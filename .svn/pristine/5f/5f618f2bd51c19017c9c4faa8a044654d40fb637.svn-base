<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
    </ul>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
    <?php } ?>
    <div class="row">
      	<div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
        <div id="content" class="col-sm-9">
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal" id="ad-form">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><?php echo $title_general ?></h3></div>
                    <div class="panel-body">

                        <div class="form-group required">
                            <label class="col-sm-2 control-label text-right" for="input-website"><?php echo $entry_website ?></label>
                            <div class="col-sm-7 ">
                                <select name="website_id" id="input-website" class="form-control">
                                <?php foreach ($websites as $product): ?>
                                <optgroup label="<?php echo $product['product'] ?>">
                                    <?php foreach ($product['website'] as $item): ?>
                                    <option value="<?php echo $item['website_id'] ?>" data-product="<?php echo $item['product'] ?>" data-product-id="<?php echo $item['product_id'] ?>" <?php echo $website==$item['website_id'] ? 'selected="selected"' : '' ?>>
                                        <?php echo $item['domain'] ?>
                                    </option>
                                    <?php endforeach ?>
                                </optgroup>
                                <?php endforeach ?>
                                </select>
                                <label class="label label-success" id="input-product"></label>
                                <input type="hidden" name="product_id">
                            </div>
                        </div>

                        <fieldset id="new-targeting">
                            <legend>
                                <?php echo $title_targeting ?>
                                <span class="legend-right">
                                    <input type="checkbox" data-target="targeting"/> 
                                    <?php echo $text_backend ?>
                                </span>

                                <input type="hidden" value="member" name="targeting[from]" data-toggle-value="backend">
                            </legend>
                            <div class="form-group clearfix ">
                                <label class="col-sm-2 control-label text-right" for="input-target-url"><?php echo $entry_template ?></label>
                                <div class="col-sm-7">
                                    <select id="template_id" name="targeting[template_id]" class="form-control">
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-link" id="btn-template">
                                        <span data-toggle="tooltip" title="<?php echo $help_template; ?>">
                                        <i class="fa fa-file-text"></i>
                                        <?php echo $button_template;?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group clearfix required ">
                                <label class="col-sm-2 control-label text-right" for="input-target-url"><?php echo $entry_target_url ?></label>
                                <div class="col-sm-7">
                                    <input type="text" name="target_url" class="form-control" id="input-target-url" value=""/>
                                </div>
                            </div>

                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_location ?></label>
                                <div class="col-sm-7">
                                    <?php foreach ($locations as $item): ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="targeting[location][]" value="<?php echo $item['targeting_id'] ?>" class="_location" />
                                        <?php echo $item['name'] ?>
                                    </label>    
                                    <?php endforeach ?>
                                    <br/>
                                    <a data-rel="_location" class="other-targeting">
                                        <i class="fa fa-plus-square-o"></i> 
                                        <?php echo $text_other_location ?>
                                    </a>
                                    <textarea name="targeting[other_location]" class="form-control _location" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
                                </div>
                            </div>

                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_age ?></label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                    <select class="form-control" style="width:80px;margin-right:20px;" name="targeting[age_min]" data-toggle="tooltip" title="<?php echo $text_age_min ?>" >
                                        <?php for ($i=13; $i <66; $i++) { ?>
                                        <option value="<?php echo $i ?>" <?php echo $i==18 ? 'selected="selected"' : '' ?>>
                                            <?php echo $i ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                    
                                    <select class="form-control" style="width:80px" name="targeting[age_max]" data-toggle="tooltip" title="<?php echo $text_age_max ?>">
                                        <?php for ($i=13; $i <65; $i++) { ?>
                                        <option value="<?php echo $i ?>" >
                                            <?php echo $i ?>
                                        </option>
                                        <?php }?>
                                        <option value="100" selected="selected">65+</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_gender ?></label>
                                <div class="col-sm-7">
                                    <?php foreach ($genders as $item): ?>
                                    <label class="radio-inline">
                                        <input type="radio" name="targeting[gender]" value="<?php echo $item['targeting_id'] ?>" />
                                        <?php echo $item['name'] ?>
                                    </label>    
                                    <?php endforeach ?>            
                                </div>
                            </div>
                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_language ?></label>
                                <div class="col-sm-7">
                                    <?php foreach ($languages as $item): ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="targeting[language][]" value="<?php echo $item['targeting_id'] ?>" class="_language" />
                                        <?php echo $item['name'] ?>
                                    </label>    
                                    <?php endforeach ?>
                                    <br/>
                                    <a data-rel="_language" class="other-targeting">
                                        <i class="fa fa-plus-square-o"></i>
                                        <?php echo $text_other_language ?>
                                    </a>
                                    <textarea name="targeting[other_language]" class="form-control _language" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label"><?php echo $text_interest ?></label>
                                <div class="col-sm-7">
                                    <textarea name="targeting[interest]" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label"><?php echo $text_behavior ?></label>
                                <div class="col-sm-7">
                                    <textarea name="targeting[behavior]" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label"><?php echo $text_more ?></label>
                                <div class="col-sm-7">
                                    <textarea name="targeting[more]" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label"><?php echo $text_audience ?></label>
                                <div class="col-sm-7">
                                    <input name="targeting[audience]" class="form-control">
                                </div>
                            </div>
                            <div class="form-group clearfix common-item hidden">
                                <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
                                <div class="col-sm-7">
                                    <textarea name="targeting[note]" class="form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="new-post">
                            <legend><?php echo $title_post ?>
                                <span class="legend-right">
                                    <input type="checkbox" data-target="post"/>
                                    <?php echo $text_backend ?>
                                </span>
                                <input type="hidden" value="member" name="post[from]" data-toggle-value="backend"/>   
                            </legend>

                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_headline ?></label>
                                <div class="col-sm-7 ">
                                    <input type="text" name="post[headline]" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label"><?php echo $text_post_text ?></label>
                                <div class="col-sm-7">
                                    <textarea name="post[text]" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group clearfix ">
                                <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
                                <div class="col-sm-7">
                                    <textarea name="post[note]" class="form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="new-photo">
                            <legend><?php echo $title_photo ?>
                                <span class="legend-right">
                                    <input type="checkbox" data-target="photo"/>
                                    <?php echo $text_backend ?>
                                </span>
                                <input type="hidden" value="member" data-toggle-value="backend" name="photo[from]"> 
                            </legend>
                            <div class="form-group clearfix required">
                                <label class="col-sm-2 control-label">
                                    <?php echo $text_post_img ?>
                                    <br>
                                    <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-info"><i class="fa fa-upload"></i></button>
                                </label>
                                <div class="col-sm-7 ">
                                    <div id="ad-photos" class="uploads _photos"></div>
                                    <input name="photo[file]" type="hidden" class="_photos"/>
                                </div>
                            </div>
                            <div class="form-group clearfix ">
                                <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
                                <div class="col-sm-7">
                                    <textarea name="photo[note]" class="transfer-note form-control"></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset style="display:none;">
                            <legend><?php echo $entry_priority ?></legend>
                            <div class="form-group clearfix">
                                <label class="col-sm-2 control-label"><?php echo $text_priority ?></label>
                                <div class="col-sm-7">
                                    <?php foreach ($priority_info as $item): ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="priority_id" value="<?php echo $item['priority_id'] ?>" <?php echo $item['default'] ? 'checked' : '' ?> data-money="<?php echo $item['money'] ?>" data-amount="<?php echo $item['amount'] ?>"> 
                                            <?php echo $item['name'] ?> 
                                            &nbsp; 
                                            <?php echo $text_queuing ?> <?php echo $item['quantity'] ?> 
                                            &nbsp;
                                            <?php echo $text_money ?> <?php echo $item['amount'] ?>
                                        </label>
                                    </div>
                                    <?php endforeach ?>   
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend><?php echo $text_note ?></legend>
                            <div class="form-group clearfix">
                                <div class="col-sm-7 col-sm-offset-2">
                                    <textarea name="note" class="form-control" id="input-note"></textarea>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="panel-footer">
                        <div class="text-right">                            
                            <?php if ($text_agree) { ?>                            
                                <label class="checkbox-inline">
                                    <?php if ($agree) { ?>
                                    <input type="checkbox" name="agree" value="1" checked="checked" />
                                    <?php } else { ?>
                                    <input type="checkbox" name="agree" value="1" checked="checked" />
                                    <?php } ?>
                                    <?php echo $text_agree; ?>
                                </label>                            
                            <?php }?>
                            <span style="display:none;">
                                <?php echo $text_amount ?>
                                <b id="ad-amount" class="text-danger"><?php echo $default_amount ?></b>
                                <input type="hidden" name="money" value="0" />
                            </span>
                            <button type="submit" class="btn btn-success">
                                <?php echo $button_create ?>
                            </button>                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="template-dialog">
    <?php echo $template ?>
</div>
<script type="text/javascript"><!-- 
$(function() {
    $('#ad-form')
    .formValidation({
        icon: false,
        fields: {            
            website_id: {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_website ?>'
                    }
                }
            },
            agree: {
                validators: {
                    notEmpty: {
                        message: '<?php //echo $error_agree ?> '
                    }
                }
            },
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
                            var domain = $.trim($('select[name="website_id"]').find("option:selected").text());
                            return value.indexOf(domain) > -1;
                        }
                    }
                }
            },
            'targeting_location':{
                selector: '#ad-form ._location',
                validators: {
                    callback:{
                        message: '<?php echo $error_location ?>',
                        callback: function(value, validator, $field){                            
                            var checked = $('#ad-form').find('[name^="targeting[location]"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#ad-form').find('[name="targeting[other_location]"]').val()).length;
                            if(txt_leng > 1){
                                return true;
                            }
                            return  false ;          
                        }
                    }
                }
            },
            'targeting[gender]': {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_gender ?>'
                    }
                }
            },
            'targeting_language':{
                selector: '#ad-form ._language',
                validators: {
                    callback:{
                        message: '<?php echo $error_language ?>',
                        callback: function(value, validator, $field){
                            
                            var checked = $('#ad-form').find('[name^="targeting[language]"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#ad-form').find('[name="targeting[other_language]"]').val()).length;
                            if(txt_leng > 1){
                                return true;
                            }
                            return  false ;          
                        }
                    }
                }
            },
            'targeting[audience]':{
                validators: {
                    callback:{
                        message:'<?php echo $error_audience;?>',
                        callback: function(value, validator, $field){
                            return value =='' ? true : $.isNumeric(value);
                        }
                    }
                }
            },
            'post[headline]':{
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_headline ?>'
                    },
                    stringLength: {
                        min:3,
                        max:25,
                        message:'<?php echo $error_headline_length ?>'
                    }
                }
            },
            'post[text]':{
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_text ?>'
                    },
                    stringLength: {
                        min:3,
                        max:90,
                        message:'<?php echo $error_text_length ?>'
                    }
                }
            },
            'photo_file':{
                selector: '#ad-form ._photos',
                validators:{
                    callback:{
                        message: '<?php echo $error_photo ?>',
                        callback: function(value, validator, $field){                            
                            if($('#new-photo input[name="photo[from]"]').val()=='member'){
                                if($('#new-photo #ad-photos img').length>0){
                                    var uploads = [];
                                    $.each($('#new-photo #ad-photos img'),function(){
                                        uploads.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
                                    });
                                    $('#new-photo input[name="photo[file]"]').val($.toJSON(uploads));
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
    })
    .on('err.form.fv', function(e) {
        var $form          = $(e.target),
            formValidation = $form.data('formValidation');

        alert('<?php echo $error_form ?>');
    })
    .on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        $.post(
            $form.attr('action'), 
            $form.serialize(), 
            function(json) {
                if(json.status==0){
                    for(var k in json['error']){

                    }
                }else{
                	location = '<?php echo $redirect; ?>';
                	$.ajax({
                		url: 'index.php?route=tool/cron/similar_text&token=<?php echo $token; ?>',
                	    type: 'get',
                	});
                    
                }
            }, 
        'json');
    })
    .find('input[data-target]').on('change',function(){
        var target = $(this).attr('data-target'),
            $container = $('#new-'+target).find('.form-group:not(".common-item")'),
            $toggle_value = $('#new-'+target).find('input[name$="from]"]').val();
            $value = $('#new-'+target).find('input[name$="from]"]').attr('data-toggle-value');
        $('#new-'+target).find('input[name$="from]"]').val($value).attr('data-toggle-value',$toggle_value);
        $container.toggle();
        var display = $container.css('display');
        switch (true) {
            case ('targeting' == target && 'block' == display):
                $('#ad-form')
                    .formValidation('addField', 'targeting_location',{
                        selector: '#ad-form ._location',
                        validators: {
                            callback:{
                                message: '<?php echo $error_location ?>',
                                callback: function(value, validator, $field){                            
                                    var checked = $('#ad-form').find('[name^="targeting[location]"]:checked').length;
                                    if(checked > 0){
                                        return true;
                                    }
                                    var txt_leng = $.trim($('#ad-form').find('[name="targeting[other_location]"]').val()).length;
                                    if(txt_leng > 1){
                                        return true;
                                    }
                                    return  false ;          
                                }
                            }
                        }
                    })
                    .formValidation('addField', 'targeting[gender]', {
                        validators: {
                            notEmpty: {
                                message: '<?php echo $error_gender ?>'
                            }
                        }
                    })
                    .formValidation('addField', 'targeting_language',{
                        selector: '#ad-form ._language',
                        validators: {
                            callback:{
                                message: '<?php echo $error_language ?>',
                                callback: function(value, validator, $field){
                                    
                                    var checked = $('#ad-form').find('[name^="targeting[language]"]:checked').length;
                                    if(checked > 0){
                                        return true;
                                    }
                                    var txt_leng = $.trim($('#ad-form').find('[name="targeting[other_language]"]').val()).length;
                                    if(txt_leng > 1){
                                        return true;
                                    }
                                    return  false ;          
                                }
                            }
                        }
                    });
                break;
            case ('targeting' == target && 'none' == display):
                $('#ad-form')
                    .formValidation('removeField', 'targeting_location')
                    .formValidation('removeField', 'targeting[gender]')
                    .formValidation('removeField', 'targeting_language');
                break;
            case ('post' == target && 'block' == display):
                $('#ad-form')
                    .formValidation('addField', 'post[headline]',{
                        validators: {
                            notEmpty: {
                                message: '<?php echo $error_headline ?>'
                            },
                            stringLength: {
                                min:3,
                                max:25,
                                message:'<?php echo $error_headline_length ?>'
                            }
                        }
                    })
                    .formValidation('addField','post[text]',{
                        validators: {
                            notEmpty: {
                                message: '<?php echo $error_text ?>'
                            },
                            stringLength: {
                                min:3,
                                max:90,
                                message:'<?php echo $error_text_length ?>'
                            }
                        }
                    });
                break;
            case ('post' == target && 'none' == display):
                $('#ad-form')
                    .formValidation('removeField', 'post[headline]')
                    .formValidation('removeField', 'post[text]');
                break;
            case ('photo' == target && 'block' == display):
                $('#ad-form')
                    .formValidation('addField', 'photo_file',{
                        selector: '#ad-form ._photos',
                        validators:{
                            callback:{
                                message: '<?php echo $error_photo ?>',
                                callback: function(value, validator, $field){                         
                                    if($('#new-photo input[name="photo[from]"]').val()=='member'){
                                        if($('#new-photo #ad-photos img').length>0){
                                            var uploads = [];
                                            $.each($('#new-photo #ad-photos img'),function(){
                                                uploads.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
                                            });
                                            $('#new-photo input[name="photo[file]"]').val($.toJSON(uploads));
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
                break;
            case ('photo' == target && 'none' == display):
                $('#ad-form').formValidation('removeField', 'photo[file]');
                break;
        }           
    });
    $('input[name="post[headline]"]').maxlength( {events: ['blur'],maxCharacters:25,slider:true,statusClass:'_txtlimit',statusText:'<?php echo $text_length_left ?>'} );
    $('textarea[name="post[text]"]').maxlength( {events: ['blur'],maxCharacters:90,slider:true,statusClass:'_txtlimit',statusText:'<?php echo $text_length_left ?>'} );
    $('#input-website').trigger('change');
});
//-->
</script>
<script type="text/javascript"><!-- 
$('#input-website').bind('change',function(){
    $option = $(this).find('option[value="'+$(this).val()+'"]');
    $('#input-target-url').val($.trim($option.text()));
    $('#input-product').html($option.attr('data-product'));
    $('input[name="product_id"]').val($option.attr('data-product-id'));
    $('#template_id').empty();
    $.get('index.php?route=service/new/getTemplates',{product_id : $option.attr('data-product-id')},function(json){
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
})
$('#template_id').bind('change',function(){
    var template_id = $('#template_id').val();
    if(template_id){
        $.get('index.php?route=service/new/template',{template_id:template_id},function(json){
            if(json.status==1){
                var tpl = json['data'];
                if($.isArray(tpl['location'])){
                    $.each($('#ad-form input[name^="targeting[location]"]'),function(){
                        $(this).removeProp('checked');
                    });
                    for (var i in tpl['location']) {
                        $('#ad-form input[name^="targeting[location]"][value="'+tpl['location'][i]+'"]').prop('checked',true);
                    }
                }
                if($.isArray(tpl['language'])){
                    $.each($('#ad-form input[name^="targeting[language]"]'),function(){
                        $(this).removeProp('checked');
                    });
                    for (var i in tpl['language']) {
                        $('#ad-form input[name^="targeting[language]"][value="'+tpl['language'][i]+'"]').prop('checked',true);
                    }
                }
                $('#ad-form input[name="targeting[age_min]"').val(tpl['age_min']);
                $('#ad-form input[name="targeting[age_max]"').val(tpl['age_max']);
                $('#ad-form input[name="targeting[gender]"][value="'+tpl['gender']+'"]').prop('checked',true);
                $('#ad-form input[name="targeting[audience]"').val(tpl['audience']);
                $('#ad-form textarea[name="targeting[interest]"').val(tpl['interest']);
                $('#ad-form textarea[name="targeting[behavior]"').val(tpl['behavior']);
                $('#ad-form textarea[name="targeting[more]"').val(tpl['more']);
            }
        },'json');
    }
})
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
$('input[name="priority_id"]').change(function(){            
    $.ajax({
        url:'index.php?route=service/advertise/valideteBalance',
        data:{priority_id:$('input[name="priority_id"]:checked').val(),ad:0},
        type:'post',
        dataType:'json',
        success:function(json){
            if(json.status==0){
                alert(json.msg);
                $('input[name="priority_id"]').prop('checked',false);
                $('label.text-danger input[name="priority_id"]').prop('checked',true);
            }
            $('#ad-amount').html($('input[name="priority_id"]:checked').attr('data-amount'));
            $('input[name="priority_id"]:checked').parent().parent().parent().find('label.text-danger').removeClass('text-danger');
            $('input[name="priority_id"]:checked').parent('label').addClass('text-danger');
            if(parseFloat($('input[name="priority_id"]:checked').attr('data-balance')).toFixed(2)==0.00){
                $('#change-priority').attr('disabled','disabled');
            }else{
                $('#change-priority').removeAttr('disabled');
            }
        }
    });
});
$('input[name="priority_id"]:checked').trigger('change');
//-->
</script>
<script type="text/javascript"><!-- 
$('#btn-template').bind('click',function() {
    $('#template-dialog select[name="tpl[product_id]"]').val($('input[name="product_id"]').val());
    $('#template-dialog').dialog('open');
});
$('#template-dialog').dialog({
    title:'<?php echo $text_title_template ;?>',
    width:680,
    autoOpen:false,
    buttons:{
        '<?php echo $button_save ?>':function() {
            $('#template-dialog form').submit();
        },
        '<?php echo $button_close ?>':function(){
            $(this).dialog('close');
        }
    }
});
new AjaxUpload('#button-upload', {
    action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
    name: 'attachment',
    autoSubmit: false,
    responseType: 'json',
    onChange: function(file, extension) {this.submit();},
    onComplete: function(file, json) {
        if(json.success) { 
            $('#ad-photos').parent().parent().removeClass('has-error').addClass('has-success').find('.help-block').hide();
            var html = '<div class="attach">';
            html +='<img title="'+file+'" filename="'+file+'" filepath="'+json.path+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
            html +='<a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>';
            html += '</div>';
            $("#ad-photos").append(html);
        }else{
            alert(json.error);
        }           
        $('.loading').remove(); 
    }
});
//-->
</script>
<style type="text/css">
    legend{position: relative;}
    .legend-right{ position: absolute; font-size:12px;left: 141px;bottom: 1px;}
    .label{letter-spacing: 1px;}
    #input-website{position: relative;}
    #input-website  option{padding: 5px;}
    #input-product{position: absolute;right:42px;bottom: 2px;}
</style>
<?php echo $footer; ?>