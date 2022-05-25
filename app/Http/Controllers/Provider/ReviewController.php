<?php

namespace App\Http\Controllers\Provider;

use App\Http\Requests\UpdateReviewRequest;
use App\Repositories\ReviewRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\User;
use App\Models\BusOrder;
use App\Models\Package;
use Flash;
use Response;
use Auth;

class ReviewController extends AppBaseController
{
    /** @var ReviewRepository $reviewRepository*/
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
        $this->middleware(function ($request, $next) {
            $this->provider_id = Auth::guard('provider')->user()->provider_id;    
            return $next($request);
        });
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
        $reviews = $this->reviewRepository->all(array_merge($request->all(), ['provider_id' => $this->provider_id]));

        $users = User::pluck('name', 'id');
        $packages = Package::pluck('name', 'id');
        $trips = Trip::pluck('id', 'id');
        $busOrders = BusOrder::pluck('id', 'id');

        return view('provider.reviews.index')
            ->with('reviews', $reviews)
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
        if (empty($review) || $review->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/reviews.singular')]));
            return redirect(route('provider.reviews.index'));
        }

        return view('provider.reviews.show')->with('review', $review);
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
        if (empty($review) || $review->provider_id != $this->provider_id) {
            Flash::error(__('messages.not_found', ['model' => __('models/reviews.singular')]));
            return redirect(route('provider.reviews.index'));
        }

        $this->reviewRepository->update(['publish' => $request->publish], $id);

        Flash::success(__('messages.updated', ['model' => __('models/reviews.singular')]));
        return redirect(route('provider.reviews.show', $id));
    }
}
