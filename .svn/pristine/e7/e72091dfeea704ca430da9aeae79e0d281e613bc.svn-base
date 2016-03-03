<div id="searchForm">
	Date Start:<input type="text" name="dateStart" value="<?php echo $dateStart;?>" size="12" id="dateStart" class="count-date">
	Date End:<input type="text" name="dateEnd" value="<?php echo $dateEnd;?>" size="12" id="dateEnd" class="count-date">
	<a href="javascript:;" class="button load-chart">Search</a>
</div>
<div id="chartContainer" style="width: 680px; height: 400px;margin:5px;"></div>
<table class="list" id="tableContainer" style="width:680px;"></table>

<script type="text/javascript">
	var fans_history=<?php echo $fans_history;?>;
	var date_set=[];
	var fans_set=[];
	var d_values=[];
	var lastPageFans = 0;
	for(var k in fans_history){
		var item=fans_history[k];
		date_set.push({"label":item.date});
		fans_set.push({"value":item.fans});
		if(k==0){
			d_values.push({"value":0});
		}else{
			d_values.push({"value":item.fans-lastPageFans});
		}
		
		lastPageFans = item.fans;
	}

	function renderTable(){
		var htmlArr = [];
		var lastFans = 0;
		htmlArr.push("<thead><tr><td class='left'>Date</td><td class='left'>Fans</td><td class='left'> </td></tr></thead><tbody>");	
		for(var k in fans_history){
			var item = fans_history[k];
			htmlArr.push("<tr>");
			htmlArr.push("<td class='left'>"+item.date+"</td>");
			htmlArr.push("<td class='left'>"+item.fans+"</td>");
			if(k==0){
				htmlArr.push("<td class='left'>--</td>");
			}else{
				htmlArr.push("<td class='left'>"+(item.fans - lastFans)+"</td>");
			}
			htmlArr.push("</tr>");
			lastFans = item.fans;
		}
		htmlArr.push("</tbody>");
		$("#tableContainer").html(htmlArr.join(""));
	}
	
	$(function(){
		var containerChart = new FusionCharts( "MSLine", "containerChart-<?php echo time();?>", "100%", "100%", "0", "1" );
		var category= [{"category":date_set}];
		var dataset = [
		 {"seriesname": "Fans", "color": "800080", "anchorbordercolor": "800080","data":fans_set},
		 {"seriesname": "Change-Value", "color": "1D8BD1", "anchorbordercolor": "1D8BD1","data":d_values}
		];
		var configData={			 
			"chart": {
				"caption": "'<?php echo $entry_sn." : ".$entry_name ;?>' Fans History",
				"labeldisplay": "ROTATE",
				"labelstep": "1",
				"slantlabels": "1",
				"chartrightmargin": "30",
				"formatnumberscale": "0",
				"divlinealpha": "20",
				"divlineisdashed": "1",
				"bgcolor": "FFFFFF,91AF46",
				"bgangle": "220",
				"bgalpha": "10,10"
			},
			"categories":category,
			"dataset":dataset
		};
		containerChart.setJSONData(configData);
		containerChart.render("chartContainer");
		renderTable();
		
	});
$('#tab-chart .load-chart').bind('click',function(){
	var params = '&token=<?php echo $token; ?>&entry_id=<?php echo $this->request->get['entry_id'];?>';
	
	if($('#searchForm input[name="dateStart"]').val()!=''){
		params += '&dateStart='+$('#searchForm input[name="dateStart"]').val();	
	}
	if($('#searchForm input[name="dateEnd"]').val()!=''){
		params += '&dateEnd='+$('#searchForm input[name="dateEnd"]').val();	
	}
	$('#fans-chart').load('index.php?route=product/fbpage/fans_chart'+params);
});
$('.count-date').datepicker({changeYear: true, dateFormat: 'yy-mm-dd' });
</script>