<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLeagueRequest extends FormRequest
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
            "name" => "required|string|max:255|unique:leagues",
            "color" => "required|string|max:255|unique:leagues",
            "minimum_xp" => "required|integer|unique:leagues",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required.",
            "name.unique" => "This league name already exists.",
            "color.required" => "Color is required.",
            "color.unique" => "This color is already used.",
            "minimum_xp.required" => "Minimum XP is required.",
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
