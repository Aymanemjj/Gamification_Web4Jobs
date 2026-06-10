<?php

namespace App\Http\Requests\EventRequests;

use App\Interfaces\SourceEventDTOInterface;
use App\Interfaces\SourceSingleEventRequestInterface;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ManualContributionSingleEventRequest extends FormRequest implements
    SourceSingleEventRequestInterface
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
    public function toDTO(): SourceEventDTOInterface
    {
        throw new \Exception("Not implemented");
    }
}
