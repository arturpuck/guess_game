<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FromRule;
use App\Rules\ToRule;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateNewGameRequest extends FormRequest
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
            'player_name' => ['nullable', 'string'],
            'from' =>  ['nullable', 'integer', new FromRule($this->to)],
            'to' => ['nullable', new ToRule($this->from)],
            'attempts' => ['nullable', 'integer', 'min:1']
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['error' => $validator->messages()->all()],400));
    }
}
