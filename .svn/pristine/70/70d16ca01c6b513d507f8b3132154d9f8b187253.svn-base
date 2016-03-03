<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-player" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-player" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_number; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="number" value="<?php echo $number; ?>"  />
              <?php if ($error_number) { ?>
              <span class="error"><?php echo $error_number; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
             <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" />
              <?php if ($error_name) { ?>
              <span class="error"><?php echo $error_name; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_team; ?></label>
            <div class="col-sm-10">
              <select name="team_id" class="form-control">
                <option value="0"><?php echo $text_none ?></option>
                <?php foreach ($teams as $item): ?>
                  <option value="<?php echo $item['team_id'] ?>" <?php echo $team_id == $item['team_id'] ? 'selected' : '' ?>><?php echo $item['name_en'].' ( '.$item['name_cn'].' )' ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_avatar; ?></label>
            <div class="col-sm-10">
              <div id="ad-imgs" class="uploads">
                <div class="attach">
                  <a href="<?php echo $avatar ?>" class="fancy-img"></a>
                  <img src="<?php echo $avatar ?>" class="img-thumbnail"/>
                </div>
                <input type="hidden" name="avatar" value="<?php echo $avatar; ?>" />
              </div>
              <div class="widgets">
                <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default"><i class="fa fa-upload"></i></button>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_note; ?></label>
            <div class="col-sm-10">
              <textarea name="note" class="form-control" rows="8"><?php echo $note; ?></textarea></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_position; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="position" value="<?php echo $position; ?>" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_height; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="height" value="<?php echo $height; ?>" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_weight; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="weight" value="<?php echo $weight; ?>" /></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_birthday; ?></label>
            <div class="col-sm-10">
              <div class='input-group date'>
                <input type="text" class="form-control" name="birthday" value="<?php echo $birthday; ?>" class="date form-control" data-date-format="YYYY-MM-DD" placeholder="YYYY-MM-DD"/>
                <span class="input-group-addon"> 
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_veteran; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="veteran" value="<?php echo $veteran; ?>" size="1"/></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_school; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="school" value="<?php echo $school; ?>" size="50"/></div>
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
              </select></div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_sort; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="sort" value="<?php echo $sort; ?>" size="1" /></div>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  new AjaxUpload('#button-upload', {
    action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
    name: 'attachment',
    autoSubmit: false,
    responseType: 'json',
    onChange: function(file, extension) {this.submit();},
    onComplete: function(file, json) {
        if(json.success) { 
            var html = '<div class="attach">';
            html +='<img title="'+file+'" filename="'+file+'" filepath="'+json.path+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
            html += '</div>';
            $('#ad-imgs').find('.fancy-img').attr('href',getImgURL(json.path));
            $('#ad-imgs').find('.img-thumbnail').attr('src',getImgURL(json.path));
            $('#ad-imgs input[name="avatar"]').val(json.path);
        }else{
            alert(json.error);
        }           
        $('.loading').remove(); 
    }
  });
    $(function(){
        $('a.fc-thumb').fancybox();
    });
    $('.date').datetimepicker({ pickTime: false});
</script>

<?php echo $footer; ?>