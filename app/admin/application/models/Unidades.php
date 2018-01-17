<?php
Class Unidades extends CI_Model
{
	function filtrarPorNivel($filtro){
		
		//$unidades = $this->ci_mongo->db->unidades->find( array('clase' => $filtro ) );


		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query( array('clase' => $filtro ) );

		$cursor = $manager->executeQuery('sidirtel.unidades', $query);
		$unidades = $cursor->toArray();

		//echo "<pre>";
		//print_r(iterator_to_array($unidades));
		//echo "</pre>";
		//exit;

		return $unidades;
	}

	function obtenerTodas(){
		// $unidades = $this->ci_mongo->db->unidades->find();
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query([]);

		$cursor = $manager->executeQuery('sidirtel.unidades', $query);
		$unidades = $cursor->toArray();

		return $unidades;
	}

	function getClasificaciones(){
		
		//$unidades = $this->ci_mongo->db->clasificaciones->find([]);
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query([]);

		$cursor = $manager->executeQuery('sidirtel.clasificaciones', $query);
		$clasificaciones = $cursor->toArray();

		return $clasificaciones;
	}
}
?>