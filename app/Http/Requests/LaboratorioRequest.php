<?php

namespace eVisual\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaboratorioRequest extends FormRequest
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
            //Request de la Orden
            'fechaGenerada'=>['max:100'], //listo  
            'fechaEntrega'=>['max:100'],  //listo  
            'horaEntrega'=>['max:100'], //listo
            'esfera'=>['max:100'],  //listo
            'cilindro'=>['max:100'],//listo
            'eje'=>['max:100'],     //listo
            'adicion'=>['max:100'], //listo
            'dnp'=>['max:100'],     //listo
            'altura'=>['max:100'],  //listo
            'prisma'=>['max:100'],  //listo
            'lente'=>['max:100'],   //listo
            'lab'=>['max:100'],     //listo
            'nro'=>['max:100'],     //listo
            'bisel'=>['max:100'],   //listo
            'lote'=>['max:100'],    //listo
            'esferai'=>['max:100'], //listo
            'cilindroi'=>['max:100'],   //listo
            'ejei'=>['max:100'],    //listo
            'adicioni'=>['max:100'],    //listo
            'dnpi'=>['max:100'],    //listo
            'alturai'=>['max:100'], //listo
            'prismai'=>['max:100'], //listo
            'lentei'=>['max:100'],  //listo
            'labi'=>['max:100'],    //listo
            'nroi'=>['max:100'],    //listo
            'biseli'=>['max:100'],  //listo
            'lotei'=>['max:100'],   //listo
            'tipol'=>['max:100'],   //listo
            'claseProgresivol'=>['max:100'],    //listo
            'invimal'=>['max:100'], //listo
            'tratamientol'=>['max:100'],    //listo
            'colorLtel'=>['max:100'],   //listo
            'materiall'=>['max:100'],   //listo
            'medicol'=>['max:100'], //listo
            'referenciav'=>['max:100'], //listo
            'vrmonturav'=>['max:100'],  //listo
            'vrlentev'=>['max:100'],    //listo
            'totalv'=>['max:100'],  //listo
            'abonoinicialv'=>['max:100'],   //listo
            'saldov'=>['max:100'],  //listo
            'materialv'=>['max:100'],   //listo
            'tipov'=>['max:100'],   //listo
            'colorMontm'=>['max:100'],  //listo
            'horizontalm'=>['max:100'], //listo
            'verticalm'=>['max:100'],   //listo
            'puentem'=>['max:100'], //listo
            'diagonalm'=>['max:100'],   //listo
            'distMecanicam'=>['max:100'],   //listo
            'nroAlmacenm'=>['max:100'], //listo
            'dVerticeODm'=>['max:100'], //listo
            'dVerticeOIm'=>['max:100'], //listo
            'panoramicom'=>['max:100'], //listo
            'pantoscopicom'=>['max:100'],   //listo
            'nroRemisionm'=>['max:100'],    //listo
            'observaciones'=>['max:100'],   //listo
            'usuarioActivo'=>['max:100'],   //listo
            'estadoOrden'=>['max:100'], //listo
            'nroFacturav'=>['max:100'], //listo
            'curvaBase'=>['max:100'], //listo 
            'observacionlab'=>['max:100'], //listo
            'idSO'=>['max:100'],   // 
            'SOmontura'=>['max:100'], //  
            'SOnueva'=>['max:100'],  //
            'SOusada'=>['max:100'],  //  
            'SOref'=>['max:100'], //
            'SOrayada'=>['max:100'],  //
            'SOpelada'=>['max:100'],    //
            'SOotro'=>['max:100'],     //
        ];
    }
}
