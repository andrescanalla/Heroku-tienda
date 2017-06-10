 <div class="modal-header" style="background-color:#A1D884 ">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="text-align: center">Crear Orden</h3>
                              </div>
                              <div class="modal-body">
                                  {!!Form::open(['url'=>'compra/orden','method'=>'POST','autocomplete'=>'off'])!!}
                                  {{Form::token()}}
                                  
                                  <div class="form-group">
                                    <label>Orden</label>
                                    <input type="text" name="orden"class="form-control" placeholder="Orden ...">
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                    <label for="talle">Fecha</label>
                                    <input type="text" name="fecha"class="form-control" value="@php$carbon=new\Carbon\Carbon();$fd=$carbon;@endphp{{$fd->format('d/m/Y')}}">
                                  </div>
                                                                  
                                    <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <select id="marca" name="marca" class="form-control form-inline">                       
                                      @foreach($marca as $key)         
                                        <option value="{{$key->idmarca}}" selected>{{$key->marca}} </option>         
                                      @endforeach
                                    </select>                                    
                                  </div>
                                  <div class="form-group">
                                    <label for="marca">Pedido</label>
                                    <select id="pedido" name="pedido" class="form-control form-inline">                       
                                      @foreach($pedidos as $key)         
                                        <option value="{{$key->idpedidos}}" selected>{{$key->nombre}} </option>         
                                      @endforeach
                                    </select>                                    
                                  </div>
                                  

                              </div>
                              <div class="modal-footer">                                
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>
                              {!!Form::close()!!}
                             