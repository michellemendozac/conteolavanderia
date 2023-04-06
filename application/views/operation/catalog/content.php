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
            <?php $this->load->view("operation/catalog/menu_catalog"); ?>
        </div>
        <!-- <div class="align-self-center ml-auto text-center text-sm-right">           
            <a href="#" class="bg-primary py-2 px-2 rounded ml-auto text-white text-center openside">
                <i class="icon-plus align-middle text-white"></i> 
                <span class="d-none d-xl-inline-block">Nuevo Vehículo</span>
            </a>  
        </div> -->
    </div> 
</div>
 
<div class="card-body album py-5 bg-light "> 
    <div class="row">
    <?php 
    if(isset($catalog_list) && count($catalog_list)>0){
        foreach($catalog_list  AS $row){
    ?>
             
                <div class="col-md-3"> 
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" alt="<?=ucfirst($row->nombre)?> [100%x225]" style="height: 225px; width: 80%; display: block; position: relative;  margin-left: auto; margin-right: auto;" src="<?=base_url()?>/assets/images/catalog/<?=($row->foto!='')?$row->foto:'default.jpg'?>" data-holder-rendered="true">
                    <div class="card-body">
                    <h5><?=ucfirst($row->nombre)?></h5>
                    <p class="h6 text-primary">                        
                        <?=($row->marca  != '')?ucfirst($row->marca):''?> / <?=($row->color  != '')?ucfirst($row->color):''?> / <?=($row->existencia  != '')?$row->existencia:'0'?> piezas
                    </p>
                    <p class="h6 text-primary">                        
                         <?=($row->precio  != '')?"$".$row->precio." MXN":''?>
                    </p>
                    <p class="h6 text-primary">                        
                         <?=($row->genero  != '')?ucfirst(gender($row->genero)):''?>
                    </p>
                    <p class="card-text">
                        <?=($row->descripcion  != '')?ucfirst($row->descripcion):''?>   
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group"> 
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="edit_item_cat('<?=$row->id_prenda?>')">Editar</button>
                        </div> 
                        <b class="text-muted"><?=($row->estado  == '1')?'Activo':'Inactivo'?> </b>
                    </div>
                    </div>
                </div>
                </div> 
            
    <?php 
        }
    }   
    ?> 
    </div>
</div> 

  

<script>
function close_sidebar(){
         $('#settings').removeClass('active');          
} 

 

 
function edit_item_cat(id){
    $("#sidebar-content").html("");  
    $.ajax({
        type: "POST", 
        data: {id:id},
        url: "<?=base_url()?>/Operation/Catalog/edit_cat",
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