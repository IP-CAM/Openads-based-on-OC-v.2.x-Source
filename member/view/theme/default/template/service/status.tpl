<form method="post" class="form-horizontal" id="component-status">
    <div class="do-result"></div>
    <div class="form-group clearfix">        
        <div class="col-sm-10 col-sm-offset-1">
            <?php if($ad_publish > $publish_deliveried){ ?>
            <?php foreach ($ad_publisheds as $item): ?>
                <?php if($ad_publish == $item['publish_id']){ ?>
                <?php echo sprintf(getBSTagStyle($item['publish_id']),$item['name']); ?>
                <?php }?>
            <?php endforeach ?>
            <?php }else{ ?>
            <div id="progress-publish" style="height:80px;" class="text-center"></div>
            <?php }?>
        </div>
    </div>
    <div class="form-group clearfix">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="well">
            <?php switch ($ad_publish) { 
                 case 1: ?>
                <p class="text-info">
                    <?php echo $text_publish_queue ?>
                    <?php if(empty($demotion)){ ?>
                    <a href="javascript:;" onclick="$('#queue-list').toggle();" class="pull-right"><?php echo $text_toggle_queue ?></a>
                    <?php }?>
                </p>
                <?php if(empty($demotion)){ ?>
                <div id="queue-list" style="display:none;"></div>
                <?php }else{ ?>
                <p class="text-warning"><?php echo $demotion ?></p>
                <?php }?>
                <?php break; ?>

                <?php case $publish_designing: ?>
                <p class="text-info"><?php echo $text_publish_designing ?></p>
                <?php break; ?>   

                <?php case $publish_waiting: ?>
                <p class="text-info"><?php echo $text_publish_waiting ?></p>
                <button type="button" class="btn btn-success" id="waiting-to-confirm"><?php echo $ad_button_confirm?></button>
                <?php break; ?>

                <?php case $publish_confirmed: ?>
                <p class="text-primary"><?php echo $text_publish_confirmed ?></p>
                <?php break; ?>  

                <?php case $publish_opening: ?>
                <p class="text-primary"><?php echo $text_publish_opening ?></p>
                <?php break; ?>  

                <?php case $publish_success: ?>
                <p class="text-success"><?php echo $text_publish_success ?></p>
                <?php break; ?> 

                <?php case $publish_deliveried: ?>
                <p class="text-success"><?php echo $text_publish_deliveried ?></p>
                <?php break; ?> 

                <?php case $publish_failed: ?>
                <p class="text-warning"><?php echo $text_publish_failed ?></p>
                <?php break; ?> 

                <?php case $publish_refunded: ?>
                <p class="text-warning"><?php echo $text_publish_refunded ?></p>
                <?php break; ?> 

            <?php } ?>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript"><!--
    $('#waiting-to-confirm').bind('click',function(){
        if(confirm('<?php echo $text_ad_confirm?>')){
            $.post(
                'index.php?route=service/advertise/waiting_to_confirm', 
                {ad:<?php echo $advertise_id ?>}, 
                function(data) {
                    if(data.status == 0){
                        $('#component-status .do-result').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + data.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }else{
                        $('#component-status .do-result').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>')
                        setTimeout('location.reload();',2000);
                    }
                }, 
            'json');
        }
    });
    $('#revoke-apply').bind('click',function(){
        if(confirm('<?php echo $confirm_revoke_apply ?>')){
            $.post('index.php?route=service/advertise/revoke',{ad:<?php echo $advertise_id ?>}, 
                function(data) {
                    if(data.status == 0){
                        $('#component-status .do-result').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + data.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }else{
                        $('#component-status .do-result').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + data.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>')
                        setTimeout('location.reload();',2000);
                    }
                }, 
            'json');
        }
    })
    $(function(){
        var $progressDiv = $("#progress-publish");
        var $progressBar = $progressDiv.progressStep();
        $progressBar.addStep('<?php echo $text_queue ?>');
        <?php $length = 0;foreach ($ad_publisheds as $item): ?>
        <?php if($item['publish_id'] <= $publish_deliveried ):?>
        $progressBar.addStep('<?php echo $item["name"] ?>');
        <?php $length++ ;endif ?>
        <?php endforeach ?>      
        $progressBar.setCurrentStep(<?php echo $ad_publish-1 ?>);
        $progressBar.refreshLayout();
        <?php if($ad_publish == 1) {?>
        reloadQueue(<?php echo $advertise_id ?>,<?php echo $ad_priority ?>);
        <?php }?>
    });
//--></script>
<style type="text/css">
    hr{margin:8px;}
</style>