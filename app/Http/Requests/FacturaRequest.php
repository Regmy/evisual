<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaRequest extends FormRequest
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
            'idCliente'=>'required|max:50', //
            'idOrden'=>'required', //
            'nFactura'=>'required', //
            'fechaFactura'=>'required', //
            'formaPago'=>'max:15', //
            'fechaVencimiento'=>'required', //
            'valorTotalOI'=>'required', //
            'valorTotalOD'=>'required', //
            'monturaIva'=>'required', //
            'monturaValorGrabado'=>'required', //
            'monturaValorTotal'=>'required', //
            'subtotal'=>'required', //
            'iva'=>'required', //
            'total'=>'required', //
            'notaCredito'=>'', //
        ];
    }

}
