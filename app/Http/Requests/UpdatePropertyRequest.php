<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePropertyRequest extends FormRequest
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
            'description' => ['string', 'nullable', 'max:1024'],
            'client_id'   => ['string', 'nullable',],
            'name'        => ['string', 'nullable', 'max:155'],
            'address'     => ['string', 'nullable', 'max:155'],
            'phone'       => ['string', 'nullable', 'max:155'],
        ];
    }
}
