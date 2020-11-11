<?php

namespace eVisual\Http\Controllers;

use Illuminate\Http\Request;
use eVisual\MClientes;
use eVisual\MAbonos;
use eVisual\MOrdenDetalles;
use Illuminate\Support\Facades\Redirect;
use eVisual\Http\Requests\AbonoRequest;
use DB;

class AbonoController extends Controller
{
     function index(Request $request, MOrdenDetalles $orden)
    {        
        $buscar=trim($request->get('searchText'));
        $cliente = MClientes::find($orden->cliente_id);
        $abonos = DB::table('abonos')->where('orden_id',$orden->id) //Cambiar a Eloquent
        ->orderBy('fecha','desc')->paginate(15);   
        $usuario = $orden->usuario;        
        $acumulado = 0;
        foreach ($abonos as $abono) {
        $acumulado += $abono->valor;    
        }        
        $acumulado += (int)$orden->dato37;
        $saldo = (int)$orden->dato36 - $acumulado;

        return view('clientes.abonos',compact('cliente'),
        ["orden" => $orden,
        "searchText" => $buscar,
        "abonos" => $abonos,
        "cliete" => $cliente,
        "saldo" => $saldo,
        "usuario" => $usuario,
        ]);        
    }

     function create(MOrdenDetalles $orden)
    {    
        $cliente = MClientes::find($orden->cliente_id);

        return view("clientes.abonoadd",["orden" => $orden, "cliente" => $cliente]);
    }

     function store(AbonoRequest $request)
    {
        $abono=new MAbonos();
        $abono->orden_id=$request->input('idOrden');
        $abono->valor=trim($request->input('abono'));
        $abono->fecha=date("y-m-d");
        $abono->tipo_pago=trim($request->input('formaPago'));
        $abono->save();
       
        return redirect()->route('abono.index', $abono->orden_id)->withStatus(__('Abono Agregado Sastifactoriamente.'));
    }

     function update(MAbonos $abono, AbonoRequest $request)
    { 
        $abono->orden_id=$request->input('idOrden');
        $abono->valor=trim($request->input('abono'));
        $abono->fecha=date("y-m-d");
        $abono->tipo_pago=trim($request->input('formaPago'));
        $abono->update();

        return redirect()->route('abono.index', $abono->orden_id)->withStatus(__('Abono Actualizado Sastifactoriamente.'));
    }
}
