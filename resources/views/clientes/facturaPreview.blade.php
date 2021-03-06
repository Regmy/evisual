<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('paper') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('paper') }}/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Open Graph data -->
    <meta property="fb:app_id" content="">
    <meta property="og:title" content="Evolución Visual" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="" />
    <meta property="og:image" content=""/>
    <meta property="og:description" content="" />
    <meta property="og:site_name" content="Evolución Visual" />
    
    <title>
        {{ __('Evolución Visual') }}
    </title>
    <!--<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' /-->
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files 
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
     CSS Just for demo purpose, don't include it in your project-->
    <link href="{{ asset('paper') }}/css/estilos-factura.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />

    <!-- Google Tag Manager -->
    <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>-->
    <!-- End Google Tag Manager -->
</head>
<body onload="anchoTablaf()" class="" style="max-width: 100%" id="body">
    <!-- Google Tag Manager (noscript)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
   {{-- -----------------------------Desde aqui empieza------------------------------- --}}
    <div id="tablaGeneral" class="" style="display: inline-block; margin-right: 8px;">
        <form method="POST" action="{{ route('facturas.store') }}" autocomplete="off"> 
        <input type="hidden" name="_method" value="PUT">                               
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="idOrden" value="{{ $orden->id }}">
        <input type="hidden" name="idCliente" value="{{ $orden->cliente_id }}">
            <table id="tabla1">
                <thead>
                    <tr style="">
                        <td class="pl-5" style="text-align: start">
                            <div class="" style="">
                                <label class="m-0"> <a href="{{ route('ordenes.index', $cliente->id) }}"> {{'|< Atrás'}} </a> </label>
                                <br>
                                <label> {{'|FACTURA'}} </label>
                            </div>
                        </td>
                        <td style="">
                            <div class="" style="text-align: center">
                                <img src="{{ asset("img/facturas/$facturaRango->imagen_logo") }}" style="max-height: 120px" />
                                <img src="{{ asset("img/facturas/$facturaRango->imagen_datos") }}"  style="max-height: 120px"/>
                                <br> 
                                <label style="font-size: 0.8rem; font-weight: lighter;">{{'Los valores de la factura son modificables desde la orden antes de que esta sea grabada'}}</label>
                            </div>
                        </td>
                        <td>
                            <div class="" style="" >
                                <label class="m-0" style="font-size: 14px"> {{'FACTURA DE VENTA No.'}} </label>
                                <br/>
                                <label style="font-size: 14px"> {{'IT-'}} </label>
                                <input name="nFactura" type="text" style="width: 100px; background: #beffb2ab; text-align: right;" value="{{ $nFactura }}" >
                            </div>
                        </td>
                    </tr>
                </thead>
            </table>
            <table id="tabla2">
                <thead>

                </thead>
                <tbody style="font-weight: normal">
                    <tr>
                        <td style="font-weight:bold; background: #ffeab257" colspan="2">{{__('CLIENTE')}}</td>
                        <td colspan="2">{{$cliente->dato1}} </td>
                        <td style="font-weight:bold; background: #ffeab257;">{{__('DOCUMENTO')}}</td>
                        <td>{{$cliente->dato2}}</td>
                        <td style="font-weight:bold; background: #ffeab257">{{__('DIRECCIÓN')}}</td>
                        <td>{{$cliente->dato7}}</td>
                        <td style="font-weight:bold; background: #ffeab257">{{__('CORREO ELECTRÓNICO')}}</td>
                        <td >{{$correo}}</td>
                    </tr>
                    <tr style="background-color: #f2f2f2">
                        <td style="font-weight:bold">{{__('CELULAR')}}</td>
                        <td>{{$cliente->dato3}}</td>
                        <td style="font-weight:bold">{{__('TELEFONO')}}</td>
                        <td>{{$cliente->dato4}}</td>
                        <td style="font-weight:bold">{{__('FECHA FACTURA')}}</td>
                        <td><input type="text" name="fechaFactura" style="background: #cecece; width: 7rem " value="<?php echo date("Y-m-d"); ?>" readonly=""></td>
                        <td style="font-weight:bold">{{__('FORMA DE PAGO')}}</td>
                        <td><input type="text" name="formaPago" style="width: 7rem"></td>
                        <td style="font-weight:bold">{{__('FECHA VENCIMIENTO')}}</td>
                        <td><input type="date" name="fechaVencimiento" value="<?php echo date("Y-m-d"); ?>"></td>
                    </tr>
                </tbody>
            </table>
            <table class="bordes" id="tabla3">
                <tbody style="font-weight: normal"><tr> 
                    <td rowspan="3" class="verticalText" style="text-align: center">{{__('Fórmula')}}</td>
                    <td style="width: 17%; background: #beffb2ab">{{__('RX')}}</td>
                    <td class="fondoverde">{{__('Esfera')}}</td> 
                    <td class="fondoverde">{{__('Cilindro')}}</td>
                    <td class="fondoverde">{{__('Eje')}}</td>
                    <td class="fondoverde">{{__('Adición')}}</td>
                    <td class="fondoverde">{{__('D.N.P.')}}</td>
                    <td class="fondoverde">{{__('LENTE Tipo')}}</td>
                    <td class="fondoverde">{{__('LENTE Clase de Progresivo')}}</td>
                    <td class="fondoverde">{{__('LENTE Tratamiento')}}</td>
                    <td class="fondoverde">{{__('LENTE Material')}}</td>
                    <td class="fondoverde">{{__('IVA')}}</td>
                    <td class="fondoverde">{{__('VALOR GRABADO')}}</td>
                    <td class="fondoverde">{{__('VALOR TOTAL')}}</td>
                </tr>
                <tr>	
                    <td>{{__('OD')}}</td>
                    <td>{{$orden->dato2}}</td>
                    <td>{{$orden->dato3}}</td>
                    <td>{{$orden->dato4}}</td>
                    <td>{{$orden->dato5}}</td>
                    <td>{{$orden->dato6}}</td>
                    <td>{{$orden->dato26}}</td>
                    <td>{{$orden->dato27}}</td>
                    <td>{{$orden->dato29}}</td>
                    <td>{{$orden->dato31}}</td>
                    <td style="font-weight: bold; text-align: right">0</td>
                    <td></td>
                    <td style="text-align: right; font-weight: bold">{{$valorTotalOD}}</td>
                </tr>
                <tr>	
                    <td> {{__('OI')}} </td>
                    <td>{{$orden->dato14}}</td>
                    <td>{{$orden->dato15}}</td>
                    <td>{{$orden->dato16}}</td>
                    <td>{{$orden->dato17}}</td>
                    <td>{{$orden->dato18}}</td>
                    <td>{{$orden->dato26}}</td>
                    <td>{{$orden->dato27}}</td>
                    <td>{{$orden->dato29}}</td>
                    <td>{{$orden->dato31}}</td>
                    <td style="font-weight: bold; text-align: right"> 0</td>
                    <td> </td>
                    <td style="text-align: right; font-weight: bold">{{$valorTotalOI}}</td>
                </tr>
                <tr> 
                    <td colspan="2"> {{__('MONTURA')}}</td>
                    <td colspan="9"> {{'Ref: '}} {{$orden->dato33}} </td>				
                    <td style="font-weight: bold; text-align: right"> {{$monturaIva}} </td>
                    <td style="font-weight: bold; text-align: right"> {{$monturaValorGrabado}} </td>
                    <td style="text-align:right; font-weight: bold"> {{$monturaValorTotal}} </td>
                </tr>
                <tr>
                    <td colspan="3">{{__('Producto')}}</td>
                    <td colspan="6">{{__('Descripción')}}</td>
                    <td>{{__('Cantidad')}}</td>
                    <td>{{__('Valor Unitario')}}</td>
                    <td></td><td></td><td></td>
                </tr>
                @foreach ($facturaItems as $facturaItem)
                    <tr>
                        <td style="padding-left: 5px" colspan='3'> {{$facturaItem->producto}} </td>
                        <td style="padding-left: 5px" colspan='6'>{{$facturaItem->descripcion}}</td>
                        <td style="text-align: right" colspan=''>{{$facturaItem->cantidad}}</td>
                        <td style="text-align: right">@php echo number_format($facturaItem->valor_unitario, 0, '.', '.'); @endphp</td>
                    @if ($facturaRango->iva =="")
                        @php
                        $facturaRango->iva = 0.19;  
                        @endphp
                    @endif
                    @if ($facturaItem->iva == "si" || $facturaItem->iva == "Si")
                        @php
                            if (!is_numeric($facturaItem->valor_unitario)) {
                                $facturaItem->valor_unitario = 0;
                            }
                            if (!is_numeric($facturaRango->iva)) {
                                $facturaRango->iva = 0;
                            }
                            if (!is_numeric($facturaItem->cantidad)) {
                                $facturaItem->cantidad = 0;
                            }
                            $ivaFe = $facturaItem->valor_unitario * $facturaRango->iva;
                            $iva_total = $ivaFe * $facturaItem->cantidad;
                            echo "<td class='valores'>" . number_format($iva_total, 0, '.', '.') . "</td>";
                            $valor_grabado = ($facturaItem->valor_unitario * $facturaItem->cantidad) - $iva_total;
                            echo "<td class='valores'>" . number_format($valor_grabado, 0, '.', '.') . "</td>";
                            $totalFe = $valor_grabado + $iva_total;
                            echo "<td class='valores'>" . number_format($totalFe, 0, '.', '.') . "</td>";
                            echo "</tr>";   
                        @endphp
                    @else
                        @php
                            $iva_total = 0;
                            echo "<td class='valores'>" . number_format($iva_total, 0, '.', '.') . "</td>";
                            $valor_grabado = ($facturaItem->valor_unitario * $facturaItem->cantidad) - $iva_total;
                            echo "<td class='valores'>0</td>";
                            $totalFe = $facturaItem->valor_unitario * $facturaItem->cantidad;
                            echo "<td class='valores'>" . number_format($totalFe, 0, '.', '.') . "</td>";
                            echo "</tr>";
                        @endphp
                    @endif
                    @php
                        $acumValorGrabado = $acumValorGrabado + $valor_grabado;
                        $acumIva= $acumIva + $iva_total; 
                    @endphp          
                    @endforeach
                    @php
                        $acumTotal = $acumValorGrabado +  $acumIva;
                        $subTotal = number_format(($acumValorGrabado) , 0, '.', '.') + $subTotal * 1000;
                        $subTotal = number_format(( $subTotal) , 0, '.', '.');
                        $iva = number_format(($acumIva) , 0, '.', '.') + $iva * 1000;
                        $iva = number_format(( $iva) , 0, '.', '.');
                        $total = number_format(( $acumTotal) , 0, '.', '.') + $total * 1000 ;
                        $total = number_format(( $total) , 0, '.', '.');
                    @endphp    
                <tr>
                    <td colspan="3" style=" padding-bottom: 100px;">{{__('Firma, Sello y Fecha del emisor')}}</td>
                    <td colspan="6" style=" padding-bottom: 100px;">{{__('Firma, Sello y Fecha del Comprador')}}</td>
                    <td colspan="2" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:17px">{{__('SUBTOTAL $')}}<br><br>{{__('IVA $')}}<br><br>{{__('TOTAL $')}}</td>
                    <td colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:17px"> 
                    {{$subTotal}}<br><br>
                    {{$iva}}<br><br>
                    {{$total}}
                    </td>
                </tr>
                <tr style=""> 
                    <td colspan="2">{{__('Nro Orden:')}} {{$nOrden}}</td>
                    <td colspan="11">{{__('FACTURA POR COMPUTADOR')}} {{$facturaRango->texto}} </td>
                    <td id="sub">
                        <input id="rrt" type="submit" name="update" style="padding: 14px;" value="GRABAR FACTURA">
                    </td>
                </tr>
            </tbody>
            </table>
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="iva" value="{{ $iva }}">
            <input type="hidden" name="subtotal" value="{{ $subTotal }}">
            <input type="hidden" name="monturaIva" value="{{ $monturaIva }}">
            <input type="hidden" name="monturaValorGrabado" value="{{ $monturaValorGrabado }}">
            <input type="hidden" name="monturaValorTotal" value="{{ $monturaValorTotal }}">
            <input type="hidden" name="valorTotalOI" value="{{ $valorTotalOI }}">
            <input type="hidden" name="valorTotalOD" value="{{ $valorTotalOD }}">
            <input type="hidden" name="notaCredito" value="">
            <script>
                function anchoTablaf(){
                var anchoTabla= document.getElementById('tabla2').offsetWidth;
                document.getElementById('tabla1').style.width = anchoTabla + 'px';
                document.getElementById('tabla3').style.width = anchoTabla + 'px';
                //document.getElementById('rrt').value=anchoTabla;
                }
            </script>
        </form>
    </div>
    {{-- ----------------------------- aqui termina------------------------------- --}}
    <!--   Core JS Files   -->
    <script src="{{ asset('paper') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('paper') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('paper') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="{{ asset('paper') }}/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('paper') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('paper') }}/js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('paper') }}/demo/demo.js"></script>
    <!-- Sharrre libray -->
    <script src="../assets/demo/jquery.sharrre.js"></script>
    
    @stack('scripts')

</body>

</html>