<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <?php if($artist_group){ ?>
                <a id="btn-artist" class="btn btn-info" data-toggle="tooltip" title="<?php echo $button_artist; ?>"><span class="glyphicon glyphicon-picture"></span></a>
                <?php } ?>
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
                <?php if($artist_group){ ?>
                <div class="well" id="export-form" style="display: none">
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" for="mode-link" style="width: 150px">Only Export Target URL:</label>
                        <input type="checkbox" onclick="$('.not-link').slideToggle();" value="link" name="mode" />
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary" id="btn-export"><span class="glyphicon glyphicon-export"></span> Export Posts</button>
                    </div>
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" style="width: 150px">Number of Short URL:</label>
                        <select name="filter_url_operator" class="form-control">
                            <option value="*"> </option>
                            <option value="dy">&gt;</option>
                            <option value="xy">&lt;</option>
                            <option value="=">=</option>
                        </select>
                        <input type="text" name="filter_url_number" value="5" class="form-control" style="width: 35px;"/>
                        
                    </div>
                    <div class="form-group clearfix form-inline">
                        <label class="control-label" style="width: 150px">Link Num (<i>In URL.csv</i>):</label>
                        <input type="text" name="link_num" value="10" class="form-control" style="width: 99px;" />
                    </div>

                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Status:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-status">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-status">None</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-inverse" data-rel="ex-status">Inverse</button></label>                            
                        <div id="ex-status">
                            <?php foreach ($post_statuses as $item) { ?>
                            <div style="display: inline-block;width: 150px;">
                                <input type="checkbox" name="filter_statuses[]" value="<?php echo $item['status_id'] ?>" <?php echo in_array($item['status_id'], $level_status) ? 'checked' : ''  ?> >
                                <?php echo $item['name']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Post Status:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-publish">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-publish">None</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-inverse" data-rel="ex-publish">Inverse</button></label>                        
                        <div id="ex-publish">
                            <?php foreach ($post_publishes as $item) { ?>
                            <div style="display: inline-block;width: 150px;">
                                <input type="checkbox" name="filter_publishes[]" value="<?php echo $item['publish_id']; ?>" <?php echo $item['publish_id'] == $promoting_publish ? 'checked' : '' ?>><?php echo $item['name']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group clearfix not-link">
                        <label class="control-label" style="width: 150px">Products:</label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-all" data-rel="ex-product">All</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-none" data-rel="ex-product">None</button></label>
                        <label class="control-label"><button type="button" class="btn btn-xs btn-default btn-inverse" data-rel="ex-product">Inverse</button></label>
                        <div id="ex-product">
                            <?php foreach ($all_products as $item) { ?>
                            <div style="display: inline-block;width: 140px;">
                                <input type="checkbox" name="filter_products[]" value="<?php echo $item['product_id'] ?>" checked><?php echo $item['code'].' '.$item['name'] ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>                    
                </div>
                <?php }?>            
                <div class="well" id="filter-column" <?php echo $filter_column ? '' : 'style="display:none ;"'?>>
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo str_replace('<br>', ' ', $column_date_modified)  ?></label>
                                <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>"  class="date form-control" data-date-format="YYYY-MM-DD"/>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_author ?></label>
                                <select name="filter_author_id" class="form-control" >
                                    <option value="*"></option>
                                    <?php foreach ($all_markets as $user) { ?>
                                    <?php if ($user['author_id'] == $filter_author_id) { ?>
                                    <option value="<?php echo $user['author_id']; ?>" selected="selected"><?php echo $user['author_id'].' '.$user['nickname']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $user['author_id']; ?>"><?php echo $user['author_id'].' '.$user['nickname']; ?></option>
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
                        </div>
                         <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_product ?></label>
                                <select name="filter_product_id" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($all_products as $item) { ?>
                                    <option value="<?php echo $item['product_id'] ?>" <?php echo $item['product_id']==$filter_product_id ? 'selected' : '' ?>><?php echo $item['code'] ?> <?php echo $item['name'] ?></option>
                                    <?php } ?>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_entry?></label>
                                <input type="text" name="filter_entry" value="<?php echo $filter_entry; ?>" class="form-control"/>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="" class="control-label"><?php echo $column_contribute_sn ?></label>
                                <input type="text" name="filter_contribute_sn" value="<?php echo $filter_contribute_sn;?>" class="form-control">
                            </div>
                            <button type="button" onclick="return filter();" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
                <form action="<?php echo $delete?>" method="post" id="form-post">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <td width="1" class="text-center">
                                <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
                            </td>
                            <td class="text-center">
                                <?php if ($sort == 'p.contribute_sn') { ?>
                                <a href="<?php echo $sort_contribute_sn; ?>" class="<?php echo strtolower($order); ?>" ><?php echo $column_contribute_sn; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_contribute_sn; ?>"><?php echo $column_contribute_sn; ?></a>
                                <?php } ?>
                            </td>              
                            <td class="text-center"><?php if ($sort == 'p.author_id') { ?>
                                <a href="<?php echo $sort_author; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_author; ?>"><?php echo $column_author; ?></a>
                                <?php } ?>
                            </td>
                            <td class="text-left">
                                <?php if ($sort == 'p.product_id') { ?>
                                <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                <?php } ?>
                            </td>
                            <td class="text-left"><?php if ($sort == 'p.entry_sn') { ?>
                                <a href="<?php echo $sort_entry_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_entry; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_entry_sn; ?>"><?php echo $column_entry; ?></a>
                                <?php } ?>
                            </td>
                            <td class="text-center"><?php if ($sort == 'p.status') { ?>
                                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                <?php } ?>
                            </td>                            
                            <td class="text-center"><?php if ($sort == 'p.user_id') { ?>
                                <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_auditor; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_user; ?>"><?php echo $column_auditor; ?></a>
                                <?php } ?>
                            </td>
                            <td class="text-center"><?php if ($sort == 'p.artist_id') { ?>
                                <a href="<?php echo $sort_artist; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_artist; ?></a>
                                <?php } else { ?>
                                <a href="<?php echo $sort_artist; ?>"><?php echo $column_artist; ?></a>
                                <?php } ?>
                            </td>              

                            <td class="text-center"><?php if ($sort == 'p.date_modified') { ?>
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
                        <tr >
                            <td class="text-center">
                                <?php echo $item['contribute_id']?>
                                <?php if ($item['selected']) { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>" checked="checked" />
                                <?php } else { ?>
                                    <input type="checkbox" name="selected[]" value="<?php echo $item['contribute_id']; ?>"  />
                                <?php } ?>
                            </td>            
                            <td class="text-center"><?php echo $item['contribute_sn']; ?></td>
                            <td class="text-center"><?php echo $item['author']; ?></td>
                            <td class="text-left"><?php echo $item['product']; ?></td>              
                            <td class="text-left"><?php echo $item['entry_sn'].' '.$item['entry_name']; ?></td>
                            <td class="text-center"><?php echo $item['status_text']; ?></td>
                            <td class="text-center"><?php echo $item['auditor']; ?></td>
                            <td class="text-center"><?php echo $item['artist']; ?></td>
                            <td class="text-center"><?php echo $item['date_modified']; ?></td>
                            <td class="text-center"><?php foreach ($item['action'] as $action) { ?>
                                <a class="btn btn-primary" href="<?php echo $action['href']; ?>" data-toggle="tooltip" title="<?php echo $action['text']; ?>"><i class="fa <?php echo $item['lock'] ? 'fa-lock' : 'fa-eye' ?>"></i></a>
                                  <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr><td class="text-center" colspan="11"><?php echo $text_no_results; ?></td></tr>
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

function filter() {
    url = 'index.php?route=fbaccount/photo&token=<?php echo $token; ?>';
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
$('.date').datetimepicker({pickTime:false});
//-->
</script>

<?php if($artist_group){ ?>
<div id="artist-dialog" style="display:none;">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tabex-images" data-toggle="tab">Export Pending Images</a></li>
        <li><a href="#tabim-images" data-toggle="tab">Import Finished Images</a></li>
    </ul>
    <div class="tab-content" >
        <div id="tabex-images" class="tab-pane active">
            <div class="do-result"></div>
            <form method="post" enctype="multipart/form-data" class="form-horizontal">
                <input name="mode" value="export" type="hidden"/>
                <div class="form-group">
                    <label class="control-label col-sm-3">Artist:</label>
                    <div class="col-sm-9">
                        <select name="filter_artist_id" class="form-control">
                            <option value="*"></option>
                            <?php foreach ($all_artists as $artist) { ?>
                            <option value="<?php echo $artist['user_id']; ?>"><?php echo $artist['nickname']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-sm-3">Status:</label>
                    <div class="col-sm-9">
                        <?php foreach ($post_statuses as $item) { ?>
                        <?php if(in_array($item['status_id'], $artist_status)){  ?> 
                        <div style="display: inline-block;width: 180px;">
                            <input type="checkbox" name="filter_statuses[]" value="<?php echo $item['status_id'] ?>" >
                            <?php echo $item['name']; ?>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Post Staus:</label>
                    <div class="col-sm-9">
                        <select name="filter_post_status" class="form-control">
                            <option value="*"></option>
                            <?php foreach ($post_publishes as $item) { ?>
                            <?php if(in_array($item['publish_id'], $this->config->get('photo_artist_publish'))) { ?>
                            <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">DateStart:</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_date_start" class="date form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">DateEnd:</label>
                    <div class="col-sm-9">
                        <input type="text" name="filter_date_end" class="date form-control" value="<?php echo date('Y-m-d')?>">
                    </div>
                </div>
            </form>
        </div>
        <div id="tabim-images" class="tab-pane">
            <div class="do-result"></div>
            <form method="post" enctype="multipart/form-data" >
                <input name="mode" value="import" type="hidden"/>
                <dl> 
                    <dt>Zip File:</dt><dd><input name="filename" type="file"></dd>   
                    <dt>Note:</dt><dd><input type="text" name="note" size="60"></dd>
                </dl>   
            </form>
        </div>
    </div>
</div>    
<script type="text/javascript"><!-- 
$('#btn-artist').bind('click',function(){
    $('#artist-dialog .do-result').empty();
    $('#artist-dialog').dialog({
        title:'Contribute Images',
        width: 680,
        modal:true,
        buttons:{
            'Run':function(){
                $('#artist-dialog div.tab-on form').ajaxSubmit({
                    url:'index.php?route=fbaccount/photo/artist&token=<?php echo $token;?>',
                    type:'Post',
                    dataType:'json',
                    beforeSubmit:function(){
                        $('#artist-dialog div.tab-on .do-result').html('<img src="<?php echo TPL_IMG?>loading.gif" class="loading">');
                        $('.ui-dialog-buttonset button').addClass('ui-state-disabled').attr('disabled','disabled');
                    },
                    success:function(data){
                        $('.alert').remove();
                        if(data.status == 0){
                            $('#artist-dialog div.tab-on.do-result').html('<div class="alert warning">'+data.msg+'</div>');
                        }else{
                            $('#artist-dialog div.tab-on .do-result').html('<div class="alert success">'+data.msg+'</div>');
                        }
                        $('.ui-dialog-buttonset button:last').removeAttr('disabled').removeClass('ui-state-disabled');
                    }
                });
            }
        }
    });
});

//-->
</script>
<?php }?>

<?php echo $footer; ?>