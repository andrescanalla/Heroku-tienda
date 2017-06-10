@extends ('layouts.admin')
@section ('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-xs-12">
    <h3>Nuevo Pedido</h3>
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
{!!Form::open(['url'=>'compra/pedidos','method'=>'POST','autocomplete'=>'off', 'files'=>true])!!}
{{Form::token()}}
<div class="row">
  <div class="col-lg-12 col-md-12 col-xs-12">
    <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre del pedido ...">
     </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10">
    <div class="form-group">
          <label>Tipo de pedido</label>
          <select name="id_tipo" class="form-control">
            @foreach($tipos as $pr)
              <option value="{{$pr->idtipo}}">{{$pr->tipo}} </option>
            @endforeach
          </select> 
    </div>        
  </div>      
  <div class="col-lg-1 col-sm-1 col-md-1 col-xs-10" style="min-height:75px ; padding-left:0">
        <br>
    <div class="form-group" style="padding-top:5px">
        <a href="{{URL::action('TiposController@create')}}"><button class="btn btn-success" type="button">Nuevo</button></a>
    </div>
  </div>   
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
    <div class="form-group">
          <label for="fechacompra">Fecha del Pedido</label>
          <input type="text" name="fechacompra" required value="{{Carbon\Carbon::now()->format('d/m/Y')}}" class="form-control" placeholder="fecha del pedido ...">
    </div>
  </div>
</div>
<div class="row">
        <div class="col-lg-5 col-sm-5 col-md-5 col-xs-10">
          <div class="form-group">
            <label>Estado del pedido</label>
            <select name="id_estado" class="form-control">
              @foreach($estado as $pr)
                <option value="{{$pr->idestado}}">{{$pr->estado}} </option>
              @endforeach
            </select>
          </div>
  </div>
  <div class="col-lg-1 col-sm-1 col-md-1 col-xs-10" style="min-height:75px ; padding-left:0">
          <br>
      <div class="form-group" style="padding-top:5px">
           <a href="{{URL::action('EstadoController@create')}}"><button class="btn btn-success" type="button">Nuevo</button></a>
      </div>
  </div>
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
            <label for="comentarios">Comentarios</label>
            <input type="text" name="comentarios"  value="{{old('comentarios')}}" class="form-control" placeholder="Comentarios ...">
      </div>
  </div>      
</div>
<div class="row"><!--
        <div class="panel panel-primary">
          <div class="panel-body">
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label>Orden</label>
              <select name="piddet" class="form-control selectpicker" id="piddet" data-live-search="true">
                @foreach($orden as $ordenn)
                <option value="{{$ordenn->idorden}}">{{$ordenn->orden}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label for="marca">Marca</label>              
              <input type="text" name="pmarca"  id="pmarca" value="{{old('marca')}}" class="form-control" placeholder="Marca ...">
          </div>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label for="fechallegada">Fecha </label>
              <input type="date" name="pfecha"  id="pfecha" value="{{old('fecha')}}" class="form-control" placeholder="Fecha ...">
          </div>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label for="number">Cantidad </label>
              <input type="text" name="pcant"  id="pcant" value="{{old('cant')}}" class="form-control" placeholder="Cantidad ...">              
          </div>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <label for="total">Total </label>
              <input type="number" name="ptotalorden"  id="ptotalorden" value="{{old('total')}}" class="form-control" placeholder="Total ...">
              
          </div>
          </div>
          <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
            <div class="form-group">
              <button type="button" id="bt_add" class="btn btn-primary">Agregar Orden</button>    
            </div>
          </div>
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                <th>Opciones</th>
                <th>Orden</th>
                <th>Marca</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>SubTotal</th>              
              </thead>
              <tfoot>
                <th>Total</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><h4 id="total"> U$S 0,00</h4></th>   
              </tfoot>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>

      </div> -->
  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" id="guardar">
    <div class="form-group"><!--
      <input name="_token" value="{{csrf_token()}}" ></input>-->
      <button class="btn btn-primary" type="submit">Guardar</button>
      <a href="{{URL::action('PedidosController@index')}}"><button class="btn btn-danger" type="button">Cancelar</button></a>
    </div>
  </div>
</div>

    {!!Form::close()!!} <!--

@push('script')
<script>
$(document).ready(function(){
  $('#bt_add').click(function(){
    agregar();
  });
});
var cont=0;
total=0;
subtotal=[];


function agregar(){
  idorden=$("#piddet").val();
  orden=$("#piddet option:selected").text();
  marca=$("#pmarca").val();
  fecha=$("#pfecha").val();
  cant=$("#pcant").val();
  totalorden=$("#ptotalorden").val();

  if(idorden!=""){
    subtotal[cont]=totalorden;
    a=-subtotal[cont]
    total=total-a;
    
    var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idorden[]" value="'+idorden+'">'+orden+'</td><td><input type="string" name="marca[]" value="'+marca+'"></td><td><input type="date" name="fecha[]" value="'+fecha+'"></td><td><input type="number" name="cant[]" value="'+cant+'"></td><td>'+subtotal[cont]+'</td></tr>';
    
    alert(total);
    cont++;
    limpiar();
    $("#total").html("U$S " + total);
    
    evaluar();
    $("#detalles").append(fila);
  } 
  else{
  alert("Error al ingresar la Orden");
  }
}

function limpiar(){
$("#pmarca").val("");
$("pfecha").val("");
$("#pcant").val("");
$("#ptotalorden").val("");
}


function evaluar(){
  if (total>0){
    $("#guardar").show();
  }
  else{
    $("#guardar").hide();
  }
}

function eliminar(index){
  total=total-subtotal[index];
  $('#total').html("US$"+ total); 
  $("#fila" + index).remove();
  evaluar();
}

</script>
@endpush -->
@endsection
