    <?php $this->load->view('counts/check_code'); ?>   
    <div id="package_list_div">
        <?php $this->load->view('counts/package_list'); ?>  
    </div>
 
    <script> 

        $('#code_id').keypress(function(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {               
                e.preventDefault();
                jQuery.ajax({
                    type: "POST",
                    data: {code_id:$('#code_id').val(), count_type:'<?=$count_type?>', visit_id:'<?=$visit_id?>',count_id:'<?=$count_id?>'},
                    url: "<?=base_url()?>/Counts/Count/Deliver_item",
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
                    url: "<?=base_url()?>/Counts/Count/End_step",
                    success: function (response) {
                        if(response == '1'){
                            location.href = '<?=base_url()?>/Counts/Count/Order_Package'; 
                        }else{
                            alert(response);
                            $("#code_id").val('');
                            $("#code_id").focus();
                        }  
                    }
                });
        }
       

        $("#code_id").val('');
        $("#code_id").focus();

    </script>