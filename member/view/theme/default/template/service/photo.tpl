
<?php if($modify){ ?>
<form method="post" class="form-horizontal" id="component-photo" action="<?php echo $modify_action ?>">
    <input type="hidden" name="entry" value="<?php echo $photo_id ?>">
    <input type="hidden" name="mode" value="photo">
    <div class="do-result"></div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $progress_status ?></label>
        <div class="col-sm-9">
            <?php echo $progress ?>
            <label class="checkbox">
                <input type="checkbox" name="from" value="backend" />
                <?php echo $text_backend ?>
            </label> 
        </div>
    </div>
    <div class="form-group clearfix by">
        <label class="col-sm-2 control-label">
            <?php echo $text_post_img ?>
            <br>
            <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default"><i class="fa fa-upload"></i></button>
        </label>
        <div class="col-sm-8 ">
            <div id="dialog-ad-photos" class="uploads _photos">
                <?php if(is_array($file)){ ?>
                    <?php foreach ($file as $item): ?>
                <div class="attach">
                    <?php if(!empty($item['realpath'])){ ?>
                    <a href="<?php echo $item['realpath'] ?>" class="fancy-img"></a>
                    <?php } ?>
                    <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>" filename="<?php echo $item['name'] ?>" filepath="<?php echo $item['path'] ?>">
                    <a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>
                </div>
                    <?php endforeach ?>
                <?php }?>
            </div>
            <input name="file" type="hidden" class="_photos"/>
        </div>    
    </div>    
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-8">
            <textarea class="transfer-note form-control"><?php echo $note ?></textarea>
        </div>
    </div>
    <div class="form-group clearfix">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-primary"><?php echo $button_save ?></a>
        </div>
    </div>
</form>
<script type="text/javascript"><!--
    $(function() {
        $('#component-photo')
        .formValidation({
            framework:'bootstrap',
            icon: false,
            fields: {
                'photo_file':{
                    selector: '._photos',
                    validators:{
                        callback:{
                            message: '<?php echo $error_photo ?>',
                            callback: function(value, validator, $field){                            
                                if($('#component-photo input[name="from"]:checked').val()!='backend'){
                                    if($('#dialog-ad-photos img').length>0){
                                        var uploads = [];
                                        $.each($('#dialog-ad-photos img'),function(){
                                            uploads.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
                                        });
                                        $('input[name="file"]').val($.toJSON(uploads));
                                        return true
                                    }else{
                                        return false;
                                    }
                                } 
                                return true;      
                            }
                        }
                    }
                }
            }
        }).on('success.form.fv', function(e) {
            $('.do-result').empty();
            e.preventDefault();
            var $form = $(e.target);
            $.post(
                $form.attr('action'), 
                $form.serialize(), 
                function(json) {
                    if(json.status==0){
                        for(var k in json['error']){}
                    }else{
                        location.reload();
                    }
                }, 
            'json');
        }).find('input[name="from"]').on('click',function(){
            $('#component-photo .by').toggle();
            if($('#component-photo .by').css('display')=='block'){
                $('#component-photo')
                    .formValidation('addField', 'photo_file',{
                        selector: '._photos',
                        validators:{
                            callback:{
                                message: '<?php echo $error_photo ?>',
                                callback: function(value, validator, $field){                            
                                    if($('#component-photo input[name="from"]:checked').val()!='backend'){
                                        if($('#dialog-ad-photos img').length>0){
                                            var uploads = [];
                                            $.each($('#dialog-ad-photos img'),function(){
                                                uploads.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
                                            });
                                            $('input[name="file"]').val($.toJSON(uploads));
                                            return true
                                        }else{
                                            return false;
                                        }
                                    } 
                                    return true;      
                                }
                            }
                        }
                    });
            }else{
                $('#component-photo').formValidation('removeField', 'photo_file');
            }
        });
    });

    new AjaxUpload('#button-upload', {
        action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
        name: 'attachment',
        autoSubmit: false,
        responseType: 'json',
        onChange: function(file, extension) {this.submit();},
        onComplete: function(file, json) {
            if(json.success) { 
                var html = '<div class="attach">';
                html +='<img title="'+file+'" filename="'+file+'" filepath="'+json.path+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
                html +='<a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>';
                html += '</div>';
                $("#dialog-ad-photos").append(html);
            }else{
                alert(json.error);
            }           
            $('.loading').remove(); 
        }
    });
$('.fancy-img').fancybox();
//--></script>
<?php }else{ ?>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_from ?></label>
        <div class="col-sm-8">
            <span class="label label-default">
                <?php echo $from == "member" ? $text_member : $text_backend ?>
            </span>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $progress_status ?></label>
        <div class="col-sm-8">
            <?php foreach ($ad_progresses as $item): ?>
            <?php if($progress == $item['status_id']){ ?>
            <?php echo sprintf(getBSTagStyle($item['status_id']),$item['name']); ?>
            <?php }?>
            <?php endforeach ?>
        </div>
    </div>
    <?php if(false){?>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_status ?></label>
        <div class="col-sm-8">
            <?php foreach ($photo_statuses as $item): ?>
            <?php if($status == $item['status_id']){ ?>
                <pre><?php echo $item['name'] ?></pre>
            <?php } ?>
            <?php endforeach ?>
        </div>
    </div>
    <?php }?>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_post_img ?></label>
        <div class="col-sm-8 ">
            <div id="dialog-ad-photos" class="uploads">
                <?php if(is_array($file)){ ?>
                    <?php foreach ($file as $item): ?>
                <div class="attach">
                    <?php if(!empty($item['realpath'])){ ?>
                    <a href="<?php echo $item['realpath'] ?>" class="fancy-img"></a>
                    <?php } ?>
                    <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>" filename="<?php echo $item['name'] ?>" filepath="<?php echo $item['path'] ?>">
                </div>
                    <?php endforeach ?>
                <?php }?>
            </div>

        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-8">
            <pre><?php echo $note ?></pre>
        </div>
    </div>
<?php }?>
