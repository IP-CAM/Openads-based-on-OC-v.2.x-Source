<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <?php if ($admin_group): ?>
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_import; ?>" class="btn btn-info" ><i class="fa fa-upload"></i></button>
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-player').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <?php endif ?>
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
        <div class="pull-right">
            <a class="btn btn-sm btn-default" onclick="$('#filter-column').slideToggle();"><i class="fa fa-filter"></i> Filters</a>
        </div>
      </div>
      <div class="panel-body">
      <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
        <div class="row filter">
          <div class="col-sm-1">
              <div class="form-group">
                  <label class="control-label" for="input-filter-number"><?php echo $column_number; ?></label>
                  <input type="text" name="filter_number" value="<?php echo $filter_number; ?>"  class="form-control" id="input-filter-number"/>
              </div>
          </div>

          <div class="col-sm-2">
            
            <div class="form-group" >
              <label class="control-label" for="input-filter-status"><?php echo $column_status; ?></label>
              <select name="filter_status" class="form-control" id="input-filter-status">
                <option value="*"></option>
                <?php if ($filter_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <?php } ?>
                <?php if (!is_null($filter_status) && !$filter_status) { ?>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-sm-3">
              <div class="form-group">
                  <label class="control-label" for="input-filter-player"><?php echo $column_name; ?></label>
                  <input type="text" id="input-player" value="<?php echo $filter_player; ?>"  class="form-control" id="input-filter-player"/>
                  <input name="filter_player_id" type="hidden" value="<?php echo $filter_player_id?>"/>
              </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group" >
              <label class="control-label" for="input-filter-team"><?php echo $column_team; ?></label>
              <select name="filter_team_id" class="form-control" id="input-filter-team">
                  <option value="*"><?php echo $text_none;?></option>
                  <?php foreach ($teams as $item) { ?>          
                  <option <?php echo $filter_team_id == $item['team_id'] ? 'selected' : '' ?> value="<?php echo $item['team_id']; ?>"><?php echo $item['team_sn'] . ' '.$item['name_en'] . ' '.$item['name_cn']; ?></option>
                  <?php }?>
              </select>
            </div>
            
          </div>
          <div class="col-sm-2">
            <div class="form-group" ></div>
            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <?php if(!empty($pagination)){?>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        <?php }?>
      </div>
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-player">
          <div class="table-responsive">
          <table class="table table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-center"><?php if ($sort == 'p.number') { ?>
                <a href="<?php echo $sort_number; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_number; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_number; ?>"><?php echo $column_number; ?></a>
                <?php } ?></td>
              <td class="text-left"><?php if ($sort == 'p.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
                <?php if(0){?>
              <td class="text-center">Avatar</td>
              <?php }?>
              <td class="text-center"><?php if ($sort == 'team') { ?>
                <a href="<?php echo $sort_team; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_team; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_team; ?>"><?php echo $column_team; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 'p.position') { ?>
                <a href="<?php echo $sort_position; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_position; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_position; ?>"><?php echo $column_position; ?></a>
                <?php } ?></td>
              
              <td class="text-center"><?php if ($sort == 'p.veteran') { ?>
                <a href="<?php echo $sort_veteran; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_veteran; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_veteran; ?>"><?php echo $column_veteran; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 'p.sort') { ?>
                <a href="<?php echo $sort_sort; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort; ?>"><?php echo $column_sort; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($players) { ?>
            <?php foreach ($players as $item) { ?>
            <tr>
              <td class="text-center"><?php if (in_array($item['player_id'], $selected)) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['player_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['player_id']; ?>" />
                <?php } ?></td>
              <td class="text-center"><b><?php echo $item['number']; ?></b></td>
              <td class="text-left"><?php echo $item['name'] ?></td>
              <?php if(0){?>
              <td class="text-center">
                <img src="<?php echo $item['avatar'] ?>" width="100" class="img-thumbnail">
              </td>
              <?php } ?>
              <td class="text-center">
              <?php if(0){?>
                <a data-team="<?php echo $item['team_id'] ?>" class="post-to-team" title="Post to <?php echo $item['team_sn']; ?>" style="cursor: pointer;">
                  <img src="<?php echo $item['flag'] ?>" width="80" class="img-thumbnail">
                </a>
                <br>
                <?php } ?>
                <a data-team="<?php echo $item['team_id'] ?>" class="post-to-team" title="Post to <?php echo $item['team_sn']; ?>" style="cursor: pointer;">
                <?php echo $item['team'] ?>
                </a>
              </td>
              <td class="text-center"><?php echo $item['position'] ?></td>       
              <td class="text-center"><?php echo $item['veteran']; ?></td>
              <td class="text-center"><?php echo $item['status_text']; ?></td>
              <td class="text-center"><?php echo $item['sort']; ?></td>
              <td class="text-center">
                  <button data-player="<?php echo $item['player_id']; ?>" data-toggle="tooltip" title="<?php echo $button_post; ?>" class="btn btn-success post-to-player" type="button"><i class="fa fa-send"></i></button>
                <?php if ($admin_group): ?>
                  <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
              <?php endif ?>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" colspan="12"><?php echo $text_no_results; ?></td>
            </tr>
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
<!-- Dialog -->
<div id="post-dialog" style="display:none;" >
    <div class="modal-body">
        <form class="form-horizontal" id="post-form">
            <input type="hidden" name="team_id">
            <input type="hidden" name="player_id">
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
<?php if ($admin_group): ?>
<div id="import-dialog" style="display:none;">
  <div class="do-result"></div>
  <form method="post" id="submiteid" enctype="multipart/form-data" >
      <input type="hidden" name="mode" value="normal">
      <table class="form">    
          <tr><td>NFL Player file:</td><td><input type="file" name="filename"/></td></tr>
      </table>
  </form>
</div>
<?php endif ?>
<script type="text/javascript" src="../asset/javascript/form.js"></script>
<script type="text/javascript">
$('.post-to-team').bind('click',function(){
    $('#dialog-result,#entry-name,#entry-desc,#entry-info').empty();
    
  $('#post-form textarea,#post-form input[type!="radio"]').val('');
    
  $.get('index.php?route=nfl/team/detail&token=<?php echo $token ?>',{'team_id':$(this).attr('data-team')},function(json){
    var data = JSON.parse(json);
    if(data.status==0){
      alert(data.msg);
    }else{
      $('#entry-photo').attr('src',data.data.flag);
      $('#entry-name').html(data.data.name_en);
      $('#entry-info').html(data.data.nickname+'<br>'+data.data.home_court);
      $('#entry-desc').html(data.data.desc);
      $('input[name="team_id"]').val(data.data.team_id);
      $('#post-dialog').dialog('open')
      .dialog('option',{'title':data.data.team_sn+' [ '+data.data.name_en+' ]'});
      $('.loading').remove();
    }
  })
});
$('.post-to-player').bind('click',function(){
    $('#dialog-result,#entry-name,#entry-desc,#entry-info').empty();
    
    $('#post-form textarea,#post-form input[type!="radio"]').val('');    
    $.get('index.php?route=nfl/player/detail&token=<?php echo $token ?>',{player_id:$(this).attr('data-player')},function(json){
        var data = JSON.parse(json);
        if(data.status==0){
            alert(data.msg);
        }else{
            $('#entry-photo').attr('src',data.data.avatar);
            $('#entry-name').html(data.data.name+'<br>['+data.data.name_en+']');
            $('#entry-desc').html(data.data.note);
            var info = '<?php echo $text_info_number ?>'+data.data.number+'<br>';
            info += '<?php echo $text_info_hw ?>'+data.data.height+'/'+data.data.weight+'<br>';
            info += '<?php echo $text_info_age ?>'+data.data.age+'<br>';
            info += '<?php echo $text_info_position ?>'+data.data.position+'<br>';
            info += '<?php echo $text_info_veteran ?>'+data.data.veteran+'<br>';
            info += '<?php echo $text_info_school ?>'+data.data.school+'<br>';
            $('#entry-info').html(info);
            $('input[name="team_id"]').val(data.data.team_id);
            $('input[name="player_id"]').val(data.data.player_id);
            $('#post-dialog').dialog('option',{
                'title':data.data.name+' [ '+data.data.name_en+' ]'
            }).dialog('open');
            $('.loading').remove();
        }
    })
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
                'url':'index.php?route=nfl/player/post&token=<?php echo $token ?>',
                'type':'Post',
                'dataType':'json',
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
                    'url': 'index.php?route=tool/cron/nfl_similar_text&token=<?php echo $token; ?>',
                      'type': 'get',
                  });
                }
            });
        }
    }
});

</script>
<script type="text/javascript">
  $('#button-filter').bind('click',function() {
    url = 'index.php?route=nfl/player&token=<?php echo $token; ?>';
    
    var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
      if($(this).val()&&$(this).val()!='*'){
        paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
      }
    });
    if(paramArr.length>0){
      url+="&"+paramArr.join("&");
    }
    location = url;
  });
  $('.cdate').datetimepicker({ 'pickTime': false});

</script>
<script type="text/javascript"><!--

$('#input-player').autocomplete({
    'delay': 0,
    'source': function(request, response) {
        $.ajax({
            'url': 'index.php?route=nfl/player/autocomplete&token=<?php echo $token ?>&filter_name=' +  encodeURIComponent(request.term),
            'dataType': 'json',           
            'success': function(json) {
                response($.map(json, function(item) {
                    return {
                      'category': item.team,
                      'label': item.name ,
                      'value': item.player_id,
                      'team': item.team_id,
                    }
                }));
            }
        });
    },
    'select': function(event, ui) {
        $('#input-player').val(ui.item.label);
        $('input[name="filter_player_id"]').val(ui.item['value']);
        $('select[name="filter_team_id"]').val(ui.item['team']);
        return false;
    } 
});
</script>
<?php if ($admin_group): ?>
<script type="text/javascript">
$('#import-button').bind('click',function(){
    $('#import-dialog .do-result').empty();
    $('#import-dialog').dialog({
        'title':'Import',
        'width': 680,
        'modal':true,
        'buttons':{
            'Import':function(){
                $('#import-dialog form').ajaxSubmit({
                    'url':'index.php?route=nfl/player/import_data&token=<?php echo $token;?>',
                    'type':'Post',
                    'dataType':'json',
                    'beforeSubmit':function(){                     
                        $('#import-dialog .do-result').html('<img src="view/image/loading_pro.gif">');                 
                    },
                    'success':function(data){
                        if(data.status == 0){
                            $('#import-dialog .do-result').html('<div class="alert warning">'+data.msg+'</div>');
                        }else{
                            $('#import-dialog .do-result').html('<div class="alert success">'+data.msg+'</div>');
                            $('#import-dialog input[name="filename"]').val('');
                        }
                        $('.ui-dialog-buttonset button:last').removeAttr('disabled').removeClass('ui-state-disabled');
                    },
                    'error': function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                });
            }
        }
    });
});
</script>
<?php endif ?>
<?php echo $footer; ?>