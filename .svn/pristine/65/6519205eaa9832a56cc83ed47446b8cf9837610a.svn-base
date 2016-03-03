<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success">
    <i class="fa fa-check-circle"></i> <?php echo $success; ?>
  </div>
  <?php } ?>
  <div class="row">
    <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
    <div id="content" class="col-sm-9">
      <h1><?php echo $heading_title; ?></h1>

      <div class="buttons clearfix">
        <div class="pull-left">
          <a href="<?php echo $toggle ?>"><?php echo $text_toggle ?></a>
        </div>
        <div class="pull-right">
          <button id="new-website" class="btn btn-success"><?php echo $title_new ?></button>
        </div>
      </div>
      <?php if ($websites) { ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th class="text-right"><?php echo $column_website; ?></th>
              <th class="text-center"><?php echo $column_date_modified; ?></th>
              <th class="text-left"><?php echo $column_product; ?></th>
              <th class="text-left"><?php echo $column_domain; ?></th>
              <th class="text-center"><?php echo $column_ads; ?></th>
              <th class="text-center"><?php echo $column_status; ?></th>
              <th class="text-right"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($websites as $item) { ?>
            <tr>
              <td class="text-right"><?php echo $item['website_sn']; ?></td>
              <td class="text-center"><?php echo $item['date_modified']; ?></td>
              <td class="text-left"><label class="label label-default"><?php echo $item['product']; ?></label></td>              
              <td class="text-left"><?php echo $item['domain']; ?></td>
              <td class="text-center">
                <?php if($item['ads']){ ?>
                <a title="<?php echo $text_view_ads ?>" href="<?php echo $item['view']; ?>"><?php echo $item['ads']; ?></a>
                <?php }else{?>
                <?php echo $item['ads']; ?>
                <?php }?>
              </td>
              <td class="text-center">

                <?php if(false && is_array($item['status_text'])){ ?>
                <a href="<?php echo $item['status_text']['link'] ?>" title="<?php echo empty($item['status_text']['title']) ? $item['status_text']['text'] : $item['status_text']['title'] ?>" <?php echo empty($$item['status_text']['class']) ? '' : 'class="'.$item['status_text']['class'].'"' ?>>
                  <?php echo !empty($item['status_text']['icon']) ? $item['status_text']['icon'] : $item['status_text']['text']?>
                </a>
                <?php } ?>
                <a href="<?php echo $item['status_text']['link'] ?>" title="<?php echo empty($item['status_text']['title']) ? $item['status_text']['text'] : $item['status_text']['title'] ?>" data-toggle="tooltip">
                  <?php if($item['status']){ ?>
                  <div class="bootstrap-switch bootstrap-switch-on bootstrap-switch-mini" >
                    <div class="bootstrap-switch-container">
                      <span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 36px;">
                        <?php echo $text_status_on ?>
                      </span>
                      <span class="bootstrap-switch-label hidden" style="width: 30px;"></span>
                    </div>
                  </div>
                  <?php }else{?>
                  <div class="bootstrap-switch bootstrap-switch-off bootstrap-switch-mini">
                    <div class="bootstrap-switch-container">
                      <span class="bootstrap-switch-label hidden" style="width: 30px;"></span>
                      <span class="bootstrap-switch-handle-off bootstrap-switch-warning" style="width: 36px;"><?php echo $text_status_off ?></span>
                    </div>
                  </div>
                  <?php }?>
                </a>
              </td>
              <td class="text-right">
                <?php foreach ($item['action'] as $action): ?>
                <a href="<?php echo $action['link'] ?>" <?php echo empty($action['class']) ? '' : 'class="'.$action['class'].'"'  ?> title="<?php echo empty($action['title']) ? $action['text'] : $action['title'] ?>" data-toggle="tooltip">
                  <?php echo $action['text'] ?>
                </a>
                <?php endforeach ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="text-right"><?php echo $pagination; ?></div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      
      </div>
    </div>
</div>
<div id="status-dialog" title="<?php echo $title_status ?>">
  <div class="col-sm-12">
      <div class="well ">
        <span id="status-active"><?php echo $text_confirm_active ?></span>
        <span id="status-stop"><?php echo $text_confirm_stop ?></span>
      </div>
  </div>
  <div class="col-sm-11 clearfix">
    <form action="<?php echo $ajax_action; ?>" method="post" class="form-horizontal" id="status-form">
      <input type="hidden" name="action" value="status">
      <input type="hidden" name="website" >
      <input type="hidden" name="status" >
      <div class="form-group clearfix required">
          <label class="col-sm-3 control-label text-right" for="input-note"><?php echo $entry_toggle_note ?></label>
          <div class="col-sm-9">
              <textarea  name="note" class="form-control" id="input-note"></textarea>
          </div>
      </div>
    </form>
  </div>
</div>
<div id="new-dialog" title="<?php echo $title_new ?>">
  <div class="col-sm-11 clearfix">
    <form action="<?php echo $ajax_action; ?>" method="post" class="form-horizontal" id="ws-form">
      <input type="hidden" name="action" value="create">
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-product"><?php echo $entry_product ?></label>
          <div class="col-sm-9 ">
              <select name="product_id" id="input-product" class="form-control">
              <?php foreach ($products as $item): ?>
                  <option value="<?php echo $item['product_id'] ?>"><?php echo $item['name'] ?></option>
              <?php endforeach ?>   
              </select>
          </div>
      </div>
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-domain"><?php echo $entry_domain ?></label>
          <div class="col-sm-9">
              <input type="text" name="domain" class="form-control" id="input-domain"/>
          </div>
      </div>
      <div class="form-group clearfix">
          <label class="col-sm-3 control-label text-right" for="input-note"><?php echo $entry_note ?></label>
          <div class="col-sm-9">
              <textarea  name="note" class="form-control" id="input-note"></textarea>
          </div>
      </div>
    </form>
  </div>
</div>
<div id="ws-history"></div>
<script type="text/javascript"><!-- 
$(function() {
    $('#ws-form')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            domain: {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_domain ?>'
                    },
                    uri: {
                        message: '<?php echo $error_domain_invalid ?>'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
            $.post(
                $form.attr('action'), 
                $form.serialize(), 
                function(json) {
                    if(json.status==0){
                        for(var k in json['error']){

                        }
                    }else{
                        location.reload();
                    }
                }, 
            'json');
    });
    $('#status-form')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            note: {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_toggle_note ?>'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        $.post(
            $form.attr('action'), 
            $form.serialize(), 
            function(json) {
                if(json.status==0){
                  alert(json.msg)
                }else{
                  location.reload();
                }
            }, 
        'json');
    })
});
//--></script>
<script type="text/javascript">

  $('#new-website').on('click',function(){
    $('#new-dialog').dialog('open');
  })
  $('#new-dialog').dialog({
    autoOpen:false,
    modal: true,
    width: 600,
    resizable:false,
    buttons: {
        "<?php echo $button_create ?>": function () {
            $('#ws-form').submit();
        },
        "<?php echo $button_cancel ?>": function () {
            $(this).dialog("close");
        }
    }
  });

  $('#ws-history').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();
    $('#ws-history').load(this.href);
  });
  function history(website_id){
      $('#ws-history').empty()
      .load('index.php?route=service/website/history&website='+website_id)
      .dialog({
        title:'<?php echo $title_history ?>',
        modal: true,
        width: 600,
        resizable:false,
        buttons:{
          "<?php echo $button_close ?>": function () {
            $(this).dialog("close");
        }
        }
      })
  }

  function toggle(website_id,toggle){
      $.ajax({
        url:'<?php echo $ajax_action ?>',
        data:{action:'toggle',website:website_id,toggle:toggle},
        type:'post',
        dataType:'json',
        success:function(json){
          if(json.status==0){
            alert(json.msg);
          }else{
            location.reload();
          }
        }
      })
  }

  function status (website_id,status){
    if(status==0){
      $('#status-dialog #status-stop').show();
      $('#status-dialog #status-active').hide();
      $('#status-dialog').next().find('.ui-button:first').text('<?php echo $button_stop ?>');
    }else{
      $('#status-dialog #status-stop').hide();
      $('#status-dialog #status-active').show();
      $('#status-dialog').next().find('.ui-button:first').text('<?php echo $button_active ?>');
    }
    $('#status-form input[name="website"]').val(website_id);
    $('#status-form input[name="status"]').val(status);
    $('#status-dialog').dialog('open');
  }
  $('#status-dialog').dialog({
    autoOpen:false,
    modal: true,
    width: 680,
    resizable:false,
    buttons: {
        "<?php echo $button_save ?>": function () {
            $('#status-form').submit();
        },
        "<?php echo $button_cancel ?>": function () {
            $(this).dialog("close");
        }
    }
  });  
  $('#button-filter').on('click', function() {
      url = 'index.php?route=service/advertise';
      var paramArr=[];
      $(".filter input[name],.filter select[name]").each(function(){
          if($(this).val() && $(this).val()!='*'){
              paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
          }
      });
      if(paramArr.length>0){
          url+="&"+paramArr.join("&");
      }
      location = url;
  });
  $('.date').datetimepicker({ pickTime: false});
</script>
<style type="text/css">
  label.label{cursor: pointer;}
</style>
<?php echo $footer; ?>