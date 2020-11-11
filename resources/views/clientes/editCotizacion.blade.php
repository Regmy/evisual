@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'editCotizacion'
])

<style>
    .altoFila{
       height: 12rem !important;
   }
   .bordes{
       padding-left: 0px !important;
       padding-right: 0px !important;
   }
   .rotar {
   writing-mode: vertical-lr;
   /*-webkit-transform: rotate(-90deg); 
   -moz-transform: rotate(-90deg);
   -o-transform: rotate(-90deg);*/
   transform: rotate(180deg);
   filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
   }
   .altotexto{
       font-size: 0.8rem !important;
   }
   .observ{
       display: grid;
       height:24.5rem;
   }
   .alinear{
       /*width: 10rem;*/ 
       display: flex;
   }

   .ancho{
       width: 11rem;
   }
   
</style>

@section('content')
   <div class="content">
       <div class="row">
           <div class="col-md-12 text-center">
                <form class="col-md-12" action="{{ route('cotizaciones.update', $cotizacion)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="idCliente" value="{{$cliente->id}}">
                   <div class="card">                      
                       <div class="card-header">
                        @php
                            $part1= explode("-", $cotizacion->fecha);
                            $nroCotizacion= $part1[0].$part1[1].$cotizacion->id;
                        @endphp
                           <h5 class="title">{{ __('Editar Cotización:  No.') }} {{ $nroCotizacion }}</h5>                                                         
                       </div>
                       <div class="card-body">
                           <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">                                
                               <div class="col-6 col-md-2 align-middle pl-1  " style="font-size: 1em" >
                                   <label class="w-75" ><b>{{ __('Fecha Elaboración') }}</b></label>
                                   <br>{{ $cotizacion->fecha }}
                                   <br><label class="pt-2"><b>{{ __('Asesor:') }}</b> <b class="text-dark">{{ $cotizacion->dato58 }}</b></label>
                               </div>                                
                               <div class="col-6 col-md-2 align-middle pl-1" style="font-size: 0.85em">
                                   <label class=""><b>{{ __('Fecha Entrega') }} </b></label>
                                   <br><input style="width: 90%" type="date" name="fechaEntrega" value="<?php echo $cotizacion->dato0; ?>"> 
                                   <br><label class="pt-1"><b>{{ __('Hora Entrega') }}</b></label>
                                   <br><input id="appt-time" type="time" name="horaEntrega" value={{$cotizacion->dato1}}>                       
                               </div>                            
                               <div class="col col-md-8 align-middle pl-1" >
                                   <label class="" ><b style="font-size: 0.85em">{{ __('Datos del Cliente') }}</b></label>
                                   <table class="table table-sm table-responsive-md" style="font-size: 0.75em">
                                       <tr><td ><label class="" ><b style="font-size: 1.2em">{{ __('Nombre:') }}</b></label></td><td colspan='2'>{{ $cliente->dato1 }}</td>
                                           <td ><label class="" ><b style="font-size: 1.2em">{{ __('Documento:') }}</td><td>{{ $cliente->dato2 }}</td></tr>
                                       <tr><td ><label class="" ><b style="font-size: 1.2em">{{ __('Celular:') }}</td><td> {{ $cliente->dato3 }}</td>
                                           <td ><label class="" ><b style="font-size: 1.2em">{{ __('Teléfono:') }}</td><td>{{ $cliente->dato4 }}</td>
                                           <td ><label class="" ><b style="font-size: 1.2em">{{ __('Correo:') }}</td><td>{{ $cliente->dato6 }}</td></tr>
                                   </table>
                               </div>
                           </div>
                       </div>
                       <div class="card-footer ">
                        <div class="row justify-content-center">
                            <div class="col" style="text-align: -webkit-center">
                                <label class="" ><b style="font-size: 1.2em">{{ __('Dirigido a:') }}</b></label> <br>
                                <input type="text" name="dirigido" class="form-control" style="width: auto" placeholder="" value={{$cotizacion->dirigido}} >    
                            </div>
                        </div>
                       </div>
                   </div>                    
                   <div class="card ">
                       <div class="card-header">
                           <h5 class="title">{{ __('Fórmula') }}</h5>
                       </div>
                       <div class="card-body">                                                      
                           <div class="row ">
                               <div class="col-xl-1 col-md-1 col-sm-2 col-2 bordes" > <!-- RX-->
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success " ><label class="w-75" ><b>{{ __('RX') }}</b></label></th>                                           
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary "><label class="w-75" ><b>{{ __('OD') }}</b></label></th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light "><label class="w-75" ><b>{{ __('OI') }}</b></label></th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-3 col-md-4 col-sm-5 col-10 bordes" > <!-- Esfera-->
                                   <table class="table table-bordered">
                                       <thead>
                                         <tr>
                                           <th scope="col"  class="table-success text-capitalize ">
                                               <label class="w-75" ><b>{{ __('Esfera') }}</b></label></th>                                            
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary alinear" >
                                               <div class="form-group ancho">
                                                   <select class="form-control" id="esfera2" type="text" name="esfera2" placeholder="--" value="" onchange="esferadato()">
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->esfera as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('esfera2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('esfera2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function esferadato() {
                                                           document.getElementById("esfera").value = document.getElementById("esfera2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id='esfera' name="esfera"  class="form-control" placeholder="" value={{$cotizacion->dato2}} >    
                                               </div>
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light alinear">
                                               <div class="form-group ancho" >
                                                   <select class="form-control" id="esferai2" type="text" name="esferai2" placeholder="--" value="" onchange="esferaidato()">
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->esfera as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('esferai2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('esferai2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function esferaidato() {
                                                           document.getElementById("esferai").value = document.getElementById("esferai2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="esferai" name="esferai"  class="form-control" placeholder="" value={{$cotizacion->dato14}} >    
                                               </div> 
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>  
                               <div class="col-xl-3 col-md-4 col-sm-5 col-9 bordes" > <!-- Cilindro-->
                                   <table class="table table-bordered">
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Cilindro') }}</b></label>
                                           </th>                                           
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary alinear ">
                                               <div class="form-group ancho" >
                                                   <select class="form-control" id="cilindro2" type="text" name="cilindro2" placeholder="--" value="" onchange="cilindrodato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->cilindro as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('cilindro2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('cilindro2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function cilindrodato() {
                                                           document.getElementById("cilindro").value = document.getElementById("cilindro2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="cilindro" name="cilindro"  class="form-control" placeholder="" value={{$cotizacion->dato3}} >    
                                               </div>  
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light alinear">
                                               <div class="form-group ancho">
                                                   <select class="form-control" id="cilindroi2" type="text" name="cilindroi2" placeholder="--" value="" onchange="cilindroidato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->cilindro as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('cilindroi2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('cilindroi2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function cilindroidato() {
                                                           document.getElementById("cilindroi").value = document.getElementById("cilindroi2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="cilindroi" name="cilindroi"  class="form-control" placeholder="" value={{$cotizacion->dato15}} >    
                                               </div>  
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-1 col-md-3 col-sm-3 col-3 bordes" > <!-- Eje-->
                                   <table class="table table-bordered altoFila" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Eje') }}</b></label>
                                           </th>                                        
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="eje"  class="form-control" placeholder="" value={{$cotizacion->dato4}} >    
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="ejei"  class="form-control" placeholder="" value={{$cotizacion->dato16}} >    
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-3 col-sm-3 col-6 bordes" > <!-- Adicion-->
                                   <table class="table table-bordered">
                                       <thead >
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Adición') }}</b></label>
                                           </th>                                     
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary  ">
                                               <div class="form-group" >
                                                   <select class="form-control" id="adicion" type="text" name="adicion" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato5}}>{{$cotizacion->dato5}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->adicion as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('adicion'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('adicion') }}</strong>
                                                       </span>
                                                    @endif
                                               </div>
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light ">
                                               <div class="form-group " >
                                                   <select class="form-control" id="adicioni" type="text" name="adicioni" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato17}}>{{$cotizacion->dato17}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->adicion as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('adicioni'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('adicioni') }}</strong>
                                                       </span>
                                                    @endif
                                               </div>
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-1 col-md-2 col-sm-2 col-6 bordes" > <!-- D.N.P-->
                                   <table class="table table-bordered altoFila"  >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('D.N.P') }}</b></label>
                                           </th>                                        
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="dnp" class="form-control" placeholder="" value={{$cotizacion->dato6}}>
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="dnpi" class="form-control" placeholder="" value={{$cotizacion->dato18}}>
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-1 col-md-2 col-sm-2 col-6 bordes" > <!-- Altura-->
                                   <table class="table table-bordered altoFila" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label><b>{{ __('Altura') }}</b></label>
                                           </th>                                      
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="altura" class="form-control" placeholder="" value={{$cotizacion->dato7}} >    
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="alturai" class="form-control" placeholder="" value={{$cotizacion->dato19}}>
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-2 col-sm-2 col-6 bordes" > <!-- Prisma-->
                                   <table class="table table-bordered altoFila" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Prisma') }}</b></label>
                                           </th>                                       
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="prisma"  class="form-control" placeholder="" value={{$cotizacion->dato8}}>    
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="prismai" class="form-control" placeholder="" value={{$cotizacion->dato20}}>    
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-3 col-sm-3 col-6 bordes" > <!-- Lente-->
                                   <table class="table table-bordered " >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Lente') }}</b></label>
                                           </th>                                       
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <div class="form-group">
                                                   <select class="form-control p-1" id="lente" type="text" name="lente" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato9}}>{{$cotizacion->dato9}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->lente as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('lente'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('lente') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <div class="form-group">
                                                   <select class="form-control p-1" id="lentei" type="text" name="lentei" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato21}}>{{$cotizacion->dato21}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->lente as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('lentei'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('lentei') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-4 col-sm-3 col-6 bordes"  > <!-- Lab-->
                                   <table class="table table-bordered" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Lab') }}</b></label>
                                           </th>                                           
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <div class="form-group">
                                                   <select class="form-control" id="lab" type="text" name="lab" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato10}}>{{$cotizacion->dato10}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->lab as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('lab'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('lab') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <div class="form-group">
                                                   <select class="form-control" id="labi" type="text" name="labi" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato22}}>{{$cotizacion->dato22}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->lab as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('labi'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('labi') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-2 col-sm-2 col-4 bordes" > <!-- Nro-->
                                   <table class="table table-bordered altoFila" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Nro') }}</b></label>
                                           </th>                                            
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="nro" class="form-control" placeholder="" value={{$cotizacion->dato11}}>    
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="nroi" class="form-control" placeholder="" value={{$cotizacion->dato23}}>
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-4 col-sm-2 col-4 bordes" > <!-- Bisel-->
                                   <table class="table table-bordered" >
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Bisel') }}</b></label>
                                           </th>                                           
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <div class="form-group">
                                                   <select class="form-control" id="bisel" type="text" name="bisel" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato12}}>{{$cotizacion->dato12}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->bisel as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('bisel'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('bisel') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <div class="form-group">
                                                   <select class="form-control" id="biseli" type="text" name="biseli" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato24}}>{{$cotizacion->dato24}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->bisel as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('biseli'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('biseli') }}</strong>
                                                       </span>
                                                    @endif
                                               </div> 
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-xl-2 col-md-2 col-sm-2 col-4 bordes"> <!-- Lote-->
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                         <tr>
                                           <th scope="col" class="table-success text-capitalize">
                                               <label class="w-75" ><b>{{ __('Lote') }}</b></label>
                                           </th>                                            
                                         </tr>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-secondary ">
                                               <input type="text" name="lote" class="form-control" placeholder="" value={{$cotizacion->dato13}}>    
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light">
                                               <input type="text" name="lotei" class="form-control" placeholder="" value={{$cotizacion->dato25}}>    
                                           </th>
                                         </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                           </div>                                                      
                       </div>                        
                   </div>

                   <div class="card ">
                       <div class="card-header">
                           <h5 class="title">{{ __('Lente') }}</h5>
                       </div>
                       <div class="card-body">                                                      
                           <div class="row ">
                               <div class="col-12  col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-info altotexto">
                                               <label class="w-75" ><b>{{ __('Tipo') }}</b></label>
                                               <div class="form-group ">
                                                   <select class="form-control" id="tipol2" type="text" name="tipol2" placeholder="--" value="" onchange="tipoldato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->tipol as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('tipol2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('tipol2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function tipoldato() {
                                                           document.getElementById("tipol").value = document.getElementById("tipol2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="tipol" name="tipol"  class="form-control" placeholder="" value={{$cotizacion->dato26}}>    
                                               </div>
                                           </th>                                            
                                         </tr>  
                                         <tr>
                                           <th scope="row" class="table-primary altotexto">
                                               <label class="w-75" ><b>{{ __('Tratamiento') }}</b></label>
                                               <div class="form-group ">
                                                   <select class="form-control" id="tratamientol2" type="text" name="tratamientol2" placeholder="--" value="" onchange="tratamientoldato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->tratamientol as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('tratamientol2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('tratamientol2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function tratamientoldato() {
                                                           document.getElementById("tratamientol").value = document.getElementById("tratamientol2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="tratamientol" name="tratamientol"  class="form-control" placeholder="" value={{$cotizacion->dato29}}>    
                                               </div>
                                           </th>
                                         </tr>                                         
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-info altotexto">
                                               <label class="w-40" ><b>{{ __('Clase de Progresivo') }}</b></label>
                                               <div class="form-group">
                                                   <select class="form-control" id="claseProgresivol2" type="text" name="claseProgresivol2" placeholder="--" value="" onchange="claseProgresivoldato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->claseProgresivol as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('claseProgresivol2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('claseProgresivol2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function claseProgresivoldato() {
                                                           document.getElementById("claseProgresivol").value = document.getElementById("claseProgresivol2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="claseProgresivol" name="claseProgresivol"  class="form-control" placeholder="" value={{$cotizacion->dato27}}>    
                                               </div>
                                           </th>                                            
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-primary altotexto">
                                               <label class="w-75" ><b>{{ __('Material') }}</b></label>
                                               <div class="form-group">
                                                   <select class="form-control" id="materiall2" type="text" name="materiall2" placeholder="--" value="" onchange="materialldato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->materiall as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('materiall2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('materiall2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function materialldato() {
                                                           document.getElementById("materiall").value = document.getElementById("materiall2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="materiall" name="materiall"  class="form-control" placeholder="" value={{$cotizacion->dato31}}>    
                                               </div>
                                           </th> 
                                         </tr>                                         
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-info altotexto" style="height: 7.7rem">
                                               <label class="w-75" ><b>{{ __('Color LTE') }}</b></label>
                                               <div class="form-group">
                                                   <select class="form-control" id="colorLtel" type="text" name="colorLtel" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato30}}>{{$cotizacion->dato30}}</option>
                                                    <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->colorLtel as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('colorLtel'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('colorLtel') }}</strong>
                                                       </span>
                                                    @endif
                                               </div>
                                           </th>                               
                                         </tr>  
                                         <tr>
                                           <th scope="row" class="table-warning altotexto" style="height: 7.9rem">
                                               <label class="w-75" ><b>{{ __('Invima') }}</b></label>
                                               <input type="text" name="invimal" class="form-control" placeholder="" value={{$cotizacion->dato28}}>    
                                           </th>  
                                         </tr>                                         
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered altoFila">
                                       <thead>
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-warning altotexto" style="height: 4rem" >
                                               <label class="w-75" ><b>{{ __('Médico') }}</b></label>
                                               <div class="form-group">
                                                   <select class="form-control" id="medicol2" type="text" name="medicol2" placeholder="--" value="" onchange="medicoldato()" >
                                                   <option value="">{{__('--')}}</option>
                                                       @foreach ($seleccionables->medicol as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('medicol2'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('medicol2') }}</strong>
                                                       </span>
                                                    @endif
                                                    <script>
                                                       function medicoldato() {
                                                           document.getElementById("medicol").value = document.getElementById("medicol2").value;
                                                       }
                                                   </script>
                                               </div>
                                               <div class="form-group-addon" >
                                                   <input type="text" id="medicol" name="medicol"  class="form-control" placeholder="" value="<?php echo utf8_encode($cotizacion->dato32); ?>">    
                                               </div>
                                           </th>                                            
                                         </tr>  
                                         <tr>
                                           <!--th scope="row" class="table-secondary ">
                                               <label class="w-75" ><b>{{ __('') }}</b></label> 
                                           </th-->
                                         </tr>                                         
                                       </tbody>
                                   </table>
                               </div>
                           </div>                                                      
                       </div>                        
                   </div>

                   <div class="card ">
                       <div class="card-header">
                           <h5 class="title" >{{ __('Descripción') }}</h5>
                       </div>
                       <div class="card-body">  
                           <div class="row">
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered">
                                       <thead>
                                           <!-- -->
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th scope="row" class="table-light altotexto">
                                                   <div>
                                                       <label class="w-75" ><b>{{ __('Referencia') }}</b></label><br>
                                                   </div>
                                                   <div class="form-group">
                                                       <input type="text" name="referenciav" class="form-control" placeholder="" value={{$cotizacion->dato33}}>                                                   
                                                   </div>
                                               </th>
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered">
                                       <thead>
                                           <!-- -->
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th scope="row" class="table-secondary altotexto">
                                                   <div>
                                                       <label class="w-75" ><b>{{ __('Material') }}</b></label><br> 
                                                   </div>                                              
                                                   <div class="form-group">
                                                       <select class="form-control" id="materialv" type="text" name="materialv" placeholder="--" value=""  >                                        
                                                        <option value={{$cotizacion->dato39}}>{{$cotizacion->dato39}}</option>
                                                        <option value="--">{{__('--')}}</option>
                                                        <option value="Acetato">{{__('Acetato')}}</option>
                                                        <option value="Pasta"  >{{__('Pasta')}}</option>
                                                        <option value="Metal"  >{{__('Metal')}}</option>                                               
                                                       </select>                                   
                                                       @if ($errors->has('materialv'))
                                                           <span class="invalid-feedback" style="display: block;" role="alert">
                                                               <strong>{{ $errors->first('materialv') }}</strong>
                                                           </span>
                                                        @endif
                                                   </div>
                                               </th>
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered">
                                       <tr>
                                           <th scope="row" class="table-light altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Tipo') }}</b></label><br> 
                                               </div>                                            
                                               <div class="form-group">
                                                   <select class="form-control" id="tipov" type="text" name="tipov" placeholder="--" value=""  >
                                                    <option value={{$cotizacion->dato42}}>{{$cotizacion->dato42}}</option>
                                                    <option value="--">{{__('--')}}</option>
                                                   <option value="3 Piezas">{{__('3 Piezas')}}</option>
                                                   <option value="Completa"  >{{__('Completa')}}</option>
                                                   <option value="Ranura"  >{{__('Ranura')}}</option>                                               
                                                   </select>                                   
                                                   @if ($errors->has('tipov'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('tipov') }}</strong>
                                                       </span>
                                                    @endif
                                               </div>
                                           </th>
                                         </tr> 
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 col-md-3 bordes">
                                   <table class="table table-bordered">
                                       <tr>
                                           <th scope="row" class="table-secondary altotexto"> 
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Color Mont') }}</b></label><br> 
                                               </div>                                                
                                               <div class="form-group">
                                                   <select class="form-control" id="colorMontm" type="text" name="colorMontm" placeholder="--" value=""  >                                        
                                                    <option value={{$cotizacion->dato45}}>{{$cotizacion->dato45}}</option>
                                                    <option value="--">{{__('--')}}</option>
                                                       @foreach ($seleccionables->colorMontm as $parametro)
                                                           <option value="{{$parametro['option_value']}}">{{$parametro['option_value']}}</option>                                                    
                                                       @endforeach                                               
                                                   </select>                                   
                                                   @if ($errors->has('colorMontm'))
                                                       <span class="invalid-feedback" style="display: block;" role="alert">
                                                           <strong>{{ $errors->first('colorMontm') }}</strong>
                                                       </span>
                                                    @endif
                                               </div>
                                           </th>
                                       </tr>
                                   </table>
                               </div>
                           </div>
                           <div class="row"> 
                               <div class="table-bordered col-12">
                                   <div>
                                       <label class="text-secondary" style="font-size: 1rem"><b>{{ __('Valor') }}</b></label>
                                   </div>
                                   <script>
                                       function addCommas(idEn)
                                       {
                                           var nStr = document.getElementsByName(idEn)[0].value;
                                           nStr += '';
                                           x = nStr.split('.');
                                           x1 = x[0];
                                           x2 = x.length > 1 ? ',' + x[1] : '';
                                           var rgx = /(\d+)(\d{3})/;
                                           while (rgx.test(x1)) {
                                               x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                           }
                                           document.getElementById(idEn + "_n").innerHTML = x1 + x2;
                                           totalvchange();
                                       }
                                   </script>   
                               </div>                   
                               <div class="col-12 col-sm-6 bordes">
                                   <table class="table table-bordered table-light table-sm altoFila">                                        
                                       <thead >                             
                                       </thead>
                                       <tbody>
                                         <tr>
                                           <th scope="row" class="table-light altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Vr.Montura') }}</b></label><br>
                                               </div>
                                           </th>
                                           <th scope="row" class="table-light altotexto pb-0">
                                               <div class="form-group">
                                                   <input type="number" id="vrmonturav" name="vrmonturav" class="form-control" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" onchange="addCommas('vrmonturav')" formnovalidate placeholder="" value={{$cotizacion->dato34}} >                                                   
                                               </div>
                                              <div id="vrmonturav_n" style="color: darkcyan" value="--"></div>
                                           </th>
                                         </tr> 
                                         <tr>
                                           <th scope="row" class="table-secondary altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Vr.Lente') }}</b></label><br>
                                               </div>
                                           </th>
                                           <th scope="row" class="table-secondary altotexto pb-0">
                                               <div class="form-group">
                                                   <input type="number" id="vrlentev" name="vrlentev" class="form-control"  inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" onchange="addCommas('vrlentev')" formnovalidate placeholder="" value={{$cotizacion->dato35}} >                                                   
                                               </div>
                                               <div id="vrlentev_n" style="color: darkcyan" value="--"></div>
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Total') }}</b></label><br>
                                               </div>
                                           </th>
                                           <th scope="row" class="table-light altotexto pb-0">
                                               <div class="form-group">
                                                   <input type="text" id="totalv" name="totalv" class="form-control bg-secondary" placeholder="" readonly value={{$cotizacion->dato36}} >                                                   
                                               </div>
                                               <div id="totalv_n" style="color: darkcyan" value="--"></div>
                                               <script>
                                                   function totalvchange() {
                                                       document.getElementById("totalv").value= +document.getElementById("vrlentev").value
                                                       + +document.getElementById("vrmonturav").value;
                                                       var nStr = document.getElementsByName('totalv')[0].value;
                                                       nStr += '';
                                                       x = nStr.split('.');
                                                       x1 = x[0];
                                                       x2 = x.length > 1 ? ',' + x[1] : '';
                                                       var rgx = /(\d+)(\d{3})/;
                                                       while (rgx.test(x1)) {
                                                           x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                                       }
                                                       document.getElementById('totalv_n').innerHTML = x1 + x2;
                                                       saldovchange();
                                                   }
                                               </script>  
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-secondary altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Abono Inicial') }}</b></label><br>
                                               </div>
                                           </th>
                                           <th scope="row" class="table-secondary altotexto pb-0">
                                               <div class="form-group">
                                                   <input type="number" id="abonoinicialv" name="abonoinicialv" class="form-control bg-secondary" onchange="addCommas('abonoinicialv')"  inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" formnovalidate placeholder="" readonly value={{$cotizacion->dato37}}>                                                   
                                               </div>
                                               <div id="abonoinicialv_n" style="color: darkcyan" value="--"></div>   
                                           </th>
                                         </tr>
                                         <tr>
                                           <th scope="row" class="table-light altotexto">
                                               <div>
                                                   <label class="w-75" ><b>{{ __('Saldo') }}</b></label><br>
                                               </div>
                                           </th>
                                           <th scope="row" class="table-light altotexto pb-0">
                                               <div class="form-group">
                                                   <input type="text" id="saldov" name="saldov" class="form-control bg-secondary" placeholder="" readonly value={{$cotizacion->dato38}}>                                                   
                                               </div>
                                               <div id="saldov_n" style="color: darkcyan" value="--"></div>
                                               <script>
                                                   function saldovchange() {
                                                       document.getElementById("saldov").value = +document.getElementById("totalv").value
                                                        - +document.getElementById("abonoinicialv").value;
                                                       var nStr = document.getElementsByName('saldov')[0].value;
                                                       nStr += '';
                                                       x = nStr.split('.');
                                                       x1 = x[0];
                                                       x2 = x.length > 1 ? ',' + x[1] : '';
                                                       var rgx = /(\d+)(\d{3})/;
                                                       while (rgx.test(x1)) {
                                                           x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                                       }
                                                       document.getElementById('saldov_n').innerHTML = x1 + x2;
                                                   }
                                               </script>     
                                           </th>
                                         </tr>                               
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 bordes">
                                   <table class="table table-bordered">
                                       <thead>                                          
                                       </thead>
                                       <tbody>
                                           <tr  class="table-secondary altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('#Almacena/') }}</b></label>  
                                               </th> 
                                               <th scope="row" class="table-secondary altotexto">                                               
                                                   <div class="form-group">
                                                       <input type="text" name="nroAlmacenm" class="form-control" placeholder="" value={{$cotizacion->dato51}}>
                                                   </div>
                                               </th>                                           
                                           </tr> 
                                           <tr  class="table-light altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Nro. Remisión') }}</b></label>
                                               </th> 
                                               <th>                                               
                                                   <div class="form-group">
                                                       <input type="text" name="nroRemisionm" class="form-control" placeholder="" value={{$cotizacion->dato56}}>
                                                   </div>
                                               </th>                                           
                                           </tr> 
                                           <tr>
                                               <th scope="row" class="table-secondary altotexto">
                                                   <label class="w-75" ><b>{{ __('Nro') }} <br> {{ __('Factura') }}</b></label>
                                               </th>
                                               <th scope="row" class="table-secondary">
                                                   <div class="form-group">
                                                       <input type="text" name="nroFacturav" class="form-control" placeholder="" value={{$cotizacion->nro_fact}}>                                                   
                                                   </div>    
                                               </th>
                                             </tr>                                          
                                       </tbody>
                                   </table>
                               </div>
                           </div>                                                                                                                
                           <div class="row">
                               <div class="table-bordered col-12">
                                   <div>
                                       <label class="text-secondary" style="font-size: 1rem"><b>{{ __('Medidas') }}</b></label>
                                   </div>
                               </div>                             
                               <div class="col-12 col-sm-6 bordes">
                                   <table class="table table-bordered table-sm altoFila">                                        
                                       <thead>                                          
                                       </thead>
                                       <tbody>
                                           <tr class="table-light altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Horizontal') }}</b></label>
                                               </th>
                                               <th>
                                                   <div class="form-group">
                                                       <input type="text" name="horizontalm" class="form-control" placeholder="" value={{$cotizacion->dato46}}>
                                                   </div>
                                               </th>
                                           </tr>
                                           <tr class="table-secondary altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Vertical') }}</b></label>
                                               </th>
                                               <th>
                                                   <div class="form-group">
                                                       <input type="text" name="verticalm" class="form-control" placeholder="" value={{$cotizacion->dato47}}>
                                                   </div>
                                               </th>
                                           </tr>
                                           <tr class="table-light altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Puente') }}</b></label>
                                               </th>
                                               <th>
                                                   <div class="form-group">
                                                       <input type="text" name="puentem" class="form-control" placeholder="" value={{$cotizacion->dato48}}>
                                                   </div>
                                               </th>
                                           </tr>
                                           <tr class="table-secondary altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Diagonal') }}</b></label>
                                               </th>
                                               <th>
                                                   <div class="form-group">
                                                       <input type="text" name="diagonalm" class="form-control" placeholder="" value={{$cotizacion->dato49}}>
                                                   </div>
                                               </th>
                                           </tr>
                                           <tr class="table-light altotexto">
                                               <th>
                                                   <label class="w-75" ><b>{{ __('Dist') }} <br> {{ __('Mecánica') }}</b></label>
                                               </th>
                                               <th>
                                                   <div class="form-group">
                                                       <input type="text" name="distMecanicam" class="form-control" placeholder="" value={{$cotizacion->dato50}}>
                                                   </div>    
                                               </th>
                                           </tr>                                        
                                       </tbody>
                                   </table>
                               </div>
                               <div class="col-12 col-sm-6 bordes">
                                   <table class="table table-bordered">
                                       <thead>                                          
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <th class="table-secondary altotexto">
                                                   <label class="w-75" ><b>{{ __('D.') }} <br> {{ __('Vertice') }} </b></label>
                                               </th> 
                                               <th class="table-secondary p-0">                                                
                                                   <table class=" table-sm" style="height: 4.6rem">
                                                       <tr class="altotexto table-secondary">
                                                           <th>
                                                               <div class="form-group h-50" style="margin-bottom: 2px">
                                                                   <label class="w-75" ><b>{{ __('OD') }}</b></label>
                                                               </div>
                                                           </th>
                                                           <th>
                                                               <div class="form-group h-50" style="margin-bottom: 2px">
                                                                   <label class="w-75" ><b>{{ __('OI') }}</b></label>
                                                               </div>
                                                           </th>
                                                       </tr>
                                                       <tr class="altotexto table-secondary">
                                                           <th class="p-0">
                                                               <div class="form-group" style="margin-bottom: 2px">
                                                                   <input type="text" name="dVerticeODm" class="form-control" placeholder="" value={{$cotizacion->dato52}}>
                                                               </div>
                                                           </th>
                                                           <th class="p-0">
                                                               <div class="form-group" style="margin-bottom: 2px">
                                                                   <input type="text" name="dVerticeOIm" class="form-control" placeholder="" value={{$cotizacion->dato53}}>
                                                               </div>
                                                           </th>
                                                       </tr>                                                    
                                                   </table>
                                               </th>                                           
                                             </tr>
                                             <tr  class="table-light altotexto">
                                               <th>
                                                   <label class="" ><b>{{ __('Panorámico') }} </b></label>
                                               </th> 
                                               <th>                                               
                                                   <div class="form-group">
                                                       <input type="text" name="panoramicom" class="form-control" placeholder="" value={{$cotizacion->dato54}}>
                                                   </div>
                                               </th>                                           
                                             </tr>
                                             <tr  class="table-secondary altotexto">
                                               <th>
                                                   <label class="" ><b>{{ __('Pantoscopico') }} </b></label>
                                               </th> 
                                               <th class="table-secondary">                                               
                                                   <div class="form-group">
                                                       <input type="text" name="pantoscopicom" class="form-control" placeholder="" value={{$cotizacion->dato55}}>
                                                   </div>
                                               </th>                                           
                                             </tr>
                                             <tr  class="table-light altotexto">
                                               <th>
                                                   <label class="" ><b>{{ __('Curva Base') }}</b></label>
                                               </th> 
                                               <th>                                               
                                                   <div class="form-group">
                                                       <input type="text" name="curvaBase" class="form-control" placeholder="" value={{$cotizacion->curva_base}}>
                                                   </div>
                                               </th>                                           
                                             </tr>                                        
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                           <div class="row" style="display: inline-flex">
                            <label class="" ><b>{{ __('Estado de La Cotización:') }}</b></label>
                            <label class="pl-2" style="color: limegreen" ><b>{{ __($cotizacion->dato59) }}</b></label>
                            <input type="hidden" name="estadoCotizacion" value={{ __($cotizacion->dato59) }}>
                            <div class="col-12 px-1 px-md-5" style="max-height: 8rem">                                                                         
                             </div>
                        </div>                                    
                           <div class="row" style="display: contents">
                               <div class="col-12 px-1 px-md-5" style="max-height: 8rem">
                                   <label class="w-75" ><b>{{ __('Observaciones') }}</b></label>
                                   <br>
                                   <div class="form-group observ">
                                       <textarea class="form-control" name="observaciones" aria-label="With textarea">{{$cotizacion->dato57}}</textarea>
                                   </div>                                        
                               </div>
                               <div class="col-12 px-1 px-md-5" style="max-height: 8rem">
                                    <label class="w-75" ><b>{{ __('Observaciones Laboratorio') }}</b></label>
                                    <br>
                                    <div class="form-group observ">
                                        <textarea class="form-control" name="observacionlab" aria-label="With textarea">{{$cotizacion->obs_lab}}</textarea>
                                    </div>                                        
                                </div>
                           </div>                                                              
                       </div>
                       <div class="card-footer ">
                           <div class="row">
                               <div class="col-md-12 text-center">
                                   <button type="submit" class="btn btn-info btn-round">{{ __('Actualizar Cotización') }}</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </form>                
           </div>
       </div>
   </div>
   <script>
          window.onload = function() {
            addCommas('vrmonturav');
            addCommas('vrlentev');
            addCommas('abonoinicialv');
          };
   </script>
@endsection