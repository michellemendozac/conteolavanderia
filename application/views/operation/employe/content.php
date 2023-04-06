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
                <?php $this->load->view("operation/employe/menu_employe"); ?>
        </div>
        <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
            <button type="button" class="btn btn-primary" onclick="new_emp()">Nuevo colaborador</button>
        </div>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table id="example" class="display w-100 table dataTable table-striped table-bordered editable-table">
            <thead>       
                <tr>
                    <th width="5%">ID</th>
                    <th width="25%">Nombre</th>
                    <th width="15%">Turno</th>                    
                    <th width="20%">Sucursal</th>
                    <th width="10%">Codigo empleado</th>
                    <th width="10%">Ubicación</th>
                    <th width="10%" class="text-center">Estatus</th> 
                    <th width="5%">&nbsp;</th>                   
                </tr>
            </thead> 
        </table>
    </div>
 
<script>


function new_emp(){
    $("#sidebar-content").html("");  
    console.log("stafff");
    $.ajax({
        type: "POST",         
        url: "<?=base_url()?>/Operation/Employe/new_emp",
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

function edit_emp(id,sitio,empresa){
    $("#sidebar-content").html("");  
    $.ajax({ 
        type: "POST",  
        data: {id:id,sitio:sitio,empresa:empresa},     
        url: "<?=base_url()?>/Operation/Employe/edit_emp",
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