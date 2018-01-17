<?php
Class Personas extends CI_Model
{
	
	function getInfoPersona($id){
		
		//$persona = $this->ci_mongo->db->personal->findOne(array('_id' => new MongoId($id)));
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$query = new MongoDB\Driver\Query( array('_id' => new MongoDB\BSON\ObjectID($id) ) );
		$cursor = $manager->executeQuery('sidirtel.personal', $query);
		$persona = $cursor->toArray();

		return $persona[0];
	}

	function obtenerTodas()
	{
		//$cursor = $this->ci_mongo->db->personal->find();
	   	//$personasArray = iterator_to_array($cursor);

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query( array() );

		$cursor = $manager->executeQuery('sidirtel.personal', $query);
		$personasArray = $cursor->toArray();

	   	return $personasArray;
	   	
	}

	function filtrar($unidad_id)
	{
		//$cursor = $this->ci_mongo->db->personal->find(['unidad_id' => $unidad_id]);
	   	//$personasArray = iterator_to_array($cursor);

	   	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query( ['unidad_id' => $unidad_id] );

		$cursor = $manager->executeQuery('sidirtel.personal', $query);
		$personasArray = $cursor->toArray();

	   	return $personasArray;
	   	
	}

	function registrar($persona){

		if(
			isset($persona['unidad_id']) && $persona['unidad_id'] != '' && 
	    	isset($persona['clasificacion_ur']) && $persona['clasificacion_ur'] != '' &&
	    	isset($persona['extension']) && $persona['extension'] != '' &&
	    	isset($persona['nombre']) && $persona['nombre'] != '' &&
	    	isset($persona['cargo']) && $persona['cargo'] != '' &&
	    	isset($persona['area']) && $persona['area'] != '' &&
	    	isset($persona['unidad']) && $persona['unidad'] != ''){

			//$this->ci_mongo->db->personal->insert($persona);
			$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
			$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->insert($persona);
			$manager->executeBulkWrite('sidirtel.personal', $bulk);

		}
	}

	function actualizar($persona){

		if(
			1 == 1	
			){

			/*
			$this->ci_mongo->db->personal->update(
		          array('_id' => new MongoId($persona['id']) ),
		          array('$set' => $persona)
			);
			*/

			$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
			$bulk = new MongoDB\Driver\BulkWrite;
			$bulk->update( [ '_id' => new MongoDB\BSON\ObjectID($persona['id']) ], ['$set' => $persona] );
			$manager->executeBulkWrite('sidirtel.personal', $bulk);
			
		}
	}

	function borrar($persona_id){
		//$this->ci_mongo->db->personal->remove(array('_id' => new MongoId($persona_id) ), array("justOne" => true));

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->delete( [ '_id' => new MongoDB\BSON\ObjectID($persona_id) ], ['limit' => 0] );
		$manager->executeBulkWrite('sidirtel.personal', $bulk);
	}
}
?>