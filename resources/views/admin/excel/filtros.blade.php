@php
    ini_set('max_execution_time',720);
@endphp
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

<table class="table align-items-center table-striped">{{-- table-flush --}}
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Nro.') }}<br>{{ __('Pedido') }}</th>
            <th scope="col">{{ __('Estado') }}<br>{{ __('Pedido') }}</th>
            <th scope="col">{{ __('Total') }} <br> <label id="total"></label></th>
            <th scope="col">{{ __('Abonos Total') }}<br>{{ __('(inicial+Abonos X Cartera)') }}<label id="abonosTotal"></label></th>
            <th scope="col">{{ __('Saldo') }} <label id="saldo"></label></th>
            <th scope="col">{{ __('Vr. Montura') }} <label id="vrMontura"></label></th>
            <th scope="col">{{ __('Vr. Lente') }} <label id="vrLente"></label></th>
            <th scope="col">{{ __('Fecha Orden') }}<br>{{ __('de Pedido') }}</th>
            <th scope="col">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
            <th scope="col">{{ __('AM/PM') }}</th>
            <th scope="col">{{ __('Sede')}}</th>                                   
            <th scope="col">{{ __('Sede')}}<br>{{ __('Asesor') }}</th>                                    
            <th scope="col">{{ __('Medicos')}}</th>                                    
            <th scope="col">{{ __('Asesor')}}</th>
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
                <td class="general">{{ $nroOrden }}</td>
                <td>{{ $orden->dato59 }}</td>
                <td class="general">{{ @number_format($orden->dato36, 0, '', '.') }}</td>
                <td class="general">{{ number_format($acumAbono, 0, '', '.') }}</td>
                <td class="general">{{ number_format($saldo, 0, '', '.') }}</td>
                <td class="general">{{ @number_format($orden->dato34, 0, '', '.') }}</td>
                <td class="general">{{ @number_format($orden->dato35, 0, '', '.') }}</td>
                <td>{{ $orden->fecha }}</td>
                <td>{{ $orden->dato0 }}</td>
                <td class="general">{{ $orden->dato1 }}</td>
                <td class="general">{{ $orden->c_sede }}</td>
                <td>{{ $orden->sede }}</td>
                <td class="general">{{ utf8_encode($orden->dato32) }}</td>
                <td>{{ $orden->dato58 }}</td>
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
            </tr>                                        
        @endforeach
    </tbody>
</table>