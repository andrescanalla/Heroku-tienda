{!! Form::model(Request::only('type','searchText'),['route'=>'detalleorden.index','method'=>'GET','autocomplete'=>'off','role'=>'search','class'=>'form-inline'])!!}
<div class="form-group">
  <div class="input-group">
    <input type="text" class="form-control form-inline" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary">Buscar</button>
  </div>
  </div>
  </div>
  <div class="col-lg-8 col-md-7 col-xs-12 "> 
   <div class="form-group form-inline pull-right"> 
  <label>Orden</label>        
    {!! Form::select('type',$orden2,null,['class'=>'form-control form-inline'])!!}
    <button type="submit" class="btn btn-primary">Filtrar</button>
  
  </div>  
{{Form::close()}}
