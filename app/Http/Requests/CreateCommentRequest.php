<?php

namespace Barryvanveen\Http\Requests;

use Illuminate\Http\JsonResponse;

class CreateCommentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                     => 'required|email',
            'name'                      => 'required',
            'text'                      => 'required',
            'youshouldnotfillthisfield' => 'size:0',
        ];
    }

    /**
     * Get the error messages that are returned when this request does not pass validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'                 => trans('validation.email-required'),
            'email.email'                    => trans('validation.email-email'),
            'name.required'                  => trans('validation.name-required'),
            'text.required'                  => trans('validation.message-required'),
            'youshouldnotfillthisfield.size' => trans('validation.youshouldnotfillthisfield-size'),
        ];
    }

    public function response(array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return $this->redirector->to($this->getRedirectUrl().'#add-your-comment')
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
