<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            //
            'name' => [
                'required',
                'max:200',
                'exists:users,name,role,user'
            ],
            'password' => [
                'required'
            ]
        ];
    }
    public function messages(): array
    {
        return[
            'name.required' => 'Name is required',
            'name.max' => 'Name is too long',
            'name.exists' => 'This Name does not exists or not valid',
            'password.required' => 'Password is required'
        ];
    }
}
