<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSample3APIRequest;
use App\Http\Requests\API\UpdateSample3APIRequest;
use App\Models\Sample3;
use App\Repositories\Sample3Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Sample3Controller
 * @package App\Http\Controllers\API
 */

class Sample3APIController extends AppBaseController
{
    /** @var  Sample3Repository */
    private $sample3Repository;

    public function __construct(Sample3Repository $sample3Repo)
    {
        $this->sample3Repository = $sample3Repo;
    }

    /**
     * Display a listing of the Sample3.
     * GET|HEAD /sample3s
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sample3Repository->pushCriteria(new RequestCriteria($request));
        $this->sample3Repository->pushCriteria(new LimitOffsetCriteria($request));
        $sample3s = $this->sample3Repository->all();

        return $this->sendResponse($sample3s->toArray(), 'Sample3S retrieved successfully');
    }

    /**
     * Store a newly created Sample3 in storage.
     * POST /sample3s
     *
     * @param CreateSample3APIRequest $request
     *
     * @return Response
     */
    public function store(CreateSample3APIRequest $request)
    {
        $input = $request->all();

        $sample3s = $this->sample3Repository->create($input);

        return $this->sendResponse($sample3s->toArray(), 'Sample3 saved successfully');
    }

    /**
     * Display the specified Sample3.
     * GET|HEAD /sample3s/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sample3 $sample3 */
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            return $this->sendError('Sample3 not found');
        }

        return $this->sendResponse($sample3->toArray(), 'Sample3 retrieved successfully');
    }

    /**
     * Update the specified Sample3 in storage.
     * PUT/PATCH /sample3s/{id}
     *
     * @param  int $id
     * @param UpdateSample3APIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSample3APIRequest $request)
    {
        $input = $request->all();

        /** @var Sample3 $sample3 */
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            return $this->sendError('Sample3 not found');
        }

        $sample3 = $this->sample3Repository->update($input, $id);

        return $this->sendResponse($sample3->toArray(), 'Sample3 updated successfully');
    }

    /**
     * Remove the specified Sample3 from storage.
     * DELETE /sample3s/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sample3 $sample3 */
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            return $this->sendError('Sample3 not found');
        }

        $sample3->delete();

        return $this->sendResponse($id, 'Sample3 deleted successfully');
    }
}
