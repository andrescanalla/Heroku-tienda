@extends ('layouts.admin')
@section ('titulo')  Nueva Venta
@endsection
@section ('contenido')
        @if (count($errors)>0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
    </div>
    @endif
  </div>
</div>
<div class="row">
{!!Form::open(['url'=>'ventas/venta','method'=>'POST','autocomplete'=>'off'])!!}
{{Form::token()}}
  <div class="col-lg-2 col-md-5 col-xs-12">
    <label>Cliente</label>
    <div class="form-group form-inline">   
                        <select id="idpersona" name="idpersona" class="form-control selectpicker form-inline" data-live-search="true">
                        @foreach($personas as $per)
                        <option value="{{$per->idpersona}}">{{$per->usuario}} </option>
                        @endforeach
                        </select>
                        
    </div>
  </div>
  <div class="col-lg-1 col-sm-1 col-md-1 col-xs-10" style="min-height:75px ; padding-left:0">
        <br>
    <div class="form-group" style="padding-top:5px">
      <a href="{{URL::action('ClienteController@create')}}"><button class="btn btn-success" type="button">Nuevo</button></a>
   </div>
  </div>
   
 
<div class="col-lg-3 col-md-5 col-xs-12">
    <div class="form-group">
       <label>Fecha Venta</label>
       <input  name="fecha"class="form-control" value="{{Carbon\Carbon::now()->format('d/m/Y')}}">
    </div>
</div> 

<div class="col-lg-3 col-md-5 col-xs-12">
    <div class="form-group">
      <label>Tipo Venta</label>
      <select  name="tventa" class="form-control selectpicker form-inline" data-live-search="true">
                        @foreach($ped2 as $key=>$value)
                        <option value="{{$key}}">{{$value}} </option>
                        @endforeach
                        </select>
    </div>
</div> 

<div class="col-lg-3 col-md-5 col-xs-12">
    <div class="form-group">
      <label>Estado Venta</label>
      <select type="text" name="estado"class="form-control">
        <option value="Confirmada" selected>1 - Confirmada</option>
        <option value="Contactada">2 - Contactada </option>
        <option value="Entregada">3 - Entregada </option>
      </select>
    </div>
</div> 
</div> 
<div class="row">
<div class="col-lg-3 col-md-5 col-xs-12">
    <div class="form-group form-inline">                       
        <button class="btn btn-primary" type="submit">Siguiente</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger">Volver</a>
    </div>
</div> 
 {!!Form::close()!!}
</div> 
@endsection
