<?php

namespace App\Http\Requests\EventRequests;

use App\DTOs\SourcesEvents\InsertionPlatformEventDTO;
use App\Interfaces\SourceBatchEventRequestInterface;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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

        return [
            "source" => "required|string|in:insertion_platform",
            "events" => "required|array|min:1",
            
            "events.*.source" => "required|string|in:insertion_platform",
            "events.*.event_type" => [
                "required",
                "string",
                "max:255",
                Rule::exists("event_types", "type")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ],
            "events.*.learner_email" => [
                "required",
                "email",
                "max:255",
                Rule::exists("users", "email"),
            ],
            "events.*.external_user_id" => [
                "required",
                "string",
                "max:255",
                Rule::exists("user_platform_accounts", "external_id")->where(
                    "platform_id",
                    $platform?->id,
                ),
            ],
            "events.*.metric_key" => "required|string|max:255|exists:metric_keys,name",
            "events.*.value" => "required|numeric",
            "events.*.previous_value" => "nullable|numeric",
            "events.*.entity_type" => "required|string|max:255",
            "events.*.entity_id" => "required|string|max:255",
            "events.*.happened_at" => "required|date_format:Y-m-d\TH:i:s\Z",
            "events.*.dedupe_key" => "required|string|max:500|unique:events,dedupe_key",
            "events.*.metadata" => "array",
        ];
    }

    public function messages(): array
    {
        return [
            "source.required" => "Top-level event source is required.",
            "source.in" => "Invalid top-level event source.",
            "events.required" => "The events batch array is required.",
            
            "events.*.source.required" => "Event source is required.",
            "events.*.source.in" => "Invalid event source.",
            "events.*.event_type.required" => "Event type is required.",
            "events.*.external_user_id.required" => "External user ID is required.",
            "events.*.learner_email.required" => "User email is required.",
            "events.*.learner_email.email" => "User email must be a valid email address.",
            "events.*.metric_key.required" => "Metric key is required.",
            "events.*.value.required" => "Value is required.",
            "events.*.value.numeric" => "Value must be a number.",
            "events.*.previous_value.numeric" => "Previous value must be a number.",
            "events.*.entity_type.required" => "Entity type is required.",
            "events.*.entity_id.required" => "Entity ID is required.",
            "events.*.happened_at.required" => "Event timestamp is required.",
            "events.*.happened_at.date_format" => "Timestamp must be ISO 8601 format (e.g. 2026-05-21T14:30:00Z).",
            "events.*.dedupe_key.required" => "Dedupe key is required.",
            "events.*.dedupe_key.unique" => "One or more events in this batch are duplicates.",
            "events.*.metadata.array" => "Metadata must be an object.",
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
        $validatedData = $this->validated();
        
        // Extract the nested events array from the validated output
        $events = $validatedData['events'] ?? [];

        // If your DTO supports a native collection handler:
        return InsertionPlatformEventDTO::collection($events);

        // NOTE: If InsertionPlatformEventDTO::collection() errors out, map it manually like this:
        // return array_map(fn($item) => InsertionPlatformEventDTO::make($item), $events);
    }
}