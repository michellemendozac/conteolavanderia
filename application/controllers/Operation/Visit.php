<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Visit_model');	
		$this->load->model('Operation/Counts_model');
		//$this->load->helper('map');
		$this->headerdata["module"] = "Visit";	
       
	} 
  

	public function index()
	{ 
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Visitas",
				"page"    => "Visit", 
				"prefix"  => "visitas",
				"section" => "Visit",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    } 

	public function visit_staff(){
		$data["staff_list"] = $this->Visit_model->staff_list($_POST["id"]);
		$this->load->view('operation/visitas/visit_staff',$data); 
	}

	public function new_visit(){
		$company = $_SESSION["user"]["company"];
		$data["place_list"] = $this->Visit_model->place_list($company); 
		$this->load->view('operation/visitas/new',$data); 
	}

	public function add_visit(){  
		$data = ["id_empresa"        => $_SESSION["user"]["company"],
			   	 "id_sitio"          => $_POST["visit_place"],
				 "id_resp_recepcion" => $_POST["resp_recp"],
				 "id_resp_entrega"   => $_POST["resp_ent"],
				 "h_inicio"          => $_POST["visit_date"],
				 "h_fin"             => "0000-00-00 00:00",
				 "turno"             => $_POST["visit_turn"],
				 "comentarios"       => $_POST["coment_visit"],
				 "info_visita"       => $_POST["coment_info"],
				 "estado"            => $_POST["visit_status"],
				"band_atendio"       => "1"];   
		//print_array($data);
		$this->Visit_model->add_visit($data);
	}

	public function edit_visit(){
		$data["info_visit"] = $this->Visit_model->Info_Visit($_POST["id"]);
		$data["staff_list"] = $this->Visit_model->staff_list($_POST["sitio"]);
		
		$this->load->view('operation/visitas/edit',$data);
	}

	public function update_visit(){
		//print_array($_POST);
		$data = ["id_resp_recepcion" => $_POST["resp_recp"],
				 "info_visita"       => $_POST["coment_visit"],
				 "estado"            => $_POST["visit_status"]];
		$this->Visit_model->update_visit($data,$_POST["id_visita"]);
	}
 
 	public function visit_list(){
		//Json speed list
		$visit_list = $this->Visit_model->visit_list();
		if(isset($visit_list) && count($visit_list)>0){
				foreach($visit_list  AS $row){
					$icon_edit  = "<div class='text-center'  onclick='edit_visit(".$row->id_visita.",".$row->id_sitio.")'><span class='icon-pencil'></span></div>";
					$icon       = "<div class='text-center'  onclick='show_visit(".$row->id_visita.",".$row->id_sitio.")'><span class='icon-info'></span></div>";

					$data  = ["<div class='text-center'>".$row->id_visita."</div>",
							  "".$row->sitio."",
							  "".ucfirst(turno($row->turno))."",
                              ($row->h_inicio  != '')?$row->h_inicio:'',
                              ($row->h_fin != '')?$row->h_fin:'',
							  ($row->atendio  != '')?$row->atendio:'',
							  ($row->estado  != '')?visit_status($row->estado):'',		
							  $icon,				   
							  $icon_edit];
					$jsonData['data'][] = $data;
				}
		} 
        echo json_encode($jsonData);
	}
 
	public function count_list()
	{	$visit_id = $_POST["id"];
		$data["visit_id"]   = $visit_id;
		$data["info_visit"] = $this->Visit_model->Info_Visit($visit_id);
		$data["count_list"] = $this->Counts_model->Counttype_list($visit_id);
		
		//Load view
		$this->load->view('operation/visitas/counts',$data);            
    }

	public function count_view(){

		$count_id = $_POST["id"];
		$visit_id = $_POST["visit"];

		$data["count_id"]      = $count_id;
		$data["visit_id"]      = $visit_id;
		$data["category_list"] = $this->Counts_model->Category_list(); 
		$data["count_list"]    = $this->Counts_model->Count_list($count_id); 

		foreach($data["category_list"] as $category): 
			$x = $category->id_categoria; 
			$data["categoryes_list"][$x] = $this->Counts_model->count_category($count_id,$x,0);
		endforeach;

		$_SESSION["checklist"]  = $data["categoryes_list"];

		//Load view
		$this->load->view('operation/counts/count_list',$data);     
	}



}