<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Banda;
use App\User;

class BandasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$listaBandas = Banda::paginate(10);
        return view('bandas/index')
        	->with('listaBandas', $listaBandas);
    }

	public function show($id)
    {
        $banda = Banda::findOrFail($id);
        $miembros = User::where('banda_id', $banda->id)->get();

        return view('bandas/show')
        	->with('banda', $banda)
        	->with('miembros', $miembros);
    }

    public function create()
    {
        return view('bandas/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $banda = new Banda;

        $banda->nombre = $request->nombre;
        $banda->descripcion = $request->descripcion;

        $banda->save();

        Session::flash('flash_message', 'Servicio creado satisfactoriamente');	
        return redirect()->action('BandasController@index');
    }

    public function edit($id)
    {
        $banda = Banda::findOrFail($id);

        return view('bandas/edit')
        	->with('banda', $banda);
    }

    public function update(Request $request, $id)
    {
        $banda = Banda::findOrFail($id);

        $this->validate($request,[
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $banda->nombre = $request->nombre;
        $banda->descripcion = $request->descripcion;

        $banda->save();

		Session::flash('flash_message', 'Edici&#243;n exitosa');

        return redirect()->action('BandasController@index');
    }

    public function delete($id)
    {
		$banda = Banda::findOrFail($id);

		return view('bandas/delete')->with('banda', $banda);
    }

    public function destroy($id)
    {
    	$banda = Banda::findOrFail($id);

    	$banda->delete();

    	Session::flash('flash_message', 'Banda eliminada satisfactoriamente');

    	return redirect()->action('BandasController@index');
    }

    public function buscar(Request $request)
    {
    	if ($request->nombre != '')
    	{
    		$listaBandas = Banda::where('nombre', 'LIKE', '%' . $request->nombre . '%')->paginate(10);
    	}
    	else
    	{
    		$listaBandas = Banda::paginate(10);	
    	}

        return view('bandas/index')
        	->with('listaBandas', $listaBandas);
    }
}
