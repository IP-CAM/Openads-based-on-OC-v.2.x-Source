<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
    </ul>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
    <?php } ?>
    <div class="row">
      	<div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
        <div id="content" class="col-sm-9">
              <div class="panel panel-default">
		      <div class="panel-heading">
		        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
		      </div>
		      <div class="panel-body">

		         <div class="well">
		          <div class="row filter">
		            <div class="col-sm-3">
		              <div class="form-group">
		               <label class="control-label" for="input-type"><?php echo $entry_type; ?></label>
		               <select name="filter_type" id="input-type" class="form-control">
		                  <option value="*"></option>
		                  <?php foreach ($all_money_type as $money_type) { ?>
		                  <?php if ($money_type == $filter_type) { ?>
		                  <option value="<?php echo $money_type; ?>" selected="selected"><?php echo GetLevelTypeName($money_type,$lang); ?></option>
		                  <?php } else { ?>
		                  <option value="<?php echo $money_type; ?>"><?php echo GetLevelTypeName($money_type,$lang);; ?></option>
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
		                <label class="control-label" for="input-advertise-sn"><?php echo $entry_advertise_id; ?></label>
		                <input type="text" name="filter_advertise_sn" value="<?php echo $filter_advertise_sn; ?>" placeholder="<?php echo $entry_advertise_id; ?>" id="input-advertise-sn" class="form-control" />
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
		              <div class="form-group">
		              </br>
		               <button type="button" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
		              </div>
		              <div class="form-group">
		                </br>
		                <h4><?php echo $entry_balance; ?><label class="control-label label-info" for="input-balance"><?php echo $current_balance?$current_balance:'0.00'; ?></label></h4>  
		              </div>
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
		                  
		                    
		                  <td class="text-center"><?php if ($sort == 'type') { ?>
		                    <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_type; ?></a>
		                    <?php } else { ?>
		                    <a href="<?php echo $sort_type; ?>"><?php echo $column_type; ?></a>
		                    <?php } ?></td>
		
		                  <td class="text-center"><?php if ($sort == 'advertise_sn') { ?>
		                    <a href="<?php echo $sort_advertise_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_advertise_id; ?></a>
		                    <?php } else { ?>
		                    <a href="<?php echo $sort_advertise_sn; ?>"><?php echo $column_advertise_id; ?></a>
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
		                
		                  <td class="text-center"><?php echo GetLevelTypeName($detail['type'],$lang); ?></td>
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
    </div>
</div>
<script type="text/javascript">
$('#button-filter').on('click', function() {
	url = 'index.php?route=service/customer_balance';
	
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

$('.date').datetimepicker({ pickTime: false});

</script>
<?php echo $footer; ?>