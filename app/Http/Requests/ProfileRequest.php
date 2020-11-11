<?php

namespace eVisual\Http\Requests;

use eVisual\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'nombre' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email',
            ],
            'documento' => [ 
                'required','numeric','digits_between:5,15',
            ],
            'rol' => [
                'required','max:50',
            ],
            'sede' =>[
                'required','max:100'
            ]
        ];
    }
}

