@extends ('layouts.admin')
@section ('titulo')  
 <span class="col-lg-1 col-md-1 col-sm-1 col-xs-12" style="padding-left:0">Ventas </span>
 <div class="col-lg-3 col-md-10 col-sm-10 col-xs-12" Style="margin-top:4px;padding-left:0 ">
    @include('ventas.venta.search')
</div>
 {!! Form::model(Request::only('tipo','estado'), ['route'=>['venta.index'],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
  
  
  <div class="col-lg-7 col-md-2 col-xs-12 " style="padding-right:0; margin-left:40px"> 
   <div class="form-group  ">          
    <div class="form-group form-inline pull-right"> 
     <button type="submit" class="btn btn-default" style="margin-right:15px">Filtrar</button>    
       <span style="font-size:15px">Tipo</span>     
       {!! Form::select('tipo',$tipo,null,['class'=>'form-control','id'=>'tipo'])!!}
        <span style="font-size:15px">Estado </span>
     {!! Form::select('estado',$estado,null,['class'=>'form-control','id'=>'estado'])!!}
         
     
    </div>
    {{Form::close()}}
  </div>
  </div> 

  <div class="col-lg-1 col-md-8 col-sm-8 col-xs-6 " style="padding-right:0; padding-left:0;margin-left:-40px">   
    <a href="venta/create"><button class="btn btn-default pull-right" Style="margin-top:4px"><i class="fa fa-plus" aria-hidden="true"></i></button></a> 
   </div>
@endsection
@section ('contenido')

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <table class="table table-striped table-condensed table-hover" id="ex">
        <thead style="background-color:#A9D0F5">
          <th>id</th>
          <th>Fecha</th>
          <th>Usuario</th>                   
          <th style="text-align: center">Cantidad</th>
          <th style="text-align: center">Total</th>
          <th>Tipo</th>
          <th>Estado</th>
          <th>Chequeado</th>
          <th style="text-align: center">Comentario</th>
          <th>Opciones</th>
        </thead>
        @php $nx=0;@endphp
        @foreach ($ventas as $per)
        @php $nx++;@endphp
        <tr>
          <td>{{$per->idventa}}</td>
          <td>{{\App\Pedidos::fechain($per->fecha)}}</td>
          <td><span data-toggle="modal" data-target="#uModal{{$nx}}" href="/ventas/cliente/{{$per->idpersona}}">{{$per->usuario}}</span></td>                 
          <td style="text-align: center">{{$per->cant}}</td>
          <td style="text-align: center">$ {{number_format($per->precio,0,',','.')}}</td>
          <td>@if ($per->id_pedidos==1)
              {{$per->nombre}}
              @else
              {{$per->nombre}}
              @endif
          </td>
           @if ($per->vestado=="Entregada") 
               <td style="text-align: center"><span data-toggle="modal" data-target="#eModal{{$nx}}" class="label label-success">{{$per->vestado}}</span></td>     
          @elseif ($per->vestado=="Contactada") 
          <td style="text-align: center"><span data-toggle="modal" data-target="#eModal{{$nx}}" class="label label-default">{{$per->vestado}}</span></td>
           @else
          <td style="text-align: center"><span data-toggle="modal" data-target="#eModal{{$nx}}" class="label label-warning">{{$per->vestado}}</span></td>
          @endif         
          <td style="text-align: center">@if (($per->cant*2)==$per->cantche) 
          <span class="label label-info">Completo</span>
          @elseif ($per->cant < $per->cantche)
           <span class="label label-warning">Parcial</span>
           @else ($per->cant==$per->cantche)
           <span class="label label-danger">Nada</span>
           @endif
          </td>
          <td style="text-align: center"><span data-toggle="modal" data-target="#cModal{{$nx}}" >{{$per->vcomentario}}</span></td>
          <td style="min-width:180px">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#shwModal{{$nx}}"  href="/ventas/venta/{{$per->idventa}}">Detalle</button>
            <a href="{{URL::action('VentaController@edit',$per->idventa)}}"><button class="btn btn-info btn-sm">Editar</button></a>
            
            <a href="" data-target="#modal-delete-{{$per->idventa}}" data-toggle="modal"><button class="btn btn-danger btn-sm">Eliminar</button></a>
          </td>
        </tr>
        @include('ventas.venta.modal')
        <!-- Modal Estado-->
                        <div class="modal fade" id="eModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Estado de la Venta</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['VentaController@update2']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$per->idventa}}">
                                    <input type="hidden" class="form-control" name="tipo" value="2">
                                 
                                  <div class="form-group" style="text-align: center">
                                    
                                    <select type="text" name="estado"class="form-control" value="{{$per->vestado}}">
                                        @if($per->vestado=="Confirmada")
                                        <option value="Confirmada" selected>1 - Confirmada</option>
                                        <option value="Contactada">2 - Contactada </option>
                                        <option value="Entregada">3 - Entregada </option>
                                        @elseif($per->vestado=="Contactada")
                                        <option value="Confirmada">1 - Confirmada</option>
                                        <option value="Contactada" selected>2 - Contactada </option>
                                        <option value="Entregada">3 - Entregada </option>
                                        @else
                                        <option value="Confirmada">1 - Confirmada</option>
                                        <option value="Contactada">2 - Contactada </option>
                                        <option value="Entregada" selected>3 - Entregada </option> 
                                        @endif   
                                      </select>     
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                              {!!Form::close()!!}      
                            </div>
                          </div>
                        </div> <!-- End Modal-->
                        <!-- Modal Show-->
                        <div class="modal fade" id="shwModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              
                              
                            </div>
                          </div>
                        </div> <!-- End Modal-->
                         <!-- Modal Usuario-->
                        <div class="modal fade" id="uModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-m">
                            <div class="modal-content">
                              
                              
                            </div>
                          </div>
                        </div> <!-- End Modal-->
                        <!-- Modal comment-->
                        <div class="modal fade" id="cModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                               <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$per->usuario}} Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'GET','action'=>['VentaController@comment']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$per->idventa}}">
                                   
                                   
                                  <div class="form-group">
                                     <label for="message-text">Comentarios:</label>
                                    <textarea class="form-control" rows="4"name="comentarios">{{$per->vcomentario}}</textarea>
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                              {!!Form::close()!!}      
                              
                            </div>
                          </div>
                        </div> <!-- End Modal-->
        @endforeach
        <tfoot>
          <th>TOTAL</th>
          <td></td>
          <th>{{$ventas->count('usuario')}}</th>
          <td></td>
          <th style="text-align: center">{{$ventas->sum('cant')}}</th>
          <th style="text-align: center">$ {{number_format($ventas->sum('precio'),0,',','.')}}</th>
          <th></th>                   
        </tfoot>
      </table>      
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
                "targets": [ 10 ],
                "orderable": false,
            }    
        ]
    } );
} );



</script>
@endpush
@endsection
