<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Str;
use Flash;
use Response;
use Auth;

class CouponController extends AppBaseController
{
    /** @var CouponRepository $couponRepository*/
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
    }

    /**
     * Display a listing of the Coupon.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $coupons = $this->couponRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        return view('provider.coupons.index')
            ->with('coupons', $coupons);
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('provider.coupons.create');
    }

    /**
     * Store a newly created Coupon in storage.
     *
     * @param CreateCouponRequest $request
     *
     * @return Response
     */
    public function store(CreateCouponRequest $request)
    {
        if($request->type == 'percentage' && $request->discount >= 100) {
            return redirect()->back()->withErrors(['discount' => __('validation.min.numeric', ['attribute' => __('models/coupons.fields.discount')])]);
        }

        $input = $request->only('name', 'date_from', 'date_to', 'type', 'discount');
        $input['provider_id'] = $this->provider_id;

        $code = Str::random(5);
        while(!is_null(Coupon::where('code', $code)->first())) {
            $code = Str::random(5);
        }

        $input['code'] = $code;

        $coupon = $this->couponRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/coupons.singular')]));
        return redirect(route('provider.coupons.index'));
    }

    /**
     * Display the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon) || $coupon->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('provider.coupons.index'));
        }

        return view('provider.coupons.show')->with('coupon', $coupon);
    }

    /**
     * Show the form for editing the specified Coupon.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon) || $coupon->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('provider.coupons.index'));
        }

        return view('provider.coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, CreateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon) || $coupon->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('provider.coupons.index'));
        }

        if($request->type == 'percentage' && $request->discount >= 100) {
            return redirect()->back()->withErrors(['discount' => __('validation.min.numeric', ['attribute' => __('models/coupons.fields.discount')])]);
        }
        
        $input = $request->only('name', 'date_from', 'date_to', 'type', 'discount');

        $coupon = $this->couponRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/coupons.singular')]));
        return redirect(route('provider.coupons.index'));
    }

    /**
     * Remove the specified Coupon from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon) || $coupon->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('provider.coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/coupons.singular')]));
        return redirect(route('provider.coupons.index'));
    }
}
