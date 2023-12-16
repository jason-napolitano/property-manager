<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'description' => ['string', 'nullable', 'max:255'],
            'category_id' => ['string', 'required'],
            'exemptable'  => ['boolean', 'nullable'],
            'price'       => ['integer', 'required'],
            'name'        => ['string', 'required', 'max:155'],
        ];
    }
}
