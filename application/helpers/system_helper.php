<?php
function print_array($array){
    echo "<pre>";    
    print_r($array);
    echo "</pre>";   
}
 
function base_url(){
    return '/conteolavanderia';
}

function gender($g){
    switch($g){
        case "F": $page = "Femenino"; break;
        case "H": $page = "Masculino"; break;
        case "U": $page = "Unisex"; break;
    }
    return $page;
}

function turno($t){
    switch($t){
        case "1": $page = "Matutino"; break;
        case "2": $page = "Vespertino"; break;
        case "3": $page = "Nocturno"; break;
        case "4": $page = "Mixto"; break;
        default:  $page = $t; break;
    }
    return $page;
}

function page_type($count_type){
    switch($count_type){
        case "2": $page = "Delivery_Count_packed"; break;
        case "3": $page = "Delivery_Count_employe"; break;
        case "4": $page = "Delivery_Count_piece"; break;
    }
    return $page;
}

function item_status($status){
    switch($status){
        case "0":  $status = "Proceso de conteo"; break;
        case "1":  $status = "Recepción"; break;
        case "2":  $status = "Empacado"; break;   
        case "3":  $status = "Consulta ubicación "; break;   
        case "4":  $status = "Entrega"; break;   
        case "5":  $status = "Entregado a Recepción"; break;   
        case "x":  $status = "Cancelado"; break;   
    }
    return $status;
}

function item_status_title($status){
    switch($status){
        case "0":  $status = "Pedido en proceso de conteo"; break;
        case "1":  $status = "Conteo finalizado"; break;
        case "2":  $status = "Pedido Empacado"; break;   
        case "3":  $status = "Consulta ubicación "; break;   
        case "4":  $status = "Pedido entregado"; break;   
        case "5":  $status = "Pedido entregado a Recepción"; break;   
        case "x":  $status = "Cancelado"; break;   
    }
    return $status;
}

function change_status($x){
    switch($x){
        case "1":  $status = "2"; break;
        case "2":  $status = "4"; break;
        case "3":  $status = "4"; break; 							
    }
    return $status;
}

function change_status_item($x){
    switch($x){
        case "1":  $status = "2"; break;
        case "2":  $status = "3"; break;
        case "3":  $status = "4"; break; 							
    }
    return $status;
}

function change_status_hour($x){
    switch($x){        
        case "1": $hour = 'h_empacado'; break;
        case "2": $hour = 'h_uempleado'; break;
        case "3": $hour = 'h_empleado'; break; 	
        case "4": $hour = 'h_empleado'; break; 						
    }
    return $hour;
}

function change_status_hour_count($x){
    switch($x){
        case "1": $hour = 'h_ingreso'; break;
        case "2": $hour = 'h_empacado'; break;
        case "3": $hour = 'h_empleado'; break; 
        case "4": $hour = 'h_entrega'; break; 							
    }
    return $hour;
}
function change_status_count($x){
    switch($x){
        case "1":  $status = "2"; break;
        case "2":  $status = "3"; break;        
    }
    return $status;
}
function visit_status_bg($status){
    switch($status){
        case "1":  $status = "text-success"; break;
        case "2":  $status = " text-danger"; break; 
        case "3":  $status = " text-primary"; break;  
    }
    return $status;
}

function visit_status_icon($status){
    switch($status){
        case "1":  $status = "icon-plus text-success"; break;
        case "2":  $status = "icon-close text-danger"; break; 
        case "3":  $status = "icon-check text-primary"; break;  
    }
    return $status;
}

function visit_status($status){
    switch($status){
        case "1":  $status = "Activa"; break;
        case "2":  $status = "Cancelada"; break; 
        case "3":  $status = "Terminada"; break;  
    }
    return $status;
}

function listoption_template($data,$items = 0){    
    $edit   = $data["edit_function"]."('".$data["id"]."')";
    $delete = $data["delete_function"]."('".$data["id"]."')";
    
    if($items != 0){
        $edit   = $data["edit_function"].'('.$data["id"].','.$data["id2"].')';        
    }    
        
    $icon = '<div class="my-auto line-h-1 h5 text-center">
                <a class="text-success openside" onclick="'.$edit.'">
                    <i class="icon-pencil"></i>
                </a>
                <a class="text-danger openside" onclick="'.$delete.'">
                    <i class="icon-trash"></i>
                </a>
            </div>';
    return $icon; 
}

function existence_status($type){
    switch($type){
        case "1": $status = "Activo"; break;
        case "0": $status = "Inactivo"; break;
        case "2": $status = "Proceso"; break;

    }
    return $status;
}

function generalstatus($type){
    switch($type){
        case "1": $status = "Activo"; break;
        case "0": $status = "Inactivo"; break;
    }
    return $status;
}

?>