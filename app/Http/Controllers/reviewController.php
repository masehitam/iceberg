<?php

namespace App\Http\Controllers;

use App\DataTables\reviewDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatereviewRequest;
use App\Http\Requests\UpdatereviewRequest;
use App\Repositories\reviewRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class reviewController extends AppBaseController
{
    /** @var  reviewRepository */
    private $reviewRepository;

    public function __construct(reviewRepository $reviewRepo)
    {
        $this->reviewRepository = $reviewRepo;
    }

    /**
     * Display a listing of the review.
     *
     * @param reviewDataTable $reviewDataTable
     * @return Response
     */
    public function index(reviewDataTable $reviewDataTable)
    {
        return $reviewDataTable->render('reviews.index');
    }

    /**
     * Show the form for creating a new review.
     *
     * @return Response
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created review in storage.
     *
     * @param CreatereviewRequest $request
     *
     * @return Response
     */
    public function store(CreatereviewRequest $request)
    {
        $input = $request->all();

        $review = $this->reviewRepository->create($input);

        Flash::success(__('Review saved successfully.'));

        return redirect(route('reviews.index'));
    }

    /**
     * Display the specified review.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            Flash::error(_('Review not found'));

            return redirect(route('reviews.index'));
        }

        return view('reviews.show')->with('review', $review);
    }

    /**
     * Show the form for editing the specified review.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            Flash::error(__('Review not found'));

            return redirect(route('reviews.index'));
        }

        return view('reviews.edit')->with('review', $review);
    }

    /**
     * Update the specified review in storage.
     *
     * @param  int              $id
     * @param UpdatereviewRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatereviewRequest $request)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            Flash::error(__('Review not found'));

            return redirect(route('reviews.index'));
        }

        $review = $this->reviewRepository->update($request->all(), $id);

        Flash::success(__('Review updated successfully.'));

        return redirect(route('reviews.index'));
    }

    /**
     * Remove the specified review from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $review = $this->reviewRepository->findWithoutFail($id);

        if (empty($review)) {
            Flash::error(__('Review not found'));

            return redirect(route('reviews.index'));
        }

        $this->reviewRepository->delete($id);

        Flash::success(__('Review deleted successfully.'));

        return redirect(route('reviews.index'));
    }
}
