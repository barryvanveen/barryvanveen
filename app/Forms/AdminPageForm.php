<?php
namespace Barryvanveen\Forms;

use Laracasts\Validation\FactoryInterface as ValidatorFactory;
use Laracasts\Validation\FormValidator;

// todo: rewrite AdminPageForm to new validation
class AdminPageForm extends FormValidator
{
    /**
     * Validation rules for the page form.
     *
     * @var array
     */
    protected $rules = [
        'title'  => 'required',
        'text'   => 'required',
        'online' => 'required',
    ];

    protected $messages;

    public function __construct(ValidatorFactory $validator)
    {
        parent::__construct($validator);

        $this->messages = [
            'title.required'  => trans('general.validation-title-required'),
            'text.required'   => trans('general.validation-text-required'),
            'online.required' => trans('general.validation-online-required'),
        ];
    }
}
