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
            <?php $this->load->view("operation/staff/menu_staff"); ?>
        </div>
        <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
            <button type="button" class="btn btn-primary" onclick="new_staff()">Nuevo Personal</button>
        </div>
      
    </div> 
</div>

<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="display w-100 table dataTable table-striped table-bordered editable-table">
            <thead>        
                <tr> 
                    <th width="10%">ID</th>
                    <th width="22%">Nombre</th>
                    <th width="20%">Puesto</th> 
                    <th width="20%">Telefono</th>                                        
                    <th width="10%">Empresa</th>
                    <th width="15%">Sucursal</th>                    
                    <th width="13%" class="text-center">Estatus</th>
                    <th width="10%">&nbsp;</th>
                </tr>
            </thead> 
        </table>
    </div>
</div> 

<script>


function new_staff(){
    $("#sidebar-content").html("");  
    console.log("stafff");
    $.ajax({
        type: "POST",         
        url: "<?=base_url()?>/Operation/Staff/new_staff",
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

function close_sidebar(){
         $('#settings').removeClass('active');          
} 

function edit_staff(id,sitio,empresa){
    $("#sidebar-content").html("");  
    $.ajax({ 
        type: "POST",  
        data: {id:id,sitio:sitio,empresa:empresa},     
        url: "<?=base_url()?>/Operation/Staff/edit_staff",
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
 
</script>