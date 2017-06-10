@extends ('layouts.admin')
@section ('titulo')  Listado de Compras
@endsection
@section ('contenido')
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
    
        @include('compra.detalleorden.search')
      
      </div>
  
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover" id="ex">
        <thead>
          <th>id</th>
          <th>Pedido</th>
          <th>Orden</th>
          <th>Codebar</th>
          <th>Imagen</th>
          <th>Producto</th>
          <th>Talle</th>
          <th>Tipo</th>          
          <th style="text-align: center">Cantidad</th>
          <th style="text-align: center">Precio</th>
          <th style="text-align: center">Check</th>
          <th>Opciones</th>
        </thead>
        @php $n=0;@endphp
        @foreach ($detalle as $sto)
        
        <tr>
          <td>{{$sto->iddetalleorden}}</td>         
          <td>{{$sto->nombre}}</td>
           <td>{{$sto->orden}}</td>
          <td>{{$sto->codebar}}</td>
          <td style="text-align: center"><img src="{{$sto->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$n}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$n}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$sto->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $sto->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $n++; @endphp</td>
          <td>{{$sto->producto}}</td>
          <td>{{$sto->talle}}</td>
           <td>{{$sto->tipo}}</td>
          <td style="text-align: center">{{$sto->cant}}</td>
          <td style="text-align: center">{{$sto->precio}}</td>
          <td style="text-align: center">{{$sto->chequeado}}</td>
          <td>
            <a href="{{URL::action('DetalleordenController@show',$sto->iddetalleorden)}}"><button class="btn btn-primary btn-sm">Detalles</button></a>
            <a href="" data-toggle="modal" data-target="#cModal{{$n}}"><button class="btn btn-info btn-sm">Editar</button></a>             
            <a href="" data-target="#modal-delete-{{$sto->iddetalleorden}}" data-toggle="modal"><button class="btn btn-danger btn-sm">Eliminar</button></a>
          </td>
             <!-- Modal edit-->
                        <div class="modal fade" id="cModal{{$n}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar: {{$sto->producto}} - Id:{{$sto->iddetalleorden}}</h4>
                              </div>
                              <div class="modal-body">
                                  {!!Form::model($sto,['method'=>'PATCH','route'=>['detalleorden.update', $sto->iddetalleorden]])!!}
                                    {{Form::token()}}                                    
                                      
                                        <div class="form-group">
                                          <label>Cantidad</label>
                                           <input type="text" name="cant" required value="{{$sto->cant}}" class="form-control">
                                        
                                     
                                       
                                          <label>Precio</label>
                                           <input type="text" name="precio" required value="{{$sto->precio}}" class="form-control">
                                         </div>
                                          <div class="form-group">
                                             <button class="btn btn-primary" type="submit">Guardar</button>
                                             <button class="btn btn-danger" type="reset" data-dismiss="modal">Cancelar</button>
                                          </div>
                                         
                                      
                                  {!!Form::close()!!}
                              </div>        
                            </div>
                          </div>
                        </div>
        </tr>
        @include('compra.detalleorden.modal')
        @endforeach
      </table>
    </div>
   
  </div>
</div>


@endsection
