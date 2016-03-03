<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row">
    <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
    <div id="content" class="col-sm-9">
      <h1><?php echo $heading_title; ?></h1>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
        <fieldset>
          <legend><?php echo $text_your_details; ?></legend>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-customer-sn"><?php echo $entry_username; ?></label>
            <div class="col-sm-10">
              <span class="form-control disabled" id="input-customer-sn"><?php echo $username; ?></span>
            </div>
          </div>
          <div class="form-group ">
            <label class="col-sm-2 control-label" for="input-nickname"><?php echo $entry_nickname; ?> </label>
            <div class="col-sm-10">
              <input type="text" name="nickname" value="<?php echo $nickname; ?>" placeholder="<?php echo $entry_nickname; ?>" id="input-nickname" class="form-control" />
            </div>
          </div>
          <div class="form-group hidden ">
            <label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?> </label>
            <div class="col-sm-10">
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />

            </div>
          </div>
          <div class="form-group hidden">
            <label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
            <div class="col-sm-10">
              <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />

            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-company"><?php echo $entry_company; ?></label>
            <div class="col-sm-10">
              <input type="text" name="company" value="<?php echo $company; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company" class="form-control" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-contact"><?php echo $entry_contact; ?></label>
            <div class="col-sm-10">
              <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="<?php echo $entry_contact; ?>" id="input-contact" class="form-control" />
            </div>
          </div>
        </fieldset>
        <div class="buttons clearfix">
          <div class="pull-left"><a href="<?php echo $back; ?>" class="btn btn-default"><?php echo $button_back; ?></a></div>
          <div class="pull-right">
            <input type="submit" value="<?php echo $button_continue; ?>" class="btn btn-primary" />
          </div>
        </div>
      </form>
      </div>
    </div>
</div>
<script type="text/javascript"><!--


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
//--></script> 
<?php echo $footer; ?>