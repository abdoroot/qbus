<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateReviewAPIRequest;
use App\Http\Requests\API\UpdateReviewAPIRequest;
use App\Models\Review;
use App\Repositories\ReviewRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ReviewController
 * @package App\Http\Controllers\API
 */

class ReviewAPIController extends AppBaseController
{
    /** @var  ReviewRepository */
    private $reviewRepository;

    public function __construct(ReviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }

    /**
     * Display a listing of the Review.
     * GET|HEAD /reviews
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $reviews = $this->reviewRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(
            $reviews->toArray(),
            __('messages.retrieved', ['model' => __('models/reviews.plural')])
        );
    }

    /**
     * Store a newly created Review in storage.
     * POST /reviews
     *
     * @param CreateReviewAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateReviewAPIRequest $request)
    {
        $input = $request->all();

        $review = $this->reviewRepository->create($input);

        return $this->sendResponse(
            $review->toArray(),
            __('messages.saved', ['model' => __('models/reviews.singular')])
        );
    }

    /**
     * Display the specified Review.
     * GET|HEAD /reviews/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Review $review */
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reviews.singular')])
            );
        }

        return $this->sendResponse(
            $review->toArray(),
            __('messages.retrieved', ['model' => __('models/reviews.singular')])
        );
    }

    /**
     * Update the specified Review in storage.
     * PUT/PATCH /reviews/{id}
     *
     * @param int $id
     * @param UpdateReviewAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReviewAPIRequest $request)
    {
        $input = $request->all();

        /** @var Review $review */
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reviews.singular')])
            );
        }

        $review = $this->reviewRepository->update($input, $id);

        return $this->sendResponse(
            $review->toArray(),
            __('messages.updated', ['model' => __('models/reviews.singular')])
        );
    }

    /**
     * Remove the specified Review from storage.
     * DELETE /reviews/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Review $review */
        $review = $this->reviewRepository->find($id);

        if (empty($review)) {
            return $this->sendError(
                __('messages.not_found', ['model' => __('models/reviews.singular')])
            );
        }

        $review->delete();

        return $this->sendResponse(
            $id,
            __('messages.deleted', ['model' => __('models/reviews.singular')])
        );
    }
}
