<div class="modal fade modal-slide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1"
 id="modal-delete-{{$sto->iddetalleorden}}">
  {{Form::open(['action'=>array('DetalleordenController@destroy',$sto->iddetalleorden),'method'=>'delete'])}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-lavel="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Eliminar id:{{$sto->iddetalleorden}}</h4>
        </div>
        <div class="modal-body">
        <input name="tipo" type="hidden" value="0">
         <input name="idd" type="hidden" value="{{$sto->iddetalleorden}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>

        </div>
      </div>
  {{Form::Close()}}
</div>
</div>
