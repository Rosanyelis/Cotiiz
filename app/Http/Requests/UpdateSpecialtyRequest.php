<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecialtyRequest extends FormRequest
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
            'name' => 'required | unique:App\Models\Specialty,name,' . $this->specialty->id
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo especialidad es obligatorio.',
            'name.unique' => 'La especialidad ya existe.',
        ];
    }
}
