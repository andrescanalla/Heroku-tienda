@extends ('layouts.admin')

@section('actualizacion')
<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Scan Codebar</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="actual">
                   <div class="row">
                      <div class="col-md-12">

              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover" style="margin-bottom:0px">
              <thead style="background-color:#A9D0F5">
                
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                 <th>Style</th>
                <th style="text-align: center">Talle</th>
                                
                <th>Orden</th>
                <th style="text-align: center">Cantidad</th>
                <th>Tipo</th>
                <th style="text-align: center">Check</th>
                <th>Venta</th> 
                         
              </thead>
              
              <tbody id = "latestData">

              @php $nf=0; @endphp 
              @php $w=$ultimo; @endphp
                
                <tr>
                  <td id="codebar">{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModalF" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModalF" role="dialog">
                          <div class="modal-dialog">
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
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                
                                  
                  <td>{{$w->orden}}</td>
                  <td style="text-align: center">{{$w->cant}}</td>  
                  <td>{{$w->tipo}}</td>                  
                  <td style="text-align: center"><mark>{{$w->chequeado}}</mark></td>
                  <!-- <td>
                     <div class="btn-group form-inline">                         
                         <button  class="btn btn-default btn-sm form-inline" data-toggle="modal"  href="http://tienda.ar/compra/pedidos/venta/{{$w->iddetalleorden}}" data-target="#fModal{{$nf}}">Vta</button>
                         
                          <!-- Modal --
                          <div class="modal fade" id="fModal{{$nf}}" role="dialog">
                            <div class="modal-dialog modal-sm">                              
                              <div class="modal-content">
                              
                              <div class="modal-body">
                               
                              </div>        
                            </div>
                          </div>
                        </div> <!--fin modal--
                        @php $nf++; @endphp
                      </div>
                      </td> -->
                       @php $nfff=0; @endphp 
                    <td>@foreach ($venta as $as)
                      <a data-toggle="modal" data-target="#cModal{{$nfff}}" href="/ventas/venta/{{$as->idventa}}">{{$as->usuario}}</a><br>
                      <!-- Modal -->
                          <div class="modal fade" id="cModal{{$nfff}}" role="dialog">
                            <div class="modal-dialog modal-lg">                              
                              <div class="modal-content">
                              
                              <div class="modal-body">
                               
                              </div>        
                            </div>
                          </div>
                        </div> <!--fin modal-->
                        @php $nfff++; @endphp 
                      @endforeach
                    </td>
                  
                   
                </tr>
               
              </tbody> 
            </table>

             </div>
                        </div>
                        
                      </div>
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
@endsection

@section ('titulo')  {{$pedido->nombre}}
@endsection

@section ('contenido')

  
<div class="row">      
  <div class="col-lg-5 col-md-5 col-xs-12">

    {!! Form::model(Request::only('type','searchText','talle'), ['route'=>['pedidos.show', $pedido->idpedidos],'method'=>'GET','class'=>'form-inline', 'autocomplete'=>'off','role'=>'search'])!!}
    
      <div class="form-group">
        <div class="input-group">
          <input type="text" id="searchText" class="form-control" name="searchText" placeholder="Codigo de barra..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </span>
        </div>
      </div>
  </div>
  
  <div class="col-lg-4 col-md-5 col-xs-12 "> 
   <div class="form-group form-inline pull-right"> 
  <label>Orden</label>        
    {!! Form::select('type',$orden2,null,['class'=>'form-control','id'=>'type'])!!}
   
  </div>
  </div>    
  <div class="col-lg-3 col-md-3 col-xs-12 ">
    <div class="form-group form-inline pull-right"> 
    <label>Talle</label>     
    {!! Form::select('talle',$talle2,null,['class'=>'form-control','id'=>'talle'])!!}
    <button type="submit" class="btn btn-primary">Filtrar</button>            
  </div>
  </div>
  {{Form::close()}} 
</div>
  
<div class="row">
      
    
            
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
            @if(Session::has('success'))
              <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <strong>Cuidado!</strong> {{ Session::get('message', '') }}
              </div>
            @endif
                  
            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                 <th>id do</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                <th>Style</th>
                <th style="text-align: center">Talle</th>
                <th style="text-align: center">Precio</th>                
                <th>Orden</th>
                <th style="text-align: center">Cantidad</th>
                <th>Tipo</th>
                <th style="text-align: center">Check</th>
                <th>Opciones</th>              
              </thead>
               <tfoot>
                     <th>TOTAL</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th style="text-align: center">{{$pedidos->sum('cant')}}</th>
                    <td></td>
                    <th style="text-align: center">{{$pedidos->sum('chequeado')}}</th>
                    <th></th>
                   
                    
                 </tfoot>
              
              <tbody id="todo">
                @php $n=0;@endphp
                 @php $nw=0;@endphp
                @foreach($pedidos as $w)
                
                <tr>
                   <td>{{$w->iddetalleorden}}</td>
                  <td>{{$w->codebar}}</td>
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$n}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$n}}" role="dialog">
                          <div class="modal-dialog">
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
                  <td>{{$w->style}}</td>
                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->precio}}</td>
                                 
                  <td>{{$w->orden}}</td>
                  <td style="text-align: center">{{$w->cant}}</td>   
                  <td>{{$w->tipo}}</td>                  
                  <td style="text-align: center">{{$w->chequeado}}</td>
                  <td> 
                     <div class="btn-group form-inline" role="group" aria-label="...">              
                     {!!Form::model(Request::all(),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->idpedidos]])!!}
                    <input name="searchText" type="hidden" value="{{$searchText}}">
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">                     
                    <input name="tipo" type="hidden" value="1">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-plus" aria-hidden="true"></i></button>
                     {!!Form::close()!!}
                     </div>
                     <div class="btn-group form-inline" role="group" aria-label="...">                       
                    {!!Form::model(Request::all(),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->idpedidos]])!!}
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">
                    <input name="idp" type="hidden" value="{{$w->idproducto}}">
                    <input name="tipo" type="hidden" value="3">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    
                     {!!Form::close()!!}
                     </div>
                    
                      <div class="btn-group form-inline">                         
                         <button  class="btn btn-default btn-sm form-inline" data-toggle="modal"  href="/compra/pedidos/venta/{{$w->iddetalleorden}}" data-target="#mModal{{$nw}}">Vta</button>
                         
                          <!-- Modal -->
                          <div class="modal fade" id="mModal{{$nw}}" role="dialog">
                            <div class="modal-dialog modal-sm">                              
                              <div class="modal-content">
                              
                              <div class="modal-body">
                               
                              </div>        
                            </div>
                          </div>
                        </div> <!--fin modal-->
                        @php $nw++; @endphp
                      </div>
                     
                  </td>
                   
                </tr>
                @endforeach
                <div id="hide">
                  <div id="idp">{{$pedido->idpedidos}}</div>
                  <div id="ta">{{Request::only('talle')["talle"]}}</div>
                  <div id="bu">{{Request::only('searchText')["searchText"]}}</div>
                  <div id="or">{{Request::only('type')["type"]}}</div>
                </div>
              </tbody>
            </table>
          </div>
        
        </div>
      
  

   
  
@push ('script')
<script>
    $(document).ready(function(){       
        $("#hide").hide()
        var id=$("#idp").text()
        var ta=$("#ta").text()
        var se=$("#bu").text()
        var ord=$("#or").text()
        setInterval(function() {
            $("#todo").load("/compra/actual/"+id+"?searchText="+se+"&type="+ord+"&talle="+ta);
        }, 7000); 
        
        setInterval(function() {
            $("#actual").load("/compra/actual");
        }, 5000);
       
    });

function loadlink(){
  $("#actual").load("/compra/actual");}



</script>


@endpush

@endsection


