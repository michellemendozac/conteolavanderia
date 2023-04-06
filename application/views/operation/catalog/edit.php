 <!-- START: Card Data -->
 <div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="edit_cat_form">
                <input type="hidden" name="cat_id_prenda" value="<?=$info["id_prenda"]?>">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="update_cat()">Editar</button>
                    </div>
                </div>
   
                <div class="card-body">                
                    
                    <div class="form-row">  
                        <div class="form-group col-md-12">
                            <h4 class="<?=ucwords($info["nombre"])?>"> 
                            </br>
                            
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" alt="<?=$info["nombre"]?> [100%x225]" style="height: 225px; width: 80%; display: block; position: relative;  margin-left: auto; margin-right: auto;" src="<?=base_url()?>/assets/images/catalog/<?=($info["foto"]!='')?$info["foto"]:'default.jpg'?>" data-holder-rendered="true">
                            </div>  

                            <h6><b>Marca:</b>  <?=ucwords($info["marca"])?></h6>
                            <h6><b>Color:</b>  <?=ucwords($info["color"])?>  </h6>
                            <h6><b>Genero:</b> <?=ucwords(gender($info["genero"]))?> </h6>
                            <h6><b>Existencia:</b> <?=ucwords($info["existencia"])?>  </h6>

                            
                        </div>  
                    </div>   

                    

                      

                    <div class="form-row">
                        <div class="form-group col-md-12"> 
                        <h6><b>Precio</b></h6>   
                        </div>  
                        <div class="form-group col-md-1  pt-1 "><h6><b>$</b></h6></div> 
                        <div class="form-group col-md-9">  
                            <input type="text" class="form-control" name="cat_precio" id="cat_precio"  value="<?=$info["precio"]?>"/>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div> 
                        <div class="form-group col-md-2 pt-1"><h6><b>MXN</b></h6></div>  
                    </div> 

                    

                     
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Estatus:</b> </h6>
                            <select class="form-control select-form" name="cat_status" id="cat_status">
                                <option <?=(isset($info["estado"]) && $info["estado"] == "1")?'selected':''?> value="1">Activo </option>
                                <option <?=(isset($info["estado"]) && $info["estado"] == "2")?'selected':''?> value="2">Inactivo </option>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div>

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Descripción</b></h6>
                                <textarea class="form-control" name="cat_desc"><?=$info["descripcion"]?></textarea>
                        </div> 
                    </div> 

                     
                     
                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script> 

function update_cat(){    
    jQuery.ajax({
        type: "POST",
        data: $("#edit_cat_form").serialize(),
        url: "<?=base_url()?>/Operation/Catalog/update_cat",
        success: function (response) {           
             close_sidebar();
             location.reload();
        }});
}

</script>