<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Persona;
use App\Empleado;
use App\User;
use Auth;
use DB;
Use Session;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;

class EmpleadoController extends Controller
{

    public function index(Request $request)
    {
        //Verifica si el usuario que desea ingresar tiene acceso para hacerlo
        $acceso = DB::table('usuario_accesos')
        ->where('usuario_accesos.usuario',auth()->user()->id)
        ->where('usuario_accesos.acceso','3')
        ->first();

        if ( $acceso == null) {
            Auth::logout();
            Session::flash('message','Acceso denegado');
            
            return redirect ('/');
        };

        $empleados = Empleado::Relacion()->get();

        return view ('empleado.index', array('empleados' => $empleados));
    }

    public function create()
    {
        $area = DB::table('area')->get();

        return view ('empleado.create', ['area' => $area]);
    }
    
    public function store(Request $request)
    {
        $empleado = new Empleado;
        $empleado->nombre_p = $request['nombre'];
        $empleado->apellido = $request['apellido'];
        $empleado->dni = $request['dni'];
        $empleado->interno = $request['interno'];
        $empleado->correo = $request['correo'];
        $empleado->fe_nac = $request['fe_nac'];
        $empleado->fe_ing = $request['fe_ing'];
        $empleado->area = $request['area'];
        $empleado->activo = 1;
        $empleado->rango = 3;
        $empleado->save();

        Notification::success('Empleado agregado con éxito');
        
        return redirect('empleado');
    }
    
    public function show($id)
    {

    }

    public function edit($id)
    {
        $empleados = DB::table('personas')
        ->leftjoin('area','personas.area','area.id_a')
        ->where('personas.id_p',$id)
        ->first();

        $area = DB::table('area')->get();
        
        return view ('empleado.edit', ['empleado' => $empleados], ['area' => $area]);
    }

    
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->nombre_p = $request['nombre'];
        $empleado->apellido = $request['apellido'];
        $empleado->dni = $request['dni'];
        $empleado->interno = $request['interno'];
        $empleado->correo = $request['correo'];
        $empleado->fe_nac = $request['fe_nac'];
        $empleado->fe_ing = $request['fe_ing'];
        $empleado->area = $request['area'];
        $empleado->save();

        Notification::success('Empleado modificado con éxito');

        return redirect('empleado');
    }

    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->activo = 0;
        $empleado->save();

        Notification::success('Empleado dado de baja con éxito');

        return redirect('empleado');       
    }
}
