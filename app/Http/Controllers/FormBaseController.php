<?php

namespace App\Http\Controllers;

use App\DataTables\FormBaseDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFormBaseRequest;
use App\Http\Requests\UpdateFormBaseRequest;
use App\Repositories\FormBaseRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FormBaseController extends AppBaseController
{
    /** @var  FormBaseRepository */
    private $formBaseRepository;

    public function __construct(FormBaseRepository $formBaseRepo)
    {
        $this->formBaseRepository = $formBaseRepo;
    }

    /**
     * Display a listing of the FormBase.
     *
     * @param FormBaseDataTable $formBaseDataTable
     * @return Response
     */
    public function index(FormBaseDataTable $formBaseDataTable)
    {
        return $formBaseDataTable->render('form_bases.index');
    }

    /**
     * Show the form for creating a new FormBase.
     *
     * @return Response
     */
    public function create()
    {
        return view('form_bases.create');
    }

    /**
     * Store a newly created FormBase in storage.
     *
     * @param CreateFormBaseRequest $request
     *
     * @return Response
     */
    public function store(CreateFormBaseRequest $request)
    {
        $input = $request->all();

        $formBase = $this->formBaseRepository->create($input);

        Flash::success(__('Form Base saved successfully.'));

        return redirect(route('formBases.index'));
    }

    /**
     * Display the specified FormBase.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formBase = $this->formBaseRepository->findWithoutFail($id);

        if (empty($formBase)) {
            Flash::error(_('Form Base not found'));

            return redirect(route('formBases.index'));
        }

        return view('form_bases.show')->with('formBase', $formBase);
    }

    /**
     * Show the form for editing the specified FormBase.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formBase = $this->formBaseRepository->findWithoutFail($id);

        if (empty($formBase)) {
            Flash::error(__('Form Base not found'));

            return redirect(route('formBases.index'));
        }

        return view('form_bases.edit')->with('formBase', $formBase);
    }

    /**
     * Update the specified FormBase in storage.
     *
     * @param  int              $id
     * @param UpdateFormBaseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormBaseRequest $request)
    {
        $formBase = $this->formBaseRepository->findWithoutFail($id);

        if (empty($formBase)) {
            Flash::error(__('Form Base not found'));

            return redirect(route('formBases.index'));
        }

        $formBase = $this->formBaseRepository->update($request->all(), $id);

        Flash::success(__('Form Base updated successfully.'));

        return redirect(route('formBases.index'));
    }

    /**
     * Remove the specified FormBase from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formBase = $this->formBaseRepository->findWithoutFail($id);

        if (empty($formBase)) {
            Flash::error(__('Form Base not found'));

            return redirect(route('formBases.index'));
        }

        $this->formBaseRepository->delete($id);

        Flash::success(__('Form Base deleted successfully.'));

        return redirect(route('formBases.index'));
    }
}
