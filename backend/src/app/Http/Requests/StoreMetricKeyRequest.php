<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreMetricKeyRequest extends FormRequest
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
             "name" => "required|string|max:255|unique:metric_keys,name",
             "platform" => "required|int|exists:platforms,id",
             
             "rules" => "required|array",
             "rules.unit" => "required|string|in:per_event,percentage,daily",
             "rules.guid" => "required|array",
             
             "rules.guid.per" => "exclude_unless:rules.unit,percentage|required|integer",
             "rules.guid.give" => "exclude_unless:rules.unit,percentage|required|numeric",
             "rules.guid.amount" => "exclude_if:rules.unit,percentage|required|numeric",
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
             
             "rules.unit.required" => "The unit field is required.",
             "rules.unit.in" => "The unit must be either per_event, percentage, or daily.",
             
             "rules.guid.required" => "The guid object is required.",
             
             "rules.guid.per.required" => "The 'per' field is required when unit is percentage.",
             "rules.guid.per.integer" => "The 'per' field must be an integer.",
             
             "rules.guid.give.required" => "The 'give' field is required when unit is percentage.",
             "rules.guid.give.numeric" => "The 'give' field must be a number.",
             
             "rules.guid.amount.required" => "An amount is required for this unit type.",
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
     }
}
