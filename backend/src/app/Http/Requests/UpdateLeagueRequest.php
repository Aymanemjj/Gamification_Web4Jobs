<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLeagueRequest extends FormRequest
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
            "name" =>
                "sometimes|string|max:255|unique:leagues,name," .
                $this->league->id,
            "color" =>
                "sometimes|string|max:255|unique:leagues,color," .
                $this->league->id,
            "minimum_xp" =>
                "sometimes|integer|unique:leagues,minimum_xp," .
                $this->league->id,
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => "This league name already exists.",
            "color.unique" => "This color is already used.",
            "minimum_xp.integer" => "Minimum XP must be a number.",
            "minimum_xp.unique" => "This minimum XP value is already used.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "success" => false,
                    "message" => "Validation error",
                    "error" => $validator->errors()->messages(),
                ],
                422,
            ),
        );
    }
}
