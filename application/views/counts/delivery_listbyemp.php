<?php if(isset($list_emp)): ?>
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
        <tr class="bg-info text-white">
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
<?php  endif; ?> 

<table class="table w-100">
    <tr class="bg-primary text-white">          
        <td align="center" colspan="3"><h4>Piezas recibidas</h4></td> 
    </tr>
    <tr>
        <?php foreach($category_list as $category): ?>   
            <td align="center"><h4><?=$category->categoria?></h4></td> 
        <?php endforeach; ?> 
    </tr>  
    <tr>
        <?php foreach($category_list as $category): $x = $category->id_categoria; ?>               
            <td align="center"><h4 id="itemcategory_<?=$category->id_categoria?>"><?=$categoryes_list[$x]["total"]?></h4></td>
        <?php endforeach; ?>    
    </tr>   
</table>

<table class="table w-100">    
    <tr class="bg-primary text-white">          
        <td align="center" colspan="3"><h4>Piezas contadas</h4></td> 
    </tr>
    <tr>
        <?php foreach($category_list as $category): ?>   
            <td align="center"><h4><?=$category->categoria?></h4></td> 
        <?php endforeach; ?> 
    </tr>  
    <tr>
        <?php foreach($category_list as $category): $x = $category->id_categoria; ?>
            <td align="center"><h4 id="itemcategory_add_<?=$category->id_categoria?>"><?=$categoryes_list_check[$x]["total"]?></h4></td>
        <?php endforeach; ?>    
    </tr>   
</table>

<table class="table w-100">
    <tr class="bg-primary text-white">
         <td>Código</td>
        <td>Prenda</td>
        <td>Colaborador</td>
        <td>Estatus</td>
    </tr>  
    <?php if(is_array($count_list)): ?>        
    <?php 
        foreach($count_list as $item_delivery):  
    ?>  
        <tr id="delivery_list_<?=$item_delivery->id_inventario?>" class="<?php if($item_delivery->estado==$count_type): echo "bg-success text-white"; else: echo ""; endif; ?>"> 
        <td><?=$item_delivery->id_inventario?></td>
        <td><?=$item_delivery->category_name." ".$item_delivery->color." ".ucwords($item_delivery->genero)?></td>
        <td><?=ucwords($item_delivery->colaborador)?> </td>
        <td><?=item_status($item_delivery->estado)?></td>
    <?php endforeach; endif; ?> 
</table> 


 
<script> 
    $("#code_id").val('');
    $("#code_id").focus(); 
    
 
    $('#label-error-check').html('<?=$error_info?>');
</script>    
 