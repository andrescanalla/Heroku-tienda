<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<div class="thumbnail" Style=" min-height:180px; margin-bottom:5px; margin-right:3px"><center><vcenter><img src="{{$img->imagen}}" width="160px"></vcenter></center></div>
    
      <table class="table table-condensed" style="text-align: center; font-size: 14px">
          <thead style="background-color:#A9D0F5; height:10px">
          <th style="text-align: center">N°</th>
          <th style="text-align: center">Venta</th>          
          
        </thead>    
              @php $ne=0;@endphp
              @foreach($venta as $w)     
               @php $ne++;@endphp 

                  <tr>
                    <td>{{$ne}}</td>  
                    <td>{{$w->usuario}}</td>                                            
                  </tr>
              @endforeach
         </table>
    
  
