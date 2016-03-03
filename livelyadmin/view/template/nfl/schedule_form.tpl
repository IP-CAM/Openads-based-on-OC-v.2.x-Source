<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-schedule" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-schedule" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_match; ?></label>
            <div class="col-sm-10">
              <select name="match_id" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach ($matches as $item): ?>
                <option value="<?php echo $item['match_id'] ?>" <?php echo $match_id == $item['match_id'] ? 'selected' : '' ?>><?php echo $item['name'] ?>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_date; ?></label>
            <div class="col-sm-10">
              <div class="input-group date">
                <input type="text" name="date" value="<?php echo $date; ?>" class="date form-control" data-date-format="YYYY-MM-DD" placeholder="YYYY-MM-DD"/>
                <span class="input-group-addon"> 
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_time; ?></label>
            <div class="col-sm-10">
              <input type="text" name="time" value="<?php echo $time; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_location; ?></label>
            <div class="col-sm-10">
              <input type="text" name="location" value="<?php echo $location; ?>" class="form-control"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_team; ?></label>
            <div class="col-sm-10 text-center" >
              <table class="table table-border"  >
                <tr>
                  <td class="text-center" style="width:50%">Home Team</td>
                  <td class="text-center" style="width:50%">Road Team</td>
                </tr>
                <tr>
                  <td class="text-right">
                    <select name="home_team_id" data-rel="home-flag">
                      <option value="0"><?php echo $text_none ?></option>
                      <?php foreach ($teams as $item): ?>
                      <option value="<?php echo $item['team_id'] ?>" <?php echo $home_team_id == $item['team_id'] ? 'selected' : '' ?> flag="<?php echo $item['flag'] ?>"><?php echo $item['name_en'].' ( '.$item['name_cn'].' )' ?></option>
                      <?php endforeach ?>
                    </select>
                  </td>
                  <td class="text-left">
                    <select name="road_team_id" data-rel="road-flag">
                      <option value="0"><?php echo $text_none ?></option>
                      <?php foreach ($teams as $item): ?>
                      <option value="<?php echo $item['team_id'] ?>" <?php echo $road_team_id == $item['team_id'] ? 'selected' : '' ?> flag="<?php echo $item['flag'] ?>"><?php echo $item['name_en'].' ( '.$item['name_cn'].' )' ?></option>
                      <?php endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="text-right" id="home-flag">
                      
                      <div class="pull-right">
                        <img class="img-thumbnail"/>
                        <br>
                        <br>
                        <input type="text" name="home_score" value="<?php echo $home_score; ?>" size="2"/>
                      </div>
                      <div class="players-scroll" style="display: none;"></div>
                  </td> 
                  <td class="text-left" id="road-flag">
                      <div class="pull-left">
                        <img class="img-thumbnail"/> 
                        <br>
                        <br>
                        <input type="text" name="road_score" value="<?php echo $road_score; ?>" size="2"/>
                      </div>
                      <div class="players-scroll" style="float:left;display: none;"></div>
                  </td> 
                </tr>
              </table>
              <?php if ($error_home) { ?>
              <span class="error"><?php echo $error_home; ?></span>
              <?php } ?>
              <?php if ($error_road) { ?>
              <span class="error"><?php echo $error_road; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="status" class="form-control">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_group; ?></label>
            <div class="col-sm-10">
              <div class="well well-sm" style="height: 150px; overflow: auto;">
                  <?php foreach ($all_users as $user) { ?>
                  <div class="checkbox">
                    <label>
                    <?php if (in_array($user['user_id'], $group)) { ?>
                    <input type="checkbox" name="group[]" value="<?php echo $user['user_id']; ?>" checked="checked" />
                    <?php echo $user['user_id'].' '.$user['lastname'].$user['firstname']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="group[]" value="<?php echo $user['user_id']; ?>" />
                    <?php echo $user['user_id'].' '.$user['lastname'].$user['firstname']; ?>
                    <?php } ?>
                    </label>
                  </div>
                  <?php } ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_note; ?></label>
            <div class="col-sm-10"><textarea name="note" rows="8" class="form-control"><?php echo $note; ?></textarea></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
<!--
  var schedule_id = <?php echo isset($this->request->get['schedule_id']) ? $this->request->get['schedule_id'] : 0 ?>;
  $(function(){$('select[name$=team_id]').trigger('change');});
  $('select[name$=team_id]').bind('change',function(){
    var obj = $('#'+$(this).attr('data-rel')),team_id = $(this).val();
    obj.find('img').attr('src',$(this).find('option:selected').attr('flag'));
    $.get('index.php?route=nfl/schedule/players&token=<?php echo $token ?>',{team_id:team_id,schedule_id:schedule_id},function(json){
      var html = '', row_class = 'odd';
      for (var i = 0 ; i <= json.length - 1; i++) {
        row_class = (row_class == 'even') ? 'odd' : 'even';
        var selected = json[i].selected ? 'checked="checked"' : '';
        html += '<div class="'+row_class+'">';
        html += '<input type="checkbox" name="player_id['+json[i].team_id+'][]" value="'+json[i].player_id+'" '+selected+'> '+json[i].name;
        html += '</div>';
      }
      
      obj.find('.players-scroll').html(html).show();
    },'json');
  });
  $('.date').datetimepicker({ pickTime: false});
  $('.time').datetimepicker({timeFormat: "HH:mm",timeOnly:true,inline: true});
//-->
</script>
<style type="text/css">
  .players-scroll{width: 63%;overflow-y:auto;overflow-x:hidden;height: 180px;border: 1px solid #cccccc; }
  .players-scroll div{float: left;padding: 3px;width: 98%;text-align: left;}
  .players-scroll div.even{background: #FFFFFF;}
  .players-scroll div.odd{background: #E4EEF7;}
</style>
<?php echo $footer; ?>