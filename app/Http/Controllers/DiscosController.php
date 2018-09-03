<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Disco;
use App\Banda;
use File;

class DiscosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$listaDiscos = Disco::paginate(10);

        return view('discos/index')
        	->with('listaDiscos', $listaDiscos);
    }

	public function show($id)
    {
        $disco = Disco::findOrFail($id);

        return view('discos/show')
        	->with('disco', $disco);
    }

    public function create()
    {
    	$listaBandas = Banda::all();
        return view('discos/create')
        	->with('listaBandas', $listaBandas);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'anio' => 'required',
            'banda_id' => 'required',
        ]);

        $disco = new Disco;

        $disco->create($request->all());

        Session::flash('flash_message', 'Disco creado satisfactoriamente');	
        return redirect()->action('DiscosController@index');
    }

    public function edit($id)
    {
        $disco = Disco::findOrFail($id);
        $listaBandas = Banda::all();

        return view('discos/edit')
        	->with('disco', $disco)
        	->with('listaBandas', $listaBandas);
    }

    public function update(Request $request, $id)
    {
        $disco = Disco::findOrFail($id);

        $this->validate($request,[
            'nombre' => 'required',
            'anio' => 'required',
            'banda_id' => 'required',
        ]);

        $disco->nombre = $request->nombre;
        $disco->anio = $request->anio;
        $disco->banda_id = $request->banda_id;

        if($request->file('archivo') != null)
        {
            //obtenemos el campo file definido en el formulario
            $archivo = $request->file('archivo');

            //obtenemos el nombre del archivo
            $nombre = $disco->id . $disco->banda->nombre . $archivo->getClientOriginalName();

            $nombre = str_replace(" ", "", $nombre);

            $archivo->move(
                base_path() . '/public/images/caratulas/', $nombre
            );
            if($disco->portada != "default.png")
            {
                File::delete('images/caratulas/' . $disco->portada);
            }

            $disco->portada = $nombre;
            $disco->save();   
        }
        else
        {
            $disco->save();
        }

		Session::flash('flash_message', 'Edici&#243;n exitosa');

        return redirect()->action('DiscosController@index');
    }

    public function delete($id)
    {
		$disco = Disco::findOrFail($id);

		return view('discos/delete')->with('disco', $disco);
    }

    public function destroy($id)
    {
    	$disco = Disco::findOrFail($id);

    	$disco->delete();

    	Session::flash('flash_message', 'Disco eliminado satisfactoriamente');

    	return redirect()->action('DiscosController@index');
    }

    public function buscar(Request $request)
    {
    	$query = 'SELECT d.id, d.nombre, d.anio, b.nombre AS "banda" FROM discos d 
    		INNER JOIN bandas b ON d.banda_id = b.id';
        
        $datos = array();

        $primero = true;
        if ($request->nombre != '')
        {
        	$query .= ' WHERE d.nombre LIKE "%' . $request->nombre . '%"';
        	$datos['nombre'] = $request->nombre;
        	$primero = false;
        }

        if ($request->desde != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE d.anio >= "' . $request->desde . '"';
        		$datos['desde'] = $request->desde;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND d.anio >= "' . $request->desde . '"';
        		$datos['desde'] = $request->desde;
        	}
        }

        if ($request->hasta != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE d.anio <= "' . $request->hasta . '"';
        		$datos['hasta'] = $request->hasta;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND d.anio <= "' . $request->hasta . '"';
        		$datos['hasta'] = $request->hasta;
        	}
        }

        if ($request->banda != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE b.nombre LIKE "%' . $request->banda . '%"';
        		$datos['banda'] = $request->banda;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND b.nombre LIKE "%' . $request->banda . '%"';
        		$datos['banda'] = $request->banda;
        	}
        }
        
        $queryAll = DB::select(DB::raw($query));

        //Get current page form url e.g. &page=6
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        //Create a new Laravel collection from the array data
        $collection = new Collection($queryAll);

        //Define how many items we want to be visible in each page
        $perPage = 10;

        //Slice the collection to get the items to display in current page
        $currentPageSearchResults = $collection->slice(($currentPage-1)*$perPage, $perPage)->all();

        //Create our paginator and pass it to the view
        $paginatedSearchResults = new LengthAwarePaginator($currentPageSearchResults, count($collection), $perPage);

        $paginatedSearchResults->setPath('');

        return view('discos/search')
        	->with('listaDiscos', $paginatedSearchResults)
        	->with('parametrosQuery', $datos);;
    }
}
