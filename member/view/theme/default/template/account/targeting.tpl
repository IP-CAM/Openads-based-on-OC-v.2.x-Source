<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
    </ul>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger">
        <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    </div>
    <?php } ?>
    <div class="row">
        <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
        <div id="content" class="col-sm-9">
            <div class="do-result"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
                </div>            
                <div class="panel-body">
                    <div class="well" id="filter-column" <?php //echo $filter_column ? '' : 'style="display:none ;"'?>>
                        <div class="row filter">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                                    <select name="filter_publish" id="input-product" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($products as $item) { ?>
                                        <?php if ($item['product_id'] == $filter_product) { ?>
                                        <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['code'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['product_id']; ?>">
                                        <?php echo $item['code'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-location"><?php echo $entry_location; ?></label>
                                    <select name="filter_location" id="input-location" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($countries as $item) { ?>
                                        <?php if ($item['targeting_id'] == $filter_location) { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>" selected="selected"><?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>">
                                        <?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-language"><?php echo $entry_language; ?></label>
                                    <select name="filter_language" id="input-language" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($languages as $item) { ?>
                                        <?php if ($item['targeting_id'] == $filter_language) { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>" selected="selected"><?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['targeting_id']; ?>">
                                        <?php echo $item['value'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>       
                                <div class="form-group">
                                    <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                                    <select name="filter_publish" id="input-publish" class="form-control">
                                        <option value="*"></option>
                                        <?php foreach ($post_publishes as $item) { ?>
                                        <?php if ($item['publish_id'] == $filter_publish) { ?>
                                        <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $item['publish_id']; ?>">
                                        <?php echo $item['publish_id'].' '.$item['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>                     
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-interest"><?php echo $entry_interest; ?></label>
                                    <input type="text" name="filter_interest" value="<?php echo $filter_interest; ?>" placeholder="<?php echo $entry_interest; ?>" id="input-interest" class="form-control" />
                                </div>    
                                <div class="form-group">
                                    <label class="control-label" for="input-target-url"><?php echo $entry_target_url; ?></label>
                                    <input type="text" name="filter_target_url" value="<?php echo $filter_target_url; ?>" placeholder="<?php echo $entry_target_url; ?>" id="input-target-url" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label class="control-label" for="input-targeting-sn"><?php echo $entry_targeting_sn; ?></label>
                                    <input type="text" name="filter_targeting_sn" value="<?php echo $filter_targeting_sn; ?>" placeholder="<?php echo $entry_targeting_sn; ?>" id="input-targeting-sn" class="form-control" />
                                </div>   
                                <div class="form-group">                     
                                    <a class="btn btn-primary" id="btn-filter">
                                        <i class="fa fa-search"></i> <?php echo $button_filter; ?>
                                    </a>
                                    <a class="btn btn-primary" id="btn-export" >
                                        <span class="glyphicon glyphicon-export"></span> <?php echo $button_export; ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data" id="form-report">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <td class="text-center"> <?php echo $column_id; ?></td>
                                        <td class="text-center"><?php if ($sort == 'att.targeting_sn') { ?>
                                            <a href="<?php echo $sort_targeting_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting_sn; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_targeting_sn; ?>"><?php echo $column_targeting_sn; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'a.product_id') { ?>
                                            <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.location') { ?>
                                            <a href="<?php echo $sort_location; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_location; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_location; ?>"><?php echo $column_location; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.gender') { ?>
                                            <a href="<?php echo $sort_gender; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_gender; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_gender; ?>"><?php echo $column_gender; ?></a>
                                            <?php } ?>
                                        </td>       
                                        <td class="text-center"><?php if ($sort == 'at.age_min') { ?>
                                            <a href="<?php echo $sort_age; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_age; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_age; ?>"><?php echo $column_age; ?></a>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center"><?php if ($sort == 'at.language') { ?>
                                            <a href="<?php echo $sort_language; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_language; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_language; ?>"><?php echo $column_language; ?></a>
                                            <?php } ?>
                                        </td>                                    
                                        <td class="text-center"><?php if ($sort == 'at.interest') { ?>
                                            <a href="<?php echo $sort_interest; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_interest; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_interest; ?>"><?php echo $column_interest; ?></a>
                                            <?php } ?>
                                        </td>        
                                        <td class="text-center"><?php if ($sort == 'at.audience') { ?>
                                            <a href="<?php echo $sort_audience; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_audience; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_audience; ?>"><?php echo $column_audience; ?></a>
                                            <?php } ?>
                                        </td> 
                                        <td class="text-center"><?php if ($sort == 'at.publish') { ?>
                                            <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                            <?php } ?>
                                        </td>                                     

                                        <td class="text-left" style="width: 18%;"><?php if ($sort == 'at.target_url') { ?>
                                            <a href="<?php echo $sort_target_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_target_url; ?></a>
                                            <?php } else { ?>
                                            <a href="<?php echo $sort_target_url; ?>"><?php echo $column_target_url; ?></a>
                                            <?php } ?>
                                        </td>
                                  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records) { ?>
                                    <?php foreach ($records as $item) { ?>
                                    <tr>
                                        <td class="text-center"><?php echo $item['id']; ?></td>
                                        <td class="text-center"><?php echo $item['targeting_sn']; ?></td>
                                        <td class="text-center"><?php echo $item['product']; ?></td>
                                        <td class="text-center"><?php echo $item['location']; ?></td>
                                        <td class="text-center"><?php echo $item['gender']; ?></td>
                                        <td class="text-center"><?php echo $item['age']; ?></td>
                                        <td class="text-center"><?php echo $item['language']; ?></td>
                                        <td class="text-center"><?php echo $item['interest']; ?></td>
                                        <td class="text-center"><?php echo $item['audience']; ?></td>
                                        <td class="text-center"><?php echo $item['publish']; ?></td>
                                        <td class="text-left" style="width: 18%;">
                                            <a href="<?php echo $item['target_url'] ?>" target="_blank"><?php echo $item['target_url']; ?></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php } else { ?>
                                    <tr>
                                        <td class="text-center" colspan="11"><?php echo $text_no_results; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
$('#btn-export').bind('click',function(){
    $.ajax({
        'url':'index.php?route=account/targeting/export',
        'type':'Post',
        'data':{'filter':'<?php echo json_encode($filter);?>'},
        'dataType':'json',
        'beforeSubmit':function(){
            $('.do-result').html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG ?>loading.gif"> <?php echo $text_waiting;?> </div>');
        },        
        'success':function(json){
            $('.alert').remove();
            if(json.status ==1){
                $('.do-result').html('<div class="alert alert-success">'+json.msg+'</div>');
            }else{
                $('.do-result').html('<div class="alert alert-warning">'+json.msg+'</div>');
            }
        }
    });
});

$('#btn-filter').on('click', function() {
    url = 'index.php?route=account/targeting';
     var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
        if($(this).val() && $(this).val()!='*'){
            paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
        }
    });
    if(paramArr.length>0){
        url+="&"+paramArr.join("&");
    }
    location = url;
});

//-->
</script> 
<?php echo $footer; ?>