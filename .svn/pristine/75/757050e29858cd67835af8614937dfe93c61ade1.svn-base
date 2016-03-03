<div class="col-sm-12">
	<form method="post" class="form-horizontal" id="post-form" action="<?php echo $post_action; ?>">
		<input type="hidden" name="entry_sn">
		<div class="form-group">
			<div class="col-sm-12 text-center">
				<div class="radio-inline">
					<label for="mode-nophoto">
						<input type="radio" name="mode" value="nophoto" id="mode-nophoto"> Fbaccount NoPhoto
					</label>
				</div>
				<div class="radio-inline">
					<label for="mode-photo">
					<input type="radio" name="mode" value="photo" id="mode-photo"> Fbaccount Photo
					</label>
				</div>
				<div class="radio-inline">
					<label for="mode-message">
					<input type="radio" name="mode" value="message" id="mode-message"> Facebook Message
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_post_gender;?></label>
			<div class="col-sm-10">
				<?php foreach ($all_gender as $item) { ?>
				<?php if(strtolower($item['name'])=='all') continue; ?>
				<div class="radio-inline">
					<label for="gender-<?php echo $item['option_id']; ?>">
						<input type="radio" name="gender_id" value="<?php echo $item['option_id']; ?>" id="gender-<?php echo $item['option_id']; ?>">
						<?php echo $item['name']; ?>
					</label>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_post_country;?></label>
			<div class="col-sm-10">
				<?php foreach ($all_country as $item) { ?>
				<?php if(strtolower($item['name'])=='common') continue; ?>
				<div class="radio-inline">
					<label for="country-<?php echo $item['option_id']; ?>">
						<input type="radio" name="country_id" value="<?php echo $item['option_id']; ?>" id="country-<?php echo $item['option_id']; ?>">
						<?php echo $item['name']; ?>
					</label>
				</div>
				<?php } ?>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_target_url;?></label>
			<div class="col-sm-10">
				<input type="text" name="target_url" class="form-control"/>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_post_text;?></label>
			<div class="col-sm-10">
				<textarea type="text" name="content" class="form-control" rows="5"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_expired;?></label>
			<div class="col-sm-10">
				<input type="text" name="expired" class="fbdate form-control" data-date-format="YYYY-MM-DD"/>
			</div>
		</div>
		<div class="form-group photo-item" style="display: none;">
			<label for="" class="control-label col-sm-2">
				<?php echo $entry_post_img;?>
			</label>
			<div class="col-sm-10">
				<div id="uploadfiles" class="uploads _photos"></div>
				<input name="file" type="hidden" class="_photos"/>
				<div class="widgets">
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default"><i class="fa fa-upload"></i></button>
                </div>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-2"><?php echo $entry_note;?></label>
			<div class="col-sm-10">
				<textarea type="text" name="note" class="form-control"></textarea>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(function(){
		
		$('#post-form').formValidation({
            framework:'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'target_url':{
                    validators: {
                        notEmpty: {
                            message: 'The Target URL field is required'
                        },
                        uri:{
                            message: 'Invalid URL!'
                        }
                    }
                },
                'content':{
                    validators: {
                        notEmpty: {
                            message: 'The text field is required'
                        },
                        stringLength: {
                            min:3,
                            max:90,
                            message:'The text must be more than 3 and less than 90 characters long'
                        }
                    }
                }
                /*
                ,'post_file' :{
                	selector: '._photos',
                    validators:{
                    	callback:{
	                        message: 'The post image is required',
	                        callback: function(value, validator, $field){
	                        	if($('#uploadfiles img').length<0 || $('#post-dialog input[name="file"]').val()==''){
	                        		return false;
	                        	}
	                        	return true;
	                        }
	                    }
                    }
                }
                */
            }
        }).on('err.form.fv', function(e) {
	        var $form          = $(e.target),
	            formValidation = $form.data('formValidation');
	        //alert('<?php //echo $error_form ?>');
	    }).on('success.form.fv', function(e) {
	        e.preventDefault();
	        var $form = $(e.target);
	        $.post(
	            $form.attr('action'), 
	            $form.serialize(), 
	            function(json) {
	                if(json['error']){
	                    for(var k in json['error']){}
	                }else{
	                	location.reload();
	                	//$.get('index.php?route=tool/cron/similar_text&token=<?php echo $token; ?>');
	                }
	            }, 
	        'json');
	    }).find('input[name="mode"]').bind('click',function(){
        	var mode = $('input[name="mode"]:checked').val();
        	if(mode=='photo'){
        		/*
				$('#post-form').formValidation('addField', 'post_file',{
					selector: '._photos',
                    validators:{
                    	callback:{
	                        message: 'The post image is required',
	                        callback: function(value, validator, $field){
	                        	if($('#uploadfiles img').length<0 || $('#post-dialog input[name="file"]').val()==''){
	                        		return false;
	                        	}
	                        	return true;
	                        }
	                    }
                    }
				});*/
				$('.photo-item').css('display','block');
			}else{
				//$('#post-form').formValidation('removeField', 'post_file');
				$('.photo-item').css('display','none');
			}
        });
	    $('input[name="mode"]:first').trigger('click');
		$('input[name="gender_id"]:first').prop('checked',true);
		$('input[name="country_id"]:first').prop('checked',true);
	});	

	function contribution(entry){
		$('#post-dialog input[type="text"],#post-dialog textarea,#post-dialog .uploads').empty();
		$('input[name="entry_sn"]').val(entry);
		$('#post-dialog').dialog({
			width:680,
			title:'Contribution',
			buttons:{
				'Save':function(){
					$('#post-form').submit();
				},
				'Close':function(){
					$(this).dialog('close');
				}
			}
		});
	}

	new AjaxUpload('#button-upload', {
        action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
        name: 'attachment',
        autoSubmit: false,
        responseType: 'json',
        onChange: function(file, extension) {this.submit();},
        onComplete: function(file, json) {
            if(json.success) { 
                var html = '<div class="attach">';
                html +='<img title="'+file+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
                html +='<a class="img-remove" onclick="$(this).parent().remove();"><?php echo $text_img_delete ?></a>';
                html += '</div>';

                $("#uploadfiles").html(html);
                $('#post-dialog input[name="file"]').val(json.path);
            }else{
                alert(json.error);
            }           
            $('.loading').remove(); 
        }
    });

</script>