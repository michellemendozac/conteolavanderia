<div id="visit_primary_detail">

        <div class="profile-menu theme-background border  z-index-1 p-2">
            <div class="d-sm-flex">
                <div class="align-self-center">
                
                </div>
                <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                    <button type="button" class="btn btn-primary" onclick="activa_count_list()">Regresar</button>
                </div>
            </div> 
        </div>                      

        <div class="card-body">
                          
            <table class="table w-100">
                    <?php $cat_t = count($category_list);?>
                    <tr class="bg-primary text-white">          
                        <td align="center" colspan="<?=$cat_t?>"><h5>Total de piezas recibidas</h5></td> 
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
                
                
                <div class="table-responsive">
                    <table id="table_recep" class="display w-100 table dataTable table-striped table-bordered editable-table" style="width:100%">
                        <thead>
                            <tr class="bg-primary text-white">
                                <!-- <td>Id</td> -->
                                <td># Conteo</td>
                                <td>Prenda</td>
                                <td>Colaborador</td>
                                <td>Estatus</td>
                            </tr>  
                        </thead>
                        
                        <tbody>
                        <?php if(is_array($count_list)): ?>        
                        <?php foreach($count_list as $item_delivery): ?>  
                            <tr> 
                        <!--  <td>< ?=$item_delivery->id_ingreso?></td> -->
                            <td><?=$item_delivery->id_inventario?></td>
                            <td><?=$item_delivery->category_name." ".$item_delivery->color." ".ucwords($item_delivery->genero)?></td>
                            <td><?=ucwords($item_delivery->colaborador)?></td>
                            <td><?=item_status($item_delivery->estado)?></td>
                        <?php endforeach; endif; ?>   
                        </tbody>
                        
                    </table>
                </div>
                   
            
             



            
        </div>    




     

    </div> 
</div>

<script>
$(document).ready(function () { 
    $(document).ready( function () {

        $('#table_recep').DataTable({
                dom: 'Bfrtip', 
                            buttons: [
                                'copy', 'csv', 'excel', 'pdf', 'print'
                            ],                
                responsive: true
            }); 


    });
});

</script>
