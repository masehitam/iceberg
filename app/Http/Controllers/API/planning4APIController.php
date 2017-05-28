<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\Createplanning4APIRequest;
use App\Http\Requests\API\Updateplanning4APIRequest;
use App\Models\planning4;
use App\Repositories\planning4Repository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class planning4Controller
 * @package App\Http\Controllers\API
 */

class planning4APIController extends AppBaseController
{
    /** @var  planning4Repository */
    private $planning4Repository;

    public function __construct(planning4Repository $planning4Repo)
    {
        $this->planning4Repository = $planning4Repo;
    }

    /**
     * Display a listing of the planning4.
     * GET|HEAD /planning4s
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->planning4Repository->pushCriteria(new RequestCriteria($request));
        $this->planning4Repository->pushCriteria(new LimitOffsetCriteria($request));
        $planning4s = $this->planning4Repository->all();

        return $this->sendResponse($planning4s->toArray(), 'Planning4S retrieved successfully');
    }

    /**
     * Store a newly created planning4 in storage.
     * POST /planning4s
     *
     * @param Createplanning4APIRequest $request
     *
     * @return Response
     */
    public function store(Createplanning4APIRequest $request)
    {
        $input = $request->all();

        $planning4s = $this->planning4Repository->create($input);

        return $this->sendResponse($planning4s->toArray(), 'Planning4 saved successfully');
    }

    /**
     * Display the specified planning4.
     * GET|HEAD /planning4s/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var planning4 $planning4 */
        $planning4 = $this->planning4Repository->findWithoutFail($id);

        if (empty($planning4)) {
            return $this->sendError('Planning4 not found');
        }

        return $this->sendResponse($planning4->toArray(), 'Planning4 retrieved successfully');
    }

    /**
     * Update the specified planning4 in storage.
     * PUT/PATCH /planning4s/{id}
     *
     * @param  int $id
     * @param Updateplanning4APIRequest $request
     *
     * @return Response
     */
    public function update($id, Updateplanning4APIRequest $request)
    {
        $input = $request->all();

        /** @var planning4 $planning4 */
        $planning4 = $this->planning4Repository->findWithoutFail($id);

        if (empty($planning4)) {
            return $this->sendError('Planning4 not found');
        }

        $planning4 = $this->planning4Repository->update($input, $id);

        return $this->sendResponse($planning4->toArray(), 'planning4 updated successfully');
    }

    /**
     * Remove the specified planning4 from storage.
     * DELETE /planning4s/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var planning4 $planning4 */
        $planning4 = $this->planning4Repository->findWithoutFail($id);

        if (empty($planning4)) {
            return $this->sendError('Planning4 not found');
        }

        $planning4->delete();

        return $this->sendResponse($id, 'Planning4 deleted successfully');
    }
}
