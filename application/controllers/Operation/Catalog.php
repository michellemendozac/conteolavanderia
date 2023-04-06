<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Catalog_model');		
		//$this->load->helper('map');
		$this->headerdata["module"] = "Catalog";	
       
	}


	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Catálogo de prendas",
				"page"    => "Catalog",
				"prefix"  => "catalog",
				"section" => "Catalog",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$company              = $_SESSION["user"]["company"];
		$data["include"]      = includefiles($data["custom"]["page"]);	 
		$data["catalog_list"] = $this->Catalog_model->catalog_list($company); 
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }
  

  	public function catalog_list(){
		//Json speed list
		$company = $_SESSION["user"]["company"];
		$catalog_list = $this->Catalog_model->catalog_list($company);
		if(isset($catalog_list) && count($catalog_list)>0){
				foreach($catalog_list  AS $row){
					$icon = ""; //visit_option($row->id_usuario);                    
					$data  = ["<div class='text-center'>".$row->id_prenda."</div>",
							  "".$row->nombre."",
                              ($row->marca  != '')?$row->marca:'',
                              ($row->color != '')?$row->color:'',
							  ($row->genero  != '')?$row->genero:'',
							  ($row->existencia  != '')?$row->existencia:'',							   
							  $icon];
					$jsonData['data'][] = $data;
				}
		}
        echo json_encode($jsonData);
	}
 

	public function edit_cat(){
		$data["info"] = $this->Catalog_model->Catalog_info($_POST["id"]);
		$this->load->view('operation/catalog/edit',$data);
	}

	public function update_cat(){
		//print_array($_POST);
		 
		$data = ["precio"       => $_POST["cat_precio"],
				 "estado"       => $_POST["cat_status"],
				 "descripcion"  => $_POST["cat_desc"]];
		$this->Catalog_model->update_cat($data,$_POST["cat_id_prenda"]);
	}





}