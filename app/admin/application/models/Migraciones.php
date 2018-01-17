<?php
Class Migraciones extends CI_Model
{
	
	function migrar_unidades(){

		$this->load->database(); 

		$query = $this->db->query("
		SELECT TURIPN.TUR_PK_UR CLAVE_UR, 
			TURIPN.TUR_NOMBRE UNIDAD, 
			TURIPN.TUR_SIGLA SIGLA, 
			TURIPN.CLASEGLOBAL CLASE_GLOBAL,
			TURIPN.CLASE,
			CUR_CLASIFICACION.CLA_CLASIFICACION CLASIFICACION
		FROM TURIPN, CUR_CLASIFICACION
		WHERE
			TURIPN.CLASE = CUR_CLASIFICACION.CLA_PK_CLASIFICACION
		ORDER BY CUR_CLASIFICACION.CLA_PK_CLASIFICACION, TURIPN.TUR_NOMBRE
		");

		return $query->result();
	}

	function migrar_clasificaciones(){

		$this->load->database(); 

		$query = $this->db->query("
		SELECT
			CUR_CLASIFICACION.CLA_PK_CLASIFICACION clasificacion,
			CUR_CLASIFICACION.CLA_CLASIFICACION descripcion
		FROM
			`CUR_CLASIFICACION`
		");

		return $query->result();
	}

	function migrar_directorio(){

		$this->load->database(); 

		$query = $this->db->query("
		SELECT	* FROM directorio
		");

		return $query->result();
	}
}
?>