<?php

namespace App\Http\Controllers;

use App\DataTables\Sample3DataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSample3Request;
use App\Http\Requests\UpdateSample3Request;
use App\Repositories\Sample3Repository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class Sample3Controller extends AppBaseController
{
    /** @var  Sample3Repository */
    private $sample3Repository;

    public function __construct(Sample3Repository $sample3Repo)
    {
        $this->sample3Repository = $sample3Repo;
    }

    /**
     * Display a listing of the Sample3.
     *
     * @param Sample3DataTable $sample3DataTable
     * @return Response
     */
    public function index(Sample3DataTable $sample3DataTable)
    {
        return $sample3DataTable->render('sample3s.index');
    }

    /**
     * Show the form for creating a new Sample3.
     *
     * @return Response
     */
    public function create()
    {
        return view('sample3s.create');
    }

    /**
     * Store a newly created Sample3 in storage.
     *
     * @param CreateSample3Request $request
     *
     * @return Response
     */
    public function store(CreateSample3Request $request)
    {
        $input = $request->all();

        $sample3 = $this->sample3Repository->create($input);

        Flash::success(__('Sample3 saved successfully.'));

        return redirect(route('sample3s.index'));
    }

    /**
     * Display the specified Sample3.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            Flash::error(_('Sample3 not found'));

            return redirect(route('sample3s.index'));
        }

        return view('sample3s.show')->with('sample3', $sample3);
    }

    /**
     * Show the form for editing the specified Sample3.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            Flash::error(__('Sample3 not found'));

            return redirect(route('sample3s.index'));
        }

        return view('sample3s.edit')->with('sample3', $sample3);
    }

    /**
     * Update the specified Sample3 in storage.
     *
     * @param  int              $id
     * @param UpdateSample3Request $request
     *
     * @return Response
     */
    public function update($id, UpdateSample3Request $request)
    {
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            Flash::error(__('Sample3 not found'));

            return redirect(route('sample3s.index'));
        }

        $sample3 = $this->sample3Repository->update($request->all(), $id);

        Flash::success(__('Sample3 updated successfully.'));

        return redirect(route('sample3s.index'));
    }

    /**
     * Remove the specified Sample3 from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sample3 = $this->sample3Repository->findWithoutFail($id);

        if (empty($sample3)) {
            Flash::error(__('Sample3 not found'));

            return redirect(route('sample3s.index'));
        }

        $this->sample3Repository->delete($id);

        Flash::success(__('Sample3 deleted successfully.'));

        return redirect(route('sample3s.index'));
    }
}
