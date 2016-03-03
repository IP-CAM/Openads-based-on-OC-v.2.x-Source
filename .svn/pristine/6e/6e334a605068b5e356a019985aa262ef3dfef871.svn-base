<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-match" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
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
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-match" class="form-horizontal">
        
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_sn; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="team_sn" value="<?php echo $team_sn; ?>" size="4"/>
              <?php if ($error_sn) { ?>
              <span class="error"><?php echo $error_sn; ?></span>
              <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name_en" value="<?php echo $name_en; ?>" size="50" placeholder="English"/>
              <?php if ($error_name_en) { ?>
              <span class="error"><?php echo $error_name_en; ?></span>
              <?php } ?>
              
              <input type="text" class="form-control" name="name_cn" value="<?php echo $name_cn; ?>" size="50" placeholder="Chinese"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_flag; ?></label>
            <div class="col-sm-10">
                <div id="ad-imgs" class="uploads">
                  <div class="attach">
                    <a href="<?php echo $flag ?>" class="fancy-img"></a>
                    <img src="<?php echo $flag ?>" class="img-thumbnail"/>
                  </div>
                  <input type="hidden" name="flag" value="<?php echo $flag; ?>" />
                </div>
                <div class="widgets">
                  <button type="button" data-toggle="tooltip" title="<?php echo $button_upload; ?>" id="button-upload" class="btn btn-default"><i class="fa fa-upload"></i></button>
                </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_desc; ?></label>
            <div class="col-sm-10">
              <textarea name="desc" cols="120" rows="5" class="form-control"><?php echo $desc; ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_nickname; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nickname" value="<?php echo $nickname; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_short; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="short" value="<?php echo $short; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_partition; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="partition" value="<?php echo $partition; ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_home_court; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="home_court" value="<?php echo $home_court; ?>" size="50"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_trainer; ?></label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="trainer" value="<?php echo $trainer; ?>" size="50"/>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
            <div class="col-sm-10"><select name="status" class="form-control">
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
            <label class="col-sm-2 control-label"><?php echo $entry_sort; ?></label>
            <div class="col-sm-10"><input type="text" class="form-control" name="sort" value="<?php echo $sort; ?>" size="1" /></div>
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
            $('#ad-imgs input[name="flag"]').val(json.path);
        }else{
            alert(json.error);
        }           
        $('.loading').remove(); 
    }
  });

    $(function(){
        $('a.fc-thumb').fancybox();
    });
</script>

<?php echo $footer; ?>