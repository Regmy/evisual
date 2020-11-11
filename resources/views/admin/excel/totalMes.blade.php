<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Nro.') }}<br>{{ __('Cotización') }}</th>
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
                <td>{{ $orden->id }}</td>
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
            </tr>                                        
        @endforeach
    </tbody>
</table>
<script>                               
    document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
</script>    