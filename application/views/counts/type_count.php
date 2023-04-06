<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
        <h6>    Información </h6>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
        <h6>Opciones</h6>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">
        <h6>Conteos</h6>            
    </a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <!-- Start information -->
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="form-row mt-4">   
            <div class="form-group col-md-12">
                <h4 class="<?=visit_status_bg($info_visit["estado"])?>"> 
                <span class="<?=visit_status_icon($info_visit["estado"])?>"></span> Visita <?=visit_status($info_visit["estado"])?></h4>
                <h6><b>Visita:</b> #<?=$info_visit["id_visita"]?></h6>
                <h6><b>Fecha:</b> <?=$info_visit["h_inicio"]?>  </h6>
                <h6><b>Lugar:</b> <?=$info_visit["empresa"]?> <?=$info_visit["sitio"]?>, <?=ucwords($info_visit["direccion"])?> </h6>
                <h6><b>Ubicación:</b> <?=ucwords($info_visit["ubicacion"])?>  </h6>
                <h6><b>Inicio:</b> <?=$info_visit["h_inicio"]?></h6>
                <h6><b>Turno:</b> <?= turno(ucwords($info_visit["turno"]))?></h6>
                <h6><b>Responsable de visita: </b> <?=ucwords($info_visit["atendio"])?>  </h6>
            </div>   
            <div class="form-group col-md-12">
                <textarea class="form-control" id="coment_visit"><?=$info_visit["comentarios"]?></textarea>
            </div>           
        </div>
  </div>
  <!-- end information -->
  <!-- Start options -->
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <table class="table mt-4">
        <tr>
            <td align="center" class="bg-primary text-white"> <h4> Recolección</h4> </td>            
        </tr>  
        <tr>
            <td align="center"  onclick="Count_type(1)"> <h4 style="cursor: pointer;"> Nuevo conteo</h4> </td>
        </tr>         
        <tr>
            <td align="center" class="bg-primary text-white"> <h4> Entrega </h4> </td>
        </tr> 
        <tr>
            <td align="center"> 
                <button type="button" onclick="set_ordervalue(3)" class="btn btn-link text-dark" style="font-size: x-large; text-decoration: none;" data-toggle="modal" data-target="#exampleModalCenter">
                    Consultar
                </button>
            </td>
        </tr>
        <tr>
            <td align="center"> 
                <button type="button" onclick="set_ordervalue(4)" class="btn btn-link text-dark" style="font-size: x-large; text-decoration: none;" data-toggle="modal" data-target="#exampleModalCenter">
                    Entrega
                </button>
            </td> 
        </tr> 
    </table> 
  </div>
  <!-- End operation -->
  <!-- Start Conteos -->
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
         <table class="table w-100  mt-4">
            <tr class="bg-primary text-white">
                <td>Conteo ID</td>                
                <td>Pedido</td>
                <td>Inicio</td>
                <td>Estatus</td>
            </tr>  
            <?php if(is_array($count_list)): ?>        
            <?php foreach($count_list as $item_delivery):  $hinit = date_create($item_delivery->h_reg); ?>  
                <tr onclick="return_count('<?=$item_delivery->id_conteo?>','<?=$item_delivery->estado?>')"> 
                <td><?=$item_delivery->id_conteo?></td>                
                <td><?=($item_delivery->id_wd != "")?strtoupper($item_delivery->id_wd):"Sin pedido asignado"?></td>
                <td><?=date_format($hinit,'y-m-d h:i ')?></td>
                <td><?=item_status_title($item_delivery->estado)?></td>
            <?php endforeach; endif; ?> 
        </table>
  </div>
  <!-- End Conteos -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ID Pedido</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            
            <div class="form-group col-md-12 text-info text-center">
                <h6>Ingresa el número de pedido para continuar o comienza un nuevo conteo.</h6>
            </div>

            <div class="form-group col-md-12 text-center">
                <input type="hidden" id="item_count_type" value="0">
                <h4>ID Pedido </h4>
                <input type="text" class="w-100" autocomplete="off" id="item_orderid">
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

   <!-- <div class="form-row">   
        <div class="form-group col-md-12 text-danger text-center">
            <h6>Ingresa el número de pedido en las cajas de texto para continuar o comienza un nuevo conteo</h6>
        </div>             
    </div> -->
    <!--  <td align="center"> <h4> Empacado </h4>  <label class="text-center">Pedido ID</label> </td> 
    <td align="center"> <h4> <input type="text" data-checktype="3" class="w-100 order_check" id="order_id_emp"> </h4> </td>
            <td align="center"> <h4> <input type="text" data-checktype="4" class="w-100 order_check" id="order_id_uni"> </h4> </td>
<tr>            
            <td align="center"> <h4> <input type="text" data-checktype="2" class="w-100 order_check" id="order_id_ord"> </h4> </td>
        </tr>
-->

 
 
    <script> 
 
        function change_visit(t,visit){
            jQuery.ajax({
                type: "POST",
                data: {change_type:t,visit_id:'<?=$visit_id?>'},
                url: "<?=base_url()?>/Counts/Count/change_visit",
                success: function (response) {
                   // location.href = '<?=base_url()?>/Counts/Count';                      
                }
            }); 
        } 
         
        function set_ordervalue(t){
            $("#item_count_type").val(t);              
        }


        function return_count(id,estatus){
            if(estatus == '0'){
                location.href = '<?=base_url()?>/Counts/Count/Item_count/<?=$visit_id?>/1/'+id; 
            }else{
                if(estatus == 'x'){
                    alert("Este conteo está cancelado");
                }else{
                alert("Este conteo ya finalizó.");
                }
            }        
        }
         

        function Count_type(type){
            jQuery.ajax({
                type: "POST",
                data: {count_type:type,visit_id:'<?=$visit_id?>'},
                url: "<?=base_url()?>/Counts/Count/New_Count/",
                success: function (response) {
                     location.href = '<?=base_url()?>/Counts/Count/Item_count/<?=$visit_id?>/'+type+'/'+response;                     
                }
            }); 
        } 

        
        $('#coment_visit').blur(function(e) { 
                jQuery.ajax({
                    type: "POST",
                    data: {coment:$(this).val(),visit_id:'<?=$visit_id?>'},
                    url:  "<?=base_url()?>/Counts/Count/Add_coment",
                    success: function (response) {
                        if(response != '1'){
                            alert(response);
                        }
                    }
                });  
        });

        $('#item_orderid').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault(); 
                var typecount = $("#item_count_type").val();
                jQuery.ajax({
                    type: "POST",
                    data: {order_id:$(this).val()},
                    url:  "<?=base_url()?>/Counts/Count/Delivery/"+typecount,
                    success: function (response) {
                        if(response == '1'){
                            $(".modal-body").html("El pedido no se encuentra registrado, favor de ingresar pedido valido."); 
                            setTimeout('document.location.reload()',2500);                           
                        }                        
                        else {  
                            if(response == '2'){
                                $(".modal-body").html("El pedido se encuentra en proceso, favor de consultar más tarde."); 
                                setTimeout('document.location.reload()',2500); 
                            }else{                                 
                                location.href = '<?=base_url()?>/Counts/Count/Delivery_list/<?=$visit_id?>/'+response+'/'+typecount;                                                                
                            } 
                        }
                    }
                }); 
                return false;
            }
        });

        $("#exampleModalCenter").on("show.bs.modall", function (event) {                        
            $('.modal-body #item_orderid').val("");
            $('.modal-body #item_orderid').focus();
            console.log("abierto modal");
        });

     </script>                
                