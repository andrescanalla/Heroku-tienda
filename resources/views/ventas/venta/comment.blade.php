<!-- Modal comentarios-->
                        
                              <div class="modal-header" style="background-color:#F3EA5D">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'GET','action'=>['VentaController@comment']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$per->idventa}}">
                                   
                                   
                                  <div class="form-group">
                                     <label for="message-text">Comentarios:</label>
                                    <textarea class="form-control" name="comentarios">{{$per->vcomentario}}</textarea>
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                              </div>
                              {!!Form::close()!!}      
                            