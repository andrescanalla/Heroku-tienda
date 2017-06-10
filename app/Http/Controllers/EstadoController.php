<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Estado;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\input;
use App\Http\Requests\EstadoFormRequest;
use DB;
class EstadoController extends Controller
{
    public function __construct()
   {
   }
   public function index(Request $request)
   {
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $estado=DB::table('estado')->where('estado','LIKE','%'.$query.'%')
            ->orderBy('idestado','desc')
            ->paginate(7);
            return view('compra.estado.index',["estado"=>$estado,"searchText"=>$query]);
        }
  }
  public function create()
{
    return view("compra.estado.create");
}
public function store (EstadoFormRequest $request)
{
    $estado=new Estado;
    $estado->estado=$request->get('estado');
    $estado->save();
   
    return Redirect::to('compra/estado');

}
public function show($id)
{
    return view("compra.estado.show",["estado"=>Estado::findOrFail($id)]);
}
public function edit($id)
{
    return view('compra.estado.edit',["estado"=>Estado::findOrFail($id)]);
}
public function update(EstadoFormRequest $request,$id)
{
    $estado=Estado::findOrFail($id);
    $estado->estado=$request->get('estado');
    $estado->update();
    
    return Redirect::to('compra/estado');
}
public function destroy($id)
{
    $estado=Estado::findOrFail($id);
    
    $estado->delete();
    return Redirect::to('compra/estado');
}
}
