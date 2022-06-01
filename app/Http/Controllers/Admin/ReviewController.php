<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\ReviewRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\updateReviewRequest;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Provider;
use App\Models\Trip;
use App\Models\Package;
use App\Models\User;
use App\Models\BusOrder;
use App\Models\Bus;
use Flash;
use Response;
use DB;

class ReviewController extends AppBaseController
{
    /** @var ReviewRepository $reviewRepository*/
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }

    /**
     * Display a listing of the Review.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $reviews = $this->reviewRepository->all($request->all());

        $providers = Provider::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');
        $trips = Trip::pluck('id', 'id');
        $busOrders = BusOrder::pluck('id', 'id');

        return view('admin.reviews.index')
            ->with('reviews', $reviews)
            ->with('providers', $providers)
            ->with('users', $users)
            ->with('trips', $trips)
            ->with('packages', $packages)
            ->with('busOrders', $busOrders);
    }

    /**
     * Display the specified Review.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reviews.singular')]));
            return redirect(route('admin.reviews.index'));
        }

        return view('admin.reviews.show')->with('review', $review);
    }
    
    /**
     * Update the specified Review.
     *
     * @param int $id
     * @param UpdateReviewRequest $request
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function update($id, UpdateReviewRequest $request)
    {
        $review = $this->reviewRepository->find($id);
        if (empty($review)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reviews.singular')]));
            return redirect(route('admin.reviews.index'));
        }

        $this->reviewRepository->update(['publish' => $request->publish], $id);

        Flash::success(__('messages.updated', ['model' => __('models/reviews.singular')]));
        return redirect(route('admin.reviews.show', $id));
    }

    /**
     * Remove the specified Review from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $review = $this->reviewRepository->find($id);
        if (empty($review)) {
            Flash::error(__('messages.not_found', ['model' => __('models/reviews.singular')]));
            return redirect(route('admin.reviews.index'));
        }

        DB::beginTransaction();

        if(!is_null($trip = Trip::find($review->trip_id))) {
            $trip->update([
                'rate' => Review::where('trip_id', $trip->id)->where('id', '!=', $id)->sum('rate') / Review::where('trip_id', $trip->id)->where('id', '!=', $id)->count()
            ]);
        }

        if(!is_null($provider = Provider::find($review->provider_id))) {
            $provider->update([
                'rate' => Review::where('provider_id', $provider->id)->where('id', '!=', $id)->sum('rate') / Review::where('provider_id', $provider->id)->where('id', '!=', $id)->count()
            ]);
        }

        if(!is_null($busOrder = BusOrder::find($review->bus_order_id)) 
            && !is_null($bus = Bus::find($busOrder->bus_id))) {
            $bus->update([
                'rate' => 
                    Review::join('bus_orders', 'bus_orders.id', '=', 'reviews.bus_order_id')
                        ->where('bus_orders.bus_id', $bus->id)
                        ->where('reviews.id', '!=', $id)
                        ->sum('reviews.rate') 
                    / 
                    Review::join('bus_orders', 'bus_orders.id', '=', 'reviews.bus_order_id')
                        ->where('bus_orders.bus_id', $bus->id)
                        ->where('reviews.id', '!=', $id)
                        ->count()
            ]);
        }
        
        $this->reviewRepository->delete($id);
        
        DB::commit();

        Flash::success(__('messages.deleted', ['model' => __('models/reviews.singular')]));
        return redirect(route('admin.reviews.index'));
    }
}
