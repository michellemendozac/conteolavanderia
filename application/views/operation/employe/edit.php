 <!-- START: Card Data -->
 <div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="edit_emp_form">
                <input type="hidden" name="id_colaborador" value="<?=$info["id_colaborador"]?>">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="update_emp()">Editar</button>
                    </div>
                </div>
   
                <div class="card-body">                
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Nombre</b></h6>
                                <input type="text" class="form-control" name="emp_name" id="emp_name" value="<?=$info["nombre"]?>"/>
                        </div>  
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Turno:</b> </h6>
                            <select class="form-control select-form" name="emp_turno" id="emp_turno">
                                <option <?=(isset($info["turno"]) && $info["turno"] == "1")?'selected':''?> value="1">Matutino</option>
                                <option <?=(isset($info["turno"]) && $info["turno"] == "2")?'selected':''?> value="2">Vespertino</option>
                                <option <?=(isset($info["turno"]) && $info["turno"] == "3")?'selected':''?> value="3">Nocturno</option>
                                <option <?=(isset($info["turno"]) && $info["turno"] == "4")?'selected':''?> value="4">Mixto</option>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div>

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Sucursal:</b> </h6>
                            <select class="form-control select-form" name="emp_place" id="emp_place">
                                <option value="0">Selecciona una sucursal </option>
                                <?php foreach($place_list as $place): ?>
                                <option <?=(isset($info["id_sitio"]) && $info["id_sitio"] == $place->id_sitio)?'selected':''?> value="<?=$place->id_sitio?>"><?=$place->nombre?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Código empleado</b></h6>
                                <input type="text" class="form-control" name="emp_code" id="emp_code"  value="<?=$info["company_code"]?>"/>
                        </div> 
                    </div>  

                    <div class="form-row">
                        <div class="form-group col-md-12"> 
                            <h6><b>Ubicación:</b> </h6>   
                        </div>  
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_col" id="emp_save_col">
                                <option value="0">Columna</option>
                                <option value="A" <?=(isset($info["columna"]) && $info["columna"] == "A")?'selected':''?>>A</option>
                                <option value="A" <?=(isset($info["columna"]) && $info["columna"] == "B")?'selected':''?>>B</option>
                                <option value="A" <?=(isset($info["columna"]) && $info["columna"] == "C")?'selected':''?>>C</option>
                                <option value="A" <?=(isset($info["columna"]) && $info["columna"] == "D")?'selected':''?>>D</option> 
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div> 
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_sub" id="emp_save_sub">
                                <option value="0">Sub-Columna</option>
                                <option <?=(isset($info["fila"]) && $info["fila"] == "1")?'selected':''?> value="1">1</option>
                                <option <?=(isset($info["fila"]) && $info["fila"] == "2")?'selected':''?> value="2">2</option>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div> 
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_fil" id="emp_save_fil">
                                <option value="0">Fila </option>
                                <?php for($xv = 1; $xv <= 7; $xv++){ ?>
                                    <option <?=(isset($info["ubicacion"]) && $info["ubicacion"] == $xv)?'selected':''?> value="<?=$xv?>"><?=$xv?></option>
                                <?php } ?> 
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Estatus de colaborador:</b> </h6>
                            <select class="form-control select-form" name="emp_status" id="emp_status">
                                <option <?=(isset($info["estado"]) && $info["estado"] == "1")?'selected':''?> value="1">Activo </option>
                                <option <?=(isset($info["estado"]) && $info["estado"] == "2")?'selected':''?> value="2">Inactivo </option>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div>

                     
                     
                    
                </div>
                
            </form>    
        </div>
    </div>  
</div> 

<script> 

function update_emp(){    
    jQuery.ajax({
        type: "POST",
        data: $("#edit_emp_form").serialize(),
        url: "<?=base_url()?>/Operation/Employe/update_emp",
        success: function (response) {           
             close_sidebar();
             location.reload();
        }});
}

</script>