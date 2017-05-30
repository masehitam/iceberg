<?php

namespace App\Http\Controllers;

use App\DataTables\tagDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatetagRequest;
use App\Http\Requests\UpdatetagRequest;
use App\Repositories\tagRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class tagController extends AppBaseController
{
    /** @var  tagRepository */
    private $tagRepository;

    public function __construct(tagRepository $tagRepo)
    {
        $this->tagRepository = $tagRepo;
    }

    /**
     * Display a listing of the tag.
     *
     * @param tagDataTable $tagDataTable
     * @return Response
     */
    public function index(tagDataTable $tagDataTable)
    {
        return $tagDataTable->render('tags.index');
    }

    /**
     * Show the form for creating a new tag.
     *
     * @return Response
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created tag in storage.
     *
     * @param CreatetagRequest $request
     *
     * @return Response
     */
    public function store(CreatetagRequest $request)
    {
        $input = $request->all();

        $tag = $this->tagRepository->create($input);

        Flash::success(__('Tag saved successfully.'));

        return redirect(route('tags.index'));
    }

    /**
     * Display the specified tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error(_('Tag not found'));

            return redirect(route('tags.index'));
        }

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified tag.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error(__('Tag not found'));

            return redirect(route('tags.index'));
        }

        return view('tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified tag in storage.
     *
     * @param  int              $id
     * @param UpdatetagRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetagRequest $request)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error(__('Tag not found'));

            return redirect(route('tags.index'));
        }

        $tag = $this->tagRepository->update($request->all(), $id);

        Flash::success(__('Tag updated successfully.'));

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified tag from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tag = $this->tagRepository->findWithoutFail($id);

        if (empty($tag)) {
            Flash::error(__('Tag not found'));

            return redirect(route('tags.index'));
        }

        $this->tagRepository->delete($id);

        Flash::success(__('Tag deleted successfully.'));

        return redirect(route('tags.index'));
    }
}
