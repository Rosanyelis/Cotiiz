<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestProfessionalRequest extends FormRequest
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
            'activity_name'         => 'required',
            'description'           => 'required',
            'requirements'          => 'required',
            'certifications'        => 'required',
            'details_especialties'  => 'required',
            'time'                  => 'required',
            'urgency'               => 'required',
            'link_drive'            => 'required',
            'file'                  => 'nullable|mimes:pdf|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'type.required'         => 'El titulo de solicitud es requerido.',
            'activity_name.required' => 'El nombre de la actividad es requerido.',
            'description.required'  => 'La Descripción del servicio es requerido.',
            'requirements.required' => 'Los requisitos son requeridos.',
            'certifications.required' => 'Las certificaciones son requeridas.',
            'details_especialties.required' => 'Los detalles de las especialidades son requeridos.',
            'time.required'         => 'El tiempo es requerido.',
            'urgency.required'      => 'La urgencia es requerida.',
            'link_drive.required'   => 'El link es requerido.',
            'file.mimes'            => 'El archivo debe ser PDF.',
            'file.max'              => 'El archivo no debe ser mayor a 2 MB',
        ];
    }
}
