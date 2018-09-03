<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use Session;
use App\Pais;

class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$listaPaises = Pais::paginate(10);
        return view('paises/index')
        	->with('listaPaises', $listaPaises);
    }

    public function create()
    {
        return view('paises/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
        ]);

        Pais::create($request->all());
        Session::flash('flash_message', 'Pa&#237;s creado satisfactoriamente');	
        return redirect()->action('PaisController@index');
    }

    public function edit($id)
    {
        $pais = Pais::findOrFail($id);

        return view('paises/edit')
        	->with('pais', $pais);
    }

    public function update(Request $request, $id)
    {
        $pais = Pais::findOrFail($id);

     	$pais->nombre = $request->nombre;

		$pais->save();
            
		Session::flash('flash_message', 'Edici&#243;n exitosa');

        return redirect()->action('PaisController@index');
    }

    public function delete($id)
    {
		$pais = Pais::findOrFail($id);

		return view('paises/delete')->with('pais', $pais);
    }

    public function destroy($id)
    {
    	$pais = Pais::findOrFail($id);

    	$pais->delete();

    	Session::flash('flash_message', 'Pa&#237;s eliminado satisfactoriamente');

    	return redirect()->action('PaisController@index');
    }

    public function buscar(Request $request)
    {
        if ($request->nombre != '')
        {
            $query = Pais::where('nombre', 'LIKE', '%' . $request->nombre . '%')->paginate(10);
        }
        else
        {
            $query = Pais::paginate(10);   
        }

        return view('paises/index')
            ->with('listaPaises', $query);
    }
}
