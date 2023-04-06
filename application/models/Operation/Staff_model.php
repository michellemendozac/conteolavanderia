<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Staff_model extends CI_Model {
 
    // Vehicle list
    public function Staff_list()
	{
        $this->db->select("p.id, p.id_sitio, p.id_empresa, p.nombre, p.puesto, p.telefono, p.estado, e.nombre empresa, s.nombre sitio");
		$this->db->from("cat_personal p", "left");
        $this->db->join("cat_empresas e","e.id_empresa = p.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = p.id_sitio","left");
         //$this->db->where("id_usuario",$_SESSION["user"]["id"]);
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }


    // Vehicle list
    public function info_staff($i)
    {
        $this->db->select("p.id, p.id_sitio, p.id_empresa, p.nombre, p.puesto, p.telefono, p.estado, e.nombre empresa, s.nombre sitio");
        $this->db->from("cat_personal p", "left");
        $this->db->join("cat_empresas e","e.id_empresa = p.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = p.id_sitio","left");
        $this->db->where("p.id",$i['id']);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }
 
    public function add_staff($data){
        $this->db->insert('cat_personal',$data);
		return $this->db->insert_id();   
    }

    public function update_staff($data,$id){
        $this->db->where('id',$id);
        return $this->db->update('cat_personal',$data);
    }
 

}