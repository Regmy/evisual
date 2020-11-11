@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'garantia'
])

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <form action="{{ route('admin.informeGarantia') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="GET"> 
                        <input type="hidden" name="excelCheck" id="excelCheck" value="0"> 
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h6 class="mb-0">{{ __('Informe de Garantías del año en Curso') }}</h6>
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
                                    <label for=""> {{__('Estado de Garantía')}} </label>
                                    <select class="form-control" type="text" name="estado">
                                        <option value="">{{__('Estado (Todos)')}}</option>                                                                                
                                        <option value="CUARENTENA" @if("CUARENTENA" == $request->estado) selected @endif>{{__('CUARENTENA')}}</option>                                                                                
                                        <option value="SEPARADO" @if("SEPARADO" == $request->estado) selected @endif>{{__('SEPARADO')}}</option>                                                                                
                                        <option value="PEDIDO_LABORATORIO" @if("PEDIDO_LABORATORIO" == $request->estado) selected @endif>{{__('PEDIDO LABORATORIO')}}</option>                                                                                
                                        <option value="CORTE Y DISENO" @if("CORTE Y DISENO" == $request->estado) selected @endif>{{__('CORTE Y DISEÑO')}}</option>                                                                                
                                        <option value="PRODUCTO TERMINADO" @if("PRODUCTO TERMINADO" == $request->estado) selected @endif>{{__('PRODUCTO TERMINADO')}}</option>                                                                                
                                        <option value="TRABAJO ENTREGA" @if("TRABAJO ENTREGA" == $request->estado) selected @endif>{{__('TRABAJO ENTREGA')}}</option>                                                                                
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
                                        <th scope="col">{{ __('Nro.') }}<br>{{ __('Pedido') }}</th>
                                        <th scope="col">{{ __('Estado') }}<br>{{ __('Garantía') }}</th>
                                        <th scope="col">{{ __('Total') }} <br> <label id="total"></label></th>
                                        <th scope="col">{{ __('Abonos Total') }}<br>{{ __('(inicial+Abonos X Cartera)') }}<label id="abonosTotal"></label></th>
                                        <th scope="col">{{ __('Saldo') }} <label id="saldo"></label></th>
                                        {{-- <th scope="col">{{ __('Vr. Montura') }} <label id="vrMontura"></label></th>
                                        <th scope="col">{{ __('Vr. Lente') }} <label id="vrLente"></label></th> --}}
                                        <th scope="col">{{ __('Fecha Solicitud') }}<br>{{ __('de Garantía') }}</th>
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
                                        <th scope="col">{{ __('Orden Previa')}}</th>
                                        <th scope="col">{{ __('Orden Generada')}}</th>
                                        <th scope="col">{{ __('Acciones')}}</th>
                                        {{-- <th scope="col"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($garantias as $garantia)
                                        @php  
                                            $part0= explode("-", $garantia->fecha);
                                            $nroGarantia= $part0[0].$part0[1].$garantia->id;

                                            $saldo = (int)$garantia->dato36 - (int)$garantia->dato37;                                          
                                            $total['total'] = $total['total'] + (int)$garantia->dato36; 
                                            $total['abono'] = $total['abono'] + (int)$garantia->dato37; 
                                            $total['saldo'] = $total['saldo'] + $saldo; 
                                            $total['montura'] = $total['montura'] + (int)$garantia->dato34; 
                                            $total['lente'] = $total['lente'] + (int)$garantia->dato35;
                                            
                                            if(!is_null($garantia->id_orden_in)){
                                                $ordenPrevia=DB::table('orden_detalle')
                                                ->select('fecha','id')
                                                ->where('id',$garantia->id_orden_in)
                                                ->first();

                                                if (!is_null($ordenPrevia)){

                                                $part1= explode("-", $ordenPrevia->fecha);
                                                $nroOrdenPrevia= $part1[0].$part1[1].$ordenPrevia->id;

                                                }else{
                                                    //Entra a esta ruta cuando la orden de la cual proviene esta garantia fue borrada o no se encuentra en la base de datos.
                                                    $nroOrdenPrevia="Borrada";
                                                }
                                                //dd($tempFecha, $tempId);
                                            }
                                            else {
                                                $nroOrdenPrevia="Antes de la actualizacion";
                                            }

                                            if(!is_null($garantia->id_orden_out)){

                                                $ordenGenerada=DB::table('orden_detalle')
                                                ->select('fecha','id')
                                                ->where('id',$garantia->id_orden_out)
                                                ->first();

                                                $part2= explode("-", $ordenGenerada->fecha);
    
                                                $nroOrdenGenerada= $part2[0].$part2[1].$ordenGenerada->id;
                                            } 
                                            else {
                                                $nroOrdenGenerada="";
                                            }                                                                                       
                                        @endphp
                                        <tr>
                                            <td class="general">
                                                <form action="{{ route('garantias.destroy', $garantia->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">  
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar esta Garantía?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Eliminar') }}
                                                    </button>
                                                </form>
                                            </td> 
                                                {{-- <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('garantiaes.edit', $garantia->id) }}">{{ __('Ver/Editar garantia') }}</a> --}}</td>
                                            <td>{{ $nroGarantia }}</td>
                                            <td>{{ $garantia->dato59 }}</td>
                                            <td>{{ @number_format($garantia->dato36, 0, '', '.') }}</td>
                                            <td>{{ @number_format($garantia->dato37, 0, '', '.') }}</td>
                                            <td>{{ @number_format($saldo, 0, '', '.') }}</td>
                                            {{-- <td>{{ @number_format($garantia->dato34, 0, '', '.') }}</td> --}}
                                            {{-- <td>{{ @number_format($garantia->dato35, 0, '', '.') }}</td> --}}
                                            <td>{{ $garantia->fecha }}</td>
                                            <td>{{ $garantia->dato0 }}</td>
                                            <td>{{ $garantia->dato1 }}</td>
                                            <td>{{ $garantia->c_sede }}</td>
                                            {{-- <td>{{ $garantia->sede }}</td> --}}
                                            <td>{{ utf8_encode($garantia->dato32) }}</td>
                                            <td>{{ $garantia->dato58 }}</td>
                                            {{-- Cliente --}}
                                            <td>{{ $garantia->c_nombre }}</td>
                                            {{-- <td>{{ $garantia->c_tipoDoc }}</td> --}}
                                            <td>{{ $garantia->c_documento }}</td>
                                            <td>{{ $garantia->c_celular }}</td>
                                            <td>{{ $garantia->c_telefono }}</td>
                                            <td>{{ $garantia->c_correo }}</td>
                                            <td>{{ $garantia->c_fechaNacimiento }}</td>
                                            <td>{{ $garantia->c_direccion }}</td>
                                            {{-- Fórmula --}}
                                            <td>{{__('OD')}}</td>
                                            <td>{{ $garantia->dato2 }}</td>
                                            <td>{{ $garantia->dato3 }}</td>
                                            <td>{{ $garantia->dato4 }}</td>
                                            <td>{{ $garantia->dato5 }}</td>
                                            <td>{{ $garantia->dato6 }}</td>
                                            <td>{{ $garantia->dato7 }}</td>
                                            <td>{{ $garantia->dato8 }}</td>
                                            <td>{{ $garantia->dato9 }}</td>
                                            <td>{{ $garantia->dato10 }}</td>
                                            <td>{{ $garantia->dato11 }}</td>
                                            <td>{{ $garantia->dato12 }}</td>
                                            <td>{{ $garantia->dato13 }}</td>
                                            <td>{{__('OI')}}</td>
                                            <td>{{ $garantia->dato14 }}</td>
                                            <td>{{ $garantia->dato15 }}</td>
                                            <td>{{ $garantia->dato16 }}</td>
                                            <td>{{ $garantia->dato17 }}</td>
                                            <td>{{ $garantia->dato18 }}</td>
                                            <td>{{ $garantia->dato19 }}</td>
                                            <td>{{ $garantia->dato20 }}</td>
                                            <td>{{ $garantia->dato21 }}</td>
                                            <td>{{ $garantia->dato22 }}</td>
                                            <td>{{ $garantia->dato23 }}</td>
                                            <td>{{ $garantia->dato24 }}</td>
                                            <td>{{ $garantia->dato25 }}</td>
                                            {{-- Lente --}}
                                            <td>{{ $garantia->dato26 }}</td>
                                            <td>{{ $garantia->dato27 }}</td>
                                            <td>{{ $garantia->dato28 }}</td>
                                            <td>{{ $garantia->dato29 }}</td>
                                            <td>{{ $garantia->dato30 }}</td>
                                            <td>{{ $garantia->dato31 }}</td>
                                            {{-- Montura --}}
                                            <td>{{ $garantia->dato33 }}</td>
                                            <td>{{ $garantia->dato45 }}</td>
                                            <td>{{ $garantia->dato39 }}</td>
                                            <td>{{ $garantia->dato42 }}</td>
                                            {{-- Medidas --}}
                                            <td>{{ $garantia->dato46 }}</td>
                                            <td>{{ $garantia->dato47 }}</td>
                                            <td>{{ $garantia->dato48 }}</td>
                                            <td>{{ $garantia->dato49 }}</td>
                                            <td>{{ $garantia->dato50 }}</td>
                                            <td>{{ $garantia->dato52 }}</td>
                                            <td>{{ $garantia->dato53 }}</td>
                                            <td>{{ $garantia->dato54 }}</td>
                                            <td>{{ $garantia->dato55 }}</td>
                                            {{-- Observaciones --}}
                                            {{-- <td>{{ $garantia->curva_base }}</td> --}}
                                            {{-- <td>{{ $garantia->nro_fact }}</td> --}}
                                            <td>{{ $garantia->dato57 }}</td>
                                            <td>{{ $nroOrdenPrevia }}</td>
                                            <td>{{ $nroOrdenGenerada }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    @if (!is_null($garantia->id_orden_out))
                                                        <label style="text-align: center">{{ __('Garantía Convertida') }}</label>
                                                        <br>
                                                        <a class="btn btn-sm btn-icon-only text-light" style="background-color: #7ed6a5" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="nc-align-left-2 nc-icon"></i>
                                                        </a>
                                                    @else
                                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="nc-align-left-2 nc-icon"></i>
                                                        </a>
                                                    @endif
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('clientes.index') }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                                                                                     
                                                            @if (is_null($garantia->id_orden_out))
                                                            <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('garantias.edit', $garantia->id) }}">{{ __('Ver/Editar Garantía') }}</a>
                                                            <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('garantias.convertirOrden', $garantia->id) }}">{{ __('Convertir a Orden') }}</a>
                                                            @endif
                                                            @if (!is_null($garantia->id_orden_in))
                                                            <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.edit', $garantia->id_orden_in) }}">{{ __('Ver/Editar Orden Previa') }}</a>
                                                            @endif
                                                            @if (!is_null($garantia->id_orden_out))
                                                            <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.edit', $garantia->id_orden_out) }}">{{ __('Ver/Editar Orden Generada') }}</a>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                                <br>
                                            </td>
                                        </tr>                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                            <nav class="d-flex justify-content-end" aria-label="...">
                                @if ($cantidadFiltrados>0)                            
                                {{ $garantias->appends($data)->links() }}
                                @endif
                                {{-- {{ $garantiaes->links() }} --}}
                            </nav>
                        </div>
                        <script>                               
                                document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
                                document.getElementById("abonosTotal").innerHTML = "{{number_format($total['abono'])}}";
                                document.getElementById("saldo").innerHTML = "{{number_format($total['saldo'])}}";
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
                </form>    
            </div>
        </div>
    </div>
</div>
@endsection