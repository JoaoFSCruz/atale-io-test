<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetFamilyCountRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns,filter|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The email is required to perform the search',
            'email.email' => 'That is not a valid email format',
            'email.exists' => 'The email provided does not exist in our records'
        ];
    }
}
