<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'email' => 'required|unique:users|email:rfc,dns,filter',
            'parent' => 'nullable|email:rfc,dns,filter|exists:users,email',
            'children' => 'array',
            'children.*' => 'email:rfc,dns,filter|exists:users,email'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email is required to perform the search',
            'email.email' => 'That is not a valid email format',
            'email.exists' => 'The email provided does not exist in our records',
            'parent.email' => 'That is not a valid email format',
            'parent.exists' => 'The email provided does not exist in our records',
            'children.*.email' => 'That is not a valid email format',
            'children.*.exists' => 'The email provided does not exist in our records'
        ];
    }

}
