<!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="visit_update_form">
                <input type="hidden" name="id_visita" value="<?=$info_visit["id_visita"]?>">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="update_visit()">Editar Visita</button>
                    </div>
                </div>
   
                <div class="card-body">                
     
                

                    <div class="form-row">  
                        <div class="form-group col-md-12">
                            <h4 class="<?=visit_status_bg($info_visit["estado"])?>"> 
                            <span class="<?=visit_status_icon($info_visit["estado"])?>"></span> Visita <?=visit_status($info_visit["estado"])?></h4>
                            </br>
                            <h6><b>Visita:</b> #<?=$info_visit["id_visita"]?></h6>
                            <h6><b>Fecha:</b> <?=$info_visit["h_inicio"]?>  </h6>
                            <h6><b>Lugar:</b> <?=$info_visit["empresa"]?> <?=$info_visit["sitio"]?>, <?=ucwords($info_visit["direccion"])?> </h6>
                            <h6><b>Ubicación:</b> <?=ucwords($info_visit["ubicacion"])?>  </h6>
                            <h6><b>Inicio:</b> <?=$info_visit["h_inicio"]?></h6>
                            <h6><b>Turno:</b> <?=ucwords(turno($info_visit["turno"]))?></h6>
                            <h6><b>Responsable de visita: </b> <?=ucwords($info_visit["atendio"])?>  </h6>
                        </div>  
                     </div>  

                    <div class="form-row">                           
                        <div class="form-group col-md-12"> 
                            <h6><b>Comentarios de reparto:</b> <?=$info_visit["comentarios"]?>  </h6>
                            
                        </div>  
                    </div>

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Responsable de recepción:</b> </h6>
                            <select class="form-control select-form" name="resp_recp" id="resp_recp">
                                <option value="0">Selecciona un responsable </option>
                                <?php foreach($staff_list as $staff): ?>
                                <option <?=(isset($staff->id) && $info_visit["id_resp_recepcion"] == $staff->id)?'selected':''?> value="<?=$staff->id?>"><?=$staff->nombre?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Estatus de visita:</b> </h6>
                            <select class="form-control select-form" name="visit_status" id="visit_status">
                                <option <?=(isset($info_visit["estado"]) && $info_visit["estado"] == 1)?'selected':''?> value="1">Activa </option>
                                <option <?=(isset($info_visit["estado"]) && $info_visit["estado"] == 2)?'selected':''?> value="2">Cancelada </option>
                                <option <?=(isset($info_visit["estado"]) && $info_visit["estado"] == 3)?'selected':''?> value="3">Terminada </option>
                                 
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div>

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Observaciones </b>   </h6>
                            <textarea class="form-control" name="coment_visit" id="coment_visit"><?=$info_visit["info_visita"]?></textarea>
                        </div> 
                    </div>  
                  

                   
                     
                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script>

   

function update_visit(){    
    jQuery.ajax({
        type: "POST",
        data: $("#visit_update_form").serialize(),
        url: "<?=base_url()?>/Operation/Visit/update_visit",
        success: function (response) {           
             close_sidebar();
        }
    });
}


</script>