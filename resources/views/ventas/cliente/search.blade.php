{!! Form::open(['url'=>'ventas/cliente','method'=>'GET','autocomplete'=>'off','role'=>'search'])!!}
<div class="form-group">
  <div class="input-group" style="width: 25%">
    <input type="search" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
    <span class="input-group-btn">
     <button type="submit" class="btn btn-info">Buscar</button>
{{Form::close()}}
	</div>
</div>
