<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestProductRequest extends FormRequest
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
    public function rules()
    {
        return [
            'type' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'budget' => 'required|numeric|min:0',
            'urgency' => 'required|string|in:Normal,Urgente',
            'description' => 'nullable|string|max:1000',
            'link_drive' => 'nullable|url|max:255',
            'file' => 'nullable|mimes:pdf|max:2048', // Valida que sea un archivo PDF y máximo de 2MB
        ];
    }


    public function messages()
    {
        return [
            'type.required' => 'El titulo de solicitud es requerido.',
            'product_name.required' => 'El nombre del producto es requerido.',
            'model.required' => 'El modelo es requerido.',
            'brand.required' => 'La marca es requerida.',
            'quantity.required' => 'La cantidad es requerida.',
            'budget.required' => 'El presupuesto es requerido.',
            'urgency.required' => 'La urgencia es requerida.',
            'description.required' => 'La descripción es requerida.',
            'link_drive.required' => 'El link es requerido.',
            'file.mimes' => 'El archivo debe ser PDF.',
            'file.max' => 'El archivo no debe ser mayor a 2 MB',
        ];
    }
}
