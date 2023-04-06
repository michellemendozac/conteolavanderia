 <!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="new_emp_form">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="add_staff()">Agregar</button>
                    </div>
                </div>
   
                <div class="card-body">                
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Nombre</b></h6>
                                <input type="text" class="form-control" name="emp_name" id="emp_name"/>
                        </div>  
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Turno:</b> </h6>
                            <select class="form-control select-form" name="emp_turno" id="emp_turno">
                                <option value="0">Selecciona un turno</option>
                                <option value="1">Matutino</option>
                                <option value="2">Vespertino</option>
                                <option value="3">Nocturno</option>
                                <option value="4">Mixto</option>
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
                                <option value="<?=$place->id_sitio?>"><?=$place->nombre?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Código empleado</b></h6>
                                <input type="text" class="form-control" name="emp_code" id="emp_code"/>
                        </div> 
                    </div>  

                    <div class="form-row">
                        <div class="form-group col-md-12"> 
                            <h6><b>Ubicación:</b> </h6>   
                        </div>  
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_col" id="emp_save_col">
                                <option value="0">Columna</option>
                                <option value="A">A</option>
                                <option value="A">B</option>
                                <option value="A">C</option>
                                <option value="A">D</option> 
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div> 
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_sub" id="emp_save_sub">
                                <option value="0">Sub-Columna</option>
                                <option value="A">1</option>
                                <option value="A">2</option>
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div> 
                        <div class="form-group col-md-4">  
                            <select class="form-control select-form" name="emp_save_fil" id="emp_save_fil">
                                <option value="0">Fila </option>
                                <?php for($xv = 1; $xv <= 7; $xv++){ ?>
                                    <option value="<?=$xv?>"><?=$xv?></option>
                                <?php } ?> 
                            </select>
                            <div class="invalid-feedback" id="feedback-confuserrol"></div>
                        </div>  
                    </div> 
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12"> 
                            <h6><b>Estatus de colaborador:</b> </h6>
                            <select class="form-control select-form" name="emp_status" id="emp_status">
                                <option value="1">Activo </option>
                                <option value="2">Inactivo </option>
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

function add_staff(){    
    jQuery.ajax({
        type: "POST",
        data: $("#new_emp_form").serialize(),
        url: "<?=base_url()?>/Operation/Employe/add_emp",
        success: function (response) {           
             close_sidebar();
             location.reload();
        }});
}

</script>