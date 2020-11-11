@php
    ini_set('max_execution_time',0);
@endphp
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
                    <form action="{{ route('admin.clientesConsolidado') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="GET"> 
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <h6 class="mb-0">{{ __('Gestor de funciones') }}</h6>
                                    <br>
                                </div>
                            </div>
                            <div class="row align-items-center">
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
                                <div class="col-12">
                                    <label for=""><b>{{__('1 - Anexar indices de Usuarios en la tabla Orden Detalles')}}</b></label>
                                    <a href="{{ route('user.indUsuarioOrdenDetalle') }}" class="btn btn-sm btn-primary">{{ __('Aplicar') }}</a>
                                    <br>
                                    <label for=""><b>{{__('2 - Anexar indice de Sede en la tabla Usuarios')}}</b></label>
                                    <a href="{{ route('user.indiceSedeTablaUsuarios') }}" class="btn btn-sm btn-primary">{{ __('Aplicar') }}</a>
                                    <br>
                                    <label for=""><b>{{__('3 - Anexar indice de Sede en la tabla Clientes')}}</b></label>
                                    <a href="{{ route('user.indiceSedeTablaClientes') }}" class="btn btn-sm btn-primary">{{ __('Aplicar') }}</a>
                                    <br>
                                    <label for=""><b>{{__('4 - Anexar indice de Usuarios en la tabla Cotizaciones')}}</b></label>
                                    <a href="{{ route('user.indiceUsuarioTablaCotizacionDetalles') }}" class="btn btn-sm btn-primary">{{ __('Aplicar') }}</a>
                                    <br>
                                    <label for=""><b>{{__('5 - Randomizar las sedes de los clientes')}}</b></label>
                                    <a href="{{ route('user.randomsedeclientes') }}" class="btn btn-sm btn-primary">{{ __('Aplicar') }}</a>
                                    <br>
                                </div>
                            </div>
                        </div>                                                                  
                    </form>                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection