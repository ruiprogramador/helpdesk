<?php

namespace App\Http\Requests;

use App\Http\Requests\GlobalRequest;
use Illuminate\Support\Facades\Validator;

class ProfileRequest extends GlobalRequest
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
            'email.email' => 'The email field must be a valid email',
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
