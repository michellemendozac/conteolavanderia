<div class="form-row">   
    <div class="form-group col-md-12">
        <p > <h3 style="text-align:center;">Escanea código</h3> </p> 
    </div>  
    <div class="form-group col-md-12">
        <input type="text"  autocomplete="off"  class="w-100" id="code_id">
    </div>                      
</div>

    <div id="info_employe"></div>

    <!-- colspan="3" -->
    <table class="table w-100">
        <tr class="location-map">
            <td align="center" class="bg-primary text-white" colspan="2"> FIla A </td>
            <td align="center" class="border-0"> &nbsp; </td>
            <td align="center" class="bg-primary text-white" colspan="2"> FIla B </td> 
            <td align="center" class="border-0"> &nbsp; </td>
            <td align="center" class="bg-primary text-white" colspan="2"> Fila C </td>
            <td align="center" class="border-0"> &nbsp; </td>
            <td align="center" class="bg-primary text-white" colspan="2"> Fila D </td>
        </tr>

        <tr class="location-map">
            <td align="center" class="bg-success text-white"> A1 </td>
            <td align="center" class="bg-success text-white"> A2 </td>
            
            <td align="center" class="border-0"> &nbsp; </td>

            <td align="center" class="bg-success text-white"> B1 </td>
            <td align="center" class="bg-success text-white"> B2 </td>

            <td align="center" class="border-0"> &nbsp; </td>

            <td align="center" class="bg-success text-white"> C1 </td>
            <td align="center" class="bg-success text-white"> C2 </td>

            <td align="center" class="border-0"> &nbsp; </td>

            <td align="center" class="bg-success text-white"> D1 </td>
            <td align="center" class="bg-success text-white"> D2 </td>
        </tr>

        <?php for($xv = 1; $xv <= 7; $xv++){ ?>
        <tr class="location-map">
            <td align="center" class="tab-consult tab-A1-<?=$xv?> bg-light"> <?=$xv?> </td>
            <td align="center" class="tab-consult tab-A2-<?=$xv?> bg-light"> <?=$xv?> </td>

            <td align="center" class="border-0"> &nbsp; </td>

            <td align="center" class="tab-consult tab-B1-<?=$xv?> bg-light"> <?=$xv?> </td> 
            <td align="center" class="tab-consult tab-B2-<?=$xv?> bg-light"> <?=$xv?> </td> 

            <td align="center" class="tab-consult border-0"> &nbsp; </td>

            <td align="center" class="tab-consult tab-C1-<?=$xv?> bg-light"> <?=$xv?> </td>
            <td align="center" class="tab-consult tab-C2-<?=$xv?> bg-light"> <?=$xv?> </td>

            <td align="center" class="border-0"> &nbsp; </td>

            <td align="center" class="tab-consult tab-D1-<?=$xv?> bg-light"> <?=$xv?> </td>
            <td align="center" class="tab-consult tab-D2-<?=$xv?> bg-light"> <?=$xv?> </td>
        </tr>
        <?php } ?>
         
        
    </table>
     
 
     

     

    <script> 
        

        $('#code_id').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault();
                console.log("entro");
                 
                jQuery.ajax({
                    type: "POST",
                    data: {code_id:$('#code_id').val(),count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/Consult_location",
                    success: function (response) { 
                            
                            $("#info_employe").html(response);
                            $("#code_id").val('');
                            $("#code_id").focus();
                            /* resp = (Array.isArray(response))?1:0;
                            if(resp==1){                                        
                                $.each(response, function(i, item) {                                                
                                    if (item.id_prenda != "") {  
                                        
                                        $("#code_id").val('');
                                        $("#code_id").focus();
                                        
                                        $('#label_category').html(item.category_name+' '+item.color+' '); 
                                        $('#label_code').html(item.id_code); 
                                        $('#label_colab').html(item.colaborador);  
                                    }  
                                });                       
                            }else{
                                alert(response);
                            }*/
                    }
                });
                return false;
            }
        });
 
        function end_count(){
            jQuery.ajax({
                    type: "POST",
                    data: {count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/End_step",
                    success: function (response) {
                        if(response == '1'){
                            location.href = '<?=base_url()?>/Counts/Count'; 
                        }else{
                            alert(response);
                        } 
                             
                    }
            });
        } 

        $("#code_id").val('');
        $("#code_id").focus();
    </script>