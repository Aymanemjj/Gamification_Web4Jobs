<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UpdateMetricKeyRequest extends FormRequest
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
         // Fetch the ID of the model being updated from the route parameter
         // e.g., if your route is /api/metric-keys/{metric_key}
         $metricKeyId = $this->route('metric_key'); 
     
         return [
             // 1. Ignore the current record ID during unique check
             "name" => [
                 "sometimes",
                 "required",
                 "string",
                 "max:255",
                 Rule::unique('metric_keys', 'name')->ignore($metricKeyId),
             ],
             
             "platform" => "sometimes|required|int|exists:platforms,id",
             "rules" => "sometimes|required|array",
             
             // 2. These nested fields should execute conditionally if 'rules' is present
             "rules.unit" => "required_with:rules|string|in:per_event,percentage,daily",
             "rules.guid" => "required_with:rules|array",
             
             // 3. Keep the conditional structures mapping perfectly
             "rules.guid.per" => "exclude_unless:rules.unit,percentage|required_with:rules.guid|integer",
             "rules.guid.give" => "exclude_unless:rules.unit,percentage|required_with:rules.guid|numeric",
             "rules.guid.amount" => "exclude_if:rules.unit,percentage|required_with:rules.guid|numeric",
         ];
     }


     public function messages(): array
     {
         return [
             "name.required" => "The name field is required.",
             "name.string" => "The name must be a string.",
             "name.max" => "The name may not be greater than 255 characters.",
             "name.unique" => "This name has already been taken.",
             
             "platform.required" => "The platform is required.",
             "platform.int" => "The platform ID must be an integer.",
             "platform.exists" => "The selected platform is invalid.",
             
             "rules.required" => "The rules object is required.",
             "rules.array" => "The rules must be a valid structure.",
             
             "rules.unit.required" => "The unit field is required when rules are provided.",
             "rules.unit.in" => "The unit must be either per_event, percentage, or daily.",
             
             "rules.guid.required" => "The guid object is required when rules are provided.",
             
             "rules.guid.per.required_with" => "The 'per' field is required when unit is percentage.",
             "rules.guid.per.integer" => "The 'per' field must be an integer.",
             
             "rules.guid.give.required_with" => "The 'give' field is required when unit is percentage.",
             "rules.guid.give.numeric" => "The 'give' field must be a number.",
             
             "rules.guid.amount.required_with" => "An amount is required for this unit type.",
             "rules.guid.amount.numeric" => "The amount must be a number.",
         ];
     }


     public function failedValidation(Validator $validator)
     {
         $errors = $validator->errors();
         $response = response()->json([
             'message' => 'Invalid data send',
             'details' => $errors->messages(),
         ], 422);
 
         throw new HttpResponseException($response);
     }}
