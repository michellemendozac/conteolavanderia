<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Existence_model extends CI_Model {
 
    // Vehicle list
    public function Existence_list()
	{  
        $this->db->select("v.id_tabla_inventario, v.id_prenda, v.id_empresa, v.id_sitio, v.id_colaborador, v.estado inv_status, pre.nombre prenda, pre.categoria id_categoria, cat.categoria, e.nombre empresa, s.nombre sitio, p.nombre colaborador, p.company_code, p.columna emp_col, p.fila emp_fil, p.ubicacion emp_ub, p.turno, p.estado col_status");
		$this->db->from("tabla_inventario v", "left");                                                                         
        $this->db->join("cat_prendas pre","pre.id_prenda = v.id_prenda","left");
        $this->db->join("cat_categoria cat","cat.id_categoria = pre.categoria","left");
        $this->db->join("cat_empresas e","e.id_empresa = v.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = v.id_sitio","left");
        $this->db->join("cat_colaboradores p","p.id_colaborador = v.id_colaborador","left");
        $this->db->where("v.estado",1);
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

     

    public function info_add_emp($colab){
        $this->db->select("p.id_sitio, p.id_empresa, p.columna, p.ubicacion, p.fila");	
        $this->db->from("cat_colaboradores p");  
        $this->db->where("id_colaborador",$colab);
        $query = $this->db->get();

		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        }

    }

    public function add_item($data){
        $this->db->insert('tabla_inventario',$data);
		return $this->db->insert_id();   
    }

    public function del_item($data,$id){
        $this->db->where('id_tabla_inventario',$id);
        return $this->db->update('tabla_inventario',$data);
    }
 

}