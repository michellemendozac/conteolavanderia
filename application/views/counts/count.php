
   
   <?php $this->load->view('counts/check_code'); ?>     

    <table class="table w-100">
        <?php $cat_t = count($category_list);?>
        <tr class="bg-primary text-white">          
            <td align="center" colspan="<?=$cat_t?>"><h4>Piezas recibidas</h4></td> 
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
    
    <div style="position:relative;">
        <table class="table w-100" id="table_recep">
            <thead>
                <tr class="bg-primary text-white">
                    <!-- <td>Id</td> -->
                    <td># Conteo</td>
                    <td>Prenda</td>
                    <td>Colaborador</td>
                    <td>Estatus</td>
                </tr>  
            </thead>
              
            <tbody style=" overflow-y:scroll; height: 20px; ">
            <?php if(is_array($count_list)): ?>        
            <?php foreach($count_list as $item_delivery): ?>  
                <tr id="delivery_list_<?=$item_delivery->id_inventario?>" class="<?=($item_delivery->estado==$count_type)?'bg-success':''?>"> 
            <!--  <td>< ?=$item_delivery->id_ingreso?></td> -->
                <td><?=$item_delivery->id_inventario?></td>
                <td><?=$item_delivery->category_name." ".$item_delivery->color." ".ucwords($item_delivery->genero)?></td>
                <td><?=ucwords($item_delivery->colaborador)?></td>
                <td><?=item_status($item_delivery->estado)?></td>
            <?php endforeach; endif; ?>   
            </tbody>
            
        </table>
    </div>
     



    <script>
         
         var count_item = {};

        jQuery.ajax({
            type: "POST",
            data: {c:0},
            url: "<?=base_url()?>/Counts/Count/Category_items_pre",
            success: function (response) {                
                if(response){
                    $.each(response, function(i, item) {  
                        count_item['itemcategory_'+i] = item.total; 
                    });
                }                                 
            }
        });

        

        $('#code_id').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault();
                console.log("entro");
                jQuery.ajax({
                    type: "POST",
                    data: {code_id:$('#code_id').val(),count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>',site_id:'<?=$site_id?>'},
                    url: "<?=base_url()?>/Counts/Count/Add_item",
                    success: function (response) {
                         resp = (Array.isArray(response))?1:0;

                            if(resp==1){                                        
                                $.each(response, function(i, item) {                                                
                                    if (item.id_prenda != "") {  
                                        
                                        el = 'itemcategory_'+item.categoria;

                                        count_item[el] = (count_item[el]*1)+1;
                                        itemval = count_item[el];
                                        
                                        $('#itemcategory_'+item.categoria).html(itemval);   
                                        $('#label_category').html(item.category_name+' '+item.color+' '); 
                                        $('#label_code').html(item.id_code); 
                                        $('#label_colab').html(item.colaborador);  
                                         
                                        $("#code_id").val('');
                                        $("#code_id").focus();

                                        $('#delivery_list_'+item.id_code).addClass('bg-success');

                                        var ge = item.genero;

                                        var htmlTags = '<tr class="bg-success">'+
                                                '<td>' + item.id_code + '</td>'+
                                                '<td>' + item.category_name+' '+item.color+ ' ' + ge.charAt(0).toUpperCase() + ge.slice(1) +'</td>'+
                                                '<td>' + item.colaborador.toUpperCase() + '</td>'+
                                                '<td> Recepción </td>'+
                                            '</tr>';
                                            
                                        $('#table_recep tbody').append(htmlTags);

                                        
                                        //console.log(itemval);
                                    }  
                                });                       
                            }else{
                                $("#code_id").val('');
                                $("#code_id").focus();
                                alert(response);
                            }
                    }
                });
                return false;
            }
        });

        function end_count(){
            jQuery.ajax({
                    type: "POST",
                    data: {count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/End_step_reg",
                    success: function (response) {
                        if(response == '1'){ 
                            location.href = '<?=base_url()?>/Counts/Count/Count_type/<?=$visit_id?>'; 
                        }else{
                            alert(response);
                            $("#code_id").val('');
                            $("#code_id").focus();
                        }
                        
                             
                    }
                });
        }

        function cancel_count(){
                jQuery.ajax({
                    type: "POST",
                    data: {count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/Cancel_count",
                    success: function (response) {
                        if(response == '1'){ 
                            location.href = '<?=base_url()?>/Counts/Count/Count_type/<?=$visit_id?>'; 
                        }else{
                            alert(response);
                        }
                             
                    }
                });
        }

        $("#code_id").val('');
        $("#code_id").focus();
 // console.log(count_item);

    </script>