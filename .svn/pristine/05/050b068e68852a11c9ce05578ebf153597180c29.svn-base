<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">      
            <div class="pull-right">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_reset; ?>" class="btn btn-primary" id="btn-statistics"><i class="fa fa-refresh"></i></button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a>
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
            </div>
            <div class="panel-body">
                <div class="well" style="display:none">
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-ad-id"><?php echo $entry_ad_id; ?></label>
                                <input type="text" name="filter_ad_id" value="<?php echo $filter_ad_id; ?>" placeholder="<?php echo $entry_ad_id; ?>" id="input-ad-id" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-targeting"><?php echo $entry_targeting; ?></label>
                                <select name="filter_targeting" id="input-targeting" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($targeting_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_targeting) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-target_url"><?php echo $entry_target_url; ?></label>
                                <input type="text" name="filter_target_url" value="<?php echo $filter_target_url; ?>" placeholder="<?php echo $entry_target_url; ?>" id="input-target_url" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-post"><?php echo $entry_post; ?></label>
                                <select name="filter_post" id="input-post" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_post) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-photo"><?php echo $entry_photo; ?></label>
                                <select name="filter_photo" id="input-photo" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($photo_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_photo) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
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
                                    <?php foreach ($contributors as $item) { ?>
                                    <?php if ($item['user_id'] == $filter_in_charge) { ?>
                                    <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                                <select name="filter_publish" id="input-publish" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($ad_publishes as $item) { ?>
                                    <?php if ($item['publish_id'] == $filter_publish) { ?>
                                    <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
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
                                <label class="control-label" for="input-publish"><?php echo $entry_product; ?></label>
                                <select name="filter_product" id="input-product" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($products as $item) { ?>
                                    <?php if ($item['product_id'] == $filter_product) { ?>
                                    <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['product_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center"><?php if ($sort == 'a.user_id') { ?>
                                        <a href="<?php echo $sort_operator; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_operator; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_operator; ?>"><?php echo $column_operator; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'targeting_score') { ?>
                                        <a href="<?php echo $sort_targeting; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_targeting; ?>"><?php echo $column_targeting; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'post_score') { ?>
                                        <a href="<?php echo $sort_post; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_post; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_post; ?>"><?php echo $column_post; ?></a>
                                        <?php } ?>
                                    </td>
                                    
                                    <td class="text-center"><?php if ($sort == 'photo_score') { ?>
                                        <a href="<?php echo $sort_photo; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_photo; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_photo; ?>"><?php echo $column_photo; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'score') { ?>
                                        <a href="<?php echo $sort_score; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_score; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_score; ?>"><?php echo $column_score; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $column_date; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($records) { ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td class="text-center">
                                        <b class="total-score"><?php echo $total_score ?></b>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php foreach ($records as $item) { ?>
                                
                                <tr>
                                    <td class="text-center"><?php echo $item['operator']; ?></td>
                                    <td class="text-center" style="vertical-align:top;">
                                        <?php echo $item['targeting']; ?>
                                    </td>
                                    <td class="text-center" style="vertical-align:top;">
                                        <?php echo $item['post']; ?>
                                    </td>
                                    <td class="text-center" style="vertical-align:top;">
                                        <?php echo $item['photo']; ?>
                                    </td>                                  
                                    <td class="text-center">
                                        <b class="total-score"><?php echo $item['score']; ?></b>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $item['min_date']; ?> 
                                        <br>-<br> 
                                        <?php echo $item['max_date']; ?> 
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
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
$('#btn-statistics').bind('click',function(){
    if(confirm(' ReStatistics ?')){
        $.ajax({
            url:'index.php?route=report/report/ajax_data&token=<?php echo $token; ?>',
            type:'post',
            dataType:'json',
            data:{action:'statistics'},
            success:function(data){
                if(data.status == 0){
                    alert('Exception!');
                }else{
                    location.reload();
                }
            }
        });
        
    }
});
$('#button-filter').on('click', function() {
    url = 'index.php?route=report/report&token=<?php echo $token; ?>';
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

$('input[name=\'filter_customer\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
            dataType: 'json',           
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['name'],
                        value: item['customer_id']
                    }
                }));
            }
        });
    },
    'select': function(item) {$('input[name=\'filter_customer\']').val(item['label']);} 
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
    e.preventDefault();
    if (confirm('<?php echo $text_confirm; ?>')) {location = $(this).attr('href');}
});

$('.date').datetimepicker({ pickTime: false});
//--></script>
<style type="text/css">
.bootstrap-dialog .bootstrap-dialog-title {
  color: #333;font-weight: bold;
}
</style>
<?php echo $footer; ?>