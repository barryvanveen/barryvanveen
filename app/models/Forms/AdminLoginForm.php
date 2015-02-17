<?php namespace Barryvanveen\Forms;

use Laracasts\Validation\FactoryInterface as ValidatorFactory;
use Laracasts\Validation\FormValidator;

class AdminLoginForm extends FormValidator
{

    /**
     * Validation rules for the login form
     *
     * @var array
     */
    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required',
    ];

    protected $messages;

    public function __construct(ValidatorFactory $validator)
    {
        parent::__construct($validator);

        $this->messages = [
            'email.required'    => trans('general.validation-email-required'),
            'email.email'       => trans('general.validation-email-email'),
            'password.required' => trans('general.validation-password-required'),
        ];
    }
}
