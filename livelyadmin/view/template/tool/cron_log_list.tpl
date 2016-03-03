<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" id="copy_template_back" title="<?php echo "Copy Template"; ?>" > <i class="fa fa-copy-o"></i></button>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-upload').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
       
      </div>
      <div class="panel-body">

        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
	            <tr>
	              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
	                
	                <td class="left"><?php if ($sort == 'contribute_id') { ?>
	                <a href="<?php echo $sort_contribute_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo "Post ID"; ?></a>
	                <?php } else { ?>
	                <a href="<?php echo $sort_contribute_id; ?>"><?php echo "Post ID"; ?></a>
	                <?php } ?></td>
	                
	                <td class="left"><?php if ($sort == 'action') { ?>
	                <a href="<?php echo $sort_action; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_action; ?></a>
	                <?php } else { ?>
	                <a href="<?php echo $sort_action; ?>"><?php echo $column_log_action; ?></a>
	                <?php } ?></td>
	                
	                
	                <td class="left"><?php if ($sort == 'log_time') { ?>
	                <a href="<?php echo $sort_log_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_time; ?></a>
	                <?php } else { ?>
	                <a href="<?php echo $sort_log_time; ?>"><?php echo $column_log_time; ?></a>
	                <?php } ?></td>
	              
	            </tr>
              </thead>
              <tbody>
                <tr class="filter">
	              <td></td>
	              <td><input type="text" name="filter_contribute_id" value="<?php echo $filter_contribute_id; ?>" size=10/></td>
	              <td></td>
	              <td align="right"><a onclick="filter();" class="btn btn-info"><?php echo $button_filter; ?></a></td>
	            </tr>
                <?php if ($cron_logs) { ?>
                <?php foreach ($cron_logs as $cron_log) { ?>
                <tr>
                  <td class="text-center"><?php if ($cron_log['selected']) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $cron_log['id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $cron_log['id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $cron_log['contribute_id']; ?></td>
                  <td class="text-left"><?php echo $cron_log['action']; ?></td>
                  <td class="text-left"><?php echo $cron_log['log_time']; ?></td>
                 
                 
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
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
  <script type="text/javascript"><!--
  function truncate_logs(){
		if (!confirm('Logging data will not resume! Are you sure you want to do this?')) {
	        return false;
	    }else{
			$.ajax({url:'index.php?route=tool/cron_log/truncate&token=<?php echo $token; ?>',type:'get',dataType:'json',success:function(data){
				$('.msg').remove();
				if(data.warning){
					$('.breadcrumb').after('<div class="warning msg">'+data.warning+'</div>');
				}else{		
					$('.breadcrumb').after('<div class="success msg">'+data.success+'</div>');
					location.href='index.php?route=tool/cron_log&token=<?php echo $token; ?>';
				}
				//
			}});
	    }
	}
	
  function filter() {
		url = 'index.php?route=tool/cron_log&token=<?php echo $token; ?>';
	  var paramArr=[];
	  $("tr.filter input[name],tr.filter select[name]").each(function(){
	    if($(this).val()&&$(this).val()!='*'){
	      paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
	    }
	  });
	  if(paramArr.length>0){
	    url+="&"+paramArr.join("&");
	  }
	  location = url;
	}
	$('#copy_template').bind('click',function() {
	    
	    $.get("index.php?route=tool/cron_log/copy_template&token=<?php echo $token; ?>", function(data){
	    	  alert("Data Loaded: " + data);
	    	});
	});
//--></script> 
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>
<?php echo $footer; ?>