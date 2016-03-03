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
                
            </div>
        </div>
        
        <div class="content">
            <div id="htabs" class="htabs">
                <a style="display:inline;" href="<?php echo $tab_photo_fbaccount;?>" <?php echo $tab=='photo_fbaccount' ? 'class="selected"':'';?> ><?php echo $tab_title_photo;?></a>
                <a style="display:inline;" href="<?php echo $tab_fbaccount;?>" <?php echo $tab=='fbaccount' ? 'class="selected"':'';?> ><?php echo $tab_title_fbaccount;?></a>
                <a style="display:inline;" href="<?php echo $tab_fbpage;?>" <?php echo $tab=='fbpage' ? 'class="selected"':'';?>><?php echo $tab_title_fbpage;?></a>
                <a style="display:inline;" href="<?php echo $tab_message;?>" <?php echo $tab=='message' ? 'class="selected"':'';?>><?php echo $tab_title_message;?></a>
                <a style="display:inline;" href="<?php echo $tab_ads;?>" <?php echo $tab=='ads' ? 'class="selected"':'';?>><?php echo $tab_title_ads;?></a>
            </div>

            <table class="filter" align="center">
                <tr>
                    <?php if($tab!='fbpage'){ ?>
                    <td><strong><?php echo $entry_sn ?></strong> 
                        <input type="text" name="filter_sn" value="<?php echo $filter_sn; ?>" size="12" />
                    </td>
                    <?php }else{ ?>
                    <td><strong><?php echo $entry_id ?></strong> 
                        <input type="text" name="filter_id" value="<?php echo $filter_id; ?>" />
                    </td>
                    <?php } ?>
                    <td style="position: relative;"><strong><?php echo $entry_author ?></strong> 
                        <input type="text" id="_customer" value="<?php echo $filter_author;?>">
                        <input type="hidden" name="filter_customer_id" value="<?php echo $filter_customer_id; ?>" />
                        <a class="clear">Clear</a>
                    </td>
                    <td><strong><?php echo $entry_publish ?></strong> 
                        <select name="filter_publish">
                            <option value="*"></option>
                        <?php if($tab=='photo_fbaccount') { ?>
                            <?php foreach ($photo_post_publishes as $item) { ?>
                            <option value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $filter_publish ? 'selected' : '' ?>><?php echo $item['name']; ?></span>
                            <?php } ?>
                        <?php }else if($tab=='message'){ ?>
                            <?php foreach ($message_publishes as $item) { ?>
                            <option value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $filter_publish ? 'selected' : '' ?>><?php echo $item['name']; ?></span>
                            <?php } ?>
                        <?php }else if($tab=='ads'){ ?>
                            <?php foreach ($ads_publishes as $item) { ?>
                            <option value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $filter_publish ? 'selected' : '' ?>><?php echo $item['name']; ?></span>
                            <?php } ?>
                        <?php }else{ ?>
                            <?php foreach ($post_publishes as $item) { ?>
                            <option value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $filter_publish ? 'selected' : '' ?>><?php echo $item['name']; ?></span>
                            <?php } ?>
                        <?php } ?>
                        </select>
                    </td>
                    <td><strong><?php echo $entry_product ?></strong> 
                        <select name="filter_product_config_id">
                            <option value="*"></option>
                            <?php foreach ($all_products as $product) { ?>
                            <option value="<?php echo $product['contribute_config_id'] ?>" <?php echo $product['contribute_config_id']==$filter_product_config_id ? 'selected' : '' ?>><?php echo $product['name'] ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><strong><?php echo $entry_start_value ?></strong>
                        <input type="text" name="filter_start_value" value="<?php echo $filter_start_value; ?>" size="3" />
                    </td>
                    <td><strong><?php echo $entry_end_value ?></strong>
                        <input type="text" name="filter_end_value" value="<?php echo $filter_end_value; ?>" size="3" />
                    </td>
                    <td><a onclick="filter();" class="button"> <?php echo $button_filter; ?></a></td>
                    <td>
                        <?php if($redo){?>
                        <a class="statistics button"><?php echo $button_statistics ?></a>
                        <?php }?>
                    </td>
                </tr>
            </table>
            <table class="list">
                <thead>
                    <tr>
                        <td class="right"><?php if ($sort == 'bfirstname') { ?>
                            <a href="<?php echo $sort_base_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_base_author; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_base_author; ?>"><?php echo $column_base_author; ?></a>
                            <?php } ?>
                        </td>
                        <td class="right"><?php if ($sort == 'base_product') { ?>
                            <a href="<?php echo $sort_base_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_base_product; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_base_product; ?>"><?php echo $column_base_product; ?></a>
                            <?php } ?>
                        </td>
                        <td class="right"><?php if ($sort == 'base_publish') { ?>
                            <a href="<?php echo $sort_base_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_base_publish; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_base_publish; ?>"><?php echo $column_base_publish; ?></a>
                            <?php } ?>
                        </td>
                        <?php if($tab=='fbpage'){ ?>
                        <td class="right"><?php echo $column_base_post_id; ?></td>
                        <?php }else{ ?>
                        <td class="right"><?php if ($sort == 'bp.contribute_sn') { ?>
                            <a href="<?php echo $sort_base_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_base_sn; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_base_sn; ?>"><?php echo $column_base_sn; ?></a>
                            <?php } ?>
                        </td>
                        <?php } ?>
                        <td class="center"><?php if ($sort == 'sp.value') { ?>
                            <a href="<?php echo $sort_value; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_similar_value; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_value; ?>"><?php echo $column_similar_value; ?></a>
                            <?php } ?>
                        </td>
                        <?php if($tab=='fbpage'){ ?>
                        <td class="left"><?php echo $column_other_post_id; ?></td>
                        <?php }else{ ?>
                        <td class="left"><?php if ($sort == 'sp.contribute_sn') { ?>
                            <a href="<?php echo $sort_other_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_other_sn; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_other_sn; ?>"><?php echo $column_other_sn; ?></a>
                            <?php } ?>
                        </td>
                        <?php } ?>                         
                        <td class="left"><?php if ($sort == 'other_publish') { ?>
                            <a href="<?php echo $sort_other_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_other_publish; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_other_publish; ?>"><?php echo $column_other_publish; ?></a>
                            <?php } ?>
                        </td>    
                        <td class="left"><?php if ($sort == 'other_product') { ?>
                            <a href="<?php echo $sort_other_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_other_product; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_other_product; ?>"><?php echo $column_other_product; ?></a>
                            <?php } ?>
                        </td> 
                        <td class="left"><?php if ($sort == 'ofirstname') { ?>
                            <a href="<?php echo $sort_other_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_other_author; ?></a>
                            <?php } else { ?>
                            <a href="<?php echo $sort_other_author; ?>"><?php echo $column_other_author; ?></a>
                            <?php } ?>
                        </td>                      
                        <td class="right"><?php echo $column_action; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($contributes) { ?>
                    <?php foreach ($contributes as $item) { ?>
                    <tr >
                        <td class="right"><?php echo $item['base_author']; ?></td>
                        <td class="right"><?php echo $item['base_product']; ?></td>
                        <td class="right"><?php echo $item['base_publish']; ?></td>
                        <td class="right">
                            <span style="color:blue;"><?php echo $item['base_sn'] ? $item['base_sn'] : $item['base_post_id']; ?></span>
                        </td>
                        <td class="center">
                            <span style="color:red;font-weight:bold;"><?php echo $item['value']; ?></span>
                            <?php if($tab=='ads'){ echo '['.ucfirst($item['mode']).']'; }?>
                        </td>
                        <td class="left">
                            <span style="color:blue;"><?php echo $item['other_sn'] ? $item['other_sn'] : $item['other_post_id']; ?></span>
                        </td>
                        <td class="left"><?php echo $item['other_publish']; ?></td>
                        <td class="left"><?php echo $item['other_product']; ?></td>
                        <td class="left"><?php echo $item['other_author']; ?></td>
                        <td class="right"><?php foreach ($item['action'] as $action) { ?>
                         [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ] 
                          <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr><td class="center" colspan="10"><?php echo $text_no_results; ?></td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="pagination"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>
<div id="similar-dialog" style="display:none;width:100%;"> 
    <table class="form">
        <tr><td colspan="2" class="diff"></td></tr>
        <tr>
            <td style="width:49%">
                <textarea spellcheck="false" id="text1"></textarea>
            </td>
            <td style="width:49%">
                <textarea spellcheck="false" id="text2"></textarea>
            </td>
        </tr>
    </table> 
</div>
<script type="text/javascript" src="<?php echo HTTP_CATALOG ?>asset/prettytextdiff/pretty-text-diff.js"></script>
<script type="text/javascript" src="<?php echo HTTP_CATALOG ?>asset/prettytextdiff/diff_match_patch.js"></script>
<style type="text/css">
    table textarea{padding:5px;border:1px dashed #cccccc;min-height:120px;width:99%;}
    ins {background-color: #c6ffc6;text-decoration: none; }
    del {background-color: #ffc6c6; }
    .filter td :not(strong):not(.clear) {float: right;margin-left: 3px;}
    .filter td .clear {color:blue;position: absolute;right:2px;bottom:3px;}
    .filter td .clear:hover{background: blue;color: #fff;}
    .filter td .date{width: 80px}
  </style>
<script type="text/javascript"><!-- 
    $('.statistics').click(function(){
        if(confirm('Reanalysis Posts ? Please wait for a while !')){
            var that = this;
            $.ajax({
                url:'index.php?route=report/statistics/ajax_data&token=<?php echo $token; ?>',
                data:{action:'similar',mode:'<?php echo $tab ?>'},
                type:'post',
                dataType:'json',
                beforeSend:function(){
                    $('.attention,.success,.warning').remove();
                    $(that).attr('disabled','disabled');
                    $('.filter').after('<div class="attention"><img src="view/image/loading.gif"> Please Waitting</div>');
                },
                success:function(json){
                    if(json.status == 1){
                        $('.attention,.success,.warning').remove();
                        $(that).removeAttr('disabled');
                        $('.filter').after('<div class="success">'+json.msg+' : '+json.times+' </div>');
                        location.reload();
                    }
                }
            })
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

    function similar_view(base_id,other_id,type){
        $('.diff').empty();
        $.ajax({
            url:'index.php?route=report/statistics/ajax_data&token=<?php echo $token;?>',
            data:{action:'compare',base_id:base_id,other_id:other_id,mode:'<?php echo $tab ?>',type:type},
            type:'Post',
            dataType:'json',
            success:function(json){
                $("#similar-dialog .form tr").prettyTextDiff({
                    originalContent: json.base,
                    changedContent: json.other,
                    diffContainer: ".diff"
                });
                $('#text1').html(json.base);
                $('#text2').html(json.other);
                $('.diff').prepend('<div class="alert success">'+json.msg+'</div>');
                $('#similar-dialog').dialog('open');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    function filter() {
        url = 'index.php?route=report/statistics/similar&tab=<?php echo $tab ?>&token=<?php echo $token; ?>';
        
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

    $('#similar-dialog').dialog({
        width:800,
        autoOpen:false,
        title:'Similar Text Detail',
        buttons:{'close':function(){$(this).dialog('close');}}
    });
//--></script>

<?php echo $footer; ?>