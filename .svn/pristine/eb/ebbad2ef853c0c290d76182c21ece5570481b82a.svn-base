<div class="col-sm-12">
	<form method="post" class="form-horizontal" id="post-form" action="<?php echo $post_action; ?>">
		<input type="hidden" name="entry_sn">
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
	    })
	});	

	function contribution(entry){
		$('#post-dialog input[type="text"],#post-dialog textarea').empty();
		$('input[name="entry_sn"]').val(entry);
		$('#post-dialog').dialog({
			width:680,
			title:'Contribution',
			buttons:{
				'Save':function(){$('#post-form').submit();},
				'Close':function(){	$(this).dialog('close');}
			}
		});
	}
</script>