
<?php if($modify){ ?>
<form method="post" class="form-horizontal" id="component-targeting" action="<?php echo $modify_action ?>">  
    <div class="do-result"></div>
    <input type="hidden" name="entry" value="<?php echo $targeting_id ?>">
    <input type="hidden" name="mode" value="targeting">
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
    <div class="form-group clearfix ">
          <label class="col-sm-2 control-label text-right" for="input-target-url"><?php echo $entry_template ?></label>
           <div class="col-sm-7">
             <select id="template_id" name="template_id" class="form-control">
             </select>
           </div>
           
     </div>
    <div class="form-group clearfix required by">
        <label class="col-sm-2 control-label" for="input-target-url"><?php echo $text_target_url ?></label>
        <div class="col-sm-9">
            <input type="text" name="target_url" class="form-control" id="input-target-url" value="<?php echo $target_url ?>"/>
        </div>
    </div>
    <div class="form-group clearfix required by">
        <label class="col-sm-2 control-label"><?php echo $text_location ?></label>
        <div class="col-sm-8">
            <?php foreach ($locations as $item): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="location[]" value="<?php echo $item['targeting_id'] ?>" <?php echo in_array($item['targeting_id'], $location) ? 'checked' : '' ?> class="_location"/>
                <?php echo $item['name'] ?>
            </label>    
            <?php endforeach ?>
            <br/>
            <a data-rel="_location" class="other-targeting">
                <i class="fa fa-plus-square-o"></i> 
                <?php echo $text_other_location ?>
            </a>
            <textarea name="other_location" class="form-control _location" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
        </div>
    </div>
    <div class="form-group clearfix required by">
        <label class="col-sm-2 control-label"><?php echo $text_age ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <select class="form-control" style="width:80px;margin-right:20px;" name="age_min" data-toggle="tooltip" title="<?php echo $text_age_min ?>" >
                    <?php for ($i=13; $i <66; $i++) { ?>
                    <option value="<?php echo $i ?>" <?php echo $i==$age_min ? 'selected="selected"' : '' ?>>
                        <?php echo $i ?>
                    </option>
                    <?php }?>
                </select>
                
                <select class="form-control" style="width:80px" name="age_max" data-toggle="tooltip" title="<?php echo $text_age_max ?>">
                    <?php for ($i=13; $i <65; $i++) { ?>
                    <option value="<?php echo $i ?>" <?php echo $i==$age_max ? 'selected="selected"' : '' ?>>
                        <?php echo $i ?>
                    </option>
                    <?php }?>
                    <option value="100" <?php echo 100==$age_max ? 'selected="selected"' : '' ?>>65+</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group clearfix required by">
        <label class="col-sm-2 control-label"><?php echo $text_gender ?></label>
        <div class="col-sm-8">
            <?php foreach ($genders as $item): ?>
            <label class="radio-inline">
                <input type="radio" name="gender" value="<?php echo $item['targeting_id'] ?>" <?php echo $gender==$item['targeting_id'] ? 'checked' : '' ?>/>
                <?php echo $item['name'] ?>
            </label>    
            <?php endforeach ?>            
        </div>
    </div>
    <div class="form-group clearfix required by">
        <label class="col-sm-2 control-label"><?php echo $text_language ?></label>
        <div class="col-sm-8">
            <?php foreach ($languages as $item): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="language[]" value="<?php echo $item['targeting_id'] ?>" <?php echo in_array($item['targeting_id'], $language) ? 'checked' : '' ?> class="_language"/>
                <?php echo $item['name'] ?>
            </label>    
            <?php endforeach ?>
            <br/>
            <a data-rel="_language" class="other-targeting">
                <i class="fa fa-plus-square-o"></i>
                <?php echo $text_other_language ?>
            </a>
            <textarea name="other_language" class="form-control _language" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
        </div>
    </div>
    <div class="form-group clearfix by">
        <label class="col-sm-2 control-label"><?php echo $text_interest ?></label>
        <div class="col-sm-8">
            <textarea name="interest" class="form-control"><?php echo $interest ?></textarea>
        </div>
    </div>
    <div class="form-group clearfix by">
        <label class="col-sm-2 control-label"><?php echo $text_behavior ?></label>
        <div class="col-sm-8">
            <textarea name="behavior" class="form-control"><?php echo $behavior ?></textarea>
        </div>
    </div>
    <div class="form-group clearfix by">
        <label class="col-sm-2 control-label"><?php echo $text_more ?></label>
        <div class="col-sm-8">
            <textarea name="more" class="form-control"><?php echo $more ?></textarea>
        </div>
    </div>
    <div class="form-group clearfix by">
      <label class="col-sm-2 control-label"><?php echo $text_audience ?></label>
        <div class="col-sm-8">
           <input name="audience" class="form-control">
        </div>
    </div>
    <div class="form-group clearfix hidden">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-8">
            <textarea name="note" class="form-control"><?php echo $note ?></textarea>
        </div>
    </div>
        
    <hr>
    <div class="form-group clearfix">
        <div class="col-sm-offset-2 col-sm-8">
            <button type="submit" class="btn btn-primary"><?php echo $button_save ?></button>
        </div>
    </div>
</form>

<script type="text/javascript"><!--
    $(function() {
        $('#component-targeting')
        .formValidation({
            framework:'bootstrap',
            icon: false,
            fields: {
                'target_url': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $error_target_url ?>'
                        },
                        uri: {
                            message: '<?php echo $error_target_url_invalid ?>'
                        },
                        callback:{
                            message:'<?php echo $error_target_url_prefix;?>',
                            callback: function(value, validator, $field) {                           
                                var domain = $.trim('<?php echo $domain ?>');
                                return value.indexOf(domain) > -1;
                            }
                        }
                    }
                },
                'targeting_location':{
                    selector: '._location',
                    validators: {
                        callback:{
                            message: '<?php echo $error_location ?>',
                            callback: function(value, validator, $field){                            
                                var checked = $('#component-targeting').find('[name^="location"]:checked').length;
                                if(checked > 0){
                                    return true;
                                }
                                var txt_leng = $.trim($('#component-targeting').find('[name="other_location"]').val()).length;
                                if(txt_leng > 1){
                                    return true;
                                }
                                return  false ;          
                            }
                        }
                    }
                },
                'gender': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $error_gender ?>'
                        }
                    }
                },
                'targeting_language':{
                    selector: '._language',
                    validators: {
                        callback:{
                            message: '<?php echo $error_language ?>',
                            callback: function(value, validator, $field){
                                
                                var checked = $('#component-targeting').find('[name^="language"]:checked').length;
                                if(checked > 0){
                                    return true;
                                }
                                var txt_leng = $.trim($('#component-targeting').find('[name="other_language"]').val()).length;
                                if(txt_leng > 1){
                                    return true;
                                }
                                return  false ;          
                            }
                        }
                    }
                }
            }
        })
        .on('success.form.fv', function(e) {
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
            $('#component-targeting .by').toggle();
            if($('#component-targeting .by').css('display')=='block'){
                $('#component-targeting')
                    .formValidation('addField', 'targeting_location',{
                        selector: '._location',
                        validators: {
                            callback:{
                                message: '<?php echo $error_location ?>',
                                callback: function(value, validator, $field){                            
                                    var checked = $('#component-targeting').find('[name^="location"]:checked').length;
                                    if(checked > 0){
                                        return true;
                                    }
                                    var txt_leng = $.trim($('#component-targeting').find('[name="other_location"]').val()).length;
                                    if(txt_leng > 1){
                                        return true;
                                    }
                                    return  false ;          
                                }
                            }
                        }
                    })
                    .formValidation('addField', 'gender', {
                        validators: {
                            notEmpty: {
                                message: '<?php echo $error_gender ?>'
                            }
                        }
                    })
                    .formValidation('addField', 'targeting_language',{
                        selector: '._language',
                        validators: {
                            callback:{
                                message: '<?php echo $error_language ?>',
                                callback: function(value, validator, $field){                 
                                    var checked = $('#component-targeting').find('[name^="language"]:checked').length;
                                    if(checked > 0){
                                        return true;
                                    }
                                    var txt_leng = $.trim($('#component-targeting').find('[name="other_language"]').val()).length;
                                    if(txt_leng > 1){
                                        return true;
                                    }
                                    return  false ;          
                                }
                            }
                        }
                    });
            }else{
                $('#component-targeting')
                    .formValidation('removeField', 'targeting_location')
                    .formValidation('removeField', 'gender')
                    .formValidation('removeField', 'targeting_language');
            }
        });

    });
    $('.other-targeting').bind('click',function(){
        $(this).next('textarea.'+$(this).attr('data-rel')).val('').toggle();
        $(this).children('i').toggleClass(function(){
            if($(this).hasClass('fa-plus-square-o')){
                $(this).removeClass('fa-plus-square-o');
                return 'fa-minus-square-o';
            }else{
                $(this).removeClass('fa-minus-square-o');
                return 'fa-plus-square-o';
            }
        })
    });
    $.get('index.php?route=service/new/getTemplates',{product_id : <?php echo $product_id?>},function(json){
        if(json.status==1){
            var _ops = '<option value="0">'+json.msg+'</option>';
            for(var k in json['data']){
                var tpl = json['data'][k];
                _ops += '<option value="'+tpl['template_id']+'">'+tpl['targeting_sn']+' '+tpl['targeting_name']+'</option>';
            }
            $('#template_id').append(_ops);
        }else{
            $('#template_id').append('<option value="0"><?php echo $text_no_template ?></option>');
        }
    },'json');
    $('#template_id').bind('change',function(){
        var template_id = $('#template_id').val();
        if(template_id){
            $.get('index.php?route=service/new/template',{template_id:template_id},function(json){
                if(json.status==1){
                    var tpl = json['data'];
                    if($.isArray(tpl['location'])){
                        $.each($('#component-targeting input[name^="location"]'),function(){
                            $(this).removeProp('checked');
                        });
                        for (var i in tpl['location']) {
                            $('#component-targeting input[name^="location"][value="'+tpl['location'][i]+'"]').prop('checked',true);
                        }
                    }
                    if($.isArray(tpl['language'])){
                        $.each($('#component-targeting input[name^="language"]'),function(){
                            $(this).removeProp('checked');
                        });
                        for (var i in tpl['language']) {
                            $('#component-targeting input[name^="language"][value="'+tpl['language'][i]+'"]').prop('checked',true);
                        }
                    }
                    $('#component-targeting input[name="age_min"').val(tpl['age_min']);
                    $('#component-targeting input[name="age_max"').val(tpl['age_max']);
                    $('#component-targeting input[name="gender"][value="'+tpl['gender']+'"]').prop('checked',true);
                    $('#component-targeting input[name="audience"').val(tpl['audience']);
                    $('#component-targeting textarea[name="interest"').val(tpl['interest']);
                    $('#component-targeting textarea[name="behavior"').val(tpl['behavior']);
                    $('#component-targeting textarea[name="more"').val(tpl['more']);
                }
            },'json');
        }
    });
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
                <?php } ?>
            <?php endforeach ?>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_location ?></label>
        <div class="col-sm-8">
        <?php foreach ($locations as $item): ?>
            <?php if(in_array($item['targeting_id'], $location)){ ?>
            <label class="label label-default"><?php echo $item['name'] ?></label>
            <?php }?>
        <?php endforeach ?>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_age ?></label>
        <div class="col-sm-8">
            <label class="label label-default"><?php echo $age_min ?> - <?php echo $age_max ?></label>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_gender ?></label>
        <div class="col-sm-8">
        <?php foreach ($genders as $item): ?>
            <?php if($gender==$item['targeting_id']){ ?>
            <label class="label label-default"><?php echo $item['name'] ?></label>
            <?php }?>
        <?php endforeach ?>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_language ?></label>
        <div class="col-sm-8">
        <?php foreach ($languages as $item): ?>
            <?php if(in_array($item['targeting_id'], $language)){ ?>
            <label class="label label-default"><?php echo $item['name'] ?></label>
            <?php } ?>                    
        <?php endforeach ?>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_interest ?></label>
        <div class="col-sm-8">
            <pre><?php echo $interest ?></pre>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_behavior ?></label>
        <div class="col-sm-8">
            <pre><?php echo $behavior ?></pre>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_more ?></label>
        <div class="col-sm-8">
            <pre><?php echo $more ?></pre>
        </div>
    </div>
    <div class="form-group clearfix">
      <label class="col-sm-2 control-label"><?php echo $text_audience ?></label>
       <div class="col-sm-8">
          <pre><?php echo $audience ?></pre>
       </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-8">
            <pre><?php echo $note ?></pre>
        </div>
    </div>
<?php }?>