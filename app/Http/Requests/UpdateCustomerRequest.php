<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'min:3', 'max:255'],
            'email'     => ['sometimes', 'nullable', 'email', 'unique:customers,email,' . $this->customer->id],
            'phone'     => ['required', 'unique:customers,phone,' . $this->customer->id],
            'address'   => ['sometimes', 'nullable', 'string', 'min:3', 'max:5000'],
            'note'      => ['sometimes', 'nullable', 'string', 'min:3', 'max:5000']
        ];
    }
}
