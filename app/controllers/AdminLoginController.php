<?php

use Barryvanveen\Exceptions\InvalidLoginException;
use Barryvanveen\Forms\AdminLoginForm;
use Barryvanveen\Users\UserRepository;
use Illuminate\Http\RedirectResponse;
use Laracasts\Validation\FormValidationException;

class AdminLoginController extends BaseController
{
    /** @var AdminLoginForm */
    private $adminLoginForm;

    /** @var UserRepository */
    private $userRepository;

    /**
     * @param AdminLoginForm $adminLoginForm
     * @param UserRepository $userRepository
     */
    public function __construct(AdminLoginForm $adminLoginForm, UserRepository $userRepository)
    {
        $this->adminLoginForm = $adminLoginForm;
        $this->userRepository = $userRepository;
    }

    /**
     * Display the AdminLoginForm form.
     */
    public function index()
    {
        Head::title('Log In');

        return View::make('templates.admin.login');
    }

    /**
     * Handle a login request for the admin pages.
     *
     * @return $this|RedirectResponse
     *
     * @throws FormValidationException
     * @throws InvalidLoginException
     */
    public function store()
    {
        $formData = Input::only('email', 'password');

        $this->adminLoginForm->validate($formData);

        if (Auth::attempt($formData, (bool) Input::only('remember_me'))) {
            Flash::success(trans('general.login-successful'));

            return Redirect::intended(route('admin.dashboard'));
        }

        throw new InvalidLoginException("Invalid login credentials given");
    }

    public function destroy()
    {
        Auth::logout();

        Flash::success(trans('general.logout-successful'));

        return Redirect::route('home');
    }
}
