@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
      <h3>Nuevo Cliente<h3>
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
    {!!Form::open(['url'=>'ventas/cliente','method'=>'POST','autocomplete'=>'off'])!!}
    {{Form::token()}}
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="usuario">Usuario</label>
          <input type="text" name="usuario" required value="{{old('usuario')}}" class="form-control" placeholder="Usuario ...">          
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Nombre ...">
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="cel">Celular</label>
          <input type="text" name="cel" value="{{old('cel')}}" class="form-control" placeholder="Celular ...">
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="direccion">Direccion</label>
          <input type="text" name="direccion" value="{{old('direccion')}}" class="form-control" placeholder="Direccion ...">
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="comentarios">Comentarios</label>
          <input type="text" name="comentarios" value="{{old('comentrios')}}" class="form-control" placeholder="Comentarios ...">
        </div>
      </div>
    </div>
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
        <button class="btn btn-primary" type="submit">Guardar</button>
        <button class="btn btn-danger" type="reset">Cancelar</button>
      </div>
    </div>
  </div>

    {!!Form::close()!!}
  
    @endsection
