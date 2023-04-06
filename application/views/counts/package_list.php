 
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


<?php if(isset($item_data)):?>
<script> 
    $("#code_id").val('');
    $("#code_id").focus(); 
    
    $('#label_category').html('<?=$item_data[0]->category_name?>'+' '+'<?=$item_data[0]->color?>'+' '+'<?=strtoupper($item_data[0]->genero)?>'); 
    $('#label_code').html('<?=$item_data[0]->id_code?>'); 
    $('#label_colab').html('<?=ucwords($item_data[0]->colaborador)?>');
    $('#label-error-check').html('<?=$error_info?>');
</script>
<?php else: ?>
<script> 
    $("#code_id").val('');
    $("#code_id").focus(); 
    
    $('#label_category').html('<?=$item_data_error["category_name"]?>'+' '+'<?=$item_data_error["color"]?>'+' '+'<?=strtoupper($item_data_error["genero"])?>'); 
    $('#label_code').html('<?=$item_data_error["id_code"]?>'); 
    $('#label_colab').html('<?=ucwords($item_data_error["colaborador"])?>');
    $('#label-error-check').html('<?=$error_info?>');
</script>    
<?php endif; ?>