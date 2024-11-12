<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBussinesRequestRequest extends FormRequest
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
            'rfc_suppliers_id' => 'required',
            'type' => 'required',
            'file' => 'mime:pdf|max:2048',
            'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rfc_suppliers_id.required' => 'El RFC es requerido',
            'type.required' => 'El Titulo de Solicitud es requerido',
            'file.mime' => 'El archivo debe ser PDF',
            'file.max' => 'El archivo no debe ser mayor a 2 MB',
            'message.required' => 'El mensaje es requerido',
        ];
    }
}
