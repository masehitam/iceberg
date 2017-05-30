<?php

namespace App\Http\Controllers;

use App\DataTables\syncDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatesyncRequest;
use App\Http\Requests\UpdatesyncRequest;
use App\Repositories\syncRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class syncController extends AppBaseController
{
    /** @var  syncRepository */
    private $syncRepository;

    public function __construct(syncRepository $syncRepo)
    {
        $this->syncRepository = $syncRepo;
    }

    /**
     * Display a listing of the sync.
     *
     * @param syncDataTable $syncDataTable
     * @return Response
     */
    public function index(syncDataTable $syncDataTable)
    {
        return $syncDataTable->render('syncs.index');
    }

    /**
     * Show the form for creating a new sync.
     *
     * @return Response
     */
    public function create()
    {
        return view('syncs.create');
    }

    /**
     * Store a newly created sync in storage.
     *
     * @param CreatesyncRequest $request
     *
     * @return Response
     */
    public function store(CreatesyncRequest $request)
    {
        $input = $request->all();

        $sync = $this->syncRepository->create($input);

        Flash::success(__('Sync saved successfully.'));

        return redirect(route('syncs.index'));
    }

    /**
     * Display the specified sync.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sync = $this->syncRepository->findWithoutFail($id);

        if (empty($sync)) {
            Flash::error(_('Sync not found'));

            return redirect(route('syncs.index'));
        }

        return view('syncs.show')->with('sync', $sync);
    }

    /**
     * Show the form for editing the specified sync.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sync = $this->syncRepository->findWithoutFail($id);

        if (empty($sync)) {
            Flash::error(__('Sync not found'));

            return redirect(route('syncs.index'));
        }

        return view('syncs.edit')->with('sync', $sync);
    }

    /**
     * Update the specified sync in storage.
     *
     * @param  int              $id
     * @param UpdatesyncRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesyncRequest $request)
    {
        $sync = $this->syncRepository->findWithoutFail($id);

        if (empty($sync)) {
            Flash::error(__('Sync not found'));

            return redirect(route('syncs.index'));
        }

        $sync = $this->syncRepository->update($request->all(), $id);

        Flash::success(__('Sync updated successfully.'));

        return redirect(route('syncs.index'));
    }

    /**
     * Remove the specified sync from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sync = $this->syncRepository->findWithoutFail($id);

        if (empty($sync)) {
            Flash::error(__('Sync not found'));

            return redirect(route('syncs.index'));
        }

        $this->syncRepository->delete($id);

        Flash::success(__('Sync deleted successfully.'));

        return redirect(route('syncs.index'));
    }
}
