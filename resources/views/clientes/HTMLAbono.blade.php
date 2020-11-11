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
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" /-->
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
     {{-- CSS Just for demo purpose, don't include it in your project> --}}
    <link href="{{ asset('paper') }}/css/estilos-PDF.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/demo/demo.css" rel="stylesheet" />

    <!-- Google Tag Manager -->
    <!--<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NKDMSK6');</script>-->
    <!-- End Google Tag Manager -->
</head>
<body onload="anchoTablaf()" class="" style="">
    <!-- Google Tag Manager (noscript)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
   {{-- -----------------------------Desde aqui empieza------------------------------- --}}
    <div style="width: 100%; height: 100%; display: grid">
        <div style="text-align: center; padding-top: 2px">
            <a href="" onclick="printDiv('divImprimir')" value="imprimir" style="width: 6rem; height: 2rem; color: #525659" >
                <i class="nc-icon nc-paper" style="width: 10rem">
                {{ __('Imprimir') }}
                </i>
            </a>
            {{-- <input type="button" onclick="printDiv('divImprimir')" value="imprimir" style="width: 6rem; height: 2rem;" class="boton" /> --}}
        </div>
        <div id="divImprimir">
            <div style="width: 50rem; height: 60rem; margin-left: auto; margin-right: auto;margin-top: 0.5%; margin-bottom: 1%; background: white; padding: 5px; border: 2px solid #f5f5f5; border: 0px">                
                <div>
                    <table id="tabla1" style="text-align: center">
                        <thead>
                            <tr>
                                <td>
                                    <div class="" style="width:140px">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_logo") }}" style="max-height: 120px; max-width:210px; text-align: left" />
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_datos") }}"  style="max-height: 105px"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="" >
                                        <label class="m-0" style="font-size: 14px; color: #404040"> {{'RECIBO DE CAJA No.'}} </label>
                                        <br/>
                                        <label style="font-size: 14px"> {{$factura->factura_numero}} </label>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div style="font-size: 11px; color: #404040; padding-bottom: 5px">
                    <label>
                        {{__('CLIENTE: ')}}
                        {{ $cliente->dato1 }}
                        {{__('| DOC: '). $cliente->dato2}}
                        {{__('| DIR: '). $cliente->dato7}}
                        {{__('| TEL: '). $cliente->dato3}}
                        {{__('| E-MAIL: '). $cliente->dato6}}
                    </label>
                </div>
                <div style="font-size: 11px; color: #404040">
                    <table id="tabla2" class="bordes3">
                        <tbody style="">
                            <tr>
                                <td class="titulo" colspan="2">{{__('FECHA FACTURA')}}</td>
                                <td colspan="2">{{$factura->fecha_factura}} </td>
                                <td class="titulo">{{__('FORMA DE PAGO')}}</td>
                                <td colspan="2">{{$factura->forma_de_pago}} </td>
                                <td class="titulo">{{__('FECHA VENCE')}}</td>
                                <td colspan="2">{{$factura->fecha_vencimiento}} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size: 11px; color: #404040;">
                    <table class="bordes3" style="width: -webkit-fill-available;" id="tabla3">
                        <tbody style="font-weight: normal">
                            <tr>
                                <td class="titulo" colspan="6">{{__('FÓRMULA')}}</td>
                                <td class="titulo" colspan="7">{{__('LENTE')}}</td>
                            </tr>
                            <tr> 
                                <td class="titulo" style="width: 8%;">{{__('RX')}}</td>
                                <td class="titulo">{{__('Esfera')}}</td> 
                                <td class="titulo">{{__('Cilindro')}}</td>
                                <td class="titulo" style="width: 7%;">{{__('Eje')}}</td>
                                <td class="titulo">{{__('Adición')}}</td>
                                <td class="titulo">{{__('D.N.P.')}}</td>
                                <td class="titulo">{{__('Tipo')}}</td>
                                <td class="titulo">{{__('Clase Progresivo')}}</td>
                                <td class="titulo">{{__('Tratam')}}</td>
                                <td class="titulo">{{__('Material')}}</td>
                                <td class="titulo">{{__('IVA')}}</td>
                                <td class="titulo">{{__('Vr.Grabado')}}</td>
                                <td class="titulo">{{__('Vr.Total')}}</td>
                            </tr>
                            <tr>	
                                <td class="">{{__('OD')}}</td>
                                <td class="">{{$orden->dato2}}</td>
                                <td class="">{{$orden->dato3}}</td>
                                <td class="">{{$orden->dato4}}</td>
                                <td class="">{{$orden->dato5}}</td>
                                <td class="">{{$orden->dato6}}</td>
                                <td class="">{{$orden->dato26}}</td>
                                <td class="">{{$orden->dato27}}</td>
                                <td class="">{{$orden->dato29}}</td>
                                <td class="">{{$orden->dato31}}</td>
                                <td style="font-weight: bold; text-align: right">0</td>
                                <td></td>
                                <td style="text-align: right; font-weight: bold">{{$valorTotalOD}}</td>
                            </tr>
                            <tr>	
                                <td class=""> {{__('OI')}} </td>
                                <td class="">{{$orden->dato14}}</td>
                                <td class="">{{$orden->dato15}}</td>
                                <td class="">{{$orden->dato16}}</td>
                                <td class="">{{$orden->dato17}}</td>
                                <td class="">{{$orden->dato18}}</td>
                                <td class="">{{$orden->dato26}}</td>
                                <td class="">{{$orden->dato27}}</td>
                                <td class="">{{$orden->dato29}}</td>
                                <td class="">{{$orden->dato31}}</td>
                                <td style="font-weight: bold; text-align: right"> 0</td>
                                <td> </td>
                                <td style="text-align: right; font-weight: bold">{{$valorTotalOI}}</td>
                            </tr>
                            <tr style="height: 2rem"> 
                                <td class="titulo" colspan="6"> {{__('MONTURA')}}</td>
                                <td class="titulo" colspan="4"> {{'Referencia: '}} {{$orden->dato33}} </td>				
                                <td style="font-weight: bold; text-align: right"> {{$monturaIva}} </td>
                                <td style="font-weight: bold; text-align: right"> {{$monturaValorGrabado}} </td>
                                <td style="text-align:right; font-weight: bold"> {{$monturaValorTotal}} </td>
                            </tr> 
                            @if ($facturaItemsExist == true)
                                <tr>
                                    <td class="titulo" colspan="3">{{__('Producto')}}</td>
                                    <td class="titulo" colspan="5">{{__('Descripción')}}</td>
                                    <td class="titulo">{{__('Cantidad')}}</td>
                                    <td class="titulo">{{__('Valor Unitario')}}</td>
                                    <td style="border-right: 0px"></td>
                                    <td style="border-right: 0px; border-left: 0px"></td>
                                    <td style="border-left: 0px"></td>
                                </tr>           
                            @endif
                            @foreach ($facturaItems as $facturaItem)
                                <tr>
                                <td style="padding-left: 5px" colspan='3'> {{$facturaItem->producto}} </td>
                                <td style="padding-left: 5px" colspan='5'>{{$facturaItem->descripcion}}</td>
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
                                <td class="titulo altura2" colspan="4" >{{__('Firma, Sello y Fecha del emisor')}}</td>
                                <td class="titulo" colspan="4" style=" ">{{__('Firma, Sello y Fecha del Comprador')}}</td>
                                <td class="titulo" colspan="3" style=" padding-rigth: 0px; text-align: right; font-weight: bold; font-size:16px">
                                    {{__('SUBTOTAL')}}
                                </td>
                                <td colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:16px"> 
                                    {{$subTotal}}
                                </td>
                            </tr>
                            <tr>
                                <td class="altura2" colspan="4" style="border-bottom: 0px"></td>
                                <td colspan="4" style="border-bottom: 0px"></td>
                                <td class="titulo" colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:16px">
                                    {{__('IVA')}}
                                </td>
                                <td colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:16px"> 
                                    {{$iva}}
                                </td>
                            </tr>
                            <tr>
                                <td class="altura2" colspan="4" style="border-top: 0px"></td>
                                <td colspan="4" style="border-top: 0px"></td>
                                <td class="titulo" colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:16px">
                                    {{__('TOTAL')}}
                                </td>
                                <td colspan="3" style=" padding-top: 0px; text-align: right; font-weight: bold; font-size:16px"> 
                                    {{$total}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size: 11px; color: #404040; padding-top: 4px">
                    <table id="tabla5" class="bordes3">
                        <tbody style="">
                            <tr style="height: 2rem">
                                <td colspan="4" class="titulo">
                                    {{__('Abonos')}}
                                </td>
                            </tr>
                            <tr>
                                <td class="titulo" style="border-right: 0px">
                                    {{__('FECHA')}}
                                </td>
                                <td class="titulo" style="border-right: 0px; border-left: 0px">
                                    {{__('| VALOR')}}
                                </td>
                                <td class="titulo" style="border-right: 0px; border-left: 0px">
                                    {{__('| #CAJA')}}
                                </td>
                                <td class="titulo" style="border-left: 0px">
                                    {{__('| FORMA PAGO')}}
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 0px; padding-left: 5px">
                                    {{$orden->fecha}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ')}} {{$orden->dato37}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ')}} {{$orden->id}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ABONO INICIAL')}}
                                </td>
                            </tr>
                            @foreach ($abonos as $abono)
                            <tr>
                                <td style="border: 0px; padding-left: 5px">
                                    {{$abono->fecha}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ')}} {{$abono->valor}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ')}} {{$abono->id}}
                                </td>
                                <td style="border: 0px; padding-left: 5px">
                                    {{__('| ')}} {{$abono->tipo_pago}}
                                </td>
                            </tr>
                            @endforeach
                            <tr style="height: 2rem;">
                                <td class="titulo" style="border-right: 0px ;font-size: 14px">
                                    {{__('Total Abonos')}}
                                </td>
                                <td class="titulo" style="border: 0px; padding-left: 5px; font-size: 14px">
                                    {{__('| ')}} {{$acumAbono}}
                                </td>
                                <td class="titulo" style="border: 0px; padding-left: 5px ;font-size: 14px">
                                    {{__('Saldo')}}
                                </td>
                                <td class="titulo" style="border: 0px; padding-left: 5px ;font-size: 14px">
                                    {{__('| ')}} {{$saldoTotal}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    
            <script>
                function anchoTablaf(){
                var anchoTabla= document.getElementById('tabla3').offsetWidth;
                document.getElementById('tabla1').style.width = anchoTabla + 'px';
                document.getElementById('tabla2').style.width = anchoTabla + 'px';
                document.getElementById('tabla5').style.width = anchoTabla + 'px';
                // document.getElementById('tabla4').style.width = anchoTabla + 'px';
                //document.getElementById('rrt').value=anchoTabla;
                }
            </script> 
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
    <script>
        function printDiv(nombreDiv) {
            
        var contenido= document.getElementById(nombreDiv).innerHTML;
        var contenidoOriginal= document.body.innerHTML;

       /*  var ventana = window.open('', 'PRINT', 'height=400,width=600'); */

        document.body.innerHTML = contenido;
        anchoTablaf();
        // document.getElementById('imgplaneta').style.top="45em";
        // document.getElementById('imgplaneta').style.left="67.1em";
       
        window.print();

        document.body.innerHTML = contenidoOriginal;
        // document.getElementById('imgplaneta').style.top="50em";
        // document.getElementById('imgplaneta').style.left="85em";
        
   }
    </script>
</body>

</html>