<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinfoAPIRequest;
use App\Http\Requests\API\UpdateinfoAPIRequest;
use App\Models\info;
use App\Repositories\infoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class infoController
 * @package App\Http\Controllers\API
 */

class infoAPIController extends AppBaseController
{
    /** @var  infoRepository */
    private $infoRepository;

    public function __construct(infoRepository $infoRepo)
    {
        $this->infoRepository = $infoRepo;
    }

    /**
     * Display a listing of the info.
     * GET|HEAD /infos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->infoRepository->pushCriteria(new RequestCriteria($request));
        $this->infoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $infos = $this->infoRepository->all();

        return $this->sendResponse($infos->toArray(), 'Infos retrieved successfully');
    }

    /**
     * Store a newly created info in storage.
     * POST /infos
     *
     * @param CreateinfoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateinfoAPIRequest $request)
    {
        $input = $request->all();

        $infos = $this->infoRepository->create($input);

        return $this->sendResponse($infos->toArray(), 'Info saved successfully');
    }

    /**
     * Display the specified info.
     * GET|HEAD /infos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var info $info */
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            return $this->sendError('Info not found');
        }

        return $this->sendResponse($info->toArray(), 'Info retrieved successfully');
    }

    /**
     * Update the specified info in storage.
     * PUT/PATCH /infos/{id}
     *
     * @param  int $id
     * @param UpdateinfoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinfoAPIRequest $request)
    {
        $input = $request->all();

        /** @var info $info */
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            return $this->sendError('Info not found');
        }

        $info = $this->infoRepository->update($input, $id);

        return $this->sendResponse($info->toArray(), 'info updated successfully');
    }

    /**
     * Remove the specified info from storage.
     * DELETE /infos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var info $info */
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            return $this->sendError('Info not found');
        }

        $info->delete();

        return $this->sendResponse($id, 'Info deleted successfully');
    }
}
