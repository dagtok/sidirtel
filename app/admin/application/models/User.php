<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		/*
		$usuario = $this->ci_mongo->db->usuarios->findOne(array('usuario' => $username ,'password' => $password, 'status' => 'activo'));
		
		if(is_array($usuario)) {
	    	return $usuario;
	   	} else {
	    	return false;
	   	}
	   	*/

	   	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query(array('usuario' => $username ,'password' => $password, 'status' => 'activo'));

		$cursor = $manager->executeQuery('sidirtel.usuarios', $query);
		$usuario = $cursor->toArray();

		if(is_array($usuario) && isset($usuario[0])) {
	    	return $usuario[0];
	   	} else {
	    	return false;
	   	}
	}

	function getInfoUsuario($id)
	{
		
		//$usuario = $this->ci_mongo->db->usuarios->findOne(array('_id' => new MongoId($id)));

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query( [ '_id' => new MongoDB\BSON\ObjectID($id) ] );

		$cursor = $manager->executeQuery('sidirtel.usuarios', $query);
		$usuario = $cursor->toArray();

		if(is_array($usuario)) {
	    	return $usuario[0];
	   	} else {
	    	return false;
	   	}
	}

	function getAll()
	{
		//$cursor = $this->ci_mongo->db->usuarios->find();
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query(array());

		$cursor = $manager->executeQuery('sidirtel.usuarios', $query);
		$usuario = $cursor->toArray();


	   	$personasArray = $usuario;

	   	return $personasArray;
	   	
	}

	function registrar($user)
	{

		if(
			isset($user['clasificacion_unidad_id']) && $user['clasificacion_unidad_id'] != '' &&
		    isset($user['unidad_id']) && $user['unidad_id'] != '' &&
		    isset($user['nombre']) && $user['nombre'] != '' &&
		    isset($user['email']) && $user['email'] != '' &&
		    isset($user['tipo']) && $user['tipo'] != '' &&
		    isset($user['usuario']) && $user['usuario'] != '' &&
		    isset($user['password']) && $user['password'] != '' &&
		    isset($user['confirm_password']) && $user['confirm_password'] != ''
	    	){
			
			if($user['password'] == $user['confirm_password']){
				//$this->ci_mongo->db->usuarios->insert($user);

				$user['status'] = "activo";

				$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
				$bulk = new MongoDB\Driver\BulkWrite;
				$bulk->insert($user);
				$manager->executeBulkWrite('sidirtel.usuarios', $bulk);

			} else {
				//el password y contraseña deben ser iguales
			}
		}
	}

	function actualizar($usuario){

		if(
			1 == 1	
			){
			/*
			$this->ci_mongo->db->usuarios->update(
		          array('_id' => new MongoId($usuario['id']) ),
		          array('$set' => $usuario)
			);*/

			$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
			$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->update( [ '_id' => new MongoDB\BSON\ObjectID($usuario['id']) ], ['$set' => $usuario] );
			$manager->executeBulkWrite('sidirtel.usuarios', $bulk);
		}
	}

	function borrar($user_id){
		// $this->ci_mongo->db->usuarios->remove(array('_id' => new MongoId($user_id) ), array("justOne" => true));
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->delete( [ '_id' => new MongoDB\BSON\ObjectID($user_id) ], ['limit' => 0] );
		$manager->executeBulkWrite('sidirtel.usuarios', $bulk);
	}

	function mostrarPassword($user_id){
		//$user_data = $this->ci_mongo->db->usuarios->findOne(array('_id' => new MongoId($user_id) ), array("password"));

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$query = new MongoDB\Driver\Query( array('_id' => new MongoDB\BSON\ObjectID($user_id) ), array("password") );
		$cursor = $manager->executeQuery('sidirtel.usuarios', $query);
		$user_data = $cursor->toArray();

		return $user_data[0]->password;
	}
	
	function resetearPassword($user_id){
		//$user_data = $this->ci_mongo->db->usuarios->findOne(array('_id' => new MongoId($user_id) ), array("password"));
		
		$longitud = mt_rand(8, 12);

	    $palabras = 'el,la,amar,comer,reir,brincar,correr,caminar,hablar,cocinar,colorear,pintar,chatear,navegar,conducir,descubrir,responder,preguntar,barrer,cambiar,desayunar,ganar,perder,buscar,escribir,rayar,marcar,hacer,mirar,conservar,checar,tocar,mover,observar,cerrar,abrir,voltear,expulsar,empacar,pegar,poner,golpear,ir,asustar,uir,gustar,sentir,nacer,deslumbrar,regresar,volver,escuchar,maltratar,sonar,trapear,cantar,bailar,esconder,traer,limpiar,morder,agarrar,meter,sacar,demoler,devolver,moler,bajar,subir,apurar,lavar,maulllar,';
	    $palabras .= 'rojo,rojoNaranja,naranja,ambar,amarillo,lima,verdePuro,verdeCian,cian,ceruleo,azul,violeta,magenta,fucsia,oscuros,granate,caoba,marron,marronDorado,oliva,verde,palta,verde,estandar,esmeralda,cerceta,azulMarino,azulPurpura,purpura,vino,agrisados,lacre,cobre,canela,dorado,verdeManzana,verdeBosque,verdeMar,turquesa,azulAcero,zafiro,amatista,purpureo,fandango,claros,coral,salmon,melon,crema,maiz,teVerde,verdeClaro,menta,aguamarina,celeste,bigaro,lavanda,malva,rosado';
	 
	    $palabras = explode(',', $palabras);
	    //if (count($palabras) == 0){ die('El listado de palabras esta vacio!'); }
	 
	    $nuevo_password = '';
	    while (strlen($nuevo_password) < $longitud){
	        $r = mt_rand(0, count($palabras)-1);
	        $nuevo_password .= $palabras[$r];
	    }
	 
	    $num = mt_rand(100, 999);
	    if ($longitud > 2){
	        $nuevo_password = substr($nuevo_password,0,$longitud-strlen($num)).$num;
	    } else { 
	        $nuevo_password = substr($nuevo_password, 0, $longitud);
	    }

		/*
		$this->ci_mongo->db->usuarios->update(
		          array('_id' => new MongoId($user_id) ),
		          array('$set' => array('password' => $nuevo_password) )
			);
		*/
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update( [ '_id' => new MongoDB\BSON\ObjectID($user_id) ], ['$set' => array('password' => $nuevo_password) ] );
		$manager->executeBulkWrite('sidirtel.usuarios', $bulk);

		return $nuevo_password;
	}

	function activar($user_id){
		/*
		$this->ci_mongo->db->usuarios->update(
		          array('_id' => new MongoId($user_id) ),
		          array('$set' => array('status' => "activo") )
			);
		*/

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update( [ '_id' => new MongoDB\BSON\ObjectID($user_id) ], ['$set' => array('status' => "activo") ] );
		$manager->executeBulkWrite('sidirtel.usuarios', $bulk);

		return 0;
	}

	function desactivar($user_id){
		/*
		$this->ci_mongo->db->usuarios->update(
		          array('_id' => new MongoId($user_id) ),
		          array('$set' => array('status' => "inactivo") )
			);*/

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update( [ '_id' => new MongoDB\BSON\ObjectID($user_id) ], ['$set' => array('status' => "inactivo") ] );
		$manager->executeBulkWrite('sidirtel.usuarios', $bulk);

		return 0;
	}
}
?>