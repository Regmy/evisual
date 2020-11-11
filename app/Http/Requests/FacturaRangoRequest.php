<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaRangoRequest extends FormRequest
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
            //
            'sede'=>'required', //
            'inicio'=>'', //
            'fin'=>'', //
            'texto'=>'', //
            'prefijo'=>'', //
            'resolucion'=>'', //
            'iva'=>'required | numeric | between:0,80', //
            'rangoInicio'=>'', //
            'rangoFin'=>'', //
            'imagenLogo'=>'', //
            'imagenDatos'=>'', //
            'textoDevolucion'=>'', //
            'textoHorarios'=>'', //
        ];
    }

    public function messages(){
        return [
            'iva.required' => 'El campo "IVA" es obligatorio, usar "0" (cero) en caso de No aplicar IVA en esta sede.'
        ];
    }

}
