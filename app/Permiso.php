<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Permiso extends Model
{
        protected $table='permisos';

	public function scopeRelaciones($query, $jefe,$motivo){
    		
    		if($motivo == 0){
    			return $query->join('personas','permisos.autorizado','personas.id_p')
                ->join('tipo_permiso','permisos.motivo','tipo_permiso.id_tip')
                ->join('jefe_area','personas.area','jefe_area.area')
                ->where('jefe_area.jefe',$jefe)
                ->select('personas.nombre_p as nombre_autorizado','personas.apellido as apellido_autorizado' , 'permisos.created_at as fecha_permiso','permisos.fecha_desde as fecha_desde','permisos.fecha_hasta as fecha_hasta','tipo_permiso.desc as motivo', 'permisos.id as id','permisos.hora_desde as hora_desde','permisos.hora_hasta as hora_hasta')
                ->orderBy('fecha_permiso','DESC');
            }
            else{
            	return $query->join('personas','permisos.autorizado','personas.id_p')
                ->join('tipo_permiso','permisos.motivo','tipo_permiso.id_tip')
                ->join('jefe_area','personas.area','jefe_area.area')
                ->where('jefe_area.jefe',$jefe)
                ->where('permisos.motivo',$motivo)
                ->select('personas.nombre_p as nombre_autorizado','personas.apellido as apellido_autorizado' , 'permisos.created_at as fecha_permiso','permisos.fecha_desde as fecha_desde','permisos.fecha_hasta as fecha_hasta','tipo_permiso.desc as motivo', 'permisos.id as id','permisos.hora_desde as hora_desde','permisos.hora_hasta as hora_hasta')
                ->orderBy('fecha_permiso','DESC');
            }
    }
    public  function scopeEmpleado ($query, $empleado)
    {
    	if($empleado){
    	return $query -> where(DB::raw("CONCAT(nombre_p,' ',apellido)"), 'LIKE',"%$empleado%");
    	
    	}
    }

    public function scopeJefe ($query){

    	return $query -> where('personas.rango','!=',1);
    }

    public function scopeBuscaPermiso($query, $id){

    	return $query ->join('personas','permisos.autorizado','personas.id_p')
        ->join('area','personas.area','area.id_a')
        ->join('tipo_permiso','permisos.motivo','tipo_permiso.id_tip')
        ->join('jefe_area','personas.area','jefe_area.area')
        ->where('permisos.id',$id)
        ->select('personas.nombre_p as nombre_autorizado','personas.apellido as apellido_autorizado' , 'permisos.created_at as fecha_permiso','permisos.fecha_desde as fecha_desde', 'permisos.fecha_hasta as fecha_hasta','tipo_permiso.desc as motivo', 'permisos.id as id','permisos.hora_desde as hora_desde','permisos.hora_hasta as hora_hasta','permisos.descripcion as descripcion','area.nombre_a as area');
    }

}