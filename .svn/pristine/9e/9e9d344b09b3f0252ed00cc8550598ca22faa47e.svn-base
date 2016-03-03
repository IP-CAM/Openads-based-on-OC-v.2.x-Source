<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-country" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-country" class="form-horizontal">
          <div class="form-group clearfix ">
            <label class="col-sm-2 control-label" for="input-date"><?php echo $entry_date; ?></label>
            <div class="col-sm-8">
              <input type="text" name="date" value="<?php echo $date; ?>" placeholder="<?php echo $entry_time; ?>" id="input-date" class="form-control date" />
              <?php if ($error_date) { ?>
              <div class="text-danger"><?php echo $error_date; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group clearfix required">
            <label class="col-sm-2 control-label" for="input-time-name"><?php echo $entry_time; ?></label>
            <div class="col-sm-8">
              <input type="text" name="time_name" value="<?php echo $time_name; ?>" placeholder="<?php echo $entry_time; ?>" id="input-time-name" class="form-control " />
              <?php if ($error_time_name) { ?>
              <div class="text-danger"><?php echo $error_time_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group clearfix required">
            <label class="col-sm-2 control-label" for="input-price"><?php echo $entry_price; ?></label>
            <div class="col-sm-8">
              <input type="text" name="price" value="<?php echo $price; ?>" placeholder="<?php echo $entry_price; ?>" id="input-price" class="form-control" />
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-2 control-label" for="input-work-content-a"><?php echo $entry_work_content_a; ?></label>
            <div class="col-sm-8">
              <pre><?php echo $work_content_a; ?></pre>
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-2 control-label" for="input-work-content-b"><?php echo $entry_work_content_b; ?></label>
            <div class="col-sm-8">
              <pre><?php echo $work_content_b; ?></pre>
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
            <div class="col-sm-8">
              <select name="confirm" id="input-confirm" class="form-control">
                <option value="1" <?php echo $confirm==1 ? 'selected="selected"' : '' ?>><?php echo $text_yes; ?></option>
                <option value="0" <?php echo !$confirm ? 'selected="selected"' : '' ?>><?php echo $text_no; ?></option>
              </select>
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-2 control-label" for="input-work_hours"><?php echo $entry_hours; ?></label>
            <div class="col-sm-8">
              <input type="text" name="work_hours" value="<?php echo $work_hours; ?>" placeholder="<?php echo $entry_hours; ?>" id="input-work_hours" class="form-control" />
            </div>
          </div>
          <div class="form-group clearfix">
            <label class="col-sm-2 control-label" for="input-note"><?php echo $entry_note; ?></label>
            <div class="col-sm-8">
              <textarea name="note" placeholder="<?php echo $entry_note; ?>" id="input-note" class="form-control"><?php echo $note; ?></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('.date').datetimepicker();
</script>
<?php echo $footer; ?>