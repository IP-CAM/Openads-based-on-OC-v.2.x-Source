<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">

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
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> <?php echo $success; ?>
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
                                <label class="control-label" for="input-ad-sn"><?php echo $entry_ad_sn; ?></label>
                                <input type="text" name="filter_ad_sn" value="<?php echo $filter_ad_sn; ?>" placeholder="<?php echo $entry_ad_sn; ?>" id="input-ad-sn" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-targeting"><?php echo $entry_targeting; ?></label>
                                <select name="filter_targeting" id="input-targeting" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($targeting_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_targeting) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_product; ?></label>
                                <select name="filter_product" id="input-product" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($products as $item) { ?>
                                    <?php if ($item['product_id'] == $filter_product) { ?>
                                    <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['code'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-post"><?php echo $entry_post; ?></label>
                                <select name="filter_post" id="input-post" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_post) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                <input name="filter_customer_id" type="hidden" value="<?php echo $filter_customer_id?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-photo"><?php echo $entry_photo; ?></label>
                                <select name="filter_photo" id="input-photo" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($photo_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_photo) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
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

                        </div>
                        <div class="col-sm-3">
                            <div class="form-group clearfix">
                                <label class="control-label" for="input-modified"><?php echo $entry_date_modified; ?></label>
                                <div class="input-group" id="input-modified">
                                    <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" data-date-format="YYYY-MM-DD" id="input-modified-start" class="form-control date" />
                                    <div class="input-group-addon"><i class="fa fa-arrows-h"></i> </div>
                                    <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end; ?>" placeholder="<?php echo $entry_modified_end; ?>" data-date-format="YYYY-MM-DD" id="input-modified-end" class="form-control date" />
                                </div>
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
                                    <td class="text-center"><?php if ($sort == 'a.date_modified') { ?>
                                        <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } ?>
                                    </td>
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
                                    <td class="text-center"><?php if ($sort == 'a.in_charge') { ?>
                                        <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.targeting') { ?>
                                        <a href="<?php echo $sort_targeting; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_targeting; ?>"><?php echo $column_targeting; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.post') { ?>
                                        <a href="<?php echo $sort_post; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_post; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_post; ?>"><?php echo $column_post; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.photo') { ?>
                                        <a href="<?php echo $sort_photo; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_photo; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_photo; ?>"><?php echo $column_photo; ?></a>
                                        <?php } ?>
                                    </td>
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
                                    <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                    <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['product']; ?></td>
                                    <td class="text-center"><?php echo $item['charger']; ?></td>
                                    <td class="text-center"><?php echo $item['targeting']; ?></td>
                                    <td class="text-center"><?php echo $item['post']; ?></td>
                                    <td class="text-center"><?php echo $item['photo']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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

<script type="text/javascript"><!--

function detail(ad_id,mode){
    $('#component-detail').remove();
    $('#container').append('<div id="component-detail"></div>');
    $('#component-detail').load(
            'index.php?route=service/advertise_transfer/component&token=<?php echo $token ?>',
            {mode:mode,advertise_id:ad_id}
        ).dialog({
            autoOpen:true,
            width: 600,
            resizable:false,
        });
}

$('#button-filter').on('click', function() {
	url = 'index.php?route=service/advertise_transfer&token=<?php echo $token; ?>';
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
    'delay':500,
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
        $('#input-customer').val(ui.item['label']);
        $('input[name="filter_customer_id"]').val(ui.item['value']);
        return false;
    },
    focus: function(event, ui) {
        return false;
    }    
});

$('input[name^=\'selected\']:first').trigger('change');


$('.date').datetimepicker({	pickTime: false});
//--></script>

<?php echo $footer; ?>