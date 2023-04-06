<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Counts_model extends CI_Model {
 
    // Vehicle list
    public function Countss_list()
	{
        $this->db->select("v.id_visita, v.h_inicio, v.h_fin, v.band_atendio, e.nombre empresa, s.nombre sitio, p.nombre atendio");
		$this->db->from("tabla_visitas v", "left");
        $this->db->join("cat_empresas e","e.id_empresa = v.id_empresa","left");
        $this->db->join("cat_sitios s"," s.id_sitio = v.id_sitio","left");
        $this->db->join("cat_personal p","p.id = v.id_resp_entrega","left");
           

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }  


    public function info_item($code_id)
	{
        $this->db->select("i.id_tabla_inventario id_code, i.id_sitio, i.estado, co.nombre colaborador, i.id_prenda, p.categoria, p.color, p.genero, c.categoria category_name");
		$this->db->from("tabla_inventario i", "left");
        $this->db->join("cat_prendas p","i.id_prenda = p.id_prenda","left");
        $this->db->join("cat_categoria c","c.id_categoria = p.categoria","left");
        $this->db->join("cat_colaboradores co","i.id_colaborador = co.id_colaborador","left");
        $this->db->where("i.id_tabla_inventario",$code_id);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        }  
    } 

    public function check_employe($code_empid,$count_id){
        $this->db->select("e.id_ingreso, e.id_inventario, e.estado, co.nombre colaborador, co.columna, co.fila, co.ubicacion,  i.id_prenda, p.categoria, p.color, p.genero, c.id_categoria, c.categoria category_name");		
		$this->db->from("tabla_entradas e", "left");
        $this->db->join("tabla_inventario i", "e.id_inventario = i.id_tabla_inventario", "left");
        $this->db->join("cat_prendas p","i.id_prenda = p.id_prenda","left");
        $this->db->join("cat_categoria c","c.id_categoria = p.categoria","left");
        $this->db->join("cat_colaboradores co","i.id_colaborador = co.id_colaborador","left");
        $this->db->where("e.id_conteo",$count_id);
        $this->db->where("co.id_colaborador",$code_empid);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }

    public function Ordercount_list($order_id){
        $this->db->select("c.id_conteo, c.id_pedido, c.h_reg, c.id_visita, c.estado, p.id_wd,");
		$this->db->from("tabla_conteos c", "left");
        $this->db->join("tabla_pedidos p", "p.id_conteo = c.id_conteo", "left");        
        $this->db->where("c.id_pedido",$order_id);
        $this->db->where_in("c.estado",[1,2,3,4]);
        
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }


    public function Count_list($conteo_id)
	{
        $this->db->select("e.*, co.nombre colaborador, i.id_prenda, p.categoria, p.color, p.genero, c.id_categoria, c.categoria category_name");
		$this->db->from("tabla_entradas e", "left");
        $this->db->join("tabla_inventario i", "e.id_inventario = i.id_tabla_inventario", "left");
        $this->db->join("cat_prendas p","i.id_prenda = p.id_prenda","left");
        $this->db->join("cat_categoria c","c.id_categoria = p.categoria","left");
        $this->db->join("cat_colaboradores co","i.id_colaborador = co.id_colaborador","left");
        $this->db->where("e.id_conteo",$conteo_id);
        $this->db->order_by("co.nombre,  p.categoria ");

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }

    public function select_item_order($visit_id,$order_id){  
        $this->db->select("e.id_ingreso, id_inventario, co.id_pedido, count(p.id_prenda) cantidad, p.categoria, p.nombre,   p.precio, (count(p.id_prenda) * p.precio) total  ");
        $this->db->from("tabla_entradas e"); 	
        $this->db->join("tabla_conteos co","co.id_conteo = e.id_conteo");
        $this->db->join("tabla_inventario i","i.id_tabla_inventario = e.id_inventario","left");
        $this->db->join("cat_prendas p","p.id_prenda = i.id_prenda","left");  
        $this->db->where("e.id_visita",$visit_id);
        $this->db->where("co.id_pedido",$order_id); 
        $this->db->where("co.estado",1); 
        $this->db->group_by("p.id_prenda");
        $query = $this->db->get();
        if($query->num_rows()>0){
            return $query->result();
        }else{
            return false;
        }  
    }

    public function Totalprice_ordercount($counts,$visit_id){  
            $this->db->select("sum(p.precio) total ");
            $this->db->from("tabla_entradas e"); 	
            $this->db->join("tabla_inventario i","i.id_tabla_inventario = e.id_inventario","left");
            $this->db->join("cat_prendas p","p.id_prenda = i.id_prenda","left");
            $this->db->where_in("e.id_conteo",$counts);
            $this->db->where("e.id_visita",$visit_id); 
            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->row_array();
            }else{
                return false;
            }  
    }


    public function Counttype_list($visit_id){
        $this->db->select("c.id_conteo, c.h_reg, c.id_visita, c.estado, p.id_wd,");
		$this->db->from("tabla_conteos c", "left");
        $this->db->join("tabla_pedidos p", "p.id_conteo = c.id_conteo", "left");        
        $this->db->where("c.id_visita",$visit_id);
        
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }

    public function order($id){
        $this->db->select("*");
		$this->db->from("tabla_pedidos"); 
        $this->db->where("id_pedido",$id);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }

    public function count_category($conteo_id,$id_categoria,$status)
	{
        $this->db->select("count(e.id_ingreso) total");
		$this->db->from("tabla_entradas e", "left");
        $this->db->join("tabla_inventario i", "e.id_inventario = i.id_tabla_inventario", "left");
        $this->db->join("cat_prendas p","i.id_prenda = p.id_prenda","left");
        $this->db->join("cat_categoria c","c.id_categoria = p.categoria","left");
       
        $this->db->where("e.id_conteo",$conteo_id);
        if($status > '0'){ 
            $this->db->where("e.estado",$status);
        }
        $this->db->where("c.id_categoria",$id_categoria);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }

    public function end_step($count_id,$status){
        $this->db->select("count(id_conteo) count");
		$this->db->from("tabla_entradas"); 
        $this->db->where("id_conteo",$count_id);
        $this->db->where("estado",$status);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }

    public function end_order($count_id,$status){
        $this->db->select("count(id_conteo) count");
		$this->db->from("tabla_entradas"); 
        $this->db->where("id_conteo",$count_id);
        $this->db->where("estado <",$status);

        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }

    
    public function Category_list()
	{
        $this->db->select("*");
		$this->db->from("cat_categoria"); 
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->result();
		}else{
			return false;
        } 
    }  

    public function Add_audit($data){        
        $this->db->insert('tabla_audita',$data);
		return $this->db->insert_id();   
    }


    public function New_Count($data){        
        $this->db->insert('tabla_conteos',$data);
		return $this->db->insert_id();   
    }


    public function Check_order($order_id){ 
        $this->db->select("p.*, c.estado est_con");           
        $this->db->from("tabla_pedidos p","left");
        $this->db->join("tabla_conteos c", "p.id_conteo = c.id_conteo", "left");
        $this->db->where("id_wd",$order_id);
        $query = $this->db->get();
        if($query->num_rows()>0){            
			return $query->row_array();
		}else{			
			return false; 			
		}
    }

    public function Check_count_status($count_id){
        $this->db->select("estado");
        $this->db->from("tabla_conteos"); 	
        $this->db->where("id_conteo",$count_id);
         $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }

    public function Check_count_item($code_id,$count_id){
        $this->db->select("*");
        $this->db->from("tabla_entradas"); 	
        $this->db->where("id_conteo",$count_id);
        $this->db->where("id_inventario",$code_id);
        $query = $this->db->get();
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
        } 
    }
    
    public function Add_enteritem($data){
        $this->db->insert('tabla_entradas',$data);
		return $this->db->insert_id();   

    }

    public function Add_order($data){
        $this->db->insert('tabla_pedidos',$data);
		return $this->db->insert_id(); 
    }

    public function Add_leaveitem($data){
        $this->db->insert('tabla_salidas',$data);
		return $this->db->insert_id(); 
    }

    public function update_delivery($data,$id){
        $this->db->where('id_ingreso',$id);
        return $this->db->update('tabla_entradas',$data);
    }  

    public function update_order($data,$id){
        $this->db->where('id_pedido',$id);
        return $this->db->update('tabla_pedidos',$data);
    }  

    public function update_orderby_visit($data,$id){
        $this->db->where('id_visita',$id);
        return $this->db->update('tabla_pedidos',$data);
    }  

    public function update_consult($data,$ingreso_id){
        $this->db->where('id_ingreso',$ingreso_id);        
        return $this->db->update('tabla_entradas',$data);
    }

    public function update_count($data,$id){
        $this->db->where('id_conteo',$id);
        return $this->db->update('tabla_conteos',$data);
    }

     


    public function update_countby_visit($data,$id){
        $this->db->where('id_visita',$id);
        return $this->db->update('tabla_conteos',$data);
    }
    
    public function update_inventory($data,$id){
        $this->db->where('id_tabla_inventario',$id);
        return $this->db->update('tabla_inventario',$data);
    }

    public function update_visit($data,$id){
        $this->db->where('id_visita',$id);
        return $this->db->update('tabla_visitas',$data);
    } 

 

}