<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
            'notes'        => ['string', 'nullable', 'max:255'],
            'is_paid'      => ['boolean', 'nullable'],
            'name'         => ['string', 'nullable', 'max:155'],
            'property_id'  => ['string', 'nullable'],
            'employee_id'  => ['string', 'nullable'],
            'scheduled_at' => ['string', 'nullable'],
            'completed_at' => ['string', 'nullable'],
        ];
    }
}
