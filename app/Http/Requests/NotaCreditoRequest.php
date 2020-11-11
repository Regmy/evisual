<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaCreditoRequest extends FormRequest
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
            'nota1'=>['required','max:100'], //
            'nota2'=>['required','max:15'], //
            'nota3'=>['required','max:15'], //
            'nota4'=>['required','max:15'], //
            'notaTexto'=>['required','max:15'], //
            ];
    }
}
