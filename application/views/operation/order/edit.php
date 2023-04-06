<!-- START: Card Data-->
<div class="row mt-3">        
    <div class="col-xl-12">
        <div class="card">
            <form method="POST" id="visit_update_form">
                <input type="hidden" name="id_order" value="<?=$order_info["id_pedido"]?>">
                <div class="card-header d-flex justify-content-between align-items-center">                                
                    <h4 class="card-title">&nbsp;</h4>
                    <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                        <button type="button" class="btn btn-danger reset_form" data-reset="reset_user" onclick="close_sidebar()">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="update_order()">Actualizar pedido</button>
                    </div>
                </div>
                
                
            

                <div class="card-body">    

                <?php //print_array($order_info); ?>

                <div class="form-row">                         
                    <div class="form-group col-md-12"> 
                        <h6><b>Estatus de pedido:</b> </h6>
                        <select class="form-control select-form" name="status_order" id="status_order">
                            <option <?=(isset($order_info["estado"]) && $order_info["estado"] == 1)?'selected':''?> value="1">Activo </option>
                            <option <?=(isset($order_info["estado"]) && $order_info["estado"] == 2)?'selected':''?> value="2">Cancelado </option>
                            <option <?=(isset($order_info["estado"]) && $order_info["estado"] == 3)?'selected':''?> value="3">Terminado </option>
                                
                        </select>
                        <div class="invalid-feedback" id="feedback-confuserrol"></div>
                    </div>  
                </div>

                <div class="form-row">                         
                    <div class="form-group col-md-12">
                            <h6><b>WD order:</b></h6>
                            <input type="text" class="form-control" value="<?=$order_info["id_wd"]?>" name="wd_order"/>
                    </div> 
                </div> 

                <div class="form-row">                         
                    <div class="form-group col-md-12">
                            <h6><b>Factura:</b></h6>
                            <input type="text" class="form-control" value="<?=$order_info["factura"]?>" name="invoice_order"/>
                    </div> 
                </div> 


                <?php if(is_array($visit_list) > 0): ?>
                    <label class="form-check-label" for="flexCheckChecked"> Asignar la visita o visitas donde se entregará el pedido. </label>
                    <?php foreach($visit_list as $visit): $select = ""; ?>

                        <?php  if(is_array($visitorder_list) > 0): foreach($visitorder_list as $vord):  if($vord->id_visita == $visit->id_visita){ $select = "checked"; } endforeach; endif; ?>

                        <div class="form-check">
                            
                                <input class="form-check-input" type="checkbox" name="visit_list[<?=$visit->id_visita?>]" value="1"  <?=$select?>  id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    <?=$visit->id_visita?>: <?=$visit->sitio?> - <?=$visit->h_inicio?>
                                </label>
                        
                        </div>
                        <?php endforeach; ?>
                <?php else: ?> 
                        <label class="form-check-label" for="flexCheckChecked"> Sin visitas programadas para entregar, favor de programar ua visita para entregar este pedido. </label>
                <?php endif; ?> 
                </div>
                 
            </form>    
        </div>
    </div>  
</div> 

<script>

function update_order(){    
    jQuery.ajax({
        type: "POST",
        data: $("#visit_update_form").serialize(),
        url: "<?=base_url()?>/Operation/Order/update_order",
        success: function (response) {           
            close_sidebar();
            location.reload();
        }
    });
}


</script>


