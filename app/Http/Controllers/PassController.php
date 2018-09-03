<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use Auth;
use Session;
use Hash;
use App\User;
use File;

class PassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }
    
    public function cambioDePass()
    {
        //dd(Auth::user()->rol);
        if (Auth::user()->rol == 'administrador')
        {
            return view('usuarios/password_user_admin');
        }
        else if (Auth::user()->rol == 'miembro')
        {
            return view('usuarios/password_user_miembro ');
        }
        else
        {
        	return action('PagesController@index');
        }
    }

    public function cambioUser(Request $request)
    {
        $this->validate($request,[
            'password_viejo' => 'required',
            'password_nuevo' => 'required',
            'password_nuevo_2' => 'required',
        ]);
        if ($request->password_nuevo == $request->password_nuevo_2)
        {
            if (Auth::user()->id == $request->id)
            {
            	$usuario = User::findOrFail($request->id);
            	
            	if (Hash::check($request->password_viejo, $usuario->password)) 
	            {
	                $usuario->password = Hash::make($request->password_nuevo);
	                $usuario->save();

	                Session::flash('flash_message', 'Clave modificada exitosamente');

	                return redirect()->action('PassController@cambioDePass');    
	            }
	            else
	            {
	                return redirect()->back()->withErrors('La clave antigua no coincide con nuestro registro');
	            }
            }
        }
        else
        {
            return redirect()->back()->withErrors('Los campos Nueva contrase&#241;a y Repetir contrase&#241;a no coinciden');
        }
    }

    public function cambioavatar(Request $request)
    {
        //obtenemos el campo file definido en el formulario
        $archivo = $request->file('archivo');

        //obtenemos el nombre del archivo
        $nombre = Auth::user()->id . Auth::user()->name . $archivo->getClientOriginalName();

        $nombre = str_replace(" ", "", $nombre);
 
        //indicamos que queremos guardar un nuevo archivo en el disco local
        //\Storage::disk('local')->put($nombre,  \File::get($file));
        $archivo->move(
            base_path() . '/public/images/avatar/', $nombre
        );

        if(Auth::user()->avatar != "default.png")
        {
            File::delete('images/avatar/' . Auth::user()->avatar);
        }

        $usuario = User::findOrFail(Auth::user()->id);
        $usuario->avatar = $nombre;
        $usuario->save();   
 
        Session::flash('flash_message', 'Foto de perfil modificada exitosamente');

        return redirect()->action('PassController@cambioDePass');  
    }
}
