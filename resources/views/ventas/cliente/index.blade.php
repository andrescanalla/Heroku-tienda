@extends ('layouts.admin')
@section ('titulo')  
 <span class="col-lg-1 col-md-1 col-sm-1 col-xs-12" style="padding-left:0">Clientes </span>
<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12" Style="margin-top:2px;padding-left:0 ">
    @include('ventas.cliente.search')
  </div>  
 
  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 " Style="margin-top:2px;padding-right:0">
    <button class="btn btn-default pull-right" data-toggle="modal" data-target="#cModal"><i class="fa fa-plus" aria-hidden="true"></i></button>
  </div>
  </div>

@endsection
@section ('contenido')


<!-- Modal crear-->
                        <div class="modal fade" id="cModal" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#A1D884 ">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="text-align: center">Crear Cliente</h3>
                              </div>
                              <div class="modal-body">
                               {!!Form::open(['url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'])!!}
                                {{Form::token()}}
                                <div class="row">
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="usuario">Usuario</label>
                                      <input type="text" name="usuario" required value="{{old('usuario')}}" class="form-control" placeholder="Usuario ...">          
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="nombre">Nombre</label>
                                      <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre ...">
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="cel">Celular</label>
                                      <input type="text" name="cel" value="{{old('cel')}}" class="form-control" placeholder="Celular ...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Casa</label>
                                      <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Direccion de la casa...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Trabajo</label>
                                      <input type="text" name="diretrabajo" value="{{old('diretrabajo')}}" class="form-control" placeholder="Direccion del trabajo...">
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="comentarios">Comentarios</label>
                                      <textarea  rows="4" name="comentarios" value="{{old('comentrios')}}" class="form-control" placeholder="Comentarios ..."></textarea>
                                    </div>
                                  </div>
                                </div>                               
                              </div>
                              <div class="modal-footer">                                
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>
                              {!!Form::close()!!}
                            </div>
                          </div>
                         </div>    

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-condensed table-hover table-responsive">
        <thead style="background-color:#A9D0F5">
          <th>N°</th>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Celular</th>
          <th>Direccion</th>
          <th>Comentarios</th>
          <th>Opciones</th>
        </thead>
        @php $nx=0;@endphp
        @foreach ($personas as $per)
        @php $nx++;@endphp
        <tr>
          <td>{{$per->idpersona}}</td>
          <td>{{$per->usuario}}</td>
          <td>{{$per->nombres}}</td>
          <td>{{$per->cel}}</td>
          <td><span class="label label-primary">Casa</span> {{$per->direccion}}
          @if (!empty($per->diretrabajo)) <br>
          <span class="label label-info">Trabajo</span> {{$per->diretrabajo}}
          @endif
          </td>
          <td>{{$per->comentarios}}</td>          
          <td Style="width:140px">        
           <div class="btn form-inline">
             <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#pModal{{$nx}}">Editar</button>
            <a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger btn-sm">Eliminar</button></a>
            </div> 
               
                  






         
          </td>
        </tr>

         <!-- Modal edit-->
                        <div class="modal fade" id="pModal{{$nx}}" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="text-align: center">Editar Cliente</h3>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['method'=>'PATCH','action'=>['ClienteController@update', $per->idpersona],'autocomplete'=>'off'])!!}
                                <div class="row">
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="usuario">Usuario: </label>
                                      <input type="text" name="usuario" required value="{{$per->usuario}}" class="form-control" placeholder="Usuario ...">          
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="nombre" class="control-label">Nombre</label>
                                      <input type="text" name="nombre" value="{{$per->nombres}}" class="form-control" placeholder="Nombre ...">
                                    </div>
                                  </div>
                                 
                                   
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="cel">Celular</label>
                                      <input type="text" name="cel" value="{{$per->cel}}" class="form-control" placeholder="Celular ...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Casa</label>
                                      <input type="text" name="direccion" value="{{$per->direccion}}" class="form-control" placeholder="Direccion de la casa...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Trabajo</label>
                                      <input type="text" name="diretrabajo" value="{{$per->diretrabajo}}" class="form-control" placeholder="Direccion del trabajo...">
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="comentarios">Comentarios</label>
                                      <textarea  rows="4" name="comentarios" value="{{$per->comentarios}}" class="form-control" placeholder="Comentarios ...">{{$per->comentarios}}</textarea>
                                    </div>
                                  </div>
                                </div>
                                 </div>
                               <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>
                                {!!Form::close()!!}
                              
                                     
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp

        @include('ventas.cliente.modal')
        @endforeach
      </table>
    </div>
    {{$personas->render()}}
  </div>
</div>


@endsection
