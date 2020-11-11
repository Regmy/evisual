<?php

namespace eVisual\Custom;

use eVisual\MOrdenParametros;

class GenericQuerys {

    function seleccionables() {

        $data = (object) [    
            'medicol' => MOrdenParametros::where( 'campo', 'medico' )->get(),
            'esfera' => MOrdenParametros::where( 'campo', 'formula_OD_esfera' )->get(),
            'cilindro' => MOrdenParametros::where( 'campo', 'formula_OD_cilindro' )->get(),
            'adicion' => MOrdenParametros::where( 'campo', 'formula_OD_adicion' )->get(),
            'lente' => MOrdenParametros::where( 'campo', 'formula_OD_lente' )->get(),
            'lab' => MOrdenParametros::where( 'campo', 'formula_OI_lab' )->get(),   
            'bisel' => MOrdenParametros::where( 'campo', 'formula_OI_bisel' )->get(),
            'tipol' => MOrdenParametros::where( 'campo', 'lente_tipo' )->get(),  
            'tratamientol' => MOrdenParametros::where( 'campo', 'lente_tratamiento' )->get(),
            'claseProgresivol' => MOrdenParametros::where( 'campo', 'lente_clase_de_progresivo' )->get(),
            'colorLtel' => MOrdenParametros::where( 'campo', 'color_lte' )->get(),
            'materiall' => MOrdenParametros::where( 'campo', 'lente_material' )->get(),
            'colorMontm' => MOrdenParametros::where( 'campo', 'color_mont' )->get(),
        ];
        return $data;           
    }
}