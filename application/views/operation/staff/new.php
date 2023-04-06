<!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="new_staff_form">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="add_staff()">Agregar nuevo contacto</button>
                    </div>
                </div>
   
                <div class="card-body">                
                    
                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Nombre</b></h6>
                                <input type="text" class="form-control" name="staff_name" id="staff_name"/>
                        </div> 
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Puesto</b></h6>
                                <input type="text" class="form-control" name="staff_job" id="staff_job"/>
                        </div> 
                    </div> 

                    <div class="form-row">                         
                        <div class="form-group col-md-12">
                                <h6><b>Teléfono</b></h6>
                                <input type="text" class="form-control" name="staff_phone" id="staff_phone"/>
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
        data: $("#new_staff_form").serialize(),
        url: "<?=base_url()?>/Operation/Staff/add_staff",
        success: function (response) {           
             close_sidebar();
             location.reload();
        }});
}

</script>
