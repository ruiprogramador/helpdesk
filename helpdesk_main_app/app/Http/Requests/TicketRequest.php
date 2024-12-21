<?php

namespace App\Http\Requests;

use App\Http\Requests\GlobalRequest;
use Illuminate\Support\Facades\Validator;

class TicketRequest extends GlobalRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Validator::extend('validateText', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z0-9\s\.\,\-\_\!\?\(\)\[\]\{\}\:\;\/\@\#\$\%\&\*\+\=\~\`\'\"\|\<\>\^\°\º\ª\ç\Ç\ã\Ã\õ\Õ\á\Á\é\É\í\Í\ó\Ó\ú\Ú\à\À\è\È\ì\Ì\ò\Ò\ù\Ù\â\Â\ê\Ê\î\Î\ô\Ô\û\Û\ä\Ä\ë\Ë\ï\Ï\ö\Ö\ü\Ü\ÿ\Ÿ\ñ\Ñ\0-9]*$/', $value);
        });

        $rules = [
            'id' => 'required|integer'
            ,'user_id' => 'required|integer|exists:users,id'
            ,'title' => 'required|string|max:255'
            ,'description' => 'required|string|validateText'
            ,'status_id' => 'required|integer|exists:status_tickets,id'
            ,'priority_id' => 'required|integer|exists:priorities_tickets,id'
            ,'category_id' => 'required|integer|exists:categories_tickets,id'
            ,'type_id' => 'required|integer|exists:ticket_types,id'
            ,'assigned_by' => 'required|integer|exists:users,id'
            ,'created_by' => 'required|integer|exists:users,id'
            ,'updated_by' => 'required|integer|exists:users,id'
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

        $messages = [];

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
