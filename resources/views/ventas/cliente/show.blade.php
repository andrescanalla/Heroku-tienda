 <div class="modal-header" style="background-color:#B0C4DE">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title" style="text-align: center">Cliente</h3>
                              </div>
                              <div class="modal-body">
                                {!!Form::open(['method'=>'GET','action'=>['ClienteController@show', $per->idpersona],'autocomplete'=>'off'])!!}
                                <div class="row">
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="usuario">Usuario: </label>
                                      <input type="text" name="usuario" readonly value="{{$per->usuario}}" class="form-control" placeholder="Usuario ...">          
                                    </div>
                                  </div>
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="nombre" class="control-label">Nombre</label>
                                      <input type="text" name="nombre" readonly value="{{$per->nombres}}" class="form-control" placeholder="Nombre ...">
                                    </div>
                                  </div>
                                 
                                   
                                  <div class="col-lg-4 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="cel">Celular</label>
                                      <input type="text" name="cel"readonly value="{{$per->cel}}" class="form-control" placeholder="Celular ...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Casa</label>
                                      <input type="text" name="direccion"readonly value="{{$per->direccion}}" class="form-control" placeholder="Direccion de la casa...">
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="direccion">Direccion Trabajo</label>
                                      <input type="text" name="diretrabajo"readonly value="{{$per->diretrabajo}}" class="form-control" placeholder="Direccion del trabajo...">
                                    </div>
                                  </div>
                                  <div class="col-lg-12 col-sm-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                      <label for="comentarios">Comentarios</label>
                                      <textarea  rows="4" name="comentarios" readonly value="{{$per->comentarios}}" class="form-control" placeholder="Comentarios ...">{{$per->comentarios}}</textarea>
                                    </div>
                                  </div>
                                </div>
                                 </div>
                               <div class="modal-footer">
                              
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              </div>
                                {!!Form::close()!!}