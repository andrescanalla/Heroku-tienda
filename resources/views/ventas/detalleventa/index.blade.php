@extends ('layouts.admin')
@section ('titulo')  Detalle Ventas
@endsection
@section ('contenido')
<!-- initComplete: function () {
                    configFilter(this, [6, 7, 4]);
                },
                "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total1 = api
                .column(8)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal1 = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 8 ).footer() ).html(
                '$'+pageTotal1);

             // Total over all pages
            total2 = api
                .column(9)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal2 = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 9 ).footer() ).html(
                '$'+pageTotal2);

             // Total over all pages
            total3 = api
                .column(10)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal3 = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 10 ).footer() ).html(
                '$'+pageTotal3);

        }
                });
    $('#example_length,#example_filter').hide();
        });
  //This function initializes the content inside the filter modal
        function configFilter($this, colArray) {
            setTimeout(function () {
                var tableName = $this[0].id;
                var columns = $this.api().columns();
                $.each(colArray, function (i, arg) {
                    $('#' + tableName + ' th:eq(' + arg + ')').append('<img src="http://www.icone-png.com/png/39/38556.png" class="filterIcon" onclick="showFilter(event,\'' + tableName + '_' + arg + '\')" />');
                });

                var template = '<div class="modalFilter">' +
                                 '<div class="modal-content">' +
                                 '{0}</div>' +
                                 '<div class="modal-footer">' +
                                     '<a href="#!" onclick="clearFilter(this, {1}, \'{2}\');"  class=" btn left waves-effect waves-light">Clear</a>' +
                                     '<a href="#!" onclick="performFilter(this, {1}, \'{2}\');"  class=" btn right waves-effect waves-light">Ok</a>' +
                                 '</div>' +
                             '</div>';
                $.each(colArray, function (index, value) {
                    columns.every(function (i) {
                        if (value === i) {
                            var column = this, content = '<input type="text" class="form-control" onkeyup="filterValues(this)" /> <br/>';
                            var columnName = $(this.header()).text().replace(/\s+/g, "_");
                            var distinctArray = [];
                            column.data().each(function (d, j) {
                                if (distinctArray.indexOf(d) == -1) {
                                    var id = tableName + "_" + columnName + "_" + j; // onchange="formatValues(this,' + value + ');
                                    content += '<div><input type="checkbox" value="' + d + '"  id="' + id + '"/><label for="' + id + '" style="margin-left:5px"> ' + d + '</label></div>';
                                    distinctArray.push(d);
                                }
                            });
                            var newTemplate = $(template.replace('{0}', content).replace('{1}', value).replace('{1}', value).replace('{2}', tableName).replace('{2}', tableName));
                            $('body').append(newTemplate);
                            modalFilterArray[tableName + "_" + value] = newTemplate;
                            content = '';
                        }
                    });
                });
            }, 50);
        }
        var modalFilterArray = {};
        //User to show the filter modal
        function showFilter(e, index) {
            $('.modalFilter').hide();
            $(modalFilterArray[index]).css({ left: 0, top: 0 });
            var th = $(e.target).parent();
            var pos = th.offset();
            console.log(th);
            $(modalFilterArray[index]).width(th.width() * 4);
            $(modalFilterArray[index]).css({ 'left': pos.left, 'top': pos.top });
            $(modalFilterArray[index]).show();
            $('#mask').show();
            e.stopPropagation();
        }

        //This function is to use the searchbox to filter the checkbox
        function filterValues(node) {
            var searchString = $(node).val().toUpperCase().trim();
            var rootNode = $(node).parent();
            if (searchString == '') {
                rootNode.find('div').show();
            } else {
                rootNode.find("div").hide();
                rootNode.find("div:contains('" + searchString + "')").show();
            }
        }

        //Execute the filter on the table for a given column
        function performFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            var searchString = '', counter = 0;

            rootNode.find('input:checkbox').each(function (index, checkbox) {
                if (checkbox.checked) {
                    searchString += (counter == 0) ? checkbox.value : '|' + checkbox.value;
                    counter++;
                }
            });
            $('#' + tableId).DataTable().column(i).search(
                searchString,
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }

        //Removes the filter from the table for a given column
        function clearFilter(node, i, tableId) {
            var rootNode = $(node).parent().parent();
            rootNode.find(".filterSearchText").val('');
            rootNode.find('input:checkbox').each(function (index, checkbox) {
                checkbox.checked = false;
                $(checkbox).parent().show();
            });
            $('#' + tableId).DataTable().column(i).search(
                '',
                true, false
            ).draw();
            rootNode.hide();
            $('#mask').hide();
        }-->






<div class="row">
   <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
    @include('ventas.detalleventa.search')
   </div>
 <div class="col-lg-9 col-md-2 col-xs-12 "> 
   <div class="form-group  form-inline pull-right">          
   
      {!! Form::model(Request::only('tipo','desde','hasta'), ['route'=>['detalleventa.index'],'method'=>'GET', 'autocomplete'=>'off','role'=>'search'])!!}
        
       <label style="margin-right:10px; margin-left:20px">Desde</label>     
       <input type="text" name="desde" required value="{{$desde->format('d/m/Y')}}" class="form-control"> 
       <label style="margin-right:10px; margin-left:20px">Hasta</label>       
       <input type="text" name="hasta" required value="{{$hasta->format('d/m/Y')}}" class="form-control"> 
      <label style="margin-right:10px; margin-left:20px">Tipo de Venta</label>
      {!! Form::select('tipo',$tipo,null,['class'=>'form-control','id'=>'tipo'])!!}

      <button type="submit" class="btn btn-primary">Filtrar</button>
     
    
    {{Form::close()}}
  </div>
  </div>
  </div>
  
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
      <div id="mask"></div>
      <table class="table table-striped table-condensed table-hover" id="example">
        <thead style="background-color:#A9D0F5">
          <th>id</th>
          <th>fecha</th>
          <th>codebar</th>         
          <th>Imagen</th>
          <th>Producto</th>
          <th>Categoria</th>
          <th>Tipo</th>
          <th>Cliente</th>
          <th style="text-align: center">Costo</th>
          <th style="text-align: center">Venta</th>
          <th style="text-align: center">Ganancia</th>
          <th>Tiempo</th>
           
         
        </thead>
        <tfoot>
                    <td></td>
                    <th>Cantidad:</th>
                    <th>{{number_format($detaventa->count('ctp'))}}</th>
                    
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <th>TOTAL</th>
                    <th style="text-align: center">${{number_format($detaventa->sum('ctp'),0,',','.')}}</th>
                    <th style="text-align: center">${{number_format($detaventa->sum('precio_venta'),0,',','.')}}</th>
                     <th style="text-align: center">${{number_format(($detaventa->sum('precio_venta')-$detaventa->sum('ctp')),0,',','.')}}</th>
                    
                   
                    
                 </tfoot>
         @php $nx=0;@endphp
        @foreach ($detaventa as $per)
        @php$fv=new\Carbon\Carbon(); $fv=$fv->createFromFormat('Y-m-d',$per->fecha); $fc=new\Carbon\Carbon(); $fc=$fc->createFromFormat('Y-m-d',$per->fechacompra); @endphp
        <tr>
          <td>{{$per->iddetalleventa}}</td>
          <td>{{$fv->format('d/m/Y')}}</td>
          <td>{{$per->codebar}}</td>
           <td style="text-align: center"><img src="{{$per->imagen}}" width="30px" data-toggle="modal" data-target="#myModal{{$nx}}" class="img-thumbnail">
                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{$nx}}" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center">{{$per->producto}}</h4>
                              </div>
                              <div class="modal-body">
                                <img src="{{$per->imagen}}" style="margin: auto">
                              </div>        
                            </div>
                          </div>
                        </div>
                        @php $nx++; @endphp
                  </td>                   
            <td>{{$per->producto}}</td>
            <td>{{$per->categoria}}</td>
            <td>@if ($per->id_pedidos==1)
              Stock
              @else
              Pedido: {{$per->nombre}}
              @endif</td>
            <td>{{$per->usuario}}</td>
            <td style="text-align: center">$ {{number_format($per->ctp,0)}}</td> 
            <td style="text-align: center">$ {{number_format($per->precio_venta,0,',','.')}}</td>
            <td style="text-align: center">$ {{number_format($per->precio_venta-$per->ctp,0)}}</td>
            
             <td>{{$fv->diffForHumans($fc)}}</td>
          
            
        </tr>
        @include('ventas.detalleventa.modal')
        @endforeach
      </table>
    </div>
   
  </div>
</div>
@push ('script')
<script>
$(document).ready(function() {
  $('#example').DataTable( {
        "paging":   false,
        "searching": false,
        "order": [[ 0, "desc" ]],
        "columnDefs": [ 
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [ 2,3 ],
                "orderable": false,
            }    
        ]
});
});
</script>
@endpush

@endsection
