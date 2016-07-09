<?php
namespace Barryvanveen\Http\Controllers\Admin;

use Barryvanveen\Comments\CommentRepository;
use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Jobs\Comments\UpdateComment;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use View;

class AdminCommentsController extends Controller
{
    /** @var CommentRepository */
    private $commentRepository;

    /** @var Request */
    private $request;

    /** @var array */
    private $rules = [
        'email'  => 'required',
        'text'   => 'required',
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
        $this->request           = $request;

        $this->messages = [
            'email.required'            => trans('validation.email-required'),
            'text.required'             => trans('validation.text-required'),
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
        $this->setPageTitle(trans('meta.pagetitle-admin-blog-edit'));

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
        $this->validate($this->request,  $this->rules, $this->messages);

        $this->dispatch(
            new UpdateComment(
                $id,
                $this->request->get('email'),
                $this->request->get('text')
            )
        );

        Flash::success(trans('flash.comment-updated'));

        return Redirect::route('admin.comments');
    }
}
