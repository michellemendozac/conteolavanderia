<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainMap extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Mainmap_model');		
		$this->load->helper('map');
		$this->headerdata["module"] = "Maps";		
	}
  
	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Velocidades",
				"page"    => "MainMap",
				"prefix"  => "map",
				"section" => "Map",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }
 
		
	
	
	public function mostrar_vehiculos_act(){

//		unset($_SESSION["messages"]); unset($_SESSION["speeds"]);
		if(!isset($_SESSION["messages"])):$this->Mainmap_model->load_messages();endif;
		if(!isset($_SESSION["speeds"])):$this->Mainmap_model->load_speeds(1029);endif;

		$id_user = "1029"; 
		//vehicles list 
		$jsondata = [];

		$jsondata[] = ["speed"         => $vehspeedname,
		"class_motor"   => $classmotor,
		"icon_motor"    => $vehmotor,
		"toltip_motor"  => $vehmotortoltip,
		"speed_tooltip" => $speedtoltip,
		"idveh"         => $vehid,
		"company"       => $vehcompanyid];
		header("Content-type: application/json");        	
		echo json_encode($jsondata);

		//$this->output->enable_profiler(TRUE);   <div class="h6 primary mdi mdi-satellite-uplink text-danger"></div>  
		/*else{echo "else_end";}*/
		//print_array($vehicles); 
	}


public function vehicle_detail(){
	$data["vehicle"] = $this->main_model->vehicle_byid($_POST["id"]);
	$this->load->view("map/vehicle_detail",$data);
}

public function get_ubication(){

		header("Content-type: application/json");        	
		echo json_encode($data);

		/************* */

	}







	




}