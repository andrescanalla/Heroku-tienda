@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
      <h3>Editar Tipo: <h3>
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
    </div>
    @endif
    
  
    {!!Form::model($estado,['method'=>'PATCH','route'=>['tipos.update', $estado->idtipo],'files'=>'true'])!!}
    {{Form::token()}}
    
     
        <div class="form-group">
          <label for="tipo">Tipos</label>
          <input type="text" name="tipo"class="form-control" value="{{$estado->tipo}}"placeholder="Tipo de pedido ...">
        </div>
      </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
          <div class="form-group">
           <button class="btn btn-primary" type="submit">Guardar</button>
            <a href="{{URL::action('TiposController@index')}}"><button class="btn btn-danger" type="button">Cancelar</button></a>
          </div>
        </div>
      </div>
    {!!Form::close()!!}
  
  @endsection
