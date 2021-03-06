@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
      <h3>Nuevo Estado<h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
    </div>
    @endif
    {!!Form::open(['url'=>'compra/estado','method'=>'POST','autocomplete'=>'off','files'=>'true'])!!}
    {{Form::token()}}
    <div class="form-group">
      <label for="estado">Estado</label>
      <input type="text" name="estado"class="form-control" value="{{old('estado')}}" placeholder="Estado ...">
    </div>
    

    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="{{URL::action('PedidosController@create')}}"><button class="btn btn-danger" type="button">Cancelar</button></a>
    </div>
    {!!Form::close()!!}
  </div>
</div>
  @endsection
