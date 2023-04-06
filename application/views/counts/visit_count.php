    <div class="form-row">
        <div class="form-group col-md-12">
            <label class="h4"> Visitas del <?=date('Y-m-d')?></label> 
        </div>                       
    </div>


    <table class="table">
        <tr class="bg-primary text-white">
            <td>#</td>
            <td>Lugar</td>
            <td>Turno</td>
            <td class="text-center">Comienzo</td>            
            <td>Recibe</td>
            <td>Estatus</td>
        </tr> 
        <?php if(is_array($visit_list)): ?>    
            <?php foreach($visit_list as $vlist):  $hinit = date_create($vlist->h_inicio);?> 
                <?php if($vlist->estado == 1){ ?>
                <tr onclick="location.href = '<?=base_url()?>/Counts/Count/Count_type/<?=$vlist->id_visita?>'">
                    <td><?=$vlist->id_visita?></td>
                    <td><?=$vlist->sitio?></td>
                    <td><?=turno($vlist->turno)?></td>
                    <td class="text-center"><?=date_format($hinit,'h:i ')?></td>                
                    <td><?=ucwords($vlist->atendio)?></td>
                    <td><?=visit_status($vlist->estado)?></td> 
                </tr>
                <?php } ?>  
            <?php endforeach; endif; ?>  
    </table>