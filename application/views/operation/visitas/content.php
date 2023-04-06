<div id="visit_primary_list">
    <div class="card-header  justify-content-between align-items-center"> 
        <div class="sub-header px-md-0 align-self-center d-sm-flex w-100 rounded">
            <div class="w-sm-100 mr-auto">
                <h4 class="card-title"><?=$custom["header"]?></h4>                          
            </div>  
        </div>
    </div>   

    <div class="profile-menu theme-background border  z-index-1 p-2">
        <div class="d-sm-flex">
            <div class="align-self-center">
                <?php $this->load->view("operation/visitas/menu_visit"); ?>
            </div>
            <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                <button type="button" class="btn btn-primary" onclick="new_visit()">Nueva visita</button>
            </div>
        </div> 
    </div>                       

    <div class="card-body">
        
                <div class="table-responsive">
                    <table id="example" class="display w-100 table dataTable table-striped table-bordered editable-table">
                        <thead>       
                            <tr>
                                <th width="10%">ID</th>
                                <th width="20%">Sucursal</th> 
                                <th width="20%">Turno</th>                    
                                <th width="10%">Llegada</th>
                                <th width="15%">Salida</th>
                                <th width="22%">Recibió</th>
                                <th width="13%" class="text-center">Estatus</th>
                                <th width="10%" class="text-center">Ver</th>
                                <th width="10%" class="text-center">Editar</th>
                            </tr>
                        </thead> 
                    </table>
                </div>
        
    </div>    
</div>

<div id="visit_primary_detail" style="display:none;"></div>
<div id="visit_count_detail" style="display:none;"></div>



<script>

function show_visit(id,site){
    
    $("#visit_primary_list").css("display","none");
    $("#visit_count_detail").css("display","none");

    $("#visit_primary_detail").html("");  
    $("#visit_primary_detail").css("display","block");

    
    $.ajax({
        type: "POST",     
        data: {id:id,sitio:site},    
        url: "<?=base_url()?>/Operation/Visit/count_list",
        success: function (response) {  
            $("#visit_primary_detail").html(response);   
        }
    });
 
}

function activa_count_list(){

    $("#visit_primary_list").css("display","none"); 
    $("#visit_primary_detail").css("display","block");
    $("#visit_count_detail").css("display","none");   

}

function show_primary_list(){
    $("#visit_primary_list").css("display","block");

    $("#visit_primary_detail").css("display","none");
    $("#visit_count_detail").css("display","none");  
 
}

function return_count(id,visit){

    $("#visit_primary_list").css("display","none");
    $("#visit_primary_detail").css("display","none");

    $("#visit_count_detail").html("");   
    $("#visit_count_detail").css("display","block");


    $.ajax({
        type: "POST",     
        data: {id:id,visit:visit},    
        url: "<?=base_url()?>/Operation/Visit/count_view",
        success: function (response) {  
            console.log("aqui");
            $("#visit_count_detail").html(response);   
        }
    });
}

function close_sidebar(){
         $('#settings').removeClass('active');          
} 


 
function new_visit(){
    $("#sidebar-content").html("");  
    $.ajax({
        type: "POST",         
        url: "<?=base_url()?>/Operation/Visit/new_visit",
        success: function (response) {  
                
                $("#sidebar-content").html(response);                 
                $('.openside').on('click', function () {
                    $('#settings').toggleClass('active');
                    return false;
                });
                $('#settings').addClass('active');
            
        }
    });
} 

 
function edit_visit(id,sitio){
    $("#sidebar-content").html("");  
    $.ajax({
        type: "POST", 
        data: {id:id,sitio:sitio},
        url: "<?=base_url()?>/Operation/Visit/edit_visit",
        success: function (response) { 
                       
                //Set speed information 
              /*  $("#speed_id").val(speed.id_velocidad);
                $("#speed_name").val(speed.nombre,speed.id_velocidad);
                $("#speed_min").val(speed.minima);
                $("#speed_normal").val(speed.normal);
                $("#speed_regular").val(speed.regular);
                $("#speed_max").val(speed.maxima);
                $("#speed_unit").val(speed.unidad);*/
                //Show lateral form
            
                // Show edit button and hide add button              
                
                $("#sidebar-content").html(response);                 
                $('.openside').on('click', function () {
                    $('#settings').toggleClass('active');
                    return false;
                });
                $('#settings').addClass('active');
            
        }
    });
} 

</script>