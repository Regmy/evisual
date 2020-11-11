@php
    ini_set('max_execution_time',720);
@endphp
@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'orden'
])

<style>
.general{
    background-color: rgba(232, 255, 234, 0.33);
}
.cliente{
    background-color: rgba(255, 236, 236, 0.33);
}
.formula1{
    background-color: rgba(255, 228, 193, 0.33);
}
.formula2{
    background-color: rgba(255, 243, 155, 0.33);
}
.lente{
    background-color: rgba(243, 255, 175, 0.33);
}
.montura{
    background-color: rgba(195, 255, 175, 0.33);
}
.medidas{
    background-color: rgba(175, 255, 233, 0.33);
}
.observaciones{
    background-color: rgba(175, 225, 255, 0.33);
}
</style>

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <form method="POST" action="{{ route('admin.informeFiltro') }}" autocomplete="off"> 
                    <input type="hidden" name="_method" value="GET">                               
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">        
                    <input type="hidden" name="excelCheck" id="excelCheck" value="0">        
                    <div class="card shadow">                      
                        <div class="card-header">
                            <div class="row">
                                <div class="col-2">
                                    <h5 class="title">{{ __('Filtros') }}</h5>
                                </div>
                                <div class="col">                                    
                                    {{-- <a href="{{ route('admin.filtroExcel')}}" class="btn btn-sm btn-primary">{{ __('Exportar a Excel') }}</a>                                                         --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row ">                                
                                <div class="col" style="background-color: " >
                                    <label for=""><b>{{__('Por Fecha de Pedido: ')}}</b></label>
                                    <br>
                                    <div style="background-color: #fff4b955">
                                        <label for=""><b>{{__('Fecha Inicio: ')}}</b></label>                                                                                            
                                        <input type="date" style="width: 7.3rem;" name="fechaInicioPedido" value="{{$request->fechaInicioPedido}}">
                                        <label for=""><b>{{__('Fecha Fin: ')}}</b></label>                                                                                            
                                        <input type="date" style="width: 7.3rem;" name="fechaFinPedido" value="{{$request->fechaFinPedido}}">
                                    </div>
                                </div>                                
                                <div class="col" style="">
                                    <label for=""><b>{{__('Por Fecha de Entrega: ')}}</b></label>
                                    <br>
                                    <div style="background-color: #ffe96b55">
                                        <label for=""><b>{{__('Fecha Inicio: ')}}</b></label>                                                                                            
                                        <input type="date" style="width: 7.3rem;" name="fechaInicioEntrega" style="" value="{{$request->fechaInicioEntrega}}">
                                        <label for=""><b>{{__('Fecha Fin: ')}}</b></label>                                                                                            
                                        <input type="date" style="width: 7.3rem;" name="fechaFinEntrega" value="{{$request->fechaFinEntrega}}">                   
                                    </div>
                                </div> 
                            </div>
                            <label for=""><b>{{__('General: ')}}</b></label>
                            <br>
                            <div class="row">
                                <div class="col" style="">
                                    <select class="form-control" type="text" name="estado" style="background-color: #c5f5bc55">
                                        <option value="">{{__('Estado (Todos)')}}</option>                                                                                
                                        <option value="CUARENTENA" @if("CUARENTENA" == $request->estado) selected @endif>{{__('CUARENTENA')}}</option>                                                                                
                                        <option value="SEPARADO" @if("SEPARADO" == $request->estado) selected @endif>{{__('SEPARADO')}}</option>                                                                                
                                        <option value="PEDIDO_LABORATORIO" @if("PEDIDO_LABORATORIO" == $request->estado) selected @endif>{{__('PEDIDO LABORATORIO')}}</option>                                                                                
                                        <option value="CORTE Y DISENO" @if("CORTE Y DISENO" == $request->estado) selected @endif>{{__('CORTE Y DISEÑO')}}</option>                                                                                
                                        <option value="PRODUCTO TERMINADO" @if("PRODUCTO TERMINADO" == $request->estado) selected @endif>{{__('PRODUCTO TERMINADO')}}</option>                                                                                
                                        <option value="TRABAJO ENTREGA" @if("TRABAJO ENTREGA" == $request->estado) selected @endif>{{__('TRABAJO ENTREGA')}}</option>                                                                                
                                    </select>
                                </div>
                                <div class="col" style="">
                                    <select class="form-control" type="text" name="usuario" style="background-color: #F9E8BB55">
                                        <option value="">{{__('Usuarios (Todos)')}}</option>
                                        @foreach ($usuarios as $parametro)
                                            <option value="{{$parametro->nombre}}" @if($parametro->nombre == $request->usuario) selected @endif>{{$parametro->nombre}}{{__(' - ')}}{{$parametro->sede->sede}}</option>                                                    
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style="">
                                    <select class="form-control" type="text" name="sede" style="background-color: #CADFFF55">
                                        <option value="">{{__('Sede (Todos)')}}</option>
                                        @foreach ($sedes as $parametro)
                                            @if ($parametro->sede != "")                                            
                                            <option value="{{$parametro->sede}}" @if($parametro->sede == $request->sede) selected @endif>{{$parametro->sede}}</option>                                                    
                                            @endif
                                        @endforeach                                               
                                    </select>
                                </div>
                            </div>
                            <label for=""><b>{{__('Por Fórmulas: OD ')}}</b></label>
                                <br>
                            <div class="row">                            
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="esferaOD">
                                        <option value="">{{__('Esfera (Todos)')}}</option>
                                        @foreach ($seleccionables->esfera as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->esferaOD) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="cilindroOD">
                                        <option value="">{{__('Cilindro (Todos)')}}</option>
                                        @foreach ($seleccionables->cilindro as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->cilindroOD) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="adicionOD">
                                        <option value="">{{__('Adicion (Todos)')}}</option>
                                        @foreach ($seleccionables->adicion as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->adicionOD) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="lenteOD">
                                        <option value="">{{__('Lente (Todos)')}}</option>
                                        @foreach ($seleccionables->lente as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->lenteOD) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="biselOD">
                                        <option value="">{{__('Bisel (Todos)')}}</option>
                                        @foreach ($seleccionables->bisel as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->biselOD) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                            </div>
                            <label for=""><b>{{__('Por Fórmulas: OI ')}}</b></label>
                                <br>
                            <div class="row">                            
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="esferaOI">
                                        <option value="">{{__('Esfera (Todos)')}}</option>
                                        @foreach ($seleccionables->esfera as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->esferaOI) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="cilindroOI">
                                        <option value="">{{__('Cilindro (Todos)')}}</option>
                                        @foreach ($seleccionables->cilindro as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->cilindroOI) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="adicionOI">
                                        <option value="">{{__('Adicion (Todos)')}}</option>
                                        @foreach ($seleccionables->adicion as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->adicionOI) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="lenteOI">
                                        <option value="">{{__('Lente (Todos)')}}</option>
                                        @foreach ($seleccionables->lente as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->lenteOI) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col" style=""> 
                                    <select class="form-control" type="text" name="biselOI">
                                        <option value="">{{__('Bisel (Todos)')}}</option>
                                        @foreach ($seleccionables->bisel as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->biselOI) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                            </div>
                            <label for=""><b>{{__('Por Lentes: ')}}</b></label>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control" type="text" name="tipol">
                                        <option value="">{{__('Tipo (Todos)')}}</option>
                                        @foreach ($seleccionables->tipol as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->tipol) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" type="text" name="claseProgresivol">
                                        <option value="">{{__('Clase de Progresivo (Todos)')}}</option>
                                        @foreach ($seleccionables->claseProgresivol as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->claseProgresivol) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" type="text" name="tratamientol">
                                        <option value="">{{__('Tratamiento (Todos)')}}</option>
                                        @foreach ($seleccionables->tratamientol as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->tratamientol) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control" type="text" name="colorLtel">
                                        <option value="">{{__('Color LTE (Todos)')}}</option>
                                        @foreach ($seleccionables->colorLtel as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->colorLtel) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-2">    
                                <div class="col-3">
                                    <select class="form-control" type="text" name="materiall">
                                        <option value="">{{__('Material (Todos)')}}</option>
                                        @foreach ($seleccionables->materiall as $parametro)                                          
                                            <option value="{{$parametro['option_value']}}" @if($parametro['option_value'] == $request->materiall) selected @endif>{{$parametro['option_value']}}</option>
                                        @endforeach                                               
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col">
                                    <label><b>{{__('Total Registros Filtrados: ')}}{{ $cantidadFiltrados}}</b></label>
                                </div>
                            </div>    
                            <div class="row pt-1">
                                <div class="col">
                                    <button type="submit" class="btn btn-success mt-4" onclick="exportExcelOff()">{{ __('Filtrar') }}</button>
                                    <button type="submit" class="btn btn-success mt-4" onclick="exportExcelOn()">{{ __('Exportar a Excel') }}</button>
                                </div>
                            </div>                    
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-12">
                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>        
                {{--Tabla Filtrados  --}}
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h6 class="mb-0">{{ __('Ordenes Filtradas:') }}</h6>
                                <br>
                            </div>
                        </div>
                    </div>                                                
                    <div class="table-responsive">
                        <table class="table align-items-center table-striped">{{-- table-flush --}}
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Eliminar') }}</th>
                                    <th scope="col">{{ __('Nro.') }}<br>{{ __('Pedido') }}</th>
                                    <th scope="col" style="background-color: #c5f5bc55">{{ __('Estado') }}<br>{{ __('Pedido') }}</th>
                                    <th scope="col">{{ __('Total') }} <br> <label id="total"></label></th>
                                    <th scope="col">{{ __('Abonos Total') }}<br>{{ __('(inicial+Abonos X Cartera)') }}<label id="abonosTotal"></label></th>
                                    <th scope="col">{{ __('Saldo') }} <label id="saldo"></label></th>
                                    <th scope="col">{{ __('Vr. Montura') }} <label id="vrMontura"></label></th>
                                    <th scope="col">{{ __('Vr. Lente') }} <label id="vrLente"></label></th>
                                    <th scope="col" style="background-color: #fff4b955">{{ __('Fecha Orden') }}<br>{{ __('de Pedido') }}</th>
                                    <th scope="col" style="background-color: #ffe96b55">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
                                    <th scope="col">{{ __('AM/PM') }}</th>
                                    <th scope="col">{{ __('Sede')}}</th>                                   
                                    <th scope="col" style="background-color: #CADFFF55">{{ __('Sede')}}<br>{{ __('Asesor') }}</th>                                    
                                    <th scope="col">{{ __('Medicos')}}</th>                                    
                                    <th scope="col" style="background-color: #F9E8BB55">{{ __('Asesor')}}</th>
                                    {{-- Cliente --}}                                   
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('(Nombre)') }}<br>{{ __('y') }}<br>{{ __('Apellidos') }}</th>                                    
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Tipo') }}<br>{{ __('Documento') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Documentos') }}<br>{{ __('de') }}<br>{{ __('Identidad') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Celular') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Teléfono') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Correo') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Fecha') }}<br>{{ __('Cumpleaños') }}</th>
                                    <th scope="col">{{ __('Cliente')}}<br>{{ __('Dirección') }}</th>
                                    {{-- Fórmula OD --}}
                                    <th scope="col">{{ __('RX')}}</th>
                                    <th scope="col">{{ __('Esfera')}}</th>
                                    <th scope="col">{{ __('Cilindro')}}</th>
                                    <th scope="col">{{ __('Eje')}}</th>
                                    <th scope="col">{{ __('Adición')}}</th>
                                    <th scope="col">{{ __('D.N.P')}}</th>
                                    <th scope="col">{{ __('Altura')}}</th>
                                    <th scope="col">{{ __('Prisma')}}</th>
                                    <th scope="col">{{ __('Lente')}}</th>
                                    <th scope="col">{{ __('Lab.')}}</th>
                                    <th scope="col">{{ __('No.')}}</th>
                                    <th scope="col">{{ __('Bisel')}}</th>
                                    <th scope="col">{{ __('Lote')}}</th>
                                    {{-- Fórmula  OI--}}
                                    <th scope="col">{{ __('RX')}}</th>
                                    <th scope="col">{{ __('Esfera')}}</th>
                                    <th scope="col">{{ __('Cilindro')}}</th>
                                    <th scope="col">{{ __('Eje')}}</th>
                                    <th scope="col">{{ __('Adición')}}</th>
                                    <th scope="col">{{ __('D.N.P')}}</th>
                                    <th scope="col">{{ __('Altura')}}</th>
                                    <th scope="col">{{ __('Prisma')}}</th>
                                    <th scope="col">{{ __('Lente')}}</th>
                                    <th scope="col">{{ __('Lab.')}}</th>
                                    <th scope="col">{{ __('No.')}}</th>
                                    <th scope="col">{{ __('Bisel')}}</th>
                                    <th scope="col">{{ __('Lote')}}</th>
                                    {{-- Lente --}}
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('Tipo') }}</th>
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('Clase de') }}<br>{{ __('Progresivo') }}</th>
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('INVIMA') }}</th>
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('Tratamiento') }}</th>
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('Color LTE') }}</th>
                                    <th scope="col">{{ __('Lente')}}<br>{{ __('Material') }}</th>
                                    {{-- Montura --}}
                                    <th scope="col">{{ __('Montura')}}<br>{{ __('Ref') }}</th>
                                    <th scope="col">{{ __('Montura')}}<br>{{ __('Color') }}</th>
                                    <th scope="col">{{ __('Montura')}}<br>{{ __('Material') }}</th>
                                    <th scope="col">{{ __('Montura')}}<br>{{ __('Tipo') }}</th>
                                    {{-- Medidas --}}
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Horizontal') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Vertical') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Puente') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Diagonal') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Dist.Mecánica') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('D. Vertice') }}<br>{{ __('OD') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('D. Vertice') }}<br>{{ __('OI') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Panorámico') }}</th>
                                    <th scope="col">{{ __('Medidas')}}<br>{{ __('Pantoscopico') }}</th>
                                    {{-- Observaciones --}}
                                    <th scope="col">{{ __('Curva')}}<br>{{ __('Base') }}</th>
                                    <th scope="col">{{ __('Nro')}}<br>{{ __('Factura') }}</th>
                                    <th scope="col">{{ __('Observaciones')}}</th>
                                    <th scope="col">{{ __('Actualizar')}}<br>{{ __('Orden') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $orden)
                                    @php
                                        $part1 = explode("-", $orden->fecha);
                                        $nroOrden = $part1[0].$part1[1].$orden->id;
                                        $abonos = DB::table('abonos')
                                        ->select('*')
                                        ->where('orden_id',$orden->id)
                                        ->get();
                                        $acumAbono = 0;
                                        foreach ($abonos as $abono) {
                                            $acumAbono = $acumAbono + $abono->valor;
                                        }
                                        $acumAbono = $acumAbono + (int)$orden->dato37;
                                        $saldo = (int)$orden->dato36 - $acumAbono;                                                    
                                        $total['total'] = $total['total'] + (int)$orden->dato36; 
                                        $total['abono'] = $total['abono'] + $acumAbono; 
                                        $total['saldo'] = $total['saldo'] + $saldo; 
                                        $total['montura'] = $total['montura'] + (int)$orden->dato34; 
                                        $total['lente'] = $total['lente'] + (int)$orden->dato35;
                                    @endphp
                                    <tr>
                                        <td class="general">
                                            <form action="{{ route('ordenes.delete', $orden->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">  
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar esta Orden?") }}') ? this.parentElement.submit() : ''">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form>
                                        </td>                                                
                                        <td class="general">{{ $nroOrden }}</td>
                                        <td style="background-color: #c5f5bc55">{{ $orden->dato59 }}</td>
                                        <td class="general">{{ @number_format($orden->dato36, 0, '', '.') }}</td>
                                        <td class="general">{{ number_format($acumAbono, 0, '', '.') }}</td>
                                        <td class="general">{{ number_format($saldo, 0, '', '.') }}</td>
                                        <td class="general">{{ @number_format($orden->dato34, 0, '', '.') }}</td>
                                        <td class="general">{{ @number_format($orden->dato35, 0, '', '.') }}</td>
                                        <td style="background-color: #fff4b955">{{ $orden->fecha }}</td>
                                        <td style="background-color: #ffe96b55">{{ $orden->dato0 }}</td>
                                        <td class="general">{{ $orden->dato1 }}</td>
                                        <td class="general">{{ $orden->cliente->sede->sede}}</td>
                                        <td style="background-color: #CADFFF55">{{ $orden->usuario->sede->sede}}</td>
                                        <td class="general">{{ utf8_encode($orden->dato32) }}</td>
                                        <td style="background-color: #F9E8BB55">{{ $orden->dato58 }}</td>
                                        {{-- Cliente --}}
                                        <td class="cliente">{{ $orden->c_nombre }}</td>
                                        <td class="cliente">{{ $orden->c_tipoDoc }}</td>
                                        <td class="cliente">{{ $orden->c_documento }}</td>
                                        <td class="cliente">{{ $orden->c_celular }}</td>
                                        <td class="cliente">{{ $orden->c_telefono }}</td>
                                        <td class="cliente">{{ $orden->c_correo }}</td>
                                        <td class="cliente">{{ $orden->c_fechaNacimiento }}</td>
                                        <td class="cliente">{{ $orden->c_direccion }}</td>
                                        {{-- Fórmula --}}
                                        <td class="formula1">{{__('OD')}}</td>
                                        <td class="formula1">{{ $orden->dato2 }}</td>
                                        <td class="formula1">{{ $orden->dato3 }}</td>
                                        <td class="formula1">{{ $orden->dato4 }}</td>
                                        <td class="formula1">{{ $orden->dato5 }}</td>
                                        <td class="formula1">{{ $orden->dato6 }}</td>
                                        <td class="formula1">{{ $orden->dato7 }}</td>
                                        <td class="formula1">{{ $orden->dato8 }}</td>
                                        <td class="formula1">{{ $orden->dato9 }}</td>
                                        <td class="formula1">{{ $orden->dato10 }}</td>
                                        <td class="formula1">{{ $orden->dato11 }}</td>
                                        <td class="formula1">{{ $orden->dato12 }}</td>
                                        <td class="formula1">{{ $orden->dato13 }}</td>
                                        <td class="formula2">{{__('OI')}}</td>
                                        <td class="formula2">{{ $orden->dato14 }}</td>
                                        <td class="formula2">{{ $orden->dato15 }}</td>
                                        <td class="formula2">{{ $orden->dato16 }}</td>
                                        <td class="formula2">{{ $orden->dato17 }}</td>
                                        <td class="formula2">{{ $orden->dato18 }}</td>
                                        <td class="formula2">{{ $orden->dato19 }}</td>
                                        <td class="formula2">{{ $orden->dato20 }}</td>
                                        <td class="formula2">{{ $orden->dato21 }}</td>
                                        <td class="formula2">{{ $orden->dato22 }}</td>
                                        <td class="formula2">{{ $orden->dato23 }}</td>
                                        <td class="formula2">{{ $orden->dato24 }}</td>
                                        <td class="formula2">{{ $orden->dato25 }}</td>
                                        {{-- Lente --}}
                                        <td class="lente">{{ $orden->dato26 }}</td>
                                        <td class="lente">{{ $orden->dato27 }}</td>
                                        <td class="lente">{{ $orden->dato28 }}</td>
                                        <td class="lente">{{ $orden->dato29 }}</td>
                                        <td class="lente">{{ $orden->dato30 }}</td>
                                        <td class="lente">{{ $orden->dato31 }}</td>
                                        {{-- Montura --}}
                                        <td class="montura">{{ $orden->dato33 }}</td>
                                        <td class="montura">{{ $orden->dato45 }}</td>
                                        <td class="montura">{{ $orden->dato39 }}</td>
                                        <td class="montura">{{ $orden->dato42 }}</td>
                                        {{-- Medidas --}}
                                        <td class="medidas">{{ $orden->dato46 }}</td>
                                        <td class="medidas">{{ $orden->dato47 }}</td>
                                        <td class="medidas">{{ $orden->dato48 }}</td>
                                        <td class="medidas">{{ $orden->dato49 }}</td>
                                        <td class="medidas">{{ $orden->dato50 }}</td>
                                        <td class="medidas">{{ $orden->dato52 }}</td>
                                        <td class="medidas">{{ $orden->dato53 }}</td>
                                        <td class="medidas">{{ $orden->dato54 }}</td>
                                        <td class="medidas">{{ $orden->dato55 }}</td>
                                        {{-- Observaciones --}}
                                        <td class="observaciones">{{ $orden->curva_base }}</td>
                                        <td class="observaciones">{{ $orden->nro_fact }}</td>
                                        <td class="observaciones">{{ $orden->dato57 }}</td>
                                        <td class="observaciones">
                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('ordenes.edit', $orden->id) }}">{{ __('Ver/Editar Orden') }}</a>
                                        </td>
                                    </tr>                                        
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            @if ($cantidadFiltrados>0)                            
                            {{ $ordenes->appends($data)->links() }}
                            @endif
                            {{-- {{ $ordenes->links() }} --}}                            
                        </nav>
                    </div>
                    <script>                               
                            document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
                            document.getElementById("abonosTotal").innerHTML = "{{number_format($total['abono'])}}";
                            document.getElementById("saldo").innerHTML = "{{number_format($total['saldo'])}}";
                            document.getElementById("vrMontura").innerHTML = "{{number_format($total['montura'])}}";
                            document.getElementById("vrLente").innerHTML = "{{number_format($total['lente'])}}";
                    </script>
                    <script>
                        function exportExcelOn(){
                            
                            document.getElementById("excelCheck").value = "1";

                        }

                        function exportExcelOff(){
                            
                            document.getElementById("excelCheck").value = "0";

                        }
                    </script>                  
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection