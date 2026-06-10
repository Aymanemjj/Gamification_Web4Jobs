<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBadgeRequest extends FormRequest
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
            "name" => "required|string|max:255|unique:achievements",
            "description" => "required|string|max:255",
            "rarity" => "required|string|max:255",
            "emoji" => "required|string|max:255",
            "type" => "required|string|max:255",
            "wining_rules" => "required|json",
        ];
    }

    public function messages(): array
    {
        return [
            "name.required" => "Name is required.",
            "name.unique" => "This achievement name already exists.",
            "description.required" => "Description is required.",
            "rarity.required" => "Rarity is required.",
            "emoji.required" => "Emoji is required.",
            "type.required" => "Type is required.",
            "wining_rules.required" => "Wining rules are required.",
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
