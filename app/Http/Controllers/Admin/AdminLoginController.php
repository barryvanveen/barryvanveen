<?php namespace Barryvanveen\Http\Controllers\Admin;

use Auth;
use Barryvanveen\Exceptions\InvalidLoginException;
use Barryvanveen\Http\Controllers\Controller;
use Barryvanveen\Users\UserRepository;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Input;
use Redirect;
use View;

class AdminLoginController extends Controller
{
    /** @var UserRepository */
    private $userRepository;

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
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository, Request $request)
    {
        $this->userRepository = $userRepository;
        $this->request        = $request;

        $this->messages = [
            'email.required'    => trans('general.validation-email-required'),
            'email.email'       => trans('general.validation-email-email'),
            'password.required' => trans('general.validation-password-required'),
        ];

        parent::__construct();
    }

    /**
     * Display the AdminLoginForm form.
     */
    public function index()
    {
        $this->setPageTitle('Log In');

        return View::make('templates.admin.login');
    }

    /**
     * Handle a login request for the admin pages.
     *
     * @return $this|RedirectResponse
     *
     * @throws InvalidLoginException
     */
    public function store()
    {
        $this->validate($this->request, $this->rules, $this->messages);

        $formData = Input::only('email', 'password');

        if (Auth::attempt($formData, (bool) Input::only('remember_me'))) {
            Flash::success(trans('general.login-successful'));

            return Redirect::intended(route('admin.dashboard'));
        }

        throw new InvalidLoginException('Invalid login credentials given');
    }

    public function destroy()
    {
        Auth::logout();

        Flash::success(trans('general.logout-successful'));

        return Redirect::route('home');
    }
}
