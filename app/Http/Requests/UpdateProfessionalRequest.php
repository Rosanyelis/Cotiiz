<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessionalRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'occupation_id' => ['required', 'integer', 'exists:occupations,id'],
            'specialty_id' => ['required', 'integer', 'exists:specialties,id'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'file_title_trainee_1' => ['required', 'max:2048'],
            'file_title_trainee_2' => ['required', 'max:2048'],
            'file_voter_idcard_1' => ['required', 'max:2048'],
            'file_voter_idcard_2' => ['required', 'max:2048'],
            'file_cv' => ['required', 'mimes:pdf', 'max:2048'],
        ];
    }

    public function messages(): array
    {
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
