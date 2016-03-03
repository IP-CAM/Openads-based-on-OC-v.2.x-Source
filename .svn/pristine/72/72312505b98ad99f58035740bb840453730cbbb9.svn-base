<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-target').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
      	<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-target">
          <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-center"><?php if ($sort == 'nt.team_sn') { ?>
                <a href="<?php echo $sort_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sn; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sn; ?>"><?php echo $column_sn; ?></a>
                <?php } ?></td>
              <td class="text-left"><?php if ($sort == 'nt.name_en') { ?>
                <a href="<?php echo $sort_name_en; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name_en; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $column_flag ?></td>
              <td class="text-center"><?php if ($sort == 'nt.partition') { ?>
                <a href="<?php echo $sort_partition; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_partition; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_partition; ?>"><?php echo $column_partition; ?></a>
                <?php } ?></td>
              <td class="text-left col-sm-2"><?php if ($sort == 'nt.nickname') { ?>
                <a href="<?php echo $sort_nickname; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_nickname; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_nickname; ?>"><?php echo $column_nickname; ?></a>
                <?php } ?></td>
              <td class="text-left"><?php if ($sort == 'nt.short') { ?>
                <a href="<?php echo $sort_short; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_short; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_short; ?>"><?php echo $column_short; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 'nt.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 'nt.sort') { ?>
                <a href="<?php echo $sort_sort; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort; ?>"><?php echo $column_sort; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($all_teams) { ?>
            <?php foreach ($all_teams as $item) { ?>
            <tr <?php echo $item['status'] ? '' : 'class="tr-disabled"' ?>>
              <td class="text-center"><?php if (in_array($item['team_id'], $selected)) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['team_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['team_id']; ?>" />
                <?php } ?></td>
              <td class="text-center"><b><?php echo $item['team_sn']; ?></b></td>
              <td class="text-left"><?php echo $item['name_en'] .'<br>'.$item['name_cn']; ?></td>
              <td class="text-center">
                <img src="<?php echo $item['flag'] ?>" width="80" class="img-thumbnail">
              </td>
              <td class="text-center"><?php echo $item['partition']; ?></td>
              <td class="text-left"><?php echo $item['nickname']; ?></td>
              <td class="text-left"><?php echo $item['short']; ?></td>
              <td class="text-center"><?php echo $item['status_text']; ?></td>
              <td class="text-center"><?php echo $item['sort']; ?></td>
              <td class="text-center">
                  <a data-team="<?php echo $item['team_id']; ?>" data-toggle="tooltip" title="<?php echo $button_post; ?>" class="btn btn-success post-to-team" ><i class="fa fa-send"></i></a>
                <?php if ($admin_group): ?>
                <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
              </td>
            </tr>
            <?php } ?>

            <?php } ?>
          </tbody>
        </table>
        </div>
      </form>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Dialog -->
<div id="post-dialog" style="display:none;" >
    <div class="modal-body">
        <form class="form-horizontal" id="post-form">
            <input type="hidden" name="team_id">
            <div id="dialog-result"></div>
            <div class="col-md-4">
                <div class="thumbnail">
                    <img class="img-rounded" id="entry-photo"/>
                    <div class="caption">
                        <h3 id="entry-name"></h3>
                        <p id="entry-info"></p>
                        <p id="entry-desc" style="overflow-y:auto;height:150px;"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8"> 
                <div class="form-group" >
                    <label class="control-label"><?php echo $entry_post_match;?></label>
                    <div class="radio">
                    <?php foreach ($matches as $k => $item) { ?>
                        <label class="radio-inline">
                            <input type="radio" name="match_id" value="<?php echo $item['match_id']; ?>" <?php echo (!$k) ? "checked =\"checked\"":""; ?> > <?php echo $item['name']; ?>
                        </label>
                    <?php } ?>
                    </div>
                </div>              
                <div class="form-group" >
                    <label class="control-label"><?php echo $entry_post_gender;?></label>
                    <div class="radio">
                        <?php foreach ($gender as $gender) { ?>
                        <?php if(strtolower($gender['name'])=='all') continue; ?>
                        <label class="radio-inline">
                            <input type="radio" name="gender_id" <?php echo (strtolower($gender['name'])=='male') ? "checked =\"checked\"":""; ?> value="<?php echo $gender['option_id']; ?>"> <?php echo $gender['name']; ?>
                        </label>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group" >
                    <label class="control-label"><?php echo $entry_expired;?></label>
                    <input type="text" name="expired" class="cdate form-control" size="10" data-date-format="YYYY-MM-DD"/>
                </div>
                <div class="form-group" >
                    <label class="control-label"><?php echo $entry_post_text;?></label>
                    <textarea name="content" class="form-control" rows="8"></textarea>
                </div>
                <div class="form-group" >
                    <label class="control-label"><?php echo $entry_note;?></label>
                    <textarea name="note" class="form-control" rows="3"></textarea>                    
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="../asset/javascript/form.js"></script>
<script type="text/javascript"><!-- 
$('.post-to-team').bind('click',function(){
    $('#dialog-result,#entry-name,#entry-desc,#entry-info').empty();
    //$('#entry-photo').attr('src','');
  $('#post-form textarea,#post-form input[type!="radio"]').val('');
    
  $.get('index.php?route=nfl/team/detail&token=<?php echo $token ?>',{team_id:$(this).attr('data-team')},function(data){
    
    if(data.status==0){
      alert(data.msg);
    }else{
      $('#entry-photo').attr('src',data.data.flag);
      $('#entry-name').html(data.data.name_en);
      $('#entry-info').html(data.data.nickname+'<br>'+data.data.home_court);
      $('#entry-desc').html(data.data.desc);
      $('input[name="team_id"]').val(data.data.team_id);
      $('#post-dialog').dialog('open')
      .dialog('option',{title:data.data.team_sn+' [ '+data.data.name_en+' ]'});
      $('.loading').remove();
    }
  },'json')
});

$('#post-dialog').dialog({
    width: 780,
    autoOpen:false,
    resizable:false,
    buttons:{
        'Submit':function(){
            if( $('input[name="team_id"]').val() == ''){
                $('#dialog-result').html('<div class="alert alert-danger"><?php echo $error_post; ?></div>');
                return false;
            }
            var _content = $('textarea[name="content"]').val();
            if( _content ==''){
                $('#dialog-result').html('<div class="alert alert-danger"><?php echo $error_post_text; ?></div>');
                return false;
            }
            var _msg = check_contribute(_content);
            if(_msg!==true){
                $('#dialog-result').html('<div class="alert alert-danger">'+_msg+'</div>');
                return false;
            }
            
            $('#post-dialog form').ajaxSubmit({
                url:'index.php?route=nfl/player/post&token=<?php echo $token ?>',
                type:'Post',
                dataType:'json',
                beforeSubmit:function(){
                    $('#dialog-result').html('<div class="alert alert-danger"><img src="../asset/image/loading.gif"></div>');
                    $('.ui-dialog-buttonset button').addClass('ui-state-disabled').attr('disabled','disabled');
                },
                success:function(data){
                    if(data.status == 1){
                        $('#dialog-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                        location.reload();
                    }else{
                        $('#dialog-result').html('<div class="alert alert-danger">'+data.msg+'</div>');
                    }
                    $('.ui-dialog-buttonset button').removeClass('ui-state-disabled').removeAttr('disabled');
                    $.ajax({
                    url: 'index.php?route=tool/cron/nfl_similar_text&token=<?php echo $token; ?>',
                      type: 'get',
                  });
                }
            });
        }
    }
});
$('.cdate').datetimepicker({ pickTime: false});
//-->
</script>
<?php echo $footer; ?>