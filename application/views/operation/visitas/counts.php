<div id="visit_primary_detail">

        <div class="profile-menu theme-background border  z-index-1 p-2">
            <div class="d-sm-flex">
                <div class="align-self-center">
                
                </div>
                <div class="align-self-center ml-auto text-center text-sm-right hidde-mobile">  
                    <button type="button" class="btn btn-primary" onclick="show_primary_list()">Regresar</button>
                </div>
            </div> 
        </div>                      

        <div class="card-body">
            <div class="form-row mt-4">   
                <div class="form-group col-md-12">
                    <h4 class="<?=visit_status_bg($info_visit["estado"])?>"> 
                    <span class="<?=visit_status_icon($info_visit["estado"])?>"></span> Visita <?=visit_status($info_visit["estado"])?></h4>
                    <h6><b>Visita:</b> #<?=$info_visit["id_visita"]?></h6>
                    <h6><b>Fecha:</b> <?=$info_visit["h_inicio"]?>  </h6>
                    <h6><b>Lugar:</b> <?=$info_visit["empresa"]?> <?=$info_visit["sitio"]?>, <?=ucwords($info_visit["direccion"])?> </h6>
                    <h6><b>Ubicación:</b> <?=ucwords($info_visit["ubicacion"])?>  </h6>
                    <h6><b>Inicio:</b> <?=$info_visit["h_inicio"]?></h6>
                    <h6><b>Turno:</b> <?=turno(ucwords($info_visit["turno"]))?></h6>
                    <h6><b>Responsable de visita: </b> <?=ucwords($info_visit["atendio"])?>  </h6>
                </div>   
                <div class="form-group col-md-12">
                    <p><?=$info_visit["comentarios"]?></p>
                </div>           
            </div>
                   
            
            <table class="table w-100  mt-4">
                    <tr class="bg-primary text-white">
                        <td>Conteo ID</td>                
                        <td>Pedido</td>
                        <td>Inicio</td>
                        <td>Estatus</td>
                    </tr>  
                    <?php if(is_array($count_list)): ?>        
                    <?php foreach($count_list as $item_delivery):  $hinit = date_create($item_delivery->h_reg); ?>  
                        <tr onclick="return_count('<?=$item_delivery->id_conteo?>','<?=$visit_id?>')"> 
                        <td><?=$item_delivery->id_conteo?></td>                
                        <td><?=($item_delivery->id_wd != "")?strtoupper($item_delivery->id_wd):"Sin pedido asignado"?></td>
                        <td><?=date_format($hinit,'y-m-d h:i ')?></td>
                        <td><?=item_status_title($item_delivery->estado)?></td>
                    <?php endforeach; endif; ?> 
            </table>



            
        </div>    




     

    </div> 
</div>
