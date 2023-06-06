<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Empleado;
use App\User;
use App\Tarjeta;
use App\Visita;
use App\Empresa;
use App\Externo;
use Auth;
use DB;
Use Session;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;

class VisitaController extends Controller
{
    public function index()
    {
        //Verifica si el usuario que desea ingresar tiene acceso para hacerlo
        $acceso = DB::table('usuario_accesos')
        ->where('usuario_accesos.usuario',auth()->user()->id)
        ->where('usuario_accesos.acceso','5')
        ->first();

        if ( $acceso == null) {
            Auth::logout();
            Session::flash('message','Acceso denegado');
            
            return redirect ('/');
        };

        $tarjetas = DB::table('tarjetas')->where('libre',0)->get();

        return view ('visita.index', array('tarjetas'=>$tarjetas));
    }

    
    public function create()
    {
        //
    }

    //Registra la asignación de una tarjeta a una visita
    public function store(Request $request)
    {
        $tarjeta = DB::table('tarjetas')->where('id_tar',$request['tarjeta'])->first();

        if($tarjeta == null){
            Notification::warning('Tarjeta ingresada es incorrecta, por favor verifique los datos');
            return redirect()->action('VisitaController@asignar');
        }
        else{
            $aux = DB::table('visitas')->where('visitas.tarjeta',$request['tarjeta'])->where('visitas.activa',1)->first();

            if($aux != null){
                Notification::warning('Tarjeta ingresada se encuentra asignada, por favor verifique los datos');
                return redirect()->action('VisitaController@asignar');

            }
            else{

                $tar = DB::table('tarjetas')
                ->where('id_tar',$request['tarjeta'])
                ->update(['libre' => 0]);

                $visita = new Visita;
                $visita->interno = $request['interno'];
                $visita->externo = $request['externo'];
                $visita->tarjeta = $request['tarjeta'];
                $visita->activa = 1;
                $visita->save();


                Notification::success('Tarjeta asignada con éxito');
                return redirect('visitas');
            }
        }
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

    }

    //Busca la información necesaria para cargar la pantalla de asignación de tarjetas
    public function asignar()
    {
        $empresas = DB::table('empresas')->orderBy('razon_social','asc')->get();

        $tarjetas = DB::table('tarjetas')->where('libre',1)->get();

        $internos = DB::table('personas')
        ->where('personas.nombre_p','!=','Guardia')
        ->where('personas.nombre_p','!=','Sala de Reuniones')
        ->where('personas.nombre_p','!=','Pasillo Esteriles')
        ->orderBy('apellido','asc')->get();

        return view ('visita.asignar', array('empresas'=>$empresas, 'internos'=>$internos, 'tarjetas'=>$tarjetas));
    }

    //Busca los exteros que pertenezcan a una cierta empresa
    public function getExterno($id){

        return DB::table('externos')->where('empresa_ext',$id)->get();
    }


    //Elimina la relación entre una tarjeta y una visita
    public function baja(Request $request)
    {
        $tarjeta = DB::table('tarjetas')->where('id_tar',$request['id'])->first();

        if($tarjeta == null){

            Notification::warning('Tarjeta ingresada es incorrecta, por favor verifique los datos');
        }
        else{

            $aux = DB::table('visitas')->where('visitas.tarjeta',$tarjeta->id_tar)->where('visitas.activa',1)->first();
            
            $visita = Visita::find($aux->id_vis);
            $visita->activa = 0;
            $visita->save();

            $tarjeta = DB::table('tarjetas')
            ->where('id_tar',$request['id'])
            ->update([
                'libre' => 1]);

            Notification::success('Tarjeta dada de baja con éxito');
        }   
        

        return redirect('visitas');
    }

    //pantalla que muestra las visitas registradas, tanto activas como inactivas
    public function consulta(Request $request)
    {
        //Obtiene lo ingresado en la busqueda por tarjeta
        $tarjeta = $request->get('tarjeta');

        //Obtiene lo ingresado en la busqueda por visitante
        $visitante = $request->get('visitante');

        //Obtiene lo ingresado en la busqueda por visita_a
        $visita_a = $request->get('visita_a');

        //Obtiene lo ingresado en la busqueda por estado
        $estado = $request->get('estado');


        if($estado == 2 || $estado == null){   
            if($visitante == null){
                if($visita_a == null){
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
                else{
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where(function($q) use ($visita_a) {
                        $q->where('personas.nombre_p','LIKE', "%$visita_a%")
                        ->orWhere('personas.apellido', 'LIKE', "%$visita_a%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
            }else{
                if($visita_a == null){
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where(function($q) use ($visitante) {
                        $q->where('externos.nombre_ext','LIKE', "%$visitante%")
                        ->orWhere('externos.apellido_ext', 'LIKE', "%$visitante%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
                else{
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where(function($q) use ($visitante) {
                        $q->where('externos.nombre_ext','LIKE', "%$visitante%")
                        ->orWhere('externos.apellido_ext', 'LIKE', "%$visitante%");
                    })
                    ->where(function($q) use ($visita_a) {
                        $q->where('personas.nombre_p','LIKE', "%$visita_a%")
                        ->orWhere('personas.apellido', 'LIKE', "%$visita_a%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
            }
        }
        else{
            if($visitante == null){
                if($visita_a == null){
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where('visitas.activa',$estado)
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
                else{
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where('visitas.activa',$estado)
                    ->where(function($q) use ($visita_a) {
                        $q->where('personas.nombre_p','LIKE', "%$visita_a%")
                        ->orWhere('personas.apellido', 'LIKE', "%$visita_a%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
            }else{
                if($visita_a == null){
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where('visitas.activa',$estado)
                    ->where(function($q) use ($visitante) {
                        $q->where('externos.nombre_ext','LIKE', "%$visitante%")
                        ->orWhere('externos.apellido_ext', 'LIKE', "%$visitante%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin', 'visitas.activa as activa')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
                else{
                    $visitas = DB::table('visitas')
                    ->leftjoin('personas','visitas.interno','personas.id_p')
                    ->leftjoin('externos','visitas.externo','externos.dni')
                    ->leftjoin('tarjetas','visitas.tarjeta','tarjetas.id_tar')
                    ->leftjoin('empresas','externos.empresa_ext','empresas.id_emp')
                    ->where('visitas.tarjeta','LIKE',"%$tarjeta%")
                    ->where('visitas.activa',$estado)
                    ->where(function($q) use ($visitante) {
                        $q->where('externos.nombre_ext','LIKE', "%$visitante%")
                        ->orWhere('externos.apellido_ext', 'LIKE', "%$visitante%");
                    })
                    ->where(function($q) use ($visita_a) {
                        $q->where('personas.nombre_p','LIKE', "%$visita_a%")
                        ->orWhere('personas.apellido', 'LIKE', "%$visita_a%");
                    })
                    ->select('visitas.tarjeta as tarjeta','externos.nombre_ext as visitante_nombre' , 'externos.apellido_ext as visitante_apellido','empresas.razon_social as empresa', 'personas.nombre_p as visita_a_nombre', 'personas.apellido as visita_a_apellido', 'visitas.created_at as fecha_inicio', 'visitas.updated_at as fecha_fin')
                    ->orderBy('fecha_inicio','desc')
                    ->paginate(20);
                }
            }
        }
        return view ('visita.consulta', array('visitas'=>$visitas, 'tarjeta'=>$tarjeta, 'visita_a'=>$visita_a, 'visitante'=>$visitante, 'estado'=>$estado));
    }


    public function añadir_empresa(Request $request)
    {
        $aux=DB::table('empresas')->where('empresas.razon_social',$request['razon_social'])->count();

        if($aux == 0){
        $empresa = new Empresa;
        $empresa->razon_social = $request['razon_social'];
        $empresa->save();
        }
        else{
            Notification::warning('Razon social ingresada ya existe');
        }
        return redirect()->action('VisitaController@asignar');
    }


    public function añadir_externo(Request $request)
    {

        $aux=DB::table('externos')->where('externos.dni',$request['dni'])->count();

        if($aux == 0){
            $externo = new Externo;
            $externo->dni = $request['dni'];
            $externo->nombre_ext = $request['nombre_ext'];
            $externo->apellido_ext = $request['apellido_ext'];
            $externo->telefono_ext = $request['telefono_ext'];
            $externo->empresa_ext = $request['empresa_ext'];
            $externo->save();
            Notification::success('Persona ingresada con éxito');
        }
        else{
            Notification::warning('DNI ingresado ya existe');
        }

        return redirect()->action('VisitaController@asignar');
    }

}


