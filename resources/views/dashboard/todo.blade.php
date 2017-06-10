<div class="row">
  <div class="panel with-nav-tabs panel-default" style="padding:0">
    <div class="panel-heading" style="min-height:42px">
      <div class="pull-left">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">To Do</a></li>
            <li><a href="#tab2default" data-toggle="tab" id="tab-pedido">Pedido</a></li>
        </ul>
      </div>   
    </div>  
      <!-- Modal new to do-->                     
      @include ('dashboard.modal.createtodo')            
               
       <!-- Modal new Pedido-->
      @include ('dashboard.modal.createpedido')  
                               
  <div class="panel-body" style="padding-top:0; min-height:408px">
      <div class="tab-content"> 
        <div class="tab-pane fade in active" id="tab1default">          
        <div class="table-responsive">
          <table class="table table-condensed table-hover" id="ex" style="margin-bottom:0px">
            <thead>
            <th>Fecha</th>
            <th>Tarea</th>
            <th><div class="btn-group pull-right">
                  <button class="btn btn-link pull-right" data-toggle="modal" data-target="#btnModal" style="padding-top:0;padding-bottom:0"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </th>
            </thead>
            @php $nx=0;@endphp
            @foreach ($todo as $to)
            @php $nx++;@endphp
            @if ($to->todo=="3") 
              <tr class="danger"> 
            @elseif ($to->todo=="2") 
              <tr class="warning">              
            @else
              <tr>
            @endif            
              <td class="container-fluid">{{\App\Dash::fechain($to->fecha)}}</td>
               <td> @if ($to->checkk=="true") <span data-toggle="modal" data-target="#cModal{{$nx}}"><s>{{$to->comment}}</s></span>
                    @else <span data-toggle="modal" data-target="#cModal{{$nx}}">{{$to->comment}}</span>
                    @endif 
               </td>
               
               <td><button class="btn btn-link pull-right" data-toggle="modal" data-target="#eModal{{$nx}}" style="padding-top:0;padding-bottom:0"><i class="fa fa-trash" aria-hidden="true"></i></td>
            </tr>
             <!-- Modal comentarios-->
                        <div class="modal fade" id="cModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['DashController@todo']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$to->iddash}}">
                                    <input type="hidden" class="form-control" name="tipo" value="2">
                                   
                                  <div class="form-group">
                                    <label >Importancia</label>     
                                      {!! Form::select('todo',['1' => 'Normal', '2' => 'Media', '3' => 'Alta'], $to->todo,['class'=>'form-control'])!!} 
                                     <label for="message-text">Tarea</label>
                                    <textarea class="form-control" name="comentarios" rows="4">{{$to->comment}}</textarea>
                                     <div class="form-group form-inline">
                                    {!!Form::checkbox('check', 'true',$to->checkk)!!} 
                                    <label > Tarea realizada</label>
                                    </div>
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
                        <!-- Modal eliminar-->
                        <div class="modal fade" id="eModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Eliminar</h4>
                              </div>
                              <div class="modal-body">
                                   {!!Form::open(['method'=>'POST','action'=>['DashController@todo']])!!}                                   
                                    <input type="hidden" class="form-control" name="iddash" value="{{$to->iddash}}">
                                    <input type="hidden" class="form-control" name="tipo" value="3">
                                   
                                  <div class="form-group">
                                     <label for="message-text">Tarea:</label>
                                    <textarea class="form-control" name="comentarios" rows="4">{{$to->comment}}</textarea>
                                  </div>
                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                              </div>
                              {!!Form::close()!!}      
                            </div>
                          </div>
                        </div>
            @endforeach
             
          </table>
        </div>
      
      </div> 
      
      <div class="tab-pane fade " id="tab2default"> 

               
        <div class="table-responsive">
           <table class="table table-condensed table-hover" id="tabla-pedido" style="margin-bottom:0px">
            <thead>
            <th>Usuario</th>
            <th>Comentario</th>
            <th><div class="btn-group pull-right">
                  <a href="#btnpModal" class="btn btn-link pull-right" data-toggle="modal" style="padding-top:0;padding-bottom:0"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </div>
            </th>
            </thead>
          
            @php $nx=0;@endphp
            @foreach ($pedido as $to)
            @php $nx++;@endphp
            @if ($to->todo=="3") 
              <tr class="danger" data-id="{{$to->iddash}}" id="p{{$to->iddash}}"> 
            @elseif ($to->todo=="2") 
              <tr class="warning" data-id="{{$to->iddash}}"  id="p{{$to->iddash}}">              
            @else
              <tr data-id="{{$to->iddash}}"  id="p{{$to->iddash}}">
            @endif            
              <td>
                @if ($to->checkk=="true")
                <span data-toggle="modal" data-target="#cpModal{{$nx}}"><s>{{($to->usuario)}}</s>
                 @else <span data-toggle="modal" data-target="#cpModal{{$nx}}">{{$to->usuario}}</span>
                @endif 
               </td>
               <td> @if ($to->checkk=="true") <span data-toggle="modal" data-target="#cpModal{{$nx}}"><s>{{$to->comment}}</s></span>
                    @else <span data-toggle="modal" data-target="#cpModal{{$nx}}">{{$to->comment}}</span>
                    @endif 
               </td>
               
               <td><a href="#"class="btn btn-link pull-right boton-delete" style="padding-top:0;padding-bottom:0" data-comment="{{$to->comment}}" data-usuario="{{$to->usuario}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            </tr>
             <!-- Modal comentarios-->
                        <div class="modal fade" id="cpModal{{$nx}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar</h4>
                              </div>
                              <div class="modal-body">
                                
                                  
                                    {!!Form::open(['method'=>'POST','action'=>['DashController@todo']])!!}
                                    
                                   
                                    <input type="hidden" class="form-control" name="id" value="{{$to->iddash}}">
                                    <input type="hidden" class="form-control" name="tipo" value="5">
                                   
                                  <div class="form-group">
                                    <label >Importancia</label>     
                                      {!! Form::select('todo',['1' => 'Normal', '2' => 'Media', '3' => 'Alta'], $to->todo,['class'=>'form-control'])!!} 
                                     <label >Usuario</label>                                              
                                      <input class="form-control" name="usuario" type="text" required value="{{$to->usuario}}" placeholder="Usuario">
                                     <label for="message-text">Comentario</label>
                                    <textarea class="form-control" name="comentarios" rows="4">{{$to->comment}}</textarea>
                                     <div class="form-group form-inline">
                                    {!!Form::checkbox('check', 'true',$to->checkk)!!} 
                                    <label > Usuario avisado!!!</label>
                                    </div>
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
           <!-- Modal eliminar-->
                         <div class="modal fade" id="epModal" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Eliminar</h4>
                              </div>
                              <div class="modal-body">
                                   {!!Form::open(['method'=>'POST','action'=>['DashController@todo']])!!}                                   
                                    <input type="hidden" class="form-control" name="id" value="">
                                    <input type="hidden" class="form-control" name="tipo" value="3">
                                   
                                  <div class="form-group">
                                      <label >Usuario</label>                                              
                                      <input class="form-control" name="usuario" type="text" readonly value="" placeholder="Usuario"> 
                                     <label for="message-text">Tarea:</label>
                                    <textarea class="form-control" name="comentarios" readonly rows="4"></textarea>
                                  </div>                               
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" id="btn-delete">Eliminar</button>                               
                              </div>
                                {!!Form::close()!!}   
                            </div>
                          </div>
                        </div>         
            </div>     
          </div>     
        </div>    
      </div>
    </div>
  </div>
 