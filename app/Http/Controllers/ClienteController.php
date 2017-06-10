<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Persona;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonaFormRequest;
use DB;

class ClienteController extends Controller
{
   public function __construct()
   	{
   	}
   public function index(Request $request)
   	{
       if ($request)
       {
           $query=trim($request->get('searchText'));
           $personas=DB::table('persona')
           	->where('usuario','LIKE','%'.$query.'%')           	
           	->orwhere('nombres','LIKE','%'.$query.'%')           	
            ->orderBy('idpersona','desc')
            ->paginate(10);
            return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
        }
  	 }
  	public function create()
	{
    	return view("ventas.cliente.create");
	}
	public function store (PersonaFormRequest $request)
	{
    	$persona=new Persona;
    	$persona->usuario=$request->get('usuario');
    	$persona->nombres=$request->get('nombre');
    	$persona->cel=$request->get('cel');
    	$persona->direccion=$request->get('direccion');
      $persona->diretrabajo=$request->get('diretrabajo');
    	$persona->comentarios=$request->get('comentarios');
    	
    	$persona->save();
    	return Redirect::to('ventas/cliente');

	}
	public function show($id)
	{
      $persona=Persona::findOrFail($id);      
     
      return view("ventas.cliente.show",["per"=>$persona]);
    	
     
	}
	public function edit($id)
	{
    	return view('ventas.cliente.edit',["persona"=>Persona::findOrFail($id)]);
	}
	public function update(PersonaFormRequest $request,$id)
	{
    	$persona=Persona::findOrFail($id);
    	$persona->usuario=$request->get('usuario');
      $persona->nombres=$request->get('nombre');
      $persona->cel=$request->get('cel');
      $persona->direccion=$request->get('direccion');
      $persona->diretrabajo=$request->get('diretrabajo');
      $persona->comentarios=$request->get('comentarios');
      $persona->save();
    	return Redirect::to('ventas/cliente');
	}
	public function destroy($id)
	{
    	$persona=Persona::findOrFail($id);    	
    	$persona->delete();
    	return Redirect::to('ventas/cliente');
	}
}
