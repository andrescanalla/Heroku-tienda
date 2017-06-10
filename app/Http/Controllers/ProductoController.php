<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Producto;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use App\Http\Requests\ProductoFormRequest;
use DB;


class ProductoController extends Controller
{
  public function __construct()
   {
   }
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $productos=DB::table('producto as pro')
            ->leftjoin('tipo as ti','pro.id_tipo','=','ti.idtipo')
            ->leftjoin('categoria as ca','pro.id_categoria','=','ca.idcategoria')
            ->leftjoin('marca as ma','pro.id_marca','=','ma.idmarca')
            ->leftjoin('estacion as es','pro.id_estacion','=','es.idestacion')
            ->where('producto','LIKE','%'.$query.'%')
            ->orwhere('codebar','LIKE','%'.$query.'%')
            ->orderBy('idproducto','desc')
            ->get();

            $categoria=DB::table('categoria')->get();
            $marca=DB::table('marca')->get();
            return view('stock.producto.index',["productos"=>$productos,"categoria"=>$categoria,"marca"=>$marca,"searchText"=>$query]);
        }
  }
  public function create()
{
    $categoria=DB::table('categoria')->get();
     $marca=DB::table('marca')->get();
     $estacion=DB::table('estacion')->get();
     $tipo=DB::table('tipo')->get();

    return view("stock.producto.create",["tipo"=>$tipo,"estacion"=>$estacion,"categoria"=>$categoria,"marca"=>$marca,]);
}
public function store (Request $request)
{
   
    $producto=new Producto;
    $producto->producto=$request->get('nomproducto');
    $producto->codebar=$request->get('codebar');
    $producto->talle=$request->get('talle');
    $producto->imagen=$request->get('imagen');
    $producto->style=$request->get('style');
    $producto->id_categoria=$request->get('categoria');
    $producto->id_estacion=$request->get('estacion');
    $producto->id_tipo=$request->get('tipo');
    $producto->id_marca=$request->get('marca');    
   
    $producto->save();
    return Redirect::to('stock/producto');

}
public function show($id)
{
    return view("stock.producto.show",["producto"=>Producto::findOrFail($id)]);
}
public function edit($id)
{    $categoria=DB::table('categoria')->get();
     $marca=DB::table('marca')->get();
     $estacion=DB::table('estacion')->get();
     $tipo=DB::table('tipo')->get();
    return view('stock.producto.edit',["producto"=>Producto::findOrFail($id),"tipo"=>$tipo,"estacion"=>$estacion,"categoria"=>$categoria,"marca"=>$marca,]);
}
public function update(Request $request,$id)
{
   
    if ($request->get('type')==1){
    $producto=Producto::findOrFail($id);
    $producto->id_categoria=$request->get('categoria');
    $producto->id_estacion=$request->get('estacion');
    $producto->id_marca=$request->get('marca');
    $producto->id_tipo=$request->get('tipo');    
    $producto->update();
   return Redirect::back();
      }
    else{
    $producto=Producto::findOrFail($id);
    $producto->codebar=$request->get('codebar');
    $producto->producto=$request->get('nomproducto');
    $producto->talle=$request->get('talle');
    $producto->id_categoria=$request->get('categoria');
    $producto->imagen=$request->get('imagen');
    $producto->id_estacion=$request->get('estacion');
    $producto->id_marca=$request->get('marca');
    $producto->id_tipo=$request->get('tipo');    
    $producto->update();


    return Redirect::to('stock/producto');
    }
}
public function destroy($id)
{
    $producto=Producto::findOrFail($id);
    
    $producto->delete();
    return Redirect::to('stock/producto');
  }

public function edit2(Request $request)
{
      
           $fil=$request->get('fil');
           $query=trim($request->get('searchText'));
           $productos=DB::table('producto as pro')
            ->leftjoin('detalleorden as do','pro.idproducto','=','do.id_producto')
            ->leftjoin('stock as s','do.iddetalleorden','=','s.id_detalleorden')
            ->leftjoin('tipo as ti','pro.id_tipo','=','ti.idtipo')
            ->leftjoin('categoria as ca','pro.id_categoria','=','ca.idcategoria')
            ->leftjoin('marca as ma','pro.id_marca','=','ma.idmarca')
            ->leftjoin('estacion as es','pro.id_estacion','=','es.idestacion')
            ->select('pro.producto','pro.codebar','pro.talle','pro.imagen','pro.style','pro.idproducto','pro.id_tipo','pro.id_estacion','pro.id_marca','pro.id_categoria')            
            ->where('producto','LIKE','%'.$query.'%')
            ->where('s.stock',$fil,'1')
            ->orderBy('idproducto','desc')
            ->get();

            $categoria=DB::table('categoria')->get();
            $marca=DB::table('marca')->get();
            $estacion=DB::table('estacion')->get();
            $tipo=DB::table('tipo')->get();
            return view('stock.producto.edit2',["productos"=>$productos,"tipo"=>$tipo,"estacion"=>$estacion,"categoria"=>$categoria,"marca"=>$marca,"searchText"=>$query]);
        
}
public function update2(Request $request)
{
    $stock=Producto::findOrFail($request->get('id'));   
    
    if($request->get('tipo')==2){
    $stock->id_tipo=$request->get('estado');    
    $stock->update();    
    }
   
    return Redirect::back();
}

}
