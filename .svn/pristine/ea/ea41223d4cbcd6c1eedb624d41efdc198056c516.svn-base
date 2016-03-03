<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/log.png" /> <?php echo $heading_title; ?></h1>
            <div class="buttons">    
                <a id="btn-statistics" class="button">Statistics</a>
            </div>
        </div>

        <div class="content">
            <table class="filter" align="center">
                <tr>
                    <td>
                        <strong><?php echo $entry_product_type ?></strong> 
                        <select name="filter_product_type">
                            <option value="*"></option>
                            <option value="1" <?php echo $filter_product_type==1 ? 'selected' : '' ?>><?php echo $entry_outsource ?></option>
                            <option value="2" <?php echo $filter_product_type==2 ? 'selected' : '' ?>><?php echo $entry_isclickbank ?></option>
                        </select>
                    </td>
                    <td style="position: relative;"><strong><?php echo $entry_author ?></strong> 
                        <input type="text" id="_customer" value="<?php echo $filter_customer;?>">
                        <input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" />
                        <a class="clear">Clear</a>
                    </td>
                    <td><strong><?php echo $entry_time_range ?></strong>
                        <select name="filter_time_range">
                            <option value="*"></option>
                            <option value="1" <?php echo $filter_time_range == 1 ? 'selected' : '' ?>><?php echo $entry_yesterday ?></option>
                            <option value="2" <?php echo $filter_time_range == 2 ? 'selected' : '' ?>><?php echo $entry_thisweek ?></option>
                            <option value="3" <?php echo $filter_time_range == 3 ? 'selected' : '' ?>><?php echo $entry_lastweek ?></option>
                            <option value="4" <?php echo $filter_time_range == 4 ? 'selected' : '' ?>><?php echo $entry_thismonth ?></option>
                            <option value="5" <?php echo $filter_time_range == 5 ? 'selected' : '' ?>><?php echo $entry_lastmonth ?></option>
                            <option value="6" <?php echo $filter_time_range == 6 ? 'selected' : '' ?>><?php echo $entry_thisyear ?></option>
                            <option value="7" <?php echo $filter_time_range == 7 ? 'selected' : '' ?>><?php echo $entry_lastyear ?></option>
                        </select>
                    </td>
                    <td><strong><?php echo $entry_date_start ?></strong>
                        <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" class="date" />
                    </td>
                    <td><a href="<?php echo $reset ?>" class="button"><?php echo $button_reset; ?></a></td>     
                </tr>
                <tr>
                    <td><strong><?php echo $entry_post_type ?></strong> 
                        <select name="filter_post_type">
                            <option value="*"></option>
                            <option value="1" <?php echo $filter_post_type==1 ? 'selected' : '' ?>><?php echo $entry_withphoto; ?></option>  
                            <option value="2" <?php echo $filter_post_type==2 ? 'selected' : '' ?>><?php echo $entry_withoutphoto; ?></option>
                            <option value="3" <?php echo $filter_post_type==3 ? 'selected' : '' ?>><?php echo $entry_message; ?></option>
                            <option value="4" <?php echo $filter_post_type==3 ? 'selected' : '' ?>><?php echo $entry_ads; ?></option>
                        </select>
                    </td>
                    
                    <td style="display:none"><strong ><?php echo $entry_status ?></strong> 
                        <select name="filter_status">
                            <option value="*"><?php echo $text_none ?></option>
                            <optgroup label="With Photo" data-val="1">
                            <?php foreach ($photo_post_statuses as $_status) { ?>
                                <option value="<?php echo $_status['status_id'] ?>" <?php echo $_status['status_id']==$filter_status ? 'selected' : '' ?>><?php echo $_status['name'] ?></option>
                            <?php } ?>
                            </optgroup>
                            <optgroup label="Without Photo" data-val="2">
                            <?php foreach ($post_statuses as $_status) { ?>
                                <option value="<?php echo $_status['status_id'] ?>" <?php echo $_status['status_id']==$filter_status ? 'selected' : '' ?>><?php echo $_status['name'] ?></option>
                            <?php } ?>
                            </optgroup>
                            <optgroup label="Message" data-val="3">
                            <?php foreach ($message_statuses as $_status) { ?>
                                <option value="<?php echo $_status['status_id'] ?>" <?php echo $_status['status_id']==$filter_status ? 'selected' : '' ?>><?php echo $_status['name'] ?></option>
                            <?php } ?>
                            </optgroup>
                            <optgroup label="Ads" data-val="3">
                            <?php foreach ($ads as $_status) { ?>
                                <option value="<?php echo $_status['status_id'] ?>" <?php echo $_status['status_id']==$filter_status ? 'selected' : '' ?>><?php echo $_status['name'] ?></option>
                            <?php } ?>
                            </optgroup>
                        </select>
                    </td>          
                    
                    <td><strong><?php echo $entry_entry_name ?></strong> 
                        <input type="text" name="filter_entry" value="<?php echo $filter_entry; ?>" />
                    </td>
                    <td><strong><?php echo $entry_product ?></strong> 
                        <select name="filter_product_config_id">
                            <option value="*"></option>
                            <?php foreach ($all_products as $product) { ?>
                            <option value="<?php echo $product['contribute_config_id'] ?>" <?php echo $product['contribute_config_id']==$filter_product_config_id ? 'selected' : '' ?>><?php echo $product['name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><strong><?php echo $entry_date_end ?></strong>
                        <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" class="date" />
                    </td>
                    <td><a onclick="filter();" class="button"> <?php echo $button_filter; ?></a></td>
                </tr>
            </table>
            <table class="list">
                <thead>
                    <tr>
                        <td class="left"><?php if ($sort == 'product_type') { ?>
                            <a href="<?php echo $sort_product_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product_type; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_product_type; ?>"><?php echo $column_product_type; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'post_type') { ?>
                            <a href="<?php echo $sort_post_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_post_type; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_post_type; ?>"><?php echo $column_post_type; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'author') { ?>
                            <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'product') { ?>
                            <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                            <?php } ?>
                        </td>
                        <td class="left"><?php if ($sort == 'entry') { ?>
                            <a href="<?php echo $sort_entry; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_entry; ?>"><?php echo $column_entry; ?></a>
                            <?php } ?>
                        </td>

                        <td class="left"><?php if ($sort == 'status') { ?>
                            <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                            <?php } ?>
                        </td>
                        <td class="right"><?php if ($sort == 'posts') { ?>
                            <a href="<?php echo $sort_posts; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_posts; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_posts; ?>"><?php echo $column_posts; ?></a>
                            <?php } ?>
                        </td>
                        <td class="right"><?php if ($sort == 'amount') { ?>
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
                        <td colspan="6" class="right"><strong>Total:</strong></td>
                        <td class="right"><strong><?php echo $total_results['total']; ?></strong></td>
                        <td class="right"><strong><?php echo $total_results['amount']; ?></strong></td>
                    </tr>
                    <?php } ?>
                    <?php if($records){ ?>
                    <?php foreach ($records as $item) { ?>
                    <tr>
                        <td class="left"><?php echo $item['product_type']; ?></td>
                        <td class="left"><?php echo $item['post_type']; ?></td>
                        <td class="left"><?php echo $item['author']; ?></td>              
                        <td class="left"><?php echo $item['product']; ?></td>
                        <td class="left"><?php echo $item['entry_sn'].' '.$item['entry_name']; ?></td>
                        <td class="left"><?php echo $item['status_text']; ?></td>
                        <td class="right"><?php echo $item['posts']; ?></td>
                        <td class="right"><?php echo $item['amount']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php }else{ ?>
                    <tr><td class="center" colspan="8"><?php echo $text_no_results; ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pagination"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="view/javascript/get_date.js"></script>
<style type="text/css">
    .filter td :not(strong):not(.clear) {float: right;margin-left: 3px;}
    .filter td .clear {color:blue;position: absolute;right:0;margin:6px 4px 0px 0px;}
    .filter td .clear:hover{background: blue;color: #fff;}
    .filter td .date {width: 80px;}
</style>
<script type="text/javascript"><!-- 

$('#btn-statistics').bind('click',function(){
    if(confirm(' ReStatistics ?')){
        $.ajax({
            url:'index.php?route=report/statistics/ajax_data&token=<?php echo $token; ?>',
            type:'post',
            dataType:'json',
            data:{action:'statistics'},
            beforeSend:function(){
                $('.box').before('<div class="attention"><img src="view/image/loading.gif"> Please Waitting</div>');
            },
            success:function(data){
                $('.attention,.warning,.success').remove();
                if(data.status == 0){
                    $('.box').before('<div class="alert warning"> Exception!</div>');
                }else{
                    $('.box').before('<div class="alert success">'+data.msg+'</div>');
                }
            }
        });
        location.reload();
    }
});
$('.filter td .clear').click(function(){$(this).parent().children('input').val('')});
$('.filter #_customer').autocomplete({
    delay: 500,
    source: function(request, response) {
        $.ajax({
            url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
            dataType: 'json',
            success: function(json) {   
                response($.map(json, function(item) {
                    return {
                        label: item.name,
                        name: item.name,
                        value: item.value
                    }
                }));
            }
        });
    }, 
    select: function(event, ui) { 
        $(this).val(ui.item.name)
        $(this).next('input:hidden').val(ui.item.value);               
        return false; 
    },
    focus: function(event, ui) {
        return false;
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
$('.filter select[name="filter_status"]').change(function(){
    if($(this).val()!='*'){
        $('.filter select[name="filter_post_type"]').val($(this).find('option:selected').parent().attr('data-val'));
    }
});
function filter() {
    url = 'index.php?route=report/statistics&token=<?php echo $token; ?>';
    
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
}

$('.date').datepicker({dateFormat: 'yy-mm-dd'});
//--></script>
<?php echo $footer; ?>