<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {	 

	public function __construct(){
		parent::__construct();
		$this->load->model('Operation/Visit_model');	
		$this->load->model('Operation/Counts_model');
		//$this->load->helper('map');
		$this->headerdata["module"] = "Visit";	
       
	} 
  

	public function index()
	{ 

        $productos = 
        [
            ["code" => "1", "nombre" => "lavado", "precio" => "5.5", "color" => "blanco"], 
            ["code" => "2", "nombre" => "secado", "precio" => "7", "color" => "negro" ],
            ["code" => "3", "nombre" => "planchado", "precio" => "8", "color" => "amarillo" ]
            
        ];
        $cliente = [
            ["code" => "1", "nombre" => "alex", "color" => "blanco"], 
            ["code" => "2", "nombre" => "gus",  "color" => "negro" ],
            ["code" => "3", "nombre" => "dany", "color" => "amarillo" ],
            ["code" => "4", "nombre" => "pedro", "color" => "amarillo" ]
        ];

        $descuento = array("0","2","10");        
		$clientecode = "1";
        $prod = "2";
        $cantidad = "5";        

        $total = $cantidad * $productos[$prod]["precio"];
        $tdesc = 0;

        foreach($cliente as $cli){
          foreach($descuento as $desc){
                if($cli["code"] == $desc){ 
                    echo $cli["nombre"]." tiene descuento del 20% </br>";
                    $tdesc = $total * .9; 
                }
          }
        }

        echo $cliente[$clientecode]["nombre"]." compro ".$cantidad." ".$productos[$prod]["nombre"].
        " con el precio $".$productos[$prod]["precio"]."MXN, da el total de: ".$total." y con el descuento, solo paga: $".$tdesc." MXN.";
    } 

	

}

