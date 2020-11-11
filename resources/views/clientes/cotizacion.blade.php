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
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <h6 class="mb-0">{{ __('Cotizaciones del Cliente') }}</h6>
                            </div>
                            <div class="col-3">
                                <Label> <b>{{__('Cliente: ')}}</b>{{$cliente->dato1}}</Label>
                            </div>
                            <div class="col-3">
                                <label> <b>{{__('Documento: ')}}</b>{{$cliente->dato2}}</label>
                            </div>
                            <div class="col text-left">
                                <a href="{{ route('cotizaciones.create', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Nueva Cotización') }}</a>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('clientes.index', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Atrás') }}</a>
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
                                    <th scope="col">{{ __('Cotizacion Nro') }}</th>
                                    <th scope="col">{{ __('Fecha') }}<br>{{ __('Elaboración') }}</th>
                                    <th scope="col">{{ __('Asesor Elabora') }}</th>
                                    <th scope="col">{{ __('Acciones')}}</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @if(!count($cotizaciones)==0)
                                @foreach ($cotizaciones as $cotizacion)
                                    <tr>
                                        <td>
                                            @php
                                                $part1= explode("-", $cotizacion->fecha);
                                                $nroOrden= $part1[0].$part1[1].$cotizacion->id;
                                            @endphp
                                            {{ $nroOrden }}</td>
                                        <td>{{ $cotizacion->fecha }}</td>
                                        <td>{{ $cotizacion->usuario->nombre}}</td>
                                        <td class="" style="text-align: center">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                                       
                                                    <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('cotizaciones.edit', $cotizacion->id) }}">{{ __('Ver/Editar Cotización') }}</a>                                                            
                                                    <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('cotizaciones.orden', $cotizacion->id) }}">{{ __('Convertir a Orden') }}</a>                                                       
                                                </div>
                                            </div>
                                            <br>
                                            @if (is_null($cotizacion->id_orden))
                                            <label style="padding-right: inherit">{{_('PDF')}}</label>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">                                              
                                                    <div style="display: flex">                                                    
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" target="__blank" href="{{ route('PDF.cotizacion', $cotizacion->id) }}">{{ __('Cotización (HTML)') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" target="__blank" href="{{ route('PDF.cotizacionToPDF', $cotizacion->id) }}">{{ __('PDF') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <Label> <b>{{__('El cliente aún no tiene cotizaciones.')}}</b></Label>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $cotizaciones->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection