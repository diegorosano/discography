<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use Auth;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Periodo;

class MiembrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('user');
    }
    
    public function index()
    {
    	$listaPeriodos = Periodo::where('banda_id', AUth::user()->banda_id)->where('estado', 'listo')->paginate(10);

        return view('miembros/index')
        	->with('listaPeriodos', $listaPeriodos);
    }

    public function buscar(Request $request)
    {
    	$query = 'SELECT p.periodo, p.cantidad, p.total, b.nombre AS "banda", d.nombre AS "disco", s.nombre AS "servicio", pa.nombre AS "pais" FROM periodos p 
    			INNER JOIN bandas b ON p.banda_id = b.id 
    			INNER JOIN discos d ON p.disco_id = d.id 
    			INNER JOIN servicios s ON p.servicio_id = s.id 
    			INNER JOIN paises pa ON p.pais_id = pa.id WHERE p.banda_id = "' . Auth::user()->banda_id . '" 
    			AND p.estado = "listo"';
        
        $datos = array();

        if ($request->periodo != '')
        {
        	$query .= ' AND p.periodo LIKE "%' . $request->periodo . '%"';
        	$datos['periodo'] = $request->periodo;
        }

        if ($request->disco != '')
        {

        	$query .= ' AND d.nombre LIKE "%' . $request->disco . '%"';
        	$datos['disco'] = $request->disco;
        }

        if ($request->servicio != '')
        {
        	$query .= ' AND s.nombre LIKE "%' . $request->servicio . '%"';
        	$datos['servicio'] = $request->servicio;
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

        return view('miembros/search')
        	->with('listaPeriodos', $paginatedSearchResults)
        	->with('parametrosQuery', $datos);
    }
}
