@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'clientes'
    
])

@section('content')
<div class="content">        
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Clientes') }}</h3>
                            </div>
                            {{-- <div class="col-6 col-sm-4 text-right">
                                <a href="{{ route('clientes.create') }}" class="btn btn-sm btn-primary">{{ __('Nuevo Cliente') }}</a>
                            </div> --}}
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
                                    <th scope="col">{{ __('Nombres y Apellidos') }}</th>
                                    <th scope="col">{{ __('Documento') }}</th>
                                    <th scope="col">{{ __('Celular') }}</th>
                                    <th scope="col">{{ __('Teléfono') }}</th>
                                    <th scope="col">{{ __('Cumpleaños') }}</th>
                                    <th scope="col">{{ __('Correo') }}</th>
                                    <th scope="col">{{ __('Dirección') }}</th>
                                    <th scope="col">{{ __('Municipio') }}</th>
                                    <th scope="col">{{ __('Observaciones') }}</th>
                                    <th scope="col">{{ __('Creación') }}</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->dato1 }}</td>
                                        <td>{{ $cliente->dato2 }}</td>
                                        <td>{{ $cliente->dato3 }}</td>
                                        <td>{{ $cliente->dato4 }}</td>
                                        <td>{{ $cliente->dato5 }}</td>
                                        <td>{{ $cliente->dato6 }}</td>
                                        <td>{{ $cliente->dato7 }}</td>
                                        <td>{{ $cliente->dato8 }}</td>
                                        <td>{{ $cliente->dato9 }}</td>
                                        <td>{{ $cliente->dato10 }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                         
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('clientes.edit', $cliente->id) }}">{{ __('Editar') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.create', $cliente->id) }}">{{ __('Nueva Orden') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.index', $cliente->id) }}">{{ __('Ordenes') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('cotizaciones.create', $cliente->id) }}">{{ __('Cotizar') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('cotizaciones.index', $cliente->id) }}">{{ __('Cotizaciones') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('garantias.index', $cliente->id) }}">{{ __('Garantías') }}</a>
                                                        {{-- @if (auth()->user()->rol =="adminisis" || auth()->user()->rol=="semiadministrador" )
                                                        <button type="button" class="dropdown-item" style="font-size: 0.8rem" onclick="confirm('{{ __("Esta seguro de eliminar este Cliente?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Eliminar') }}
                                                        </button>
                                                        @endif --}}
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $clientes->appends($data)->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection