<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-country').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row filter">
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-date-start"><?php echo $entry_date_start; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" placeholder="<?php echo $entry_date_start; ?>" data-date-format="YYYY-MM-DD" id="input-date-start" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-end"><?php echo $entry_date_end; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" placeholder="<?php echo $entry_date_end; ?>" data-date-format="YYYY-MM-DD" id="input-date-end" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
              </div>
              
            </div>
            
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-office"><?php echo $entry_office; ?></label>
                <select name="filter_office" id="input-office" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($offices as $item) { ?>
                  <?php if ($filter_office == $item['office_id']) { ?>
                  <option value="<?php echo $item['office_id']; ?>" selected="selected"><?php echo $item['nickname']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['office_id']; ?>"><?php echo $item['nickname']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-user"><?php echo $entry_user; ?></label>
                <select name="filter_user" id="input-user" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($users as $item) { ?>
                  <?php if ($filter_user == $item['user_id']) { ?>
                  <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              
              <div class="form-group">
                <label class="control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                <select name="filter_confirm" id="input-confirm" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_confirm) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <?php } ?>
                  <?php if (!$filter_confirm && !is_null($filter_confirm)) { ?>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-time"><?php echo $entry_time; ?></label>
                <select name="filter_time" id="input-time" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($times as $item) { ?>
                  <?php if ($filter_time == $item['time_id']) { ?>
                  <option value="<?php echo $item['time_id']; ?>" selected="selected"><?php echo $item['time_name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['time_id']; ?>"><?php echo $item['time_name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              
            </div>
            <div class="col-sm-3">
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-country">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php if ($sort == 'om.date') { ?>
                    <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'om.time_name') { ?>
                    <a href="<?php echo $sort_time_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_time; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_time_name; ?>"><?php echo $column_time; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'om.office_id') { ?>
                    <a href="<?php echo $sort_office; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_office; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_office; ?>"><?php echo $column_office; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'om.user_id') { ?>
                    <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_user; ?>"><?php echo $column_user; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'om.confirm') { ?>
                    <a href="<?php echo $sort_confirm; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_confirm; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_confirm; ?>"><?php echo $column_confirm; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'om.work_hours') { ?>
                    <a href="<?php echo $sort_hours; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_hours; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_hours; ?>"><?php echo $column_hours; ?></a>
                    <?php } ?></td>

                  <td class="text-center"><?php if ($sort == 'om.amount') { ?>
                    <a href="<?php echo $sort_amount; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_amount; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_amount; ?>"><?php echo $column_amount; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($monitors) { ?>
                <?php foreach ($monitors as $item) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($item['monitor_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $item['monitor_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $item['monitor_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-center"><?php echo $item['date']; ?></td>
                  <td class="text-center"><?php echo $item['time_name']; ?></td>
                  <td class="text-center"><?php echo $item['office']; ?></td>
                  <td class="text-center"><?php echo $item['user']; ?></td>
                  <td class="text-center"><?php echo $item['confirm']; ?></td>
                  <td class="text-center"><?php echo $item['work_hours']; ?></td>
                  <td class="text-center"><?php echo $item['amount']; ?></td>
                  <td class="text-right">
                    <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
  url = 'index.php?route=office/monitor&token=<?php echo $token; ?>';
  
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
$('.date').datetimepicker({
  pickTime: false
});
//--></script>
<?php echo $footer; ?>