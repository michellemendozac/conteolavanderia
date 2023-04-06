<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Count extends CI_Controller {	 

	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('Operation/Counts_model');	
		$this->load->model('Operation/Visit_model');		
		//$this->load->helper('map');
		$this->headerdata["module"] = "Count";	
       
	} 
  
 
	public function index()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => "Count_visit",
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		$data["user_id"]   = $_SESSION["user"]["id"];
		$today = date("Y-m-d"); 
		$data["include"]    = includefiles($data["custom"]["page"]);		
		$data["visit_list"] = $this->Visit_model->Visit_list($today);
		
 		//Load view
		$this->load->view('layouts/admin',$data);
		                  
    }

	public function Order_Package()
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => "Order_package",
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$today = date("Y-m-d"); 
		$data["include"]    = includefiles($data["custom"]["page"]);		
		$data["visit_id"]   = '0';
  		
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE);                  
    }

	public function count_type($visit_id)
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => "Count_type",
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$today = date("Y-m-d");  
		$data["info_visit"] = $this->Visit_model->Info_Visit($visit_id);
 
		if(isset($data["info_visit"])){
			if($data["info_visit"]["estado"] == 1){ //Solo si está activa la visita
				$data["include"]    = includefiles($data["custom"]["page"]);		
				$data["visit_id"]   = $visit_id;
				$data["step_t"]     = '0'; 
				$data["count_list"] = $this->Counts_model->Counttype_list($visit_id); 
				
				//Load view
				$this->load->view('layouts/admin',$data);

 			}else{
				header('Location:'.base_url().'/Counts/Count');
			}
		}else{
			header('Location:'.base_url().'/Counts/Count');
		}                  
    }

	public function Item_Count($visit_id,$count_type,$count_id)
	{
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => "Item_Count",
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$today = date("Y-m-d"); 
		$new = ["id_visita" => $visit_id, "tipo_conteo" => $count_type];

		$data["count_id"]      = $count_id;
		$data["visit_id"]      = $visit_id; 
 
		$data["include"]       = includefiles($data["custom"]["page"]);	 
		$data["info_visit"]    = $this->Visit_model->Info_Visit($visit_id); 
		$data["count_type"]    = $count_type;
		$data["category_list"] = $this->Counts_model->Category_list(); 
		$data["count_list"]    = $this->Counts_model->Count_list($count_id); 

		$data["site_id"]       = $data["info_visit"]["idsitio"];

		foreach($data["category_list"] as $category): 
			$x = $category->id_categoria; 
			$data["categoryes_list"][$x] = $this->Counts_model->count_category($count_id,$x,0);
		endforeach;

		$_SESSION["checklist"]  = $data["categoryes_list"];


		//Load view 
		$this->load->view('layouts/admin',$data);               
    }

	public function New_Count(){
		$new = ["tipo_conteo" => $_POST["count_type"], "id_visita" => $_POST["visit_id"], "estado" => 0, "h_reg" => date("Y-m-d")];
		$data    = $this->Counts_model->New_Count($new);
		echo $data;

	}

	public function Category_items(){
		$data = $this->Counts_model->Category_list();
 		header("Content-type: application/json");        	
		echo json_encode($data); 	
	}

	public function Category_items_pre(){ 
		$data = $_SESSION["checklist"];
		header("Content-type: application/json");        	
		echo json_encode($data); 	
	}
 
	public function Delivery($type){
		$order_id   = $_POST["order_id"];
		$ordercheck = $this->Counts_model->Check_order($order_id);

		if($ordercheck){
			if($ordercheck["est_con"] > 1){
				echo $ordercheck["id_conteo"];
			}else{				 
				echo "2";				 
			}
		}else{
			echo "1";
		}		              
    }
	
	public function Package_Orger(){
		$order_id   = $_POST["order_id"];
		$ordercheck = $this->Counts_model->Check_order($order_id);

		if($ordercheck){
			if($ordercheck["est_con"] == 1){
				echo $ordercheck["id_conteo"];
			}else{				 
				echo "2";				 
			}
		}else{
			echo "1";
		}
	}



	public function Consult_location(){
		$code_empid = $_POST["code_id"];
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];
		$company    = 1;
		$place      = 1; 

		$emp["list_emp"] = $this->Counts_model->check_employe($code_empid,$count_id);

		if(is_array($emp["list_emp"])):
			foreach($emp["list_emp"] as $code):

				$data = ['h_uempleado'  => date('Y-m-d h:i:s'),
				"estado"  		=> '3']; 
	   			$update_delivery = $this->Counts_model->update_consult($data,$code->id_ingreso);

			endforeach;				
		endif; 
 
		$this->load->view('counts/consult_byemp',$emp);		
	}

	public function Delivery_list($visit_id,$conteo_id,$count_type){
		
		$visit_id   = $visit_id; 
		
		$page = page_type($count_type); 

		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "counts",
				"page"    => $page,
				"prefix"  => "count",
				"section" => "Counts",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer
		$data["include"]       = includefiles($data["custom"]["page"]);		
		$data["visit_id"]      = $visit_id;
		$data["count_type"]    = $count_type;
		$data["count_id"]      = $conteo_id;
		
		$data["category_list"]       = $this->Counts_model->Category_list(); 
		$_SESSION["categoryes_list"] = $data["category_list"];
		$data["count_list"]          = $this->Counts_model->Count_list($conteo_id); 
 
		foreach($data["category_list"] as $category): 
			$x = $category->id_categoria; 
			$data["categoryes_list"][$x]       = $this->Counts_model->count_category($conteo_id,$x,0);
			$data["categoryes_list_check"][$x] = $this->Counts_model->count_category($conteo_id,$x,$data["count_type"]);
		endforeach;

		$data["status_count"] = 0;
		$estatus_count = $this->Counts_model->Check_count_status($conteo_id); 			
		if($estatus_count){
			$data["status_count"] = $estatus_count["estado"];
		} 

 		$_SESSION["checklist"]  = $data["categoryes_list_check"];
		 
		 //Load view
		$this->load->view('layouts/admin',$data); 
	}

	public function Deliver_item_by_emp(){
		$code_id    = $_POST["code_id"];
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];
		$data["count_type"] = $_POST["count_type"];
		$data["error_info"] ="";
		$code_empid = $_POST["code_id"];
		$company    = 1;
		$place      = 1;  
		$data["item_data_error"] = ["category_name" => "N/A",
									"color" 	    => " ",
									"genero" 		=> " ",
									"id_code" 		=> "N/A",
									"colaborador" 	=> "N/A"]; 

		$emp["list_emp"] = $this->Counts_model->check_employe($code_empid,$count_id);

		//Actualizar por empleado
		if(is_array($emp["list_emp"])){
			foreach($emp["list_emp"] as $code):
				if($code->estado < 4){
					$data_emp = ["h_empleado" => date('Y-m-d h:i:s'),
						     "estado"  	  => "4"]; 							
	   				$update_delivery = $this->Counts_model->update_consult($data_emp,$code->id_ingreso);
				}
				if($code->estado == 4){
					$data["error_info"] = "Ya se le entregaron las prendas a este colaborador.";
				}				
			endforeach;				
		}else{ 
			$data["error_info"] = "";
		}  

		$data["category_list"] = $_SESSION["categoryes_list"];
		$data["count_list"]    = $this->Counts_model->Count_list($count_id); 

		foreach($data["category_list"] as $category): 
			$x = $category->id_categoria; 
			$data["categoryes_list"][$x] = $this->Counts_model->count_category($count_id,$x,0);
			$data["categoryes_list_check"][$x] = $this->Counts_model->count_category($count_id,$x,$count_type);
		endforeach;		 

		$data["list_emp"]  = $emp["list_emp"];
		  
		$this->load->view('counts/delivery_listbyemp',$data);  
	}

	public function Deliver_item($step = 0){ 
		$code_id    = $_POST["code_id"];
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];
		$data["count_type"] = $_POST["count_type"];
		$data["error_info"] ="";
		$company    = 1;
		$place      = 1;  
 
		$data["item_data_error"] = ["category_name" => "N/A",
								    "color" 	    => " ",
								    "genero" 		=> " ",
								    "id_code" 		=> "N/A",
								    "colaborador" 	=> "N/A"]; 
		
		$check = $this->Counts_model->check_count_item($code_id,$count_id);	 
		if($check){			//si exsite en el conteo	
				if($check["estado"] == "4" ){
					$data["error_info"] = "Esta prenda ya fue entregada.";
				}else{					
					$item = $this->Counts_model->info_item($code_id);  //informacion del item
					if($item){
						if($check["estado"] == $count_type){
							$data["error_info"] = "Ya se registro este elemento.";
						}
						else{
							$x = $check["estado"];

							if($count_type == 4){
								$data_update = ["h_empleado" => date('Y-m-d h:i:s'),
											    "estado"    =>  4];
							}else{ 
								$data_update = [change_status_hour($x)  => date('Y-m-d h:i:s'),
									           "estado"  				=>  change_status_item($x)];

							}
							
	
							$update_delivery = $this->Counts_model->update_delivery($data_update,$check["id_ingreso"]);
							$item[0]->id_ingreso = $check["id_ingreso"];
							
							$data["item_data"] = $item; 
							
						}
						 
					}else{
						$data["error_info"] = "Elemento no se encuentra registrado en el catálogo.";
					}					
				}
		}else{ 
			$data["error_info"] = "El elemento no se encuentra registrado en este conteo.";
		} 

		$data["category_list"] = $_SESSION["categoryes_list"];
		$data["count_list"]    = $this->Counts_model->Count_list($count_id); 

		foreach($data["category_list"] as $category): 
			$x = $category->id_categoria; 
			$data["categoryes_list"][$x] = $this->Counts_model->count_category($count_id,$x,0);
			$data["categoryes_list_check"][$x] = $this->Counts_model->count_category($count_id,$x,$count_type);
		endforeach;		
		  
		$this->load->view('counts/package_list',$data); 
		//print_array($data);
	}

	public function End_step(){
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];

		$status = 0;
		$status = ($count_type==2)?1:$count_type;

		$end = $this->Counts_model->end_step($count_id,$status);
		if($end["count"]==0){ 			

			$data = [change_status_hour_count($count_type)  => date('Y-m-d h:i:s'),
					"estado"       			                => $count_type];

			if($this->Counts_model->update_count($data,$count_id)){ 
				echo "1";
			}else{
				echo "Recargue la página e intente de nuevo.";
			} 

		}else{
			echo "Faltan elementos por empacar.";
		} 
	}

	public function End_order(){
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];

		$status = 4; 

		$end = $this->Counts_model->end_order($count_id,$status);
		if($end["count"]==0){
			$estatus_count = $this->Counts_model->Check_count_status($count_id); 			
			if($estatus_count){
				if($estatus_count["estado"]==4){
					echo "El pedido ya está finalizado";
				}else{

					$data = [change_status_hour_count($count_type)  => date('Y-m-d h:i:s'),
							"estado"       			                => $count_type];

					if($this->Counts_model->update_count($data,$count_id)){ 
						echo "1";
					}else{
						echo "Recargue la página e intente de nuevo.";
					} 		
				}
			}else{
				echo "El conteo no existe";
			}
		}else{
			echo "Faltan elementos por empacar..".$count_id." ..".$status."...".$end["count"];
		} 
	}

	public function End_step_reg(){
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"]; 

		$data = ["h_ingreso"  => date('Y-m-d h:i:s'),
				"estado"      => 1];

		if($this->Counts_model->update_count($data,$count_id)){ 
			echo "1";
		}else{
			echo "Recargue la página e intente de nuevo.";
		} 
		 
	}

	public function Cancel_count(){ 
		$data = ["estado" => "x"];
		$this->Counts_model->update_count($data,$_POST["count_id"]);
		echo "1";
	}

	/*case "0":  $status = "Pedido en proceso de conteo"; break;
			case "1":  $status = "Conteo finalizado"; break;
			case "2":  $status = "Pedido Empacado"; break;   
			case "3":  $status = "Consulta ubicación "; break;   
			case "4":  $status = "Pedido entregado"; break;   
			case "5":  $status = "Pedido entregado a Recepción"; break;   
			case "x":  $status = "Cancelado"; break;  */

	

	public function change_visit(){
		//Si finaliza la visita
		$visit_id = $_POST["visit_id"];
		if($_POST["change_type"] == 3){   
			$cl = $this->Counts_model->Counttype_list($visit_id);
			$counts = []; 
			if(count($cl)>0){
				foreach($cl as $c): 
					if($c->estado == 0){ //Si el conteo está incompleto
						$this->Counts_model->update_count(["estado" => "x"],$c->id_conteo);
						$dsc = "Conteo sin finalizar cancelado";
						$audit = ["module" => "Change_visit_3", "user" =>  $_SESSION["user"]["id"], "dsc" => $dsc, "code" => "008", "conteo_id" => $c->id_conteo, "visita_id" => $visit_id, "fecha" => date('Y-m-d h:i:s')];
						$this->Counts_model->Add_audit($audit); 
					} 
					if($c->estado == 1){ //Si el conteo se termino
						$counts[] = $c->id_conteo; 
					}
				endforeach;		
				$this->Counts_model->update_orderby_visit(["estado" => 0],$visit_id); 

				$total = $this->Counts_model->Totalprice_ordercount($counts,$visit_id); 


				$order = ["total" => $total["total"], "id_visita" => $_POST["visit_id"], "recibido" => date('Y-m-d h:i:s'), "estado" => "1"];
				$order_id = $this->Counts_model->Add_order($order); 

				$this->Counts_model->update_countby_visit(["id_pedido" => $order_id],$visit_id);  
			}
			else{
				$dsc = "En esta visita no se registraron conteos, si no se realizarán conteos, favor de cancelar la visita y agregar los motivos correspondientes.";
				$audit = ["module" => "Change_visit_3", "dsc" => $dsc, "user" => $_SESSION["user"]["id"], "code" => "007", "conteo_id" => 0, "visita_id" => $visit_id, "fecha" => date('Y-m-d h:i:s')];
				$this->Counts_model->Add_audit($audit);
				echo $dsc;   
			}
			
		}

		if($_POST["change_type"] == 2){  
			$cl = $this->Counts_model->Counttype_list($visit_id);
			$counts = []; 
			if(count($cl)>0){
				foreach($cl as $c):  
						$this->Counts_model->update_count(["estado" => "x"],$c->id_conteo); 
				endforeach;		 
			}			
		}

		$data = ["estado" => $_POST["change_type"],"f_finalizado" => date('Y-m-d h:i:s')];
		$this->Counts_model->update_visit($data,$_POST["visit_id"]);
		echo "1";
	}

	public function Add_coment(){		 
		$data = ["comentarios" => $_POST["coment"]];
		$this->Counts_model->update_visit($data,$_POST["visit_id"]);
		echo "1";
	}

	public function Add_item(){
		$code_id    = $_POST["code_id"];
		$count_type = $_POST["count_type"];
		$visit_id   = $_POST["visit_id"];
		$count_id   = $_POST["count_id"];
		$site_id    = $_POST["site_id"];
		$company    = 1;
		$place      = 1; 
		
		$check = $this->Counts_model->check_count_item($code_id,$count_id,$count_type);	 
		if(!$check){			
			$item = $this->Counts_model->info_item($code_id);
				if($item){
					if($item[0]->id_sitio == $site_id){
						switch($item[0]->estado){
							case 1:
								$data = ["id_visita"     => $visit_id,
								"id_inventario" => $code_id,
								"id_empresa"    => $company,
								"id_sitio"      => $place,
								"id_conteo"     => $count_id,
								"h_ingreso"     => date('Y-m-d h:i:s'),
								"estado"        => "1"];

								$this->Counts_model->update_inventory(["estado" => "2"],$code_id);
		
								$item = $this->Counts_model->info_item($code_id);					
								$data["additem"] = $this->Counts_model->Add_enteritem($data);
								
								header("Content-type: application/json");        	
								echo json_encode($item);  
							break;
							case 2: 
								$dsc = "Esta pieza ya se encuentra en otro conteo, y no se tomará en cuenta para este pedido.";
								$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "001", "conteo_id" => $count_id, "visita_id" => $visit_id, "fecha" => date('Y-m-d h:i:s')];
								$this->Counts_model->Add_audit($audit);
								echo $dsc; 
							break;
							case 0:  
								$dsc = "Esta pieza no se encuentra dentro del inventario, favor de retirarla del conteo.";
								$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "002", "conteo_id" => $count_id, "visita_id" => $visit_id,  "fecha" => date('Y-m-d h:i:s')];
								$this->Counts_model->Add_audit($audit);
								echo $dsc;
							break;
							default: 
								$dsc = "Favor de intentar de nuevo.";
								$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "003", "conteo_id" => $count_id, "visita_id" => $visit_id, "fecha" => date('Y-m-d h:i:s')];
								$this->Counts_model->Add_audit($audit);
								echo $dsc; 
							break;
						} 
					}
					else{
						$dsc = "Este elemento no pertenece a esta sucursal."; 
						$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "004", "fecha" => date('Y-m-d h:i:s')];
						$this->Counts_model->Add_audit($audit);
						echo $dsc; 
					}
				}else{ 
					$dsc = "Elemento no se encuentra registrado en el catálogo."; 
					$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "005", "fecha" => date('Y-m-d h:i:s')];
					$this->Counts_model->Add_audit($audit);
					echo $dsc; 
				}
		}else{
			$dsc = "El elemento ya se encuentra registrado"; 
			$audit = ["module" => "Add_item", "dsc" => $dsc, "code" => "006", "fecha" => date('Y-m-d h:i:s')];
			$this->Counts_model->Add_audit($audit);
			echo $dsc; 
		} 
	}




}