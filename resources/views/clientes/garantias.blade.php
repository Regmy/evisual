@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'garantias'
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
                                <h6 class="mb-0">{{ __('Gestión de Garantías') }}</h6>
                            </div>
                            <div class="col-3">
                                <Label> <b>{{__('Cliente:')}}</b>{{$cliente->dato1}}</Label>
                            </div>
                            <div class="col-3">
                                <label> <b>{{__('Documento:')}}</b>{{$cliente->dato2}}</label>                            
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
                                    <th scope="col">{{ __('Garantía Nro') }}</th>                                    
                                    <th scope="col">{{ __('Fecha') }}<br>{{ __('Elaboración') }}</th>
                                    <th scope="col">{{ __('Asesor Elabora') }}</th>
                                    <th scope="col">{{ __('Acciones')}}</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @if(!count($garantias)==0)
                                @foreach ($garantias as $garantia)
                                    <tr>
                                        <td>
                                            @php
                                                $part1= explode("-", $garantia->fecha);
                                                $nroOrden= $part1[0].$part1[1].$garantia->id;
                                            @endphp
                                            {{ $nroOrden }}</td>
                                        <td>{{ $garantia->fecha }}</td>
                                        <td>{{ $garantia->dato58 }}</td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                @if (!is_null($garantia->id_orden_out))
                                                    <label style="text-align: center">{{ __('Garantía Convertida') }}</label>
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
                                                        @if (is_null($garantia->id_orden_out))
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('garantias.edit', $garantia->id) }}">{{ __('Ver/Editar Garantía') }}</a>
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('garantias.convertirOrden', $garantia->id) }}">{{ __('Convertir a Orden') }}</a>
                                                        @endif
                                                        @if (!is_null($garantia->id_orden_in))
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.edit', $garantia->id_orden_in) }}">{{ __('Ver/Editar Orden Previa') }}</a>
                                                        @endif
                                                        @if (!is_null($garantia->id_orden_out))
                                                        <a class="dropdown-item py-1" style="font-size: 0.8rem" href="{{ route('ordenes.edit', $garantia->id_orden_out) }}">{{ __('Ver/Editar Orden Generada') }}</a>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                            <br>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td>
                                        <Label> <b>{{__('El cliente aún no tiene garantías.')}}</b></Label>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $garantias->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection