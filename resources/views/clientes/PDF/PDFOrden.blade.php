<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
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
    {{-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" /> --}}
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files 
    <link href="{{ asset('paper') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('paper') }}/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
     CSS Just for demo purpose, don't include it in your project-->
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
@php
    ini_set('max_execution_time',720);
@endphp
<body onload="anchoTablaf()" class="" style="">
    <!-- Google Tag Manager (noscript)
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
    <!-- End Google Tag Manager (noscript) -->
   {{-- -----------------------------Desde aqui empieza------------------------------- --}}           
        {{-- <div id="divImprimir">
            <div style="width: 50rem; height: 60rem; margin-left: auto; margin-right: auto;margin-top: 0.5%; margin-bottom: 1%; background: white; padding: 5px; border: 2px solid #f5f5f5; border: 0px"> --}}
                <div>
                    <table id="tabla1" style="text-align: center">
                        <thead>
                            <tr>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_logo") }}" style="max-height: 120px; max-width:210px; text-align: left" />
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_datos") }}"  style="max-height: 105px"/>
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="font-size: 12px; color: #18226A; font-weight: bold">
                                        {{__('ORDEN DE PEDIDO')}}
                                        <br>
                                        {{"No." . $nOrden}}
                                        <br>                                       
                                        {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($nOrden, 'EAN13',1.7,75,array(1,1,1), false) . '" alt="barcode"   />'!!}                                                                                                                                                             
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/logo_EV.png") }}"  style="max-height: 100px; text-align: right"/>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div style="font-size: 11px; color: #18226A">
                    <table id="tabla2" class="bordes" style ="width:101%">
                        <tbody style="">
                            <tr>
                                <td class="titulo" colspan="2">{{__('Nombre y Apellidos')}}</td>
                                <td colspan="2">{{$cliente->dato1}} </td>
                                <td class="titulo">{{__('Fecha Elaboración')}}</td>
                                <td class="titulo">{{__('Asesor')}}</td>
                                <td class="titulo">{{__('Fecha Entrega')}}</td>
                                <td class="titulo">{{__('Hora Entrega')}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo">{{__('Documento')}}</td>
                                <td style="min-width: 4rem">{{$cliente->dato2}}</td>
                                <td class="titulo">{{__('Cel-Tel')}}</td>
                                <td style="min-width: 2rem">{{$cliente->dato3}} {{__(' - ')}} {{$cliente->dato4}}</td>
                                <td>{{$orden->fecha}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$orden->dato0}}</td>
                                <td>{{$orden->dato1}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size: 11px; color: #18226A; padding-top: 2px">
                    <table id="tabla3" class="bordes" style ="width:101%">
                        <tbody style="">
                            <tr>
                                <td class="titulo">{{__('RX')}}</td>
                                <td class="titulo">{{__('ESFERA')}}</td>
                                <td class="titulo">{{__('CILINDRO')}}</td>
                                <td class="titulo">{{__('EJE')}}</td>
                                <td class="titulo">{{__('ADICIÓN')}}</td>
                                <td class="titulo">{{__('D.N.P')}}</td>
                                <td class="titulo">{{__('ALTURA')}}</td>
                                <td class="titulo">{{__('PRISMA')}}</td>
                                <td class="titulo">{{__('LENTE')}}</td>
                                <td class="titulo">{{__('LAB')}}</td>
                                <td class="titulo">{{__('No.')}}</td>
                                <td class="titulo">{{__('BISEL')}}</td>
                                <td class="titulo">{{__('LOTE')}}</td>
                            </tr>
                            <tr style="">
                                <td style="font-weight: 700;font-size: 12px;">{{__('OD')}}</td>
                                <td>{{$orden->dato2}}</td>
                                <td>{{$orden->dato3}}</td>
                                <td>{{$orden->dato4}}</td>
                                <td>{{$orden->dato5}}</td>
                                <td>{{$orden->dato6}}</td>
                                <td>{{$orden->dato7}}</td>
                                <td>{{$orden->dato8}}</td>
                                <td>{{$orden->dato9}}</td>
                                <td>{{$orden->dato10}}</td>
                                <td>{{$orden->dato11}}</td>
                                <td>{{$orden->dato12}}</td>
                                <td>{{$orden->dato13}}</td>
                            </tr>
                            <tr style="">
                                <td style="font-weight: 700;font-size: 12px;">{{__('OI')}}</td>
                                <td>{{$orden->dato14}}</td>
                                <td>{{$orden->dato15}}</td>
                                <td>{{$orden->dato16}}</td>
                                <td>{{$orden->dato17}}</td>
                                <td>{{$orden->dato18}}</td>
                                <td>{{$orden->dato19}}</td>
                                <td>{{$orden->dato20}}</td>
                                <td>{{$orden->dato21}}</td>
                                <td>{{$orden->dato22}}</td>
                                <td>{{$orden->dato23}}</td>
                                <td>{{$orden->dato24}}</td>
                                <td>{{$orden->dato25}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size: 11px; color: #18226A">
                    <table id="tabla4" class="bordes" style ="width:101%">
                        <tbody style="">
                            <tr>
                                <td class="titulo">{{__('Lente Tipo')}}</td>
                                <td colspan="3">{{$orden->dato26}} </td>
                                <td class="titulo">{{__('Clase de Progresivo')}}</td>
                                <td colspan="3">{{$orden->dato27}} </td>
                            </tr>
                            <tr style="">
                                <td class="titulo">{{__('Tratamiento')}}</td>
                                <td>{{$orden->dato29}}</td>
                                <td class="titulo">{{__('Color Lente')}}</td>
                                <td>{{$orden->dato30}}</td>
                                <td class="titulo">{{__('Material')}}</td>
                                <td>{{$orden->dato31}}</td>
                                <td class="titulo">{{__('#Almacena')}}</td>
                                <td>{{$orden->dato51}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="font-size: 11px; color: #18226A">
                    <table id="tabla5" class="bordes" style ="width:100%">
                        <tbody style="">
                            <tr>
                                <td class="titulo" colspan="2">{{__('Valores')}}</td>
                                <td class="titulo" colspan="2">{{__('Montura')}}</td>
                                <td class="titulo" colspan="2">{{__('Medidas')}}</td>
                                <td class="titulo">{{__('Medico')}}</td>
                                <td colspan="2">{{$orden->dato32}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Referencia')}}</td>
                                <td class="ancho2">{{$orden->dato33}}</td>
                                <td class="titulo ancho">{{__('Material')}}</td>
                                <td class="ancho2">{{$orden->dato39}}</td>
                                <td class="titulo ancho">{{__('M:Horizontal')}}</td>
                                <td class="ancho2">{{$orden->dato46}}</td>
                                <td class="titulo ancho">{{__('Reparación')}}</td>
                                <td class="titulo ancho">{{__('OD')}}</td>
                                <td class="titulo ancho">{{__('OI')}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Valor Montura')}}</td>
                                <td class="ancho2">{{$orden->dato34}}</td>
                                <td class="titulo ancho">{{__('Tipo')}}</td>
                                <td class="ancho2">{{$orden->dato42}}</td>
                                <td class="titulo ancho">{{__('M:Vetical')}}</td>
                                <td class="ancho2">{{$orden->dato47}}</td>
                                <td class="titulo ancho">{{__('D.Vertice')}}</td>
                                <td>{{$orden->dato52}}</td>
                                <td>{{$orden->dato53}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Valor Lente')}}</td>
                                <td class="ancho2">{{$orden->dato35}}</td>
                                <td class="titulo ancho">{{__('Color')}}</td>
                                <td class="ancho2">{{$orden->dato45}}</td>
                                <td class="titulo ancho">{{__('M:Puente')}}</td>
                                <td class="ancho2">{{$orden->dato48}}</td>
                                <td class="titulo ancho">{{__('Panorámico')}}</td>
                                <td colspan="2" >{{$orden->dato54}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Total')}}</td>
                                <td class="ancho2">{{$orden->dato36}}</td>
                                <td class="titulo ancho">{{__('Nro Factura')}}</td>
                                <td class="ancho2">{{$orden->nro_fact}}</td>
                                <td class="titulo ancho">{{__('M:Diametro')}}</td>
                                <td class="ancho2">{{$orden->dato49}}</td>
                                <td class="titulo ancho">{{__('Pantoscopico')}}</td>
                                <td colspan="2" >{{$orden->dato55}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Abono')}}</td>
                                <td class="ancho2">{{$acumAbono}}</td>
                                <td class="titulo ancho">{{__('Curva Base')}}</td>
                                <td class="ancho2">{{$orden->curva_base}}</td>
                                <td class="titulo ancho">{{__('M:Dist.Mec')}}</td>
                                <td class="ancho2">{{$orden->dato50}}</td>
                                <td class="titulo ancho">{{__(' ')}}</td>
                                <td colspan="2" >{{' '}}</td>
                            </tr>
                            <tr style="">
                                <td class="titulo ancho">{{__('Saldo')}}</td>
                                <td class="ancho2">{{$saldo}}</td>
                                <td class="titulo">{{__('Observaciones')}}</td>
                                <td colspan="6" >{{$orden->dato57}}</td>
                            </tr>
                            <tr style="">
                                <td colspan="4" >{{$facturaRango->texto_devolucion}} </td>
                                <td colspan="4">{{$facturaRango->texto_horarios}} </td>
                                <td colspan="1"></td>
                            </tr>
                        </tbody>
                    </table>
                    <img id="imgplaneta" src="{{ asset("img/facturas/logo_amigos_planeta.png") }}" class="superponer" style="max-height: 105px"/>
                </div>                          
            {{-- </div>
        </div> --}}    
            <script>
                function anchoTablaf(){
                var anchoTabla= document.getElementById('tabla5').offsetWidth;
                document.getElementById('tabla1').style.width = anchoTabla + 'px';
                document.getElementById('tabla2').style.width = anchoTabla + 'px';
                document.getElementById('tabla3').style.width = anchoTabla + 'px';
                document.getElementById('tabla4').style.width = anchoTabla + 'px';
                //document.getElementById('rrt').value=anchoTabla;
                }
            </script> 
    
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
        document.getElementById('imgplaneta').style.top="38em";
        document.getElementById('imgplaneta').style.left="67.1em";
       
        window.print();

        document.body.innerHTML = contenidoOriginal;
        document.getElementById('imgplaneta').style.top="42em";
        document.getElementById('imgplaneta').style.left="85em";
        
   }
    </script>
</body>

</html>