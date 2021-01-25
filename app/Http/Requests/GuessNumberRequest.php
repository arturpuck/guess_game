<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Rules\NumberIsInCorrectRange;
use App\Rules\GameHasActiveStatus;
use App\Rules\GameIDIsNotToOld;


class GuessNumberRequest extends FormRequest
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
            'id' => ['bail','required', 'string', 'exists:games', new GameHasActiveStatus(), new GameIDIsNotToOld()],
            'number' => ['required', 'integer', new NumberIsInCorrectRange(intval($this->id))]
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['error' => $validator->messages()->all()],400));
    }
}
