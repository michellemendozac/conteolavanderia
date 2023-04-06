<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Login_model extends CI_Model {
    
    // get login database
    public function check_login($user, $password)
	{ 
        $this->db->select("*");
		$this->db->from("cat_usuario");
        $this->db->where("username",$user);		
        $this->db->where("password",$password);
        $this->db->where("estado",1);             
        $query = $this->db->get();                 
		if($query->num_rows()>0){            
		    return $query->row_array();
		}else{
            return false;	 		
		}
    }  
     
    public function send_email($email){
        $this->dbmaster->select("email");
		$this->dbmaster->from("usuarios");
        $this->dbmaster->where("email",$email);        
        $query = $this->dbmaster->get(); 
            
        //check email in db
		if($query->num_rows()>0){ 
            //load code
            //send email
            return true;
            
		}else{			
			return false; 			
		}
    }
 
	
}