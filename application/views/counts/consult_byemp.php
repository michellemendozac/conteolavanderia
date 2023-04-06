<?php $location_tab = 0; if(is_array($list_emp)): ?>        
    <?php $location_tab = $list_emp[0]->columna.$list_emp[0]->fila.'-'.$list_emp[0]->ubicacion; ?>
         <div class="form-row text-danger">
            <div class="form-group col-md-12  col-sm-12 text-center m-0">
                   <h3 class="m-0"> Ubicación: <label id="label_code"><?=$location_tab?></label> </h3>
            </div>  
            <div class="form-group col-md-12 col-sm-12  text-center">
                <h5 class="m-0">  <?=ucwords($list_emp[0]->colaborador)?>  </h5>
            </div>                      
        </div>
<?php  endif; ?> 

<?php if(is_array($list_emp)): ?>
<table class="table w-100">
    <tr class="bg-primary text-white">
        <td class="text-center">Código</td>
        <td class="text-center">Prenda</td>
    </tr>              
    <?php foreach($list_emp as $item_delivery): ?>  
        <tr id="delivery_list_<?=$item_delivery->id_inventario?>"> 
        <td class="text-center"><?=$item_delivery->id_inventario?></td>
        <td class="text-center"><?=$item_delivery->category_name." ".$item_delivery->color." ".strtoupper($item_delivery->genero)?></td>
    <?php endforeach; ?> 
</table>
<?php else: ?> 
    <div class="form-row text-danger">
        <div class="form-group col-md-12  col-sm-12 text-center">
                <h3 class="m-0"> Lo sentimos, este colaborador, no cuenta con prendas en este pedido </h3>
        </div>                        
    </div>
<?php  endif; ?> 
    
<script>
    $(".tab-consult").removeClass('bg-warning');
    $(".tab-<?=$location_tab?>").addClass('bg-warning');
</script>