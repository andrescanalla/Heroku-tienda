@extends ('layouts.adminscan')

@section('actualizacion')
 <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th style="text-align: center">Talle</th>
                                
                <th>Orden</th>
                <th style="text-align: center">Cantidad</th>
                <th>Tipo</th>
                <th style="text-align: center">Check</th>
                             
              </thead>
              
              <tbody>

                
              @php $w=$ultimo; @endphp
                
                <tr>
                  <td>{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModalF" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModalF" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250",$w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        
                  </td>
                  <td>{{$w->producto}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                
                                  
                  <td>{{$w->orden}}</td>
                  <td style="text-align: center">{{$w->cant}}</td>  
                  <td>{{$w->tipo}}</td>                  
                  <td style="text-align: center"><mark>{{$w->chequeado}}</mark></td>
                  
                   
                </tr>
               
              </tbody>
            </table>
@endsection

@section ('titulo')  {{$pedido->nombre}}
@endsection

@section ('contenido')
 
<div class="row">      
  <div class="col-lg-6 col-md-6 col-xs-12">

    {!! Form::model(Request::only('type','searchText','talle'), ['route'=>['pedidos.show', $pedido->idpedidos],'method'=>'GET','class'=>'form-inline', 'autocomplete'=>'off','role'=>'search'])!!}
    
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" name="searchText" placeholder="Codigo de barra..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        </div>
      </div>
  </div>
  
  <div class="col-lg-3 col-md-8 col-xs-12 "> 
   <div class="form-group form-inline pull-right"> 
  <label>Orden</label>        
    {!! Form::select('type',$orden2,null,['class'=>'form-control'])!!}
    <button type="submit" class="btn btn-primary">Filtrar</button>
  </div>
  </div>    
  <div class="col-lg-3 col-md-8 col-xs-12 ">
    <div class="form-group form-inline pull-right"> 
    <label>Talle</label>     
    {!! Form::select('talle',$talle2,null,['class'=>'form-control'])!!}
    <button type="submit" class="btn btn-primary">Filtrar</button>            
  </div>
  </div>
  {{Form::close()}} 
</div>
  
<div class="row">
      
    
            
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
                  
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                 <th>id do</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th style="text-align: center">Talle</th>
                <th style="text-align: center">Precio</th>                
                <th>Orden</th>
                <th style="text-align: center">Cantidad</th>
                <th>Tipo</th>
                <th style="text-align: center">Check</th>
                <th>Opciones</th>              
              </thead>
              
              <tbody>
                @php $n=0;@endphp
                @foreach($pedidos as $w)
                
                <tr>
                   <td>{{$w->iddetalleorden}}</td>
                  <td>{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$n}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$n}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$w->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{str_replace("?sw=83", "?sw=250", $w->imagen)}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $n++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->precio}}</td>
                                 
                  <td>{{$w->orden}}</td>
                  <td style="text-align: center">{{$w->cant}}</td>   
                  <td>{{$w->tipo}}</td>                  
                  <td style="text-align: center">{{$w->chequeado}}</td>
                  <td> 
                     <div class="btn-group form-inline" role="group" aria-label="...">
                        
               
                     {!!Form::model(Request::only('idd','tipo'),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->idpedidos]])!!}
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">
                    <input name="tipo" type="hidden" value="1">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-plus" aria-hidden="true"></i></button>
                     {!!Form::close()!!}
                     </div>
                     <div class="btn-group form-inline" role="group" aria-label="...">
                        
                    {!!Form::model(Request::only('idd','tipo'),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->idpedidos]])!!}
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">
                    <input name="tipo" type="hidden" value="3">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-minus" aria-hidden="true"></i></button>
                     {!!Form::close()!!}
                     </div>
                     
                  </td>
                   
                </tr>
                @endforeach
              </tbody>
            </table>
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
                "targets": [ 8 ],
                "orderable": false,
            }    
        ]
    } );
} );



</script>
@endpush
   
  


@endsection
