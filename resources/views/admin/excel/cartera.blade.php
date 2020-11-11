<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Orden') }}</th>
            <th scope="col">{{ __('Fecha') }}<br>{{ __('Elaboración') }}</th>
            <th scope="col">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
            <th scope="col">{{ __('Cliente') }}</th>
            <th scope="col">{{ __('Documento') }}</th>
            <th scope="col">{{ __('Contacto') }}</th>
            <th scope="col">{{ __('Usuario') }}</th>
            <th scope="col">{{ __('Estado Trabajo')}}</th>                                    
            <th scope="col">{{ __('Total')}}</th>                                    
            <th scope="col">{{ __('Abonos')}}</th>                                    
            <th scope="col">{{ __('Saldo')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ordenes as $orden)
            @if ($orden->orden_total != $orden->orden_abonos)                                                                            
                <tr>
                    @php
                        $saldo = ((float)$orden->orden_total - (float)$orden->orden_abonos);
                    @endphp
                    <td>{{ $orden->orden_id }}</td>
                    <td>{{ $orden->orden_fechaElaboracion }}</td>
                    <td>{{ $orden->orden_fechaEntrega }}</td>
                    <td style="text-transform:uppercase">{{ $orden->cliente_nombre }}</td>
                    <td>{{ $orden->cliente_documento }}</td>                                        
                    <td>{{ $orden->cliente_contacto }}</td>                                        
                    <td>{{ $orden->orden_usuario }}</td>                                        
                    <td>{{ $orden->orden_estado }}</td>                                        
                    <td>{{ $orden->orden_total }}</td>                                        
                    <td>{{ $orden->orden_abonos }}</td>                                        
                    <td>{{ $saldo }}</td>                    
                </tr>
            @endif
        @endforeach
    </tbody>
</table>