@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'cotizacion'
])

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <form action="{{ route('admin.informeCotizacion') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="GET"> 
                        <input type="hidden" name="excelCheck" id="excelCheck" value="0"> 
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h6 class="mb-0">{{ __('Informe de Cotizaciones') }}</h6>
                                    <br>
                                </div>
                                <div class="col-6">
                                    {{-- <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary">{{ __('Exportar a Excel') }}</a> --}}
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <label ><b>{{__('Filtrar por Fecha de Creación: ')}}</b></label>
                                    <br>
                                    <label >{{__('Fecha Inicio: ')}}</label>                                                                                            
                                    <input type="date" name="fechaInicio" style="padding-left: 1rem" value="{{$request->fechaInicio}}">
                                    <label >{{__('Fecha Fin: ')}}</label>                                                                                            
                                    <input type="date" name="fechaFin" value="{{$request->fechaFin}}">                                                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for=""> {{__('Estado de Cotización')}} </label>
                                    <select class="form-control" type="text" name="estado">
                                        <option value="">{{__('Estado (Todos)')}}</option>                                                                                
                                        {{-- <option value="CUARENTENA" @if("CUARENTENA" == $request->estado) selected @endif>{{__('CUARENTENA')}}</option>                                                                                
                                        <option value="SEPARADO" @if("SEPARADO" == $request->estado) selected @endif>{{__('SEPARADO')}}</option>                                                                                
                                        <option value="PEDIDO_LABORATORIO" @if("PEDIDO_LABORATORIO" == $request->estado) selected @endif>{{__('PEDIDO LABORATORIO')}}</option>                                                                                
                                        <option value="CORTE Y DISENO" @if("CORTE Y DISENO" == $request->estado) selected @endif>{{__('CORTE Y DISEÑO')}}</option>                                                                                
                                        <option value="PRODUCTO TERMINADO" @if("PRODUCTO TERMINADO" == $request->estado) selected @endif>{{__('PRODUCTO TERMINADO')}}</option>                                                                                
                                        <option value="TRABAJO ENTREGA" @if("TRABAJO ENTREGA" == $request->estado) selected @endif>{{__('TRABAJO ENTREGA')}}</option> --}}
                                    </select>
                                </div>
                                <div class="col">
                                    <label> {{__('Usuarios')}} </label>
                                    <select class="form-control" type="text" name="usuario">
                                        <option value="">{{__('Usuarios (Todos)')}}</option>
                                        @foreach ($usuarios as $parametro)
                                            <option value="{{$parametro->nombre}}" @if($parametro->nombre == $request->usuario) selected @endif>{{$parametro->nombre}}{{__(' - ')}}{{$parametro->sede}}</option>                                                    
                                        @endforeach                                               
                                    </select>
                                </div>                                
                                <div class="col" style="padding-top: 1rem">
                                    <input type='submit' class="btn btn-sm btn-primary" onclick="exportExcelOff()" value='Filtrar'> 
                                    <input type='submit' class="btn btn-sm btn-primary" onclick="exportExcelOn()" value='Exportar a Excel'> 
                                </div>
                            </div>                                  
                            <div class="row pl-2 pb-3 pt-2">
                                <div class="col">
                                    <label><b>{{__('Total Registros Filtrados: ')}}{{ $cantidadFiltrados}}</b></label>
                                </div>                                    
                            </div>                            
                        </div>
                    </form>                            
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
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">{{ __('Eliminar') }}</th>
                                        <th scope="col">{{ __('Nro.') }}<br>{{ __('Cotización') }}</th>
                                        <th scope="col">{{ __('Estado') }}<br>{{ __('') }}</th>
                                        <th scope="col">{{ __('Total') }} <br> <label id="total"></label></th>
                                        {{-- <th scope="col">{{ __('Abonos Total') }}<br>{{ __('(inicial+Abonos X Cartera)') }}<label id="abonosTotal"></label></th> --}}
                                        {{-- <th scope="col">{{ __('Saldo') }} <label id="saldo"></label></th> --}}
                                        {{-- <th scope="col">{{ __('Vr. Montura') }} <label id="vrMontura"></label></th>
                                        <th scope="col">{{ __('Vr. Lente') }} <label id="vrLente"></label></th> --}}
                                        <th scope="col">{{ __('Fecha Solicitud') }}<br>{{ __('de Cotización') }}</th>
                                        <th scope="col">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
                                        <th scope="col">{{ __('AM/PM') }}</th>
                                        <th scope="col">{{ __('Sede')}}</th>                                   
                                        {{-- <th scope="col">{{ __('Sede')}}<br>{{ __('Asesor') }}</th>                                     --}}
                                        <th scope="col">{{ __('Medico')}}</th>
                                        <th scope="col">{{ __('Asesor')}}</th>                                    
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('(Nombre)') }}<br>{{ __('y') }}<br>{{ __('Apellidos') }}</th>                                    
                                        {{-- <th scope="col">{{ __('Cliente')}}<br>{{ __('Tipo') }}<br>{{ __('Documento') }}</th> --}}
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Documentos') }}<br>{{ __('de') }}<br>{{ __('Identidad') }}</th>
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Celular') }}</th>
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Teléfono') }}</th>
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Correo') }}</th>
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Fecha') }}<br>{{ __('Cumpleaños') }}</th>
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Dirección') }}</th>
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
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('Tipo') }}</th>
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('Clase de') }}<br>{{ __('Progresivo') }}</th>
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('INVIMA') }}</th>
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('Tratamiento') }}</th>
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('Color LTE') }}</th>
                                        <th scope="col">{{ __('Lente')}}<br>{{ __('Material') }}</th>
                                        <th scope="col">{{ __('Montura')}}<br>{{ __('Ref') }}</th>
                                        <th scope="col">{{ __('Montura')}}<br>{{ __('Color') }}</th>
                                        <th scope="col">{{ __('Montura')}}<br>{{ __('Material') }}</th>
                                        <th scope="col">{{ __('Montura')}}<br>{{ __('Tipo') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Horizontal') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Vertical') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Puente') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Diagonal') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Dist.Mecánica') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('D. Vertice') }}<br>{{ __('OD') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('D. Vertice') }}<br>{{ __('OI') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Panorámico') }}</th>
                                        <th scope="col">{{ __('Medidas')}}<br>{{ __('Pantoscopico') }}</th>
                                        {{-- <th scope="col">{{ __('Curva')}}<br>{{ __('Base') }}</th> --}}
                                        {{-- <th scope="col">{{ __('Nro')}}<br>{{ __('Factura') }}</th> --}}
                                        <th scope="col">{{ __('Observaciones')}}</th>
                                        <th scope="col">{{ __('Actualizar')}}<br>{{ __('Orden') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotizaciones as $cotizacion)
                                        @php                                           
                                            $total['total'] = $total['total'] + (int)$cotizacion->dato36; 
                                            $part0= explode("-", $cotizacion->fecha);
                                            $nroCotizacion= $part0[0].$part0[1].$cotizacion->id;
                                        @endphp
                                        <tr>
                                            <td class="general">
                                                <form action="{{ route('cotizaciones.destroy', $cotizacion->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">  
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar esta Cotización?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('garantiaes.edit', $cotizacion->id) }}">{{ __('Ver/Editar garantia') }}</a> --}}</td>
                                            <td>{{ $nroCotizacion }}</td>
                                            <td>{{ $cotizacion->dato59 }}</td>
                                            <td>{{ @number_format($cotizacion->dato36, 0, '', '.') }}</td>
                                            {{-- <td>{{ @number_format($cotizacion->dato37, 0, '', '.') }}</td> --}}
                                            {{-- <td>{{ @number_format($saldo, 0, '', '.') }}</td> --}}
                                            {{-- <td>{{ @number_format($cotizacion->dato34, 0, '', '.') }}</td> --}}
                                            {{-- <td>{{ @number_format($cotizacion->dato35, 0, '', '.') }}</td> --}}
                                            <td>{{ $cotizacion->fecha }}</td>
                                            <td>{{ $cotizacion->dato0 }}</td>
                                            <td>{{ $cotizacion->dato1 }}</td>
                                            <td>{{ $cotizacion->c_sede }}</td>
                                            {{-- <td>{{ $cotizacion->sede }}</td> --}}
                                            <td>{{ utf8_encode($cotizacion->dato32) }}</td>
                                            <td>{{ $cotizacion->dato58 }}</td>
                                            {{-- Cliente --}}
                                            <td>{{ $cotizacion->c_nombre }}</td>
                                            {{-- <td>{{ $cotizacion->c_tipoDoc }}</td> --}}
                                            <td>{{ $cotizacion->c_documento }}</td>
                                            <td>{{ $cotizacion->c_celular }}</td>
                                            <td>{{ $cotizacion->c_telefono }}</td>
                                            <td>{{ $cotizacion->c_correo }}</td>
                                            <td>{{ $cotizacion->c_fechaNacimiento }}</td>
                                            <td>{{ $cotizacion->c_direccion }}</td>
                                            {{-- Fórmula --}}
                                            <td>{{__('OD')}}</td>
                                            <td>{{ $cotizacion->dato2 }}</td>
                                            <td>{{ $cotizacion->dato3 }}</td>
                                            <td>{{ $cotizacion->dato4 }}</td>
                                            <td>{{ $cotizacion->dato5 }}</td>
                                            <td>{{ $cotizacion->dato6 }}</td>
                                            <td>{{ $cotizacion->dato7 }}</td>
                                            <td>{{ $cotizacion->dato8 }}</td>
                                            <td>{{ $cotizacion->dato9 }}</td>
                                            <td>{{ $cotizacion->dato10 }}</td>
                                            <td>{{ $cotizacion->dato11 }}</td>
                                            <td>{{ $cotizacion->dato12 }}</td>
                                            <td>{{ $cotizacion->dato13 }}</td>
                                            <td>{{__('OI')}}</td>
                                            <td>{{ $cotizacion->dato14 }}</td>
                                            <td>{{ $cotizacion->dato15 }}</td>
                                            <td>{{ $cotizacion->dato16 }}</td>
                                            <td>{{ $cotizacion->dato17 }}</td>
                                            <td>{{ $cotizacion->dato18 }}</td>
                                            <td>{{ $cotizacion->dato19 }}</td>
                                            <td>{{ $cotizacion->dato20 }}</td>
                                            <td>{{ $cotizacion->dato21 }}</td>
                                            <td>{{ $cotizacion->dato22 }}</td>
                                            <td>{{ $cotizacion->dato23 }}</td>
                                            <td>{{ $cotizacion->dato24 }}</td>
                                            <td>{{ $cotizacion->dato25 }}</td>
                                            {{-- Lente --}}
                                            <td>{{ $cotizacion->dato26 }}</td>
                                            <td>{{ $cotizacion->dato27 }}</td>
                                            <td>{{ $cotizacion->dato28 }}</td>
                                            <td>{{ $cotizacion->dato29 }}</td>
                                            <td>{{ $cotizacion->dato30 }}</td>
                                            <td>{{ $cotizacion->dato31 }}</td>
                                            {{-- Montura --}}
                                            <td>{{ $cotizacion->dato33 }}</td>
                                            <td>{{ $cotizacion->dato45 }}</td>
                                            <td>{{ $cotizacion->dato39 }}</td>
                                            <td>{{ $cotizacion->dato42 }}</td>
                                            {{-- Medidas --}}
                                            <td>{{ $cotizacion->dato46 }}</td>
                                            <td>{{ $cotizacion->dato47 }}</td>
                                            <td>{{ $cotizacion->dato48 }}</td>
                                            <td>{{ $cotizacion->dato49 }}</td>
                                            <td>{{ $cotizacion->dato50 }}</td>
                                            <td>{{ $cotizacion->dato52 }}</td>
                                            <td>{{ $cotizacion->dato53 }}</td>
                                            <td>{{ $cotizacion->dato54 }}</td>
                                            <td>{{ $cotizacion->dato55 }}</td>
                                            {{-- Observaciones --}}
                                            {{-- <td>{{ $cotizacion->curva_base }}</td> --}}
                                            {{-- <td>{{ $cotizacion->nro_fact }}</td> --}}
                                            <td>{{ $cotizacion->dato57 }}</td>
                                            <td>
                                                <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('ordenes.edit', $cotizacion->id) }}">{{ __('Ver/Editar Orden') }}</a>
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                @if ($cantidadFiltrados>0)                            
                                {{ $cotizaciones->appends($data)->links() }}
                                @endif
                                {{-- {{ $cotizaciones->links() }} --}}
                            </nav>
                        </div>
                        <script>                               
                                document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
                        </script>
                        <script>
                            function exportExcelOn(){
                                document.getElementById('excelCheck').value = "1";
                            }
                            function exportExcelOff(){
                                document.getElementById('excelCheck').value = "0";
                            }
                        </script>      
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
@endsection