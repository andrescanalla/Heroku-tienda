@extends ('layouts.admin')
@section ('contenido')
<div class="row">
  <div class="col-lg-20 col-md-20 col-sm-20 col-xs-12">
    <h3> Listado de Estados <a href="estado/create"><button class="btn btn-success">Nuevo</button></a></h3>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" ; style="padding-left:0px">
    @include('compra.estado.search')
</div>
  </div>
</div>
<div class="row">
  <div class="col-lg-20 col-md-20 col-sm-20 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>id</th>
          <th>Estado</th>
          <th>Opciones</th>
        </thead>
        @foreach ($estado as $est)
        <tr>
          <td>{{$est->idestado}}</td>
          <td>{{$est->estado}}</td>
          <td>
            <a href="{{URL::action('EstadoController@edit',$est->idestado)}}"><button class="btn btn-info">Editar</button></a>
            <a href="" data-target="#modal-delete-{{$est->idestado}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
          </td>
          
        </tr>
        @include('compra.estado.modal')
        @endforeach
      </table>
    </div>
    {{$estado->render()}}
  </div>
</div>


@endsection
