<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'price.required' => 'El precio es requerido',
            'description.required' => 'La descripción es requerida',
            'photo.max' => 'La imagen no debe ser mayor a 2 MB',
            'photo.image' => 'La imagen debe ser una imagen',
        ];
    }
}
