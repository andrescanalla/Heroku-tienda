@extends ('layouts.admin')
@section ('titulo')  Listado de Productos en Stock
@endsection
@section ('contenido')

@push ('script')


<script>

$(document).ready(function() {
  $('#ex').DataTable( {
        "paging":   false,
        "order": [[ 0, "desc" ]],
        

dom: 'Bfrtip',
fixedHeader: true,

"columnDefs": [ 
            {
                "targets": [ 5 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 8 ],
                "visible": false
               
            },
            {
                "targets": [ 7 ],
                "visible": false
               
            },
             {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 15 ],
                "visible": false,
                "searchable": false
            },
              {
                "targets": [ 1,2,17 ],
                "orderable": false,
            },
              
            {
                "targets": [ 16 ],
                "visible": false,
                "searchable": false
            }
        ],

 
language: {
        search: "Buscar :"
    },
 
       buttons: [
            {
                extend: 'colvisGroup',
                text: 'Mostrar todo',
                show: ':hidden'
            },
            
            {
                extend: 'colvisGroup',
                text: 'Mostrar menos',
                show: [ 1, 2 ],
                hide: [ 0,7,8,15, 16, 5 ]

                
            }
        ],
     
    } );
} );



</script>
@endpush

<div class="row">
   
  
  <div class="col-lg-12 col-md-2 col-xs-12 "> 
   <div class="form-group  form-inline">          
   
      {!! Form::model(Request::only('tipo','talle','cat','est','marca','estado'), ['route'=>['stock.index'],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
        <button type="submit" class="btn btn-primary">Filtrar</button>
       <label style="margin-right:10px; margin-left:20px">Talle</label>     
    {!! Form::select('talle',$talle1,null,['class'=>'form-control','style'=>'margin-letf:5px;'])!!}
       <label style="margin-right:10px; margin-left:20px">Album</label>     
       {!! Form::select('tipo',$tipo,null,['class'=>'form-control'])!!}     
      <label style="margin-right:10px; margin-left:20px">Categoria</label>
      {!! Form::select('cat',$cat,null,['class'=>'form-control'])!!}
      <label style="margin-right:10px; margin-left:20px">Estacion</label>
      {!! Form::select('est',$est,null,['class'=>'form-control'])!!}
       <label style="margin-right:10px; margin-left:20px">Marca</label>  
       {!! Form::select('marca',$marca,null,['class'=>'form-control'])!!}
       <label style="margin-right:10px; margin-left:15px">Estado</label>  
       {!! Form::select('estado',$estado,null,['class'=>'form-control'])!!}
     
    
    {{Form::close()}}
  </div>
  </div>        
  </div>
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
    <div class="table-responsive" style="height:100%; width: 100%; margin: 0; overflow-y: auto;">
      <table class="table table-condensed table-hover table-condensed" id="ex" style="width:100%">
        <thead style="background-color:#A9D0F5">
          <th>id</th>
          <th>CodeBar</th>
          <th>imagen</th>
          <th>Producto</th>
          <th style="text-align: center">Talle</button></th>          
          <th class="toggle">Style</th>
          <th>Album</th>
          <th>Categoria</th>
          <th>Estacion</th>
          <th>Marca</th>
          <th style="text-align: center">Compra</th> 
          <th style="text-align: center">Venta</th>
          <th style="text-align: center">Ganancia</th>                 
          <th>Estado</th>
          <th>Comentarios</th>          
          <th class="toggle">Orden</th>
          <th class="toggle">Pedido</th>
          <th>Opciones</th>
        </thead>
         <tfoot>
                    
                    <td></td>
                    <th>TOTAL</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th style="text-align: center">${{number_format($stocks->sum('ctp'),0,',','.')}}</th>
                    <td></td>
                    <td></td>
                     <td></td>             
                 </tfoot>     
        @php $nx=0;@endphp
        @foreach ($stocks as $sto)
        @if ($sto->estado=="Reservado") 
        <tr class="danger"> 
        @elseif ($sto->comentarios=="Falta Subir"||$sto->comentarios=="falta subir"||$sto->comentarios=="Falta subir")
        <tr class="success">              
        @else
        <tr>
        @endif
          <td>{{$sto->idstock}}</td>
          <td>{{$sto->codebar}}</td>
          <td style="text-align: center"><img src="{{$sto->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$nx}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$sto->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{$sto->imagen}}" style="margin: auto; max-height:500px">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp
                  </td>
          <td>{{$sto->producto}}</td>
          <td style="text-align: center">{{$sto->talle}}</td>
          <td>{{$sto->style}}</td>
          <td><span data-toggle="modal" data-target="#alModal{{$nx}}">{{$sto->tipo}}</span></td>
          <td>{{$sto->categoria}}</td>
          <td>{{$sto->estacion}}</td>
          <td>{{$sto->marca}}</td>
           <td style="text-align: center">$ {{number_format($sto->ctp,0)}}</td>  
          <td style="text-align: center"><mark data-toggle="modal" data-target="#pModal{{$nx}}">$ {{number_format($sto->precio_v, 0, '.', ',')}}</mark>
           
          </td>
          <td style="text-align: center">$ {{number_format($sto->precio_v-$sto->ctp,0, '.', ',')}}</td>           
          <td> @if ($sto->estado=="Chequeado") 
                <span class="label label-success" data-toggle="modal" data-target="#eModal{{$nx}}">{{$sto->estado}}</span>
                @elseif ($sto->estado=="Reservado")
                <span class="label label-danger" data-toggle="modal" data-target="#eModal{{$nx}}">{{$sto->estado}}</span>            
                @else
                <span class="label label-warning" data-toggle="modal" data-target="#eModal{{$nx}}">{{$sto->estado}}</span>       
                @endif            
          </td>
           <td><mark data-toggle="modal" data-target="#mModal{{$nx}}">{{$sto->comentarios}}</mark>            
           </td>
          <td>{{$sto->orden}}</td>
          <td>{{$sto->nombre}}</td>

          <td>
             <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#dModal{{$nx}}">Detalle</button>
              <!-- Modal 
                        <div class="modal fade" id="dModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Detalles</h4>
                              </div>
                              <div class="modal-body">
                                <table class="table table-condensed">
                                    <thead style="background-color:#A9D0F5">
                                      <th>Style</th>
                                      <th>Orden</th>
                                      <th>Pedido</th>
                                    </thead>
                                    <tr>
                                       <td>{{$sto->style}}</td>
                                       <td>{{$sto->orden}}</td>
                                       <td>{{$sto->nombre}}</td>
                                    </tr>
                                </table>
                                  
                                    
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                              </div>
                               
                            </div>
                          </div>
                        </div>-->

            <a href="{{URL::action('VentaController@vstock',$sto->idstock)}}"><button class="btn btn-info btn-sm">Vender</button></a>
            
            
          </td>
        </tr>        
        @include('stock.stock.modal')
         <!-- Modal comentarios-->
                        <div class="modal fade" id="mModal{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['StockController@update2']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$sto->idstock}}">
                                    <input type="hidden" class="form-control" name="tipo" value="3">
                                   
                                  <div class="form-group">
                                     <label for="message-text">Comentarios:</label>
                                    <textarea class="form-control" name="comentarios">{{$sto->comentarios}}</textarea>
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                              {!!Form::close()!!}      
                            </div>
                          </div>
                        </div>
                         <!-- Modal album-->
                        <div class="modal fade" id="alModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$sto->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['method'=>'POST','action'=>['ProductoController@update2']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$sto->idproducto}}">
                                    <input type="hidden" class="form-control" name="tipo" value="2">
                                 
                                  <div class="form-group" style="text-align: center">
                                    <label for="estado" class="control-label">Estado:</label>
                                     <select type="text" name="estado"class="form-control">
                                      @if($sto->id_tipo==1)
                                      <option value="1" selected>S/D</option>
                                      <option value="2">Beba</option>
                                      <option value="4">Nena</option>
                                      <option value="3">Bebe</option>                                      
                                      <option value="5">Nene</option>
                                       <option value="6">Unisex</option>
                                      @elseif($sto->id_tipo=="2")
                                      <option value="1">S/D</option>
                                      <option value="2" selected>Beba</option>
                                      <option value="4">Nena</option>
                                      <option value="3">Bebe</option>                                      
                                      <option value="5">Nene</option>
                                      <option value="6">Unisex</option>
                                       @elseif($sto->id_tipo=="3")
                                      <option value="1">S/D</option>
                                      <option value="2">Beba</option>
                                      <option value="4">Nena</option>
                                      <option value="3" selected>Bebeb</option>                                      
                                      <option value="5">Nene</option>
                                      <option value="6">Unisex</option>
                                       @elseif($sto->id_tipo=="4")
                                      <option value="1">S/D</option>
                                      <option value="2">Beba</option>
                                      <option value="4" selected>Nena</option>
                                      <option value="3">Bebe</option>                                      
                                      <option value="5">Nene</option>
                                      <option value="6">Unisex</option>
                                      @else
                                      <option value="1">S/D</option>
                                      <option value="2">Beba</option>
                                      <option value="4">Nena</option>
                                      <option value="3">Bebe</option>                                      
                                      <option value="5" selected>Nene</option>
                                      <option value="6">Unisex</option> 
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
                        </div>
          <!-- Modal Estado-->
                        <div class="modal fade" id="eModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['StockController@update2']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$sto->idstock}}">
                                    <input type="hidden" class="form-control" name="tipo" value="2">
                                 
                                  <div class="form-group" style="text-align: center">
                                    <label for="precio" class="control-label">Estado:</label>
                                     <select type="text" name="estado"class="form-control">
                                      @if($sto->estado=="Comprado")
                                      <option value="Comprado" selected>Comprado</option>
                                      <option value="Chequeado">Chequeado</option>
                                      <option value="Reservado">Reservado </option>
                                      @elseif($sto->estado=="Chequeado")
                                      <option value="Comprado">Comprado</option>
                                      <option value="Chequeado" selected>Chequeado</option>
                                      <option value="Reservado">Reservado </option>
                                      @else
                                      <option value="Comprado">Comprado</option>
                                      <option value="Chequeado">Chequeado</option>
                                      <option value="Reservado" selected>Reservado </option> 
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
                        </div>
              <!-- Modal Precio de Venta -->
                        <div class="modal fade" id="pModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['StockController@update2']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$sto->idstock}}">
                                    <input type="hidden" class="form-control" name="tipo" value="1">
                                 
                                  <div class="form-group">
                                    <label for="precio" class="control-label">Precio de Venta:</label>
                                    <input class="form-control" name="precio" value="{{number_format($sto->precio_v, 0, '.', ',')}}"></input>
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                              {!!Form::close()!!}      
                            </div>
                          </div>
                        </div>
        @endforeach
        </table>
    </div>
    
  </div>
</div>


@endsection
