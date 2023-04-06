<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Existence extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Existence_model');
		$this->load->model('Operation/Visit_model');		
		//$this->load->helper('map'); 
		$this->headerdata["module"] = "Staff";	
       
	} 


	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Existencia",
				"page"    => "Existence",
				"prefix"  => "exist",
				"section" => "Existence",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }
 
	public function test_list(){
		$inv_list = $this->Existence_model->Existence_list();
		print_array($inv_list);
	}

 	public function existence_list(){
		//Json inv list 
		$inv_list = $this->Existence_model->Existence_list();
		if(isset($inv_list) && count($inv_list)>0){
				foreach($inv_list  AS $row){					
					$icon = '<div class="text-center"  onclick="del_inv('.$row->id_tabla_inventario.')"><span class="icon-trash"></span></div>';

					$data  = ["<div class='text-center'>".$row->id_tabla_inventario."</div>",
							  "".$row->categoria."",
							  "".$row->colaborador."",							  
							  "".$row->company_code."", 
							  "".$row->empresa."",
							  "".$row->sitio."",
							  "".$row->emp_col.$row->emp_fil."-".$row->emp_ub."",
							  "".existence_status($row->inv_status)."",
							  $icon];
					$jsonData['data'][] = $data;
				}
		}
        echo json_encode($jsonData);
	}
  

	public function employe_list(){
		$company = $_SESSION["user"]["company"];
		$data["employe_list"]   = $this->Visit_model->employe_list_sel($company,$_POST["id"]);
		//print_array($data);
		$this->load->view('operation/Existence/existence_staff',$data);  
	}


	public function new_item(){
		$company = $_SESSION["user"]["company"];
		
		$data["place_list"]     = $this->Visit_model->select_list($company,"cat_sitios");
		$data["category_list"]  = $this->Visit_model->select_list($company,"cat_prendas");	
		

		//print_array($data); 
 
		$this->load->view('operation/Existence/new',$data);  
	}

	public function add_item(){
		$add  = $this->Existence_model->info_add_emp($_POST["item_colab"]); 		
		$data = ["id_prenda"      => $_POST["item_cat"],				 
				 "id_empresa"     => $add["id_empresa"],
			   	 "id_sitio"       => $add["id_sitio"],
				 "columna"        => $add["columna"],
				 "ubicacion"      => $add["ubicacion"],
				 "fila"           => $add["fila"],
				 "id_colaborador" => $_POST["item_colab"],
				 "estado"         => 1,
				 "hora"           => date('Y-m-d h:s:m')];   
		
		$this->Existence_model->add_item($data); 
		//print_array($data);
	}
 
	public function del_inv(){
		$data = ["estado" => 0];
		$this->Existence_model->del_item($data,$_POST["id"]); 
	}




}