 <!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="visit_new_form">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="add_visit()">Nueva Visita</button>
                    </div>
                </div>
   
                <div class="card-body">                
     
                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Lugar:</b> </h6>
                            <select class="form-control select-form" onchange="visit_staff()" name="visit_place" id="visit_place">
                                <option value="0">Selecciona una sucursal </option>
                                <?php foreach($place_list as $place): ?>
                                <option value="<?=$place->id_sitio?>"><?=$place->nombre.", ".$place->direccion?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 

                    <div id="visit_content" style="display:none;">
                            <div class="form-row">                         
                                <div class="form-group col-md-12">
                                        <h6><b>Ubicación:</b></h6>
                                        <input type="text" class="form-control" name="visit_ub"/>
                                </div> 
                            </div> 

                            <div id="visit_staff"></div>


                            <div class="form-row">                         
                                <div class="form-group col-md-12">
                                        <h6><b>Fecha:</b></h6>
                                        <input type="datetime-local" class="form-control" name="visit_date"/>
                                </div> 
                            </div> 

                            <div class="form-row">                         
                                <div class="form-group col-md-12"> 
                                    <h6><b>Turno:</b> </h6>
                                    <select class="form-control select-form" name="visit_turn" id="visit_turn">
                                        <option selected="selected" value="1">Matutino </option>
                                        <option value="2">Vespertino </option>
                                        <option value="3">Nocturno </option>
                                        <option value="4">Mixto </option>
                                        
                                    </select>
                                    <div class="invalid-feedback" id="feedback-confuserrol"></div>
                                </div>  
                            </div> 

                            

                            <div class="form-row">                         
                                <div class="form-group col-md-12"> 
                                    <h6><b>Estatus de visita:</b> </h6>
                                    <select class="form-control select-form" name="visit_status" id="visit_status">
                                        <option selected="selected" value="1">Activa </option>
                                        <option value="2">Cancelada </option>
                                        <option value="3">Terminada </option>
                                        
                                    </select>
                                    <div class="invalid-feedback" id="feedback-confuserrol"></div>
                                </div>  
                            </div> 


                            <div class="form-row">                         
                                <div class="form-group col-md-12">
                                        <h6><b>Observaciones </b>   </h6>
                                    <textarea class="form-control" name="coment_visit" id="visit_obs"></textarea>
                                </div> 
                            </div>   

                            <div class="form-row">                         
                                <div class="form-group col-md-12">
                                        <h6><b>Comentarios de reparto </b>   </h6>
                                    <textarea class="form-control" name="coment_info" id="visit_info"></textarea>
                                </div> 
                            </div>   
                    </div>
                    <!-- End visit content -->


                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script>


function visit_staff(){ 
    $("#visit_content").css("display","none");
    jQuery.ajax({
        type: "POST",
        data: {id:$("#visit_place").val()},   
        url: "<?=base_url()?>/Operation/Visit/visit_staff",
        success: function (response) {           
            $("#visit_content").css("display","block");
            $("#visit_staff").html(response);
        }
    }); 
}

function add_visit(){    
    jQuery.ajax({
        type: "POST",
        data: $("#visit_new_form").serialize(),
        url: "<?=base_url()?>/Operation/Visit/add_visit",
        success: function (response) {           
            close_sidebar();
             location.reload();
        }
    });
}


</script>