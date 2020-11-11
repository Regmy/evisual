<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            {{-- <th scope="col">{{ __('Eliminar') }}</th> --}}
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
        </tr>
    </thead>
    <tbody>
        @foreach ($garantias as $garantia)
            @php  
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
                    
                    $part1= explode("-", $ordenPrevia->fecha);
                    $nroOrdenPrevia= $part1[0].$part1[1].$ordenPrevia->id;
                }
                else {
                    $nroOrdenPrevia="";
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
                {{-- <td>{{ __('Eliminar')}} --}}
                    {{-- <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('garantiaes.edit', $garantia->id) }}">{{ __('Ver/Editar garantia') }}</a> </td>--}}
                <td>{{ $garantia->id }}</td>
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
            </tr>
        @endforeach
</table>
<script>                               
    document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
    document.getElementById("abonosTotal").innerHTML = "{{number_format($total['abono'])}}";
    document.getElementById("saldo").innerHTML = "{{number_format($total['saldo'])}}";
</script>   