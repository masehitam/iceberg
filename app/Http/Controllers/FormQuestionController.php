<?php

namespace App\Http\Controllers;

use App\DataTables\FormQuestionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateFormQuestionRequest;
use App\Http\Requests\UpdateFormQuestionRequest;
use App\Repositories\FormQuestionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class FormQuestionController extends AppBaseController
{
    /** @var  FormQuestionRepository */
    private $formQuestionRepository;

    public function __construct(FormQuestionRepository $formQuestionRepo)
    {
        $this->formQuestionRepository = $formQuestionRepo;
    }

    /**
     * Display a listing of the FormQuestion.
     *
     * @param FormQuestionDataTable $formQuestionDataTable
     * @return Response
     */
    public function index(FormQuestionDataTable $formQuestionDataTable)
    {
        return $formQuestionDataTable->render('form_questions.index');
    }

    /**
     * Show the form for creating a new FormQuestion.
     *
     * @return Response
     */
    public function create()
    {
        return view('form_questions.create');
    }

    /**
     * Store a newly created FormQuestion in storage.
     *
     * @param CreateFormQuestionRequest $request
     *
     * @return Response
     */
    public function store(CreateFormQuestionRequest $request)
    {
        $input = $request->all();

        $formQuestion = $this->formQuestionRepository->create($input);

        Flash::success(__('Form Question saved successfully.'));

        return redirect(route('formQuestions.index'));
    }

    /**
     * Display the specified FormQuestion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $formQuestion = $this->formQuestionRepository->findWithoutFail($id);

        if (empty($formQuestion)) {
            Flash::error(_('Form Question not found'));

            return redirect(route('formQuestions.index'));
        }

        return view('form_questions.show')->with('formQuestion', $formQuestion);
    }

    /**
     * Show the form for editing the specified FormQuestion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $formQuestion = $this->formQuestionRepository->findWithoutFail($id);

        if (empty($formQuestion)) {
            Flash::error(__('Form Question not found'));

            return redirect(route('formQuestions.index'));
        }

        return view('form_questions.edit')->with('formQuestion', $formQuestion);
    }

    /**
     * Update the specified FormQuestion in storage.
     *
     * @param  int              $id
     * @param UpdateFormQuestionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFormQuestionRequest $request)
    {
        $formQuestion = $this->formQuestionRepository->findWithoutFail($id);

        if (empty($formQuestion)) {
            Flash::error(__('Form Question not found'));

            return redirect(route('formQuestions.index'));
        }

        $formQuestion = $this->formQuestionRepository->update($request->all(), $id);

        Flash::success(__('Form Question updated successfully.'));

        return redirect(route('formQuestions.index'));
    }

    /**
     * Remove the specified FormQuestion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $formQuestion = $this->formQuestionRepository->findWithoutFail($id);

        if (empty($formQuestion)) {
            Flash::error(__('Form Question not found'));

            return redirect(route('formQuestions.index'));
        }

        $this->formQuestionRepository->delete($id);

        Flash::success(__('Form Question deleted successfully.'));

        return redirect(route('formQuestions.index'));
    }
}
