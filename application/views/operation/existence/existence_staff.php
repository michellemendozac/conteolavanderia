
 
<div class="form-row">                         
    <div class="form-group col-md-12"> 
        <h6><b>Colaborador:</b> </h6>
        <select class="form-control select-form" name="item_colab" id="item_colab">
            <option value="0">Selecciona un colaborador </option>
            <?php foreach($employe_list as $employe): ?>
            <option value="<?=$employe->id_colaborador?>"><?=ucfirst($employe->nombre)." ".$employe->company_code." ".$employe->sitio?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback" id="feedback-confuserrol"></div>
    </div>  
</div> 