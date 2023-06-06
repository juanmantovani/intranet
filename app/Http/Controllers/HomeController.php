<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use DB;
use Auth;
use App\Novedad;
Use Session;
use Mail;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;
use Carbon\Carbon;


class HomeController extends Controller
{
    public function index()
    {
        //Busca novedades en la DB que estén vigentes para mostrarlas en pantalla
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $novedades = DB::table('novedades')->where('novedades.fecha_desde','<=',$date)->where('novedades.fecha_hasta','>=',$date)->paginate(10);

        return view ('home.inicio', array('novedades'=>$novedades));
    }

    public function internos()
    {
        $personas = DB::table('personas')
        ->where('personas.interno','>=','0')
        ->leftjoin('area', 'area.id_a', 'personas.area')
        ->orderBy('interno','ASC')
        ->paginate(200);    
        
        return view ('internos.internos', array('personas'=>$personas));
    }
    public function novedades()
    {
        return view ('home.create_novedades');

    }
    public function store_novedades(Request $request)
    {
        if(strlen($request['descripcion'])<=80){

        $personas = DB::table('personas')->select('correo')->where('personas.rango',1)->orwhere('personas.rango',2)->orderBy('nombre_p')->get();

        $novedad= new Novedad;
        $novedad->descripcion = $request['descripcion'];
        $novedad->fecha_desde = $request['fecha_desde'];
        $novedad->fecha_hasta = $request['fecha_hasta'];
        $novedad->save();

        //Si al crear una novedad, se indica que es necesario enviar la notificacion por mail
        if ($request['enviar_correo'] == 1){
            Mail::send('home.mail',array('novedad'=>$novedad), function($message) use ($personas,$novedad){
                $message->from('notificaciones@lafedar.com', 'Notificaciones');
                foreach ($personas as $persona) {
                    $message->to($persona->correo)->subject('Nueva novedad');
                }
            });
        }      
        
        Notification::success('Novedad agregada con éxito');
        
        return redirect('empleado');

        }else{
            Notification::warning('La descripción es demasiado extensa, intentelo nuevamente');
            return back();
        }
    }

    public function sistemas()
    {
        //Verifica si el usuario que desea ingresar tiene acceso para hacerlo
        $acceso = DB::table('usuario_accesos')
        ->where('usuario_accesos.usuario',auth()->user()->id)
        ->where('usuario_accesos.acceso','4')
        ->first();

        if ( $acceso == null) {
            Auth::logout();
            Session::flash('message','Acceso denegado');
            
            return redirect ('/');
        };
        return view ('home.sistemas', array('acceso' => $acceso));

    }
}
