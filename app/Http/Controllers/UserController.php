<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

//Personales
use Auth;
use Session;
use Hash;
use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\User;
use App\Banda;
use App\Pais;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('activo');
    }

    public function index()
    {
        $queryUsers = User::paginate(10);
        $queryBandas = Banda::all();

        return view('usuarios/index')
            ->with('listaUsuarios', $queryUsers)
            ->with('listaBandas', $queryBandas);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$queryBandas = Banda::all();

            return view('usuarios/create')
            	->with('listaBandas', $queryBandas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'rol' => 'required',
            'activo' => 'required',
        ]);

        $array = $request->all();
        $array['password'] = Hash::make($request->password);
        User::create($array);
        Session::flash('flash_message', 'Usuario creado satisfactoriamente');	
        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $queryBandas = Banda::all();

        return view('usuarios/edit')
        	->with('usuario', $user)
            ->with('listaBandas', $queryBandas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

     	$user->name = $request->name;
     	$user->rol = $request->rol;
     	$user->banda_id = $request->banda_id;
        $user->estado = $request->estado;

		$user->save();
            
		Session::flash('flash_message', 'Edici&#243;n exitosa');

		if (\Auth::user()->id == $id)
        {
            if ($user->rol == 'administrador')
            {
                return redirect()->action('UserController@index');
            }
            else
            {
                return redirect()->action('PagesController@index');
            }
        }
        else
        {
            return redirect()->action('UserController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delete($id)
    {

    }

    public function search(Request $request)
    {
    	$query = 'SELECT u.id, u.name, u.email, u.rol, b.nombre AS "banda", u.estado FROM users u 
    		INNER JOIN bandas b ON u.banda_id = b.id';
        
        $datos = array();

        $primero = true;
        if ($request->nombre != '')
        {
        	$query .= ' WHERE u.name LIKE "%' . $request->nombre . '%"';
        	$datos['nombre'] = $request->nombre;
        	$primero = false;
        }

        if ($request->banda_id != '0')
        {
        	if ($primero)
        	{
        		$query .= ' WHERE u.banda_id = "' . $request->banda_id . '"';
        		$datos['banda_id'] = $request->banda_id;
        		$primero = false;
        	}
        	else
        	{
        		$query .= ' AND u.banda_id = "' . $request->banda_id . '"';
        		$datos['banda_id'] = $request->banda_id;
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

    	$queryBandas = Banda::all();

        return view('usuarios/search')
        	->with('listaUsuarios', $paginatedSearchResults)
        	->with('listaBandas', $queryBandas)
        	->with('parametrosQuery', $datos);;
    }

    public function cambiarPass($id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios/password')->with('usuario', $usuario);
    }

    public function cambio(Request $request)
    {
        $this->validate($request,[
            'password_nuevo' => 'required',
            'password_nuevo_2' => 'required',
        ]);
        if ($request->password_nuevo == $request->password_nuevo_2)
        {
            $usuario = User::findOrFail($request->id);
            $usuario->password = Hash::make($request->password_nuevo);
            $usuario->save();

            Session::flash('flash_message', 'Usuario modificado exitosamente');

            return redirect()->action('UserController@index');
        }
        else
        {
            return redirect()->back()->withErrors('Los valores ingresados no coinciden');
        }
    }
}
