<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacturaItemRequest extends FormRequest
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
            'idOrden'=>['required','max:50'], //
            'producto'=>['required','max:100'], //
            'descripcion'=>['max:100'], //
            'cantidad'=>['max:100'], //
            'valor_unitario'=>['max:100'], //
            'iva'=>['max:100'], //
            'idCliente'=>['max:100'], //
            ];
    }
}
