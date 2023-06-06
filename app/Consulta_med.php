<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Consulta_med extends Model
{
    protected $table='consultas_med';

public function scopeBusca($query){

	return $query ->join('personas','consultas_med.paciente','personas.id_p')
            		->join('sintomas','consultas_med.sintoma', 'sintomas.id')
            		->select('personas.nombre_p as nombre_paciente','personas.apellido as apellido_paciente','consultas_med.obs as obs', 'consultas_med.fecha as fecha', 'sintomas.desc_sintoma as sintoma')
            ->orderBy('fecha','DESC');
}

public function scopePaciente($query, $paciente){
	if($paciente){
	return $query -> where(DB::raw("CONCAT(nombre_p,' ',apellido)"), 'LIKE',"%$paciente%");
	}
}

public function scopeFecha($query, $fecha){
	if($fecha != null){
	return $query -> where('consultas_med.fecha',$fecha);
	}
}

}
