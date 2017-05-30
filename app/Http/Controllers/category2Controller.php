<?php

namespace App\Http\Controllers;

use App\DataTables\category2DataTable;
use App\Http\Requests;
use App\Http\Requests\Createcategory2Request;
use App\Http\Requests\Updatecategory2Request;
use App\Repositories\category2Repository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class category2Controller extends AppBaseController
{
    /** @var  category2Repository */
    private $category2Repository;

    public function __construct(category2Repository $category2Repo)
    {
        $this->category2Repository = $category2Repo;
    }

    /**
     * Display a listing of the category2.
     *
     * @param category2DataTable $category2DataTable
     * @return Response
     */
    public function index(category2DataTable $category2DataTable)
    {
        return $category2DataTable->render('category2s.index');
    }

    /**
     * Show the form for creating a new category2.
     *
     * @return Response
     */
    public function create()
    {
        return view('category2s.create');
    }

    /**
     * Store a newly created category2 in storage.
     *
     * @param Createcategory2Request $request
     *
     * @return Response
     */
    public function store(Createcategory2Request $request)
    {
        $input = $request->all();

        $category2 = $this->category2Repository->create($input);

        Flash::success(__('Category2 saved successfully.'));

        return redirect(route('category2s.index'));
    }

    /**
     * Display the specified category2.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $category2 = $this->category2Repository->findWithoutFail($id);

        if (empty($category2)) {
            Flash::error(_('Category2 not found'));

            return redirect(route('category2s.index'));
        }

        return view('category2s.show')->with('category2', $category2);
    }

    /**
     * Show the form for editing the specified category2.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $category2 = $this->category2Repository->findWithoutFail($id);

        if (empty($category2)) {
            Flash::error(__('Category2 not found'));

            return redirect(route('category2s.index'));
        }

        return view('category2s.edit')->with('category2', $category2);
    }

    /**
     * Update the specified category2 in storage.
     *
     * @param  int              $id
     * @param Updatecategory2Request $request
     *
     * @return Response
     */
    public function update($id, Updatecategory2Request $request)
    {
        $category2 = $this->category2Repository->findWithoutFail($id);

        if (empty($category2)) {
            Flash::error(__('Category2 not found'));

            return redirect(route('category2s.index'));
        }

        $category2 = $this->category2Repository->update($request->all(), $id);

        Flash::success(__('Category2 updated successfully.'));

        return redirect(route('category2s.index'));
    }

    /**
     * Remove the specified category2 from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $category2 = $this->category2Repository->findWithoutFail($id);

        if (empty($category2)) {
            Flash::error(__('Category2 not found'));

            return redirect(route('category2s.index'));
        }

        $this->category2Repository->delete($id);

        Flash::success(__('Category2 deleted successfully.'));

        return redirect(route('category2s.index'));
    }
}
