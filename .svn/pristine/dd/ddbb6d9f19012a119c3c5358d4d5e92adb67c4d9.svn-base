<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
            <div class="pull-right">
                <a id="btn-statistics" class="btn btn-primary " data-toggle="tooltip" title="Statistics"><i class="fa fa-refresh"></i></a>
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
                    <i class="fa fa-list"></i> <?php echo $heading_title; ?>
                </h3>
                <div class="pull-right">
                	<a href="<?php echo $reset ?>" class="btn btn-sm btn-warning"><?php echo $button_reset; ?></a>
                    <a onclick="$('#filter-column').slideToggle();" class="btn btn-sm btn-info">Show / Hide Filters</a>
                </div>
            </div>
            <div class="panel-body">
            	<div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
            		<form class="filter">
            			<div class="form-group clearfix">	
			                <label class="control-label"><?php echo $entry_time_range ?></label>
			                <div class="form-inline col-sm-offset-1">
			                    <select name="filter_time_range" class="form-control col-sm-4">
			                        <option value="*"></option>
			                        <option value="1" <?php echo $filter_time_range == 1 ? 'selected' : '' ?>><?php echo $entry_yesterday ?></option>
			                        <option value="2" <?php echo $filter_time_range == 2 ? 'selected' : '' ?>><?php echo $entry_thisweek ?></option>
			                        <option value="3" <?php echo $filter_time_range == 3 ? 'selected' : '' ?>><?php echo $entry_lastweek ?></option>
			                        <option value="4" <?php echo $filter_time_range == 4 ? 'selected' : '' ?>><?php echo $entry_thismonth ?></option>
			                        <option value="5" <?php echo $filter_time_range == 5 ? 'selected' : '' ?>><?php echo $entry_lastmonth ?></option>
			                        <option value="6" <?php echo $filter_time_range == 6 ? 'selected' : '' ?>><?php echo $entry_thisyear ?></option>
			                        <option value="7" <?php echo $filter_time_range == 7 ? 'selected' : '' ?>><?php echo $entry_lastyear ?></option>
			                    </select>
			                    &nbsp; 
			                    <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" class="date form-control col-sm-2" placeholder="<?php echo $entry_date_start ?>"/>
			                    &nbsp; 
			                    <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" class="date form-control col-sm-2" placeholder="<?php echo $entry_date_end ?>"/>		                    
			                    &nbsp; 
			                    <input type="button" onclick="filter();" class="btn btn-primary" value="<?php echo $button_filter; ?>">
			                </div>
						</div>
						<div class="form-group clearfix">	
			                <label class="control-label"><?php echo $entry_player ?></label>
			                <div class="col-sm-offset-1">
			                	<input type="text" id="filter-player" placeholder="input the player name" class="form-control" style="width: 200px"> 
			                
			               		<div id="filter-players" style="border:1px dashed #dddddd;max-height:150px;overflow-y:auto;padding:10px;<?php echo is_array($filter_players_data) ? '' : 'display:none'; ?>;">
			                        <?php if (is_array($filter_players_data)): ?>
			                        <?php foreach ($filter_players_data as $item): ?>
			                        <div class="player-items" style="display: inline-block;margin:5px;">
			                            <label class="label label-success">
			                            	<?php echo $item['name'].' #'.$item['number'] ?> 
			                            	<a class="badge bg-warning" onclick="$(this).parent().parent().remove();" title="Remove">X</a>
			                            </label>
			                            <input type="hidden" name="filter_players[]" value="<?php echo $item['player_id'] ?>">
			                        </div>
			                        <?php endforeach ?>
			                        <?php endif ?>
			                        <input type="button" value="Reset Players" class="ui-button ui-state-error ui-corner-all pull-right" onclick="$('.player-items,#filter-player').empty();$('#filter-players').hide();" > 
			                    </div>
			                </div>
			            </div>
			            <div class="form-group clearfix">	
			                <label class="control-label" style="width:85px;"><?php echo $entry_team ?></label>
			                <label class="control-label"><input type="button" value="All" class="ui-button ui-state-default ui-corner-all" data-rel="filter-team"></label>
				            <label class="control-label"><input type="button" value="None" class="ui-button ui-state-default ui-corner-all" data-rel="filter-team"></label>
							<label class="control-label"><input type="button" value="Inverse" class="ui-button ui-state-default ui-corner-all" data-rel="filter-team"></label>
			                <div id="filter-team" class="col-sm-offset-1">
			                	<?php foreach ($all_teams as $item) { ?>                        
			                    <div style="width: 180px;display:inline-block;"><label>
			                        <input type="checkbox" name="filter_teams[]" value="<?php echo $item['team_id']?>" <?php echo $filter_teams && in_array($item['team_id'], $filter_teams) ? 'checked="checked"' : '' ?> /> <?php echo $item['team_sn'].' '.$item['name_en'] ?>
			                    </label></div>
			                    <?php } ?>
			                </div>
			           </div>
			           <div class="form-group clearfix">	
			                <label class="control-label" style="width:85px;"><?php echo $entry_author ?></label>
			                <label class="control-label"><input type="button" value="All" class="ui-button ui-state-default ui-corner-all" data-rel="filter-author"></label>
				            <label class="control-label"><input type="button" value="None" class="ui-button ui-state-default ui-corner-all" data-rel="filter-author"></label>
							<label class="control-label"><input type="button" value="Inverse" class="ui-button ui-state-default ui-corner-all" data-rel="filter-author"></label>
			                <div id="filter-author" class="col-sm-offset-1">
			                	<?php foreach ($all_authors as $item) { ?>                        
			                    <div style="width: 180px;display:inline-block;">
			                        <input type="checkbox" name="filter_authors[]" value="<?php echo $item['author_id']?>" <?php echo $filter_authors && in_array($item['author_id'], $filter_authors) ? 'checked="checked"' : '' ?>/> <?php echo $item['author_id'].' '.$item['nickname'] ?>
			                    </div>
			                    <?php } ?>
			                </div>
			           </div>
			           <div class="form-group clearfix">	
			                <label class="control-label" style="width:85px;"><?php echo $entry_status ?></label>
			                <label class="control-label"><input type="button" value="All" class="ui-button ui-state-default ui-corner-all" data-rel="filter-status"></label>
				            <label class="control-label"><input type="button" value="None" class="ui-button ui-state-default ui-corner-all" data-rel="filter-status"></label>
							<label class="control-label"><input type="button" value="Inverse" class="ui-button ui-state-default ui-corner-all" data-rel="filter-status"></label>
			                <div id="filter-status" class="col-sm-offset-1">
			                    <?php foreach ($post_statuses as $item) { ?>
			                    <div style="width: 180px;display: inline-block;" >
			                        <input type="checkbox" name="filter_statuses[]" value="<?php echo $item['status_id'] ?>" <?php echo $filter_statuses && in_array($item['status_id'], $filter_statuses) ? 'checked="checked"' : '' ?> /> <?php echo $item['name'] ?>
			                    </div>
			                    <?php } ?>
			                </div>
			           </div>
					</form>
		        </div>
		        <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
		        <div class="table-responsive">
		            <table class="table table-bordered table-hover">
		                <thead>
		                    <tr>
		                        <td class="text-left"><?php if ($sort == 'tp.team') { ?>
		                            <a href="<?php echo $sort_team; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_team; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_team; ?>"><?php echo $column_team; ?></a>
		                            <?php } ?>
		                        </td>
		                        <td class="text-left"><?php if ($sort == 'player') { ?>
		                            <a href="<?php echo $sort_player; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_player; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_player; ?>"><?php echo $column_player; ?></a>
		                            <?php } ?>
		                        </td>
		                        <td class="text-left"><?php if ($sort == 'author') { ?>
		                            <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
		                            <?php } ?>
		                        </td>
		                        <td class="text-center"><?php if ($sort == 'status') { ?>
		                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
		                            <?php } ?>
		                        </td>
		                        <td class="text-center"><?php if ($sort == 'posts') { ?>
		                            <a href="<?php echo $sort_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_posts; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_posts; ?>"><?php echo $column_posts; ?></a>
		                            <?php } ?>
		                        </td>
		                        <td class="text-center"><?php if ($sort == 'amount') { ?>
		                            <a href="<?php echo $sort_amount; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_amount; ?></a>
		                            <?php } else { ?>
		                            <a href="<?php echo $sort_amount; ?>"><?php echo $column_amount; ?></a>
		                            <?php } ?>
		                        </td>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php if($total_results){ ?>
		                    <tr>
		                        <td colspan="4" class="text-right"><strong>Total:</strong></td>
		                        <td class="text-center"><strong><?php echo $total_results['total']; ?></strong></td>
		                        <td class="text-center"><strong><?php echo $total_results['amount']; ?></strong></td>
		                    </tr>
		                    <?php } ?>
		                    <?php if($records){ ?>
		                    <?php foreach ($records as $item) { ?>
		                    <tr>
		                        <td class="text-left"><?php echo $item['team']; ?></td>
		                        <td class="text-left"><?php echo $item['player']; ?></td>
		                        <td class="text-left"><?php echo $item['author']; ?></td>   
		                        <td class="text-center"><?php echo $item['status_text']; ?></td>
		                        <td class="text-center"><?php echo $item['posts']; ?></td>
		                        <td class="text-center"><?php echo $item['amount']; ?></td>
		                    </tr>
		                    <?php } ?>
		                    <?php }else{ ?>
		                    <tr><td class="text-center" colspan="6"><?php echo $text_no_results; ?></td></tr>
		                    <?php } ?>
		                </tbody>
		            </table>
		           
		    	</div>
		    	<div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="view/javascript/get_date.js"></script>
<script type="text/javascript"><!-- 
$(function(){ 
    $('input[type="button"][value="All"]').click(function(){
        $('#'+$(this).attr('data-rel')+' :checkbox').prop("checked", true);
    });   
    $('input[type="button"][value="None"]').click(function(){
        $('#'+$(this).attr('data-rel')+' :checkbox').prop("checked", false);
    });   
    $('input[type="button"][value="Inverse"]').click(function(){  
        $('#'+$(this).attr('data-rel')+' :checkbox').each(function(){
            $(this).prop("checked",!$(this).attr("checked"));
        }); 
    }); 
}); 
$('#btn-statistics').bind('click',function(){
    if(confirm(' ReStatistics ?')){
        $.ajax({
            url:'index.php?route=nfl/report/ajax_data&token=<?php echo $token; ?>',
            type:'post',
            dataType:'json',
            data:{action:'statistics'},
            beforeSend:function(){
                $('.do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG; ?>loading.gif"> Is statistical data! Please Waitting ... </div>');
            },
            success:function(data){
                $('.attention,.warning,.success').remove();
                if(data.status == 0){
                    $('.do-result').html('<div class="alert alert-warning"> Exception!</div>');
                }else{
                    $('.do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                    setTimeout('location.reload();',3000) ;
                }
            }
        });
        
    }
});


$('.filter select[name="filter_time_range"]').change(function(){
    if($(this).val()=='*'){
        $('.filter .date').val('');
    }else{
        var filter_date;
        switch(parseInt($(this).val())){
            case 1:
                filter_date = getYesterdayDate();
            break;
            case 2:
                filter_date = getCurrentWeek();
            break;
            case 3:
                filter_date = getPreviousWeek();
            break;
            case 4:
                filter_date = getCurrentMonth();
            break;
            case 5:
                filter_date = getPreviousMonth();
            break;
            case 6:
                filter_date = getThisYear();
            break;
            case 7:
                filter_date = getPreviousYear();
            break;
        }
        if(filter_date.length=2){
            $('.filter input[name="filter_date_start"]').val(filter_date[0]);
            $('.filter input[name="filter_date_end"]').val(filter_date[1]);
        }
    }
});


$('#filter-player').autocomplete({
    delay: 500,
    source: function(request, response) {
        $.ajax({
            url: 'index.php?route=nfl/player/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
            dataType: 'json',
            success: function(json) {   
                response($.map(json, function(item) {
                    return {
                        category: item['team'],
                        label: item['name'],
                        value: item['player_id'],
                        team: item['team_id'],
                    }
                }));
            }
        });
    }, 
    select: function(event, ui) { 
        var put = true;
        $.each($('#filter-players input[name^="filter_players"]'),function(){
            if($(this).val()==parseInt(ui.item['value'])){
                alert('already exists');
                put =false;
            }
        });
        if(put==true){
            var option = '<div class="player-items" style="display: inline-block;margin:5px;">';
            option += '<label class="label label-success"> '+ui.item['label']+'<a class="badge" onclick="$(this).parent().parent().remove();" title="Remove">X</a></label>';
            option += '<input type="hidden" name="filter_players[]" value="'+ui.item['value']+'"></div>';
            $('#filter-players').prepend(option).show();  
        }
        
        return false; 
    },
    focus: function(event, ui) {
        return false;
    }
});

function filter() {
    url = 'index.php?route=nfl/report&token=<?php echo $token; ?>';
    
    var players=[];
    $('input[name="filter_players[]"]').each(function(){
        if($(this).val() ){
            players.push($(this).val());
        }
    });
    if(players.length>0){
        url+="&filter_players="+players.join();
    }
    var teams=[];
    $('input[name="filter_teams[]"]:checked').each(function(){
        if($(this).val() ){
            teams.push($(this).val());
        }
    });
    if(teams.length>0){
        url+="&filter_teams="+teams.join();
    }
    var authors=[];
    $('input[name="filter_authors[]"]:checked').each(function(){
        if($(this).val() ){
            authors.push($(this).val());
        }
    });
    if(authors.length>0){
        url+="&filter_authors="+authors.join();
    }
    var statuses=[];
    $('input[name="filter_statuses[]"]:checked').each(function(){
        if($(this).val() ){
            statuses.push($(this).val());
        }
    });
    if(statuses.length>0){
        url+="&filter_statuses="+statuses.join();
    }
    if(parseInt($('select[name="filter_time_range"]').val()) > 0){
        url+="&filter_time_range="+encodeURIComponent($('select[name="filter_time_range"]').val());
    }
    if($('input[name="filter_date_start"]').val()!=''){
        url+="&filter_date_start="+encodeURIComponent($('input[name="filter_date_start"]').val());
    }
    if($('input[name="filter_date_end"]').val()!=''){
        url+="&filter_date_end="+encodeURIComponent($('input[name="filter_date_end"]').val());
    }
    location = url;
}

$('.date').datepicker({dateFormat: 'yy-mm-dd'});


//--></script>
<?php echo $footer; ?>