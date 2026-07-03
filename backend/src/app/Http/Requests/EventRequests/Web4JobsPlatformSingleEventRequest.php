<?php

namespace App\Http\Requests\EventRequests;

use App\DTOs\SourcesEvents\Web4JobsPlatformEventDTO;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use App\Interfaces\SourceSingleEventRequestInterface;


class Web4JobsPlatformSingleEventRequest extends FormRequest implements
    SourceSingleEventRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $platform = \App\Models\Platform::where(
            "name",
            "web4jobs_progress",
        )->first();
    
        return [
            "source" => "required|string|in:web4jobs_progress",
            "event_type" => [
                "required",
                "string",
                "max:255",
                Rule::exists("event_types", "type")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ],
            "learner_email" => [
                "required",
                "email",
                "max:255",
                Rule::exists("users", "email"),
            ],
            "external_user_id" => [
                "required",
                "string",
                "max:255",
                Rule::exists("user_platform_accounts", "external_id")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ],
            "metric_key" => "required|string|max:255|exists:metric_keys,name",
            "value" => "required|numeric",
            "previous_value" => "nullable|numeric",
            "entity_type" => "required|string|max:255",
            "entity_id" => "required|string|max:255",
            "happened_at" => "required|date_format:Y-m-d\TH:i:s\Z",
            "dedupe_key" => "required|string|max:500|unique:events,dedupe_key",

            "metadata" => "array",
            //"metadata.course_name" => "required|string|max:255",
            //"metadata.module_name" => "required|string|max:255",
            "metadata.progress_unit" =>
                "required|string|in:percentage,count,score",
        ];
    }

    public function messages(): array
    {
        return [
            "source.required" => "Event source is required.",
            "source.in" => "Invalid event source.",
            "event_type.required" => "Event type is required.",
            "external_user_id.required" => "External user ID is required.",
            "learner_email.required" => "User email is required.",
            "learner_email.email" =>
                "User email must be a valid email address.",
            "metric_key.required" => "Metric key is required.",
            "value.required" => "Value is required.",
            "value.numeric" => "Value must be a number.",
            "previous_value.numeric" => "Previous value must be a number.",
            "entity_type.required" => "Entity type is required.",
            "entity_id.required" => "Entity ID is required.",
            "happened_at.required" => "Event timestamp is required.",
            "happened_at.date_format" =>
                "Timestamp must be ISO 8601 format (e.g. 2026-05-21T14:30:00Z).",
            "dedupe_key.required" => "Dedupe key is required.",
            "metadata.required" => "Metadata is required.",
            "metadata.array" => "Metadata must be an object.",
            "metadata.course_name.required" =>
                "Metadata course name is required.",
            "metadata.module_name.required" =>
                "Metadata module name is required.",
            "metadata.progress_unit.required" =>
                "Metadata progress unit is required.",
            "metadata.progress_unit.in" =>
                "Progress unit must be one of: percentage, count, score.",
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        if ($errors->has("dedupe_key")) {
            throw new HttpResponseException(
                response()->json(
                    [
                        "success" => true,
                        "message" => "Duplicate event ignored",
                        "data" => [
                            "dedupe_key" => $this->input("dedupe_key"),
                            "status" => "duplicate_ignored",
                        ],
                    ],
                    200,
                ),
            );
        }

        throw new HttpResponseException(
            response()->json(
                [
                    "success" => false,
                    "message" => "Invalid request",
                ],
                422,
            ),
        );
    }
    public function toDTO(): Web4JobsPlatformEventDTO
    {
        $data = $this->validated();
        return Web4JobsPlatformEventDTO::make($data);
    }
}
