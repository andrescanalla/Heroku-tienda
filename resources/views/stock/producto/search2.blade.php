{!! Form::open(['url'=>'stock/producto/edit2','method'=>'GET','autocomplete'=>'off','role'=>'serch'])!!}
<div class="form-group">
  <div class="input-group">
    <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary">Buscar</button>
       </div>
 </div>
