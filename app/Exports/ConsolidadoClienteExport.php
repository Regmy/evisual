<?php

namespace eVisual\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ConsolidadoClienteExport implements FromView
{

    public $clientes;

    public function __construct($request){

        $this->clientes= $request;
        // carteraExcel();
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function view(): View
    {
        //
        $clientes = $this->clientes;
        
        return view('admin.excel.clientesConsolidado ',[
            'clientes'=>$clientes,
        ]);
        
    }
}