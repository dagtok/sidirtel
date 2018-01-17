<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Directorio extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

  function index()
  {
  if($this->session->userdata('logged_in')) {
    $this->load->model('unidades');
    $this->load->model('personas');

    $info_persona = new stdClass();
    $info_persona->_id = null;
    $info_persona->unidad_id = null;
    $info_persona->clasificacion_ur = null;
    $info_persona->extension = null;
    $info_persona->nombre = null;
    $info_persona->cargo = null;
    $info_persona->area = null;
    $info_persona->unidad = null;

    $data =  array();

    //Registrar nueva persona
    if (isset($_POST) && sizeof($_POST) > 0) {
      //echo "<pre>";
      //print_r($_POST);
      //echo "</pre>";
      //exit;
      
      if(isset($_POST['id'])){
        $this->personas->actualizar($_POST);
      } else {
        $this->personas->registrar($_POST);  
      }
      redirect('directorio', 'refresh');
    }
    
    if (isset($_GET) && isset($_GET['id']) && isset($_GET['action'])) { //Borrar
      if($_GET['action'] == 'delete') { //Borrar usuario
        $this->personas->borrar($_GET['id']);
      }
    } elseif (isset($_GET) && isset($_GET['id'])) {
      $data['id'] = $_GET['id'];
      $info_persona = $this->personas->getInfoPersona($data['id']);
      //echo "<pre>";
      //print_r($info_persona);
      //echo "</pre>";
      //exit;
    }
    
    $data['usuario'] = $this->session->userdata('logged_in');
    $data['clasificaciones'] = $this->unidades->getClasificaciones();
    $data['unidades'] = ( (isset($_GET) && isset($_GET['id']) && isset($info_persona)) ? $this->unidades->filtrarPorNivel($info_persona->clasificacion_ur) : []);
    $data['info_persona'] = $info_persona;
    
    if($data['usuario']['tipo'] == 'manager'){
      $data['personas'] = $this->personas->obtenerTodas();
    } elseif($data['usuario']['tipo'] == 'unidad'){
      $data['personas'] = $this->personas->filtrar($data['usuario']['unidad_id']);
    }

    /*echo "<pre>";
    print_r($info_persona);
    print_r($data);
    echo "</pre>";
    exit;*/

    $this->load->view('directorio_view', $data);

   } else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
   
  }

  function buscar(){
    if(isset($_GET['s']) && strlen($_GET['s']) > 0){
      
      $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

      $query = new MongoDB\Driver\Query(['$text' => ['$search' => $_GET['s'] ]], ['projection' => ['nombre' => 1] ]);

      $cursor = $manager->executeQuery('sidirtel.personal', $query);
      $cursor = $cursor->toArray();

      echo json_encode($cursor);

    } else {
      echo '[]';
    }
  }
    

}

?>