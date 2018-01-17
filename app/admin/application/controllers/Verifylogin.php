<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function index()
 {
   //Este metodo va a traer las validaciones
   $this->load->library('form_validation');

   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

   if($this->form_validation->run() == FALSE)
   {
     //Field validation failed.  User redirected to login page
     $this->load->view('login_view');
   } else {
     //Go to private area
     redirect('directorio', 'refresh');
   }

 }

 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->user->login($username, $password);
 
   if(gettype($result) == 'object') {
     
     $sess_array = array(
          'id' => (string) $result->_id,
          'clasificacion_unidad_id' => $result->clasificacion_unidad_id,
          'unidad_id' => $result->unidad_id,
          'unidad' => $result->unidad,
          'nombre' => $result->nombre,
          'email' => $result->email,
          'tipo' => $result->tipo,
          'usuario' => $result->usuario
      );
      
      $this->session->set_userdata('logged_in', $sess_array);

      return TRUE;

   } else {
     
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return FALSE;
     
   }
 }
}
?>