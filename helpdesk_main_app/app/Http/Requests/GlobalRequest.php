<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class GlobalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(
            1 == 1
            && Auth::check()
        )
        {
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the general validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    /**
     * Get the general validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {

        return [

            // attribute required
            'required' => 'The :attribute field is required',
            'min' => 'The :attribute field must be at least :min characters',
            'max' => 'The :attribute field must be at most :max characters',
            'unique' => 'The :attribute is already taken',
            'boolean' => 'The :attribute field must be true or false',
            'accepted' => 'You must accept the :attribute.',
        ];
    }

    /**
     * Get the current request validated
     */
    public function validate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, $this->rules(), $this->messages());
    }
}
