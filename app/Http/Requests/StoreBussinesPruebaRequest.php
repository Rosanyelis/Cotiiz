<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBussinesPruebaRequest extends FormRequest
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
            'firstname'             => ['required'],
            'lastname'              => ['required'],
            'phone'                 => ['required'],
            'file_gafete'           => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'file_gafete2'          => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'file_credential'       => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'file_credential2'      => ['required', 'mimes:png,jpg,jpeg', 'max:2048'],
            'workstation'           => ['required'],
            'area_work'             => ['required'],
            'phone'                 => ['required'],
            'phone_personal'        => ['required'],
            'country'               => ['required'],
            'state'                 => ['required'],
            'municipality'          => ['required'],
            'colony'                => ['required'],
            'street'                => ['required'],
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'              => ['required'],
        ];
    }

    public function messages()  {
        return [
            '*.required' => 'El campo es obligatorio',
            '*.string' => 'El campo debe ser un texto',
            '*.email' => 'El campo debe ser un email',
            '*.exists' => 'El campo no existe',
            '*.unique' => 'El campo ya existe',
            '*.max' => 'El campo es demasiado extenso',
        ];
    }
}
