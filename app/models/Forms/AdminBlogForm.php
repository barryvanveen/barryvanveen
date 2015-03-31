<?php namespace Barryvanveen\Forms;

use Laracasts\Validation\FactoryInterface as ValidatorFactory;
use Laracasts\Validation\FormValidator;

class AdminBlogForm extends FormValidator
{
    /**
     * Validation rules for the login form.
     *
     * @var array
     */
    protected $rules = [
        'title'            => 'required',
        'summary'          => 'required',
        'text'             => 'required',
        'publication_date' => 'required',
        'online'           => 'required',
    ];

    protected $messages;

    public function __construct(ValidatorFactory $validator)
    {
        parent::__construct($validator);

        $this->messages = [
            'title.required'            => trans('general.validation-title-required'),
            'summary.required'          => trans('general.validation-summary-required'),
            'text.required'             => trans('general.validation-text-required'),
            'publication_date.required' => trans('general.validation-publication-date-required'),
            'online.required'           => trans('general.validation-online-required'),
        ];
    }
}
