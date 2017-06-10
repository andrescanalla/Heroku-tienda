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
                      <div class="btn-group form-inline">                         
                         <button  class="btn btn-default btn-sm form-inline" data-toggle="modal"  href="http://tienda.ar/compra/pedidos/venta/{{$w->iddetalleorden}}" data-target="#mModal{{$nw}}">Vta</button>
                         
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