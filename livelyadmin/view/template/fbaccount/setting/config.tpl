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
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-nophoto" data-toggle="tab"><?php echo $tab_nophoto; ?></a></li>
                        <li><a href="#tab-photo" data-toggle="tab"><?php echo $tab_photo; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-nophoto">
                            <fieldset>
                                <legend><?php echo $text_nophoto_initial_status ?></legend>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-initial-status"><span data-toggle="tooltip" title="<?php echo $help_nophoto_initial_status; ?>"><?php echo $text_nophoto_initial_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_initial_status" class="form-control" id="input-nophoto-initial-status">
                                        <?php foreach ($post_statuses as $item) { ?>
                                          <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbaccount_initial_status) ? ' selected' : '' ?> >
                                          <?php echo $item['status_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-initial-publish"><span data-toggle="tooltip" title="<?php echo $help_nophoto_initial_publish; ?>"><?php echo $text_nophoto_initial_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_initial_publish" class="form-control" id="input-nophoto-initial-publish">
                                        <?php foreach ($post_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_initial_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_auditor_attention_status; ?>"><?php echo $text_nophoto_auditor_attention_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_auditor_status)) { ?>
                                                <input type="checkbox" name="fbaccount_auditor_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_auditor_status[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_auditor_attention_publish; ?>"><?php echo $text_nophoto_auditor_attention_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_auditor_publish)) { ?>
                                                <input type="checkbox" name="fbaccount_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_auditor_approve_status; ?>"><?php echo $text_nophoto_auditor_approve_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_auditor_approve)) { ?>
                                                <input type="checkbox" name="fbaccount_auditor_approve[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_auditor_approve[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_auditor_modify_publish; ?>"><?php echo $text_nophoto_auditor_modify_publish; ?></span></label>
                                    <div class="col-sm-6">

                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_auditor_modify)) { ?>
                                                <input type="checkbox" name="fbaccount_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_level_status; ?>"><?php echo $text_nophoto_level_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_level_status)) { ?>
                                                <input type="checkbox" name="fbaccount_level_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_level_status[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_nophoto_promotion_modify_publish; ?>"><?php echo $text_nophoto_promotion_modify_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($post_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_promotion_modify)) { ?>
                                                <input type="checkbox" name="fbaccount_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-promoting-publish"><span data-toggle="tooltip" title="<?php echo $help_nophoto_promoting_publish; ?>"><?php echo $text_nophoto_promoting_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_promoting_publish" class="form-control" id="input-nophoto-promoting-publish">
                                        <?php foreach ($post_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_promoting_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-testing-publish"><span data-toggle="tooltip" title="<?php echo $help_nophoto_testing_publish; ?>"><?php echo $text_nophoto_testing_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_testing_publish" class="form-control" id="input-nophoto-testing-publish">
                                        <?php foreach ($post_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_testing_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-rejected-status"><span data-toggle="tooltip" title="<?php echo $help_nophoto_rejected_status; ?>"><?php echo $text_nophoto_rejected_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_rejected_status" class="form-control" id="input-nophoto-rejected-status">
                                        <?php foreach ($post_statuses as $item) { ?>
                                          <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbaccount_rejected_status) ? ' selected' : '' ?> >
                                          <?php echo $item['status_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-similar-text-percent"><span data-toggle="tooltip" title="<?php echo $help_nophoto_similar_percent; ?>"><?php echo $text_nophoto_similar_percent; ?></span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="fbaccount_similar_percent" value="<?php echo $fbaccount_similar_percent; ?>" size="3" class="form-control" id="input-nophoto-similar-text-percent"/>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-nophoto-expired-publish"><span data-toggle="tooltip" title="<?php echo $help_nophoto_promote_expired_publish; ?>"><?php echo $text_nophoto_promote_expired_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_expired_publish" class="form-control" id="input-nophoto-expired-publish">
                                        <?php foreach ($post_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_expired_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="tab-pane" id="tab-photo">
                            <fieldset>
                                <legend><?php echo $text_photo_initial_status ?></legend>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-initial-status"><span data-toggle="tooltip" title="<?php echo $help_photo_initial_status; ?>"><?php echo $text_photo_initial_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_initial_status" class="form-control" id="input-photo-initial-status">
                                        <?php foreach ($photo_statuses as $item) { ?>
                                          <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbaccount_photo_initial_status) ? ' selected' : '' ?> >
                                          <?php echo $item['status_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-initial-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_initial_publish; ?>"><?php echo $text_photo_initial_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_initial_publish" class="form-control" id="input-photo-initial-publish">
                                        <?php foreach ($photo_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_photo_initial_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_auditor_attention_status; ?>"><?php echo $text_photo_auditor_attention_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_photo_auditor_status)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_status[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_auditor_attention_publish; ?>"><?php echo $text_photo_auditor_attention_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_photo_auditor_publish)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_publish[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_auditor_approve_status; ?>"><?php echo $text_photo_auditor_approve_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_photo_auditor_approve)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_approve[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_approve[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_auditor_modify_publish; ?>"><?php echo $text_photo_auditor_modify_publish; ?></span></label>
                                    <div class="col-sm-6">

                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_photo_auditor_modify)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_auditor_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_level_status; ?>"><?php echo $text_photo_level_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_statuses as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['status_id'], $fbaccount_photo_level_status)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_level_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_level_status[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label"><span data-toggle="tooltip" title="<?php echo $help_photo_promotion_modify_publish; ?>"><?php echo $text_photo_promotion_modify_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_publishes as $item) { ?>
                                            <div class="checkbox">
                                                <label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_photo_promotion_modify)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_promotion_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                                </label>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-promoting-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_promoting_publish; ?>"><?php echo $text_photo_promoting_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_promoting_publish" class="form-control" id="input-photo-promoting-publish">
                                        <?php foreach ($photo_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_photo_promoting_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-testing-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_testing_publish; ?>"><?php echo $text_photo_testing_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_testing_publish" class="form-control" id="input-photo-testing-publish">
                                        <?php foreach ($photo_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_photo_testing_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-rejected-status"><span data-toggle="tooltip" title="<?php echo $help_photo_rejected_status; ?>"><?php echo $text_photo_rejected_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_rejected_status" class="form-control" id="input-photo-rejected-status">
                                        <?php foreach ($photo_statuses as $item) { ?>
                                          <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbaccount_photo_rejected_status) ? ' selected' : '' ?> >
                                          <?php echo $item['status_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-similar-text-percent"><span data-toggle="tooltip" title="<?php echo $help_photo_similar_percent; ?>"><?php echo $text_photo_similar_percent; ?></span></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="fbaccount_photo_similar_percent" value="<?php echo $fbaccount_photo_similar_percent; ?>" size="3" class="form-control" id="input-photo-similar-text-percent"/>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-expired-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_promote_expired_publish; ?>"><?php echo $text_photo_promote_expired_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_expired_publish" class="form-control" id="input-photo-expired-publish">
                                        <?php foreach ($photo_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_photo_expired_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-attention-status"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_attention_status; ?>"><?php echo $text_photo_artist_attention_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_statuses as $item) { ?>
                                            <div class="checkbox"><label>
                                                <?php if (in_array($item['status_id'], $fbaccount_photo_artist_status)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_status[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_status[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                            </label></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-attention-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_attention_publish; ?>"><?php echo $text_photo_artist_attention_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_publishes as $item) { ?>
                                            <div class="checkbox"><label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_photo_artist_publish)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_publish[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_publish[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                            </label></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-finished-status"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_finished_status; ?>"><?php echo $text_photo_artist_finished_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_artist_finished_status" class="form-control" id="input-photo-artist-finished-status">
                                        <?php foreach ($photo_statuses as $item) { ?>
                                          <option value="<?php echo $item['status_id']; ?>" <?php echo ($item['status_id'] == $fbaccount_photo_artist_finished_status) ? ' selected' : '' ?> >
                                          <?php echo $item['status_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-attention-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_attention_publish; ?>"><?php echo $text_photo_artist_attention_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <select name="fbaccount_photo_artist_finished_publish" class="form-control" id="input-photo-artist-finished-publish">
                                        <?php foreach ($photo_publishes as $item) { ?>
                                          <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $fbaccount_photo_artist_finished_publish) ? ' selected' : '' ?> >
                                          <?php echo $item['publish_id'].' '.$item['name']; ?>
                                          </option>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-approve"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_approve_status; ?>"><?php echo $text_photo_artist_approve_status; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_statuses as $item) { ?>
                                            <div class="checkbox"><label>
                                                <?php if (in_array($item['status_id'], $fbaccount_photo_artist_approve)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_approve[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_approve[]" value="<?php echo $item['status_id']; ?>" />
                                                <?php echo $item['status_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                            </label></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix required">
                                    <label class="col-sm-4 control-label" for="input-photo-artist-modify-publish"><span data-toggle="tooltip" title="<?php echo $help_photo_artist_modify_publish; ?>"><?php echo $text_photo_artist_modify_publish; ?></span></label>
                                    <div class="col-sm-6">
                                        <div class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php foreach ($photo_publishes as $item) { ?>
                                            <div class="checkbox"><label>
                                                <?php if (in_array($item['publish_id'], $fbaccount_photo_artist_modify)) { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_modify[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } else { ?>
                                                <input type="checkbox" name="fbaccount_photo_artist_modify[]" value="<?php echo $item['publish_id']; ?>" />
                                                <?php echo $item['publish_id'].' '.$item['name']; ?>
                                                <?php } ?>
                                            </label></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>