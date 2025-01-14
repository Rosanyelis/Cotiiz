<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRfcBussinesRequest extends FormRequest
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
            'name'              => ['required', 'string'],
            'email'             => ['required', 'email'],
            'firstname'         => ['required', 'string'],
            'second_name'       => ['required', 'string'],
            'lastname'          => ['required', 'string'],
            'second_lastname'   => ['required', 'string'],
            'phone'             => ['required', 'string'],
            'street'            => ['required', 'string'],
            'area_work'         => ['required', 'string'],
            'workstation'       => ['required', 'string'],
            'colony'            => ['required', 'string'],
            'municipality'      => ['required', 'string'],
            'state'             => ['required', 'string'],
            'country'           => ['required', 'string'],
            'file_gafete'       => ['nullable', 'file'],
            'file_gafete2'      => ['nullable', 'file'],
            'file_credential'   => ['nullable', 'file'],
            'file_credential2'  => ['nullable', 'file'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'              => 'El campo es requerido.',
            'email.required'             => 'El campo es requerido.',
            'firstname.required'         => 'El campo es requerido.',
            'second_name.required'       => 'El campo es requerido.',
            'lastname.required'          => 'El campo es requerido.',
            'second_lastname.required'   => 'El campo es requerido.',
            'phone.required'             => 'El campo es requerido.',
            'street.required'            => 'El campo es requerido.',
            'area_work.required'         => 'El campo es requerido.',
            'workstation.required'       => 'El campo es requerido.',
            'colony.required'            => 'El campo es requerido.',
            'municipality.required'      => 'El campo es requerido.',
            'state.required'             => 'El campo es requerido.',
            'country.required'           => 'El campo es requerido.',
            'file_gafete.required'       => 'El campo es requerido.',
            'file_gafete2.required'      => 'El campo es requerido.',
            'file_credential.required'   => 'El campo es requerido.',
            'file_credential2.required'  => 'El campo es requerido.',
        ];
    }
}
