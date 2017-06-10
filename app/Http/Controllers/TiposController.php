<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Tipos;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use App\Http\Requests\TiposFormRequest;
use DB;

class TiposController extends Controller
{
     public function __construct()
   {
   }
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $estado=DB::table('tipos')->where('tipo','LIKE','%'.$query.'%')
            ->orderBy('idtipo','desc')
            ->paginate(7);
            return view('compra.tipos.index',["estado"=>$estado,"searchText"=>$query]);
        }
  }
  public function create()
{
    return view("compra.tipos.create");
}
public function store (TiposFormRequest $request)
{
    $estado=new Tipos;
    $estado->tipo=$request->get('tipo');
    $estado->save();
   
    return Redirect::to('compra/tipos');

}
public function show($id)
{
    return view("compra.tipos.show",["estado"=>Tipos::findOrFail($id)]);
}
public function edit($id)
{
    return view('compra.tipos.edit',["estado"=>Tipos::findOrFail($id)]);
}
public function update(TiposFormRequest $request,$id)
{
    $estado=Tipos::findOrFail($id);
    $estado->tipo=$request->get('tipo');
    $estado->update();
    
    return Redirect::to('compra/tipos');
}
public function destroy($id)
{
    $estado=Tipos::findOrFail($id);
    
    $estado->delete();
    return Redirect::to('compra/tipos');
}
}
