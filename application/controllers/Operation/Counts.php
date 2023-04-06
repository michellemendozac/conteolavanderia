<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Counts extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Counts_model');		
		//$this->load->helper('map');
		$this->headerdata["module"] = "Staff";	
       
	}


	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => "Counts",
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }
 
 	public function count_list(){
		//Json speed list
		$count_list = $this->count_model->count_list();
		if(isset($count_list) && count($count_list)>0){
				foreach($count_list  AS $row){
					$icon = ""; //visit_option($row->id_usuario);                    
					$data  = ["<div class='text-center'>".$row->id_visita."</div>",
							  "".$row->sitio."",
                              ($row->h_inicio  != '')?$row->h_inicio:'',
                              ($row->h_fin != '')?$row->h_fin:'',
							  ($row->atendio  != '')?$row->atendio:'',
							  ($row->band_atendio  != '')?visit_status($row->band_atendio):'',							   
							  $icon];
					$jsonData['data'][] = $data;
				}
		}
        echo json_encode($jsonData);
	}
 




}