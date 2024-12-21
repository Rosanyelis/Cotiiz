<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreBussinesRequest extends FormRequest
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
            'name_fantasy'           => ['required'],
            'number_plant'          => ['required'],
            'file_positive_opinion' => ['required', 'mimes:pdf', 'max:2048'],
            'file_bank_information' => ['required', 'mimes:pdf', 'max:2048'],
            'file_fiscal_constancy'  => ['required', 'mimes:pdf', 'max:2048'],
            'file_fiscal_address'    => ['required', 'mimes:pdf', 'max:2048'],
            'phone'                  => ['required'],
            'main_activity'          => ['required'],
            'country'                => ['required'],
            'state'                  => ['required'],
            'municipality'           => ['required'],
            'colony'                => ['required'],
            'street'                 => ['required'],
            'street_number'          => ['required'],
            'postal_code'           => ['required'],
            'name'                      => ['required'],
            'email' => ['required', 'lowercase', 'email'],
            'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name_fantasy.required' => 'El campo es obligatorio',
            'number_plant.required' => 'El campo es obligatorio',
            'file_positive_opinion.required' => 'El campo es obligatorio',
            'file_positive_opinion.mimes' => 'El archivo debe ser PDF',
            'file_positive_opinion.max' => 'El archivo no debe ser mayor a 2MB',
            'file_bank_information.required' => 'El campo es obligatorio',
            'file_bank_information.mimes' => 'El archivo debe ser PDF',
            'file_bank_information.max' => 'El archivo no debe ser mayor a 2MB',
            'file_fiscal_constancy.required' => 'El campo es obligatorio',
            'file_fiscal_constancy.mimes' => 'El archivo debe ser PDF',
            'file_fiscal_constancy.max' => 'El archivo no debe ser mayor a 2MB',
            'file_fiscal_address.required' => 'El campo es obligatorio',
            'file_fiscal_address.mimes' => 'El archivo debe ser PDF',
            'file_fiscal_address.max' => 'El archivo no debe ser mayor a 2MB',
            'phone.required' => 'El campo es obligatorio',
            'main_activity.required' => 'El campo es obligatorio',
            'country.required' => 'El campo es obligatorio',
            'state.required' => 'El campo es obligatorio',
            'municipality.required' => 'El campo es obligatorio',
            'colony.required' => 'El campo es obligatorio',
            'street.required' => 'El campo es obligatorio',
            'street_number.required' => 'El campo es obligatorio',
            'postal_code.required' => 'El campo es obligatorio',
            'name.required' => 'El campo es obligatorio',
            'email.required' => 'El campo es obligatorio',
            'password.required' => 'El campo es obligatorio',
        ];
    }
}
