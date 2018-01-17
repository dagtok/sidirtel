<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Centros extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   if($this->session->userdata('logged_in'))
   {

    $this->load->model('unidades');
    //$data['unidades'] = $this->unidades->filtrarPorNivel('NS');
    //echo "<pre>";
		// print_r($unidades);
		// echo "</pre>";
		// exit;

    //$this->load->model('personas');
    
    // $info_persona = null;
    // $data = array();

    // if (isset($_POST) && sizeof($_POST) > 0) { //Va a registrar o actualizar un registro
      /*if(isset($_POST['id'])){ //El usuario va a actualizar un registro
        $this->personas->actualizar($_POST);
      } else { // Va a registrar un nuevo 
        $this->personas->registrar($_POST);  
      }*/
    // }

    //Editar usuario
    /*
    if (isset($_GET) && isset($_GET['id'])) {

      $id = $_GET['id'];
      $data['id'] = $id;
      $info_persona = $this->personas->getInfoPersona($id);

    }*/
    
    $session_data = $this->session->userdata('logged_in');
    
    $data['usuario'] = $this->session->userdata('logged_in');
    //$data['clasificaciones'] = $this->unidades->getClasificaciones();
    $data['unidades'] = $this->unidades->obtenerTodas();
    //$data['info_persona'] = $info_persona;
    //$data['personas'] = $this->personas->getPersonas();

    

    $this->load->view('centros_view', $data);

   } else {
     
     redirect('login', 'refresh');

   }
   
 }

 function filtrarPorNivel()
 {
    //if($this->session->userdata('logged_in') && isset($_POST) && sizeof($_POST) > 0) {
    $this->load->model('unidades');

    $centros = $this->unidades->filtrarPorNivel($_POST['clasificacion']);
    $items = [];
    foreach ($centros as $centro) {
      $option = new stdClass();
      $option->value = $centro->clave_ur;
      $option->text =  $centro->unidad;
      array_push($items, $option);
    }

    echo json_encode($items);
 }

}

?>