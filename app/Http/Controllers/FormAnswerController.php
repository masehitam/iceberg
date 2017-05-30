<?php

namespace App\Http\Controllers;

use App\DataTables\FormAnswerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFormAnswerRequest;
use App\Http\Requests\UpdateFormAnswerRequest;
use App\Repositories\FormAnswerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FormAnswerController extends AppBaseController
{
    /** @var  FormAnswerRepository */
    private $formAnswerRepository;

    public function __construct(FormAnswerRepository $formAnswerRepo)
    {
        $this->formAnswerRepository = $formAnswerRepo;
    }

    /**
     * Display a listing of the FormAnswer.
     *
     * @param FormAnswerDataTable $formAnswerDataTable
     * @return Response
     */
    public function index(FormAnswerDataTable $formAnswerDataTable)
    {
        return $formAnswerDataTable->render('form_answers.index');
    }

    /**
     * Show the form for creating a new FormAnswer.
     *
     * @return Response
     */
    public function create()
    {
        return view('form_answers.create');
    }

    /**
     * Store a newly created FormAnswer in storage.
     *
     * @param CreateFormAnswerRequest $request
     *
     * @return Response
     */
    public function store(CreateFormAnswerRequest $request)
    {
        $input = $request->all();

        $formAnswer = $this->formAnswerRepository->create($input);

        Flash::success(__('Form Answer saved successfully.'));

        return redirect(route('formAnswers.index'));
    }

    /**
     * Display the specified FormAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formAnswer = $this->formAnswerRepository->findWithoutFail($id);

        if (empty($formAnswer)) {
            Flash::error(_('Form Answer not found'));

            return redirect(route('formAnswers.index'));
        }

        return view('form_answers.show')->with('formAnswer', $formAnswer);
    }

    /**
     * Show the form for editing the specified FormAnswer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formAnswer = $this->formAnswerRepository->findWithoutFail($id);

        if (empty($formAnswer)) {
            Flash::error(__('Form Answer not found'));

            return redirect(route('formAnswers.index'));
        }

        return view('form_answers.edit')->with('formAnswer', $formAnswer);
    }

    /**
     * Update the specified FormAnswer in storage.
     *
     * @param  int              $id
     * @param UpdateFormAnswerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormAnswerRequest $request)
    {
        $formAnswer = $this->formAnswerRepository->findWithoutFail($id);

        if (empty($formAnswer)) {
            Flash::error(__('Form Answer not found'));

            return redirect(route('formAnswers.index'));
        }

        $formAnswer = $this->formAnswerRepository->update($request->all(), $id);

        Flash::success(__('Form Answer updated successfully.'));

        return redirect(route('formAnswers.index'));
    }

    /**
     * Remove the specified FormAnswer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formAnswer = $this->formAnswerRepository->findWithoutFail($id);

        if (empty($formAnswer)) {
            Flash::error(__('Form Answer not found'));

            return redirect(route('formAnswers.index'));
        }

        $this->formAnswerRepository->delete($id);

        Flash::success(__('Form Answer deleted successfully.'));

        return redirect(route('formAnswers.index'));
    }
}
