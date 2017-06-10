@extends ('layouts.admin')
@section ('titulo')  <span class="col-lg-3 col-md-1 col-sm-1 col-xs-12" style="padding-left:0; margin-right:-40px">Orden: {{$orden1->orden}}</span>
<div class="col-lg-3 col-md-10 col-sm-10 col-xs-12" Style="margin-top:2px;padding-left:0 ">
    {!! Form::model(Request::only('searchText','talle'), ['route'=>['orden.show', $orden1->idorden],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
    
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" name="searchText" placeholder="Producto o Codigo de barra..." value="{{$searchText}}">
          <span class="input-group-btn">
          <button type="submit" class="btn btn-info">Buscar</button>
        </span>
        </div>
      </div>
  </div>
  <div class="col-lg-6 col-md-10 col-sm-10 col-xs-12" style="margin-left:40px">
    <div class="form-group form-inline pull-right" Style="margin-top:-2px;padding-left:0">
            
    <button type="submit" class="btn btn-default">Filtrar</button>     
    <span style="font-size:15px">Talle</span>   
    {!! Form::select('talle',$talle1,null,['class'=>'form-control'])!!}
    
        
  </div>
  </div>
     
  {{Form::close()}} 
@endsection
@section ('contenido')
 
   
  <div class="row">      
  
</div>
  
<div class="row">
      
    
            
          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
                  
            <table id="detalles" class="table table-striped table-condensed table-hover">
              <thead style="background-color:#A9D0F5">
                 <th>iddet</th>
                <th>Codebar</th>
                <th style="text-align: center">Imagen</th>
                <th>Producto</th>
                 <th>Style</th>
                 <th>Tipo</th>
                
                <th style="text-align: center">Talle</th>
                <th style="text-align: center">Precio</th>                
                <th style="text-align: center">Cantidad</th>               
                <th style="text-align: center">Check</th>
                <th>Opciones</th>              
              </thead>
               <tfoot>                   
                    <th>TOTAL</th>
                    <td></td>
                    <th style="text-align: center">{{number_format($orden->count('cant'),0,',','.')}}</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>               
                    <th style="text-align: center">${{number_format($orden->sum('precio'),0,',','.')}}</th>
                    <th style="text-align: center">{{number_format($orden->sum('cant'),0,',','.')}}</th>
                    <th style="text-align: center">Tax: ${{number_format($orden->sum('precio')*0.0712,0,',','.')}}</th>
                    <th style="text-align: center">Total $ {{number_format($orden->sum('precio')*1.0712,0,',','.')}}</th>                                
                 </tfoot>     
              
              <tbody>
                @php $n=0;@endphp
                @foreach($orden as $w)
                
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
                  <td>{{$w->style}}</td>
                  <td>{{$w->tipo}}</td>

                  <td style="text-align: center">{{$w->talle}}</td>
                  <td style="text-align: center">{{$w->precio}}</td>
                  <td style="text-align: center">{{$w->cant}}</td>                                    
                  <td style="text-align: center">{{$w->chequeado}}</td>
                  <td> 
                     <div class="btn-group form-inline" role="group" aria-label="...">
                        
               
                     {!!Form::model(Request::only('idd','tipo'),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->iddetalleorden]])!!}
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">
                    <input name="tipo" type="hidden" value="1">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-plus" aria-hidden="true"></i></button>
                     {!!Form::close()!!}
                     </div>
                     <div class="btn-group form-inline" role="group" aria-label="...">
                        
                    {!!Form::model(Request::only('idd','tipo'),['method'=>'DELETE','class'=>'form-inline','route'=>['detalleorden.destroy', $w->iddetalleorden]])!!}
                    <input name="idd" type="hidden" value="{{$w->iddetalleorden}}">
                    <input name="tipo" type="hidden" value="3">
                    <button type="submit" class="btn btn-default btn-sm form-inline"><i class="fa fa-minus" aria-hidden="true"></i></button>
                     {!!Form::close()!!}                    
                     </div>
                      <a href="" data-toggle="modal" data-target="#cModal{{$n}}"><button class="btn btn-info btn-sm">Editar</button></a>                      
                  </td>
                      <!-- Modal edit-->
                        <div class="modal fade" id="cModal{{$n}}" role="dialog">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Editar: {{$w->producto}} - Id:{{$w->iddetalleorden}}</h4>
                              </div>
                              <div class="modal-body">
                                  {!!Form::model($w,['method'=>'PATCH','route'=>['detalleorden.update', $w->iddetalleorden]])!!}
                                    {{Form::token()}}                                    
                                      
                                        <div class="form-group">
                                          <label>Cantidad</label>
                                           <input type="text" name="cant" required value="{{$w->cant}}" class="form-control">
                                        
                                     
                                       
                                          <label>Precio</label>
                                           <input type="text" name="precio" required value="{{$w->precio}}" class="form-control">
                                         </div>
                                          <div class="form-group">
                                             <button class="btn btn-primary" type="submit">Guardar</button>
                                             <button class="btn btn-danger" type="reset" data-dismiss="modal">Cancelar</button>
                                          </div>
                                         
                                      
                                  {!!Form::close()!!}
                              </div>        
                            </div>
                          </div>
                        </div>
                   
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        
        </div>
  @push ('script')


<script>

$(document).ready(function() {
  $('#detalles').DataTable( {
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
