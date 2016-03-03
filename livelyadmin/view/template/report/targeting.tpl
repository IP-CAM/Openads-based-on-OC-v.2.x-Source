<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="button" class="btn btn-default" id="btn-config" data-toggle="tooltip" title="<?php echo $button_config?>">
                    <i class="fa fa-wrench"></i>
                </button>
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
        <div class="do-result">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                <div class="pull-right">
                    <a class="btn btn-sm btn-default" onclick="$('#filter-column').slideToggle();">
                        <i class="fa fa-filter"></i> <?php echo $button_filter; ?>
                    </a>
                    <a class="btn btn-sm btn-default" id="btn-export" >
                        <span class="glyphicon glyphicon-export"></span> <?php echo $button_export; ?>
                    </a>
                </div>                
            </div>
            <div class="panel-body">
                <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
                    <div class="row filter">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                <input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id;?>">
                            </div>                   
                            <div class="form-group">
                                <label class="control-label" for="input-target-url"><?php echo $entry_target_url; ?></label>
                                <input type="text" name="filter_target_url" value="<?php echo $filter_target_url; ?>" placeholder="<?php echo $entry_target_url; ?>" id="input-target-url" class="form-control" />
                            </div>
                        </div>                    
                        <div class="col-sm-2">
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
                        <div class="col-sm-2">
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
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-advertise-sn"><?php echo $entry_advertise_sn; ?></label>
                                <input type="text" name="filter_advertise_sn" value="<?php echo $filter_advertise_sn; ?>" placeholder="<?php echo $entry_advertise_sn; ?>" id="input-advertise-sn" class="form-control" />
                            </div> 
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                                <select name="filter_publish" id="input-publish" class="form-control" multiple="multiple">
                                    
                                    <?php foreach ($report_publishes as $k => $item) { ?>
                                    <?php if (in_array($k,$filter_publish)) { ?>
                                    <option value="<?php echo $k; ?>" selected="selected"><?php echo $item['text']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $k; ?>">
                                    <?php echo $item['text']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>                            
                        </div>    

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-targeting-sn"><?php echo $entry_targeting_sn; ?></label>
                                <input type="text" name="filter_targeting_sn" value="<?php echo $filter_targeting_sn; ?>" placeholder="<?php echo $entry_targeting_sn; ?>" id="input-targeting-sn" class="form-control" />
                            </div>                        
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="form-report">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center"><?php if ($sort == 'a.advertise_sn') { ?>
                                        <a href="<?php echo $sort_advertise_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_advertise_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_advertise_sn; ?>"><?php echo $column_advertise_sn; ?></a>
                                        <?php } ?>
                                    </td>
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
                                    <td class="text-center"><?php if ($sort == 'at.publish') { ?>
                                        <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                        <?php } ?>
                                    </td>                                     
                                    <td class="text-center"><?php if ($sort == 'customer') { ?>
                                        <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left" style="width: 22%;"><?php if ($sort == 'at.target_url') { ?>
                                        <a href="<?php echo $sort_target_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_url; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_target_url; ?>"><?php echo $column_target_url; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'ad.ad_account') { ?>
                                        <a href="<?php echo $sort_account; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_account; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_account; ?>"><?php echo $column_account; ?></a>
                                        <?php } ?>
                                    </td>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($records) { ?>
                                <?php foreach ($records as $item) { ?>
                                <tr class="<?php echo $item['class']?>">
                                    <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                    <td class="text-center">
                                        <?php echo $item['targeting_sn']; ?>
                                    </td>
                                    <td class="text-center"><?php echo $item['product']; ?></td>
                                    <td class="text-center"><?php echo $item['location']; ?></td>
                                    <td class="text-center"><?php echo $item['gender']; ?></td>
                                    <td class="text-center"><?php echo $item['age']; ?></td>
                                    <td class="text-center"><?php echo $item['language']; ?></td>
                                    <td class="text-center"><?php echo $item['interest']; ?></td>
                                    <td class="text-center"><?php echo $item['audience']; ?></td>
                                    <td class="text-center"><?php echo $item['publish']; ?></td>
                                    <td class="text-center"><?php echo $item['customer']; ?></td>
                                    <td class="text-left" style="width: 22%;">
                                        <a href="<?php echo $item['target_url'] ?>" target="_blank"><?php echo $item['target_url']; ?></a>
                                    </td>
                                    <td class="text-center"><?php echo $item['account']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="13"><?php echo $text_no_results; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="config-dialog"><?php echo $config_tpl ?></div>
<script type="text/javascript" src="<?php echo TPL_JS ?>form.js"></script>
<script type="text/javascript" src="<?php echo TPL_JS ?>bsmultiselect/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo TPL_JS ?>bsmultiselect/css/bootstrap-multiselect.css" type="text/css"/>
<script type="text/javascript"><!--
$(document).ready(function() {
    $('#input-publish').multiselect();
});
$('#btn-export').bind('click',function(){
    $.ajax({
        'url':'index.php?route=report/targeting/export&token=<?php echo $token?>',
        'type':'Post',
        'data':{'data':'<?php echo json_encode($records);?>'},
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

$('#button-filter').on('click', function() {
    url = 'index.php?route=report/targeting&token=<?php echo $token; ?>';
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

$('#input-customer').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
            dataType: 'json',           
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['username']+' '+item['name'],
                        value: item['customer_id']
                    }
                }));
            }
        });
    },
    'select': function(event,ui) {
        $(this).val(ui.item['label']);
        $('input[name=\'filter_customer_id\']').val(ui.item['value']);
        return false;
    },
    'focus':function(event,ui){
        return false;
    }
});

$('input[name^=\'selected\']:first').trigger('change');
$('#btn-config').bind('click',function(){
    $('#config-dialog').dialog('open');
});
$('#config-dialog').dialog({
    width:680,
    height:600,
    autoOpen:false,
    title:'<?php echo $text_report_config;?>',
    buttons:{
        '<?php echo $button_save; ?>':function(){
            
            $('#config-form').ajaxSubmit({
                'url':'index.php?route=report/targeting/config&token=<?php echo $token?>',
                'type':'post',
                'dataType':'json',
                'beforeSubmit':function(){
                    $('#config-dialog .do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG ?>loading.gif"> <?php echo $text_waiting;?> </div>');
                },
                'success':function(json){
                    if(json.status ==1){
                        $('#config-dialog .do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
                        setTimeout('location.reload();',3000);
                    }else{
                        $('#config-dialog .do-result').html('<div class="alert alert-warning">'+json.msg+'</div>');
                    }
                }
            });
            
        },
        '<?php echo $button_close; ?>':function(){
            $(this).dialog('close');
        }
    }
});

$('a[id^=\'button-delete\']').on('click', function(e) {
    e.preventDefault();
    if (confirm('<?php echo $text_confirm; ?>')) {location = $(this).attr('href');}
});

$('.date').datetimepicker({ pickTime: false});
//--> 
</script>
<style type="text/css">
    .multiselect-container>li>a>label>input[type=checkbox] { margin-bottom: -1px; }
    tr.indesign td{color:#000000;font-weight: bold;}
    tr.indesign a{color:#000000;}
    tr.waiting td{color:#0066cc;font-weight: bold;}
    tr.waiting a{color:#0066cc;}
    tr.doing td{color:#ffcc00;font-weight: bold;}
    tr.doing a{color:#ffcc00;}
    tr.running td{color:#008000;font-weight: bold;}
    tr.running a{color:#008000;}
    tr.banned td{color:#808080;text-decoration: line-through;}
    tr.banned a{color:#808080;}

</style>
<?php echo $footer; ?>