<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Catalog_model extends CI_Model {
 
    // Vehicle list
    public function Catalog_list($company)
	{       
        $company_name = "";
        if($company > 0){
            $company_name = ",e.nombre empresa";
        }
 
        $this->db->select("p.id_prenda, p.precio, p.nombre, p.marca, p.existencia, p.color, p.genero, p.estado, p.descripcion, p.foto $company_name");
		$this->db->from("cat_prendas p", "left");

                    
            if($company > 0){
                $this->db->join("cat_empresas e","e.id_empresa = $company","left");
            } 

        $this->db->where("p.estado","1");
        $this->db->order_by("p.categoria","1");

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }

    }

     // Vehicle list
     public function Catalog_info($id)
     {     
         $this->db->select("*");
         $this->db->from("cat_prendas");
         $this->db->where("id_prenda",$id);    
         $query = $this->db->get();
         if($query->num_rows()>0){
             return $query->row_array();
         }else{
             return false;
         } 
     }
 

     public function update_cat($data,$id){
        $this->db->where('id_prenda',$id);
        return $this->db->update('cat_prendas',$data);
    }

}