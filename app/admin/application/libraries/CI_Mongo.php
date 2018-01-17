<?php

class CI_Mongo {

    public $db;

    function __construct()
    {   
        // Fetch CodeIgniter instance
        $ci = get_instance();
        // Load Mongo configuration file
        $ci->load->config('mongo');

        // Fetch Mongo server and database configuration
        $server = $ci->config->item('mongo_server');
        $username = $ci->config->item('mongo_username');
        $password = $ci->config->item('mongo_password');
        $dbname = $ci->config->item('mongo_dbname');

        // Initialise Mongo - Authentication required
        
            //parent::__construct("mongodb://$username:$password@$server/$dbname");
            //$m = new MongoClient("mongodb://heroku_m4b97brj:5rm1ub4c09s4dhn8m266i34669@ds141108.mlab.com:41108/heroku_m4b97brj");
            //$this->db = $m->selectDB('heroku_m4b97brj');
            
            //$usuario = $this->ci_mongo->db->usuarios->findOne(array('usuario' => $username ,'password' => $password, 'status' => 'activo'));

            $m = new MongoClient();
            $this->db = $m->selectDB('sidirtel');
            
            //$this->db = 'heroku_m4b97brj';
        /*try{
        }catch(MongoConnectionException $e){
            //Don't show Mongo Exceptions as they can contain authentication info
            $_error =& load_class('Exceptions', 'core');
            exit($_error->show_error('MongoDB Connection Error', $e.'A MongoDB error occured while trying to connect to the database!', 'error_db'));           
        }catch(Exception $e){
            $_error =& load_class('Exceptions', 'core');
            exit($_error->show_error('MongoDB Error',$e->getMessage(), 'error_db'));           
        }*/
    }
}