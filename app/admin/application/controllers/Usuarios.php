<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $usuario = $this->session->userdata('logged_in');
   if($usuario && $usuario['tipo'] == 'manager'){ //Si esta loggeado y es tipo manager
        $this->load->model('user');
        $this->load->model('unidades');
        $user_info = new stdClass();    
        $user_info->_id = null;
        $user_info->clasificacion_unidad_id = null;
        $user_info->unidad_id = null;
        $user_info->nombre = null;
        $user_info->email = null;
        $user_info->tipo = null;
        $user_info->usuario = null;
        $user_info->password = null;
        $user_info->confirm_password = null;
        $user_info->unidad = null;
        $user_info->status = null;
        
        //Registrar nueva persona
        if (isset($_POST) && sizeof($_POST) > 0) {
          
          if(isset($_POST['id'])){
            $this->user->actualizar($_POST);
          } else { 
            //registrado con exito
            $this->user->registrar($_POST);
            unset($_POST);

          }
          
        }
        
        if (isset($_GET) && isset($_GET['id']) && isset($_GET['action'])) { //Borrar
          if($_GET['action'] == 'delete') { //Borrar usuario
            $this->user->borrar($_GET['id']);
          } elseif($_GET['action'] == 'view_password') { //Ver password
            $this->user->obtenerPassword($_GET['id']);
          } elseif($_GET['action'] == 'activate') { //Activar usuario
            $this->user->activar($_GET['id']);
          } elseif($_GET['action'] == 'deactivate') { //Desactivar usuario
            $this->user->desactivar($_GET['id']);
          }
          
        } elseif (isset($_GET) && isset($_GET['id'])) {//Editar usuario
          $data['id'] = $_GET['id'];
          $user_info = $this->user->getInfoUsuario($data['id']);
        }
        
        $usuarios = $this->user->getAll();
        $data['usuario'] = $this->session->userdata('logged_in');
        $data['clasificaciones'] = $this->unidades->getClasificaciones();
        $data['unidades'] = ( (isset($_GET) && isset($_GET['id']) && isset($user_info)) ? $this->unidades->filtrarPorNivel($user_info->clasificacion_unidad_id) : []);
        $data['user_info'] = $user_info;
        $data['usuarios'] = $this->user->getAll();

        //echo "<pre>";
        //print_r($data);
        //echo "</pre>";
        //exit;

        $this->load->view('usuarios_view', $data);
   } else {
     //If no session, redirect to login page
     redirect('login', 'refresh');
   }
 }

 function reiniciarPassword(){
    if(isset($_POST) && $_POST['id']){
      $this->load->model('user');
      $new_password = $this->user->resetearPassword($_POST['id']);
      echo $new_password;
    }
 }

 function mostrarPassword(){
    if(isset($_POST) && $_POST['id']){
      $this->load->model('user');
      $new_password = $this->user->mostrarPassword($_POST['id']);
      echo $new_password;
    }
 }


}

?>