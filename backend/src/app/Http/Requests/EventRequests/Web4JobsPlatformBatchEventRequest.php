<?php

namespace App\Http\Requests\EventRequests;

use App\Interfaces\SourceBatchEventRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class Web4JobsPlatformBatchEventRequest extends FormRequest implements
    SourceBatchEventRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
                //
            ];
    }

    #[Override]
    public function toDTOCollection(): array
    {
        throw new \Exception("Not implemented");
    }
}
