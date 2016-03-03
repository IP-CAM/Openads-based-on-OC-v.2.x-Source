<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">

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
    	<div class="do-result">
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
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-list"></i> <?php echo $text_list; ?>
                </h3>
                <div class="pull-right">
                    <a class="btn btn-sm btn-default" onclick="$('#export-form').hide();$('#filter-column').slideToggle();">
                    	<i class="fa fa-filter"></i> Filters
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo str_replace('<br>', ' ', $column_date_modified)  ?></label>
                                <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>"  class="date form-control"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_author ?></label>
                                <select name="filter_author" class="form-control" >
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['user_id'] == $filter_author) { ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['nickname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['nickname']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo str_replace('<br>', ' ', $column_auditor)  ?></label>
                                <select name="filter_user_id" class="form-control" >
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['user_id'] == $filter_user_id) { ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['nickname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['nickname']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_status ?></label>
                                <select name="filter_status" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_status) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_publish ?></label>
                                <select name="filter_publish" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_publishes as $item) { ?>
                                    <?php if ($item['publish_id'] == $filter_publish) { ?>
                                    <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                         <div class="col-sm-4">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_team ?></label>
                                <select name="filter_team" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($all_teams as $item) { ?>
                                    <option value="<?php echo $item['team_id'] ?>" <?php echo $item['team_id']==$filter_team ? 'selected' : '' ?>><?php echo $item['team_sn'] ?> <?php echo $item['name_en'] ?> <?php echo $item['name_cn'] ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input-player" class="control-label"><?php echo $column_player ?></label>
                                <input type="text" id="input-player" value="<?php echo $filter_player ?>" class="form-control"/>
                                <input type="hidden" name="filter_player_id" value="<?php echo $filter_player_id ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_contribute_sn ?></label>
                                <input type="text" name="filter_contribute_sn" value="<?php echo $filter_contribute_sn;?>" class="form-control">
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
                <form action="" method="post" id="form">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>
                                    <td width="1" style="text-align: center;">
                                        <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                                    </td>
                                    <td class="text-center">
                                        <?php if ($sort == 'nc.contribute_sn') { ?>
                                        <a href="<?php echo $sort_contribute_sn; ?>" class="<?php echo strtolower($order); ?>" ><?php echo $column_contribute_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_contribute_sn; ?>"><?php echo $column_contribute_sn; ?></a>
                                        <?php } ?>
                                    </td>              
                                    <td class="text-center"><?php if ($sort == 'nc.author_id') { ?>
                                        <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left">
                                        <?php if ($sort == 'nc.team_id') { ?>
                                        <a href="<?php echo $sort_team; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_team; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_team; ?>"><?php echo $column_team; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'nc.player_id') { ?>
                                        <a href="<?php echo $sort_player; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_player; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_player; ?>"><?php echo $column_player; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'nc.status') { ?>
                                        <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'nc.publish') { ?>
                                        <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                        <?php } ?>
                                    </td>                                    
                                    <td class="text-center"><?php if ($sort == 'nc.user_id') { ?>
                                        <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_auditor; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_user; ?>"><?php echo $column_auditor; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'nc.date_modified') { ?>
                                        <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($contributes) { ?>
                                <?php foreach ($contributes as $item) { ?>
                                <tr>
                                    <td style="text-align: center;"><?php echo $item['contribute_id']; if ($item['selected']) { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>" checked="checked" />
                                      <?php } else { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>"  />
                                      <?php } ?>
                                    </td>            
                                    <td class="text-center"><?php echo $item['contribute_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['author']; ?></td>
                                    <td class="text-left"><?php echo $item['team']; ?></td>              
                                    <td class="text-left"><?php echo $item['player']; ?></td>
                                    <td class="text-center"><?php echo $item['status_text']; ?></td>
                                    <td class="text-center"><?php echo $item['publish_text']; ?></td>
                                    <td class="text-center"><?php echo $item['auditor']; ?></td>
                                    <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                    <td class="text-center"><?php foreach ($item['action'] as $action) { ?>
                                     <a class="btn btn-primary" href="<?php echo $action['href']; ?>" data-toggle="tooltip" title="<?php echo $action['text']; ?>"><i class="fa <?php echo $item['lock'] ? 'fa-lock' : 'fa-eye' ?>"></i></a>
                                      <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr><td class="text-center" colspan="12"><?php echo $text_no_results; ?></td></tr>
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
        $('select[name="filter_team"]').val(ui.item['team']);
        return false;
    } 
});
</script>
<script type="text/javascript"> 

$('#button-filter').bind('click',function() {
    url = 'index.php?route=nfl/post_player&token=<?php echo $token; ?>';
    var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
        if($(this).val() && $(this).val() != '*'){
            paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
        }
    });
    if(paramArr.length>0){
        url+="&"+paramArr.join("&");
    }
    location = url;
});

$('.date').datetimepicker({pickTime:false});
</script>

<?php echo $footer; ?>