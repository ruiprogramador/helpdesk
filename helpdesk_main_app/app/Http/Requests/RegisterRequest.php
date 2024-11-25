<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\GlobalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterRequest extends GlobalRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'agree' => ['required', 'accepted'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:255', 'regex:/[A-Z]/', 'regex:/[!@#$%^&*(),.?":{}|<>]/'],
        ];

        return array_merge(parent::rules(), $rules);
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        /**
         * Use GlobalRequest
         */
        //dd(parent::messages());

        $register_messages = [
            'regex' => 'The :attribute must contain at least one uppercase letter and one special character',
            'password.confirmed' => 'Passwords do not match',
        ];

        return array_merge(parent::messages(), $register_messages);
    }
}
