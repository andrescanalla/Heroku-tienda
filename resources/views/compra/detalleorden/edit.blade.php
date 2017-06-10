@extends ('layouts.admin')
@section ('titulo')  Editar Detalle Orden id:{{$detalleorden->iddetalleorden}}
@endsection
@section ('contenido')
  <div class="row">
    @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
    @endif
    
  
    {!!Form::model($detalleorden,['method'=>'PATCH','route'=>['detalleorden.update', $detalleorden->iddetalleorden]])!!}
    {{Form::token()}}
          
      
      
      </div>
      <div class="row">
      <div class="col-lg-2 col-sm-3 col-md-3 col-xs-11">
        <div class="form-group">
          <label>Cantidad</label>
           <input type="text" name="cant" required value="{{$detalleorden->cant}}" class="form-control">
        </div>
      </div>
       <div class="col-lg-2 col-sm-3 col-md-3 col-xs-11">
        <div class="form-group">
          <label>Precio</label>
           <input type="text" name="precio" required value="{{$detalleorden->precio}}" class="form-control">
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

