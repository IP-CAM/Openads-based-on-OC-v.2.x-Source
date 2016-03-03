<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row">
    <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
    <div id="content" class="col-sm-9">
      <ul class="nav nav-tabs" id="ad-tabs">
        <li class="active"><a href="#tab-general"><?php echo $tab_general ?></a></li>
        <li><a href="#tab-history"><?php echo $tab_history ?></a></li>
        <li><a href="#tab-tracking"><?php echo $tab_tracking ?></a></li>
      </ul>
      <div class="tab-content">
        <div id="tab-general" class="tab-pane active">
          <div class="panel panel-success">
            <div class="panel-heading">
               <h3 class="panel-title"><?php echo $text_ad_detail ?></h3>
            </div>
            <div class="panel-body">
              <fieldset id="ad-status">
                <div class="text-center">
                  <img src="<?php echo TPL_IMG ?>loading_lg.gif"/>
                  <?php echo $text_loading ?>
                </div>
              </fieldset>                                     
              <fieldset>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label text-right"><?php echo $text_website ?></label>
                  <div class="col-sm-8 ">
                      <input type="text" class="form-control" disabled value="<?php echo $domain ?>" />
                  </div>
                </div>
                
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_product ?></label>
                    <div class="col-sm-8 ">
                        <?php foreach ($products as $item): ?>
                        <?php if($item['product_id']==$product_id){ ?>
                        <b class="gh-btn">
                            <span class="gh-text"><?php echo $item['name']; ?></span>
                        </b>
                        <?php } ?>
                        <?php endforeach ?>   
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_priority ?></label>
                    <div class="col-sm-8 ">
                        <div class="btn-group btns-queue">  
                            <button type="button" class="btn btn-primary"><?php echo $priority; ?></button>                     
                          <button type="button" class="btn dropdown-toggle btn-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $amount ?>
                          </button>
                        </div>
                    </div>
                </div>
                <?php if(!empty($note)){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_note ?></label>
                    <div class="col-sm-8 ">
                        <textarea id="ad-note" class="form-control" disabled><?php echo $note ?></textarea>
                    </div>
                </div>
                <?php }?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_date_added ?></label>
                    <div class="col-sm-8 ">
                        <label class="label label-default"><?php echo $date_added ?></label>
                    </div>
                </div>
              </fieldset>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"><?php echo $text_targeting ?></h3></div>
            <div class="panel-body">
              <fieldset id="ad-targeting">
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_target_url ?></label>
                    <div class="col-sm-8 ">
                        <textarea class="form-control" disabled><?php echo $target_url ?></textarea>
                    </div>
                </div>
                <div class="form-group clearfix hidden">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_from ?></label>
                    <div class="col-sm-8">
                        <span class="label label-default">
                            <?php echo $targeting['from'] == "member" ? $text_member : $text_backend ?>
                        </span>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $progress_status ?></label>
                    <div class="col-sm-8">
                        <?php echo $targeting['progress'] ?>
                        <?php if($targeting['editable']){?>
                        <a class="editable" data-mode="targeting" data-entry="<?php echo $targeting['targeting_id'] ?>"><?php echo $text_edit ?></a>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_location ?></label>
                    <div class="col-sm-8">
                    <?php foreach ($locations as $item): ?>
                        <?php if(in_array($item['targeting_id'], $targeting['location'])){ ?>
                        <label class="label label-default"><?php echo $item['name'] ?></label>
                        <?php }?>
                    <?php endforeach ?>
                    <?php if(!empty($targeting['other_location'])){?>
                        <div class="well"><?php echo $targeting['other_location'] ?></div>
                    <?php }?>
                    </div>
                </div>

                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_age ?></label>
                    <div class="col-sm-8">
                        <label class="label label-default"><?php echo $targeting['age_min'] ?> - <?php echo (int)$targeting['age_max'] > 65 ? '65+' : $targeting['age_max']  ?></label>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_gender ?></label>
                    <div class="col-sm-8">
                    <?php foreach ($genders as $item): ?>
                        <?php if($targeting['gender']==$item['targeting_id']){ ?>
                        <label class="label label-default"><?php echo $item['name'] ?></label>
                        <?php }?>
                    <?php endforeach ?>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_language ?></label>
                    <div class="col-sm-8">
                    <?php foreach ($languages as $item): ?>
                        <?php if(in_array($item['targeting_id'], $targeting['language'])){ ?>
                        <label class="label label-default"><?php echo $item['name'] ?></label>
                        <?php } ?>                    
                    <?php endforeach ?>

                    <?php if(!empty($targeting['other_language'])){?>
                        <br/>
                        <div class="well"><?php echo $targeting['other_language'] ?></div>
                    <?php }?>
                    </div>
                </div>

                <?php if(!empty($targeting['interest'])){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_interest ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $targeting['interest'] ?></textarea>
                    </div>
                </div>
                <?php }?>
                <?php if(!empty($targeting['behavior'])){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_behavior ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $targeting['behavior'] ?></textarea>
                    </div>
                </div>
                <?php }?>
                <?php if(!empty($targeting['more'])){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_more ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $targeting['more'] ?></textarea>
                    </div>
                </div>
                <?php }?>
                <?php if(!empty($targeting['note'])){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_note ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $targeting['note'] ?></textarea>
                    </div>
                </div>
                <?php }?>
              </fieldset>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"><?php echo $text_post ?></h3></div>
            <div class="panel-body">
              <fieldset id="ad-post">
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_from ?></label>
                    <div class="col-sm-8">
                        <span class="label label-default">
                            <?php echo $post['from'] == "member" ? $text_member : $text_backend ?>
                        </span>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $progress_status ?></label>
                    <div class="col-sm-8">
                        <?php echo $post['progress'] ?>
                        <?php if($post['editable']){?>
                        <a class="editable" data-mode="post" data-entry="<?php echo $post['post_id'] ?>"><?php echo $text_edit ?></a>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_headline ?></label>
                    <div class="col-sm-8 ">
                        <textarea class="form-control" disabled><?php echo $post['headline'] ?></textarea>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_post_text ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $post['text'] ?></textarea>
                    </div>
                </div>
                <?php if(!empty($post['note'])){?>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_note ?></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" disabled><?php echo $post['note'] ?></textarea>
                    </div>
                </div>
                <?php }?>
              </fieldset>
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading"><h3 class="panel-title"><?php echo $text_photo ?></h3></div>
            <div class="panel-body">
              <fieldset id="ad-photo">
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_from ?></label>
                    <div class="col-sm-8">
                        <span class="label label-default">
                            <?php echo $photo['from'] == "member" ? $text_member : $text_backend ?>
                        </span>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $progress_status ?></label>
                    <div class="col-sm-8">
                        <?php echo $photo['progress'] ?>
                        <?php if($photo['editable']){?>
                        <a class="editable" data-mode="photo" data-entry="<?php echo $photo['photo_id'] ?>"><?php echo $text_edit ?></a>
                        <?php }?>
                    </div>
                </div>
                <div class="form-group clearfix">
                    <label class="col-sm-2 control-label text-right"><?php echo $text_post_img ?></label>
                    <div class="col-sm-8 ">
                        <div id="ad-photos" class="uploads">
                            <?php if(is_array($photo['file'])){ ?>
                                <?php foreach ($photo['file'] as $item): ?>
                            <div class="attach">
                                <?php if(!empty($item['realpath'])){ ?>
                                <a href="<?php echo $item['realpath'] ?>" class="fancy-img"></a>
                                <?php } ?>
                                <img src="<?php echo $item['image']; ?>" class="img-thumbnail" title="<?php echo $item['name']; ?>" filename="<?php echo $item['name'] ?>" filepath="<?php echo $item['path'] ?>">
                            </div>
                                <?php endforeach ?>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php if(!empty($photo['note'])){?>
                <div class="form-group clearfix">
                  <label class="col-sm-2 control-label text-right"><?php echo $text_note ?></label>
                  <div class="col-sm-8">
                    <textarea class="form-control" disabled><?php echo $photo['note'] ?></textarea>
                  </div>
                </div>
                <?php }?>
              </fieldset>
            </div>
          </div>
        </div>
        <div id="tab-history" class="tab-pane">
            <fieldset>
                <legend><?php echo $text_publish_history ?></legend>
                <div id="history"></div>
            </fieldset>
            
            <br />
            <fieldset>
                <legend><?php echo $text_balance_history ?></legend>
                <div id="balance"></div>
            </fieldset>
        </div>
        <div id="tab-tracking" class="tab-pane">
            <div id="timeline"></div>
        </div>
      </div>
      <div class="buttons clearfix">
        <div class="pull-right">
            <a href="<?php echo $return; ?>" class="btn btn-primary">
                <?php echo $button_return; ?>
            </a>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="editable-dialog" style="display:none;"></div>
<script type="text/javascript">
$('#ad-status').load('index.php?route=service/advertise/component&mode=status&ad=<?php echo $advertise_id ?>');

$('#balance').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  $('#balance').load(this.href);
});
$('#balance').load('index.php?route=service/advertise/balance&ad=<?php echo $advertise_id; ?>');

$('#history').delegate('.pagination a', 'click', function(e) {
  e.preventDefault();
  $('#history').load(this.href);
});
$('#history').load('index.php?route=service/advertise/history&ad=<?php echo $advertise_id; ?>');

$('#button-history').on('click', function() {
  $.ajax({
    url: 'index.php?route=service/advertise/history&ad=<?php echo $advertise_id; ?>',
    type: 'post',
    dataType: 'json',
    data: 'publish=' + encodeURIComponent($('select[name=\'publish\']').val()) + '&note=' + encodeURIComponent($('textarea[name=\'note\']').val()),
    beforeSend: function() {
      $('#button-history').button('loading');     
    },
    complete: function() {
      $('#button-history').button('reset'); 
    },
    success: function(json) {

      $('.alert').remove();
      
      if (json['error']) {
        $('#history').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      } 
    
      if (json['success']) {
        $('#history').load('index.php?route=service/advertise/history&ad=<?php echo $advertise_id; ?>');
        
        $('#history').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        $('#ad-note').html($('input[name=\'note\']').val());

        $('input[name=\'note\']').val('');
        
        $('#ad-publish span.label').html($('select[name=\'publish\'] option:selected').text());

      }     
      return false;
    },      
    error: function(xhr, ajaxOptions, thrownError) {
      alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});
$('.fancy-img').fancybox();
$('#ad-tabs a').click(function (e) {
  e.preventDefault();
  $(this).tab('show')
})

$('#timeline').load('index.php?route=service/advertise/tracking',{ad:'<?php echo $advertise_id; ?>'});
$('.editable').bind('click',function(){
    $('#editable-dialog').empty();
    var mode = $(this).attr('data-mode');
    $.get('index.php?route=service/advertise/component&mode='+mode+'&ad=<?php echo $advertise_id ?>',{},function(html){
        $('#editable-dialog').html('<div class="col-sm-12">'+html+'</div>').dialog('open');
    });
});
$('#editable-dialog').dialog({
    width:680,
    modal:true,
    autoOpen:false,
    title:'<?php echo $text_edit ?>'
});
</script>
<style type="text/css">
  .form-group pre{min-height: 35px;}
</style>
<?php echo $footer; ?>