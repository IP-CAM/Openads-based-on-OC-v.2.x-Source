<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">

                        <div class="form-group required">
                            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_group_admin; ?>"><?php echo $text_group_admin; ?></span></label>
                            <div class="col-sm-9">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                  <?php foreach ($all_users as $item) { ?>
                                    <div class="checkbox">
                                        <label>
                                          <?php if (in_array($item['user_id'], $sns_group_admin)) { ?>
                                          <input type="checkbox" name="sns_group_admin[]" value="<?php echo $item['user_id']; ?>" checked="checked" />
                                          <?php echo $item['lastname'].$item['firstname']; ?>
                                          <?php } else { ?>
                                          <input type="checkbox" name="sns_group_admin[]" value="<?php echo $item['user_id']; ?>" />
                                          <?php echo $item['lastname'].$item['firstname']; ?>
                                          <?php } ?>
                                        </label>
                                    </div>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_group_promotion; ?>"><?php echo $text_group_promotion; ?></span></label>
                            <div class="col-sm-9">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                  <?php foreach ($all_users as $item) { ?>
                                  <div class="checkbox">
                                    <label>
                                      <?php if (in_array($item['user_id'], $sns_group_promotion)) { ?>
                                      <input type="checkbox" name="sns_group_promotion[]" value="<?php echo $item['user_id']; ?>" checked="checked" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } else { ?>
                                      <input type="checkbox" name="sns_group_promotion[]" value="<?php echo $item['user_id']; ?>" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } ?>
                                    </label>
                                  </div>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_group_artist; ?>"><?php echo $text_group_artist; ?></span></label>
                            <div class="col-sm-9">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                  <?php foreach ($all_users as $item) { ?>
                                  <div class="checkbox">
                                    <label>
                                      <?php if (in_array($item['user_id'], $sns_group_artist)) { ?>
                                      <input type="checkbox" name="sns_group_artist[]" value="<?php echo $item['user_id']; ?>" checked="checked" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } else { ?>
                                      <input type="checkbox" name="sns_group_artist[]" value="<?php echo $item['user_id']; ?>" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } ?>
                                    </label>
                                  </div>
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-sm-3 control-label"><span data-toggle="tooltip" title="<?php echo $help_group_market; ?>"><?php echo $text_group_market; ?></span></label>
                            <div class="col-sm-9">
                                <div class="well well-sm" style="height: 150px; overflow: auto;">
                                  <?php foreach ($all_users as $item) { ?>
                                  <div class="checkbox">
                                    <label>
                                      <?php if (in_array($item['user_id'], $sns_group_market)) { ?>
                                      <input type="checkbox" name="sns_group_market[]" value="<?php echo $item['user_id']; ?>" checked="checked" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } else { ?>
                                      <input type="checkbox" name="sns_group_market[]" value="<?php echo $item['user_id']; ?>" />
                                      <?php echo $item['lastname'].$item['firstname']; ?>
                                      <?php } ?>
                                    </label>
                                  </div>
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