<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
        parent::__construct();         
        $this->load->model('login_model');
	}
  
    //Load login 
	public function index()
	{    
        $custom = array("title" => "Login",
                        "form"  => "login/login");     
        $data["custom"] = $custom; 

        $this->load->view('login/main_login',$data);
    }
    
    //Start session
    public function start()
	{
        //Get data 
        $usuario  = $_POST["user"];
        $password = $_POST["password"];
 
        //Search user 
        $user = $this->login_model->check_login($usuario, $password);
  
        //If user exist, save and return true 
        if($user){       
                     
                $this->init($user);
                $this->load_system_data();
                //echo "true"; 
                echo "true";                                       
        }else{
            echo "Error: Usuario o contraseña incorrecto.";
        }
    }

    private function load_system_data(){       
        //$data["vehicle_status"] = $this->main_model->vehicle_status();

        $_SESSION["catalog"]    = '';
        
    }
    
    //Save user in session 
    private function init($user){
        $login = array("id"       => $user["id_usuario"],
                       "id_eplus" => $user["id_eplus"],
                       "puesto"   => $user["puesto"],
                       "nombre"   => $user["username"],
                       "foto"     => $user["foto"],
                       "company"  => $user["id_empresa"],
                       "site"     => $user["id_sitio"],
                       "priv"     => $user["privilegios"]);
        $_SESSION["user"]  = $login;        
    }

    //Close session
    public function cerrar_session(){
        session_destroy();
        header('Location:/Login');
    }
 
    //Load recovery view
    public function PasswordRecovery(){
        $custom = array("title" => "Recuperar Contraseña",
                        "form"  => "login/recovery");
        $data["custom"] = $custom; 
        $this->load->view('login/main_login',$data); 
    }

    //Send email recovery
    public function SendRecovery(){
        //Get data        
        $email  = $_POST["email"];

        //Search user in DB and send email
        $send = $this->login_model->send_email($email);
 
        //If email send, return true
         if($send){             
             echo "true";             
         }else{
             echo "false";
         }
    }
    

}
