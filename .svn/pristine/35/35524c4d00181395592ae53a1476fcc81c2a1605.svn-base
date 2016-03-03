<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right" style="display:none;">
                <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                <div class="pull-right">
                    <a class="btn btn-info btn-link" onclick="$('#filter-columns').slideToggle();">
                        <?php echo $text_filter_toggle;?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="well" id="filter-columns" style="display: none;">
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-ad-account"><?php echo $entry_ad_account; ?></label>
                                <input type="text" name="filter_ad_account" value="<?php echo $filter_ad_account; ?>" placeholder="<?php echo $entry_ad_account; ?>" id="input-ad-account" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                                <select name="filter_publish" id="input-publish" class="form-control"  multiple="multiple">
                                    <?php foreach ($ad_publishes as $item) { ?>
                                    <?php if (in_array($item['publish_id'],$filter_publish)) { ?>
                                    <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['publish_id']; ?>">
                                    <?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>                            
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="input-progress" class="control-label"><?php echo $entry_progress ?></label>
                                <input type="text" name="filter_progress" class="form-control" value="<?php echo $filter_progress?>" placeholder="<?php echo $entry_progress; ?>" id="input-progress" >
                            </div>
                            <div class="form-group">
                                <label for="input-targeting-sn" class="control-label"><?php echo $entry_targeting_sn ?></label>
                                <input type="text" name="filter_targeting_sn" class="form-control" value="<?php echo $filter_targeting_sn?>" placeholder="<?php echo $entry_targeting_sn; ?>" id="input-targeting-sn" >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-target_url"><?php echo $entry_target_url; ?></label>
                                <input type="text" name="filter_target_url" value="<?php echo $filter_target_url; ?>" placeholder="<?php echo $entry_target_url; ?>" id="input-target_url" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                <input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id?>">
                            </div>

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-in-charge"><?php echo $entry_in_charge; ?></label>
                                <select name="filter_in_charge" id="input-in-charge" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($managers as $item) { ?>
                                    <?php if ($item['user_id'] == $filter_in_charge) { ?>
                                    <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div> 
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_product; ?></label>
                                <select name="filter_product" id="input-product" class="form-control">
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
                            
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-modified-start"><?php echo $entry_modified_start; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" data-date-format="YYYY-MM-DD" id="input-modified-start" class="form-control" />
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-modified-end"><?php echo $entry_modified_end; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end; ?>" placeholder="<?php echo $entry_modified_end; ?>" data-date-format="YYYY-MM-DD" id="input-modified-end" class="form-control" />
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label class="control-label" for="input-ad-sn"><?php echo $entry_ad_sn; ?></label>
                                <input type="text" name="filter_ad_sn" value="<?php echo $filter_ad_sn; ?>" placeholder="<?php echo $entry_ad_sn; ?>" id="input-ad-sn" class="form-control" />
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-center"><?php if ($sort == 'a.advertise_sn') { ?>
                                        <a href="<?php echo $sort_ad; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_ad; ?>"><?php echo $column_ad_sn; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.product_id') { ?>
                                        <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'a.target_url') { ?>
                                        <a href="<?php echo $sort_target_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_url; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_target_url; ?>"><?php echo $column_target_url; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'customer') { ?>
                                        <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.progress') { ?>
                                        <a href="<?php echo $sort_progress; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_progress; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_progress; ?>"><?php echo $column_progress; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.ad_account') { ?>
                                        <a href="<?php echo $sort_ad_account; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_account; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_ad_account; ?>"><?php echo $column_ad_account; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'att.targeting_sn') { ?>
                                        <a href="<?php echo $sort_targeting_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_targeting_sn; ?>"><?php echo $column_targeting_sn; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'at.location') { ?>
                                        <a href="<?php echo $sort_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_location; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_location; ?>"><?php echo $column_location; ?></a>
                                        <?php } ?>
                                    </td>                                    
                                    <td class="text-center"><?php if ($sort == 'a.publish') { ?>
                                        <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.in_charge') { ?>
                                        <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'a.date_modified') { ?>
                                        <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($advertises) { ?>
                                <?php foreach ($advertises as $item) { ?>
                                <tr>
                                    <td class="text-center"><?php if (in_array($item['advertise_id'], $selected)) { ?>
                                          <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" checked="checked" />
                                          <?php } else { ?>
                                          <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" />
                                          <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['product']; ?></td>
                                    <td class="text-left" style="width:16%;word-break:break-all;">
                                        <a target="_blank" href="<?php echo $item['target_url'] ?>"  >
                                            <?php echo lively_truncate($item['target_url'],60); ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $item['customer'] ?></td>
                                    <td class="text-center"><?php echo $item['progress']; ?></td>
                                    <td class="text-center"><?php echo $item['ad_account']; ?></td>
                                    <td class="text-center"><?php echo $item['targeting_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['location']; ?></td>
                                    <td class="text-center"><?php echo $item['publish_text']; ?></td>
                                    <td class="text-center"><?php echo $item['charger']; ?></td>
                                    <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                    <td class="text-center">
                                        <?php if( false && $item['msg']){ ?>
                                        <span class="label label-danger pull-left"><?php echo $item['msg'] ?></span>
                                        <?php }?>
                                        <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                    </td>
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
<script type="text/javascript" src="<?php echo TPL_JS ?>bsmultiselect/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo TPL_JS ?>bsmultiselect/css/bootstrap-multiselect.css" type="text/css"/>
<script type="text/javascript"><!--
$(document).ready(function() {
    $('#input-publish').multiselect();
});

$('#button-filter').on('click', function() {
    url = 'index.php?route=service/publish&token=<?php echo $token; ?>';
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
            url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
    'select': function(item) {
        $('#input-customer').val(item['label']);
        $('input[name=\'filter_customer_id\']').val(item['value']);
    } 
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
    e.preventDefault();
    if (confirm('<?php echo $text_confirm; ?>')) {location = $(this).attr('href');}
});

$('.date').datetimepicker({ pickTime: false});

//-->
</script>
<style type="text/css">
    .multiselect-container>li>a>label>input[type=checkbox] {margin-bottom: -1px;}
</style>
<?php echo $footer; ?>