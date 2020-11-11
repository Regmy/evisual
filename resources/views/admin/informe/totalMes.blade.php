@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'orden'
])

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <form action="{{ route('admin.informeOrdenMes') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="GET"> 
                        <input type="hidden" name="excelCheck" id="excelCheck" value="0"> 
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h6 class="mb-0">{{ __('Informes de Ordenes por Mes') }}</h6>
                                    <br>
                                </div>
                                <div class="col-6">
                                    {{-- <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary">{{ __('Exportar a Excel') }}</a> --}}
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <label for=""> {{__('Filtrar por Mes')}} </label>
                                    <select class="form-control" type="text" name="mes">
                                        <option value="">{{__('Seleccionar (Todos)')}}</option>
                                        <option value="01" @if("01" == $request->mes) selected @endif>{{__('Enero')}}</option>                                                                                
                                        <option value="02" @if("02" == $request->mes) selected @endif>{{__('Febrero')}}</option>                                                                                
                                        <option value="03" @if("03" == $request->mes) selected @endif>{{__('Marzo')}}</option>                                                                                
                                        <option value="04" @if("04" == $request->mes) selected @endif>{{__('Abril')}}</option>                                                                                
                                        <option value="05" @if("05" == $request->mes) selected @endif>{{__('Mayo')}}</option>                                                                                
                                        <option value="06" @if("06" == $request->mes) selected @endif>{{__('Junio')}}</option>                                                                                
                                        <option value="07" @if("07" == $request->mes) selected @endif>{{__('Julio')}}</option>                                                                                
                                        <option value="08" @if("08" == $request->mes) selected @endif>{{__('Agosto')}}</option>                                                                                
                                        <option value="09" @if("09" == $request->mes) selected @endif>{{__('Septiembre')}}</option>
                                        <option value="10" @if("10" == $request->mes) selected @endif>{{__('Octubre')}}</option>                                                                                
                                        <option value="11" @if("11" == $request->mes) selected @endif>{{__('Noviembre')}}</option>                                                                                
                                        <option value="12" @if("12" == $request->mes) selected @endif>{{__('Diciembre')}}</option>                                                                                
                                        {{-- <option value="CUARENTENA" @if("CUARENTENA" == $request->estado) selected @endif>{{__('CUARENTENA')}}</option>                                                                                
                                        <option value="SEPARADO" @if("SEPARADO" == $request->estado) selected @endif>{{__('SEPARADO')}}</option>                                                                                
                                        <option value="PEDIDO_LABORATORIO" @if("PEDIDO_LABORATORIO" == $request->estado) selected @endif>{{__('PEDIDO LABORATORIO')}}</option>                                                                                
                                        <option value="CORTE Y DISENO" @if("CORTE Y DISENO" == $request->estado) selected @endif>{{__('CORTE Y DISEÑO')}}</option>                                                                                
                                        <option value="PRODUCTO TERMINADO" @if("PRODUCTO TERMINADO" == $request->estado) selected @endif>{{__('PRODUCTO TERMINADO')}}</option>                                                                                
                                        <option value="TRABAJO ENTREGA" @if("TRABAJO ENTREGA" == $request->estado) selected @endif>{{__('TRABAJO ENTREGA')}}</option> --}}
                                    </select>                                                                  
                                </div>
                                <div class="col-6">
                                    <label for=""> {{__('del Año')}} </label>
                                    <select class="form-control" type="text" name="agno">
                                        @for ($agnoInicio; $agnoInicio<=$agnoActual; $agnoInicio++ )
                                            <option value="{{$agnoInicio}}" @if($agnoInicio == $request->agno) selected @endif>{{$agnoInicio}}</option>
                                        @endfor
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
                                        <th scope="col">{{ __('Nro.') }}<br>{{ __('Pedido') }}</th>
                                        <th scope="col">{{ __('Estado') }}<br>{{ __('') }}</th>
                                        <th scope="col">{{ __('Total') }} <br> <label id="total"></label></th>
                                        <th scope="col">{{ __('Abonos Total') }}<br>{{ __('(inicial+Abonos X Cartera)') }}<label id="abonosTotal"></label></th>
                                        <th scope="col">{{ __('Saldo') }} <label id="saldo"></label></th>
                                        <th scope="col">{{ __('Vr. Montura') }} <label id="vrMontura"></label></th> 
                                        <th scope="col">{{ __('Vr. Lente') }} <label id="vrLente"></label></th>
                                        <th scope="col">{{ __('Fecha Solicitud') }}<br>{{ __('de Cotización') }}</th>
                                        <th scope="col">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
                                        <th scope="col">{{ __('AM/PM') }}</th>
                                        <th scope="col">{{ __('Sede')}}</th>                                   
                                        {{-- <th scope="col">{{ __('Sede')}}<br>{{ __('Asesor') }}</th> --}}
                                        <th scope="col">{{ __('Medico')}}</th>
                                        <th scope="col">{{ __('Asesor')}}</th>                                    
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('(Nombre)') }}<br>{{ __('y') }}<br>{{ __('Apellidos') }}</th>                                    
                                        <th scope="col">{{ __('Cliente')}}<br>{{ __('Tipo') }}<br>{{ __('Documento') }}</th>
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
                                    @foreach ($ordenes as $orden)
                                        @php
                                            $part1= explode("-", $orden->fecha);
                                            $nroOrden= $part1[0].$part1[1].$orden->id;
                                            $abonos=DB::table('abonos')
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
                                                <form action="{{ route('ordenes.deleteOrdenMes', $orden->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">  
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar esta Orden?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td>
                                            {{-- <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('garantiaes.edit', $orden->id) }}">{{ __('Ver/Editar garantia') }}</a> --}}</td>
                                            <td>{{ $nroOrden }}</td>
                                            <td>{{ $orden->dato59 }}</td>
                                            <td>{{ @number_format($orden->dato36, 0, '', '.') }}</td>
                                            <td>{{ number_format($acumAbono, 0, '', '.') }}</td>
                                            <td>{{ number_format($saldo, 0, '', '.') }}</td>
                                            <td>{{ @number_format($orden->dato34, 0, '', '.') }}</td>
                                            <td>{{ @number_format($orden->dato35, 0, '', '.') }}</td>
                                            <td>{{ $orden->fecha }}</td>
                                            <td>{{ $orden->dato0 }}</td>
                                            <td>{{ $orden->dato1 }}</td>
                                            <td>{{ $orden->c_sede }}</td>
                                            {{-- <td>{{ $orden->sede }}</td> --}}
                                            <td>{{ utf8_encode($orden->dato32) }}</td>
                                            <td>{{ $orden->dato58 }}</td>
                                            {{-- Cliente --}}
                                            <td>{{ $orden->c_nombre }}</td>
                                            <td>{{ $orden->c_tipoDoc }}</td>
                                            <td>{{ $orden->c_documento }}</td>
                                            <td>{{ $orden->c_celular }}</td>
                                            <td>{{ $orden->c_telefono }}</td>
                                            <td>{{ $orden->c_correo }}</td>
                                            <td>{{ $orden->c_fechaNacimiento }}</td>
                                            <td>{{ $orden->c_direccion }}</td>
                                            {{-- Fórmula --}}
                                            <td>{{__('OD')}}</td>
                                            <td>{{ $orden->dato2 }}</td>
                                            <td>{{ $orden->dato3 }}</td>
                                            <td>{{ $orden->dato4 }}</td>
                                            <td>{{ $orden->dato5 }}</td>
                                            <td>{{ $orden->dato6 }}</td>
                                            <td>{{ $orden->dato7 }}</td>
                                            <td>{{ $orden->dato8 }}</td>
                                            <td>{{ $orden->dato9 }}</td>
                                            <td>{{ $orden->dato10 }}</td>
                                            <td>{{ $orden->dato11 }}</td>
                                            <td>{{ $orden->dato12 }}</td>
                                            <td>{{ $orden->dato13 }}</td>
                                            <td>{{__('OI')}}</td>
                                            <td>{{ $orden->dato14 }}</td>
                                            <td>{{ $orden->dato15 }}</td>
                                            <td>{{ $orden->dato16 }}</td>
                                            <td>{{ $orden->dato17 }}</td>
                                            <td>{{ $orden->dato18 }}</td>
                                            <td>{{ $orden->dato19 }}</td>
                                            <td>{{ $orden->dato20 }}</td>
                                            <td>{{ $orden->dato21 }}</td>
                                            <td>{{ $orden->dato22 }}</td>
                                            <td>{{ $orden->dato23 }}</td>
                                            <td>{{ $orden->dato24 }}</td>
                                            <td>{{ $orden->dato25 }}</td>
                                            {{-- Lente --}}
                                            <td>{{ $orden->dato26 }}</td>
                                            <td>{{ $orden->dato27 }}</td>
                                            <td>{{ $orden->dato28 }}</td>
                                            <td>{{ $orden->dato29 }}</td>
                                            <td>{{ $orden->dato30 }}</td>
                                            <td>{{ $orden->dato31 }}</td>
                                            {{-- Montura --}}
                                            <td>{{ $orden->dato33 }}</td>
                                            <td>{{ $orden->dato45 }}</td>
                                            <td>{{ $orden->dato39 }}</td>
                                            <td>{{ $orden->dato42 }}</td>
                                            {{-- Medidas --}}
                                            <td>{{ $orden->dato46 }}</td>
                                            <td>{{ $orden->dato47 }}</td>
                                            <td>{{ $orden->dato48 }}</td>
                                            <td>{{ $orden->dato49 }}</td>
                                            <td>{{ $orden->dato50 }}</td>
                                            <td>{{ $orden->dato52 }}</td>
                                            <td>{{ $orden->dato53 }}</td>
                                            <td>{{ $orden->dato54 }}</td>
                                            <td>{{ $orden->dato55 }}</td>
                                            {{-- Observaciones --}}
                                            {{-- <td>{{ $orden->curva_base }}</td> --}}
                                            {{-- <td>{{ $orden->nro_fact }}</td> --}}
                                            <td>{{ $orden->dato57 }}</td>
                                            <td>
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
                        </script>
                        <script>
                            function exportExcelOff(){
                                document.getElementById('excelCheck').value = "0";
                            }

                            function exportExcelOn(){
                                document.getElementById('excelCheck').value = "1";
                            }
                            
                        </script>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
@endsection