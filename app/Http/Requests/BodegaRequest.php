<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BodegaRequest extends FormRequest
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
            'cantidad'=>'required|max:50', //
            'bodega'=>'required', //
            'referencia'=>'required', //
            'codigo'=>'required', //
            'grupoFamilia'=>'required', //
            'marca'=>'required', //
            'manifiesto'=>'required', //
            'costo'=>'required', //
            'precio'=>'required', //
            'tipo'=>'required', //
            'material'=>'required', //
            'unidadMedida'=>'required', //
            'invima'=>'required', //
            'lote'=>'required', //
            'color'=>'required', //
        ];
    }

}
