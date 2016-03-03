<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
    </ul>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    </div>
    <?php } ?>
    <div class="row">
        <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
        <div id="content" class="col-sm-9">
            <div class="do-result">
                
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
                </div>            
                <div class="panel-body">
                    <div class="well" id="filter-column" <?php //echo $filter_column ? '' : 'style="display:none ;"'?>>
                        <div class="row filter">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                                    <select name="filter_publish" id="input-product" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($products as $item) { ?>
                                        <?php if ($item['product_id'] == $filter_product) { ?>
                                        <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['code'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['product_id']; ?>">
                                        <?php echo $item['code'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-location"><?php echo $entry_location; ?></label>
                                    <select name="filter_location" id="input-location" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($countries as $item) { ?>
                                        <?php if ($item['targeting_id'] == $filter_location) { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>" selected="selected"><?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>">
                                        <?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-language"><?php echo $entry_language; ?></label>
                                    <select name="filter_language" id="input-language" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($languages as $item) { ?>
                                        <?php if ($item['targeting_id'] == $filter_language) { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>" selected="selected"><?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>">
                                        <?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>       
                    
                                <div class="form-group">
                                    <label class="control-label" for="input-interest"><?php echo $entry_interest; ?></label>
                                    <input type="text" name="filter_interest" value="<?php echo $filter_interest; ?>" placeholder="<?php echo $entry_interest; ?>" id="input-interest" class="form-control" />
                                </div>    

                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-targeting-sn"><?php echo $entry_targeting_sn; ?></label>
                                    <input type="text" name="filter_targeting_sn" value="<?php echo $filter_targeting_sn; ?>" placeholder="<?php echo $entry_targeting_sn; ?>" id="input-targeting-sn" class="form-control" />
                                </div>   
                                <div class="form-group">                     
                                    <a class="btn btn-primary" id="btn-filter">
                                        <i class="fa fa-search"></i> <?php echo $button_filter; ?>
                                    </a>
                                    <a class="btn btn-primary" id="btn-export" >
                                        <span class="glyphicon glyphicon-export"></span> <?php echo $button_export; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data" id="form-report">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-center"> <?php echo $column_id; ?></td>
                                        <td class="text-center"><?php if ($sort == 'at.targeting_sn') { ?>
                                            <a href="<?php echo $sort_targeting_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting_sn; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_targeting_sn; ?>"><?php echo $column_targeting_sn; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'a.product_id') { ?>
                                            <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.location') { ?>
                                            <a href="<?php echo $sort_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_location; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_location; ?>"><?php echo $column_location; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.gender') { ?>
                                            <a href="<?php echo $sort_gender; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_gender; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_gender; ?>"><?php echo $column_gender; ?></a>
                                            <?php } ?>
                                        </td>       
                                        <td class="text-center"><?php if ($sort == 'at.age_min') { ?>
                                            <a href="<?php echo $sort_age; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_age; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_age; ?>"><?php echo $column_age; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.language') { ?>
                                            <a href="<?php echo $sort_language; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_language; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_language; ?>"><?php echo $column_language; ?></a>
                                            <?php } ?>
                                        </td>                                    
                                        <td class="text-center"><?php if ($sort == 'at.interest') { ?>
                                            <a href="<?php echo $sort_interest; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_interest; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_interest; ?>"><?php echo $column_interest; ?></a>
                                            <?php } ?>
                                        </td>        
                                        <td class="text-center"><?php if ($sort == 'at.audience') { ?>
                                            <a href="<?php echo $sort_audience; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_audience; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_audience; ?>"><?php echo $column_audience; ?></a>
                                            <?php } ?>
                                        </td> 
                                        <?php if(0){?>
                                        <td class="text-center"><?php if ($sort == 'at.status') { ?>
                                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                            <?php } ?>
                                        </td> 
                                        <?php }?>     
                                        <td class="text-right"></td>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records) { ?>
                                    <?php foreach ($records as $item) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $item['id']; ?></td>
                                        <td class="text-center"><?php echo $item['targeting_sn']; ?></td>
                                        <td class="text-center"><?php echo $item['product']; ?></td>
                                        <td class="text-center"><?php echo $item['location']; ?></td>
                                        <td class="text-center"><?php echo $item['gender']; ?></td>
                                        <td class="text-center"><?php echo $item['age']; ?></td>
                                        <td class="text-center"><?php echo $item['language']; ?></td>
                                        <td class="text-center"><?php echo $item['interest']; ?></td>
                                        <td class="text-center"><?php echo $item['audience']; ?></td>
                                        <?php if(0){?>
                                        <td class="text-center"><?php echo $item['status']; ?></td>
                                        <?php }?>
                                        <td class="text-right actions" data-entry="<?php echo $item['template_id']?>">
                                            <button type="button" class="btn btn-primary btn-xs btn-edit">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="11"><?php echo $text_no_results; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="template-dialog">
    <div class="do-result"></div>
    <form id="template-form" method="post" action="<?php echo $edit_action;?>">
        <div class="col-sm-12">
            <input name="template" type="hidden">
            <div class="form-group clearfix required ">
                <label class="col-sm-3 control-label text-right" for="input-product"><?php echo $entry_product ?></label>
                <div class="col-sm-8">
                    <select name="product_id" class="form-control">
                    <?php foreach ($products as $item): ?>
                    <option value="<?php echo $item['product_id'] ?>"><?php echo $item['code'].' '.$item['name'] ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group clearfix required">
                <label class="col-sm-3 control-label text-right"><?php echo $text_targeting_sn ?></label>
                <div class="col-sm-8">
                    <input name="targeting_sn" class="form-control">
                </div>
            </div>

            <div class="form-group clearfix required">
                <label class="col-sm-3 control-label text-right"><?php echo $text_location ?></label>
                <div class="col-sm-8">
                    <?php foreach ($countries as $item): ?>
                    <label class="checkbox-inline">
                        <input type="checkbox" name="location[]" value="<?php echo $item['targeting_id'] ?>" class="_location" />
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
            <div class="form-group clearfix required">
                <label class="col-sm-3 control-label text-right"><?php echo $text_age ?></label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <select class="form-control" style="width:80px;margin-right:20px;" name="age_min" data-toggle="tooltip" title="<?php echo $text_age_min ?>" >
                            <?php for ($i=13; $i <66; $i++) { ?>
                            <option value="<?php echo $i ?>" <?php echo $i==18 ? 'selected="selected"' : '' ?>>
                            <?php echo $i ?>
                            </option>
                            <?php }?>
                        </select>

                        <select class="form-control" style="width:80px" name="age_max" data-toggle="tooltip" title="<?php echo $text_age_max ?>">
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
                        <input type="radio" name="gender" value="<?php echo $item['targeting_id'] ?>" />
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
                        <input type="checkbox" name="language[]" value="<?php echo $item['targeting_id'] ?>" class="_language" />
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
            <div class="form-group clearfix">
                <label class="col-sm-3 control-label text-right"><?php echo $text_interest ?></label>
                <div class="col-sm-8">
                    <textarea name="interest" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="col-sm-3 control-label text-right"><?php echo $text_behavior ?></label>
                <div class="col-sm-8">
                    <textarea name="behavior" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="col-sm-3 control-label text-right"><?php echo $text_more ?></label>
                <div class="col-sm-8">
                    <textarea name="more" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group clearfix">
                <label class="col-sm-3 control-label text-right"><?php echo $text_audience ?></label>
                <div class="col-sm-8">
                    <input name="audience" class="form-control">
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"><!-- 
$(function() {
    $('#template-form').formValidation({
        icon: false,
        fields: {
            'targeting_sn':{
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
            'location':{
                selector: '#template-form ._location',
                validators: {
                    callback:{
                        message: '<?php echo $error_location ?>',
                        callback: function(value, validator, $field){                            
                            var checked = $('#template-form').find('[name^="location"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#template-form').find('[name="other_location"]').val()).length;
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
            'language':{
                selector: '#template-form ._language',
                validators: {
                    callback:{
                        message: '<?php echo $error_language ?>',
                        callback: function(value, validator, $field){
                            
                            var checked = $('#template-form').find('[name^="language"]:checked').length;
                            if(checked > 0){
                                return true;
                            }
                            var txt_leng = $.trim($('#template-form').find('[name="other_language"]').val()).length;
                            if(txt_leng > 1){
                                return true;
                            }
                            return  false ;          
                        }
                    }
                }
            },
            'audience':{
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
                    $('#template-dialog .do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
                    setTimeout('location.reload();',1500);
                }
            }, 
        'json');
    })    
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
//-->
</script>
<script type="text/javascript"><!--

$('.btn-edit').bind('click',function(){
    $('#template-dialog textarea,#template-dialog .do-result').html('');
    $('#template-dialog input[type="text"]').val('');
    $.get('index.php?route=account/template/detail',{template:$(this).parent().attr('data-entry')},function(json){
        if(json.status==1){
            var tpl = json['data'];
            if($.isArray(tpl['location'])){
                $.each($('#template-dialog input[name^="location"]'),function(){
                    $(this).removeProp('checked');
                })
                for (var i in tpl['location']) {
                    $('#template-dialog input[name^="location"][value="'+tpl['location'][i]+'"]').prop('checked',true);
                }
            }
            if($.isArray(tpl['language'])){
                $.each($('#template-dialog input[name^="language"]'),function(){
                    $(this).removeProp('checked');
                })                
                for (var i in tpl['language']) {
                    $('#template-dialog input[name^="language"][value="'+tpl['language'][i]+'"]').prop('checked',true);
                }
            }
            $('#template-dialog input[name="template"]').val(tpl['template_id']);
            $('#template-dialog select[name="product_id"]').val(tpl['product_id']);
            $('#template-dialog input[name="targeting_sn"]').val(tpl['targeting_sn']);
            $('#template-dialog input[name="age_min"]').val(tpl['age_min']);
            $('#template-dialog input[name="age_max"]').val(tpl['age_max']);
            $('#template-dialog input[name="gender"][value="'+tpl['gender']+'"]').prop('checked',true);
            $('#template-dialog input[name="audience"]').val(tpl['audience']);
            $('#template-dialog textarea[name="interest"]').val(tpl['interest']);
            $('#template-dialog textarea[name="behavior"]').val(tpl['behavior']);
            $('#template-dialog textarea[name="more"]').val(tpl['more']);            
            $('#template-dialog').dialog('option',{title:'<?php echo $text_title_detail?>'}).dialog('open');
            if(tpl['ads']>0){
                $('#template-dialog .do-result').html('<div class="alert alert-warning">'+tpl['text_used']+'</div>');
                $('#template-dialog').dialog('option',{buttons:{
                    '<?php echo $button_close?>':function(){
                        $(this).dialog('close');
                    }
                }})
            }else{
                $('#template-dialog').dialog('option',{ buttons:{
                    '<?php echo $button_save ?>':function() {
                        $('#template-dialog form').submit();
                    },
                    '<?php echo $button_delete ?>':function() {
                        if(confirm('<?php echo $text_confirm_delete ?>')){
                            $.ajax({
                                url:'index.php?route=account/template/delete',
                                type:'post',
                                data:{template:$(this).parent().attr('data-entry')},
                                dataType:'json',
                                success:function(json){
                                    if(json.status ==1){
                                        $('.do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
                                        location.reload();
                                    }else{
                                        $('.do-result').html('<div class="alert alert-warning">'+json.msg+'</div>');
                                    }
                                }
                            })    
                        }
                    }
                }})                
            }
        }else{
            alert('<?php echo $text_exception;?>')
        }
    },'json');
});

$('#template-dialog').dialog({title:'<?php echo $text_title_new ;?>',width:680,autoOpen:false});

$('#btn-export').bind('click',function(){
    $.ajax({
        'url':'index.php?route=account/template/export',
        'type':'Post',
        'data':{'filter':'<?php echo json_encode($filter);?>'},
        'dataType':'json',
        'beforeSubmit':function(){
            $('.do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG ?>loading.gif"> <?php echo $text_waiting;?> </div>');
        },        
        'success':function(json){
            $('.alert').remove();
            if(json.status ==1){
                $('.do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
            }else{
                $('.do-result').html('<div class="alert alert-warning">'+json.msg+'</div>');
            }
        }
    });
});

$('#btn-filter').on('click', function() {
    url = 'index.php?route=account/template';
     var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
        if($(this).val() && $(this).val()!='*'){
            paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
        }
    });
    if(paramArr.length>0){
        url+="&"+paramArr.join("&");
    }
    location = url;
});

//-->
</script> 
<style type="text/css">
    .actions .btn{padding: 5px 8px;}
</style>
<?php echo $footer; ?>