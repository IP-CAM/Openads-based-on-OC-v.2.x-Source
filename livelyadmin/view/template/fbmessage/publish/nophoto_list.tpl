<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <?php if($promotion_group){ ?>
                <a id="btn-bulk" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_bulk; ?>"><i class="fa fa-paw"></i></a>   
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-post').submit() : false;"><i class="fa fa-trash-o"></i></button>             
                <a id="btn-import" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_import; ?>"><span class="glyphicon glyphicon-import"></span></a>
                <a onclick="$('#filter-column').hide();$('#export-form').slideToggle();" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_export; ?>"><span class="glyphicon glyphicon-export"></span></a>
                <?php } ?>
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
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> <?php echo $text_list; ?>
                </h3>
                <div class="pull-right">
                    <a class="btn btn-sm btn-default" onclick="$('#export-form').hide();$('#filter-column').slideToggle();">
                        <i class="fa fa-filter"></i> Filters
                    </a>
                </div>
            </div>
            
            <div class="panel-body">
                <?php if($promotion_group){ ?>
                <div class="well" id="export-form" style="display: none">
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" for="mode-link" style="width: 150px">Only Export Target URL:</label>
                        <input type="checkbox" onclick="$('.not-link').slideToggle();" value="link" name="mode" />
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" id="btn-export"><span class="glyphicon glyphicon-export"></span> Export Posts</button>
                    </div>
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" style="width: 150px">Number of Short URL:</label>
                        <select name="filter_url_operator" class="form-control">
                            <option value="*"> </option>
                            <option value="dy">&gt;</option>
                            <option value="xy">&lt;</option>
                            <option value="=">=</option>
                        </select>
                        <input type="text" name="filter_url_number" value="5" class="form-control" style="width: 35px;"/>
                        
                    </div>
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" style="width: 150px">Link Num (<i>In URL.csv</i>):</label>
                        <input type="text" name="link_num" value="10" class="form-control" style="width: 99px;" />
                    </div>

                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Status:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-status">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-status">None</button></label>
                        <div id="ex-status">
                            <?php foreach ($post_statuses as $item) { ?>
                            <div style="display: inline-block;width: 150px;">
                                <input type="checkbox" name="filter_statuses[]" value="<?php echo $item['status_id'] ?>" <?php echo in_array($item['status_id'], $level_status) ? 'checked' : ''  ?> >
                                <?php echo $item['name']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Post Status:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-publish">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-publish">None</button></label>
                        <div id="ex-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                            <div style="display: inline-block;width: 150px;">
                                <input type="checkbox" name="filter_publishes[]" value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $promoting_publish ? 'checked' : '' ?>><?php echo $item['name']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Products:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-product">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-product">None</button></label>
                        <div id="ex-product">
                            <?php foreach ($all_products as $item) { ?>
                            <div style="display: inline-block;width: 140px;">
                                <input type="checkbox" name="filter_products[]" value="<?php echo $item['product_id'] ?>" checked><?php echo $item['code'].' '.$item['name'] ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>                    
                </div>
                <?php }?>            
                <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo str_replace('<br>', ' ', $column_date_modified)  ?></label>
                                <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>"  class="date form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_author ?></label>
                                <select name="filter_author" class="form-control" >
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['user_id'] == $filter_author) { ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['nickname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['user_id']; ?>">
                                    <?php echo $user['nickname']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo str_replace('<br>', ' ', $column_auditor)  ?></label>
                                <select name="filter_user_id" class="form-control" >
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['user_id'] == $filter_user_id) { ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['nickname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['user_id']; ?>">
                                    <?php echo $user['nickname']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_status ?></label>
                                <select name="filter_status" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_status) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_publish ?></label>
                                <select name="filter_publish" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_publishes as $item) { ?>
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
                                <label for="" class="control-label"><?php echo $column_product ?></label>
                                <select name="filter_product_id" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($all_products as $item) { ?>
                                    <option value="<?php echo $item['product_id'] ?>" <?php echo $item['product_id']==$filter_product_id ? 'selected' : '' ?>><?php echo $item['code'] ?> <?php echo $item['name'] ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_entry?></label>
                                <input type="text" name="filter_entry" value="<?php echo $filter_entry; ?>" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_contribute_sn ?></label>
                                <input type="text" name="filter_contribute_sn" value="<?php echo $filter_contribute_sn;?>" class="form-control">
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
                <form action="<?php echo $delete;?>" method="post" id="form-post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <td width="1" style="text-align: center;">
                                    <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                                </td>
                                <td class="text-center">
                                    <?php if ($sort == 'mc.contribute_sn') { ?>
                                    <a href="<?php echo $sort_contribute_sn; ?>" class="<?php echo strtolower($order); ?>" ><?php echo $column_contribute_sn; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_contribute_sn; ?>"><?php echo $column_contribute_sn; ?></a>
                                    <?php } ?>
                                </td>              
                                <td class="text-center"><?php if ($sort == 'author_id') { ?>
                                    <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-left">
                                    <?php if ($sort == 'product') { ?>
                                    <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-left"><?php if ($sort == 'mc.entry_sn') { ?>
                                    <a href="<?php echo $sort_entry_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_entry_sn; ?>"><?php echo $column_entry; ?></a>
                                    <?php } ?>
                                </td>

                                <td class="text-center"><?php if ($sort == 'mc.status') { ?>
                                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center"><?php if ($sort == 'mc.publish') { ?>
                                    <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center"><?php if ($sort == 'mc.user_id') { ?>
                                    <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_auditor; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_user; ?>"><?php echo $column_auditor; ?></a>
                                    <?php } ?>
                                </td>                                
                                <td class="text-center"><?php if ($sort == 'mc.date_modified') { ?>
                                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                    <?php } ?>
                                </td>

                                <td class="text-center"><?php echo $column_action; ?></td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if ($contributes) { ?>
                            <?php foreach ($contributes as $item) { ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $item['contribute_id']; if ($item['selected']) { ?>
                                  <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>" checked="checked" />
                                  <?php } else { ?>
                                  <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>"  />
                                  <?php } ?>
                                </td>            
                                <td class="text-center"><?php echo $item['contribute_sn']; ?></td>
                                <td class="text-center"><?php echo $item['author']; ?></td>
                                <td class="text-left"><?php echo $item['product']; ?></td>              
                                <td class="text-left"><?php echo $item['entry_sn'].' '.$item['entry_name']; ?></td>
                                <td class="text-center"><?php echo $item['status_text']; ?></td>
                                <td class="text-center"><?php echo $item['publish_text']; ?></td>
                                <td class="text-center"><?php echo $item['auditor']; ?></td>
                                <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                <td class="text-center"><?php foreach ($item['action'] as $action) { ?>
                                <a class="btn btn-primary" href="<?php echo $action['href']; ?>" data-toggle="tooltip" title="<?php echo $action['text']; ?>"><i class="fa <?php echo $item['lock'] ? 'fa-lock' : 'fa-eye' ?>"></i></a>
                                  <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr><td class="text-center" colspan="12"><?php echo $text_no_results; ?></td></tr>
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

<script type="text/javascript" src="<?php echo TPL_JS;?>form.js"></script>
<script type="text/javascript">
<!--	
function filter() {
	url = 'index.php?route=fbmessage/publish_nophoto&token=<?php echo $token; ?>';
	var paramArr=[];
	$(".filter input[name],.filter select[name]").each(function(){
	    if($(this).val() && $(this).val() != '*'){
	        paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
	    }
	});
	if(paramArr.length>0){
	    url+="&"+paramArr.join("&");
	}
	location = url;
}

$('.date').datetimepicker({pickTime: false});
//-->
</script>
<?php if($promotion_group){ ?>
<div id="bulk-dialog" style="display:none;">
    <div class="do-result"></div>
    <form method="post" id="bulk-form">
        <div class="form-group">
            <label class="control-label">Status:</label> 
            <select name="_status"  class="form-control">
                <option value="*"><?php echo $text_none;?></option>
                <?php foreach ($post_statuses as $item) { ?>
                <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">PostStatus:</label> 
            <select name="_publish" class="form-control">
                <option value="*"><?php echo $text_none;?></option>
                <?php foreach ($post_publishes as $item) { ?>
                <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </form>
</div>
<script type="text/javascript">
$('#btn-bulk').bind('click',function(){
    $('#bulk-dialog .do-result').empty();
    $('#selected-ids').remove();
    var selecteds = [];
    $('input[name^="selected"]:checked').each(function(){
        selecteds.push($(this).attr('value') );      
    });
    if(selecteds.length > 0){
        var dialog_html = '<h3 class="text-center">Selected :'+selecteds.length+' </h3><input type="hidden" name="selecteds" value="'+selecteds.join()+'">';
        $('#bulk-dialog #bulk-form').prepend('<div id="selected-ids">'+dialog_html+'</div>');
    }else{
        alert('You must select one line at least!');
        return false;
    }
    
    $('#bulk-dialog').dialog({
        title:"Bulk Edit Contributes",
        modal:true,
        width:680,
        buttons:{
            'Save':function(){
                $('#bulk-form').ajaxSubmit({
                    url:'index.php?route=fbmessage/publish_nophoto/bulk&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    success:function(data){
                        if(data.status == 0){
                            $('#bulk-dialog .do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                        }else{
                            $('#bulk-dialog .do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                            location.reload();
                        }
                    }
                });
            }
        }
    });
})
</script>

<div id="import-dialog" style="display:none;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabim-normal" data-toggle="tab">Nomal</a></li>
        <li><a href="#tabim-url" data-toggle="tab">URL</a></li>
        <li><a href="#tabim-dele-url" data-toggle="tab">Delete URL</a></li>
    </ul>
    <div class="tab-content">
        <div id="tabim-normal" class="tab-pane active">
            <div class="do-result"></div>
            <form method="post" enctype="multipart/form-data" >
                <input type="hidden" name="mode" value="normal">
                <dl>
                    <dt>Post Testing file:</dt>
                    <dd><input type="file" name="filename"/></dd>
                </dl>
            </form>
        </div>
        <div id="tabim-url" class="tab-pane">
            <div class="do-result"></div>
            <form method="post" enctype="multipart/form-data" >
                <input type="hidden" name="mode" value="links">
                <dl>    
                    <dt>URL file:</dt>
                    <dd><input type="file" name="filename"/></dd> 
                </dl>
            </form>
        </div>
        <div id="tabim-dele-url" class="tab-pane">
            <div class="do-result"></div>
            <form method="post" enctype="multipart/form-data" >
                <input type="hidden" name="mode" value="dele_links">
                <dl>    
                    <dt>URL file:</dt><dd>
                    <input type="file" name="filename"/></dd> 
                </dl>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
<!-- 

$('#btn-import').bind('click',function(){
    $('#import-dialog .do-result').empty();
    $('#import-dialog').dialog({
        title:'Import',
        width: 680,
        modal:true,
        buttons:{
            'Import':function(){
                $('#import-dialog div.tab-on form').ajaxSubmit({
                    url:'index.php?route=fbmessage/publish_nophoto/import_data&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    beforeSubmit:function(){
                        $('#import-dialog div.tab-on .do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG ?>loading.gif"></div>');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $('#import-dialog div.tab-on .do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                        }else{
                            $('#import-dialog div.tab-on .do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                            $('#import-dialog div.tab-on input[name="filename"]').val('');
                        }
                    }
                });
            }
        }
    });
});

$('#btn-export').bind('click',function(){
    $.ajax({
        url:'index.php?route=fbmessage/publish_nophoto/advanced_export&token=<?php echo $token;?>',
        type:'POST',
        data:$('#export-form input[type="text"],#export-form select,#export-form input[type="checkbox"]:checked'),
        dataType:'json',
        beforeSend:function(){
            $('.do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG?>loading.gif"> Please Waiting ... </div>');
        },
        success:function(data){
            $('.alert').remove();
            if(data.status==1){             
                $('.do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
            }else{
                $('.do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
            }
        }       
    });
});
//-->
</script>

<script type="text/javascript"><!-- 
$('#btn-copy').bind('click',function(){
    $('#copy-dialog').remove();
    var _html = '<div class="do-result"></div><h3 class="text-center">Selected :<span id="_selected">0</span></h3>';
    _html += '<div class="form-group"><label class="control-label">Filter Status:</label><div class="input-group">';
    <?php foreach ($post_statuses as $item) { ?>
    <?php if (in_array($item['status_id'], $level_status)) { ?>
    _html += '<div style="display:inline-block;width:150px">';
    _html += '<input type="checkbox" name="copy_status" value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></div>';
    <?php } ?>
    <?php } ?>
    _html += '</div>';
    $('#container').append('<div id="copy-dialog"><div class="col-sm-12">'+_html+'</div></div>');
    $('#copy-dialog').dialog({
        title:'Copy to with Photo',
        width: 680,
        modal:true,
        buttons:{
          'Copy':function(){
                var copy_status = [];
                $('#copy-dialog input[name="copy_status"]').each(function(){
                    if($(this).is(':checked')){
                        copy_status.push($(this).val());
                    }
                });
                if(copy_status.length){
                    $.ajax({
                        url:'index.php?route=fbmessage/publish_nophoto/ajax_data&token=<?php echo $token;?>',
                        type:'Post',
                        data:{ajax:1,action:'copy',status:copy_status.join()},
                        dataType:'json',
                        beforeSend:function(){
                            $('#copy-dialog .do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG?>loading.gif"></div>');
                            $('.ui-dialog-buttonset button').addClass('ui-state-disabled').attr('disabled','disabled');
                        },
                        success:function(data){
                            $('.alert').remove();
                            if(data.status == 0){
                                $('#copy-dialog .do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                            }else{
                                $('#copy-dialog .do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                            }
                        }
                    });
                }else{
                    $('#copy-dialog .do-result').html('<div class="alert alert-warning">No Match Found</div>');
                }
            }
        }
    });
});
$('#copy-dialog input[name="copy_status"]').live('click',function(){
    var copy_status = [];
    $('#copy-dialog input[name="copy_status"]').each(function(){
        if($(this).is(':checked')){
            copy_status.push($(this).val());
        }
    });
    if(copy_status.length){
        $.ajax({
            url:'index.php?route=fbmessage/publish_nophoto/ajax_data&token=<?php echo $token;?>',
            type:'Post',
            data:{ajax:1,action:'get',status:copy_status.join()},
            dataType:'json',
            success:function(data){
                if(data.status == 1){
                    $('#copy-dialog span#_selected').html(data.total);
                }
            }
        });
    }
})
//-->
</script>
<?php } ?>

<?php echo $footer; ?>