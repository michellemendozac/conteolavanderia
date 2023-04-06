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
            <?php $this->load->view("config/vehicle/menu_vehicle"); ?>
        </div>
        <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
            <button type="button" class="btn btn-primary" onclick="new_item()">Nuevo elemento</button>
        </div>
    </div>
</div>
 
<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="display w-100 table dataTable table-striped table-bordered editable-table">
            <thead>       
                <tr>
                    <th width="5%">ID</th>
                    <th width="15%">Categoría</th>                    
                    <th width="15%">Colaborador</th>
                    <th width="10%">Codigo emp</th>
                    <th width="15%">Empresa</th>
                    <th width="15%">Sitio</th>
                    <th width="10%">Ubicación</th>
                    <th width="5%" class="text-center">Estatus</th>
                    <th width="5%">&nbsp;</th>
                </tr>
            </thead> 
        </table>
    </div>
</div> 


<script>


function new_item(){
    $("#sidebar-content").html("");   
    $.ajax({
        type: "POST",         
        url: "<?=base_url()?>/Operation/Existence/new_item",
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

function del_inv(id){
    $("#sidebar-content").html("");  
    $.ajax({ 
        type: "POST",  
        data: {id:id},     
        url: "<?=base_url()?>/Operation/Existence/del_inv",
        success: function (response) {  
               
            close_sidebar();
            location.reload();
            
        }
    });
}
 
</script>