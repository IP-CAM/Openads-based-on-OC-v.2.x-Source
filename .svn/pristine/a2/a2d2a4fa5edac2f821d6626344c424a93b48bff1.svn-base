<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-product" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" id="form-product" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_type; ?></label>
            <div class="col-sm-10">
	            <div class="radio-line">
	              <input type="radio" name="type" value="country" <?php if($type == 'country'){ ?>checked="checked" <?php }?>/> Country
	              <input type="radio" name="type" value="gender" <?php if($type == 'gender'){ ?>checked="checked" <?php }?>/> Gender
	              <input type="radio" name="type" value="language" <?php if($type == 'language'){ ?>checked="checked" <?php }?>/> Language
				</div>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="name" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" value="<?php echo $name; ?>">
              <?php if (!empty($error_name)) { ?>
              <div class="text-danger"><?php echo $error_name; ?></div>
              <?php } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-code"><?php echo $entry_value; ?></label>
            <div class="col-sm-10">
              <input type="text" name="value" placeholder="<?php echo $entry_value; ?>" id="input-value" class="form-control" value="<?php echo $value; ?>">
              <?php if (!empty($error_value)) { ?>
              <div class="text-danger"><?php echo $error_value; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort"><?php echo $entry_sort; ?></label>
            <div class="col-sm-10">
              <input type="text" name="sort" value="<?php echo $sort; ?>" placeholder="<?php echo $entry_sort; ?>" id="input-sort" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-default"><?php echo $entry_default; ?></label>
            <div class="col-sm-10">

              <div class="radio-line">
	              <?php if ($default) { ?>
	              <input type="radio" name="type" value="1" checked="checked"><?php echo $text_yes; ?>
	              <input type="radio" name="type" value="0" ><?php echo $text_no; ?>
	              <?php } else { ?>
	              <input type="radio" name="type" value="1" ><?php echo $text_yes; ?>
	              <input type="radio" name="type" value="0" checked="checked"><?php echo $text_no; ?>
	              <?php } ?>
				</div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>