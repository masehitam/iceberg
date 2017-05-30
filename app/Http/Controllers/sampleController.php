<?php

namespace App\Http\Controllers;

use App\DataTables\sampleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatesampleRequest;
use App\Http\Requests\UpdatesampleRequest;
use App\Repositories\sampleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class sampleController extends AppBaseController
{
    /** @var  sampleRepository */
    private $sampleRepository;

    public function __construct(sampleRepository $sampleRepo)
    {
        $this->sampleRepository = $sampleRepo;
    }

    /**
     * Display a listing of the sample.
     *
     * @param sampleDataTable $sampleDataTable
     * @return Response
     */
    public function index(sampleDataTable $sampleDataTable)
    {
        return $sampleDataTable->render('samples.index');
    }

    /**
     * Show the form for creating a new sample.
     *
     * @return Response
     */
    public function create()
    {
        return view('samples.create');
    }

    /**
     * Store a newly created sample in storage.
     *
     * @param CreatesampleRequest $request
     *
     * @return Response
     */
    public function store(CreatesampleRequest $request)
    {
        $input = $request->all();

        $sample = $this->sampleRepository->create($input);

        Flash::success(__('Sample saved successfully.'));

        return redirect(route('samples.index'));
    }

    /**
     * Display the specified sample.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sample = $this->sampleRepository->findWithoutFail($id);

        if (empty($sample)) {
            Flash::error(_('Sample not found'));

            return redirect(route('samples.index'));
        }

        return view('samples.show')->with('sample', $sample);
    }

    /**
     * Show the form for editing the specified sample.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sample = $this->sampleRepository->findWithoutFail($id);

        if (empty($sample)) {
            Flash::error(__('Sample not found'));

            return redirect(route('samples.index'));
        }

        return view('samples.edit')->with('sample', $sample);
    }

    /**
     * Update the specified sample in storage.
     *
     * @param  int              $id
     * @param UpdatesampleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesampleRequest $request)
    {
        $sample = $this->sampleRepository->findWithoutFail($id);

        if (empty($sample)) {
            Flash::error(__('Sample not found'));

            return redirect(route('samples.index'));
        }

        $sample = $this->sampleRepository->update($request->all(), $id);

        Flash::success(__('Sample updated successfully.'));

        return redirect(route('samples.index'));
    }

    /**
     * Remove the specified sample from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sample = $this->sampleRepository->findWithoutFail($id);

        if (empty($sample)) {
            Flash::error(__('Sample not found'));

            return redirect(route('samples.index'));
        }

        $this->sampleRepository->delete($id);

        Flash::success(__('Sample deleted successfully.'));

        return redirect(route('samples.index'));
    }
}
