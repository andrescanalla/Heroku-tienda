<div class="modal fade modal-slide-in-rigth" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$pro->idproducto}}">
  {{Form::open(['action'=>array('ProductoController@destroy',$pro->idproducto),'method'=>'delete'])}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-lavel="Close">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Eliminar Producto</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-defaul" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>

        </div>
      </div>
  {{Form::Close()}}
</div>
</div>
