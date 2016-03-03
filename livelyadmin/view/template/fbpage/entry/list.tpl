<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
	    <div class="container-fluid">
  	      <div class="pull-right">
    	      	<?php if($promotion){ ?>
    	        <a id="btn-likes" class="btn btn-info" data-toggle="tooltip" title="Update Page Likes"><i class="fa fa-facebook"></i> <i class="fa fa-thumbs-o-up"></i></a>
    	        <?php } ?>
    	      	<a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    	        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger hidden" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-entry').submit() : false;"><i class="fa fa-trash-o"></i></button>
    	        <a data-toggle="tooltip" title="Bulk" class="btn btn-primary" id="btn-bulk"><i class="fa fa-paw"></i></a>
              <a data-toggle="tooltip" title="Export" class="btn btn-primary" id="btn-export"><span class="glyphicon glyphicon-export"></span></a>
    	        <a data-toggle="tooltip" title="Import" class="btn btn-primary" id="btn-import"><span class="glyphicon glyphicon-import"></span></a>
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
                      <i class="fa fa-filter"></i> Filters
                  </a>
              </div>
          </div>
      </div>
      <div class="panel-body">
          <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"' ?>>
          	<div class="row filter">
        		  <div class="col-sm-2">
          		    <div class="form-group">
                    	<label class="control-label"><?php echo $column_entry_sn ?></label>
                    	<input type="text" name="filter_entry_sn" value="<?php echo $filter_entry_sn; ?>" class="form-control"/>
                  </div>
                  <div class="form-group">
                    	<label class="control-label"><?php echo $column_entry_name ?></label>
                    	<input type="text" name="filter_entry_name" value="<?php echo $filter_entry_name; ?>" class="form-control"/>
                  </div>
              </div>
              <div class="col-sm-2">
                  <div class="form-group">
                    	<label class="control-label"><?php echo $column_product ?></label>
                    	<select name="filter_product_id" class="form-control">
                          <option value="*"><?php echo $text_none;?></option>
                          <?php foreach ($all_products as $item) { ?>          
                          <option <?php echo $filter_product_id == $item['product_id'] ? 'selected' : '' ?> value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                          <?php }?>
                      </select>
                  </div>
                  <div class="form-group">
                    	<label class="control-label"><?php echo $column_user ?></label>
                    	<select name="filter_user_id" class="form-control">
                          <option value="*"></option>
                          <?php foreach ($all_markets as $user) { ?>
                          <?php if ($user['user_id'] == $filter_user_id) { ?>
                          <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['nickname']; ?></option>
                          <?php } else { ?>
                          <option value="<?php echo $user['user_id']; ?>"><?php echo $user['nickname']; ?></option>
                          <?php } ?>
                          <?php } ?>
                      </select>
                  </div>
      			 </div>
      			 <div class="col-sm-2">
        			 	  <div class="form-group">
                  		<label class="control-label"><?php echo $column_fans;?></label>
                  		<input type="text" name="filter_fans" value="<?php echo $filter_fans; ?>" class="form-control"/>
                	</div>
                	<div class="form-group">
                  		<label class="control-label"><?php echo $column_is_clickbank;?></label>
    	              	<select name="filter_is_clickbank" class="form-control">
      	                  <option value="*"></option>
      	                  <?php if ($filter_is_clickbank) { ?>
      	                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
      	                  <?php } else { ?>
      	                  <option value="1"><?php echo $text_yes; ?></option>
      	                  <?php } ?>
      	                  <?php if (!is_null($filter_is_clickbank) && !$filter_is_clickbank) { ?>
      	                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
      	                  <?php } else { ?>
      	                  <option value="0"><?php echo $text_no; ?></option>
      	                  <?php } ?>
    	                </select>
                  </div>
              </div>
              <div class="col-sm-2">
                	<div class="form-group">
                  		<label class="control-label"><?php echo $column_page_status?></label>
    	              	<select name="filter_page_status" class="form-control">
    	                  <option value="*"></option>
    	                  <?php foreach ($all_page_status as $page_status) { ?>
    	                  <?php if ($page_status['status_id'] == $filter_page_status) { ?>
    	                  <option value="<?php echo $page_status['status_id']; ?>" selected="selected"><?php echo $page_status['name']; ?></option>
    	                  <?php } else { ?>
    	                  <option value="<?php echo $page_status['status_id']; ?>"><?php echo $page_status['name']; ?></option>
    	                  <?php } ?>
    	                  <?php } ?>
    	                </select>
                  </div> 
                  <div class="form-group">
                  		<label class="control-label"><?php echo $column_status?></label>
    	              	<select name="filter_status" class="form-control">
    	                  <option value="*"></option>
    	                  <?php if ($filter_status) { ?>
    	                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
    	                  <?php } else { ?>
    	                  <option value="1"><?php echo $text_enabled; ?></option>
    	                  <?php } ?>
    	                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
    	                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
    	                  <?php } else { ?>
    	                  <option value="0"><?php echo $text_disabled; ?></option>
    	                  <?php } ?>
    	                </select>
                  </div> 
              </div>
              <div class="col-sm-2">
              		<a onclick="filter();" class="btn btn-primary"><?php echo $button_filter; ?></a>
              </div>
      	  </div>
      </div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-entry">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
            <thead>
                <tr>            	
                  <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                  
                  <td class="text-left"><?php if ($sort == 'f.entry_sn') { ?>
                    <a href="<?php echo $sort_entry_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry_sn; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_entry_sn; ?>"><?php echo $column_entry_sn; ?></a>
                    <?php } ?>
                  </td>
                  <td class="text-left"><?php if ($sort == 'f.entry_name') { ?>
                    <a href="<?php echo $sort_entry_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry_name; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_entry_name; ?>"><?php echo $column_entry_name; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'product') { ?>
                    <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'f.user_id') { ?>
                    <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_user; ?>"><?php echo $column_user; ?></a>
                    <?php } ?></td>

                  <td class="text-left"><?php if ($sort == 'f.fans') { ?>
                    <a href="<?php echo $sort_fans; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_fans; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_fans; ?>"><?php echo $column_fans; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'f.page_status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_page_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_page_status; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'f.status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'posts') { ?>
                    <a href="<?php echo $sort_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_posts; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_posts; ?>"><?php echo $column_posts; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'nposts') { ?>
                    <a href="<?php echo $sort_nposts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_nposts; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_nposts; ?>"><?php echo $column_nposts; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($entries) { ?>
                <?php foreach ($entries as $entry) { ?>
                <tr>
                  <td style="text-align: center;"><?php if ($entry['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $entry['entry_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $entry['entry_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $entry['entry_sn']; ?></td>
                  <td class="text-left"><?php echo lively_truncate($entry['entry_name']); ?></td>  
                  <td class="text-left"><?php echo $entry['product'] ?></td>
                  <td class="text-left"><?php echo $entry['user'] ?></td>
                  <td class="text-left"><?php echo $entry['fans']; ?></td>
                  <td class="text-left"><?php echo $entry['page_status']; ?></td>
                  <td class="text-left"><?php echo $entry['status']; ?></td>
                  <td class="text-left"><?php echo $entry['posts']; ?></td>
                  <td class="text-left"><?php echo $entry['nposts']; ?></td>
                  <td class="text-right">
                  <?php foreach ($entry['action'] as $action) { ?>
                   <a class="btn btn-sm btn-primary" href="<?php echo $action['href']; ?>" data-toggle="tooltip" title="<?php echo $action['text']; ?>" <?php echo isset($action['attr']) ? $action['attr'] : ''; ?>>
                     <?php echo $action['icon']; ?> 
                   </a>
                  <?php } ?>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr><td class="text-center" colspan="11"><?php echo $text_no_results; ?></td></tr>
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
<div id="post-dialog" style="display:none;">
  <?php echo $post_dialog ?>
</div>
<div id="export-dialog" style="display:none;">
    <form action="index.php?route=fbpage/entry/export&token=<?php echo $token;?>" method="post">
        Exports ?
    </form>
</div>
<div id="import-dialog" style="display:none;">
    <div class="do-result"></div>
    <form method="post" enctype="multipart/form-data" >
        <input type="hidden" name="mode" value="normal">
        <dl>    
            <dt>Post Page file:</dt>
            <dd><input type="file" name="filename"/></dd>
        </dl>
    </form>
</div>
<div id="bulk-dialog" style="display:none;">
    <div class="do-result"></div>
    <form method="post" id="bulk-form" class="form-horizontal">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="control-label col-sm-3">Product:</label>
                <div class="col-sm-9">
                    <select name="_product_id" class="form-control">
                      <option value="*"><?php echo $text_none;?></option>
                      <?php foreach ($all_products as $item) { ?>          
                      <option value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                      <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Auditor:</label>
                <div class="col-sm-9">
                    <select name="_user_id" class="form-control">
                        <option value="*"><?php echo $text_none;?></option>
                          <?php foreach ($all_markets as $user) { ?>          
                          <option value="<?php echo $user['user_id']; ?>"><?php echo $user['nickname']; ?></option>
                          <?php }?>
                      </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Page Status:</label>
                <div class="col-sm-9">
                    <select name="_page_status" class="form-control">
                      <option value="*"><?php echo $text_none;?></option>
                      <?php foreach ($all_page_status as $Pstatus) {?>
                        <option value="<?php echo $Pstatus['status_id'] ;?>"><?php echo $Pstatus['name']; ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Is Clickbank:</label>
                <div class="col-sm-9">
                    <select name="_is_clickbank" class="form-control">
                        <option value="*"><?php echo $text_none;?></option>
                        <option value="1"><?php echo $text_yes; ?></option>                  
                        <option value="0"><?php echo $text_no; ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3">Status:</label>
                <div class="col-sm-9">
                    <select name="_status" class="form-control">
                        <option value="*"><?php echo $text_none;?></option>
                        <option value="1"><?php echo $text_enabled; ?></option>                  
                        <option value="0"><?php echo $text_disabled; ?></option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"><!--
$('#btn-export').bind('click',function(){
    $('#export-dialog').dialog({
        title:"Export Pages",
        modal:true,
        buttons:{
            'Export':function(){$('#export-dialog form').submit(); },
            'Close':function(){$(this).dialog('close');}
      }
    })
})
$('#btn-import').bind('click',function(){
    $('#import-dialog .do-result').empty();
    $('#import-dialog').dialog({
        title:'Import',
        width: 680,
        modal:true,
        buttons:{
            'Import':function(){
                $('#import-dialog form').ajaxSubmit({
                    url:'index.php?route=fbpage/entry/import_page&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    beforeSubmit:function(){
                        $('#import-dialog .do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG?>loading.gif"></div>');
                    },
                    success:function(data){
                        if(data.status == 0){
                            $('#import-dialog .do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                        }else{
                            $('#import-dialog .do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                            $('#import-dialog input[name="filename"]').val('');
                        }
                    }
                });
            }
        }
    });
});

$('#btn-likes').bind('click',function(){
    if(confirm('Update Page Likes')){
        $.ajax({
            url:'index.php?route=fbpage/entry/update_page_fans&token=<?php echo $token ?>',
            type:'post',
            dataType:'json',
            beforeSend:function(){
              $('.do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG?>loading.gif"> Please Waitting</div>');
            },
            success:function(json){
              $('.alert').remove();
              if(json.status){
                $('.do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
              }else{
                $('.do-result').html('<div class="alert alert-warning">'+json.msg+'</div>');
              }
            }
        })
    }
});

$('#btn-bulk').bind('click',function(){
    $('#bulk-dialog .do-result').empty();
    $('#selected-ids').remove();
    var selecteds = [];
    $('input[name^="selected"]:checked').each(function(){
        selecteds.push($(this).attr('value') );      
    });
  
    if(selecteds.length>0){
        var dialog_html = '<h3 class="text-center">Selected :'+selecteds.length+' </h3><input type="hidden" name="selected_ids" value="'+selecteds.join()+'">';
        $('#bulk-dialog #bulk-form').prepend('<div id="selected-ids">'+dialog_html+'</div>');
    }else{
        alert('You must be select one line at least!');
        return false;
    }
    $('#bulk-dialog').dialog('open');
});

$('#bulk-dialog').dialog({
    title:"Bulk Edit",
    modal:true,
    width:680,
    autoOpen:false,
    buttons:{
        'Save':function(){
            $('#bulk-form').ajaxSubmit({
                url:'index.php?route=fbpage/entry/update&token=<?php echo $token;?>',
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
function filter() {
  	url = 'index.php?route=fbpage/entry&token=<?php echo $token; ?>';
  	var paramArr=[];
  	$(".filter input[name],.filter select[name]").each(function(){
    		if($(this).val()&&$(this).val()!='*'){
    			  paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
    		}
  	});
  	if(paramArr.length>0){
  		  url+="&"+paramArr.join("&");
  	}
  	location = url;
}

$('.fbdate').datetimepicker({ pickTime: false});
//-->
</script> 

<?php echo $footer; ?>