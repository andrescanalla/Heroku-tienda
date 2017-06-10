@extends ('layouts.admin')
@section ('titulo')  Editar Orden
@endsection
@section ('contenido')
  <div class="row">
    
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif
    
  
    {!!Form::model($orden,['method'=>'PATCH','route'=>['orden.update', $orden->idorden], 'files'=>'true'])!!}
    {{Form::token()}}
           
      <div class="col-lg-2 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
          <label for="orden">Nombre de la orden</label>
          <input type="text" name="orden" required value="{{$orden->orden}}" class="form-control">
        </div>
      </div>
      <div class="col-lg-2 col-sm-12 col-md-12 col-xs-12">
        <div class="form-group">
          <label for="orden">Costo Extra</label>
          <input type="decimal" name="extra" required value="{{$orden->extra}}" class="form-control">
        </div>
      </div>      
      <div class="col-lg-2 col-sm-4 col-md-4 col-xs-11">
        <div class="form-group">
          <label>Pedido</label>
          <select name="id_pedidos" class="form-control">
            @foreach($pedidos as $pr)
              @if($pr->idpedidos==$orden->id_pedidos)
              <option value="{{$pr->idpedidos}}" selected>{{$pr->nombre}} </option>
              @else
              <option value="{{$pr->idpedidos}}">{{$pr->nombre}} </option>
              @endif
            @endforeach
          </select>          
        </div>
      </div>     
      <div class="col-lg-2 col-sm-4 col-md-4 col-xs-11">
        <div class="form-group">
          <label>Marca</label>
          <select name="id_marca" class="form-control">
            @foreach($marca as $pr)
              @if($pr->idmarca==$orden->id_marca)
              <option value="{{$pr->idmarca}}" selected>{{$pr->marca}} </option>
              @else
              <option value="{{$pr->idmarca}}">{{$pr->marca}} </option>
              @endif
            @endforeach
          </select>          
        </div>
      </div>       
      <div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="fecha">Fecha de la orden</label>
          <input type="text" name="fecha"  value="@php$carbon=new\Carbon\Carbon();@endphp @if(!empty($orden->fecha))@php$fd=$carbon->createFromFormat('Y-m-d',$orden->fecha);@endphp{{$fd->format('d/m/Y')}}@endif" class="form-control">
        </div>
      </div> 
    <div class="col-lg-2 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group" style="padding-top:25px">
        <a href="{{ url()->previous() }}" class="btn btn-default" type="reset">Cancelar</a>
         <button class="btn btn-primary" type="submit">Guardar</button>         
      </div>
     </div>
  </div>
    {!!Form::close()!!}

    <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      Detalle de la Orden
      <table class="table table-striped table-bordered table-condensed table-hover" style="text-align: center">
        <thead style="background-color:#A9D0F5">
          
          <th style="text-align: center">Id stock</th>
          <th style="text-align: center">Codebar</th>
          <th style="text-align: center">imagen</th>
          <th style="text-align: center">Producto</th>
          <th style="text-align: center">Style</th>
          <th style="text-align: center">talle</th>
          <!--<th style="text-align: center">Tipo Venta</th>-->
          <th style="text-align: center">Costo</th>
          <th style="text-align: center">Cantidad</th>
          <th style="text-align: center">Opciones</th>
          
        </thead>
       
        
     
            @php $nx=0;@endphp
            @foreach($detaord as $w)                
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
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto ;max-height:500px">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>                  
                 
                  <td style="text-align: center">U$S {{number_format($w->precio,0)}}</td>
                  
                  <td style="text-align: center">{{number_format($w->cant,0)}}</td>
                  <td> 
                     {!!Form::model(Request::all(),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->iddetalleorden]])!!}
                     <input type="hidden" value="1" name="delete">
                     <input type="hidden" value="{{$w->iddetalleorden}}" name="idd">
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
                
                <th style="text-align: center">id Producto</th>
                <th style="text-align: center">Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th style="text-align: center">Producto</th>
                <th style="text-align: center">Style</th>
                <th style="text-align: center">Talle</th> 
                <th style="text-align: center"> Tipo Compra</th>      
                <th style="text-align: center">Precio</th>   
                 <th style="text-align: center">Cantidad</th>                  
                <th style="text-align: center"> Opciones</th>            
              </thead>
              
              <tbody style="text-align: center">
                @php $nn=0;@endphp
                @foreach($articulos as $w)
                
                <tr>
                   {!! Form::model(Request::all(), ['action'=>['DetalleordenController@store', $id],'method'=>'STORE','class'=>'form-inline'])!!}
                   <td><input type="hidden" value="{{$w->idproducto}}" name="idproducto">{{$w->idproducto}}</td>                  
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
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto; max-height:500px">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nn++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>                  
                  <td style="text-align: center;width:120px"> {!! Form::select('tipo',$tipo1,5,['class'=>'form-control','id'=>'prod'])!!}

                  </td>
                  <td style="text-align: center;width:100px"><input name="precio" id="precio" type="number" placeholder="U$S..." class="form-control" required value=""></input></td>
                  <td style="text-align: center; width:100px"><input name="cant" id="cant" type="number" class="form-control" required value=""></input></td>                                                       
                  <td style="text-align: center"> 
                     <input type="hidden" value="{{$orden->idorden}}" name="idorden">
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

       {!! Form::model(Request::only('marca','searchText'), ['route'=>['orden.edit', $id],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
    
      <div class="form-group">
        <label>Codigo de barra o Style</label> 
        <div class="input-group">
          <input type="text" id="searchText" class="form-control" name="searchText" placeholder="Codigo de barra o Style..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        </div>
      </div>
      </div>
      
     <div class="col-lg-9 col-md-2 col-xs-12 ">
       <label>Marca</label> 
      <div class="form-group  form-inline"> 
         
       {!! Form::select('marca',$marca1,null,['class'=>'form-control','id'=>'prod'])!!}
      <button type="submit" class="btn btn-primary">Filtrar</button>       
      </div>
     </div>
</div>
  <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
       Cant: {{$busca->count()}}
      <table class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                <th>idProducto</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th>Style</th>
                <th style="text-align: center">Talle</th>                                
                <th>Album</th>
                <th style="text-align: center">Categoria</th>
                <th>Estacion</th>   
                 <th>Marca</th>                
                <th style="text-align: center"> Opciones</th>              
              </thead>
              
              <tbody id="todo">
                @php $n=0;@endphp
                @foreach($busca as $w)
                
                <tr>
                   <td>{{$w->idproducto}}</td>
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
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto; max-height:500px">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $n++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->tipo}}</td>                                 
                  <td>{{$w->categoria}}</td>
                  <td>{{$w->estacion}}</td>  
                  <td>{{$w->marca}}</td>                                      
                  <td style="text-align: center"> <button type="submit" id="venta" name="venta" class="btn btn-primary btn-sm" value="{{$w->idproducto}}">Seleccionar</button></td>
                </tr>
                @endforeach
                 {!!Form::close()!!}
              </tbody>
            </table>
            
          </div>
    </div>
   </div><!-- /.box-body -->
</div><!-- /.box -->
  
  @endsection

