<?php

namespace eVisual\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TotalMesExport implements FromView
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
        $total['total']=0;
        $total['abono']=0;
        $total['saldo']=0;
        $total['montura']=0;
        $total['lente']=0; 
        
        return view('admin.excel.totalMes',[
            'ordenes'=>$ordenes,
            'total'=>$total,
        ]);
        
    }
}