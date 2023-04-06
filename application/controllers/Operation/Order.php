<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Visit_model');	
		$this->load->model('Operation/Counts_model');	
		//$this->load->helper('map');
		$this->headerdata["module"] = "Order";	
       
	}


	public function index()
	{ 
		$data["custom"]   = ["title"   => "Conteos de prendas para industrias",
				"header"  => "Order",
				"page"    => "order", 
				"prefix"  => "order",
				"section" => "Orders",
				"module"  => $this->headerdata["module"]];

		//Files in head, body y footer  
		//$data["user_id"]   = $_SESSION["user"]["id"];
		$data["include"]   = includefiles($data["custom"]["page"]);		
		//$data["site_type"] = $this->Mainmap_model->load_sitestype(15);
		
		//Load view
		$this->load->view('layouts/admin',$data);
		//$this->output->enable_profiler(TRUE); 
                 
    }
 

 	public function order_list(){
		//Json speed list
		$visit_list = $this->Visit_model->order_list();
		if(isset($visit_list) && count($visit_list)>0){
				foreach($visit_list  AS $row){ 
                    $fac = ($row->factura>0)?$row->factura:'Sin factura';

                    $hx = date_create($row->recibido); 
                    $hy = date_create($row->entregado); 

					$icon  = "<div class='text-center'  onclick='show_visit(".$row->id_visita.",".$row->id_pedido.")'><span class='icon-info'></span></div>";
					$icon_edit  = "<div class='text-center'  onclick='edit_visit(".$row->id_visita.",".$row->id_pedido.")'><span class='icon-pencil'></span></div>";

 					$data  = ["<div class='text-center'>".$row->id_pedido."</div>",
							  "<div class='text-center'>".$row->id_wd."</div>",
                              "<div class='text-center'>$".$row->total.".00 MXN</div>",		  
                              "<div class='text-center'>".$row->id_visita."</div>",
							  "<div class='text-center'>".$row->id_visita_ent."</div>",
							  "<div class='text-center'>".date_format($hx,'y-m-d')."</div>",
                              "<div class='text-center'>".date_format($hy,'y-m-d')."</div>",                              
                              "<div>".$fac."</div>",
                              "<div class='text-center'>".generalstatus($row->estado)."</div>",
							  $icon,
							  $icon_edit];
					$jsonData['data'][] = $data;  
				} 
		}
        echo json_encode($jsonData);
	}

	public function edit_visit(){
		$data["visit_list"]      = $this->Visit_model->Visit_select_list($_POST["id"]);
		$data["order_info"]      = $this->Counts_model->order($_POST["order"]);
		$data["visitorder_list"] = $this->Visit_model->visitorder_list($_POST["id"]); 
		$this->load->view('operation/order/edit',$data);
	}


	public function update_order(){ 		

		$update = ["estado"  => $_POST["status_order"],
				   "id_wd"   => $_POST["wd_order"],
				   "factura" => $_POST["invoice_order"]];
		
		$this->Visit_model->update_order($update,$_POST["id_order"]);

		if(isset($_POST["visit_list"])){
			$this->Visit_model->delete_delivery($_POST["id_order"]);		
			foreach($_POST["visit_list"] as $idvisit => $v){
				$data = ["id_visita"   => $idvisit,
						"id_pedido"    => $_POST["id_order"]];
				$this->Visit_model->add_delivery($data);
			}	
		}
		//print_array($_POST);
	}

	
	public function count_list()
	{	//id:id,order:order
		$visit_id = $_POST["id"];
		$order_id = $_POST["order"];
		
		$data["visit_id"]   = $visit_id;
		$data["info_visit"] = $this->Visit_model->Info_Visit($visit_id);
		//$data["count_list"] = $this->Counts_model->Ordercount_list($order_id);
		$data["item_order"] = $this->Counts_model->select_item_order($visit_id,$order_id);

		//Load view
		$this->load->view('operation/order/counts',$data);
    }
 
	public function test(){
		
		/*
            [id_ingreso] => 120
            [id_inventario] => 13
            [cantidad] => 3
            [categoria] => 1
            [precio] => 6
        */
	}



}