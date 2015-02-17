<?php

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
     * Display the AdminLoginForm form
     */
    public function index()
    {
        Head::title('Log In');

        return View::make('pages.admin.login');
    }

    /**
     * Handle a login request for the admin pages
     *
     * @return $this|RedirectResponse
     * @throws FormValidationException
     */
    public function store()
    {
        $formData = Input::only('email', 'password');

        $this->adminLoginForm->validate($formData);

        if (Auth::attempt($formData, (bool) Input::only('remember_me'))) {
            Flash::success(trans('general.login-successful'));

            return Redirect::intended(route('admin.dashboard'));
        }

        $errors = [
            'password' => [
                trans('general.invalid-login'),
            ],
        ];

        return Redirect::route('admin.login')->withInput()->withErrors($errors);
    }
}
