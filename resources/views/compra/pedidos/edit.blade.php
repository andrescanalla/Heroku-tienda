@extends ('layouts.admin')
@section ('titulo')  Editar Pedido
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
    
  
    {!!Form::model($pedidos,['method'=>'PATCH','route'=>['pedidos.update', $pedidos->idpedidos], 'files'=>'true'])!!}
    {{Form::token()}}
          
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Nombre del Pedido</label>
          <input type="text" name="nombre" required value="{{$pedidos->nombre}}" class="form-control">
        </div>
      </div>
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Costo Envio del Pedido (U$S)</label>
          <input type="decimal" name="envio" required value="{{$pedidos->envio}}" class="form-control"></input>
        </div>
      </div>
      <div class="col-lg-3 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Costo Encomienda ($)</label>
          <input type="decimal" name="encomienda" required value="{{$pedidos->encomienda}}" class="form-control"></input>
        </div>
      </div>
      <div class="col-lg-2 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="nombre">Tasa de Cambio</label>
          <input type="decimal" name="tasa" required value="{{$pedidos->tasa}}" class="form-control"></input>
        </div>
      </div>
      </div>
       <div class="row">
      <div class="col-lg-3 col-sm-3 col-md-3 col-xs-11">
        <div class="form-group">
          <label>Tipo de Pedido</label>
          <select name="id_tipo" class="form-control">
            @foreach($tipos as $pr)
              @if($pr->idtipo==$pedidos->id_tipo)
              <option value="{{$pr->idtipo}}" selected>{{$pr->tipo}} </option>
              @else
              <option value="{{$pr->idtipo}}">{{$pr->tipo}} </option>
              @endif
            @endforeach
          </select>          
        </div>
      </div>
      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="min-height:75px ; padding-left:0">
        <br>
        <div class="form-group" style="padding-top:5px">
           <a href="{{URL::action('TiposController@create')}}"><button class="btn btn-success" type="button">Nuevo</button></a>
        </div>
      </div>
      <div class="col-lg-3 col-sm-3 col-md-3 col-xs-11">
        <div class="form-group">
          <label>Estado del Pedido</label>
          <select name="id_estado" class="form-control">
            @foreach($estado as $es)
              @if($es->idestado==$pedidos->id_estado)
              <option value="{{$es->idestado}}" selected>{{$es->estado}} </option>
              @else
              <option value="{{$es->idestado}}">{{$es->estado}} </option>
              @endif
            @endforeach
          </select>          
        </div>
      </div>
      <div class="col-lg-1 col-sm-1 col-md-1 col-xs-1" style="min-height:75px ; padding-left:0">
        <br>
        <div class="form-group" style="padding-top:5px">
           <a href="{{URL::action('EstadoController@create')}}"><button class="btn btn-success" type="button">Nuevo</button></a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="comentarios">Comentarios</label>
          <input type="text" name="comentarios"  value="{{$pedidos->comentarios}}" class="form-control">
        </div>
      </div>
      </div>
      <div class="row">
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="fechacompra">Fecha del Pedido</label>
          <input type="text" name="fechacompra" required value="@php $carbon = new \Carbon\Carbon(); $fc=$carbon->createFromFormat('Y-m-d',$pedidos->fechacompra); @endphp{{$fc->format('d/m/Y')}}" class="form-control">
        </div>
      </div>      
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="fechadespacho">Fecha de Despacho</label>
          <input type="text" name="fechadespacho"  value="@if(!empty($pedidos->fechadespacho))@php $fd=$carbon->createFromFormat('Y-m-d',$pedidos->fechadespacho); @endphp{{$fd->format('d/m/Y')}}@endif" class="form-control">
        </div>
      </div>      
      <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
        <div class="form-group">
          <label for="fechallegada">Fecha de Llegada</label>
          <input type="text" name="fechallegada"  value="@if(!empty($pedidos->fechallegada))@php $fl=$carbon->createFromFormat('Y-m-d',$pedidos->fechallegada); @endphp{{$fl->format('d/m/Y')}}@endif" class="form-control">
        </div>
      </div>
  </div>
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
      <div class="form-group">
          <a href="{{ url()->previous() }}" class="btn btn-default">Cancelar</a>
         <button class="btn btn-primary" type="submit">Guardar</button>
       
      </div>
     </div>
  </div>
  
  <div class="row">
    
            
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
          <label>Detalle de Ordenes del Pedido</label>           
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                
                <th>Orden</th>
                <th>Marca</th>
                <th>Fecha</th>
                <th>Cantidad</th>
                <th>SubTotal</th>
                <th>Opciones</th>              
              </thead>
              
              <tbody>
                @php
                $totalp=0;
                $cantp=0;
                @endphp
                @foreach($orden as $w)
                @php
                $totalp=$totalp+$w->total;
                $cantp=$cantp+$w->cant;
                @endphp
                <tr>                  
                  <td>{{$w->orden}}</td>
                  <td>{{$w->marca}}</td>
                  <td>{{$w->fecha}}</td>                  
                  <td>{{$w->cant}}</td>                  
                  <td>U$S {{$w->total}}</td>
                  <td>
                    
                    <a href="{{URL::action('OrdenController@edit',$w->idorden)}}"><button class="btn btn-info">Editar</button></a></td>
                   
                </tr>
                @endforeach
              </tbody>
              <tfoot style="background-color:#A9D0F5">
                <td>Total</td>
                <td></td>
                <td></td>
                <td>{{$cantp}}</td>
                <input type="hidden" name="cantp" value="{{$cantp}}">
  {!!Form::close()!!}
                <td>U$S {{$totalp}}</td>
                <td></td>
              </tfoot>
            </table>
          </div>
        </div>
    
  

   
  
  @endsection

