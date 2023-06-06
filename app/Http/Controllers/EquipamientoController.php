<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use App\Equipamiento;
use App\Puesto;
use App\Relacion;
use App\Persona;
use App\Incidente;
use App\User;
use Auth;
use DB;
Use Session;
use Illuminate\Routing\Controller;
use Krucas\Notification\Facades\Notification;
use Krucas\Notification\Middleware\NotificationMiddleware;
use Carbon\Carbon;

class EquipamientoController extends Controller
{   

    public function index(Request $request)
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

         //Buca en la DB todos los tipos de equipamientos para completar el desplegable
        $tipo_equipamiento = DB::table('tipo_equipamiento')->orderBy('equipamiento','asc')->get();

                    $equipamientos = Equipamiento::Ip($request->get('ip'))
                    ->Equipo($request->get('equipo'))
                    ->Relaciones($request->get('tipo'))
                    ->Puesto($request->get('puesto'))
                    ->Area($request->get('area'))
                    ->Usuario($request->get('usuario'))
                    ->paginate(20);
                
        return view ('equipamiento.inicio', array('equipamientos'=>$equipamientos, 'equipo'=>$request->get('equipo'),'puesto'=>$request->get('puesto'),'ip'=>$request->get('ip'),'tipo_equipamiento'=>$tipo_equipamiento, 'usuario'=>$request->get('usuario'), 'area'=>$request->get('area'), 'acceso'=>$acceso));
    }

    public function create()
    {
        //Busca en la BD los tipos de equipamiento disponibles
        $tipo_equipamiento = DB::table('tipo_equipamiento')->get();

        return view ('equipamiento.create_equipamiento', array('tipo_equipamiento' => $tipo_equipamiento));
    }

    public function store(Request $request)
    {
        $equipamiento= new Equipamiento;
        $equipamiento->id_e = $request['id_e'];
        $equipamiento->marca = $request['marca'];
        $equipamiento->modelo = $request['modelo'];
        $equipamiento->num_serie = $request['num_serie'];
        $equipamiento->ip = $request['ip'];
        $equipamiento->obs = $request['obs'];
        $equipamiento->pulgadas = $request['pulgadas'];
        $equipamiento->procesador = $request['procesador'];
        $equipamiento->disco = $request['disco'];
        $equipamiento->memoria = $request['memoria'];
        $equipamiento->tipo = $request['tipo'];
        $equipamiento->toner = $request['toner'];
        $equipamiento->unidad_imagen = $request['unidad_imagen'];
        $equipamiento->oc = $request['oc'];
        $equipamiento->save();

        Notification::success('Equipamiento agregado con éxito');

        return redirect('equipamiento');
    }

    public function edit($id)
    {   
        $equipamientos = DB::table('equipamientos')
        ->leftjoin('tipo_equipamiento','equipamientos.tipo','tipo_equipamiento.id')
        ->where('equipamientos.id_e',$id)
        ->first();

        //Busca en la BD los tipos de equipamiento disponibles
        $tipo_equipamiento = DB::table('tipo_equipamiento')->get();

        if($equipamientos){
        return view ('equipamiento.edit', array('tipo_equipamiento' => $tipo_equipamiento, 'equipamiento' => $equipamientos));
        }
        else{
            return view ('errors.view');   
        }
    
    }

    
    public function update(Request $request, $id)
    {   
        $equipamiento = DB::table('equipamientos')
        ->where('equipamientos.id_e',$id)
        ->update([
            'id_e' => $request['id_e'],    
            'marca' => $request['marca'],
            'modelo' => $request['modelo'],
            'num_serie' => $request['num_serie'],
            'ip' => $request['ip'],
            'obs' => $request['obs'],
            'pulgadas' => $request['pulgadas'],
            'procesador' => $request['procesador'],
            'disco' => $request['disco'],
            'memoria' => $request['memoria'],
            'tipo' => $request['tipo'],
            'toner' => $request['toner'],
            'unidad_imagen' => $request['unidad_imagen'],
            'oc' => $request['oc']
        ]);      
        
        Notification::success('Equipamiento modificado con éxito');
        
        return redirect('equipamiento');
    }
    
    public function show($id)
    {
        //
    }
    public function listado_ip(Request $request)
    {
        $listado= array();
        for($i=1; $i<255;$i++){          
        $equipamiento = Equipamiento::ListadoIp($i)->first();

            if($equipamiento == null){
                $listado[$i][0] = "10.41.20.".$i;
                $listado[$i][1]='Libre';
                $listado[$i][2]='';
                $listado[$i][3]='';
            }
            else{
             $listado[$i][0] = "10.41.20.".$i;
             $listado[$i][1]=$equipamiento->id_equipamiento;
             $listado[$i][2]=$equipamiento->tipo;
             $listado[$i][3]=$equipamiento->nombre.' '.$equipamiento->apellido;
         }
     }

     return view ('equipamiento.listado_ip', array('listado'=> $listado));
 }

   //****************PUESTOS**********************

 public function puestos(Request $request)
 {
            $puestos = Puesto::Relaciones()            
            ->Puesto($request->get('puesto'))
            ->Usuario($request->get('usuario'))
            ->Area($request->get('area'))
            ->orderBy('desc_puesto','asc')
            ->paginate(20);

    return view ('equipamiento.puestos', array('puestos'=>$puestos, 'puesto'=>$request->get('puesto'),'usuario'=>$request->get('usuario'), 'area'=>$request->get('area')));
}


public function create_puesto()
{   
    $area = DB::table('area')->get();

    $aux = DB::table('puestos')->where('persona','!=',null)->get();
    foreach ($aux as $aux1) {
        $data[] = $aux1->persona;
    }

    $personas = DB::table('personas')->whereNotIn('id_p', $data)->orderBy('personas.nombre_p', 'asc')->get();

    return view ('equipamiento.create_puesto', array('area' => $area , 'personas' => $personas));

}


public function store_puesto(Request $request)
{
    $puesto= new Puesto;
    $puesto->desc_puesto = $request['desc_puesto'];
    $puesto->area = $request['area'];
    $puesto->persona = $request['persona'];
    $puesto->telefono_ip = $request['telefono_ip'];
    $puesto->save();

    Notification::success('Puesto agregado con éxito');

    return redirect('puestos');
}

public function edit_puesto($id)
{   
    $puestos = DB::table('puestos')
    ->leftjoin('personas','puestos.persona','personas.id_p')
    ->leftjoin('area','puestos.area','area.id_a')
    ->where('puestos.id_puesto',$id)
    ->first();

    $areas = DB::table('area')->get();

    $personas = DB::table('personas')->get();

    return view ('equipamiento.edit_puesto', array('puesto' => $puestos,'area' => $areas, 'personas' => $personas));
}


public function update_puesto(Request $request)
{   
    $puesto = DB::table('puestos')
    ->where('puestos.id_puesto',$request['id'])
    ->update([
        'desc_puesto' => $request['desc_puesto'],
        'area' => $request['area'],
        'persona' => $request['persona'],
        'telefono_ip' => $request['telefono_ip'],
    ]);      

    Notification::success('Puesto modificado con éxito');

    return redirect('puestos');
}

   //****************RELACIONES**********************


    //Pantalla donde se define la relacion equipamiento - puesto
public function relacion(Request $request)
{
    $aux= DB::table('relaciones')->where('relaciones.estado',1)->get();
    foreach ($aux as $aux1) {
        $data[] = $aux1->equipamiento;
    }

    $equipamientos =  DB::table('equipamientos')->whereNotIn('id_e', $data)->get();

    $puestos=DB::table('puestos')
    ->leftjoin('personas','puestos.persona','personas.id_p')
    ->orderBy('puestos.desc_puesto')->get();

    $equipo = DB::table('equipamientos')->where('equipamientos.id_e', $request['id_equipamiento'])->first();

    return view ('equipamiento.relacion', array('equipamientos' => $equipamientos, 'equipo' => $equipo ,'puestos' => $puestos));
}

public function store_relacion(Request $request)
{

    $relacion= new Relacion;
    $relacion->equipamiento = $request['equipamiento'];
    $relacion->puesto = $request['puesto'];
    $relacion->estado = 1;
    $relacion->save();

    Notification::success('Relacion agregada con éxito');

    return redirect('equipamiento');

}
    //Elimina la relación entre equipamiento y puesto
public function destroy_relacion(Request $request)
{
    $relacion = DB::table('relaciones')->where('relaciones.id_r',$request['relacion'])
    ->update([
        'estado'=> 0]);

    Notification::success('Relación eliminada con éxito con éxito');

    return redirect('equipamiento');
}

   //****************INCIDENTES**********************
public function incidentes(Request $request){

      $incidentes = Incidente::busca($request->get('resuelto'))
      ->Equipamiento($request->get('equipamiento'))
      ->paginate(20);

return view ('equipamiento.incidentes', array('incidentes'=>$incidentes, 'equipamiento' => $request->get('equipamiento')));

}

public function create_incidente(Request $request)
{   

    $equipamientos = DB::table('equipamientos')->where('equipamientos.id_e',$request['id_equipamiento'])->first();


    return view ('equipamiento.create_incidente', array('equipamientos' => $equipamientos));

}

public function store_incidente(Request $request)
{
    $incidente = new Incidente;
    $incidente->descripcion = $request['descripcion'];
    $incidente->solucion = $request['solucion'];
    $incidente->equipamiento = $request['equipamiento'];

    if($request['resuelto'] == 1){
        $incidente->resuelto = $request['resuelto'];
    }
    else{
        $incidente->resuelto = 0;
    }

    $incidente->save();

    Notification::success('Incidente agregado con éxito');

    return redirect('equipamiento');

}

public function update_incidente(Request $request)
{   
    $incidente = DB::table('incidentes')
    ->where('incidentes.id_i',$request['incidente'])
    ->update([
        'solucion' => $request['solucion'],
        'resuelto' => 1
    ]);      

    Notification::success('Incidente resuelto');

    return redirect('incidentes');
}

//****************USUARIOS**********************
public function usuarios (Request $request){


    $usuarios = DB::table('users')->orderBy('users.name','asc')->get();

    $accesos = DB::table('accesos')->get();

    $usuario_accesos = DB::table('usuario_accesos')
    ->join('users','usuario_accesos.usuario','users.id')
    ->leftjoin('accesos','usuario_accesos.acceso','accesos.id')
    ->select('usuario_accesos.usuario as id_usuario', 'accesos.acceso as acceso')
    ->get();
    
    return view ('equipamiento.usuarios', array('usuarios'=>$usuarios, 'usuario_accesos'=>$usuario_accesos, 'accesos'=>$accesos));
}

public function create_usuario(Request $request){

    Auth::logout();

    return redirect('/register');

}

public function accesos(Request $request)
{
        //Verifica si el usuario ya tiene acceso a donde está solicitando
    $acceso = DB::table('usuario_accesos')
    ->where('usuario_accesos.usuario',$request['usuario'])
    ->where('usuario_accesos.acceso',$request['acceso'])
    ->get()
    ->count();

    if ( $acceso == 0) {

        DB::table('usuario_accesos')->insert(
            ['usuario' => $request['usuario'], 'acceso' => $request['acceso']]);
        Notification::success('Acceso asignado con éxito');
        return redirect ('/usuarios');              
    }
    else{
        Notification::warning('Acceso ya se encuentra asignado');
        return redirect ('/usuarios');   
    }

}

public function destroy_usuario($id)
{
    $usuario = User::find($id);
    $usuario->delete();
    Notification::success('Usuario eliminado con éxito');

    return redirect('/usuarios');
}

}