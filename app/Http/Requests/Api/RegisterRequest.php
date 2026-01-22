<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:300'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::default()]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل الايميل مطلوب',
            'email.unique' => 'الايميل مسجل من قبل  ',
            'password.required' => 'حقل الباسورد مطلوب',
            'password.confirmed' => 'حقل الباسورد غير مطابق ',
        ];
    }
}
