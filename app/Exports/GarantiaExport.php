<?php

namespace eVisual\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GarantiaExport implements FromView
{

    public $garantias;

    public function __construct($request){

        $this->garantias= $request;
        // carteraExcel();
    }

    /**
    * @return \Illuminate\Database\Query\Builder
    */
    public function view(): View
    {
        //
        $garantias = $this->garantias;    
        $total['total']=0;
        $total['abono']=0;
        $total['saldo']=0;
        $total['montura']=0;
        $total['lente']=0; 
        
        return view('admin.excel.garantias',[
            'garantias'=>$garantias,
            'total'=>$total,
        ]);
        
    }
}