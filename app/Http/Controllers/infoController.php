<?php

namespace App\Http\Controllers;

use App\DataTables\infoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateinfoRequest;
use App\Http\Requests\UpdateinfoRequest;
use App\Repositories\infoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class infoController extends AppBaseController
{
    /** @var  infoRepository */
    private $infoRepository;

    public function __construct(infoRepository $infoRepo)
    {
        $this->infoRepository = $infoRepo;
    }

    /**
     * Display a listing of the info.
     *
     * @param infoDataTable $infoDataTable
     * @return Response
     */
    public function index(infoDataTable $infoDataTable)
    {
        return $infoDataTable->render('infos.index');
    }

    /**
     * Show the form for creating a new info.
     *
     * @return Response
     */
    public function create()
    {
        return view('infos.create');
    }

    /**
     * Store a newly created info in storage.
     *
     * @param CreateinfoRequest $request
     *
     * @return Response
     */
    public function store(CreateinfoRequest $request)
    {
        $input = $request->all();

        $info = $this->infoRepository->create($input);

        Flash::success(__('Info saved successfully.'));

        return redirect(route('infos.index'));
    }

    /**
     * Display the specified info.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            Flash::error(_('Info not found'));

            return redirect(route('infos.index'));
        }

        return view('infos.show')->with('info', $info);
    }

    /**
     * Show the form for editing the specified info.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            Flash::error(__('Info not found'));

            return redirect(route('infos.index'));
        }

        return view('infos.edit')->with('info', $info);
    }

    /**
     * Update the specified info in storage.
     *
     * @param  int              $id
     * @param UpdateinfoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinfoRequest $request)
    {
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            Flash::error(__('Info not found'));

            return redirect(route('infos.index'));
        }

        $info = $this->infoRepository->update($request->all(), $id);

        Flash::success(__('Info updated successfully.'));

        return redirect(route('infos.index'));
    }

    /**
     * Remove the specified info from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $info = $this->infoRepository->findWithoutFail($id);

        if (empty($info)) {
            Flash::error(__('Info not found'));

            return redirect(route('infos.index'));
        }

        $this->infoRepository->delete($id);

        Flash::success(__('Info deleted successfully.'));

        return redirect(route('infos.index'));
    }
}
