<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:window.history.go(-1);" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_back; ?></a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a>
                    </li>
                    <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
                    <li><a href="#tab-tracking" data-toggle="tab"><?php echo $tab_tracking; ?></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-general">
                        <div class="col-sm-5">
                            <fieldset>
                                <legend><?php echo $tab_advertise.' '.$advertise_sn; ?></legend>

                                <div class="form-group clearfix hidden">
                                    <label class="col-sm-3 text-right"><?php echo $entry_product; ?></label>
                                    <div class="col-sm-9"><?php echo $product; ?></div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 text-right"><?php echo $entry_customer; ?></label>
                                    <div class="col-sm-9"><label class="label label-default"><?php echo $customer; ?></label></div>
                                </div>
                                <div class="form-group clearfix hidden">
                                    <label class="col-sm-3 text-right"><?php echo $entry_website; ?></label>
                                    <div class="col-sm-9"><pre><?php echo $website; ?></pre></div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 text-right"><?php echo $entry_in_charge; ?></label>
                                    <div class="col-sm-9"><label class="label label-default"><?php echo $charger; ?></label></div>
                                </div>
                                <?php if(!empty($note)){ ?>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 text-right" ><?php echo $entry_note; ?></label>
                                    <div class="col-sm-10"><pre id="ad-note"><?php echo $note; ?></pre></div>
                                </div>
                                <?php } ?>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 text-right"><?php echo $entry_ad_account ?></label>
                                    <div class="col-sm-9">
                                        <?php if ($is_publisher || $is_promoter){ ?>
                                        <div class="form-inline" id="account-form">
                                            <input type="text" class="form-control" id="ad-account" value="<?php echo $ad_account;?>" name="ad_account" data-toggle="tooltip" title="<?php echo $entry_ad_account ?>"  placeholder="<?php echo $entry_ad_account ?>" style="width: 150px">
                                            <input type="text" class="form-control" id="ad-progress" value="<?php echo $progress;?>" name="progress" data-toggle="tooltip" title="<?php echo $entry_progress;?>"  placeholder="<?php echo $entry_progress;?>" style="width: 50px">
                                            <button type="button" id="a_ad_account" class="btn btn-primary"><i class="fa fa-save"> <?php echo $button_save;?></i></button>
                                            <input type="hidden" name="advertise_id" value="<?php echo $advertise_id?>" />
                                            <input type="hidden" name="publish" value="<?php echo $publish?>" />
                                        </div>
                                        <?php }else{ ?>
                                        <label class="label label-default" data-toggle="tooltip" title="<?php echo $entry_ad_account ?>"><?php echo $ad_account;?></label>
                                        <label class="label label-default" data-toggle="tooltip" title="<?php echo $entry_progress;?>"><?php echo $progress;?></label>
                                        <?php }?>
                                    </div>
                                </div>
                                <?php if ($is_publisher){ ?>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label text-right" for="input-publish"><?php echo $entry_publish; ?></label>
                                    <div class="col-sm-9">
                                        <select name="publish" class="form-control" id="input-publish">
                                            <?php foreach ($ad_publishes as $item) { ?>
                                            <?php if ($item['publish_id'] == $publish) { ?>
                                            <option value="<?php echo $item['publish_id']; ?>" selected="selected">
                                                <?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                            <?php } else { ?>
                                            <option value="<?php echo $item['publish_id']; ?>">
                                                <?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix none">
                                    <label class="col-sm-3 control-label text-right" for="input-amount"><?php echo $entry_amount; ?> </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="amount"  class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group clearfix hidden">
                                    <label class="col-sm-3 control-label  text-right" for="input-notify"><?php echo $entry_notify; ?> </label>
                                    <div class="col-sm-9">
                                        &nbsp;
                                        <input type="checkbox" name="notify" checked value="1" id="input-notify" />
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <label class="col-sm-3 control-label text-right" for="input-note"><?php echo $entry_note; ?></label>
                                    <div class="col-sm-9">
                                        <textarea name="note" id="input-note" placeholder="<?php echo $entry_note; ?>" data-toggle="tooltip" title="<?php echo $entry_note; ?>" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-9 col-sm-offset-3">
                                        <button id="button-history" class="btn btn-primary"><?php echo $button_history_add; ?></button>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="form-group clearfix">
                                    <label class="col-sm-2 text-right"><?php echo $entry_publish; ?></label>
                                    <div class="col-sm-10"><span id="ad-publish"><?php echo $publish_text?></span></div>
                                </div>

                                <?php } ?>
                            </fieldset>
                        </div>
                        <div class="col-sm-7">
                            <fieldset>
                                <legend><?php echo $tab_targeting; ?></legend>
                                <div id="tab-targeting"><?php echo $targeting_tpl ?></div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $tab_post; ?></legend>
                                <div id="tab-post"><?php echo $post_tpl ?></div>
                            </fieldset>
                            <fieldset>
                                <legend><?php echo $tab_photo; ?></legend>
                                <div id="tab-photo"><?php echo $photo_tpl ?></div>
                            </fieldset>
                        </div>

                    </div>
                    <div class="tab-pane" id="tab-history">
                        <div id="history"></div>
                    </div>
                    <div class="tab-pane" id="tab-tracking">
                        <div id="timeline" style="background: rgba(0, 0, 0, 0.05);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($advertise_id){ ?>
<script type="text/javascript"><!--

$('select[name="publish"]').bind('change',function(){
    $('input[name="amount"]').parent().parent('.form-group').toggle($('select[name="publish"]').val() == <?php echo $publish_terminal ?>);
});
$('select[name="publish"]').trigger('change');
$('#history').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();
    $('#history').load(this.href);
});

$('#history').load('index.php?route=service/publish/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>');

$('#button-history').on('click', function() {
    if($('select[name="publish"]').val() == <?php echo $publish_indesign ?>){
        if(confirm('退回到设计中，将会把广告文本和图片的状态修改为已拒绝，确认修改吗？')){

        }else{
            return false;
        }
    }
    $.ajax({
        url: 'index.php?route=service/publish/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>',
        type: 'post',
        dataType: 'json',
        data: 'publish=' + encodeURIComponent($('select[name=\'publish\']').val()) + '&advertise_sn='+<?php echo $advertise_sn; ?> + '&customer_id='+<?php echo $customer_id; ?> + '&amount=' + ($('input[name=\'amount\']').val()) + '&notify=' + ($('input[name=\'notify\']').prop('checked') ? 1 : 0)  + '&note=' + encodeURIComponent($('textarea[name=\'note\']').val()),
        beforeSend: function() { $('#button-history').button('loading'); },
        complete: function() { $('#button-history').button('reset'); },
        success: function(json) {
            $('.alert').remove();
            if (json['error']) {
                $('#history').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            }
            if (json['success']) {
                $('#history').load('index.php?route=service/publish/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>');
                $('#tab-general').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                $('#ad-note').html($('input[name=\'note\']').val());
                $('input[name=\'note\']').val('');
                //$('#ad-publish').html('<label class="label label-default">'+$('select[name=\'publish\'] option:selected').text()+'</label>');
            }
            return false;
        }
    });
});
//--></script> 
<?php }?>
<script type="text/javascript"><!--
$('.date').datetimepicker({
    pickTime: false
});

$('#timeline').load('index.php?route=service/publish/tracking&token=<?php echo $token ?>',{advertise_id:'<?php echo $advertise_id; ?>'});

$('#a_ad_account').on('click', function() {
	if(confirm("你确定要修改Ad Account?")){
        $.ajax({
             url: 'index.php?route=service/publish/edit_ad_account&token=<?php echo $token; ?>',
             type: 'post',
             data:$('#account-form :input'),
             dataType: 'json',
             success: function(json) {
               alert(json.msg);
             }
        });
	}
});
//--></script>
<style>
    textarea[readonly]{overflow-y:visible ;}
</style>
<?php echo $footer; ?>