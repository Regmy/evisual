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
                            <div class="col-6">
                                <h6 class="mb-0">{{ __('Panel de Administración:') }} <label  class="mb-0" style="color: #FFA500">{{ __('Cartera') }}</label> </h6>                               
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.carteraExcel') }}" class="btn btn-sm btn-primary">{{ __('Exportar Excel') }}</a>
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
                                    <th scope="col"></th>
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
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="nc-align-left-2 nc-icon"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('ordenes.edit', $orden->orden_id) }}" method="POST">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                           
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" target="_blank" href="{{ route('ordenes.edit', $orden->orden_id) }}">{{ __('Ver/Editar Orden') }}</a>                                                                                                                                    
                                                        </form>
                                                    </div>
                                                </div>                                           
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $ordenes->appends($data)->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection