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
                <a id="cb-link-button" class="button" style="display:none;">Reset ClickBank</a>
                <a id="export-button" class="button"><?php echo $button_export; ?></a>     

            </div>
        </div>
        <div class="content">
            <div id="htabs" class="htabs">
                <a style="display:inline;" href="<?php echo $tab_photo_fbaccount;?>" <?php echo $tab=='photo_fbaccount' ? 'class="selected"':'';?>>Fbaccount Photo</a>
                <a style="display:inline;" href="<?php echo $tab_fbaccount;?>" <?php echo $tab=='fbaccount' ? 'class="selected"':'';?>>Fbaccount</a>
                <a style="display:inline;" href="<?php echo $tab_message;?>" <?php echo $tab=='message' ? 'class="selected"':'';?>>Message</a>
                <a style="display:inline;" href="<?php echo $tab_ads;?>" <?php echo $tab=='ads' ? 'class="selected"':'';?>>Ads</a>
            </div>
            <form action="" method="post" id="form">
                <table class="list">
                    <thead>
                        <tr>
                            <td width="1" style="text-align: center;">
                                <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                            </td>
                            <td class="left"><?php if ($sort == 'entry_name') { ?>
                                <a href="<?php echo $sort_entry_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_entry_name; ?>"><?php echo $column_product; ?></a>
                                <?php } ?>
                            </td>
                            <td class="left"><?php if ($sort == 'mc.customer_id') { ?>
                                <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_customer; ?>"><?php echo $column_author; ?></a>
                                <?php } ?>
                            </td>
                            <td class="left"><?php if ($sort == 'mc.publish') { ?>
                                <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                <?php } ?>
                            </td>
                            <td class="left">
                                <?php if ($sort == 'mc.contribute_sn') { ?>
                                <a href="<?php echo $sort_contribute_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_contribute_sn; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_contribute_sn; ?>"><?php echo $column_contribute_sn; ?></a>
                                <?php } ?>
                            </td>
                            <td class="left"><?php if ($sort == 'mc.target_url') { ?>
                                <a href="<?php echo $sort_target_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_url; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_target_url; ?>"><?php echo $column_target_url; ?></a>
                                <?php } ?>
                            </td>
                            <td class="left"><?php if ($sort == 'user') { ?>
                                <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_auditor; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_user; ?>"><?php echo $column_auditor; ?></a>
                                <?php } ?>
                            </td>
                            <td class="right"><?php echo $column_action; ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="filter">
                            <td></td>
                            <td><input type="text" name="filter_entry" value="<?php echo $filter_entry; ?>" /></td>
                            <td><input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>"/></td>
                            <td>
                                <select name="filter_publish" style="width:80px;">
                                    <option value="*"></option>
                                    <?php if($tab=='ads'){?>
                                        <?php foreach ($ads_publishes as $item) { ?>
                                        <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $filter_publish) ? 'selected="selected"' : '' ?>><?php echo $item['name']; ?></option>
                                        <?php } ?>
                                    <?php }else if($tab=='message'){?>
                                        <?php foreach ($message_publishes as $item) { ?>
                                        <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $filter_publish) ? 'selected="selected"' : '' ?>><?php echo $item['name']; ?></option>
                                        <?php } ?>
                                    <?php } else if($tab=='fbaccount'){?>
                                        <?php foreach ($post_publishes as $item) { ?>
                                        <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $filter_publish) ? 'selected="selected"' : '' ?>><?php echo $item['name']; ?></option>
                                        <?php } ?>
                                    <?php } else {?>
                                        <?php foreach ($photo_post_publishes as $item) { ?>
                                        <option value="<?php echo $item['publish_id']; ?>" <?php echo ($item['publish_id'] == $filter_publish) ? 'selected="selected"' : '' ?> ><?php echo $item['name']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td><input type="text" name="filter_contribute_sn" value="<?php echo $filter_contribute_sn;?>"></td>
                            <td></td>
                            <td>
                                <select name="filter_user_id">
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['user_id'] == $filter_user_id) { ?>
                                    <option value="<?php echo $user['user_id']; ?>" selected="selected"><?php echo $user['lastname'].$user['firstname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['user_id']; ?>"><?php echo $user['lastname'].$user['firstname']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </td>
                            <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
                        </tr>
                    <?php if ($contributes) { ?>
                    <?php foreach ($contributes as $item) { ?>
                        <tr >
                            <td style="text-align: center;">
                                <?php echo '<a name="'.$item['contribute_id'].'">'.$item['contribute_id'].'</a>'; ?>
                                <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>" <?php echo ($item['selected']) ? 'checked="checked"' : '' ?>  />
                            </td>
                            <td class="left">
                                <?php echo $item['entry_sn'].' - '.$item['entry_name']; ?> (<?php echo $item['product']; ?>)
                            </td>
                            <td class="left"><?php echo $item['author']; ?></td>
                            <td class="left"><?php echo $item['publish_text']; ?></td>
                            <td class="left"><?php echo $item['contribute_sn']; ?></td>
                            <td class="left">
                                <a id="url-<?php echo $item['contribute_id'] ?>" target="_blank" href="<?php echo $item['target_url'] ?>"><?php echo $item['target_url']; ?></a>
                            </td>
                            <td class="left"><?php echo $item['auditor']; ?></td>
                            <td class="right"><?php foreach ($item['action'] as $action) { ?>
                             [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ] 
                              <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr><td class="center" colspan="8"><?php echo $text_no_results; ?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
            <div class="pagination"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>

<div id="export-dialog" style="display:none;">
    <div class="do-result"></div>
    <form id="export-form" action="<?php echo $export; ?>" method="post">
        <input type="hidden" name="tab" value="<?php echo $tab ?>" />
        <table class="form">
            <tr>
                <td>Website:</td>
                <td>
                    <input type="text" id="-website"  style="width:80%"/>
                    <input type="hidden" name="entry_sn" />
                </td>
            </tr>
            <tr>
                <td>Author</td>
                <td>
                    <input type="text" id="-customer" style="width:80%"/>
                    <input type="hidden" name="customer_id" />
                </td>
            </tr>
            <tr>
                <td>Auditor</td>
                <td>
                    <select name="auditor_id">
                        <option value="0"></option>
                        <?php foreach ($all_markets as $user) { ?>
                        <option value="<?php echo $user['user_id']; ?>"><?php echo $user['lastname'].$user['firstname']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <td>Post Status:</td>
            <td>
                <select name="publish">
                    <option value="*"></option>
                <?php if($tab=='ads'){?>
                    <?php foreach ($ads_publishes as $item) { ?>
                    <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                    <?php } ?>
                <?php }else if($tab=='message'){?>
                    <?php foreach ($message_publishes as $item) { ?>
                    <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                    <?php } ?>
                <?php } else if($tab=='fbaccount'){?>
                    <?php foreach ($post_publishes as $item) { ?>
                    <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                    <?php } ?>
                <?php } else {?>
                    <?php foreach ($photo_post_publishes as $item) { ?>
                    <option value="<?php echo $item['publish_id']; ?>" ><?php echo $item['name']; ?></option>
                    <?php } ?>
                <?php } ?>
                </select>
            </td>
        </table>
    </form>
</div>

<div id="detail-dialog"></div>

<script type="text/javascript"><!--	
function edit_link(cid){
    $('.alert').remove();
    $('#detail-dialog').html('<div><b>Target URL:</b><input type="text" name="target_url" value="'+$('#url-'+cid).text()+'" style="width:90%;"></div>');
    $('#detail-dialog').dialog({
        title:"Edit Target URL",
        modal:true,
        width:680,
        buttons:{
            'Save':function(){
                $.ajax({
                    url:'index.php?route=report/link/update&token=<?php echo $token;?>',
                    type:'Post',
                    data:{contribute_id:cid,tab:'<?php echo isset($this->request->get['tab']) ? trim($this->request->get['tab']) : 'photo_fbaccount' ?>','target_url':$('input[name="target_url"]').val()},
                    dataType:'json',
                    success:function(data){
                        if(data.status == 0){
                            $('#detail-dialog').append('<div class="alert warning">'+data.msg+'</div>');
                        }else{
                            $('#detail-dialog').append('<div class="alert success">'+data.msg+'</div>');
                            location.reload();
                        }
                    }
                });
            },
            'Close':function(){
                $(this).dialog('close');
            }
      }
    });
}
$('#export-button').bind('click',function(){
    $('#export-dialog .do-result').empty();
    $('#export-dialog').dialog({
        title:'Export Target URL',
        width: 680,
        modal:true,
        buttons:{
            'Export':function(){
                $('#export-form').submit();
            }
        }
    });
});

function filter() {
      url = 'index.php?route=report/link&tab=<?php echo $tab ?>&token=<?php echo $token; ?>';
      var paramArr=[];
      $("tr.filter input[name],tr.filter select[name]").each(function(){
            if($(this).val() && $(this).val() != '*'){
                  paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
            }
      });
      if(paramArr.length>0){
            url+="&"+paramArr.join("&");
      }
      location = url;
}
var complete_url = '';
$('#export-dialog #-website,#export-dialog #-customer').focus(function(){
    if($(this).attr('id')=='-website'){
        complete_url = 'index.php?route=product/fbaccount/autocomplete&token=<?php echo $token; ?>'
    }else if($(this).attr('id')=='-customer'){
        complete_url = 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>'
    }
}).autocomplete({
    delay: 500,
    source: function(request, response) {
        $.ajax({
            url: complete_url+'&filter_name=' +  encodeURIComponent(request.term),
            dataType: 'json',
            success: function(json) {   
                response($.map(json, function(item) {
                    return {
                        label: item.value+' '+item.name,
                        name: item.value+' '+item.name,
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

$('#cb-link-button').click(function(){
    if(confirm('Reset all target url of ClickBank ')){
        $.ajax({
            url:'index.php?route=report/link/update&token=<?php echo $token;?>',
            type:'Post',
            data:{tab:'<?php echo isset($this->request->get['tab']) ? trim($this->request->get['tab']) : 'photo_fbaccount' ?>','clickbank':1},
            dataType:'json',
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
    }
});
//--></script>

<?php echo $footer; ?>