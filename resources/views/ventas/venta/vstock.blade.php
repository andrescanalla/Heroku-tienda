@extends ('layouts.admin')
@section ('titulo') Venta
@endsection
@section ('contenido')
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
    </div>
    @endif
  </div>
</div>
<div class="row">
  
 {!!Form::model($venta,['method'=>'PATCH','route'=>['venta.update', $venta->idventa]])!!}
  {{Form::token()}}
  <div class="col-lg-2 col-md-5 col-xs-12">
    <label>Cliente</label>
    <div class="form-group form-inline">   
      <select id="idpersona" name="idpersona" class="form-control selectpicker form-inline" data-live-search="true">                       
        @foreach($personas as $per)
          @if($per->idpersona==$venta->idpersona)
          <option value="{{$per->idpersona}}" selected>{{$per->usuario}} </option>
          @else
          <option value="{{$per->idpersona}}">{{$per->usuario}} </option>
          @endif
        @endforeach
      </select>
                       
    </div>
  </div>

<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">
       <label>Fecha Venta</label>       
       <input  name="fecha" class="form-control" value="@php $f=new Carbon\Carbon();$fv=$f->createFromFormat('Y-m-d',$venta->fecha); @endphp{{$fv->format('d/m/Y')}}">
    </div>
</div> 

<div class="col-lg-3 col-md-5 col-xs-12">
    <label>Tipo de venta</label>
    <div class="form-group form-inline">   
      <select id="tventa" name="tventa" class="form-control selectpicker form-inline" data-live-search="true">                       
                  <option value="1" selected>Stock</option>
         
      </select>
                       
    </div>
  </div>

<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">      
      <label>Estado Venta</label>
      <select type="text" name="estado"class="form-control" value="{{$venta->estado}}">
        @if($venta->estado=="confirmada")
        <option value="confirmada" selected>1 - confirmada</option>
        <option value="contactada">2 - contactada </option>
        <option value="entregada">3 - entregada </option>
        @elseif($venta->estado=="contactada")
        <option value="confirmada">1 - confirmada</option>
        <option value="contactada" selected>2 - contactada </option>
        <option value="entregada">3 - entregada </option>
        @else
        <option value="confirmada">1 - confirmada</option>
        <option value="contactada">2 - contactada </option>
        <option value="entregada" selected>3 - entregada </option> 
        @endif   
      </select>     
    </div>
</div> 


    <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group pull-right" style="margin-top:25px">       
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>
      </div>
       {!!Form::close()!!}
    </div>
  
   

</div> 

  
   <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      Detalle de Ventas
      <table class="table table-striped table-bordered table-condensed table-hover" style="text-align: center">
        <thead style="background-color:#A9D0F5">
          
          <th style="text-align: center">Id stock</th>
          <th style="text-align: center">Codebar</th>
          <th style="text-align: center">imagen</th>
          <th style="text-align: center">Producto</th>
          <th style="text-align: center">Style</th>
          <th style="text-align: center">talle</th>
          <!--<th style="text-align: center">Tipo Venta</th>-->
          <th style="text-align: center">Precio</th>
          <th style="text-align: center">Opciones</th>
          
        </thead>
       
        
     
            @php $nx=0;@endphp
            @foreach($detaven as $w)                
                <tr>
                  <td>{{$w->idstock}}</td>  
                  <td>{{$w->codebar}}</td>                                 
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModalll{{$nx}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModalll{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>                  
                  <!--<td style="text-align: center">{{$w->id_pedidos}}</td>-->
                  <td style="text-align: center">{{$w->precio_venta}}</td>
                  <td>
                     {!!Form::model(Request::all(),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleventa.destroy', $w->iddetalleventa, $w->idstock]])!!}
                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                     {!!Form::close()!!}
                  </td>               
                  
                </tr>
                @endforeach
                 </table>
              </div> 
            </div> 
    
<div class="row">
       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      <table class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#F9D0F5">
                
                <th style="text-align: center">idStock</th>
                <th style="text-align: center">Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th style="text-align: center">Producto</th>
                <th style="text-align: center">Style</th>
                <th style="text-align: center">Talle</th> 
                <!--<th style="text-align: center"> Tipo Venta</th>-->       
                <th style="text-align: center"> Precio</th>                  
                <th style="text-align: center"> Opciones</th>            
              </thead>
              
              <tbody style="text-align: center">
                @php $nn=0;@endphp
                @foreach($articulos as $w)
                
                <tr>
                   {!! Form::model(Request::all(), ['action'=>['DetalleventaController@store', $id],'method'=>'STORE','class'=>'form-inline'])!!}
                   <td><input type="hidden" value="{{$w->idstock}}" name="idstock">{{$w->idstock}}</td>
                   <td><input type="hidden" value="{{$id}}" name="idventa">{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModall{{$nn}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModall{{$nn}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nn++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                
                  <td style="text-align: center"><input name="precio" id="precio" type="number" required value=""></input></td>                                                     
                  <td style="text-align: center"> 
                    
                    <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                    {!!Form::close()!!}
                  </td>
                   
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
         </div> 

<div class="box">
 <div class="box-header with-border">
   <h3 class="box-title">Buscar Productos</h3>
    <div class="box-tools pull-right">
     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
 
  <!-- /.box-header -->
 <div class="box-body">
   <div class="row">
     <div class="col-lg-3 col-md-4 col-xs-12">

       {!! Form::model(Request::only('type','searchText','talle','prod','ped','venta'), ['route'=>['venta.edit', $id],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
    
      <div class="form-group">
        <label>Codigo de barra o Style</label> 
        <div class="input-group">
          <input type="text" id="searchText" class="form-control" name="searchText" placeholder="Codigo de barra..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        </div>
      </div>
      </div>
      <div class="col-lg-2 col-md-4 col-xs-12">
        </div>
     <div class="col-lg-2 col-md-2 col-xs-12 ">
      <div class="form-group  pull-right"> 
      <label>Producto</label>     
       {!! Form::select('prod',$prod1,null,['class'=>'form-control','id'=>'prod'])!!}
               
      </div>
     </div>

  <div class="col-lg-2 col-md-2 col-xs-12 ">
    <div class="form-group  pull-right"> 
    <label>Talle</label>     
    {!! Form::select('talle',$talle2,null,['class'=>'form-control','id'=>'talle'])!!}
                
  </div>
  </div>
  
  <div class="col-lg-3 col-md-2 col-xs-12 "> 
   <div class="form-group  pull-right"> 
  <label>Orden</label>       
    <div class="form-group form-inline"> 
      {!! Form::select('type',$orden2,null,['class'=>'form-control','id'=>'type'])!!}
      <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
  </div>
  </div>    
  
</div>
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
       Cant: {{$busca->count()}}
      <table class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                <th>idStock</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th>Style</th>
                <th style="text-align: center">Talle</th>                                
                <th>Orden</th>
                <th style="text-align: center">Pedido</th>
                <th>estado</th>                
                <th style="text-align: center"> Opciones</th>              
              </thead>
              
              <tbody id="todo">
                @php $n=0;@endphp
                @foreach($busca as $w)
                
                <tr>
                   <td>{{$w->idstock}}</td>
                   <td>{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$n}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$n}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $n++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->orden}}</td>                                 
                  <td>{{$w->nombre}}</td>
                  <td>{{$w->estado}}</td>                                      
                  <td style="text-align: center"> <button type="submit" id="venta" name="venta" class="btn btn-primary btn-sm" value="{{$w->idstock}}">Seleccionar</button></td>
                </tr>
                @endforeach
                 {!!Form::close()!!}
              </tbody>
            </table>
            
          </div>
    </div>
   </div><!-- /.box-body -->
</div><!-- /.box -->

    

   
  <!-- @push('script')
  <script>
  $(document).ready(function(){
    $('#bt_add').click(function(){
      agregar();
    });
  });

  var cont=0;
  total=0;
  subtotal=[];
  $('#guardar').hide();

  function agregar(){
    idproducto=$('#pidproducto').val();
    producto=$('#pidproducto option:selected').text();
    precio=$('#pprecio').val();

    if (idproducto!=""&& precio!=""){
      subtotal[cont]=(precio);
      total=total+subtotal[cont];

      var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td></td><td></td><td><input type="hidden" name"idproducto[]" value="'+idproducto+'">'+producto+'</td><td></td><td><input type="number" name"precio[]" value="'+precio+'"></td>'+subtotal[cont]+'<td></td></tr>';
      cont++;
      limpiar();
      $('#total').html("US$"+total);
      evaluar();
      $('#detalles').append(fila);
    }
    else{
      alert("error ingresar precio y articulo");
    }

  }

  function limpiar(){
    $("#pprecio").val("");
  }
  function evaluar(){
    if (total>0){
      $("#guardar").show();
    }
    else{
      $("#guardar").hide();
    }
  }
  function eliminar(index){
    total=total-subtotal[index];
    $('#total').html("US$"+total);
    $("#fila"+index).remove();
    evaluar();
  }
  </script>
  @endpush -->
@endsection
