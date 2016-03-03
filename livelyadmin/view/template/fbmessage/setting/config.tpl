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
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-initial-status"><span data-toggle="tooltip" title="<?php echo $help_message_initial_status; ?>"><?php echo $text_message_initial_status; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_initial_status" class="form-control" id="input-page-initial-status">
                            <?php foreach ($post_statuses as $item) { ?>
                              <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbmessage_initial_status) ? ' selected' : '' ?> >
                              <?php echo $item['status_id'].' '.$item['name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-initial-publish"><span data-toggle="tooltip" title="<?php echo $help_message_initial_publish; ?>"><?php echo $text_message_initial_publish; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_initial_publish" class="form-control" id="input-page-initial-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                              <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbmessage_initial_publish) ? ' selected' : '' ?> >
                              <?php echo $item['publish_id'].' '.$item['name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_auditor_attention_status; ?>"><?php echo $text_message_auditor_attention_status; ?></span></label>
                        <div class="col-sm-6">
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_statuses as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['status_id'], $fbmessage_auditor_status)) { ?>
                                    <input type="checkbox" name="fbmessage_auditor_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_auditor_status[]" value="<?php echo $item['status_id']; ?>" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_auditor_attention_publish; ?>"><?php echo $text_message_auditor_attention_publish; ?></span></label>
                        <div class="col-sm-6">
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_publishes as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['publish_id'], $fbmessage_auditor_publish)) { ?>
                                    <input type="checkbox" name="fbmessage_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_auditor_approve_status; ?>"><?php echo $text_message_auditor_approve_status; ?></span></label>
                        <div class="col-sm-6">
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_statuses as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['status_id'], $fbmessage_auditor_approve)) { ?>
                                    <input type="checkbox" name="fbmessage_auditor_approve[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_auditor_approve[]" value="<?php echo $item['status_id']; ?>" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_auditor_modify_publish; ?>"><?php echo $text_message_auditor_modify_publish; ?></span></label>
                        <div class="col-sm-6">

                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_publishes as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['publish_id'], $fbmessage_auditor_modify)) { ?>
                                    <input type="checkbox" name="fbmessage_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_level_status; ?>"><?php echo $text_message_level_status; ?></span></label>
                        <div class="col-sm-6">
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_statuses as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['status_id'], $fbmessage_level_status)) { ?>
                                    <input type="checkbox" name="fbmessage_level_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_level_status[]" value="<?php echo $item['status_id']; ?>" />
                                    <?php echo $item['status_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_message_promotion_modify_publish; ?>"><?php echo $text_message_promotion_modify_publish; ?></span></label>
                        <div class="col-sm-6">
                            <div class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php foreach ($post_publishes as $item) { ?>
                                <div class="checkbox">
                                    <label>
                                    <?php if (in_array($item['publish_id'], $fbmessage_promotion_modify)) { ?>
                                    <input type="checkbox" name="fbmessage_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } else { ?>
                                    <input type="checkbox" name="fbmessage_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                    <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    <?php } ?>
                                    </label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-promoting-publish"><span data-toggle="tooltip" title="<?php echo $help_message_promoting_publish; ?>"><?php echo $text_message_promoting_publish; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_promoting_publish" class="form-control" id="input-page-promoting-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                              <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbmessage_promoting_publish) ? ' selected' : '' ?> >
                              <?php echo $item['publish_id'].' '.$item['name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-testing-publish"><span data-toggle="tooltip" title="<?php echo $help_message_testing_publish; ?>"><?php echo $text_message_testing_publish; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_testing_publish" class="form-control" id="input-page-testing-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                              <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbmessage_testing_publish) ? ' selected' : '' ?> >
                              <?php echo $item['publish_id'].' '.$item['name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-rejected-status"><span data-toggle="tooltip" title="<?php echo $help_message_rejected_status; ?>"><?php echo $text_message_rejected_status; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_rejected_status" class="form-control" id="input-page-rejected-status">
                            <?php foreach ($post_statuses as $item) { ?>
                              <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbmessage_rejected_status) ? ' selected' : '' ?> >
                              <?php echo $item['status_id'].' '.$item['name']; ?>
                              </option>
                              <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-similar-text-percent"><span data-toggle="tooltip" title="<?php echo $help_message_similar_percent; ?>"><?php echo $text_message_similar_percent; ?></span></label>
                        <div class="col-sm-6">
                            <input type="text" name="fbmessage_similar_percent" value="<?php echo $fbmessage_similar_percent; ?>" size="3" class="form-control" id="input-page-similar-text-percent"/>
                        </div>
                    </div>
                    <div class="form-group clearfix required">
                        <label class="col-sm-4 control-label" for="input-page-expired-publish"><span data-toggle="tooltip" title="<?php echo $help_message_promote_expired_publish; ?>"><?php echo $text_message_promote_expired_publish; ?></span></label>
                        <div class="col-sm-6">
                            <select name="fbmessage_expired_publish" class="form-control" id="input-page-expired-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                              <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbmessage_expired_publish) ? ' selected' : '' ?> >
                              <?php echo $item['publish_id'].' '.$item['name']; ?>
                              </option>
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