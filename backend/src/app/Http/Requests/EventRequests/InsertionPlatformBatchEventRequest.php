<?php

namespace App\Http\Requests\EventRequests;

use App\DTOs\SourcesEvents\InsertionPlatformEventDTO;
use App\Interfaces\SourceBatchEventRequestInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Override;

class InsertionPlatformBatchEventRequest extends FormRequest implements
    SourceBatchEventRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $platform = \App\Models\Platform::where(
            "name",
            "insertion_platform",
        )->first();

        $rules = [];

        foreach ($this->all() as $index => $item) {
            $rules["$index.source"] = "required|string|in:insertion_platform";
            $rules["$index.event_type"] = [
                "required",
                "string",
                "max:255",
                Rule::exists("event_types", "type")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ];
            $rules["$index.learner_email"] = [
                "required",
                "email",
                "max:255",
                Rule::exists("users", "email"),
            ];
            $rules["$index.external_user_id"] = [
                "required",
                "string",
                "max:255",
                Rule::exists("user_platform_accounts", "external_id")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ];
            $rules["$index.metric_key"] =
                "required|string|max:255|exists:metric_keys,name";
            $rules["$index.value"] = "required|numeric";
            $rules["$index.previous_value"] = "nullable|numeric";
            $rules["$index.entity_type"] = "required|string|max:255";
            $rules["$index.entity_id"] = "required|string|max:255";
            $rules["$index.happened_at"] =
                "required|date_format:Y-m-d\TH:i:s\Z";
            $rules["$index.dedupe_key"] =
                "required|string|max:500|unique:events,dedupe_key";

            $rules["$index.metadata"] = "array";
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            "*.source.required" => "Event source is required.",
            "*.source.in" => "Invalid event source.",
            "*.event_type.required" => "Event type is required.",
            "*.external_user_id.required" => "External user ID is required.",
            "*.learner_email.required" => "User email is required.",
            "*.learner_email.email" =>
                "User email must be a valid email address.",
            "*.metric_key.required" => "Metric key is required.",
            "*.value.required" => "Value is required.",
            "*.value.numeric" => "Value must be a number.",
            "*.previous_value.numeric" => "Previous value must be a number.",
            "*.entity_type.required" => "Entity type is required.",
            "*.entity_id.required" => "Entity ID is required.",
            "*.happened_at.required" => "Event timestamp is required.",
            "*.happened_at.date_format" =>
                "Timestamp must be ISO 8601 format (e.g. 2026-05-21T14:30:00Z).",
            "*.dedupe_key.required" => "Dedupe key is required.",
            "*.metadata.array" => "Metadata must be an object.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "success" => false,
                    "message" => "Invalid request",
                    "errors" => $validator->errors(),
                ],
                422,
            ),
        );
    }

    public function toDTOCollection(): array
    {
        $data = $this->validated();
        return InsertionPlatformEventDTO::collection($data);
    }
}