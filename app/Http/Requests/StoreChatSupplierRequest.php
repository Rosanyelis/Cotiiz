<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatSupplierRequest extends FormRequest
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
            'message' => 'required|string|max:1000',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Máximo 2 MB y tipos de archivo válidos
            'rfc_suppliers_id' => 'required|exists:rfc_suppliers,id', // Validación para el proveedor
        ];
    }

    public function messages()
    {
        return [
            'message.required' => 'El mensaje es obligatorio.',
            'message.string' => 'El mensaje debe ser texto válido.',
            'message.max' => 'El mensaje no debe exceder los 1000 caracteres.',
            'file.file' => 'El archivo debe ser válido.',
            'file.mimes' => 'El archivo debe ser de tipo: jpeg, png, jpg, gif o pdf.',
            'file.max' => 'El archivo no debe exceder los 2 MB.',
            'rfc_suppliers_id.required' => 'Debe seleccionar un proveedor.',
            'rfc_suppliers_id.exists' => 'El proveedor seleccionado no es válido.',
        ];
    }
}
