<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use App\Periodo;
use App\Disco;
use App\Banda;
use App\Servicio;
use App\Pais;

class PeriodosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('admin');
    }
    
	public function index()
    {
    	$listaPeriodos = Periodo::paginate(10);

        return view('periodos/index')
        	->with('listaPeriodos', $listaPeriodos);
    }

	public function show($id)
    {
        $periodo = Periodo::findOrFail($id);

        return view('periodos/show')
        	->with('periodo', $periodo);
    }

    public function create()
    {
    	$listaBandas = Banda::all();
    	$listaServicios = Servicio::all();
    	$listaPaises = Pais::all();

        return view('periodos/create')
        	->with('listaBandas', $listaBandas)
        	->with('listaServicios', $listaServicios)
        	->with('listaPaises', $listaPaises);
    }

    public function cargardiscos()
    {
    	$query = 'SELECT d.id, d.nombre FROM discos d WHERE d.banda_id = "' . Input::get('banda') . '"';

    	$queryAll = DB::select(DB::raw($query));

        return json_encode($queryAll);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'periodo' => 'required',
            'banda_id' => 'required',
            'disco_id' => 'required',
            'servicio_id' => 'required',
            'pais_id' => 'required',
            'cantidad' => 'required',
            'estado' => 'required',
        ]);

        $periodo = new Periodo;

        $periodo->periodo = $request->periodo;
        $periodo->banda_id = $request->banda_id;
        $periodo->disco_id = $request->disco_id;
        $periodo->servicio_id = $request->servicio_id;
        $periodo->pais_id = $request->pais_id;
        $periodo->cantidad = $request->cantidad;
        $periodo->estado = $request->estado;

        $servicio = Servicio::where('id', $request->servicio_id)->first();

        $periodo->total = $request->cantidad * $servicio->precio;

        $periodo->save();

        Session::flash('flash_message', 'Periodo creado satisfactoriamente');	
        return redirect()->action('PeriodosController@index');
    }

    public function edit($id)
    {
    	$periodo = Periodo::findOrFail($id);
    	$listaBandas = Banda::all();
    	$listaServicios = Servicio::all();
    	$listaPaises = Pais::all();
    	
        return view('periodos/edit')
        	->with('periodo', $periodo)
        	->with('listaBandas', $listaBandas)
        	->with('listaServicios', $listaServicios)
        	->with('listaPaises', $listaPaises);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'periodo' => 'required',
            'banda_id' => 'required',
            'disco_id' => 'required',
            'servicio_id' => 'required',
            'pais_id' => 'required',
            'cantidad' => 'required',
            'estado' => 'required',
        ]);

        $periodo = Periodo::findOrFail($id);

        $periodo->periodo = $request->periodo;
        $periodo->banda_id = $request->banda_id;
        $periodo->disco_id = $request->disco_id;
        $periodo->servicio_id = $request->servicio_id;
        $periodo->pais_id = $request->pais_id;
        $periodo->cantidad = $request->cantidad;
        $periodo->estado = $request->estado;

        $servicio = Servicio::where('id', $request->servicio_id)->first();

        $periodo->total = $request->cantidad * $servicio->precio;

        $periodo->save();

		Session::flash('flash_message', 'Edici&#243;n exitosa');

        return redirect()->action('PeriodosController@index');
    }

    public function delete($id)
    {
		$periodo = Periodo::findOrFail($id);

		return view('periodos/delete')->with('periodo', $periodo);
    }

    public function destroy($id)
    {
    	$periodo = Periodo::findOrFail($id);

    	$periodo->delete();

    	Session::flash('flash_message', 'Periodo eliminado satisfactoriamente');

    	return redirect()->action('PeriodosController@index');
    }

    public function buscar(Request $request)
    {
    	$query = 'SELECT p.id, p.periodo, p.cantidad, p.total, p.estado, b.nombre AS "banda", d.nombre AS "disco", s.nombre AS "servicio", pa.nombre AS "pais" FROM periodos p 
    			INNER JOIN bandas b ON p.banda_id = b.id 
    			INNER JOIN discos d ON p.disco_id = d.id 
    			INNER JOIN servicios s ON p.servicio_id = s.id 
    			INNER JOIN paises pa ON p.pais_id = pa.id';
        
        $datos = array();
        $primero = true;

        if ($request->periodo != '')
        {
        	$query .= ' WHERE p.periodo LIKE "%' . $request->periodo . '%"';
        	$datos['periodo'] = $request->periodo;
        	$primero = false;
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

        if ($request->disco != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE d.nombre LIKE "%' . $request->disco . '%"';
        		$datos['disco'] = $request->disco;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND d.nombre LIKE "%' . $request->disco . '%"';
        		$datos['disco'] = $request->disco;
        	}
        }

        if ($request->servicio != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE s.nombre LIKE "%' . $request->servicio . '%"';
        		$datos['servicio'] = $request->servicio;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND s.nombre LIKE "%' . $request->servicio . '%"';
        		$datos['servicio'] = $request->servicio;
        	}
        }

        if ($request->pais != '')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE pa.nombre LIKE "%' . $request->pais . '%"';
        		$datos['pais'] = $request->pais;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND pa.nombre LIKE "%' . $request->pais . '%"';
        		$datos['pais'] = $request->pais;
        	}
        }

        if ($request->estado != '0')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE p.estado = "' . $request->estado . '"';
        		$datos['estado'] = $request->estado;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND p.estado = "' . $request->estado . '"';
        		$datos['estado'] = $request->estado;
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

        return view('periodos/search')
        	->with('listaPeriodos', $paginatedSearchResults)
        	->with('parametrosQuery', $datos);
    }
}
