@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
      <h3>Editar producto de Stock:{{$stock->id_producto}}<h3>
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
    {!!Form::model($stock,['method'=>'PATCH','route'=>['stock.update', $stock->idstock], 'files'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label>Producto</label>
          <select name="id_producto" class="form-control">
            @foreach($productosxx as $pr)
              @if($pr->idproducto==$stock->id_producto)
              <option value="{{$pr->idproducto}}" selected>{{$pr->codebar}} </option>
              @else
              <option value="{{$pr->idproducto}}">{{$pr->codebar}} </option>
              @endif
            @endforeach
          </select>          
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="stock">Stock</label>
          <input type="text" name="stock" required value="{{$stock->stock}}" class="form-control">
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label for="estado">Estado</label>
          <input type="text" name="estado" required value="{{$stock->estado}}" class="form-control">
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
