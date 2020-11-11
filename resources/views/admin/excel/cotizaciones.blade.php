<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
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
        </tr>
    </thead>
    <tbody>
        @foreach ($cotizaciones as $cotizacion)
            @php                                           
                $total['total'] = $total['total'] + (int)$cotizacion->dato36; 
            @endphp
            <tr>
                <td>{{ $cotizacion->id }}</td>
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
            </tr>                                        
        @endforeach
    </tbody>
</table>
<script>                               
    document.getElementById("total").innerHTML = "{{number_format($total['total'])}}";
</script>     