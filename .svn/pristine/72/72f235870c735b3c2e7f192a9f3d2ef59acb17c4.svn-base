<form id="template-form" method="post" action="<?php echo $tpl_action;?>">
<div class="do-result"></div>
<div class="col-sm-12">
    <div class="form-group clearfix required ">
        <label class="col-sm-3 control-label text-right" for="input-product"><?php echo $entry_product ?></label>
        <div class="col-sm-8">
            <select name="tpl[product_id]" class="form-control">
            <?php foreach ($products as $item): ?>
            <option value="<?php echo $item['product_id'] ?>"><?php echo $item['code'].' '.$item['name'] ?></option>
            <?php endforeach ?>
            </select>
        </div>
    </div>
    <div class="form-group clearfix required">
        <label class="col-sm-3 control-label text-right"><?php echo $text_targeting_sn ?></label>
        <div class="col-sm-8">
            <input name="tpl[targeting_sn]" class="form-control">
        </div>
    </div>

    <div class="form-group clearfix required">
        <label class="col-sm-3 control-label text-right"><?php echo $text_location ?></label>
        <div class="col-sm-8">
            <?php foreach ($locations as $item): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="tpl[location][]" value="<?php echo $item['targeting_id'] ?>" class="_location" />
                <?php echo $item['name'] ?>
            </label>
            <?php endforeach ?>
            <br/>
            <a data-rel="_location" class="other-targeting">
                <i class="fa fa-plus-square-o"></i>
                <?php echo $text_other_location ?>
            </a>
            <textarea name="tpl[other_location]" class="form-control _location" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
        </div>
    </div>
    <div class="form-group clearfix required">
        <label class="col-sm-3 control-label text-right"><?php echo $text_age ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <select class="form-control" style="width:80px;margin-right:20px;" name="tpl[age_min]" data-toggle="tooltip" title="<?php echo $text_age_min ?>" >
                    <?php for ($i=13; $i <66; $i++) { ?>
                    <option value="<?php echo $i ?>" <?php echo $i==18 ? 'selected="selected"' : '' ?>>
                    <?php echo $i ?>
                    </option>
                    <?php }?>
                </select>

                <select class="form-control" style="width:80px" name="tpl[age_max]" data-toggle="tooltip" title="<?php echo $text_age_max ?>">
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
        <label class="col-sm-3 control-label text-right"><?php echo $text_gender ?></label>
        <div class="col-sm-8">
            <?php foreach ($genders as $item): ?>
            <label class="radio-inline">
                <input type="radio" name="tpl[gender]" value="<?php echo $item['targeting_id'] ?>" />
                <?php echo $item['name'] ?>
            </label>
            <?php endforeach ?>
        </div>
    </div>
    <div class="form-group clearfix required">
        <label class="col-sm-3 control-label text-right"><?php echo $text_language ?></label>
        <div class="col-sm-8">
            <?php foreach ($languages as $item): ?>
            <label class="checkbox-inline">
                <input type="checkbox" name="tpl[language][]" value="<?php echo $item['targeting_id'] ?>" class="_language" />
                <?php echo $item['name'] ?>
            </label>
            <?php endforeach ?>
            <br/>
            <a data-rel="_language" class="other-targeting">
                <i class="fa fa-plus-square-o"></i>
                <?php echo $text_other_language ?>
            </a>
            <textarea name="tpl[other_language]" class="form-control _language" style="display:none;" placeholder="<?php echo $text_input ?>"></textarea>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-3 control-label text-right"><?php echo $text_interest ?></label>
        <div class="col-sm-8">
            <textarea name="tpl[interest]" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group clearfix">
        <label class="col-sm-3 control-label text-right"><?php echo $text_behavior ?></label>
        <div class="col-sm-8">
            <textarea name="tpl[behavior]" class="form-control"></textarea>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-3 control-label text-right"><?php echo $text_more ?></label>
        <div class="col-sm-8">
            <textarea name="tpl[more]" class="form-control"></textarea>
        </div>
    </div>

    <div class="form-group clearfix">
        <label class="col-sm-3 control-label text-right"><?php echo $text_audience ?></label>
        <div class="col-sm-8">
            <input name="tpl[audience]" class="form-control">
        </div>
    </div>
</div>
</form>
<script type="text/javascript"><!-- 
$(function() {
    $('#template-form').formValidation({
        icon: false,
        fields: {
            'tpl[targeting_sn]':{
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_targeting_sn ?>'
                    },
                    stringLength: {
                        min:3,
                        max:32,
                        message:'<?php echo $error_targeting_sn_length ?>'
                    }                    
                }
            },
            'tpl_location':{
                selector: '#template-form ._location',
                validators: {
                    callback:{
                        message: '<?php echo $error_location ?>',
                        callback: function(value, validator, $field){                            
                            var checked = $('#template-form').find('[name^="tpl[location]"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#template-form').find('[name="tpl[other_location]"]').val()).length;
                            if(txt_leng > 1){
                                return true;
                            }
                            return  false ;          
                        }
                    }
                }
            },
            'tpl[gender]': {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_gender ?>'
                    }
                }
            },
            'tpl_language':{
                selector: '#template-form ._language',
                validators: {
                    callback:{
                        message: '<?php echo $error_language ?>',
                        callback: function(value, validator, $field){
                            
                            var checked = $('#template-form').find('[name^="tpl[language]"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#template-form').find('[name="tpl[other_language]"]').val()).length;
                            if(txt_leng > 1){
                                return true;
                            }
                            return  false ;          
                        }
                    }
                }
            },
            'tpl[audience]':{
                validators: {
                    callback:{
                        message:'<?php echo $error_audience;?>',
                        callback: function(value, validator, $field){
                            return value =='' ? true : $.isNumeric(value);
                        }
                    }
                }
            }
        }
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
                    $('#template-form .do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
                    setTimeout('location.reload();',1500);
                }
            }, 
        'json');
    })    
});
//-->
</script>