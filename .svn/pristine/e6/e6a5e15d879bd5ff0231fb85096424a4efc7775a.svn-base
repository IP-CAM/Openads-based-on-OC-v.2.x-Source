<div  class="col-sm-12 clearfix">
    <form method="post" class="form-horizontal" id="transfer-form">
        <input type="hidden" name="entry_id" value="<?php echo $entry_id ?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <div class="do-result">
            <?php if($locked){  ?>
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-circle"></i>
                <?php echo $text_lock ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
            <?php }?>
            <?php if($reset) { ?>
            <div class="alert alert-warning"> <?php echo $text_reset?> </div>
            <?php } ?>
        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_operator ?></label>
            <div class="col-sm-9">
                <select name="operator" class="form-control" <?php echo ($reset || $relax) ? 'disabled' : '' ?>>
                    <option value="0"><?php echo $text_none;?></option>
                    <?php foreach ($operators as $item): ?>
                    <option value="<?php echo $item['user_id'] ?>" <?php echo $user_id == $item['user_id'] ? 'selected' : ''?>>
                    <?php echo $item['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo $entry_note ?></label>
            <div class="col-sm-9">
                <textarea name="note" class="form-control" <?php echo ($reset || $relax) ? 'disabled' : '' ?>><?php echo $note ?></textarea>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#component-detail').dialog('option', 'title', '<?php echo $heading_title ?>');
    $('#component-detail').dialog('option', 'buttons' ,
        {
            <?php if($transfer){ ?>
            '<?php echo $button_transfer ?>' : function(e){
                if($('select[name="operator"]').val()>0) {
                    _component.update(
                        'index.php?route=service/advertise_transfer/transfer&token=<?php echo $token?>',
                        $('#transfer-form').serialize()
                    );
                }else{
                    $('#transfer-form .do-result').html('<div class="alert alert-warning"><?php echo $error_operator;?></div>');
                }
            }
            ,
            <?php } ?>

            <?php if($reset){ ?>
            '<?php echo $button_reset ?>':function(e){
                _component.update(
                    'index.php?route=service/advertise_transfer/reset&token=<?php echo $token?>',
                    {mode:'<?php echo $mode;?>',entry_id:'<?php echo $entry_id ?>'}
                );
            }
            ,
            <?php } ?>

            <?php if($relax){ ?>
            '<?php echo $button_relax ?>':function(e){
                _component.update(
                    'index.php?route=service/advertise_transfer/relax&token=<?php echo $token?>',
                    {mode:'<?php echo $mode;?>',entry_id:'<?php echo $entry_id ?>'}
                );
            }
            ,
            <?php }?>
            '<?php echo $button_close ?>' : function(e){
                _component.update(
                    'index.php?route=service/advertise_transfer/relax&token=<?php echo $token?>',
                    {mode:'<?php echo $mode;?>',entry_id:'<?php echo $entry_id ?>',valid:1,reset:1},
                    false
                );
                $(this).dialog('close');
            }
        }
    );
</script>
