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
                    <h6><b>Visita:</b> #<?=$info_visit["id_visita"]?>, <?=visit_status($info_visit["estado"])?></h6>
                    <h6><b>Fecha:</b> <?=$info_visit["h_inicio"]?>  </h6>
                    <h6><b>Lugar:</b> <?=$info_visit["empresa"]?> <?=$info_visit["sitio"]?>, <?=ucwords($info_visit["direccion"])?> </h6>
                    <h6><b>Ubicación:</b> <?=ucwords($info_visit["ubicacion"])?>  </h6>
                    <h6><b>Inicio:</b> <?=$info_visit["h_inicio"]?></h6>
                    <h6><b>Turno:</b> <?=turno(ucwords($info_visit["turno"]))?></h6>
                    <h6><b>Responsable de visita: </b> <?=ucwords($info_visit["atendio"])?>  </h6>
                </div>      
            </div>
                   
            
            


            <table class="table w-100  mt-4">
                    <tr class="bg-primary text-white">
                        <td>Cantidad</td>    
                        <td>Descripción</td>  
                        <td>Precio</td>
                        <td>Total</td>
                    </tr>  
                    <?php $totalt = 0; $pz = 0; 
                        if(is_array($item_order)): ?>        
                    <?php foreach($item_order as $item_delivery):    ?>  
                        <tr> 
                            <td><?=$item_delivery->cantidad?></td>                
                            <td><?=$item_delivery->nombre?></td>
                            <td>$<?=$item_delivery->precio?> MXN</td>
                            <td><?=$item_delivery->total?></td>
                        </tr>
                    <?php   $totalt = $totalt+$item_delivery->total;
                            $pz = $pz + $item_delivery->cantidad;
                            endforeach; endif; ?> 
                    <tr class="bg-primary text-white"> 
                            <td><h5><?=$pz?> PZ</h5></td>                
                            <td>&nbsp;</td>      
                            <td>&nbsp;</td>      
                            <td><h5>$<?=$totalt?>MXN</h5></td>
                        </tr>
            </table>



            
        </div>    




     

    </div> 
</div>
