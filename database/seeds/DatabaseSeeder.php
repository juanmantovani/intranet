<?php

use Illuminate\Database\Seeder;
use App\Persona;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('mi_agenda')->delete();
	    DB::table('users')->delete();

    	
    	self::seedPersona();
       self::seedUser();

     }

    private function seedPersona(){

		foreach( $this->arrayPersonas as $personas ) {
		$p = new Persona;
		$p->documento = $personas['documento'];
		$p->nombre = $personas['nombre'];
		$p->apellido = $personas['apellido'];
		$p->direccion = $personas['direccion'];
		$p->numero = $personas['numero'];
		$p->es_familiar = $personas['es_familiar'];
		$p->save();
	}
	}

	private function seedUser(){
   	
    	foreach( $this->arrayUsuarios as $usuario ) {
    	$p = new User;
    	$p->name = $usuario['name'];
    	$p->email = $usuario['email'];
    	$p->password = bcrypt($usuario['password']);
    	$p->save();
  	  }
  	}

  	private $arrayUsuarios = array(
  		array(
  			'name'=>'Juan',
  			'email'=>'juan@hotmail.com',
  			'password'=>'juan',
  		),
  		array(
  			'name'=>'Damian',
  			'email'=>'damian@hotmail.com',
  			'password'=>'damian',
  		)
  	);


     private $arrayPersonas = array(
		array(
			'documento' => '33123456',
			'nombre' => 'Juan', 
			'apellido' => 'Gonzalez', 
			'direccion' => 'Av larralde 1512', 
			'numero' =>'0343156123321',
			'es_familiar' => false,
			),
		array(
			'documento' => '37523888',
			'nombre' => 'Maria', 
			'apellido' => 'Gonzalez', 
			'direccion' => 'Av larralde 1512', 
			'numero' =>'0343156123344',
			'es_familiar' => false, 
			),
		array(
			'documento' => '21523778',
			'nombre' => 'Victoria', 
			'apellido' => 'Martinez', 
			'direccion' => 'Av Americas 456', 
			'numero' =>'0343156123754',
			'es_familiar' => false, 
			),
		array(
			'documento' => '29554666',
			'nombre' => 'Homero', 
			'apellido' => 'Simpsons', 
			'direccion' => 'Av Siempre Vivas 1234', 
			'numero' =>'0343155258741',
			'es_familiar' => true, 
			),
		array(
			'documento' => '26951753',
			'nombre' => 'Laura', 
			'apellido' => 'Gimenez', 
			'direccion' => 'Av Rivadavia 325', 
			'numero' =>'0343154852159',
			'es_familiar' => false, 
			),
		array(
			'documento' => '35112256',
			'nombre' => 'Pedro', 
			'apellido' => 'Lescamoso', 
			'direccion' => 'Av Ramirez 25', 
			'numero' =>'0343154155661',
			'es_familiar' => true, 
		)
	);

}
