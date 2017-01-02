<?php

namespace Barryvanveen\Http\Controllers\Admin;

use Auth;
use Barryvanveen\Exceptions\InvalidLoginException;
use Barryvanveen\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Input;
use Redirect;
use View;

class AdminLoginController extends Controller
{
    /** @var Request */
    private $request;

    /** @var array */
    private $rules = [
        'email'    => 'required|email',
        'password' => 'required',
    ];

    /** @var array */
    private $messages;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->messages = [
            'email.required'    => trans('validation.email-required'),
            'email.email'       => trans('validation.email-email'),
            'password.required' => trans('validation.password-required'),
        ];

        parent::__construct();
    }

    /**
     * Display the AdminLoginForm form.
     */
    public function index()
    {
        $this->setPageTitle(trans('meta.pagetitle-admin-login'));

        return View::make('templates.admin.login');
    }

    /**
     * Handle a login request for the admin pages.
     *
     * @throws InvalidLoginException
     *
     * @return RedirectResponse
     */
    public function store()
    {
        $this->validate($this->request, $this->rules, $this->messages);

        $formData = Input::only(['email', 'password']);

        if (Auth::attempt($formData, (bool) Input::only('remember_me'))) {
            Flash::success(trans('flash.login-successful'));

            return Redirect::intended(route('admin.dashboard'));
        }

        throw new InvalidLoginException('Invalid login credentials given');
    }

    public function destroy()
    {
        Auth::logout();

        Flash::success(trans('flash.logout-successful'));

        return Redirect::route('home');
    }
}
