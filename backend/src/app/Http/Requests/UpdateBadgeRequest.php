<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBadgeRequest extends FormRequest
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
                "sometimes|string|max:255|unique:achievements,name," .
                $this->achievement->id,
            "description" => "sometimes|string|max:255",
            "rarity" => "sometimes|string|max:255",
            "emoji" => "sometimes|string|max:255",
            "type" => "sometimes|string|max:255",
            "wining_rules" => "sometimes|json",
        ];
    }

    public function messages(): array
    {
        return [
            "name.unique" => "This achievement name already exists.",
            "wining_rules.json" => "Wining rules must be valid JSON.",
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
