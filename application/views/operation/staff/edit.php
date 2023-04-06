<!-- START: Card Data Array
(
    [id] => 1
    [id_sitio] => 3
    [id_empresa] => 2
    [nombre] => angelo
    [puesto] => reparto
    [telefono] => 7221987139
    [estado] => 1
    [empresa] => Eplus
    [sitio] => Express Plus
)
 -->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="update_staff_form">
                <input type="hidden" name="id_staff" value="<?=$info["id"]?>">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                  
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="update_staff()">Editar</button>
                    </div>
                </div>
   
                <div class="card-body">    

                    <div class="form-row">  
                        <div class="form-group col-md-12">
                            <h6><b>Empresa:</b> <?=ucwords($info["empresa"])?></h6>
                            <h6><b>Sucursal: </b> <?=ucwords($info["sitio"])?>  </h6>
                        </div>  
                    </div>    

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Nombre</b></h6>
                                <input type="text" class="form-control" name="staff_name" id="staff_name" value="<?=$info["nombre"]?>"/>
                        </div> 
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Puesto</b></h6>
                                <input type="text" class="form-control" name="staff_job" id="staff_job" value="<?=$info["puesto"]?>"/>
                        </div> 
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Teléfono</b></h6>
                                <input type="text" class="form-control" name="staff_phone" id="staff_phone" value="<?=$info["telefono"]?>"/>
                        </div> 
                    </div>   
                     
                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script>

function update_staff(){    
    jQuery.ajax({
        type: "POST",
        data: $("#update_staff_form").serialize(),
        url: "<?=base_url()?>/Operation/Staff/update_staff",
        success: function (response) {           
             close_sidebar();
             location.reload();
        }});
}

</script>