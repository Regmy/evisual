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
    {{-- <div style="width: 100%; height: 100%; background:#525659; display: grid; font-family: Arial">
        <div style="text-align: center; padding-top: 2px">
            <input type="button" onclick="printDiv('divImprimir')" value="imprimir" style="width: 6rem; height: 2rem;" class="boton" />
        </div>
        <div id="divImprimir"> --}}
            {{-- <div style="width: 50rem; height: 60rem; margin-left: auto; margin-right: auto;margin-top: 0.5%; margin-bottom: 1%; background: white; padding: 80px; border: 2px solid #f5f5f5; border: 0px"> --}}
                <div>
                    <table id="tabla1" style="text-align: center">
                        <thead>
                            <tr>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_logo") }}" style="max-height: 120px; max-width:200px; text-align: left" />
                                    </div>
                                </td>
                                <td>
                                    <div class="" style="">
                                        <img src="{{ asset("img/facturas/$facturaRango->imagen_datos") }}"  style="max-height: 100px"/>
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
                <br>
                <div id="Nombre1 debe ser arial tamaño 11">
                    {{ __('Sr(a)')}} <label style="padding-left: 590px">{{ "Itagüi, " . date("d") . " / " . date("m") . " de " . date("Y")}} </label>
                    <br>
                    {{$cliente->dato1}} 
                    <br>
                    {{__('E.S.M.')}}                   
                    <br>
                    <br>
                    <br>
                    <div style="text-align: justify; font-size: 15px; font-stretch: ultra-expanded; font-weight: 200">
                        @if ($tipoCertificado == "EV I")
                            {{__('Este documento certifica que usted ha recibido unos lentes EV I, progresivos avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí que permite obtener buena visión a todas las distancias. Los lentes EV I son unos progresivos quepermiten lograr una excelente relación costo/beneficio.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con un servicio profesional y amable. A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                        @if ($tipoCertificado == "EV II")
                            {{__('Este documento certifica que usted ha recibido unos lentes EV II, progresivos avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí que permite obtener un lente con cómodos campos de visión a todas las distancias para realizar las diferentes actividades con una visión fluida.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con un servicio profesional y amable. A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                        @if ($tipoCertificado == "EV III")
                            {{__('Este documento certifica que usted ha recibido unos lentes EV III, progresivos avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí donde se tienen en cuenta los parámetros únicos de sus ojos y montura para conseguir una adaptación más rápida y fluida, ideal para pacientes exigentes que desean obtener el mayor rendimiento visual con sus lentes.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con un servicio profesional y amable. A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                        @if ($tipoCertificado == "EV IV")
                            {{__('Este documento certifica que usted ha recibido unos lentes EV IV, unos lentes Ocupacionales avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí, permitiendo que el usuario experimente una cómoda visión a distancias intermedias y cercanas, es decir, ver bien al computador, desenvolverse bien en ambientes de oficina o en situaciones donde se requiera una visión hasta 3 metros de distancia.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con un servicio profesional y amable. A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                        @if ($tipoCertificado == "EV B")
                            {{__('Este documento certifica que usted ha recibido unos lentes EVB, unos lentes Bifocales avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí que ha logrado ofrecer un lente bifocal estético y funcional, dejando en el pasado los bifocales que tenían un segmento “como un bolsillo” que hacía ver antiestético el lente y hacia que el usuario tuviera un incómodo salto de imagen. Ahora con EVB es posible usar un lente bifocal elaborado con la última tecnología para que sean lentes atractivos y con buena visión.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con un servicio profesional y amable. A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                        @if ($tipoCertificado == "EV Lente")
                            {{__('Este documento certifica que usted ha recibido unos lentes EVM, unos lentes visión sencilla avanzados elaborados con la sofisticada tecnología Freeform que permite obtener la mayor precisión óptica y de diseño, garantizando así un producto pensado en resolver sus necesidades y expectativas visuales.')}}
                            <br>
                            <br>
                            {{__('Estos lentes han sido desarrollados con última tecnología de diseño Israelí que ha logrado ofrecer un lente visión sencilla más estético y funcional, permitiéndole experimentar una visión nítida, clara y sin complicaciones. Otra ventaja de sus lentes EVM es su diseño atórico que le va permitir disfrutar campos de visión muy amplios y dar la percepción de una visión clara, precisa, extendida y natural.')}}
                            <br>
                            <br>
                            {{__('El procesamiento de estos lentes cuenta con certificado ISO 9001:2015; fueron revisados con base a la norma ISO 21987 de 2018, avalando la excelente calidad de este producto.')}}
                            <br>
                            <br>
                            {{__('Al adquirir estos lentes en nuestras ópticas, Usted también obtiene un servicio de postventa pensado en su satisfacción con  un servicio profesional y amable.  A continuación nuestra política de garantía:')}}
                            <br>
                            {{__('1. Seguimiento de adaptación y soluciones para cada necesidad visual.')}}
                            <br>
                            {{__('2. Para exámenes realizados en nuestros consultorios cuenta con el acompañamiento del Profesional para inquietudes de adaptación.')}}
                            <br>
                            {{__('3. Acompañamiento profesional y asesoría integral a formulaciones externas a nuestros consultorios Evolución Visual.')}}
                        @endif
                    </div>
                    <div style="text-align: justify; font-size: 15px; font-stretch: ultra-expanded; font-weight: 200; overflow-wrap: break-word;">
                        <br>
                        {{$textoCertificado}}
                        <br>
                        <br>
                    </div>
                    <div>
                        <table id="tabla1" class="bordes2" style="border-collapse: collapse; margin: auto">
                            <thead>
                                <tr style="">
                                    <td style="background: #92D050;" colspan="2">
                                        {{__('PRESCRIPCIÓN ÓPTICA')}}
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="background: #D9D9D9; width: 230px; text-align: left; padding-left: 10px">
                                        {{__('Nombre Paciente:')}}
                                    </td>
                                    <td style="width: 441px; text-align: left; padding-left: 10px; font-weight: 200">
                                        {{$cliente->dato1}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background: #D9D9D9; text-align: left; padding-left: 10px">
                                        {{__('Producto que Adquirió:')}}
                                    </td>
                                    <td style="width: 441px; text-align: left; padding-left: 10px; font-weight: 200">
                                        {{$orden->dato26 . " " . $orden->dato27 . " " . $orden->dato31 . " CON " . $orden->dato29}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table id="tabla2" class="bordes2" style="border-collapse: collapse; margin: auto" >
                            <thead>

                            </thead>
                            <tbody>
                                <tr>
                                    <td style="background: #C5E0B3; width: 136px;">
                                        {{__('Rx')}}
                                    </td>
                                    <td style="background: #C5E0B3; width: 136px;">
                                        {{__('Esfera')}}
                                    </td>
                                    <td style="background: #C5E0B3; width: 136px;">
                                        {{__('Cilindro')}}
                                    </td>
                                    <td style="background: #C5E0B3; width: 136px;">
                                        {{__('Eje')}}
                                    </td>
                                    <td style="background: #C5E0B3; width: 136px;">
                                        {{__('Adición')}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background: #D9D9D9;">
                                        {{__('OD')}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato2}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato3}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato4}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato5}}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background: #D9D9D9;">
                                        {{__('OI')}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato14}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato15}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato16}}
                                    </td>
                                    <td style="font-weight: 200">
                                        {{$orden->dato17}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: justify; font-size: 15px; font-stretch: ultra-expanded; font-weight: 200">
                        <br>
                        <br>
                        {{__('Para nosotros es muy importante sus comentarios y sugerencia para el mejoramiento continuo estaremos atentos.')}}
                    </div>
                    <div id="imgfirma" style="position: absolute; top: 770px">
                        <img src="{{ asset("img/facturas/firma_director_tecnicocientifica.png") }}"  style="max-height: 105px"/>
                        <div style="text-align: justify; font-size: 15px; font-stretch: ultra-expanded; font-weight: 500">
                            {{__('Dr. HECTOR FABIAN DUEÑAS MONTAÑA')}}
                            <br>
                            {{__('Director Técnico-Científico')}}
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
        {{-- </div>     --}}
            <script>
                function anchoTablaf(){
                var anchoTabla= document.getElementById('tabla1').offsetWidth;
                document.getElementById('tabla2').style.width = anchoTabla + 'px';
                }
            </script> 
    {{-- </div> --}}
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

        document.body.innerHTML = contenido;
        document.getElementById('imgfirma').style.top="1100px";
       
        window.print();

        document.body.innerHTML = contenidoOriginal;
        
   }
    </script>
</body>

</html>