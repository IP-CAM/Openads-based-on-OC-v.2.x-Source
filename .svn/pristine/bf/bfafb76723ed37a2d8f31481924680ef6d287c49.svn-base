
<?php if($modify){ ?>
<form method="post" class="form-horizontal" id="component-post" action="<?php echo $modify_action ?>">
    <input type="hidden" name="entry" value="<?php echo $post_id ?>">
    <input type="hidden" name="mode" value="post">
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
    <div class="form-group clearfix by required">
        <label class="col-sm-2 control-label"><?php echo $text_headline ?></label>
        <div class="col-sm-9 ">
            <input type="text" name="headline" value="<?php echo $headline ?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group clearfix by required">
        <label class="col-sm-2 control-label"><?php echo $text_post_text ?></label>
        <div class="col-sm-9">
            <textarea name="text" class="form-control"><?php echo $text ?></textarea>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-9">
            <textarea name="note" class="form-control"><?php echo $note ?></textarea>
        </div>
    </div>    
    <hr>
    <div class="form-group clearfix">
        <div class="col-sm-9 col-sm-offset-2">
            <button type="submit" class="btn btn-primary"><?php echo $button_save ?></button>
        </div>
    </div>
</form> 
<script type="text/javascript"><!--
    $(function() {
        $('#component-post')
        .formValidation({
            framework:'bootstrap',
            icon: false,
            fields: {
                'headline':{
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
                'text':{
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
                }
            }
        }).on('success.form.fv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            $.post(
                $form.attr('action'), 
                $form.serialize(), 
                function(json) {
                    if(json.status==0){
                        for(var k in json['error']){}
                    }else{
                        $.get('index.php?route=tool/cron/similar_text');
                        location.reload();
                    }
                }, 
            'json');
        }).find('input[name="from"]').on('click',function(){
            $('#component-post .by').toggle();
            if($('#component-post .by').css('display')=='block'){
                $('#component-post')
                    .formValidation('addField', 'headline',{
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
                    .formValidation('addField','text',{
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
            }else{
                $('#component-post')
                    .formValidation('removeField', 'headline')
                    .formValidation('removeField', 'text');
            }
        });
        $('input[name="headline"]').maxlength( {events: ['blur'],maxCharacters:25,slider:true,statusClass:'_txtlimit',statusText:'<?php echo $text_length_left ?>'} );
        $('textarea[name="text"]').maxlength( {events: ['blur'],maxCharacters:90,slider:true,statusClass:'_txtlimit',statusText:'<?php echo $text_length_left ?>'} );

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
            <?php echo $progress ?>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_headline ?></label>
        <div class="col-sm-8 ">
            <pre><?php echo $headline ?></pre>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_post_text ?></label>
        <div class="col-sm-8">
            <pre><?php echo $text ?></pre>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="col-sm-2 control-label"><?php echo $text_note ?></label>
        <div class="col-sm-8">
            <pre><?php echo $note ?></pre>
        </div>
    </div>
<?php }?>