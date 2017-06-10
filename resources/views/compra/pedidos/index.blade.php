@extends ('layouts.admin')
@section ('titulo')  Listado de Pedidos
@endsection
@section ('contenido')
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">    
    
        @include('compra.pedidos.search')
      
      </div>
  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 ">
    <a href="pedidos/create"><button class="btn btn-default pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button></a>
  </div>
  </div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-bordered table-condensed table-hover">
        <thead>
          <th>id</th>
          <th>Pedido</th>
          <th>Tipo</th>
          <th>Estado</th>
          <th>Fecha</th>
          <th>Despacho</th>
          <th>LLegada</th>          
          <th style="text-align: center">Cantidad</th>
           <th style="text-align: center">Env Uni</th>
            <th style="text-align: center">Env Tot</th>
            <th style="text-align: center">Compra</th>
          <th style="text-align: center">Total</th>
          <th>Comentarios</th>
          <th>Opciones</th>
        </thead>
        @foreach ($pedidos as $sto)
        
        <tr>
          <td>{{$sto->idpedidos}}</td>
          <td>{{$sto->nombre}}</td>
          <td>{{$sto->tipo}}</td>
          <td>{{$sto->estado}}</td>
          <td>{{\App\Pedidos::fechain($sto->fechacompra)}}</td>
          <td>{{\App\Pedidos::fechain($sto->fechadespacho) }}</td>
          <td>{{\App\Pedidos::fechain($sto->fechallegada) }}</td>
           
           <td style="text-align: center">{{$sto->cantt}}</td> 
            <td style="text-align: center">U$S {{number_format($sto->costo_unit_total,2,',','.')}}</td>
           <td style="text-align: center">U$S {{number_format($sto->envio,0,',','.')}}</td>
           <td style="text-align: center">U$S {{number_format($sto->total+$sto->textra,0,',','.')}}</td>
            <td style="text-align: center">U$S {{number_format($sto->envio+$sto->total+$sto->textra,0,',','.')}}</td>
          <td>{{$sto->comentarios}}</td>
          <td>
            <a href="{{URL::action('PedidosController@show',$sto->idpedidos)}}"><button class="btn btn-primary btn-sm">Det</button></a>
            <a href="{{URL::action('PedidosController@edit',$sto->idpedidos)}}"><button class="btn btn-info btn-sm">Edt</button></a>             
            <a href="" data-target="#modal-delete-{{$sto->idpedidos}}" data-toggle="modal"><button class="btn btn-danger btn-sm">Elmr</button></a>
          </td>
        </tr>
        @include('compra.pedidos.modal')
        @endforeach
      </table>
    </div>
    {{$pedidos->render()}}
  </div>
</div>


@endsection
