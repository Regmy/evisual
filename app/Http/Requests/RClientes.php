<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RClientes extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>['required','max:50'], //Nombre
            'documento'=>['max:100'], //Documento
            'celular'=>['max:100'], //Celular
            'telefono'=>['max:100'], //Telefono
            'cumpleanos'=>['max:100'], //Cumpleaños
            'correo'=>['max:100'], //Correo
            'direccion'=>['max:100'], //Direccion
            'municipio'=>['max:100'], //Municipio
            'observaciones'=>['max:50'], //Observaciones
            'fechaCreacion'=>['max:100'], //fecha de creacion
            'sede'=>['max:100'], //Sede
            'tipoDocumento'=>['max:100'], //Tipo de documento
            ];
    }
}
