<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Producto;
use App\Detalleorden;
use App\Orden;
use Excel;
use DB;
class MaatwebsiteDemoController extends Controller
{
    /**
     * Return View file
     *
     * @var array
     */
	public function importExport(Request $request)
	{
		$as=$request->get('id_pedidos');
		
		return view('stock.import.importExport',["as"=>$as]);
	}

	/**
     * File Export Code
     *
     * @var array
     */
	public function downloadExcel(Request $request, $type)
	{
		$data = Stock::get()->toArray();

		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

	/**
     * Import file into database Code
     *
     * @var array
     */
	public function importExcel(Request $request )
	{

		if($request->hasFile('import_file')){
			$path = $request->file('import_file')->getRealPath();

			$data = Excel::load($path, function($reader) {
				 })->get();

			if(!empty($data) && $data->count()){

				foreach ($data->toArray() as $key => $value) {
					if(!empty($value) && $value['codebar']!=null){
						
							$insert []= ['codebar' => $value['codebar'],
										 'producto' => $value['item'],
										 'imagen' => $value['foto'],
										 'style' => $value['style'],
										 'talle' => $value['talle'],
										  ];
							$imporden []= ['orden' => $value['orden'],
										   'id_pedidos' => $request->get('id_pedidosx'),
										   'fecha' => $value['fecha']
										   ];

							$impdetaor []= ['codebar' => $value['codebar'],
										 'producto' => $value['item'],
										 'imagen' => $value['foto'],
										 'style' => $value['style'],
										 'talle' => $value['talle'],
										 'cant' => $value['quantity'],
										 'precio' => $value['total'],
										 'orden' => $value['orden'],
                     'tipo' => $value['tipo'],
                     'chequeado' => $value['check'],
										 ];
										
					}	
				}

				
				
				if(!empty($insert)){
					/*$col=Collection::make($insert);*/
					$query=1;
					$agre=0;
					$update=0;
					foreach($insert as $co){
						/*$cole=Collection::make($co);*/
						/*dd($co);*/
						
						$codebar=array_get($co,'codebar');
						$talle=array_get($co, 'talle');
						
						
						if(!empty($codebar)){
							$producto=DB::table('producto')
          						->where('codebar', $codebar)
          						->where('talle', $talle) 
          						->get();

          				
           				
           					if(!empty($producto)&& $producto->count()){
           						$update++;
           						/*foreach ($producto as $sto) {
           							$ids=$sto->idproducto;
           							$produ=Stock::findOrFail($ids);
           							$produ->=$coseo;           							
    								$stoc->update();
    								dd($stoc->stock);
           						return view('stock.stock.index',["stocks"=>$stocks,"searchText"=>$query]);
           						
           						}*/
           					}
           					else{Producto::insert($co);
           						$agre++;
           					}
           				}
           				
           			}
           		}

           		if(!empty($imporden)){
           			$updateor=0;
           			$agreor=0;
					foreach($imporden as $impo){
						$nombre=array_get($impo,'orden');
						if(!empty($codebar)){
							$orden=DB::table('orden')
          						->where('orden', $nombre)
          						->get();
          						          				
           				
           					if(!empty($orden)&& $orden->count()){
           						$updateor++;
           						/*foreach ($producto as $sto) {
           							$ids=$sto->idproducto;
           							$produ=Stock::findOrFail($ids);
           							$produ->=$coseo;           							
    								$stoc->update();
    								dd($stoc->stock);
           						return view('stock.stock.index',["stocks"=>$stocks,"searchText"=>$query]);
           						
           						}*/
           					}
           					else{       						
           						Orden::insert($impo);
           						$agreor++;
           						
           					}
           				}
           				
           			}
           		}

				if(!empty($impdetaor)){
           			
          $agrde=0;
					foreach($impdetaor as $det){ 
						if(!empty($det)&& $orden->count()){
    						$nombre=array_get($det,'orden');
    						$codebar=array_get($det,'codebar');
                $tipos=array_get($det,'tipo');
    						if(!empty($codebar)){
    							$orden=DB::table('orden')
              						->where('orden', $nombre)
              						->get();
              					foreach($orden as $w){
              						$ww=$w;}
        					$producto=DB::table('producto')
        						->where('codebar', $codebar)
        						->get(); 
        					foreach($producto as $p){
        						$pp=$p;}
                  $tipo=DB::table('tipos')
                    ->where('tipo', $tipos)
                    ->first(); 

                  

                  if(empty($tipo)){

                    $tipo=DB::table('tipos')
                    ->where('idtipo',5)
                    ->first(); // idtipo->5 es el id para S/D "sin dato"
                  }
                    
              					
    							$detalleorden=new Detalleorden;
    							$detalleorden->id_orden=$ww->idorden;
    							$detalleorden->id_producto=$pp->idproducto;
                  $detalleorden->id_tipo=$tipo->idtipo;
    							$detalleorden->cant=$det['cant'];
    							$detalleorden->precio=$det['precio'];
                  $detalleorden->chequeado=$det['chequeado'];
    							$detalleorden->save();
              		
                        $agrde++;
                }				
              						          				
               				
               					/*if(!empty($orden)&& $orden->count()){
               						$updateor++;
               						foreach ($producto as $sto) {
               							$ids=$sto->idproducto;
               							$produ=Stock::findOrFail($ids);
               							$produ->=$coseo;           							
        								$stoc->update();
        								dd($stoc->stock);
           						return view('stock.stock.index',["stocks"=>$stocks,"searchText"=>$query]);
           						
           						}
           					}
           					else{       						
           						Orden::insert($impo);
           						$agreor++;
           						
           					}*/
            }
          }
        }        
        $idor=DB::table('orden')
          ->where('orden',"")          
          ->get();
        foreach ($idor as $key){       
        $keyid=$key->idorden;
        $ordsup=Orden::findOrFail($keyid);
        $ordsup->delete();
         }

       $iddetsup=DB::table('detalleorden')
          ->where('precio',0)          
          ->get();
        foreach ($iddetsup as $key){ 
        $keyid=$key->iddetalleorden;      
        $ordsup=Detalleorden::findOrFail($keyid);
        $ordsup->delete();
         }
        
				$agr="$agre Productos agregados, $update Productos Existente, $agreor ordenes creadas $updateor ordenes existentes $agrde Productos agregados a las Ordenes ";
				/*Stock::insert($insert);*/
				return back()->with('success', $agr ,$nombre);
			}
			
			return back()->with('error','Please Check your file, Something is wrong there.');
		}
	}
}
