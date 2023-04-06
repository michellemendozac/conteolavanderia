<style>
 #table_recep   thead {
    position: static;
    top: 0;
}
#table_recep table {
  position: relative;
  border-collapse: collapse; 
}
#table_recep th, td {
  padding: 6%;
}

#table_recep th {  
  position: sticky;
  top: 0; 
}
</style>
<div class="card-body"> 
    <div class="row">
        <div class="col-12">
                 
                 
                <div class="position-relative px-3">
                    <div class="media d-md-flex">
                         <div class="media-body">
                            <div class="pl-4">
                                <h3 class=" text-uppercase mb-0 text-center" id="company_labelname"> <?=(isset($count_type))?item_status($count_type).'  de prendas':''?></h3>
                              </div>
                        </div>
                    </div>
                </div>

            
        </div>
    </div>     

 

  
    <div class="row mt-3">        
        <div class="col-xl-12"> 
            <div class="card">
                <form class="add-contact-form needs-validation configform" id="company_configform" novalidate>
                    <div class="card-header d-flex justify-content-between align-items-center"> 
                         

                <?php if($custom["page"] != "Count_type"){ ?>
                    <?php if(isset($info_visit)){ ?>
                    <h6>
                    <b><?=(isset($count_id))?'Conteo: #'.$count_id:''?> </b> <?=(isset($status_count))?item_status_title($status_count):''?>, 
                    <b>Visita:</b> #<?=$visit_id?>,
                    <b>Lugar:</b> <?=$info_visit["empresa"]?>, <?=$info_visit["sitio"]?>, <?=ucwords($info_visit["direccion"])?>, 
                    <b>Fecha:</b> <?=$info_visit["h_inicio"]?>, 
                    <b>Turno:</b> <?=ucwords(turno($info_visit["turno"]))?>
                    </h6>  
                    <?php } ?>
                <?php } ?>
                

                        <div class="align-self-center ml-auto text-center text-sm-right">  
                            <!-- <button type="button" class="btn btn-danger" onclick="acount_formtoggle()">Cancelar</button> -->
                             
                                <?php if(isset($step_t)): ?>
                                    <button type="button"  onclick="return_site('count')" class="btn btn-info">Regresar</button>
                                    <button type="button"  onclick="change_visit(3)" class="btn btn-success">Finalizar Visita</button>
                                    <button type="button"  onclick="change_visit(2)" class="btn btn-danger">Cancelar Visita</button>
                                <?php endif; ?>
 

                                <?php if(isset($count_type)): ?>
                                    <!-- Nuevo conteo-->
                                    <?php  if($count_type =='1'): ?>
                                            <button type="button"  onclick="return_site('<?=$visit_id?>')" class="btn btn-info">Regresar</button>
                                            <button type="button"  onclick="cancel_count('<?=$visit_id?>')" class="btn btn-danger">Cancelar Conteo</button>
                                            <button type="button"  onclick="end_count('<?=$visit_id?>')" class="btn btn-success">Terminar</button>
                                    <?php endif; ?>

                                    <!-- Empacar -->
                                    <?php  if($count_type =='2'): ?>
                                             <button type="button"  onclick="return_site('<?=$visit_id?>')" class="btn btn-info">Regresar</button>
                                             <button type="button"  onclick="end_count('<?=$visit_id?>')" class="btn btn-success">Terminar</button>
                                    <?php endif; ?>
                                    
                                    <!-- Consultar -->
                                    <?php  if($count_type =='3'): ?>             
                                        <button type="button"  onclick="return_site('<?=$visit_id?>')" class="btn btn-danger">Regresar</button>
                                    <?php endif; ?>

                                    <!-- Entregar -->
                                    <?php  if($count_type =='4'): ?> 
                                            <button type="button"  onclick="return_site('<?=$visit_id?>')" class="btn btn-danger">Regresar</button>
                                                <?php  if(isset($status_count) && $status_count < 4): ?> 
                                                    <button type="button"  onclick="end_count()'<?=$visit_id?>'" class="btn btn-success">Terminar</button>
                                                <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?> 
                        </div>
                    </div> 

                    <div class="card-body">
                        
                    <?php $this->load->view($include["body"]["step"]); ?>  
                                             
                    </div> 
                </form>
            </div>
        </div>   
    </div>
 


</div>






    </div>
</div> 

<script>
    function return_site(visit){
        if(visit == 'count'){
            location.href = '<?=base_url()?>/Counts/Count'; 
        }else{
            location.href = '<?=base_url()?>/Counts/Count/Count_type/'+visit; 
        }
        
    }



</script>