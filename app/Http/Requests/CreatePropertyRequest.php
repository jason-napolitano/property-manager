<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePropertyRequest extends FormRequest
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
            'description' => ['string', 'required', 'max:1024'],
            'client_id'   => ['string', 'required',],
            'name'        => ['string', 'required', 'max:155'],
            'address'     => ['string', 'required', 'max:155'],
            'phone'       => ['string', 'required', 'max:155'],
        ];
    }
}
