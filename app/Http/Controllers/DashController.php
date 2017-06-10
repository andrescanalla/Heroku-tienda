<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Requests;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;
use DB;
use App\Dash;

class DashController extends Controller
{
   public function index(Request $request)
   {
	$todo=DB::table('dash')
    ->where('usuario','s/u')
    ->orderBy('fecha')
    ->get();

    $pedido=DB::table('dash')
    ->where('usuario','!=','s/u')
    ->get();

    $stock=DB::table('stock')  
    ->where('stock',1)
    ->select('idstock')
    ->get();
    $stocktotal=$stock->count('idstock'); 

    $stock=DB::table('stock')  
    ->where('stock',1)
    ->where('estado','=','Comprado')
    ->select('idstock')
    ->get();
    $stockcomp=$stock->count('idstock');

    $stock=DB::table('stock')  
    ->where('stock',1)
    ->where('estado','=','Reservado')
    ->select('idstock')
    ->get();
    $stockre=$stock->count('idstock');

    $stock=DB::table('stock')  
    ->where('stock',1)
    ->where('comentarios','LIKE','%'.'subir'.'%')
    ->select('idstock')
    ->get();
    $stockss=$stock->count('idstock'); 

     $stock=DB::table('stock as s')           
           ->leftjoin('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->leftjoin('producto as p','de.id_producto','=','p.idproducto')
           ->leftjoin('tipo as ti','p.id_tipo','=','ti.idtipo')
           ->where('s.stock',1)
           ->where('ti.tipo','Beba')  
           ->select('ti.tipo') 
           ->get();
     $stockbba=$stock->count('tipo'); 

      $stock=DB::table('stock as s')           
           ->leftjoin('detalleorden as de','s.id_detalleorden','=','de.iddetalleorden')
           ->leftjoin('producto as p','de.id_producto','=','p.idproducto')
           ->leftjoin('tipo as ti','p.id_tipo','=','ti.idtipo')
           ->where('s.stock',1)
           ->where('ti.tipo','Bebe')  
           ->select('ti.tipo') 
           ->get();
     $stockbbe=$stock->count('tipo'); 

     $ventas=DB::table('venta')
        ->where('vestado','Contactada')
        ->select('idventa')
        ->get();
    $vtacon=$ventas->count('idventa');

    $ventas=DB::table('venta')
        ->where('vestado','Confirmada')
        ->select('idventa')
        ->get();
    $vtapcon=$ventas->count('idventa');

     $data=Dash::ventastock('2017');
     $data[0]=13;
     $data[1]=9;
     $data[2]=$data[2]+26;
     $data[3]=$data[3]+24;
     $data[4]=$data[4]+18;
     $data[5]=$data[5]+10;
     $chartjs1 = app()->chartjs
        ->name('lineChartTest')
        ->type('line')
        ->size(['width' => 400, 'height' => 266])
        ->labels(['Ene', 'Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'])
        ->datasets([            
            [
                "label" => "2017",
                'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                'borderColor' => "rgba(38, 185, 154, 0.7)",
                "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                "pointHoverBackgroundColor" => "#fff",
                "pointHoverBorderColor" => "rgba(220,220,220,1)",
                'data' => $data,
            ],
            [
                "label" => "2016",
                
                'data' => [11, 10,6, 8,3,16,23,13,21,20,18,26],
            ]
        ])
        ->options([
            "title"=>["display"=>true,
                      "text"=>"Stocks"],
            "legend"=>["position"=>"bottom"]            
            ]);
       
        
        
        

        $chartjs2 = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 286])
         ->labels(['Ene', 'Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'])
         ->datasets([             
             [
                 "label" => "2017",
                 'backgroundColor' => ['rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)'],               
                 
                 'data' => Dash::ventapedido('2017')
             ],
             [
                 "label" => "2016",
                 'backgroundColor' => ['rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)','rgba(255, 206, 86, 0.2)'],
                 'data' => [93, 75,91,69,0,0,121,0,0,0,78,56,0],
                 'borderColor'=> ['rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)','rgba(255, 206, 86, 1)'],
                 'borderWidth'=> 1

             ]
         ])
         ->options([
            "title"=>["display"=>true,
                      "text"=>"Pedidos"],
            "legend"=>["position"=>"bottom"]
            ]);


       
      
            return view("layouts.dash",compact('chartjs1','chartjs2'),["pedido"=>$pedido,"todo"=>$todo,"stocktotal"=>$stocktotal,"stockcomp"=>$stockcomp,"stockre"=>$stockre,"stockss"=>$stockss,"stockbbe"=>$stockbbe,"stockbba"=>$stockbba,"vtacon"=>$vtacon,"vtapcon"=>$vtapcon]);
    
    }

    public function todo(Request $request)
    {   
       
        if($request->get('tipo')==1){
            $f=Carbon::now();
            $todo=new Dash;
            $todo->comment=$request->get('comentarios');
            $todo->todo=$request->get('todo');
            $todo->fecha=$f->format('Y-m-d');   
            
            $todo->save(); 
            return Redirect::back();   
        }
        if($request->get('tipo')==2){
            $todo=Dash::findOrFail($request->get('id')); 
            $todo->comment=$request->get('comentarios');
            $todo->todo=$request->get('todo');
            $todo->checkk=$request->get('check');    
            $todo->update(); 
            return Redirect::back();   
        }
        if($request->get('tipo')==3){
            $todo=Dash::findOrFail($request->get('iddash'));                       
            $todo->delete();
             $response = [
                'msg' => 'Pedido Eliminado',
            ];
            if($request->ajax()) { 
                return Response::json($todo);
            }
            else{
                return Redirect::back();    
            }
            
        }
        if($request->get('tipo')==4){
          if($request->ajax()) {
            $f=Carbon::now();
            $todo=new Dash;
            if (!empty($request->get('comentarios'))){
            $todo->comment=$request->get('comentarios');
            }
            $todo->todo=$request->get('todo');
            $todo->usuario=$request->get('usuario');
            $todo->fecha=$f->format('Y-m-d');           
            $todo->save(); 
            $response = [
                'msg' => 'Pedido guardado',
            ];
            
            return Response::json($todo);

           }
        return Redirect::back();   
        }
        if($request->get('tipo')==5){
        $todo=Dash::findOrFail($request->get('id')); 
        $todo->comment=$request->get('comentarios');
        $todo->todo=$request->get('todo');
        $todo->checkk=$request->get('check'); 
        $todo->usuario=$request->get('usuario');   
        $todo->update(); 
        return Redirect::back();        
                   
        }
        
    }
    public function cale(Request $request){
        if ($request->get('type')==null){
            $cale=DB::table('dash')
                ->where('end','!=',null)
                ->where('todo','=',2)
                ->select('start', 'end','comment as title','iddash as id')
                ->get(); 
             return Response::json($cale);
        }
        else {
            $type = $request->get('type');
                if($type == 'new')
                    {
                        $event= new Dash;
                        $event->comment=$request->get('title');
                        $event->start = Carbon::now();
                        $event->fecha = Carbon::now();
                        $event->end = Carbon::now()->addHour();
                        $event->todo =2;
                        $event->save();                                              
                        echo json_encode(array('status'=>'success'));               
                    }
                if($type == 'resetdate')
                    {
                        $startdate = new Carbon($request->get('start'));               
                        $enddate = new Carbon($request->get('end'));
                        $eventid = $request->get('eventid');     
                       
                        $event = Dash::find($eventid);
                        $event->start = $startdate;
                        $event->fecha = $startdate;
                        $event->end = $enddate;
                        $event->save();                
                    }
                if($type == 'changetitle')
                    {
                        $eventid = $request->get('eventid');
                        $eventtitle = $request->get('title');     
                       
                        $event = Dash::find($eventid);
                        $event->comment = $eventtitle;                
                        $event->save();
                        echo json_encode(array('status'=>'success'));                
                    }
                if($type == 'remove')
                    {
                        $eventid = $request->get('eventid');
                        $event = Dash::find($eventid);
                        $event->delete();
                        
                        if($event)
                            echo json_encode(array('status'=>'success'));
                        else
                            echo json_encode(array('status'=>'failed'));
                    }    
        }
    }
    public function calr(Request $request){
        if ($request->get('type')==null){
              $calr=DB::table('dash')
                ->where('end','!=',null)
                ->where('todo','=',3)
                ->select('start', 'end','comment as title','iddash as id')
                ->get(); 
            return Response::json($calr); 
        }
        else {
            $type = $request->get('type');
                if($type == 'new')
                    {
                        $event= new Dash;
                        $event->comment=$request->get('title');
                        $event->start = Carbon::now();
                        $event->fecha = Carbon::now();
                        $event->end = Carbon::now()->addHour();
                        $event->todo =3;
                        $event->save();
                                              
                        echo json_encode(array('status'=>'success'));               
                    }
                if($type == 'resetdate')
                    {
                        $startdate = new Carbon($request->get('start'));               
                        $enddate = new Carbon($request->get('end'));
                        $eventid = $request->get('eventid');     
                       
                        $event = Dash::find($eventid);
                        $event->start = $startdate;
                        $event->fecha = $startdate;
                        $event->end = $enddate;
                        $event->save();                
                    }    
        }
    }
}
