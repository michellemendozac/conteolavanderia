<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Visit_model');		
		//$this->load->helper('map'); 
		$this->headerdata["module"] = "Colaboradores";	
       
	}

 
	public function index()
	{ 
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Colaboradores",
				"page"    => "employe", 
				"prefix"  => "emp",
				"section" => "employe",
	 			"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);

 		//$this->output->enable_profiler(TRUE); 
                 
    }
 
 
 
 	public function employe_list(){
		//Json speed list
		$visit_list = $this->Visit_model->employe_list();
		if(isset($visit_list) && count($visit_list)>0){
				foreach($visit_list  AS $row){

					$dat = $row->id_colaborador.",".$row->id_sitio.",'".$row->id_empresa."'";
					$icon = '<div class="text-center"  onclick="edit_emp('.$dat.')"><span class="icon-info"></span></div>';

					$data  = ["<div class='text-center'>".$row->id_colaborador."</div>",
							  "".$row->nombre."",
							  "".turno($row->turno)."",
							  "".$row->sucursalname."",
                              "".$row->company_code."",
                              "".$row->columna.$row->fila."-".$row->ubicacion."",                              
                              "Activo",$icon]; 

					$jsonData['data'][] = $data;
				}
		}
        echo json_encode($jsonData);
	}
 
	public function new_emp(){
		$company = 1;
		$data["place_list"] = $this->Visit_model->place_list($company);
		$this->load->view('operation/employe/new',$data); 
	}

	public function add_emp(){
		$data = ["nombre"         => $_POST["emp_name"],
				 "turno"      	  => $_POST["emp_turno"],
				 "id_empresa"     => 1,
			   	 "id_sitio"       => $_POST["emp_place"],
				 "company_code"   => $_POST["emp_code"],
				 "columna"        => $_POST["emp_save_col"],
				 "fila"           => $_POST["emp_save_sub"],
				 "ubicacion"      => $_POST["emp_save_fil"],
				 "estado"         => $_POST["emp_status"]];   
		$this->Visit_model->add_emp($data);

	}
			
			
			
	public function edit_emp(){		
		/*$data = ["id"     => $_POST["id"],
				"sitio"   => $_POST["sitio"],
				"empresa" => $_POST["empresa"]];*/

		$company = 1;
		$data["place_list"] = $this->Visit_model->place_list($company);
		$data["info"] = $this->Visit_model->info_emp($_POST["id"]);
		//print_array($data);
		$this->load->view('operation/employe/edit',$data);
	}


	public function update_emp(){	 
		$data =	["nombre"       => $_POST["emp_name"],
				 "turno"      	=> $_POST["emp_turno"],
				 "id_sitio"     => $_POST["emp_place"],
				 "company_code" => $_POST["emp_code"],
				 "columna"      => $_POST["emp_save_col"],
				 "fila"         => $_POST["emp_save_sub"],
				 "ubicacion"    => $_POST["emp_save_fil"],
				 "estado"       => $_POST["emp_status"]]; 
		$this->Visit_model->update_emp($data,$_POST["id_colaborador"]);
		
		//print_array($_POST); 
	}




}