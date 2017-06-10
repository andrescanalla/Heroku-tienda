
                              <div class="modal-header" style="background-color:#B0C4DE">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">Detalle de la Venta</h4>
                              </div>
                              <div class="modal-body">

<div class="row"> 
  <div class="col-lg-3 col-md-5 col-xs-12">
    <label>Cliente</label>
    <div class="form-group">   
      <input value="{{$ven->usuario}}" class="form-control" readonly>
     
                       
    </div>
  </div>

<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group">
       <label>Fecha Venta</label>       
       <input   class="form-control" readonly value="@php $f=new Carbon\Carbon();$fv=$f->createFromFormat('Y-m-d',$ven->fecha);@endphp{{$fv->format('d/m/Y')}}">
    </div>
</div> 

<div class="col-lg-2 col-md-5 col-xs-12">
   
    <div class="form-group  pull-right">  
     <label>Tipo de venta</label> 
      <input  class="form-control" readonly value="{{$ven->nombre}}">
                       
    </div>
  </div>


<div class="col-lg-2 col-md-5 col-xs-12">
    <div class="form-group pull-right">      
      <label>Estado Venta</label>
       <input  name="fecha" class="form-control" readonly value="{{$ven->vestado}}"> 
    </div>
</div> 
<div class="col-lg-3 col-md-5 col-xs-12">
    <div class="form-group">      
      <label>Comentario</label>
       <textarea name="vcomentario" class="form-control" readonly value="">{{$ven->vcomentario}} </textarea>
    </div>
</div> 
</div>
  
   <div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
      Detalle de Ventas
      <table class="table table-striped table-condensed table-hover" style="text-align: center">
        <thead style="background-color:#A9D0F5">
          
          <th style="text-align: center">Id stock</th>
          <th style="text-align: center">Codebar</th>
          <th style="text-align: center">imagen</th>
          <th style="text-align: center">Producto</th>
         
          <th style="text-align: center">Estado</th>
          <th style="text-align: center">Talle</th>
          <th style="text-align: center">Costo</th>         
          <th style="text-align: center">Precio</th>
          <th style="text-align: center">Ganancia</th>
          
        </thead>
         <tfoot>
                     <td></td>
                    <td></td>
                    
                    <td></td>
                    <td></td>                   
                    <th style="text-align: center">Cantidad: {{$ven->cant}}</th>
                    <th style="text-align: center">Total</th>
                    <th style="text-align: center">$ {{number_format($detaven->sum('ctp'),0,',','.')}}</th>
                    <th style="text-align: center;background-color:#A1D894 ">$ {{number_format($ven->precio,0,',','.')}}</th>
                    <th style="text-align: center">$ {{number_format(($detaven->sum('precio_venta'))-($detaven->sum('ctp')),0,',','.')}}</th>
                    
                 </tfoot>
       
            <tbody>
            @php $nw=0;@endphp
            @foreach($detaven as $w)                
                <tr>
                  <td>{{$w->idstock}}</td>  
                  <td>{{$w->codebar}}</td>                                 
                  <td style="text-align: center"><img src="{{$w->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$nw}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$nw}}" role="dialog">
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
                        @php $nw++; @endphp
                  </td>
                  <td>{{$w->producto}}</td>
                 
                  <td>{{$w->estado}}</td>
                  <td style="text-align: center">{{$w->talle}}</td> 
                  <td style="text-align: center">$ {{number_format($w->ctp,0,',','.')}}</td>                                  
                  <td style="text-align: center">$ {{number_format($w->precio_venta,0,',','.')}}</td>
                  <td style="text-align: center">$ {{number_format($w->precio_venta-$w->ctp,0,',','.')}}</td>

                               
                </tr>
                @endforeach
                </tbody>
                
                 </table>
              </div> 
            </div>             
           
          </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                                
                              </div>
                              
                           
    


