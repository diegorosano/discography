<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use Auth;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
    }
    
    public function index()
    {
    	if (Auth::guest())
    	{
    		return view('auth/login');
    	}
        else if (Auth::user()->rol == 'administrador')
        {
            return view('admin/index');
        }
        else if (Auth::user()->rol == 'miembro')
        {
            return redirect()->action('MiembrosController@index');
        }
        else
        {
        	return view('auth/login')->withErrors('ROL DE USUARIO NO DEFINIDO, CONTACTE AL ADMINISTRADOR');
        }
    }
}
