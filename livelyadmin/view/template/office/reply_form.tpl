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
            <label class="col-sm-2 control-label" for="input-time"><?php echo $entry_time; ?></label>
            <div class="col-sm-8">
              <input type="text" name="time" value="<?php echo $time; ?>" placeholder="<?php echo $entry_time; ?>" id="input-time" class="form-control " />
              <?php if ($error_time) { ?>
              <div class="text-danger"><?php echo $error_time; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group clearfix required">
            <label class="col-sm-2 control-label" for="input-work-content"><?php echo $entry_work_content; ?></label>
            <div class="col-sm-8">
              <textarea name="work_content" placeholder="<?php echo $entry_work_content; ?>" id="input-work-content" class="form-control" rows="6"><?php echo $work_content; ?></textarea>
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