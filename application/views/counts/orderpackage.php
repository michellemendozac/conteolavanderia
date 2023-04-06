    <div class="form-row">   
        <div class="form-group col-md-12 text-danger text-center">
            <h6>Ingresa el número de pedido en las cajas de texto para continuar o comienza un nuevo conteo</h6>
        </div>

        <div class="form-group col-md-12 text-center">
            <h4> Empacado </h4>  
            <label class="text-center">Pedido ID</label>
            <input type="text" data-checktype="2" class="w-100 order_check" id="order_id_ord">
        </div>   

    </div> 
 
 
    <script>  

        $('.order_check').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault(); 
                var typecount = $(this).data("checktype");
                jQuery.ajax({
                    type: "POST",
                    data: {order_id:$(this).val()},
                    url:  "<?=base_url()?>/Counts/Count/Package_Orger/"+typecount,
                    success: function (response) {
                        if(response == '1'){
                            alert("El pedido no se encuentra registrado, favor de ingresar pedido valido."); 
                        }                        
                        else {  
                            if(response == '2'){
                               alert("El pedido ya avanzó por este proceso, favor de consultar más tarde."); 
                                
                            }else{                                 
                                location.href = '<?=base_url()?>/Counts/Count/Delivery_list/<?=$visit_id?>/'+response+'/'+typecount;                                                                
                            } 
                        }
                    }
                }); 
                return false;
            }
        });

        $("#order_id_ord").val('');
        $("#order_id_ord").focus(); 

     </script>