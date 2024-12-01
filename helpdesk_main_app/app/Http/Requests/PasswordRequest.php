<?php

namespace App\Http\Requests;

use App\Http\Requests\GlobalRequest;
use Illuminate\Support\Facades\Validator;

class PasswordRequest extends GlobalRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
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

        $messages = [
            'regex' => 'The :attribute must contain at least one uppercase letter and one special character',
        ];

        return array_merge(parent::messages(), $messages);
    }

    /**
     * Get the current request validated
     */
    public function validate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, $this->rules(), $this->messages());
    }
}
