@extends ('layouts.admin')
@section ('titulo') Editar Producto
@endsection
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
     
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
    {!!Form::model($producto,['method'=>'PATCH','route'=>['producto.update', $producto->idproducto],'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
      <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="codebar">Codigo de Barra</label>
          <input type="text" name="codebar"class="form-control" value="{{$producto->codebar}}"placeholder="Codigo Barra ...">
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nomproducto"class="form-control" value="{{$producto->producto}}"placeholder="Nombre ...">
        </div>
      </div>
       <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="imagen">Imagen</label>
          <input type="text" name="imagen"class="form-control" value="{{$producto->imagen}}">
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="talle">Talle</label>
          <input type="text" name="talle"class="form-control" value="{{$producto->talle}}"placeholder="Talle ...">
        </div>
      </div>
    </div>
       <div class="row">
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-10">
        <div class="form-group">
          <label for="imagen">Tipo</label>
          <select name="tipo" class="form-control">
              @foreach($tipo as $es)
              @if($es->idtipo==$producto->id_tipo)
              <option value="{{$es->idtipo}}" selected>{{$es->tipo}} </option>
              @else
              <option value="{{$es->idtipo}}">{{$es->tipo}} </option>
              @endif
              @endforeach
              </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-10">
        <div class="form-group">
          <label for="imagen">Categoria</label>
          <select name="categoria" class="form-control">
              @foreach($categoria as $es)
              @if($es->idcategoria==$producto->id_categoria)
              <option value="{{$es->idcategoria}}" selected>{{$es->categoria}} </option>
              @else
              <option value="{{$es->idcategoria}}">{{$es->categoria}} </option>
              @endif
              @endforeach
              </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-10">
        <div class="form-group">
          <label for="imagen">Estacion</label>
         <select name="estacion" class="form-control">
              @foreach($estacion as $es)
              @if($es->idestacion==$producto->id_estacion)
              <option value="{{$es->idestacion}}" selected>{{$es->estacion}} </option>
              @else
              <option value="{{$es->idestacion}}">{{$es->estacion}} </option>
              @endif
              @endforeach
              </select>
        </div>
      </div>
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-10">
        <div class="form-group">
          <label for="imagen">Marca</label>
          <select name="marca" class="form-control">
              @foreach($marca as $es)
              @if($es->idmarca==$producto->id_marca)
              <option value="{{$es->idmarca}}" selected>{{$es->marca}} </option>
              @else
              <option value="{{$es->idmarca}}">{{$es->marca}} </option>
              @endif
              @endforeach
            </select>
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
