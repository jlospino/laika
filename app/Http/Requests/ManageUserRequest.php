<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:user',
            'document' => 'required|numeric|unique:user',
            'document_type_id' => 'required|numeric',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(){
        return [
            'name' => 'Nombre',
            'address' => 'Dirección',
            'email' => 'Correo Electrónico',
            'document' => 'Número De Documento',
            'document_type_id' => 'Tipo De Documento',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Debe asignar un nombre al usuario',
            'address.required' => 'Debe asignar una dirección al usuario',
            'email.required' => 'Debe asignar un correo electrónico al usuario',
            'email.unique' => 'El correo electrónico ingresado ya se encuentra registrado',
            'document.required' => 'Debe asignar un número de documento al usuario',
            'document.unique' => 'El número de documento ya se encuentra registrado',
            'document.numeric' => 'El número de documento ingresado no es un valido',
            'document_type_id.required' => 'Debe seleccionar un tipo de documento',
        ];
    }
}
