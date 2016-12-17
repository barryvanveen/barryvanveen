<?php

namespace Barryvanveen\Http\Controllers\Admin;

use View;
use Flash;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Barryvanveen\Comments\CommentRepository;
use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Jobs\Comments\UpdateComment;

class AdminCommentsController extends Controller
{
    /** @var CommentRepository */
    private $commentRepository;

    /** @var Request */
    private $request;

    /** @var array */
    private $rules = [
        'email' => 'required|email',
        'name'  => 'required',
        'text'  => 'required',
    ];

    /** @var array */
    private $messages;

    /**
     * @param CommentRepository $commentRepository
     * @param Request           $request
     */
    public function __construct(CommentRepository $commentRepository, Request $request)
    {
        $this->commentRepository = $commentRepository;
        $this->request = $request;

        $this->messages = [
            'email.required' => trans('validation.email-required'),
            'name.required'  => trans('validation.name-required'),
            'text.required'  => trans('validation.text-required'),
        ];

        parent::__construct();
    }

    /**
     * Return all comments.
     *
     * @return View
     */
    public function index()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-comments'));

        $comments = $this->commentRepository->all();

        return View::make('comments.admin.index', compact('comments'));
    }

    /**
     * Edit comment by its id.
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-comments-edit'));

        $comment = $this->commentRepository->findById($id);

        return View::make('comments.admin.edit', compact('comment'));
    }

    /**
     * Update blogpost with posted data.
     *
     * @param $id
     *
     * @return RedirectResponse
     */
    public function update($id)
    {
        $this->validate($this->request, $this->rules, $this->messages);

        $this->dispatch(
            new UpdateComment(
                $id,
                $this->request->get('email'),
                $this->request->get('name'),
                $this->request->get('text'),
                $this->request->get('ip'),
                $this->request->get('fingerprint'),
                $this->request->get('online')
            )
        );

        Flash::success(trans('flash.comment-updated'));

        return Redirect::route('admin.comments');
    }
}
