
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title" style="text-align: center">Clientes</h4>
   </div>
<div class="modal-body">
<div class="row">
  <div class="col-lg-12 col-md-12 col-xs-12">
    <table class="table table-striped table-bordered table-condensed table-hover" style="text-align: center">
        <thead style="background-color:#A9D0F5">
          
          <th style="text-align: center">N°</th>
          <th style="text-align: center">Usuario</th>
          <th style="text-align: center">Nombre</th>       
          
        </thead>
        
            @php $ne=0;@endphp
            @foreach($venta as $w)     
             @php $ne++;@endphp           
                <tr>
                  <td>{{$ne}}</td>  
                  <td> <a data-toggle="modal" data-target="#ffModal{{$ne}}" href="http://tienda.ar/ventas/venta/{{$w->idventa}}">
                    {{$w->usuario}}</a>  </td>                               
                  <td>{{$w->nombres}}</td>
                 
                                                
                </tr>
                 <!-- Modal -->
                          <div class="modal fade" id="ffModal{{$ne}}" role="dialog">
                            <div class="modal-dialog modal-sm">                              
                              <div class="modal-content">
                              
                              <div class="modal-body">
                               
                              </div>        
                            </div>
                          </div>
                        </div> <!--fin modal-->
            @endforeach
       </table>
  </div>
</div>
</div>
</div>