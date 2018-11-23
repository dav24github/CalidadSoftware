<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;

use sisVentas\Http\Requests;

use sisVentas\User;

use Illuminate\Support\Facades\Redirect;

use sisVentas\http\Requests\UsuarioFormRequest;

use DB;	

class UsuarioController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function index(Request $request){
    	if($request){
    		$query = trim($request->get('searchText')); //obtener todos los registros de la tabla categoria
			$usuarios = DB::table('users')
			->where('name','LIKE','%'.$query.'%')
			->orderBy('id','desc')
			->paginate(7);
    		return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
    	}
    }

    public function create(){
    	return view("seguridad.usuario.create");
    }

    public function store(UsuarioFormRequest $request){
    	$usuario = new User;
    	$usuario->name = $request->get('name');    	
    	$usuario->email = $request->get('email');
    	$usuario->password = bcrypt($request->get('password'));
    	$usuario->save();
    	return Redirect::to('seguridad/usuario');
    }

    public function edit($id){
    	return view("seguridad.usuario.edit",["usuario"=>User::FindOrFail($id)]);
    } 

    public function update(UsuarioFormRequest $request, $id){
    	$usuario = User::FindOrFail($id);
    	$usuario->name = $request->get('name');    	
    	$usuario->email = $request->get('email');
    	$usuario->password = bcrypt($request->get('password'));
    	$usuario->update();
    	return Redirect::to('seguridad/usuario');
    }

    public function destroy($id){
    	$usuario = DB::table('users')->where("id",'=',$id)->delete();
    	return Redirect::to('seguridad/usuario');
    }
}
