<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Visit_model extends CI_Model {

    
    // Vehicle list
    public function Visit_list($today = "")
	{
        $this->db->select("v.id_visita, v.estado, v.h_inicio, v.h_fin, v.turno, v.band_atendio, e.nombre empresa,  s.id_sitio, s.nombre sitio, p.nombre atendio");
		$this->db->from("tabla_visitas v", "left");
        $this->db->join("cat_empresas e","e.id_empresa = v.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = v.id_sitio","left");
        $this->db->join("cat_personal p","p.id = v.id_resp_entrega","left");
         
          
            if($today != ""){
                $tomorrow = date("Y-m-d", strtotime ("+ 1 day")); 
                $this->db->where('v.h_inicio >= ',$today);
                $this->db->where('v.h_inicio <= ',$tomorrow);
            } 

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

    public function Visit_select_list($sitio)
	{
        $this->db->select("v.id_visita, v.estado, v.h_inicio, v.h_fin, v.turno, v.band_atendio, e.nombre empresa,  s.id_sitio, s.nombre sitio");
		$this->db->from("tabla_visitas v", "left");
        $this->db->join("cat_empresas e","e.id_empresa = v.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = v.id_sitio","left");
            
        //$tomorrow = date("Y-m-d h", strtotime ("+ 1 day")); 
        $this->db->where('v.h_inicio >= ',date('Y-m-d h'));

        
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }


    public function Info_Visit($visit_id)
	{
        $this->db->select("v.id_visita, v.h_inicio, v.estado, v.info_visita, v.id_resp_recepcion, v.comentarios, v.h_fin, v.turno, v.band_atendio, e.nombre empresa, s.id_sitio idsitio, s.nombre sitio, s.direccion, s.ubicacion, p.nombre atendio");
		$this->db->from("tabla_visitas v", "left");
        $this->db->join("cat_empresas e","e.id_empresa = v.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = v.id_sitio","left");
        $this->db->join("cat_personal p","p.id = v.id_resp_entrega","left");
         
        $this->db->where('v.id_visita',$visit_id);
        

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        }
    }

    public function employe_list()
	{
        $this->db->select("e.*, s.nombre sucursalname");
		$this->db->from("cat_colaboradores e", "left");        
        $this->db->join("cat_sitios s"," s.id_sitio = e.id_sitio ","left");
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

    public function Order_list()
	{
        $this->db->select("*");
		$this->db->from("tabla_pedidos");
        $this->db->where('estado',"1"); 
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false; 
        }
    }
 
    public function staff_list($sitio=0,$company=0)
	{
        $this->db->select("*");
		$this->db->from("cat_personal");
        if($company==0){
            $this->db->where('id_sitio',$sitio); 
        }
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }
 

    public function update_visit($data,$id){
        $this->db->where('id_visita',$id);
        return $this->db->update('tabla_visitas',$data);
    }  



    public function place_list($company)
	{
        $this->db->select("*");
        $this->db->from("cat_sitios");  
        $this->db->where("id_empresa",$company);  
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

    public function select_list($company,$table,$dsc_company = "id_empresa",$where = 0){
        $this->db->select("*");
        $this->db->from($table);  
        if($where == 0){
            $this->db->where($dsc_company,$company);  
        }
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

    public function employe_list_sel($company,$sitio=0)
    {
        $this->db->select("p.id_colaborador, p.nombre, p.company_code, e.nombre empresa, s.nombre sitio");
        $this->db->from("cat_colaboradores p", "left");
        $this->db->join("cat_empresas e","e.id_empresa = p.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = p.id_sitio","left");
        $this->db->where("p.id_empresa",$company);
        if($sitio>0){
            $this->db->where("p.id_sitio",$sitio);
        }
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function add_emp($data){
        $this->db->insert('cat_colaboradores',$data);
		return $this->db->insert_id();   
    }

    public function add_visit($data){
        $this->db->insert('tabla_visitas',$data);
		return $this->db->insert_id();   
    }

    public function add_delivery($data){
        $this->db->insert('tabla_entregas',$data);
		return $this->db->insert_id();
    }

    public function update_order($data,$id){
        $this->db->where('id_pedido',$id);
        return $this->db->update('tabla_pedidos',$data);
    } 

    public function delete_delivery($order){
        $this->db->where('id_pedido',$order);
        return $this->db->delete('tabla_entregas');
    }

    public function visitorder_list($order){
        $this->db->select("*");
        $this->db->from("tabla_entregas");  
        $this->db->where("id_pedido",$order);  
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }
    }

    public function info_emp($id)
    {
        $this->db->select("p.*, e.nombre empresa, s.nombre sitio");
        $this->db->from("cat_colaboradores p", "left");
        $this->db->join("cat_empresas e","e.id_empresa = p.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = p.id_sitio","left");
        $this->db->where("p.id_colaborador",$id);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }


    public function update_emp($data,$id){
        $this->db->where('id_colaborador',$id);
        return $this->db->update('cat_colaboradores',$data);
    }

}