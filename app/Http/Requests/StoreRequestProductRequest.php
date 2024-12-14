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
    public function rules(): array
    {
        return [
            'type'          => 'required',
            'product_name'  => 'required',
            'model'         => 'required',
            'brand'         => 'required',
            'quantity'      => 'required',
            'budget'        => 'required',
            'urgency'       => 'required',
            'description'   => 'required',
            'link_drive'    => 'required',
            'file' => 'nullable|mimes:pdf|max:2048',
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
