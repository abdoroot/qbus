<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Repositories\CouponRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Provider;
use Flash;
use Response;

class CouponController extends AppBaseController
{
    /** @var CouponRepository $couponRepository*/
    private $couponRepository;

    public function __construct(CouponRepository $couponRepo)
    {
        $this->couponRepository = $couponRepo;
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
        $coupons = $this->couponRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');

        return view('admin.coupons.index')
            ->with('coupons', $coupons)
            ->with('providers', $providers);
    }

    /**
     * Show the form for creating a new Coupon.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.coupons.create');
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
        $input = $request->all();

        $coupon = $this->couponRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/coupons.singular')]));
        return redirect(route('admin.coupons.index'));
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

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('admin.coupons.index'));
        }

        return view('admin.coupons.show')->with('coupon', $coupon);
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

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('admin.coupons.index'));
        }

        return view('admin.coupons.edit')->with('coupon', $coupon);
    }

    /**
     * Update the specified Coupon in storage.
     *
     * @param int $id
     * @param UpdateCouponRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCouponRequest $request)
    {
        $coupon = $this->couponRepository->find($id);

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('admin.coupons.index'));
        }

        $input = $request->all();
        $coupon = $this->couponRepository->update($input, $id);

        Flash::success(__('messages.updated', ['model' => __('models/coupons.singular')]));
        return redirect(route('admin.coupons.index'));
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

        if (empty($coupon)) {
            Flash::error(__('messages.not_found', ['model' => __('models/coupons.singular')]));
            return redirect(route('admin.coupons.index'));
        }

        $this->couponRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/coupons.singular')]));
        return redirect(route('admin.coupons.index'));
    }
}
