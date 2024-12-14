<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestServiceRequest extends FormRequest
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
            'type'                  => 'required',
            'service_name'          => 'required',
            'description'           => 'required',
            'budget'                => 'required',
            'urgency'               => 'required',
            'description_problem'   => 'required',
            'link_drive'            => 'required',
            'file'                  => 'nullable|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'type.required'         => 'El titulo de solicitud es requerido.',
            'service_name.required' => 'El tipo de servicio es requerido.',
            'description.required'  => 'La Descripción del servicio es requerido.',
            'budget.required'       => 'El presupuesto es requerido.',
            'urgency.required'      => 'La urgencia es requerida.',
            'description_problem.required'  => 'La  de problematica es requerida.',
            'link_drive.required'   => 'El link es requerido.',
            'file.mimes'            => 'El archivo debe ser PDF.',
            'file.max'              => 'El archivo no debe ser mayor a 2 MB',
        ];
    }
}
