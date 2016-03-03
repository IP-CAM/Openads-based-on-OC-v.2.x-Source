<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/log.png" alt="" width="22px" height="22px"/> <?php echo $heading_title; ?></h1>
            <div class="buttons">
                <?php if($bulk){ ?>
                <a href="javascript:;" class="button bulk-edit"><?php echo $button_bulk; ?></a>
                <?php }?>
                <?php if($admin_group){ ?>
                <a id="import-button" class="button"><?php echo $button_import; ?></a>
              	<a id="export-button" class="button"><?php echo $button_export; ?></a>
                <?php } ?>
            </div>
        </div>
        <div class="content">
            <div class="pagination top"><?php echo $pagination; ?></div>
            <form action="" method="post" id="form">
            <table class="list">
                <thead>
                    <tr>
                        <td width="1" style="text-align: center;">
                            <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                        </td>
                        <td class="left">
                            <?php if ($sort == 'mc.contribute_sn') { ?>
                            <a href="<?php echo $sort_contribute_sn; ?>" class="<?php echo strtolower($order); ?>" ><?php echo $column_contribute_sn; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_contribute_sn; ?>"><?php echo $column_contribute_sn; ?></a>
                            <?php } ?>
                        </td>              
                        <td class="left"><?php if ($sort == 'customer') { ?>
                            <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_customer; ?>"><?php echo $column_author; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left">
                            <?php if ($sort == 'product') { ?>
                            <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'mc.entry_sn') { ?>
                            <a href="<?php echo $sort_entry_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_entry_sn; ?>"><?php echo $column_entry; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'mc.group_id') { ?>
                            <a href="<?php echo $sort_group; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_group; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_group; ?>"><?php echo $column_group; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'user') { ?>
                            <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_auditor; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_user; ?>"><?php echo $column_auditor; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'mc.status') { ?>
                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'mc.date_modified') { ?>
                            <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'mc.publish') { ?>
                            <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                            <?php } ?>
                        </td>
                        <td class="right"><?php echo $column_action; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="filter">
                        <td></td>
                        <td>
                            <input type="text" name="filter_contribute_sn" value="<?php echo $filter_contribute_sn;?>" style="width:80px;">
                        </td>
                        <td><input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" style="width:100px;"/></td>
          			        <td>
                            <select name="filter_product_config_id" style="width:80px;">
                                <option value="*"></option>
                                <?php foreach ($all_products as $product) { ?>
                                <option value="<?php echo $product['contribute_config_id'] ?>" <?php echo $product['contribute_config_id']==$filter_product_config_id ? 'selected' : '' ?>><?php echo $product['name'] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td><input type="text" name="filter_entry" value="<?php echo $filter_entry; ?>" /></td>
                        <td><select name="filter_group_id" >
                            <option value="*"></option>
                            <?php foreach ($all_groups as $group) { ?>
                            <?php if ($group['group_id'] == $filter_group_id) { ?>
                            <option value="<?php echo $group['group_id']; ?>" selected="selected"><?php echo $group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $group['group_id']; ?>"><?php echo $group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        <td><select name="filter_user_id" >
                            <option value="*"></option>
                            <?php foreach ($all_markets as $user) { ?>
                            <?php if ($user['user_id'] == $filter_user_id) { ?>
                            <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['lastname'].$user['firstname']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $user['user_id']; ?>"><?php echo $user['lastname'].$user['firstname']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select></td>
                        <td><select name="filter_status" style="width:80px;">
                          		<option value="*"></option>
                              <?php foreach ($message_statuses as $item) { ?>
                              <?php if ($item['status_id'] == $filter_status) { ?>
                              <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                              <?php } ?>
                              <?php } ?>
                        	  </select></td>
                        <td>
                            <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" style="width:80px;" class="date" />
                        </td>
                        <td><select name="filter_publish" style="width:80px;">
                              <option value="*"></option>
                              <?php foreach ($message_publishes as $item) { ?>
                              <?php if ($item['publish_id'] == $filter_publish) { ?>
                              <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                              <?php } ?>
                              <?php } ?>
                            </select></td>
                        <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
                    </tr>
                    <?php if ($contributes) { ?>
                    <?php foreach ($contributes as $item) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo '<a name="'.$item['contribute_id'].'">'.$item['contribute_id'].'</a>'; if ($item['selected']) { ?>
                          <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>" checked="checked" />
                          <?php } else { ?>
                          <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>"  />
                          <?php } ?>
                        </td>            
                        <td class="left"><?php echo $item['contribute_sn']; ?></td>
                        <td class="left"><?php echo $item['author']; ?></td>
                        <td class="left"><?php echo $item['product']; ?></td>              
                        <td class="left"><?php echo $item['entry_sn'].' '.$item['entry_name']; ?></td>
                        <td class="left"><?php echo $item['group']; ?></td>
                        <td class="left"><?php echo $item['auditor']; ?></td>
                        <td class="left"><?php echo $item['status_text']; ?></td>
                        <td class="left"><?php echo $item['date_modified']; ?></td>
                        <td class="left"><?php echo $item['publish_text']; ?></td>
                        <td class="right"><?php foreach ($item['action'] as $action) { ?>
                         [ <a href="<?php echo $action['href']; ?>" <?php echo $item['lock'] ? 'lock=1' : '' ?>><?php echo $action['text']; ?></a> ] 
                          <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr><td class="center" colspan="13"><?php echo $text_no_results; ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
            </form>
            <div class="pagination"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>

<div id="import-dialog" style="display:none;">
    <div id="imtabs" class="htabs">
        <a href="#tabim-normal">Nomal</a>
        <a href="#tabim-url">URL</a>
        <a href="#tabim-dele-url">Delete URL</a>
    </div>
    <div id="tabim-normal">
        <div class="do-result"></div>
        <form method="post" enctype="multipart/form-data" >
            <input type="hidden" name="mode" value="normal">
            <table class="form">    
                <tr><td>Post Testing file:</td><td><input type="file" name="filename"/></td></tr>
            </table>
        </form>
    </div>
    <div id="tabim-url">
        <div class="do-result"></div>
        <form method="post" enctype="multipart/form-data" >
            <input type="hidden" name="mode" value="links">
            <table class="form">    
                <tr><td>URL file:</td><td><input type="file" name="filename"/></td></tr> 
            </table>
        </form>
    </div>
    <div id="tabim-dele-url">
        <div class="do-result"></div>
        <form method="post" enctype="multipart/form-data" >
            <input type="hidden" name="mode" value="dele_links">
            <table class="form">    
                <tr><td>URL file:</td><td><input type="file" name="filename"/></td></tr> 
            </table>
        </form>
    </div>
</div>

<div id="export-dialog" style="display:none;">
    <input name="mode" value="posts" type="hidden"/>
    <table class="form">
        <tr class="not-only">
            <td>Status:</td>
            <td>
                <?php foreach ($message_statuses as $item) { ?>
                <span class="multiple"><input type="checkbox" name="filter_statuses[]" value="<?php echo $item['status_id'] ?>" <?php echo in_array($item['status_id'], $this->config->get("message_level_status")) ? 'checked' : ''  ?> ><?php echo $item['name']; ?></span>
                <?php } ?>
            </td>
        </tr>
        <tr class="not-only">
            <td>Post Status:</td>
            <td>
                <?php foreach ($message_publishes as $item) { ?>
                <span class="multiple"><input type="checkbox" name="filter_publishes[]" value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $this->config->get("message_promoting_publish") ? 'checked' : '' ?>><?php echo $item['name']; ?></span>
                <?php } ?>
            </td>
        </tr>
        <tr class="not-only">
            <td>Products:</td>
            <td>
                <?php foreach ($all_products as $product) { ?>
                <span class="multiple"><input type="checkbox" name="filter_products[]" value="<?php echo $product['contribute_config_id'] ?>" checked><?php echo $product['name'] ?></span>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table class="inner-table"><tr>
                    <td>
                        <label>Number of Short URL:</label>
                        <select name="filter_url_operator">
                            <option value="*"> </option>
                            <option value="dy">&gt;</option>
                            <option value="xy">&lt;</option>
                            <option value="=">=</option>
                        </select>
                        <input type="text" name="filter_url_number" value="5" size="4"/>
                    </td>
                    <td>
                        <label>Link Num (<i>In URL.csv</i>):</label>
                        <input type="text" name="link_num" value="10" size="4"/>
                    </td>
                </tr></table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="only-target-url">Only Export Target URL:</label>
                <input type="checkbox" id="only-target-url" value="1"/>
            </td>
        </tr>
    </table>
    <div class="do-result"></div>
</div>

<div id="bulk-edit-dialog" style="display:none;">
    <div class="do-result"></div>
    <form method="post" id="bulk-edit-form">
        <table class="form">
            <tr>
                <td>Status:</td>
                <td>
                    <select name="_status">
                        <option value="*"><?php echo $text_none;?></option>
                        <?php foreach ($message_statuses as $item) { ?>
                        <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Post Status:</td>
                <td>
                    <select name="_publish">
                        <option value="*"><?php echo $text_none;?></option>
                        <?php foreach ($message_publishes as $item) { ?>
                        <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="detail-dialog"></div>
<script type="text/javascript" src="view/javascript/jquery/form.js"></script>
<script type="text/javascript"><!--	
function edit_contribute(contribute_id,type){
    $.ajax({
        url:'index.php?route=contribute/message/detail&token=<?php echo $token;?>',
        type:'Post',
        data:{mode:1,contribute_id:contribute_id,edit_type:type},
        dataType:'html',
        success:function(_html){
            $('#detail-dialog').html(_html);
        }
    });
}
$('#only-target-url').click(function(){
    if($(this).attr('checked')=='checked'){
        $('#export-dialog input[name="mode"]').val('links');
        $('#export-dialog select[name="filter_url_operator"]').val('dy');
        $('#export-dialog tr.not-only').hide();
    }else{
        $('#export-dialog input[name="mode"]').val('posts');
        $('#export-dialog select[name="filter_url_operator"]').val('*');
        $('#export-dialog tr.not-only').show();
    }
});
$('.bulk-edit').bind('click',function(){
    $('#bulk-edit-dialog .do-result').empty();
    $('#selected-ids').remove();
    var selected_ids = [];
    $('table.list input[name^="selected"]:checked').each(function(){
        selected_ids.push($(this).attr('value') );      
    });
    var _ids = selected_ids.join();
    var dialog_html = '';
    if(_ids){
        dialog_html += '<div id="selected-ids"><h4>You have selected '+selected_ids.length+' records.</h4><input type="hidden" name="selected_ids" value="'+_ids+'"></div>';
    }else{
        alert('You must select one line at least!');
        return false;
    }
    $('#bulk-edit-dialog #bulk-edit-form').prepend(dialog_html);
    $('#bulk-edit-dialog').dialog({
        title:"Bulk Edit Contributes",
        modal:true,
        width:680,
        buttons:{
            'Save':function(){
                
                $('#bulk-edit-form').ajaxSubmit({
                    url:'index.php?route=contribute/message/update&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    success:function(data){
                        if(data.status == 0){
                            $('#bulk-edit-dialog .do-result').html('<div class="alert warning">'+data.msg+'</div>');
                        }else{
                            $('#bulk-edit-dialog .do-result').html('<div class="alert success">'+data.msg+'</div>');
                            location.reload();
                        }
                    }
                });
            },
            'Delete':function(){
                if(confirm('Are you sure to delete '+selected_ids.length+' records??')){
                    
                    $('#bulk-edit-form').ajaxSubmit({
                        url:'index.php?route=contribute/message/update&token=<?php echo $token;?>&delete=1',
                        type:'Post',
                        dataType:'json',
                        success:function(data){
                            if(data.status == 0){
                                $('#bulk-edit-dialog .do-result').html('<div class="alert warning">'+data.msg+'</div>');
                            }else{
                                $('#bulk-edit-dialog .do-result').html('<div class="alert success">'+data.msg+'</div>');
                                location.reload();
                            }
                        }
                    });
                }
            }
      }
    });
})
function filter() {
	url = 'index.php?route=contribute/message&token=<?php echo $token; ?>';
	var paramArr=[];
	$("tr.filter input[name],tr.filter select[name]").each(function(){
	    if($(this).val() && $(this).val() != '*'){
	        paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
	    }
	});
	if(paramArr.length>0){
	    url+="&"+paramArr.join("&");
	}
	location = url;
}

$('div.success a[hash],div.warning a[hash]').bind('click',function(){
    location.hash = $(this).attr('hash');
    $('input[name^=selected][value='+$(this).attr('hash')+']').parent('td').focus();
    shake($('input[name^=selected][value='+$(this).attr('hash')+']').parent('td'),'focus_line',3);
});
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
//--></script>

<?php if($admin_group){?>
<script type="text/javascript"><!-- 
$('#import-button').bind('click',function(){
    $('#import-dialog .do-result').empty();
    $('#import-dialog').dialog({
        title:'Import',
        width: 680,
        modal:true,
        buttons:{
            'Import':function(){
                $('#import-dialog div.tab-on form').ajaxSubmit({
                    url:'index.php?route=contribute/message/import_data&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    beforeSubmit:function(){
                        $('#import-dialog div.tab-on .do-result').html('<img src="view/image/loading_pro.gif">');
                        $('.ui-dialog-buttonset button').addClass('ui-state-disabled').attr('disabled','disabled');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $('#import-dialog div.tab-on .do-result').html('<div class="alert warning">'+data.msg+'</div>');
                        }else{
                            $('#import-dialog div.tab-on .do-result').html('<div class="alert success">'+data.msg+'</div>');
                            $('#import-dialog div.tab-on input[name="filename"]').val('');
                        }
                        $('.ui-dialog-buttonset button:last').removeAttr('disabled').removeClass('ui-state-disabled');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }
    });
});

$('#export-button').bind('click',function(){
    $('#export-dialog .do-result').empty();
    $('#export-dialog').dialog({
        title:'Export Posts',
        width: 800,
        modal:true,
        buttons:{
            'Export':function(){
                if(confirm("Note: When export data,please import URL first.")){
                $.ajax({
                    url:'index.php?route=contribute/message/advanced_export&token=<?php echo $token;?>',
                    type:'POST',
                    data:$('#export-dialog input:text,#export-dialog input:hidden,#export-dialog  input:checked,#export-dialog select'),
                    dataType:'json',
                    beforeSend:function(){
                        $('#export-dialog .do-result').html('<img src="view/image/loading_pro.gif">');
                        $('.ui-dialog-buttonset button').addClass('ui-state-disabled').attr('disabled','disabled');
                    },
                    success:function(data){
                        $('.alert').remove();
                        if(data.status==1){             
                            $('#export-dialog .do-result').html('<div class="alert success">'+data.msg+'</div>');
                        }else{
                            $('#export-dialog .do-result').html('<div class="alert warning">'+data.msg+'</div>');
                        }
                        $('.ui-dialog-buttonset button:last').removeAttr('disabled').removeClass('ui-state-disabled');
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }         
                });
                }
            }
        }
    });
});
$('#imtabs a').tabs();
//--></script>
<?php } ?>
<style type="text/css">
table.form > tbody > tr > td:first-child {width: 150px;}
table.form > tbody > tr > td {padding: 5px}

</style> 
<?php echo $footer; ?>