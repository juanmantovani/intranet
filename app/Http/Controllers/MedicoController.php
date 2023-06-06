<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\User;
use App\Empleado;
use App\Sintoma;
use App\Consulta_med;
use Auth;
use DB;
Use Session;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;
use Carbon\Carbon;

class MedicoController extends Controller
{
    public function index(Request $request)
    {
        //Verifica si el usuario que desea ingresar tiene acceso para hacerlo
        $acceso = DB::table('usuario_accesos')
        ->where('usuario_accesos.usuario',auth()->user()->id)
        ->where('usuario_accesos.acceso','6')
        ->first();

        if ( $acceso == null) {
            Auth::logout();
            Session::flash('message','Acceso denegado');
            
            return redirect ('/');
        };
            $consultas = Consulta_med::Busca()
            ->Paciente($request->get('paciente')) 
            ->Fecha($request->get('fecha'))
            ->paginate(10);
       return view ('medico.index', array('consultas'=>$consultas,'paciente'=>$request->get('paciente'),'fecha'=>$request->get('fecha')));
   }


   public function create()
   {
    $personas = Empleado::where('activo',1)->orderBy('apellido','asc')->get();


    $sintomas = DB::table('sintomas')->orderBy('desc_sintoma','asc')->get();

    return view ('medico.create_consulta', array('personas' => $personas,'sintomas' => $sintomas ));
}

public function store(Request $request)
{
    $consulta_nueva = new Consulta_med;
    $consulta_nueva->paciente = $request['paciente'];
    $consulta_nueva->sintoma = $request['sintoma'];
    $consulta_nueva->obs = $request['observacion'];
    $consulta_nueva->fecha = $request['fecha'];
    $consulta_nueva->save();

    Notification::success('Consulta agregada con éxito');
    return redirect('medico');
}

public function show($id)
{
        //
}

public function edit($id)
{
        //
}
public function update(Request $request, $id)
{
        //
}
public function destroy($id)
{
        //
}
public function añadir_sintoma(Request $request)

{
    $aux=DB::table('sintomas')->where('sintomas.desc_sintoma',$request['sintoma'])->count();

    if($aux == 0){
        $sintoma = new Sintoma;
        $sintoma->desc_sintoma = $request['sintoma'];
        $sintoma->save();
    }
    else{
        Notification::warning('Sintoma ingresado ya existe');
    }
    return redirect()->action('MedicoController@create');
}

public function historia_clinica (){

    $personas = Empleado::where('activo',1)->orderBy('apellido','asc')->get();

    return view ('medico.historia_clinica',array('personas' => $personas));
}

}
