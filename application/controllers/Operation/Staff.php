<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Staff_model');		
		//$this->load->helper('map');
		$this->headerdata["module"] = "Staff";	
       
	}
  

	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Staff",
				"page"    => "Staff",
				"prefix"  => "staff",
				"section" => "Staff",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }

	public function new_staff(){

		$data="";
		$this->load->view('operation/staff/new',$data);
 
	}

	public function add_staff(){

 		$data = ["nombre"     => $_POST["staff_name"],
				 "puesto"     => $_POST["staff_job"],
				 "telefono"   => $_POST["staff_phone"],
				 "id_empresa" => $_SESSION["user"]["company"],
				 "id_sitio"   => $_SESSION["user"]["site"],
				 "estado"     => "1"];    
 
		$this->Staff_model->add_staff($data);

	}



	public function edit_staff(){		
		$data = ["id"     => $_POST["id"],
				"sitio"   => $_POST["sitio"],
				"empresa" => $_POST["empresa"]];

		$data["info"] = $this->Staff_model->info_staff($data);
		//print_array($data);
		$this->load->view('operation/staff/edit',$data);
	}


	public function update_staff(){		 
		$data =	["nombre"   => $_POST["staff_name"],
				 "puesto"   => $_POST["staff_job"],
				 "telefono" => $_POST["staff_phone"]]; 
		$this->Staff_model->update_staff($data,$_POST["id_staff"]);
	 		
		//print_array($data); 
	}


 	public function staff_list(){
		//Json speed list
		$staff_list = $this->Staff_model->staff_list();

		if(isset($staff_list) && count($staff_list)>0){
				foreach($staff_list  AS $row){ 
					$dat = $row->id.",".$row->id_sitio.",'".$row->empresa."'";
					$icon = '<div class="text-center"  onclick="edit_staff('.$dat.')"><span class="icon-info"></span></div>';
					$data  = ["<div class='text-center'>".$row->id."</div>",
							  "".$row->nombre."",
                              ($row->puesto  != '')?$row->puesto:'',
							  ($row->telefono  != '')?$row->telefono:'',
                              ($row->empresa != '')?$row->empresa:'',
							  ($row->sitio != '')?$row->sitio:'',
							  ($row->estado  != '')?visit_status($row->estado):'',							   
							  $icon];
					$jsonData['data'][] = $data;
				}
		}
        echo json_encode($jsonData);
	}
 




}