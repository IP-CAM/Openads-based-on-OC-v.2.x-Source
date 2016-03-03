<div  class="col-sm-12 clearfix">
    <div class="do-result"></div>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
        <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab-general">
            <form class="form-horizontal">
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                    <div class="col-sm-9">
                        <?php foreach ($ad_publishes as $item) { ?>
                        <?php if(in_array($item['publish_id'],$publish_statuses)) { ?>

                        <div class="<?php echo $item['publish_id'] == $terminal ? 'radio' : 'radio-inline' ?>">
                            <label>
                                <input type="radio" name="publish" value="<?php echo $item['publish_id']; ?>"
                                <?php echo ($item['publish_id'] == $publish) ? 'checked' : '' ?> >
                                <?php echo $item['name']; ?>
                            </label>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group clearfix hidden">
                    <label class="col-sm-2 text-right" for="input-notify"><?php echo $entry_notify; ?></label>
                    <div class="col-sm-9">
                        <input type="checkbox" name="notify" checked value="1" id="input-notify"/>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 text-right" for="input-note"><?php echo $entry_note; ?></label>
                    <div class="col-sm-9">
                        <textarea name="note" rows="3" id="input-note" class="form-control"></textarea>
                    </div>
                </div>

            </form>
        </div>
        <div class="tab-pane " id="tab-history">
            <div id="logs"></div>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
    $('#component-detail').dialog('option', 'title', '<?php echo $heading_title ?>');
    $('#component-detail').dialog('option', 'buttons' ,{
        '<?php echo $button_save; ?>' : function (e,ui) {
            $.ajax({
                url: 'index.php?route=service/advertise/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>',
                type: 'post',
                dataType: 'json',
                data: 'publish=' + encodeURIComponent($('select[name=\'publish\']').val()) + '&notify=' + ($('input[name=\'notify\']').prop('checked') ? 1 : 0) + '&note=' + encodeURIComponent($('#input-note').val()),

                success: function (json) {
                    $('.alert').remove();
                    if (json['error']) {
                        $('#component-detail .do-result').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }
                    if (json['success']) {

                        $('#component-detail .do-result').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        $('#ad-note').html($('input[name=\'note\']').val());
                        $('input[name=\'note\']').val('');
                        $(this).html($('select[name=\'publish\'] option:selected').text());

                        $('#logs').load('index.php?route=service/advertise/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>');
                    }
                    return false;
                }
            });
        }
    });
    $('#logs').delegate('.pagination a', 'click', function (e) {
        e.preventDefault();
        $('#logs').load(this.href);
    });

    $('#logs').load('index.php?route=service/advertise/history&token=<?php echo $token; ?>&advertise_id=<?php echo $advertise_id; ?>');

//--></script>
