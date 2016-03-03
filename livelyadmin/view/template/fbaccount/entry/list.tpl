<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	  <div class="page-header">
    		<div class="container-fluid">
      			<div class="pull-right">
      				  <a id="btn-bulk" class="btn btn-primary" data-toggle="tooltip" title="Bulk Edit"><i class="fa fa-paw"></i></a>
                <a href="<?php echo $add; ?>" class="btn btn-primary" data-toggle="tooltip" title="<?php echo $button_add; ?>"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger hidden" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-entry').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> <?php echo $text_list; ?>
                </h3>
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
                						<label class="control-label"><?php echo $column_entry_sn ;?></label>
                						<input type="text" name="filter_entry_sn" value="<?php echo $filter_entry_sn; ?>" class="form-control"/>
              					</div>
                				<div class="form-group">
                						<label class="control-label"><?php echo $column_entry_name ;?></label>
                						<input type="text" name="filter_entry_name" value="<?php echo $filter_entry_name; ?>" class="form-control"/>
              					</div>
            				</div>
            				<div class="col-sm-2">
              					<div class="form-group">
              						  <label class="control-label"><?php echo $column_product ;?></label>
              						  <select name="filter_product_id"  class="form-control">
      		                      <option value="*"><?php echo $text_none;?></option>
      		                      <?php foreach ($all_products as $item) { ?>          
      		                      <option <?php echo $filter_product_id == $item['product_id'] ? 'selected' : '' ?> value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
      		                      <?php }?>
        		                </select>
              					</div>
            					  <div class="form-group">
            						    <label class="control-label"><?php echo $column_group ?></label>
            						    <select name="filter_product_id"  class="form-control">
      		                      <option value="*"><?php echo $text_none;?></option>
      		                      <?php foreach ($all_products as $item) { ?>          
      		                      <option <?php echo $filter_product_id == $item['product_id'] ? 'selected' : '' ?> value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
      		                      <?php }?>
        		                </select>
            					  </div>
            				</div>
            				<div class="col-sm-2">
              					<div class="form-group">
                						<label class="control-label"><?php echo $column_artist ;?></label>
                						<select name="filter_artist_id" class="form-control">
          		                  <option value="*"></option>
          		                  <?php foreach ($all_artists as $artist) { ?>
          		                  <?php if ($artist['user_id'] == $filter_artist_id) { ?>
          		                  <option value="<?php echo $artist['user_id']; ?>" selected="selected"><?php echo $artist['name']; ?></option>
          		                  <?php } else { ?>
          		                  <option value="<?php echo $artist['user_id']; ?>"><?php echo $artist['name']; ?></option>
          		                  <?php } ?>
          		                  <?php } ?>
          		              </select>
              					</div>
              					<div class="form-group">
                						<label class="control-label"><?php echo $column_status;?></label>
                						<select name="filter_status" class="form-control">
          		                  <option value="*"></option>
          		                  <?php if ($filter_status) { ?>
          		                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
          		                  <option value="0"><?php echo $text_disabled; ?></option>
          		                  <?php } else { ?>
          		                  <option value="1"><?php echo $text_enabled; ?></option>
          		                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
          		                  <?php } ?>
          		              </select>
              					</div>
            				</div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label"><?php echo str_replace('<br>', '', $column_posts);  ?></label>
                            <input type="text" name="filter_posts" value="<?php echo $filter_posts;?>" class="form-control">
                        </div>
                        <button type="button" onclick="return filter();" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                    </div>
			          </div>
		        </div>
            <div class="row">
                <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                <div class="col-sm-6 text-right"><?php echo $results; ?></div>
            </div>
            <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-entry">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                    <thead>
                    <tr>            	
                        <td width="1" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                        <td class="text-center"><?php if ($sort == 'f.entry_sn') { ?>
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

                        <td class="text-center"><?php if ($sort == 'f.artist_id') { ?>
                          <a href="<?php echo $sort_artist; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_artist; ?></a>
                          <?php } else { ?>
                          <a href="<?php echo $sort_artist; ?>"><?php echo $column_artist; ?></a>
                          <?php } ?></td>
                        <td class="text-center"><?php if ($sort == 'f.status') { ?>
                          <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                          <?php } else { ?>
                          <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                          <?php } ?></td>
                        <td class="text-center"><?php echo $column_posts; ?></td>
                        <td class="text-center"><?php if ($sort == 's_posts') { ?>
                          <a href="<?php echo $sort_s_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_s_posts; ?></a>
                          <?php } else { ?>
                          <a href="<?php echo $sort_s_posts; ?>"><?php echo $column_s_posts; ?></a>
                          <?php } ?></td>
                        <td class="text-center"><?php if ($sort == 'p_posts') { ?>
                          <a href="<?php echo $sort_p_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_p_posts; ?></a>
                          <?php } else { ?>
                          <a href="<?php echo $sort_p_posts; ?>"><?php echo $column_p_posts; ?></a>
                          <?php } ?></td>
                        <td class="text-center"><?php if ($sort == 'm_posts') { ?>
                          <a href="<?php echo $sort_m_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_m_posts; ?></a>
                          <?php } else { ?>
                          <a href="<?php echo $sort_m_posts; ?>"><?php echo $column_m_posts; ?></a>
                          <?php } ?></td>
                        <td class="text-center"><?php echo $column_action; ?></td>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($entries) { ?>
                    <?php foreach ($entries as $entry) { ?>
                    <tr>
                        <td class="text-center"><?php if ($entry['selected']) { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $entry['entry_id']; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="checkbox" name="selected[]" value="<?php echo $entry['entry_id']; ?>" />
                            <?php } ?>
                        </td>
                        <td class="text-center"><?php echo $entry['entry_sn']; ?></td>
                        <td class="text-left"><a href="<?php echo lively_truncate($entry['entry_url']); ?>" target="_blank"><?php echo lively_truncate($entry['entry_name']); ?></a></td>  
                        <td class="text-left"><?php echo $entry['product'] ?></td>
                        <td class="text-center"><?php echo $entry['artist'] ?></td> 
                        <td class="text-center"><?php echo $entry['status']; ?></td> 
                        <td class="text-center"><?php echo $entry['posts']; ?></td>
                        <td class="text-center"><?php echo $entry['s_posts']; ?></td>
                        <td class="text-center"><?php echo $entry['p_posts']; ?></td>
                        <td class="text-center"><?php echo $entry['m_posts'] ?></td>
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
<div id="bulk-dialog" style="display:none;">
    <form method="post" id="bulk-form" class="form-horizontal">
        <div class="col-sm-12">
            <div class="form-group">
              	<label class="control-label col-sm-3">Product:</label>
              	<div class="col-sm-9">
                		<select name="_product_id" class="form-control ">
                      <option value="*"><?php echo $text_none;?></option>
                      <?php foreach ($all_products as $item) { ?>          
                      <option value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                      <?php }?>
                		</select>
              	</div>
            </div>
            <div class="form-group">
              	<label class="control-label col-sm-3">Artist:</label>
              	<div class="col-sm-9">
              	  <select name="_artist_id" class="form-control">
                  	  <option value="*"><?php echo $text_none;?></option>
                      <?php foreach ($all_artists as $user) { ?>          
                      <option value="<?php echo $user['user_id']; ?>"><?php echo $user['name']; ?></option>
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
          		    <select name="_status" class="form-control col-sm-10">
                  	  <option value="*"><?php echo $text_none;?></option>
                      <option value="1"><?php echo $text_enabled; ?></option>                  
                      <option value="0"><?php echo $text_disabled; ?></option>
                  </select>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="<?php echo  TPL_JS ?>form.js"></script>
<script type="text/javascript"><!--
$('#btn-bulk').bind('click',function(){
  	$('#bulk-dialog .do-result').empty();
  	$('#selected-ids').remove();
  	var selecteds = [];
	  $('input[name^="selected"]:checked').each(function(){
		    selecteds.push($(this).attr('value') );    	
	  });
	  if(selecteds.length>0){
		    var dialog_html = '<h3 class="text-center">Selected :'+selecteds.length+' </h3><input type="hidden" name="selecteds" value="'+selecteds.join()+'">';
		    $('#bulk-dialog #bulk-form').prepend('<div id="selected-ids">'+dialog_html+'</div>');
  	}else{
		    alert('You must be select one line at least!');
		    return false;
  	}
    $('#bulk-dialog').dialog('open');
})

$('#bulk-dialog').dialog({
    title:"Bulk Edit",
    modal:true,
    width:680,
    autoOpen:false,
    buttons:{
        'Save':function(){
            $('#bulk-form').ajaxSubmit({
                url:'index.php?route=fbaccount/entry/edit&token=<?php echo $token;?>',
                type:'Post',
                dataType:'json',
                success:function(data){
                    if(data.status == 0){
                        $('#bulk-dialog .do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                    }else{
                        $('#bulk-dialog .do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                        location.reoload();
                    }
                }
            });
        }
    }
});
function filter() {
	url = 'index.php?route=fbaccount/entry&token=<?php echo $token; ?>';
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

//--></script> 
<?php echo $footer; ?>