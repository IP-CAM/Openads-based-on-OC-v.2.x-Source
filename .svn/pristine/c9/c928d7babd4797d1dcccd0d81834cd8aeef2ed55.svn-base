<div class="do-result">
    <?php if ($locked) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $text_lock; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
</div>

<ul class="nav nav-tabs">
    <li class="active"><a href="#tab-post" data-toggle="tab"><?php echo $tab_photo; ?></a></li>
    <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
</ul>

<div class="tab-content">
    <div class="tab-pane active" id="tab-post">
        <form method="post" class="form-horizontal" id="ad-photo-form" action="<?php echo $action ?>">
            <input type="hidden" name="photo_id" value="<?php echo $photo_id?>">
            <fieldset>
                <legend>
                    <?php echo $text_photo ?>
                    <div class="pull-right">
                        <?php echo $status_text ?>
                    </div>
                </legend>
                <div class="form-group clearfix">
                    <label class="col-sm-2 text-right"><?php echo $entry_file ?></label>
                    <div class="col-sm-10 ">
                        <div id="ad-imgs" class="uploads _ad-photo">
                        <?php if(is_array($file)){ ?>
                            <?php foreach ($file as $item): ?>
                            <div class="attach">
                                <?php if(!empty($item['realpath'])){ ?>
                                <a href="<?php echo $item['realpath'] ?>" class="fancy-img"></a>
                                <?php } ?>
                                <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>" filename="<?php echo $item['name'] ?>" filepath="<?php echo $item['path'] ?>">
                                <?php if($modify){ ?>
                                <a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>
                                <?php }?>
                            </div>
                            <?php endforeach ?>
                        <?php }else{ ?>
                            <div class="empty-label"><label class="label label-default"><?php echo $text_empty ?></label></div>
                        <?php }?>
                        </div>
                        <input name="file" type="hidden" class="_ad-photo" />
                        <?php if($modify){ ?>
                        <div class="widgets">
                            <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default _ad-photo"><i class="fa fa-upload"></i></button>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label"><?php echo $entry_note ?></label>
                    <div class="col-sm-10">
                        <textarea name="note" class="form-control" <?php echo $modify ? '' : 'readonly' ?>><?php echo $note ?></textarea>
                    </div>
                </div>
                <?php if($relax){ ?>
                <fieldset>
                    <legend></legend>
                    <div class="form-group clearfix">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="button" id="btn-relax" data-toggle="tooltip" title="<?php echo $button_relax; ?>" class="btn btn-warning">
                                <i class="fa fa-unlock"></i> <?php echo $button_relax; ?>
                            </button>
                        </div>
                    </div>
                </fieldset>
                <?php } ?>
                <?php if($modify){ ?>
                <fieldset>
                    <legend></legend>
                    <div class="form-group clearfix">
                        <div class="col-sm-10 col-sm-offset-2">
                            <button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary" id="btn-save">
                                <i class="fa fa-save"></i> <?php echo $button_update; ?>
                            </button>
                        </div>
                    </div>
                </fieldset>
                <?php }?>
            </fieldset>
        </form>
        <fieldset id="advertise-set">
            <legend>
                <?php echo $text_advertise ?>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs widget-tg" data-rel="advertise"><i class="fa fa-minus"></i> </a>
                </div>
            </legend>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_product ?></label>
                <div class="col-sm-10"><?php echo $product ?></div>
            </div>
            <?php if(!empty($domain)){ ?>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_domain ?></label>
                <div class="col-sm-10"><?php echo $domain ?></div>
            </div>
            <?php }?>
            <?php if(!empty($ad_note)){ ?>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_ad_note ?></label>
                <div class="col-sm-10"><?php echo $ad_note ?></div>
            </div>
            <?php }?>
        </fieldset>
        <fieldset id="targeting-set">
            <legend>
                <?php echo $text_targeting ?>
                <div class="pull-right">
                    <?php echo $targeting_status ?>
                    <a class="btn btn-default btn-xs widget-tg" data-rel="targeting"><i class="fa fa-minus"></i> </a>
                </div>
            </legend>
            <div class="form-group clearfix">
                <label class="col-sm-2 control-label"><?php echo $entry_target_url ?></label>
                <div class="col-sm-10">
                    <textarea class="form-control" readonly><?php echo $target_url ?></textarea>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_location ?></label>
                <div class="col-sm-10">
                    <?php foreach ($locations as $item): ?>
                    <?php if(in_array($item['targeting_id'], $location)){ ?>
                    <label class="label label-default"><?php echo $item['name'] ?></label>
                    <?php }?>
                    <?php endforeach ?>
                    <?php if(!empty($other_location)){ ?>
                    <textarea class="form-control" readonly><?php echo $other_location ?></textarea>
                    <?php }?>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_age ?></label>
                <div class="col-sm-10">
                    <label class="label label-default">
                        <?php echo $age_min ?> - <?php echo $age_max >65 ? '65+' : $age_max ?>
                    </label>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_gender ?></label>
                <div class="col-sm-10">
                    <?php foreach ($genders as $item): ?>
                    <?php if($item['targeting_id']==$gender){ ?>
                    <label class="label label-default"><?php echo $item['name'] ?></label>
                    <?php }?>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_language ?></label>
                <div class="col-sm-10">
                    <?php foreach ($languages as $item): ?>
                    <?php if(in_array($item['targeting_id'], $language)){ ?>
                    <label class="label label-default"><?php echo $item['name'] ?></label>
                    <?php }?>
                    <?php endforeach ?>
                    <?php if(!empty($other_language)){ ?>
                    <textarea class="form-control" readonly><?php echo $other_language ?></textarea>
                    <?php }?>
                </div>
            </div>
            <?php if(!empty($interest)) { ?>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_interest ?></label>
                <div class="col-sm-10">
                    <textarea class="form-control" readonly><?php echo $interest ?></textarea>
                </div>
            </div>
            <?php } ?>
            <?php if(!empty($audience)) { ?>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_audience ?></label>
                <div class="col-sm-10">
                    <input class="form-control" readonly value="<?php echo $audience ?>" />
                </div>
            </div>
            <?php } ?>
        </fieldset>
        <fieldset id="post-set">
            <legend>
                <?php echo $text_post ?>
                <div class="pull-right">
                    <?php echo $post_status ?>
                    <a class="btn btn-default btn-xs widget-tg" data-rel="post"><i class="fa fa-minus"></i> </a>
                </div>
            </legend>

            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_headline ?></label>
                <div class="col-sm-10">
                    <input class="form-control" readonly value="<?php echo $headline ?>" />
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_post_text ?></label>
                <div class="col-sm-10">
                    <textarea class="form-control" readonly ><?php echo $post_text ?></textarea>
                </div>
            </div>
            <?php if(!empty($post_note)){ ?>
            <div class="form-group clearfix">
                <label class="col-sm-2 text-right"><?php echo $entry_note ?></label>
                <div class="col-sm-10">
                    <textarea class="form-control" readonly ><?php echo $post_note ?></textarea>
                </div>
            </div>
            <?php } ?>
        </fieldset>

    </div>
    <div class="tab-pane" id="tab-history">
        <div id="history"></div>
    </div>
</div>

<script type="text/javascript"><!--
    $(function(){
        $('a.fancy-img').fancybox();
    });
    <?php if($modify){ ?>
    $(function() {
        $('#ad-photo-form').formValidation({
            framework:'bootstrap',
            icon: false,
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            if($('.uploads img').length > 0){
                var upload = [];
                $.each($('.uploads img'), function () {
                    upload.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
                });
                $('input[name="file"]._ad-photo').val($.toJSON(upload));
                $('#ad-imgs').parent().parent().removeClass('has-error').addClass('has-success');
                $('#ad-imgs').parent().find('.help-block').remove();
            }else{
                $('#ad-imgs').parent().parent().removeClass('has-success').addClass('has-error');
                $('#ad-imgs').parent().append('<small class="help-block" style="display: block;"><?php echo $error_photo;?></small>')
                return false;
            }
            var $form = $(e.target);
            $.post(
                $form.attr('action'),
                $form.serialize(),
                function(json){
                    $('html, body').animate({ scrollTop: 0 }, 'fast');
                    if(json.status==0){
                        $('.do-result').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }else{
                        $('.do-result').html('<div class="alert alert-success"> ' + json.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        location.reload();
                    }
                },
                'json'
            );
        });
    });

    //Upload Image
    new AjaxUpload('#button-upload', {
        action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
        name: 'attachment',
        autoSubmit: false,
        responseType: 'json',
        onChange: function(file, extension) {this.submit();},
        onComplete: function(file, json) {
            if(json.success) {
                $('.empty-label').remove();
                var html = '<div class="attach">';
                html += '    <img title="'+file+'" filename="'+file+'" filepath="'+json.path+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
                html += '    <a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>';
                html += '</div>';
                $("#ad-imgs").html(html).parent().find('.help-block').remove();
                $('#ad-imgs').parent().parent().removeClass('has-error').addClass('has-success');
            }else{
                alert(json.error);
            }
            $('.loading').remove();
        }
    });
    <?php }?>

    <?php if($relax){ ?>
    $('#btn-relax').bind('click',function(){
        _component.update(
            'index.php?route=service/advertise/relax&token=<?php echo $token; ?>',
            {mode:'photo',entry_id:'<?php echo $photo_id ?>'}
        );
    });
    <?php } ?>
    //toggle
    $('.widget-tg').bind('click', function () {
        $('#'+$(this).attr('data-rel')+'-set').find('div.form-group').slideToggle();
        if($(this).children('i').hasClass('fa-minus')){
            $(this).children('i').removeClass('fa-minus').addClass('fa-plus');
        }else{
            $(this).children('i').removeClass('fa-plus').addClass('fa-minus');
        }
    });
    $('.widget-tg[data-rel="targeting"],.widget-tg[data-rel="post"]').trigger('click');
    //History
    $('#history').delegate('.pagination a', 'click', function(e) {
        e.preventDefault();
        $('#history').load(this.href);
    });
    $('#history').load('index.php?route=service/advertise_photo/history&token=<?php echo $token; ?>&photo_id=<?php echo $photo_id; ?>');

//-->
</script>
