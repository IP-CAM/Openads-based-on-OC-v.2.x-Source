<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-office_name"><?php echo $entry_office_name; ?></label>
            <div class="col-sm-10">
              <input type="text" name="office_name" value="<?php echo $office_name; ?>" placeholder="<?php echo $entry_office_name; ?>" id="input-office_name" class="form-control" />
              <?php if ($error_office_name) { ?>
              <div class="text-danger"><?php echo $error_office_name; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-nickname"><?php echo $entry_nickname; ?></label>
            <div class="col-sm-10">
              <input type="text" name="nickname" value="<?php echo $nickname; ?>" placeholder="<?php echo $entry_nickname; ?>" id="input-nickname" class="form-control" />
              <?php if ($error_nickname) { ?>
              <div class="text-danger"><?php echo $error_nickname; ?></div>
              <?php } ?>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-user-group"><?php echo $entry_office_group; ?></label>
            <div class="col-sm-10">
              <select name="office_group_id" id="input-offic-group" class="form-control">
                <?php foreach ($office_group_ids as $office_group) { ?>
                <?php if ($office_group == $office_group_id) { ?>
                <option value="<?php echo $office_group; ?>" selected="selected"><?php echo getOfficeGroupName($office_group); ?></option>
                <?php } else { ?>
                <option value="<?php echo $office_group; ?>"><?php echo getOfficeGroupName($office_group); ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-handphone"><?php echo $entry_handphone; ?></label>
            <div class="col-sm-10">
              <input type="text" name="handphone" value="<?php echo $handphone; ?>" placeholder="<?php echo $entry_handphone; ?>" id="input-handphone" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-qq"><?php echo $entry_qq; ?></label>
            <div class="col-sm-10">
              <input type="text" name="qq" value="<?php echo $qq; ?>" placeholder="<?php echo $entry_qq; ?>" id="input-qq" class="form-control" />
            </div>
          </div>

          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
            <div class="col-sm-10">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" autocomplete="off" />
              <?php if ($error_password) { ?>
              <div class="text-danger"><?php echo $error_password; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group required">
            <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
            <div class="col-sm-10">
              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm" class="form-control" />
              <?php if ($error_confirm) { ?>
              <div class="text-danger"><?php echo $error_confirm; ?></div>
              <?php  } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" id="input-status" class="form-control">
                <?php if ($status) { ?>
                <option value="0"><?php echo $text_disabled; ?></option>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <option value="1"><?php echo $text_enabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?> 