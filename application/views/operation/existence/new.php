  <!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="new_item_form">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="add_item()">Agregar</button>
                    </div>
                </div>
   
                <div class="card-body">                
                                        
                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Prenda:</b> </h6>
                            <select class="form-control select-form" name="item_cat" id="item_cat">
                                <option value="0">Selecciona una prenda </option>
                                <?php foreach($category_list as $category): ?>
                                <option value="<?=$category->id_prenda?>"><?=ucfirst($category->nombre)." ".$category->marca." ".$category->color." ".gender($category->genero)?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div>
                     

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Lugar:</b> </h6>
                            <select class="form-control select-form" onchange="existence_staff()" name="existence_place" id="existence_place">
                                <option value="0">Selecciona una sucursal </option>
                                <?php foreach($place_list as $place): ?>
                                <option value="<?=$place->id_sitio?>"><?=$place->nombre.", ".$place->direccion?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 

                    <div id="existence_staff"></div> 
                     
                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script> 


function existence_staff(){ 
    console.log("ff");
    $("#existence_staff").html("");
    jQuery.ajax({
        type: "POST",
        data: {id:$("#existence_place").val()},   
        url: "<?=base_url()?>/Operation/Existence/employe_list",
        success: function (response) {           
             $("#existence_staff").html(response);
        }
    }); 
}


function add_item(){    
    jQuery.ajax({
        type: "POST",
        data: $("#new_item_form").serialize(),
        url: "<?=base_url()?>/Operation/Existence/add_item",
        success: function (response) {           
             close_sidebar();
             location.reload();  
        }});
}

</script>