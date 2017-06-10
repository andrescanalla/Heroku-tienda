@extends ('layouts.admin')
@section ('contenido')
  <div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12">
      <h3>Nuevo producto en Stock<h3>
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
    {!!Form::open(['url'=>'stock/stock','method'=>'POST','autocomplete'=>'off', 'files'=>true])!!}
    {{Form::token()}}
    <div class="row">
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
          <label>Producto</label>
          <select name="id_producto" class="form-control">
            @foreach($productos as $pr)
              <option value="{{$pr->idproducto}}">{{$pr->codebar}} </option>
            @endforeach
          </select>
          
        </div>
      </div>
      <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        <div class="form-group">
      <label for="stock">Stock</label>
      <input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock ...">
    </div>
      </div>
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Guardar</button>
      <button class="btn btn-danger" type="reset">Cancelar</button>
    </div>
  </div>
</div>
    {!!Form::close()!!}
  
    @endsection
