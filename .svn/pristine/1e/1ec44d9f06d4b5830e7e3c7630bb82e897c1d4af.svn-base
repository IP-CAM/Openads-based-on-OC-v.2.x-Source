<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header"></div>
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
	    <?php if($locked){ ?>
	    <div class="alert alert-warning">
	        <i class="fa fa-lock"></i> <?php echo $text_lock;?>
	    </div>
	    <?php } ?>
	    </div>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title">
	                <i class="fa fa-pencil"></i> 
	                <?php echo ' '.$contribute_sn; ?>
	            </h3>
                <div class="pull-right">
                    <a href="<?php echo $cancel ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" titile="<?php echo $button_cancel; ?>">
                        <i class="fa fa-reply"></i>
                        <?php echo $button_cancel; ?>
                    </a>
                </div>                
	        </div>
	        <div class="panel-body">
				<ul class="nav nav-tabs">
	                <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
				    <li><a href="#tab-history" data-toggle="tab">History</a></li>
				</ul>		
				<div class="tab-content">
					<div class="tab-pane active" id="tab-general">
					    <div class="col-sm-4">
                            <div class="panel panel-info">
                                <div class="panel-heading"><?php echo $tab_info ?></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="" class="control-label">SN</label>
                                        <span class="form-control"><?php echo $contribute_sn;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Author</label>
                                        <span class="form-control"><?php echo $author;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Artist</label>
                                        <span class="form-control"><?php echo $artist;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Submite Date</label>
                                            <span class="form-control"><?php echo $submited_date;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Submite Times</label>
                                            <span class="form-control"><?php echo $submited_times;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Operator</label>
                                            <span class="form-control"><?php echo $user;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <?php foreach ($post_statuses as $item) { ?>
                                        <?php if ($item['status_id']==$status) { ?>
                                        <span class="form-control" ><?php echo $item['name']; ?></span>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>                                 
                                    <?php if(is_array($notes)){ rsort($notes);?>   
                                    <div class="form-group">
                                        <label class="control-label">Note</label>
                                        <div style="overflow-y:auto;max-height: 120px; ">
                                            <?php foreach ($notes as $item): ?>
                                            <blockquote style="margin-bottom: 2px;padding: 5px;">
                                                <p><?php echo $item['msg'] ?></p>
                                                <footer><?php echo $item['operator'] ?> : <?php echo (isset($item['time']) ? date("m-d H:i:s",$item['time']) : '') ?></footer>
                                            </blockquote>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <?php } ?>                                    
                                </div>
                            </div>
                         </div>
                         <div class="col-sm-8">
                         <form method="post" id="post-save-form">
                         	<div class="panel panel-primary">
                         		<div class="panel-heading">
                         			<?php echo $tab_post ?>
                                    <?php if($edit){ ?>
                         			<div class="pull-right">
                                        <a id="btn-save" class="btn btn-success btn-sm" data-toggle="tooltip" titile="<?php echo $button_save; ?>">
                                            <i class="fa fa-save"></i>
                                            <?php echo $button_save; ?>
                                        </a>
                                    </div>
                                    <?php }?>
                                    <input type="hidden" name="contribute_id" value="<?php echo $contribute_id ?>">
                         		</div>
                         		<div class="panel-body">
							        <div class="form-group">
	                                    <label for="" class="control-label">Facebook Account</label> 
	                                    <?php if($edit) {?>
	                                    <div class="input-group">
	                                        <span class="form-control"><b><?php echo $entry_sn.' '.$entry_name.'  [ '.$product.' ]'; ?></b></span>
	                                        <span class="modified input-group-addon btn">
	                                            <i class="fa fa-pencil"></i>
	                                            <input type="checkbox" name="entry_modified" value="1"/>
	                                        </span>
	                                    </div>
	                                    <input id="_entry" type="text" class="form-control hidden -toggle">
	                                    <input name="entry_sn" type="hidden" value="<?php echo $entry_sn;?>" />
	                                    <?php }else{?>           
	                                    <span class="form-control"><b><?php echo  $entry_sn.' '.$entry_name.'  [ '.$product.' ]'; ?></b></span>
	                                    <?php }?>
	                                </div>
                                    <div class="form-group">
                                        <label class="control-label">Expiration Date</label>
                                    <?php if($edit){ ?>
                                        <input type="text" name="expired" value="<?php echo $expired;?>" class="form-control cdate" data-date-format="YYYY-MM-DD"/>
                                    <?php }else{ ?>
                                        <span class="form-control"><?php echo $expired;?></span>
                                    <?php }?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Target URL</label>
                                    <?php if($edit){ ?>
                                        <input type="text" name="target_url" value="<?php echo $target_url;?>" class="form-control" />
                                    <?php }else{?>
                                        <span class="form-control"><?php echo $target_url;?></span>
                                    <?php }?>
                                    </div>   
                                    <div class="form-group">
                                        <label class="control-label">Post Text</label>
                                    <?php if ($edit) { ?>
                                        <textarea name="content" rows="8" class="form-control" ><?php echo $content;?></textarea>
                                    <?php }else{ ?>
                                        <pre style="height: 100px;" class="form-control"><?php echo $content;?></pre>
                                    <?php }?>                                           
                                    </div>

									<div class="form-group">
                                        <label class="control-label"><?php echo $entry_file ?></label>
                                        <div class="col-sm-12">
	                                        <div id="uploadfiles" class="uploads">
	                                            <?php if(is_array($file)){ ?>
	                                            <?php foreach ($file as $item): ?>
	                                            <div class="attach">
	                                                <?php if(!empty($item['realpath'])){ ?>
	                                                <a href="<?php echo $item['realpath'] ?>" class="fancy-img"></a>
	                                                <?php } ?>
	                                                <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>"  >
	                                                <?php if($edit){ ?>
	                                                <a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>
	                                                <?php }?>
	                                            </div>
	                                            <?php endforeach ?>
	                                            <?php }else{?>
	                                            <label class="label label-default"><?php echo $text_no_results ?></label>
	                                            <?php }?>
	                                        </div>
	                                        <div class="widgets">
	                                            <?php if($edit){ ?>
	                                            <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default"><i class="fa fa-upload"></i></button>
	                                            <?php }?>
	                                        </div>
                                        </div>
                                    </div>
                                    <?php if($edit){ ?>
                                    <div class="form-group">
                                        <label class="control-label">Note</label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            </form>
						</div>
					</div>
					<div id="tab-history" class="tab-pane"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript"><!-- 
$(function(){  $('a.fancy-img').fancybox();});

$('#tab-history').load('index.php?route=fbaccount/profile_photo/history&token=<?php echo $token;?>&contribute_id=<?php echo $contribute_id;?>');
$('#tab-history').delegate('.pagination a','click', function() {
  	$('#tab-history').load(this.href);  
  	return false;
});
$('.cdate').datetimepicker({pickTime:false});

//-->
</script>
<?php if($edit ) {?>
<script type="text/javascript"><!--
$('#btn-save').bind('click',function(){
    var _content = $('textarea[name="content"]').val();
    if( _content ==''){
        $('.do-result').html('<div class="alert alert-warning"><?php echo $error_text ?></div>');
        return false;
    }
    var _msg = check_contribute(_content);
    if(_msg!==true){
        $('.do-result').html('<div class="alert alert-warning">'+_msg+'</div>');
        return false;
    }
    $.ajax({
        url:'index.php?route=fbaccount/profile_photo/save&token=<?php echo $token;?>',
        type:'POST',
        data:$('#post-save-form:input'),
        dataType:'json',
        success:function(data){
            $('.alert').remove();
            if(data.status==1){                         
                $('.do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                location.reload();                 
            }else{
                $('.do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
            }
        }                   
    });
});

new AjaxUpload('#button-upload', {
    action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
    name: 'attachment',
    autoSubmit: false,
    responseType: 'json',
    onChange: function(file, extension) {   this.submit();  },
    onSubmit: function(file, extension) {
        $('#button-upload').append('<img src="<?php echo TPL_IMG?>loading.gif" class="loading">');
    },
    onComplete: function(file, json) {
        if (json.success) { 
            $("#uploadfiles").html('<div class="attach"><img class="img-thumbnail" title="'+file+'" src="'+getImgURL(json.path)+'"><br/><a onclick="$(this).parent().remove();">Delete</a><input name="file" value="'+json.path+'" type="hidden" /></div>');
        }else{
            alert(json.error);
        }           
        $('.loading').remove(); 
    }
});

$('.modified').bind('click',function(){
    if($(this).hasClass('focusin')){
        $(this).children('input[type="checkbox"]').removeProp('checked');
        $(this).parent('.input-group').find('input[type="text"]').prop('disabled','disabled');
        $(this).parent('.input-group').next('.-toggle').addClass('hidden');
        $(this).removeClass('focusin');
    }else{
        $(this).children('input[type="checkbox"]').prop('checked',true);
        $(this).parent('.input-group').find('input[type="text"]').removeProp('disabled').focus();
        $(this).parent('.input-group').next('.-toggle').removeClass('hidden');
        $(this).addClass('focusin');
    }
});

$('#_entry').autocomplete({
    delay: 500,
    source: function(request, response) {
        $.ajax({
            url: 'index.php?route=fbaccount/entry/autocomplete&token=<?php echo $token; ?>&filter_product=<?php echo $product_id ?>&filter_name=' +  encodeURIComponent(request),
            dataType: 'json',
            success: function(json) {   
                response($.map(json, function(item) {
                    return {
                        label: item.value+' '+item.name+' [ '+item['product']+' ]',
                        value: item.value
                    }
                }));
            }
        });
    }, 
    select: function(item) { 
        $('#_entry').val(item.label);
        $('input[name="entry_sn"]').val(item.value);               
        return false; 
    }
});
//-->
</script> 
<?php } ?>