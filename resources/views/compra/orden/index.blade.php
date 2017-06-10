@extends ('layouts.admin')
@section ('titulo')   <span class="col-lg-3 col-md-1 col-sm-1 col-xs-12" style="padding-left:0; margin-right:-80px">Listado de Ordenes</span>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-12" Style="margin-top:2px;padding-left:0 ">
    
      @include('compra.orden.search')
      </div>
  <div class="col-lg-6 col-md-1 col-sm-1 col-xs-12 " Style="margin-top:2px;padding-right:0;margin-left:80px">
  <button class="btn btn-default pull-right" data-toggle="modal" data-target="#crpModal" href="{{URL::action('OrdenController@create')}}"><i class="fa fa-plus" aria-hidden="true"></i></button>
  </div>
@endsection
@section ('contenido')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-hover" id="ex">
        <thead style="background-color:#A9D0F5">
          <th>id</th>          
          <th>Orden</th>
          <th>Pedido</th>
          <th style="text-align: center">Marca</th>
          <th style="text-align: center">Fecha</th>
          <th style="text-align: center">Cantidad</th>
          <th style="text-align: center">Total</th>         
          <th>Opciones</th>
        </thead>
        @foreach ($orden as $sto)
        @php
        $carbon = new \Carbon\Carbon();
        @endphp
        
        <tr>
          <td>{{$sto->idorden}}</td>
          <td>{{$sto->orden}}</td>
          <td>{{$sto->nombre}}</td>
          <td style="text-align: center">{{$sto->marca}}</td>
          <td style="text-align: center">@if(!empty($sto->fecha))
                @php
                  $fc=$carbon->createFromFormat('Y-m-d',$sto->fecha);
                @endphp
                  {{$fc->format('d/m/Y')}}
                  
              @endif
            </td>                   
           <td style="text-align: center">{{$sto->cant}}</td> 
           <td style="text-align: center">U$S {{number_format($sto->total,2)}}</td>
          
          
          <td>
            <a href="{{URL::action('OrdenController@edit',$sto->idorden)}}"><button class="btn btn-info">Editar</button></a>
             <a href="{{URL::action('OrdenController@show',$sto->idorden)}}"><button class="btn btn-primary">Detalles</button></a>
            <a href="" data-target="#modal-delete-{{$sto->idorden}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
          </td>
        </tr>
        @include('compra.orden.modal')
        @endforeach
      </table>
       <!-- Modal create-->
                  <div class="modal fade" id="crpModal" role="dialog">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                            </div>
                          </div>
                  </div>  
    </div>
    
  </div>
</div>
@push ('script')


<script>

$(document).ready(function() {
  $('#ex').DataTable( {
    "paging":   false,
    "searching": false,
    "order": [[ 0, "desc" ]],
    "columnDefs": [ 
            
            {
                "targets": [ 7 ],
                "orderable": false,
            }    
        ]
    } );
} );



</script>
@endpush

@endsection
