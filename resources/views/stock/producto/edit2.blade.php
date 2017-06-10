@extends ('layouts.admin')
@section ('titulo') Editar Productos
@endsection
@section ('contenido')
<div class="row">
   <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    @include('stock.producto.search2')
</div>
<div class="col-lg-7 col-md-4 col-sm-4 col-xs-12">
   {!!Form::model(Request::only(['fil']),['url'=>'producto/edit2','method'=>'GET','autocomplete'=>'off','role'=>'search'])!!}
     <div class="form-group  pull-right">
      
    <div class="form-group form-inline">      
     {{Form::radio('fil', '=')}}
     <label style="padding-right: 10px; padding-left:5px; font-weight:400;">Stock</label>      
    {{Form::radio('fil', '<=', true)}}
     <label style="padding-left:5px; font-weight:400; padding-right: 10px;">Todo</label> 
      <button type="submit" class="btn btn-primary">Filtrar</button>
     </div> 
     
    </div>
    {{Form::close()}} 
  </div> 
  <div class="col-lg-1 col-md-8 col-sm-8 col-xs-6 ">
    <a href="orden/create"><button class="btn btn-default pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
  </div>
  <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    Cant: {{$productos->count()}}
 </div>
  </div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>id</th>
          <th>CodeBar</th>
          <th>imagen</th>
          <th>Producto</th>
          <th>Talle</th>
          <th>Style</th>
          <th>Tipo</th>
          <th>Categoria</th>
          <th>Estacion</th>
          <th>Marca</th>
          <th>Opciones</th>
        </thead>
        @php $nx=0;@endphp
        @foreach ($productos as $pro)
         {!!Form::model($pro,['method'=>'PATCH','route'=>['producto.update', $pro->idproducto]])!!}
        {{Form::token()}}
        <tr>
          <td>{{$pro->idproducto}}</td>
          <td>{{$pro->codebar}}</td>         
          <td style="text-align: center"><img src="{{$pro->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$nx}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$pro->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{$pro->imagen}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp                  
          </td>
          <td>{{$pro->producto}}</td>
          <td>{{$pro->talle}}</td>
          <td>{{$pro->style}}</td>
          <td><select name="Album" class="form-control">
              @foreach($tipo as $es)
              @if($es->idtipo==$pro->id_tipo)
              <option value="{{$es->idtipo}}" selected>{{$es->tipo}} </option>
              @else
              <option value="{{$es->idtipo}}">{{$es->tipo}} </option>
              @endif
              @endforeach
              </select> </td>
          <td><select name="categoria" class="form-control">
              @foreach($categoria as $es)
              @if($es->idcategoria==$pro->id_categoria)
              <option value="{{$es->idcategoria}}" selected>{{$es->categoria}} </option>
              @else
              <option value="{{$es->idcategoria}}">{{$es->categoria}} </option>
              @endif
              @endforeach
              </select> </td>
          <td><select name="estacion" class="form-control">
              @foreach($estacion as $es)
              @if($es->idestacion==$pro->id_estacion)
              <option value="{{$es->idestacion}}" selected>{{$es->estacion}} </option>
              @else
              <option value="{{$es->idestacion}}">{{$es->estacion}} </option>
              @endif
              @endforeach
              </select> </td> 
          <td><select name="marca" class="form-control">
              @foreach($marca as $es)
              @if($es->idmarca==$pro->id_marca)
              <option value="{{$es->idmarca}}" selected>{{$es->marca}} </option>
              @else
              <option value="{{$es->idmarca}}">{{$es->marca}} </option>
              @endif
              @endforeach
            </select></td>
          <td>
            <input name="type" type="hidden" value=1>
            <button class="btn btn-primary" type="submit">Guardar</button>
                    
            
            <a href="" data-target="#modal-delete-{{$pro->idproducto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
          </td>
           {!!Form::close()!!}
        </tr>
        @include('stock.producto.modal')
        @endforeach
      </table>
      
         
    </div>
   
  </div>
</div>


@endsection
