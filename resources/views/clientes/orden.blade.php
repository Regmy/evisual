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
                                <h6 class="mb-0">{{ __('Ordenes del Cliente') }}</h6>
                            </div>
                            <div class="col-3">
                                <Label> <b>{{__('Cliente:')}}</b>{{$cliente->dato1}}</Label>
                            </div>
                            <div class="col-3">
                                <label> <b>{{__('Documento:')}}</b>{{$cliente->dato2}}</label>
                            </div>
                            <div class="col text-left">
                                <a href="{{ route('ordenes.create', $cliente->id) }}" class="btn btn-sm btn-primary">{{ __('Nueva Orden') }}</a>
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
                                    <th scope="col">{{ __('Pedido No.') }}</th>
                                    <th scope="col">{{ __('Fecha') }}<br>{{ __('Elaboración') }}</th>
                                    <th scope="col">{{ __('Asesor Elabora') }}</th>
                                    <th scope="col">{{ __('Fecha') }}<br>{{ __('Entrega') }}</th>
                                    <th scope="col">{{ __('Hora') }}<br>{{ __('Entrega') }}</th>
                                    <th scope="col">{{ __('Estado Orden') }}</th>
                                    <th scope="col">{{ __('Valor Notas de') }} <br> {{__('Credito')}}</th>
                                    <th scope="col">{{ __('Notas de Credito')}}</th>                                    
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordenes as $orden)
                                    <tr>
                                        <td>
                                            @php
                                                $part1= explode("-", $orden->fecha);
                                                $nroOrden= $part1[0].$part1[1].$orden->id;

                                            @endphp
                                            {{ $nroOrden }}</td>
                                        <td>{{ $orden->fecha }}</td>
                                        <td>{{ $orden->dato58 }}</td>
                                        <td>{{ $orden->dato0 }}</td>
                                        <td>{{ $orden->dato1 }}</td>                                        
                                        <td class="text-primary">{{ $orden->dato59 }}</td>
                                        <td>{{'OD:'}} {{$orden->nota_credito}} <br>
                                            {{'OI:'}} {{$orden->nota_credito2}} <br>
                                            {{'Montura:'}} {{$orden->nota_credito3}} <br><br>
                                            {{'Total:'}} {{$orden->nota_credito4}}                                        
                                        </td>
                                        <td>{{ $orden->nota_credito_texto }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('clientes.edit', $cliente->id) }}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                         
                                                            @if (  $orden->id_orden == "" )
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('ordenes.edit', $orden->id) }}">{{ __('Ver/Editar Orden') }}</a>                                                            
                                                            @endif
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('garantias.create', $orden->id) }}">{{ __('Convertir a garantía') }}</a>
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('ordenes.editLab', $orden->id) }}">{{ __('Laboratorios') }}</a>                                                            
                                                            @if (  $orden->id_orden == "" )
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('facturas.createItem', $orden->id) }}">{{ __('Agregar item a Factura') }}</a>                                                            
                                                            @endif
                                                            @if (  $orden->id_orden == "" )
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('facturas.edit', $orden->id) }}">{{ __('Grabar Factura') }}</a>                                                                
                                                            @endif                                    
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('PDF.certificadoadd', $orden->id) }}">{{ __('Certificado') }}</a>                                                            
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('abono.index', $orden->id) }}">{{ __('Abonar a Factura') }}</a>
                                                            <a class="dropdown-item py-1" style="font-size: 0.6rem" href="{{ route('facturas.notaCredito', $orden->id) }}">{{ __('Nota de Credito') }}</a>                                                            
                                                        </form>
                                                </div>
                                            </div>
                                            <br>
                                            <label style="padding-right: inherit">{{_('PDF')}}</label>
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="nc-align-left-2 nc-icon"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if (  $orden->id_orden != "" )                                               
                                                    <a class="dropdown-item" target="_blank" style="font-size: 0.8rem" target="_blank" href="{{ route('PDF.factura', $orden->id) }}">{{ __('Factura/PDF') }}</a>                                                            
                                                    @endif
                                                    <div style="display: flex">
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem; padding-right: 5.2rem;" href="{{ route('PDF.orden', $orden->id) }}">{{ __('Orden (HTML)') }}</a>
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem" href="{{ route('PDF.ordenToPDF', $orden->id) }}">{{ __('PDF') }}</a>
                                                    </div>
                                                    <div style="display: flex">
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem" href="{{ route('PDF.laboratorio', $orden->id) }}">{{ __('Laboratorios (HTML)') }}</a>                                                            
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem" href="{{ route('PDF.laboratorioToPDF', $orden->id) }}">{{ __('PDF') }}</a>                                                            
                                                    </div>
                                                    <div style="display: flex">
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem; padding-right: 3.4rem;" href="{{ route('PDF.certificado', $orden->id) }}">{{ __('Certificado (HTML)') }}</a>                                                                                                                        
                                                        <a class="dropdown-item" target="_blank" style="font-size: 0.8rem" href="{{ route('PDF.certificadoToPDF', $orden->id) }}">{{ __('PDF') }}</a>                                                                                                                        
                                                    </div>
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
                            {{ $ordenes->links() }}
                        </nav>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection