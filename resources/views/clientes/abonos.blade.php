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
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h6 class="mb-0">{{ __('Gestión de los Abonos') }}</h6>
                            </div>
                            <div class="col-3">
                                <Label> <b>{{__('Cliente:')}}</b>{{$cliente->dato1}}</Label>
                            </div>
                            <div class="col-3" style="height: 2.5rem">
                                <label> <b>{{__('Documento:')}}</b>{{$cliente->dato2}}</label>
                            </div>
                            <div class="col text-left">
                                {{-- <a href="{{ route('ordenes.create', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Nueva Orden') }}</a> --}}
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('ordenes.index', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
                            </div>
                        </div>
                    </div>                        
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
                                    <th scope="col">{{ __('Orden No.') }}</th>
                                    <th scope="col">{{ __('Nro') }}<br>{{ __('Factura') }}</th>
                                    <th scope="col">{{ __('Total') }}</th>
                                    <th scope="col" style="text-align: center">{{ __('Abonos') }}</th>
                                    <th scope="col">{{ __('Saldo') }}</th>
                                    <th scope="col">{{ __('') }}</th> 
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>
                                            @php
                                                $part1= explode("-", $orden->fecha);
                                                $nroOrden= $part1[0].$part1[1].$orden->id;
                                            @endphp
                                            {{ $nroOrden }}</td>
                                        <td>{{ $orden->nro_fact }}</td>
                                        <td>{{ $orden->dato36 }}</td>
                                        <td>{{-- Abonos For each --}}
                                            <table>
                                                <tr>
                                                    <td>{{ __('Fecha') }}</td>
                                                    <td class="pb-0">{{ __('Abono Inicial: ') }} <br> <label style="color: limegreen; font-weight: bold"> {{ $orden->dato37}}</label></td>
                                                    <td>{{ __('#Caja') }}</td>
                                                    <td>{{ __('Tipo de Pago') }}</td>
                                                    @if (auth()->user()->rol =="adminisis" || auth()->user()->roll == "semiadministrador" )
                                                    <td style="text-align: center">{{ __('Acción') }}</td>
                                                    @endif
                                                </tr>
                                                    @foreach ($abonos as $abono)
                                                        <tr>
                                                            <td>{{ $abono->fecha }}</td>
                                                            <td>
                                                                @if (auth()->user()->rol =="adminisis" || auth()->user()->rol=="semiadministrador" )
                                                                <form method="POST" action="{{ route('abono.update', $abono->id) }}" autocomplete="off"> 
                                                                    <input type="hidden" name="_method" value="PUT">                               
                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                    <input type="hidden" name="idOrden" value="{{ $orden->id }}">
                                                                    <input type="hidden" name="idCliente" value="{{ $orden->cliente_id }}">
                                                                    <input type="number" name="abono" style="width: 6rem" value={{ $abono->valor }}>
                                                                @else
                                                                    {{ $abono->valor }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $abono->id }}</td>
                                                            <td>
                                                                @if (auth()->user()->rol =="adminisis" || auth()->user()->rol =="semiadministrador" )
                                                                    <input type="text" name="formaPago" style="width: 7rem;" value={{ $abono->tipo_pago }}>
                                                                @else
                                                                    {{ $abono->tipo_pago }} 
                                                                @endif
                                                            </td>
                                                            @if (auth()->user()->rol =="adminisis" || auth()->user()->rol =="semiadministrador" )
                                                                <td>
                                                                    <button style="font-size: 0.6rem; width: 5rem" type="submit" class="btn btn-info">{{ __('Editar') }}</button>
                                                                    </form> 
                                                                    {{-- <a href="{{ route('abono.update', $abono->id) }}">{{ __('Editar') }}</a> --}}
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                            </table> 
                                        </td>
                                        <td>{{ $saldo }}</td>  
                                        <td class="text-right">
                                            <div class="dropdown" style="text-align: center">
                                                @if ($saldo < 0 )
                                                    <label style="text-align: center">{{ __('Factura Cancelada') }}</label>
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
                                                        <form action="{{ route('clientes.edit', $cliente->id) }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                                                            @if ($saldo!==0 )
                                                                <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('abono.create', $orden->id) }}">{{ __('Agregar Abono') }}</a>
                                                            @endif
                                                            <div style="display: flex">
                                                                <a class="dropdown-item py-1" style="font-size: 0.8rem" target="_blank" href="{{ route('PDF.abono', $orden->id) }}">{{ __('Abono (HTML)') }}</a>                                                        
                                                                <a class="dropdown-item py-1" style="font-size: 0.8rem" target="_blank" href="{{ route('PDF.abonoToPDF', $orden->id) }}">{{ __('PDF') }}</a>                                                        
                                                            </div>                                                        
                                                        </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $abonos->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection