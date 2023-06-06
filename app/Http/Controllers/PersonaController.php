<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Persona;
use App\Permiso;
use App\Empleado;
use App\User;
use Auth;
use DB;
Use Session;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;



class PersonaController extends Controller
{
    public function index(Request $request)
    {
        $acceso = DB::table('usuario_accesos')
        ->where('usuario_accesos.usuario',auth()->user()->id)
        ->where('usuario_accesos.acceso','1')
        ->first();

        if ( $acceso == null) {
            Auth::logout();
            Session::flash('message','Acceso denegado');
            
            return redirect ('/');
        };
        $personas = Persona::orderBy('nombre','asc')
        ->Empresa($request->get('empresa'))
        ->Nombre($request->get('nombre'))
        ->paginate(50);

    return view ('persona.index', array('personas' => $personas, 'nombre' => $request->get('nombre'), 'empresa' => $request->get('empresa') ,'acceso' => $acceso));
}

public function create()
{

    return view ('persona.create');
}

public function store(Request $request)
{
    $creador = auth()->user()->id;

    $personas = new Persona;
    $personas->nombre = $request['nombre'];
    $personas->apellido = $request['apellido'];
    $personas->direccion = $request['direccion'];
    $personas->empresa = $request['empresa'];
    $personas->interno = $request['interno'];
    $personas->telefono = $request['telefono'];
    $personas->celular = $request['celular'];
    $personas->correo = $request['correo'];
    $personas->creador = $creador;
    $personas->save();
    Notification::success('Contacto agregado con éxito');
    return redirect('persona');
}

public function show($id)
{
//        
}

public function edit($id)
{
    $personas = Persona::find($id);
    return view ('persona.edit', ['persona' => $personas]);
}

public function update(Request $request, $id)
{
    $modificador = auth()->user()->id;

    $personas = Persona::find($request['id']);

    $personas->nombre = $request['nombre'];
    $personas->apellido = $request['apellido'];
    $personas->direccion = $request['direccion'];
    $personas->empresa = $request['empresa'];
    $personas->interno = $request['interno'];
    $personas->telefono = $request['telefono'];
    $personas->celular = $request['celular'];
    $personas->correo = $request['correo'];
    $personas->modificador = $modificador;
    $personas->save();
    
    Notification::success('Contacto modificado con éxito');
    
    return redirect('persona');
}

public function destroy($id)
{
    $personas = Persona::find($id);
    $personas->delete();
    Notification::success('Contacto eliminado con éxito');
    
    return redirect('persona');
}

}
