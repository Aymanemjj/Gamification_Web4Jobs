<?php

namespace App\Http\Requests\EventTypeRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $eventType = $this->route("event_type");

        return [
            "type" => [
                "sometimes",
                "required",
                "string",
                "max:255",
                Rule::unique("event_types", "type")
                    ->where(
                        "platform_id",
                        $this->input("platform_id", $eventType?->platform_id),
                    )
                    ->ignore($eventType?->id),
            ],
            "platform_id" => "sometimes|required|integer|exists:platforms,id",
        ];
    }

    public function messages(): array
    {
        return [
            "type.required" => "Event type is required.",
            "type.unique" =>
                "This event type already exists for the selected platform.",
            "platform_id.required" => "Platform is required.",
            "platform_id.exists" => "The selected platform does not exist.",
        ];
    }
}