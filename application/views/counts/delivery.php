    <div class="form-row">
        <div class="form-group col-md-12">
            <p > <h3 style="text-align:center;">Escanea código </h3> </p> 
        </div>   
        <div class="form-group col-md-12">
            <input type="text" autocomplete="off" class="w-100" id="code_id">
        </div>                      
    </div>

    <div class="form-row text-danger">
        <div class="form-group col-md-12  col-sm-12 text-center">
            <div id="label-error-check" class=" h4 text-danger"></div>
        </div>                     
    </div> 
    
    <div id="package_list_div">
        <?php $this->load->view('counts/delivery_listbyemp'); ?>  
    </div>

    <script> 

        $('#code_id').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault();
                jQuery.ajax({
                    type: "POST",
                    data: {code_id:$('#code_id').val(),count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/Deliver_item_by_emp",
                    success: function (response) {
                            $("#package_list_div").html(response);
                            $("#code_id").val('');
                            $("#code_id").focus(); 
                    }
                });
                return false;
            }
        });
 
        function end_count(){ 
            jQuery.ajax({
                    type: "POST",
                    data: {count_type:'<?=$count_type?>',visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/End_order",
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