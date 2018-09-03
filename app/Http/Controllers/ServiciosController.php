<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use DB;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Servicio;


class ServiciosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('activo');
        $this->middleware('admin');
    }
    
    public function index()
    {
    	$listaServicios = Servicio::paginate(10);
        return view('servicios/index')
        	->with('listaServicios', $listaServicios);
    }

    public function create()
    {
        return view('servicios/create');
    }

    public function show($id)
    {
        $servicio = Servicio::findOrFail($id);

        return view('servicios/show')->with('servicio', $servicio);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre' => 'required',
            'precio' => 'required',
            'descripcion' => 'required',
        ]);

        $servicio = new Servicio;

        $servicio->nombre = $request->nombre;

        $precio = str_replace(",",".", $request->precio);

        $servicio->precio = $precio;
        $servicio->descripcion = $request->descripcion;
        //Si preguntan, hago este metodo para guardar y no el create por que necesito hacer el replace de comas por puntos.
        $servicio->save();

        Session::flash('flash_message', 'Servicio creado satisfactoriamente');	
        return redirect()->action('ServiciosController@index');
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);

        return view('servicios/edit')
        	->with('servicio', $servicio);
    }

    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $servicio->nombre = $request->nombre;

        $precio = str_replace(",",".", $request->precio);

        $servicio->precio = $precio;
        $servicio->descripcion = $request->descripcion;
        //Si preguntan, hago este metodo para guardar y no el create por que necesito hacer el replace de comas por puntos.
        $servicio->save();

		Session::flash('flash_message', 'Edici&#243;n exitosa');

        return redirect()->action('ServiciosController@index');
    }

    public function delete($id)
    {
		$servicio = Servicio::findOrFail($id);

		return view('servicios/delete')->with('servicio', $servicio);
    }

    public function destroy($id)
    {
    	$servicio = Servicio::findOrFail($id);

    	$servicio->delete();

    	Session::flash('flash_message', 'Servicio eliminado satisfactoriamente');

    	return redirect()->action('ServiciosController@index');
    }

    public function buscar(Request $request)
    {
        $query = 'SELECT s.id, s.nombre, s.precio FROM servicios s';

        $primero = true;
        $datos[] = array();

        if ($request->nombre != '')
        {
            $query .= ' WHERE s.nombre LIKE "%' . $request->nombre . '%"';
            $primero = false;
            $datos['nombre'] = $request->nombre;
        }
        
        if ($request->menor != '')
        {
            if ($primero)
            {
                $query .= ' WHERE s.precio < "' . $request->menor . '"';
                $primero = false;    
            }
            else 
            {
                $query .= ' AND s.precio < "' . $request->menor . '"';
            }
            $datos['menor'] = $request->menor;
        }

        if ($request->mayor != '')
        {
            if ($primero)
            {
                $query .= ' WHERE s.precio > "' . $request->mayor . '"';
                $primero = false;    
            }
            else 
            {
                $query .= ' AND s.precio > "' . $request->mayor . '"';
            }
            $datos['mayor'] = $request->mayor;
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

        return view('servicios/search')
            ->with('listaServicios', $paginatedSearchResults)
            ->with('parametrosQuery', $datos);;
    }
}
