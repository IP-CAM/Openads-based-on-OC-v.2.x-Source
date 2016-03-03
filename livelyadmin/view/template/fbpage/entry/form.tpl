<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
		  <div class="pull-right">
		  		<a onclick="$('#form').submit();" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button_save; ?></a>
				<a href="<?php echo $cancel; ?>" class="btn btn-primary"> <i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
	  <div class="panel-body">
      	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">

	        <div class="form-group">
	            <label class="control-label col-sm-2"> <?php echo $entry_entry_sn; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="entry_sn" value="<?php echo $entry_sn;?>" class="form-control" <?php echo (!empty($entry_id)) ? 'readonly':'';?> />
	              	<?php if ($error_entry_sn) { ?>
	              	<span class="error"><?php echo $error_entry_sn; ?></span>
	              	<?php } ?>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_entry_name; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="entry_name" value="<?php echo $entry_name;?>" class="form-control" />
	              	<?php if ($error_entry_name) { ?>
	              	<span class="error"><?php echo $error_entry_name; ?></span>
	              	<?php } ?>
	            </div>
	        </div> 
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_page_url; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="page_url" value="<?php echo $page_url;?>" class="form-control" />
	              	<?php if ($error_page_url) { ?>
	              	<span class="error"><?php echo $error_page_url; ?></span>
	              	<?php } ?>
	              </div>
	        </div> 
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_entry_url; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="entry_url" value="<?php echo $entry_url;?>" class="form-control" />
	              	<?php if ($error_entry_url) { ?>
	              	<span class="error"><?php echo $error_entry_url; ?></span>
	              	<?php } ?>
	             </div>
	        </div> 
	          
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_user; ?></label>
	            <div class="col-sm-10">
	            	<select name="user_id" class="form-control">
	            	<option value="0"><?php echo $text_none?></option>
            		<?php foreach ($all_markets as $user){?>
            		<option value="<?php echo $user['user_id']?>" <?php echo ($user_id == $user['user_id']) ? 'selected':'';?>><?php echo $user['nickname'];?></option>
	            	<?php } ?>
	            	</select>
	            	<?php if ($error_user) { ?>
	              	<span class="error"><?php echo $error_user; ?></span>
	              	<?php } ?>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_artist; ?></label>
	            <div class="col-sm-10">
	            	<select name="artist_id" class="form-control">
	            	<option value="0"><?php echo $text_none?></option>
	            	<?php foreach ($all_artists as $artist){?>
	            	<option value="<?php echo $artist['user_id']?>" <?php echo ($artist_id == $artist['user_id']) ? 'selected':'';?>><?php echo $artist['fullname'];?></option>
	            	<?php }?>
	            	</select>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_product; ?></label>
	            <div class="col-sm-10">
	            	<select name="product_id" class="form-control">
	            	<?php foreach ($all_products as $item){?>
	            	<option value="<?php echo $item['product_id']?>" <?php echo ($product_id == $item['product_id']) ? 'selected':'';?>><?php echo $item['code'].' '.$item['name'];?></option>
	            	<?php }?>
	            	</select>
	            </div>
	        </div>  
	               
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_fans; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="fans" value="<?php echo $fans;?>" class="form-control" />
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_page_status; ?></label>
	            <div class="col-sm-10">
	            	<select name="page_status" class="form-control">
	                <?php foreach ($all_page_status as $Pstatus) {?>
	                <option value="<?php echo $Pstatus['status_id']?>" <?php echo ($Pstatus['status_id'] == $page_status) ? 'selected':'';?>><?php echo $Pstatus['name'];?></option>
	            	<?php } ?>
	            	</select>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_create_date; ?></label>
	            <div class="col-sm-10"><input type="text" name="create_date" value="<?php echo $create_date;?>" class="fbdate form-control" data-date-format="YYYY-MM-DD"/></div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_update_date; ?></label>
	            <div class="col-sm-10"><input type="text" name="update_date" value="<?php echo $update_date;?>" class="fbdate form-control" data-date-format="YYYY-MM-DD"/></div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_is_clickbank; ?></label>
	            <div class="col-sm-10">
	              <select name="is_clickbank" class="form-control">
	                <option value="1" <?php echo $is_clickbank ? ' selected="selected"' : ''?> ><?php echo $text_yes; ?></option>
	                <option value="0" <?php echo !$is_clickbank ? ' selected="selected"' : ''?>><?php echo $text_no; ?></option>
	              </select>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_note; ?></label>
	            <div class="col-sm-10">
	            	<textarea name="note" id="fbnote" class="form-control" ><?php echo $note?></textarea>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_status; ?></label>
	            <div class="col-sm-10">
	            	<select name="status" class="form-control">
	                	<option value="1" <?php echo $status ? ' selected="selected"' : ''?> ><?php echo $text_enabled; ?></option>
	                	<option value="0" <?php echo !$status ? ' selected="selected"' : ''?>><?php echo $text_disabled; ?></option>
	                </select>
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_post_level; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="post_level" value="<?php echo $post_level;?>" class="form-control" />
	            </div>
	        </div>
	        <div class="form-group">
	            <label class="control-label col-sm-2"><?php echo $entry_maintain_level; ?></label>
	            <div class="col-sm-10">
	            	<input type="text" name="maintain_level" value="<?php echo $maintain_level;?>" class="form-control" />
	            </div>
	        </div>
	      </form>
	   </div>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('.fbdate').datetimepicker({picktime:false});

//--></script> 

<?php echo $footer; ?>