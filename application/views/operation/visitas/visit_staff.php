
<div class="form-row">                         
    <div class="form-group col-md-12"> 
        <h6><b>Responsable de visita:</b> </h6>
        <select class="form-control select-form" name="resp_recp" id="resp_recp">
            <option value="0">Selecciona un responable </option>
            <?php foreach($staff_list as $staff): ?>
            <option value="<?=$staff->id?>"><?=$staff->nombre?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback" id="feedback-confuserrol"></div>
    </div>  
</div> 


<div class="form-row">                         
    <div class="form-group col-md-12"> 
        <h6><b>Responsable de recepción:</b> </h6>
        <select class="form-control select-form" name="resp_ent" id="resp_ent">
            <option value="0">Selecciona un responable </option>
            <?php foreach($staff_list as $staff): ?>
            <option value="<?=$staff->id?>"><?=$staff->nombre?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback" id="feedback-confuserrol"></div>
    </div>  
</div> 