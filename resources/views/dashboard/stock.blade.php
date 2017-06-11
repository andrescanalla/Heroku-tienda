<div class="row">
    <div class="panel panel-info" style="min-height:100px;margin-bottom:0;margin-left: 15px">
      <div class="panel-heading">
         <div class="row"><a href="/stock/stock">
        <div class="col-lg-10 col-md-4 col-sm-4 col-xs-12">
        Prendas en Stock <i class="fa fa-tag pull-right" style="padding-top:4px"></i>
      </div>
      <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
        <span class="badge pull-right">{{$stocktotal}}</span>
      </div>
      </div></a>
      </div>

      <div class="panel-body">
       <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12" style="padding-left:0;padding-right:7px"> 
      <ul class="list-group" style="margin-bottom:0">
       <a href="/stock/stock?talle=&tipo=&cat=&est=&marca=&estado=Comprado">
      <li class="list-group-item list-group-item-warning" style="height: 28px;padding-top:4px" >
        <span class="badge">{{$stockcomp}}</span>
       Compradas
      </li></a>
      <a href="/stock/stock?talle=&tipo=&cat=&est=&marca=&estado=Reservado">
      <li class="list-group-item list-group-item-warning" style="height: 28px;padding-top:4px">
        <span class="badge">{{$stockre}}</span>
       Reservadas
      </li></a>
       <a href="#">
      <li class="list-group-item list-group-item-warning" style="height: 28px;padding-top:4px">
        <span class="badge">{{$stockss}}</span>
       Sin Subir
      </li></a>
    </ul>

    </div>
    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12" style="padding-left:7px; padding-right:0"> 
      <ul class="list-group" style="margin-bottom:0">
      <a href="/stock/stock?talle=&tipo=2&cat=&est=&marca=&estado=">
      <li class="list-group-item list-group-item-danger" style="height: 28px;padding-top:4px">
        <span class="badge">{{$stockbba}}</span>
       Bebas
      </li></a>
      <a href="/stock/stock?talle=&tipo=3&cat=&est=&marca=&estado=">
      <li class="list-group-item list-group-item-info" style="height: 28px;padding-top:4px">
        <span class="badge">{{$stockbbe}}</span>
       Bebes
      </li></a>
      <a href="#">
      <li class="list-group-item list-group-item-warning" style="height: 28px;padding-top:4px" >
        <span class="badge">{{$stocktotal-$stockbba-$stockbbe}}</span>
       Resto
      </li></a>
    </ul>

    </div>
      </div>
      </div>
  </div> 