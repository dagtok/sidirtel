<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migracion extends CI_Controller {

	public function migrar_unidades()
	{
		$this->load->model('migraciones');
		
		$unidades_sql = $this->migraciones->migrar_unidades();

		$conexion = new MongoClient();

		// select a database
		$db = $conexion->sidirtel;
	   	echo "Database mydb selected";
	   
	   	$collection = $db->unidades;
	   	echo "Collection selected succsessfully";
		
	   	foreach ($unidades_sql as $unidad) {

	   		$record = new stdClass();

		    $record->clave_ur = $unidad->CLAVE_UR;
		    $record->unidad = $unidad->UNIDAD;
		    $record->sigla = $unidad->SIGLA;
		    $record->clase_global = $unidad->CLASE_GLOBAL;
		    $record->clase = $unidad->CLASE;
		    $record->clasificacion = $unidad->CLASIFICACION;
			
			echo "<pre>";
			print_r($record);
			echo "<pre>";

			$collection->insert($record);
		}

	}

	public function migrar_clasificaciones()
	{
		$this->load->model('migraciones');
		
		$clasificaciones_sql = $this->migraciones->migrar_clasificaciones();

		$conexion = new MongoClient();

		// select a database
	   $db = $conexion->sidirtel;
	   echo "Database mydb selected";
	   
	   $collection = $db->clasificaciones;
	   echo "Collection selected succsessfully";
		
	   foreach ($clasificaciones_sql as $record) {
			echo "<pre>";
			print_r($record);
			echo "<pre>";

			$collection->insert($record);
		}
	}

	public function generar_directorio()
	{
		$this->load->model('migraciones');
		
		$directorio_sql = $this->migraciones->migrar_directorio();
		

		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");
		$bulk = new MongoDB\Driver\BulkWrite;

		foreach ($directorio_sql as $persona) {
			
			if($persona->nombre != ''){
				$persona->unidad_id = '';
				$persona->clasificacion_ur = '';
				echo "<pre>";
				print_r($persona);
				echo "<pre>";

				$bulk->insert($persona);
			}
		}
		
		
		$manager->executeBulkWrite('sidirtel.personal', $bulk);
		/*
		$conexion = new MongoClient();

		// select a database
	   	$db = $conexion->sidirtel;
	   	echo "Database mydb selected";
	   
	   $collection = $db->clasificaciones;
	   echo "Collection selected succsessfully";
		
	   */
	}
}
