<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-schedule').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-schedule">
          <div class="table-responsive">
          <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="text-left"><?php if ($sort == 's.match_id') { ?>
                <a href="<?php echo $sort_match; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_match; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_match; ?>"><?php echo $column_match; ?></a>
                <?php } ?></td>
              <td class="text-left"><?php if ($sort == 's.date') { ?>
                <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
                <?php } ?></td>
              <td class="text-right"><?php if ($sort == 's.home_team_id') { ?>
                <a href="<?php echo $sort_home_team; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_home_team; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_home_team; ?>"><?php echo $column_home_team; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 's.home_score') { ?>
                <a href="<?php echo $sort_home_score; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_score; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_home_score; ?>"><?php echo $column_score; ?></a>
                <?php } ?></td>
              <td class="text-left"><?php if ($sort == 's.road_team_id') { ?>
                <a href="<?php echo $sort_road_team; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_road_team; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_road_team; ?>"><?php echo $column_road_team; ?></a>
                <?php } ?></td>
              <td class="text-center"><?php if ($sort == 's.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="text-left col-sm-2"><?php echo $column_group ?></td>
              <td class="text-right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter hidden">
              <td></td>
              <td><select name="filter_match_id">
                    <option value="*"><?php echo $text_none;?></option>
                    <?php foreach ($matches as $item) { ?>          
                    <option <?php echo $filter_match_id == $item['match_id'] ? 'selected' : '' ?> value="<?php echo $item['match_id']; ?>"><?php echo $item['name'] ; ?></option>
                    <?php }?>
                </select></td>
              <td><input type="text" name="filter_date" value="<?php echo $filter_date; ?>" class="date" size="8" /></td>
              <td class="text-right"><select name="filter_home_team">
                    <option value="*"><?php echo $text_none;?></option>
                    <?php foreach ($teams as $item) { ?>          
                    
                      <option <?php echo $filter_home_team == $item['team_id'] ? 'selected' : '' ?> value="<?php echo $item['team_id']; ?>">
                        <?php echo $item['team_sn'].' '.$item['name_en']; ?>
                        <br><i><?php echo $item['name_cn'] ?></i>
                      </option>
                    
                    <?php }?>
                </select></td>
              <td></td>
              <td class="text-left"><select name="filter_road_team">
                    <option value="*"><?php echo $text_none;?></option>
                    <?php foreach ($teams as $item) { ?>   
                      <option <?php echo $filter_road_team == $item['team_id'] ? 'selected' : '' ?> value="<?php echo $item['team_id']; ?>">
                        <?php echo $item['team_sn'].' '.$item['name_en'] ; ?>
                        <br><i><?php echo $item['name_cn'] ?></i>
                      </option>
                    <?php }?>
                </select>
              </td>
              <td class="text-center"><select name="filter_status">
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
                </select></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
            <?php if ($schedules) { ?>
            <?php foreach ($schedules as $item) { ?>
            <tr>
              <td style="text-align: center;"><?php if (in_array($item['schedule_id'], $selected)) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['schedule_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $item['schedule_id']; ?>" />
                <?php } ?></td>
              <td class="text-left"><?php echo $item['match'] ?></td>
              <td class="text-left"><?php echo $item['date']; ?><br><?php echo $item['time']; ?></td>              
              <td class="text-right"><?php echo $item['home_team'] ?></td>
              <td class="text-center">
                <img src="<?php echo $item['home_flag'] ?>" width="100" class="img-thumbnail">
                <?php echo $item['home_score'] ?><b> : </b><?php echo $item['road_score']; ?>
                <img src="<?php echo $item['road_flag'] ?>" width="100" class="img-thumbnail">
              </td>
              <td class="text-left"><?php echo $item['road_team']; ?></td>
              <td class="text-center"><?php echo $item['status_text']; ?></td>
              <td class="text-center"><span title="<?php echo $item['group'] ?>"><?php echo lively_truncate($item['group'],30); ?></span></td>
              <td class="text-right">
                <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
              </td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
    </div>
    <div class="row">
        <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
        <div class="col-sm-6 text-right"><?php echo $results; ?></div>
      </div>
  </div>
</div>

<script type="text/javascript">
  function filter() {
    url = 'index.php?route=nfl/schedule&token=<?php echo $token; ?>';
    
    var paramArr=[];
    $("tr.filter input[name],tr.filter select[name]").each(function(){
      if($(this).val()&&$(this).val()!='*'){
        paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
      }
    });
    if(paramArr.length>0){
      url+="&"+paramArr.join("&");
    }
    location = url;
  }
  $('.date').datetimepicker({pickTime: false});
</script>
<?php echo $footer; ?>