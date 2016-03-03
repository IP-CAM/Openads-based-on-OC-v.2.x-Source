<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
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
         <div class="well">
          <div class="row filter">
           <div class="col-sm-4">
              <div class="form-group">
                    <h4><?php echo $entry_username; ?><span class="label label-info"><?php echo $base_infos['username']; ?></span></h4>             
              </div>
              <div class="form-group">
                 <h4><?php echo $entry_customer_name; ?><span class="label label-info"><?php echo $base_infos['customer']; ?></span></h4>  
              </div>
            </div>  
            <div class="col-sm-4">
              <div class="form-group">
                 <h4><?php echo $entry_email; ?><span class="label label-info"><?php echo $base_infos['email']; ?></span></h4>            
              </div>
              <div class="form-group">
                <h4><?php echo $entry_balance; ?><span class="label label-info"><?php echo $current_balance; ?></span></h4>  
              </div>
            </div>  
            <div class="col-sm-1">
              <div class="form-group">
                <button id="button-history" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_edit_balance; ?></button>             
              </div>

            </div>            
           </div>
         </div>
         <div class="well">
          <div class="row filter">
            <div class="col-sm-3">
              <div class="form-group">
               <label class="control-label" for="input-type"><?php echo $entry_type; ?></label>
               <select name="filter_type" id="input-type" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($all_money_type as $money_type) { ?>
                  <?php if ($money_type == $filter_type) { ?>
                  <option value="<?php echo $money_type; ?>" selected="selected"><?php echo GetLevelTypeName($money_type,"en"); ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $money_type; ?>"><?php echo GetLevelTypeName($money_type,"en");; ?></option>
                  <?php } ?>
                  <?php } ?>
                   
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-amount"><?php echo $entry_amount; ?></label>
                <input type="text" name="filter_amount" value="<?php echo $filter_amount; ?>" placeholder="<?php echo $entry_amount; ?>" id="input-amount" class="form-control" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-advertise-id"><?php echo $entry_advertise_id; ?></label>
                <input type="text" name="filter_advertise_sn" value="<?php echo $filter_advertise_sn; ?>" placeholder="<?php echo $entry_advertise_id; ?>" id="input-advertise-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
            </div>

            <div class="col-sm-3">

              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  
                  <td class="text-left"><?php if ($sort == 'date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php echo $column_operator; ?></td>
                    
                  <td class="text-center"><?php if ($sort == 'type') { ?>
                    <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
                    <?php } ?></td>

                  <td class="text-center"><?php if ($sort == 'advertise_sn') { ?>
                    <a href="<?php echo $sort_advertise_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_advertise_sn; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_advertise_sn; ?>"><?php echo $column_advertise_sn; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php echo $column_priority_id; ?></td>
                  <td class="text-center"><?php echo $column_amount; ?></td>  
                  <td class="text-center"><?php echo $column_note; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($details) { ?>
                <?php foreach ($details as $detail) { ?>
                <tr>
                  <td class="text-left"><?php echo $detail['date_added']; ?></td>
                  <td class="text-center"><?php echo $detail['username']; ?></td>
                  <td class="text-center"><?php echo GetLevelTypeName($detail['type'],"en"); ?></td>
                  <td class="text-center"><?php echo $detail['advertise_sn']; ?></td>
                  <td class="text-center"><?php echo ($detail['from_priority_name']?$detail['from_priority_name']."->":'')?><?php echo $detail['priority_name']?($detail['priority_name']):''; ?></td>
                  <td class="text-center"><?php echo $detail['amount']; ?></td>
                  <td class="text-center"><?php echo $detail['note']; ?></td>
           
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="13"><?php echo $text_no_results; ?></td>
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
  <div id="new-dialog" title="<?php echo $base_infos['username'] ?>">
  <div class="col-sm-11 clearfix">
    <form action="<?php echo $action; ?>" method="post" class="form-horizontal" id="ws-form">
      <input type="hidden" name="action" value="create">
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-type"><?php echo $entry_type ?></label>
          <div class="col-sm-9 ">
              
               <select name="filter_type" id="input-type" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($all_money_type as $money_type) { ?>
                  <?php if ($money_type == $filter_type) { ?>
                  <option value="<?php echo $money_type; ?>" selected="selected"><?php echo GetLevelTypeName($money_type,"en"); ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $money_type; ?>"><?php echo GetLevelTypeName($money_type,"en");; ?></option>
                  <?php } ?>
                  <?php } ?>
                   
                </select>
          </div>
      </div>
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-amount"><?php echo $entry_amount ?></label>
          <div class="col-sm-9">
              <input type="text" name="amount" class="form-control" id="input-amount"/>
          </div>
      </div>
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-note"><?php echo $entry_note ?></label>
          <div class="col-sm-9">
              <textarea  name="note" class="form-control" id="input-note"></textarea>
          </div>
      </div>
    </form>
   </div>
  </div>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=finance/customer_balance/edit&customer_id=<?php echo $base_infos['customer_id']; ?>&token=<?php echo $token; ?>';
	
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
//--></script> 
<script type="text/javascript"><!--
  $('#button-history').on('click',function(){
	    $('#new-dialog').dialog('open');
	  })
	  $('#new-dialog').dialog({
	    autoOpen:false,
	    modal: true,
	    width: 600,
	    resizable:false,
	    buttons: {
	        "<?php echo $button_create ?>": function () {
	            $('#ws-form').submit();
	        },
	        "<?php echo $button_cancel ?>": function () {
	            $(this).dialog("close");
	        }
	    }
	  });
	  
$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});	
//--></script></div>
<?php echo $footer; ?>