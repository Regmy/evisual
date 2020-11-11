<?php

namespace eVisual\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CarteraExport implements FromView
{

    public $ordenes;

    public function __construct($request){

        $this->ordenes= $request;
        // carteraExcel();
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function view(): View
    {
        //
        $ordenes = $this->ordenes;

        return view('admin.excel.cartera',[
            'ordenes'=>$ordenes,
        ]);
        
    }
}