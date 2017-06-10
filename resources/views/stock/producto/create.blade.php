 
                              <div class="modal-header" style="background-color:#A1D884 ">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="text-align: center">Crear Producto</h3>
                              </div>
                              <div class="modal-body">
                                  {!!Form::open(['url'=>'stock/producto','method'=>'POST','autocomplete'=>'off'])!!}
                                  {{Form::token()}}
                                  <div class="row">
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="codebar">Codigo de Barra</label>
                                    <input type="text" name="codebar"class="form-control" placeholder="Codigo de Barra ...">
                                  </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <input type="text" name="imagen" class="form-control" placeholder="Http://imagen ...">
                                  </div>
                                  </div>
                                  </div>
                                  <div class="row">
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" name="nomproducto"class="form-control" placeholder="Nombre ...">
                                  </div>
                                  </div>
                                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="talle">Talle</label>
                                    <input type="text" name="talle"class="form-control" placeholder="Talle ...">
                                  </div>
                                   </div>                                   
                                  <div class="col-lg-3 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="style">Style</label>
                                    <input type="text" name="style"class="form-control" placeholder="Style ...">
                                  </div>
                                   </div>
                                    </div>
                                  <div class="row">
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <select id="marca" name="marca" class="form-control form-inline">                       
                                      @foreach($marca as $key)         
                                        <option value="{{$key->idmarca}}">{{$key->marca}} </option>         
                                      @endforeach
                                    </select>                                    
                                  </div>
                                   </div>
                                   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="tipo">Album</label>     
                                    <select id="categoria" name="tipo" class="form-control form-inline">                       
                                      @foreach($tipo as $key)         
                                        <option value="{{$key->idtipo}}">{{$key->tipo}} </option>         
                                      @endforeach
                                    </select>
                                  </div>
                                   </div>
                                   </div>
                                   <div class="row">
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                    <label for="estacion">Estacion</label>
                                    <select id="estacion" name="estacion" class="form-control form-inline">                       
                                      @foreach($estacion as $key)         
                                        <option value="{{$key->idestacion}}">{{$key->estacion}} </option>         
                                      @endforeach
                                    </select>
                                  </div>
                                   </div>
                                   <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                  <div class="form-group">
                                   <label for="categoria">Categoria</label>     
                                    <select id="categoria" name="categoria" class="form-control form-inline">                       
                                      @foreach($categoria as $key)         
                                        <option value="{{$key->idcategoria}}">{{$key->categoria}} </option>         
                                      @endforeach
                                    </select>
                                  </div>
                                  </div>
                                  </div>

                              </div>
                              <div class="modal-footer">                                
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                              </div>
                              {!!Form::close()!!}
                             