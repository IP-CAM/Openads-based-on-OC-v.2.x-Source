<div  class="col-sm-12 clearfix">
<form method="post" class="form-horizontal" id="component-photo">
    <input type="hidden" name="entry_id" value="<?php echo $entry_id ?>">
    <input type="hidden" name="mode" value="photo">
    <div class="do-result">
        <?php if($locked){  ?>
        <div class="alert alert-warning">
            <i class="fa fa-exclamation-circle"></i> 
            <?php echo $text_lock ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php }?>
    </div>

    <?php if(!empty($operator)){ ?>
    <div class="form-group">
        <label class="col-sm-2 text-right"><?php echo $entry_artist ?></label>
        <div class="col-sm-10">
            <label class="label label-default"><?php echo $operator ?></label>
        </div>
    </div>
    <?php } ?>
    <div class="form-group">
        <label class="col-sm-2 text-right"><?php echo $entry_post_img ?></label>
        <div class="col-sm-10">
            <?php if(is_array($file)){ ?>
            <div class="uploads">
                <?php foreach ($file as $item): ?>
                <div class="text-center">
                    <?php if(!empty($item['realpath'])){ ?>
                    <a href="<?php echo $item['realpath'] ?>" class="fancy-img"><img src="<?php echo $item['image']; ?>"></a>
                    <span><a href="<?php echo $item['download'] ?>" target="_blank">Download</a></span>
                    <?php } else { ?>
                    <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>" filename="<?php echo $item['name'] ?>" filepath="<?php echo $item['path'] ?>">
                    <br>
                    <span><a href="<?php echo $item['download'] ?>" target="_blank">Download</a></span>
                    <?php }?>
                </div>
                <?php endforeach ?>
            </div>
            <?php }else{ ?>
            <label class="label label-default"><?php echo $text_empty;?></label>
            <?php } ?>
        </div>
    </div>

    <?php if($approve){ ?>
    <fieldset>
        <legend></legend>
        <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_status ?></label>
            <div class="col-sm-10">
                <?php foreach ($photo_statuses as $item): ?>
                <div class="<?php echo ($item['status_id'] == $rejected ) ? 'radio' : 'radio-inline' ?>">
                    <label>
                    <input type="radio" name="status" value="<?php echo $item['status_id'] ?>" <?php echo $status == $item['status_id'] ? 'checked' : '' ?> >
                        <?php echo $item['name'] ?>
                    </label>
                </div>
                <?php endforeach ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 text-right"><?php echo $entry_note ?></label>
            <div class="col-sm-10">
                <textarea name="note" class="form-control"><?php echo $note ?></textarea>
            </div>
        </div>
    </fieldset>

    <?php }?>

</form>
</div>
<script type="text/javascript"><!--
    $(function(){
        $('a.fancy-img').fancybox();
    });
    <?php if($approve || $relax){ ?>
    $('#component-detail').dialog('option', 'title', '<?php echo $heading_title ?>');
    $('#component-detail').dialog('option', 'buttons' ,
        {
            '<?php echo $button_close ?>':function(e){
                _component.update(
                    'index.php?route=service/advertise/relax&token=<?php echo $token;?>',
                    {mode:'photo',entry_id:'<?php echo $entry_id ?>',valid:1,relax:1},
                    false
                );
                $(this).dialog('close');
            }
        <?php if( $approve){ ?>
            ,
            '<?php echo $button_save ?>':function(dialogRef){
                _component.update(
                    'index.php?route=service/advertise/approve&token=<?php echo $token;?>',
                    $('#component-photo').serialize()
                );
            }
        <?php } ?>
        <?php if($relax){ ?>
            ,
            '<?php echo $button_relax ?>':function(dialogRef){
                _component.update(
                    'index.php?route=service/advertise/relax&token=<?php echo $token;?>',
                    {mode:'photo',entry_id:'<?php echo $entry_id ?>'}
                );
            }
        <?php }?>
    });
    <?php }?>
//-->
</script>
<style type="text/css">
    .form-group pre{height: 35px;}
</style>