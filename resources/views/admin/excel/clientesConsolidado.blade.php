<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col">{{ __('Nombres y') }} <br> {{ __('Apellidos') }}</th>
            <th scope="col">{{ __('Sede') }}</th>
            <th scope="col">{{ __('Documento') }}</th>
            <th scope="col">{{ __('Celular') }}</th>
            <th scope="col">{{ __('Telefono') }} <br> {{ __('Fijo') }}</th>
            <th scope="col">{{ __('Cumpleaños') }}</th>
            <th scope="col">{{ __('Correo') }}</th>
            <th scope="col">{{ __('Direccion') }}</th>
            <th scope="col">{{ __('Municipio')}}</th>                                    
            <th scope="col">{{ __('Observaciones')}}</th>
            <th scope="col">{{ __('Fecha')}} <br> {{ __('Creación') }}</th>
        </tr>
    </thead>                           
    <tbody>
        @foreach ($clientes as $cliente)                                                                          
            <tr>
                <td>{{ $cliente->dato1 }}</td>
                <td>{{ $cliente->dato11 }}</td>
                <td>{{ $cliente->dato2 }}</td>
                <td>{{ $cliente->dato3 }}</td>
                <td>{{ $cliente->dato4 }}</td>
                <td>{{ $cliente->dato5 }}</td>
                <td>{{ $cliente->dato6 }}</td>
                <td>{{ $cliente->dato7 }}</td>
                <td>{{ $cliente->dato8 }}</td>
                <td>{{ $cliente->dato9 }}</td>
                <td>{{ $cliente->dato10 }}</td>                
            </tr>
        @endforeach
    </tbody>
</table>