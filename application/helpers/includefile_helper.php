<?php
function  fileby_option($options){  
        $dtableurl   = "/dist/vendors/datatable";
        $datatable   = ["head"   => ["$dtableurl/css/dataTables.bootstrap4.min.css",
                                     "$dtableurl/buttons/css/buttons.bootstrap4.min.css"],            
                        "footer" => ["$dtableurl/js/jquery.dataTables.min.js",
                                    "$dtableurl/js/dataTables.bootstrap4.min.js",
                                    "$dtableurl/jszip/jszip.min.js",
                                    "$dtableurl/pdfmake/pdfmake.min.js",
                                    "$dtableurl/pdfmake/vfs_fonts.js",
                                    "$dtableurl/buttons/js/dataTables.buttons.min.js",
                                    "$dtableurl/buttons/js/buttons.bootstrap4.min.js",
                                    "$dtableurl/buttons/js/buttons.colVis.min.js",
                                    "$dtableurl/buttons/js/buttons.flash.min.js",
                                    "$dtableurl/buttons/js/buttons.html5.min.js",
                                    "$dtableurl/buttons/js/buttons.print.min.js",
                                    "$dtableurl/editor/mindmup-editabletable.js",
                                    "$dtableurl/editor/numeric-input-example.js"],
                        "scripts" => ["layouts/scripts/script_list"]];
        $icheck                 =   ["head"   =>  ["/dist/vendors/icheck/skins/all.css"],            
                                     "footer" =>  ["/dist/vendors/icheck/icheck.min.js"]];        
        $validate               =   ["footer" => ["/dist/js/validate.js"]];

        $allfiles               =   ["datatable" => $datatable, "icheck" => $icheck, "validate" => $validate];   

        $return = [];

        foreach($options as $option){
            $return[$option] = $allfiles[$option];            
        }

        return $return;
}

/*  "template"    => Base template
    "config_menu" => Sub menu
    "content"     => Content page
    "table"       => Get data function
    "add_url"     => Save new data function
    "sidebar"     => Sidebar form
    "deleteit"    => Delete function */

function includefiles($page){
    $opt = [];
    switch($page){          
        case "Visit":        
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/visitas/content",
                            "table"       => "visit/visit_list",                            
                            "add_url"     => "/Config/Vehicles/new",  
                            "sidebar"     => "config/vehicle/add_vehicle",//
                            "upconf"      => "/Config/Speeds/update", //
                            "deleteit"    => "/Config/Vehicles/delete"];  //
                          
             $scriptendfile = ["/dist/js/visit.js"]; 
        break;   
  
        case "Staff":             
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/staff/content",
                            "table"       => "staff/staff_list", 
                            "add_url"     => "/Config/Speeds/new",  
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            $scriptendfile = ["/dist/js/staff.js"]; 
        break; 

        case "Catalog":  
            $options     = [];         
            $body        = ["template"    => ["layouts/config"],  
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/catalog/content",
                            "table"       => "catalog/catalog_list", 
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
         break;


        case "Existence":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/existence/content",
                            "table"       => "existence/existence_list", 
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
         break;
        
  
        case "Counts":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/counts/content",
                            "table"       => "counts/count_list", 
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
         break;

        case "Count_visit":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/visit_count", 
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
         break;

        case "Count_type":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/type_count",
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
         break;
        
        case "Order_package":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/orderpackage",
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
        break;

        case "Item_Count":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/count",
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            
        break;

        case "Delivery_Count_packed":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/package",   
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            //$scriptendfile = ["/dist/js/staff.js"]; 
        break;

        case "Delivery_Count_employe":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/consult", 
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            //$scriptendfile = ["/dist/js/staff.js"]; 
        break;

        case "Delivery_Count_piece":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/count"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "counts/count",
                            "table"       => "counts/count_list", 
                            "step"        => "counts/delivery",  
                            "add_url"     => "/Config/Speeds/new", 
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            //$scriptendfile = ["/dist/js/staff.js"]; 
        break;

        case "order":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/order/content",
                            "table"       => "order/order_list", 
                            "add_url"     => "/Config/Speeds/new",  
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            //$scriptendfile = ["/dist/js/staff.js"]; 
        break;
        
        case "employe":          
            $options     = ["datatable"];
            $body        = ["template"    => ["layouts/config"], 
                            "config_menu" => "operation/config_menu",
                            "content"     => "operation/employe/content",
                            "table"       => "employe/employe_list", 
                            "add_url"     => "/Config/Speeds/new",  
                            "sidebar"     => "config/speed/add_speed", 
                            "upconf"      => "/Config/Speeds/update",
                            "deleteit"    => "/Config/Speeds/delete"];
            //$scriptend     = ["acount/users/validate_user"];  
            //$scriptendfile = ["/dist/js/staff.js"]; 
        break;
        
        
        // ###### ACOUNT FILES ###### //
        // **** Users files  => Acount/User **** //
        case "Users":  
            $options     = ["datatable","icheck","validate"];
            $body        = ["template" => ["acount/config"],
                            "list"     => "acount/users/user_list",
                            "table"    => "/Acount/User/List",
                            "config"   => "acount/users/user_configform",
                            "add_url"  => "/Acount/User/new",
                            "sidebar"  => "acount/users/add_user",
                            "upconf"   => "/Acount/User/update",
                            "deleteit" => "/Acount/User/delete"];            
            $scriptendfile = ["/dist/js/validate_user.js"];
        break; 
        
        // **** Profile files  => Acount/User **** //
        case "Profile":
            $options     = ["datatable","icheck","validate"]; 
            $body        = ["template" => ["acount/config"],
                            "content"  => "acount/users/profile", 
                            "table"    => "/Acount/Companys/List",
                            "upconf"   => "/Acount/Companys/update",
                            "deleteit" => "/Acount/Companys/delete",
                            "add_url"  => "/Acount/Companys/new",
                            "upconf"   => "/Acount/User/update",
                            "deleteit" => "/Acount/User/deleteprofile"];
            $scriptendfile = ["/dist/js/validate_user.js"];
        break;
        // **** Rol files  => Acount/Rol **** //
        case "Rol":
            $options     = ["datatable","icheck"];
            $datatable   = "/dist/vendors/datatable";
            $body        = ["template" => ["acount/config"],
                            "list"     => "acount/roles/rol_list",
                            "table"    => "/Acount/Rol/List",
                            "config"   => "acount/roles/rol_configform",
                            "add_url"  => "/Acount/Rol/new",
                            "sidebar"  => "acount/roles/add_rol",
                            "upconf"   => "/Acount/Rol/update",
                            "deleteit" => "/Acount/Rol/delete"];
        break;
        // **** Company files  => Acount/Contact **** //
        case "CompanyList":
            $options     = ["datatable","icheck","validate"];
            $body        = ["template" => ["acount/config"],
                            "list"     => "acount/company/company_list", 
                            "table"    => "/Acount/Companys/List",
                            "config"   => "acount/company/company_configform",
                            "add_url"  => "/Acount/Companys/new",
                            "sidebar"  => "acount/company/add_company",
                            "upconf"   => "/Acount/Companys/update",
                            "deleteit" => "/Acount/Companys/delete"]; 
        break; 
        // **** My Company files  => Acount/Company/MyCompany **** //
        case "MyCompany":
            $options     = ["datatable","icheck","validate"];
            $body        = ["template" => ["acount/config"],
                            "content"  => "acount/company/mycompany",
                            "table"    => "/Acount/Companys/List",
                            "upconf"   => "/Acount/Companys/update",
                            "deleteit" => "/Acount/Companys/delete",
                            "add_url"  => "/Acount/Companys/new",
                            "sidebar"  => "acount/roles/add_rol"]; 
        break;
        // **** Office List files   => Acount/Office **** //
        case "OfficeList":
            $options     = ["datatable","icheck"];
            $body        = ["template" => ["acount/config"],
                            "list"     => "acount/office/office_list",
                            "table"    => "/Acount/Office/List",
                            "config"   => "acount/office/office_configform",
                            "add_url"  => "/Acount/Office/new",
                            "sidebar"  => "acount/office/add_office",
                            "upconf"   => "/Acount/Office/update",
                            "deleteit" => "/Acount/Office/delete"]; 
        break;
        // **** Contact files   => Acount/Contact **** //
        case "ContactList":
            $options = ["datatable","icheck","validate"];
            $body        = ["template" => ["acount/config"],
                            "list"     => "acount/contact/contact_list",
                            "table"    => "/Acount/Contact/List",
                            "config"   => "acount/contact/contact_configform",
                            "add_url"  => "/Acount/Contact/new",
                            "sidebar"  => "acount/contact/add_contact",
                            "upconf"   => "/Acount/Contact/update",
                            "deleteit" => "/Acount/Contact/delete"];
        break;
        // ###### ACOUNT FILES ###### //
    } 
 
    if(isset($options)){        
        if(!isset($head)){ $head = []; }
        if(!isset($footer)){ $footer = []; }
        if(!isset($scripts)){ $scripts = []; }
        if(!isset($scriptend)){ $scriptend = []; }
        if(!isset($scriptendfile)){ $scriptendfile = []; }
  
        $opt = fileby_option($options);
        foreach($opt as $opts){  
            if(isset($opts["head"])){
                foreach($opts["head"] as $file){ 
                    array_push($head, $file); 
                }
            } 
            if(isset($opts["footer"])){
                foreach($opts["footer"] as $file){  
                    array_push($footer, $file); 
                }
            }
            if(isset($opts["scripts"])){
                foreach($opts["scripts"] as $file){  
                    array_push($scripts, $file); 
                }
            }
            if(isset($opts["scriptend"])){
                foreach($opts["scriptend"] as $file){
                    array_push($scriptend, $file);
                }
            } 
        }
    }
    
    $include = ["head" => $head, "body" => $body, "footer" => $footer, "scripts" => $scripts, "scriptend" => $scriptend, "scriptendfile" => $scriptendfile];    
    return $include;
}
?>