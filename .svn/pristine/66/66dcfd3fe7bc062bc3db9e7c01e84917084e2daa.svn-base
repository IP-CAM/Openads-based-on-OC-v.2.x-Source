<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right hidden">
                <button type="button" id="btn-new" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></button>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                <div class="pull-right">
                    <a class="btn btn-info btn-link" onclick="$('#filter-columns').slideToggle();">
                        <?php echo $text_filter_toggle;?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="well" id="filter-columns" style="display: none;">
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                                <select name="filter_product" id="input-product" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($products as $item) { ?>
                                    <?php if ($item['product_id'] == $filter_product) { ?>
                                    <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo  $item['code'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-in-charge"><?php echo $entry_in_charge; ?></label>
                                <select name="filter_in_charge" id="input-in-charge" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($users as $item) { ?>
                                    <?php if ($item['user_id'] == $filter_in_charge) { ?>
                                    <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-2">

                            <div class="form-group">
                                <label class="control-label" for="input-website-sn"><?php echo $entry_website_sn; ?></label>
                                <input type="text" name="filter_website_sn" value="<?php echo $filter_website_sn; ?>" placeholder="<?php echo $entry_website_sn; ?>" id="input-website-sn" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                <input name="filter_customer_id" type="hidden" value="<?php echo $filter_customer_id?>">
                            </div>

                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-modified-start"><?php echo $entry_date_modified; ?></label>
                                <div class="input-group">
                                    <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" data-date-format="YYYY-MM-DD"  class="form-control date" />
                                    <div class="input-group-addon"><i class="fa fa-arrows-h"></i> </div>
                                    <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end; ?>" placeholder="<?php echo $entry_modified_end; ?>" data-date-format="YYYY-MM-DD" class="form-control date" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-domain"><?php echo $entry_domain; ?></label>
                                <input type="text" name="filter_domain" value="<?php echo $filter_domain; ?>" placeholder="<?php echo $entry_domain; ?>" id="input-domain" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-1">

                            <br>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="form-website">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>

                                    <td class="text-center"><?php if ($sort == 'w.date_modified') { ?>
                                        <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'w.website_sn') { ?>
                                        <a href="<?php echo $sort_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_sn; ?>"><?php echo $column_sn; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'w.product_id') { ?>
                                        <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'w.domain') { ?>
                                        <a href="<?php echo $sort_domain; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_domain; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_domain; ?>"><?php echo $column_domain; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'customer') { ?>
                                        <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'w.in_charge') { ?>
                                        <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'w.ads') { ?>
                                        <a href="<?php echo $sort_ads; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ads; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_ads; ?>"><?php echo $column_ads; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'w.status') { ?>
                                        <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($websites) { ?>
                                <?php foreach ($websites as $item) { ?>
                                <tr >
                                    <td class="text-center">
                                    <?php echo $item['website_id'] ?><br>
                                    <?php if (in_array($item['website_id'], $selected)) { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['website_id']; ?>" checked="checked" />
                                      <?php } else { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['website_id']; ?>" />
                                      <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                    <td class="text-center"><?php echo $item['website_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['product']; ?></td>
                                    <td class="text-center" style="width:28%;word-break:break-all;">
                                        <a href="<?php echo $item['domain'] ?>" target="_blank" title="<?php echo $item['domain'] ?>">
                                            <?php echo lively_truncate($item['domain'],34); ?>
                                        </a>
                                    </td>
                                    <td class="text-center"> <?php echo $item['customer'] ?></td>
                                    <td class="text-center"><?php echo $item['charger']; ?></td>
                                    <td class="text-center">
                                        <?php if($item['ads']){ ?>
                                        <a href="<?php echo $item['ad_list']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>">
                                            <span class="badge"><?php echo $item['ads'] ?></span>
                                        </a>
                                        <?php }else{ ?>
                                        <span class="badge">0</span>
                                        <?php }?>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <?php if($item['status']){ ?>
                                            <button type="button" class="btn btn-success" data-toggle="tooltip" title="<?php echo $text_disabled_alt; ?>" onclick="toggleValue(this,'status')">
                                                <i class="fa fa-pause"></i>
                                            </button>
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-warning" data-toggle="tooltip" title="<?php echo $text_enabled_alt; ?>" onclick="toggleValue(this,'status')">
                                                <i class="fa fa-play"></i>
                                            </button>
                                            <?php } ?>
                                            <?php if($item['show']){ ?>
                                            <button type="button" class="btn btn-info" data-toggle="tooltip" title="<?php echo $text_hide_alt; ?>" onclick="toggleValue(this,'show')">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            <?php } else { ?>
                                            <button type="button" class="btn btn-default" data-toggle="tooltip" title="<?php echo $text_show_alt; ?>" onclick="toggleValue(this,'show')">
                                                <i class="fa fa-eye-slash"></i>
                                            </button>
                                            <?php } ?>
                                            <button type="button" class="btn btn-default _edit" data-entry="<?php echo $item['website_id']; ?>" data-toggle="tooltip" title="<?php echo $text_edit_alt; ?>">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-default _history" data-href="<?php echo $item['history']; ?>" data-toggle="tooltip" title="<?php echo $text_history_alt; ?>">
                                                <i class="fa fa-history"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
                                </tr>
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

<div id="edit-dialog" style="display:none">
    <div class="col-sm-12">
        <div class="do-result"></div>
        <form method="post" class="form-horizontal" id="website-form" action="<?php echo $action?>">
            <input type="hidden" name="website_id">
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_product ?></label>
                <div class="col-sm-10">
                    <select name="product_id"  class="form-control">
                        <?php foreach ($products as $item): ?>
                        <option value="<?php echo $item['product_id'] ?>"><?php echo $item['code'].' '.$item['name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_domain ?></label>
                <div class="col-sm-10">
                    <input name="domain" type="text" class="form-control" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo $entry_note ?></label>
                <div class="col-sm-10">
                    <textarea name="note" class="form-control"></textarea>
                </div>
            </div>

        </form>
    </div>
</div>
<div id="ws-history"></div>
<script type="text/javascript"><!-- 
$(function() {
    $('#website-form')
    .formValidation({
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {

            product_id: {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_product ?>'
                    }
                }
            },
            domain: {
                validators: {
                    notEmpty: {
                        message: '<?php echo $error_domain ?>'
                    },
                    uri: {
                        message: '<?php echo $error_domain_invalid ?>'
                    }
                }
            },
        }
    }).on('success.form.fv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        $.post(
            $form.attr('action'),
            $form.serialize(),
            function(json) {
                if(json.status==0){
                    for(var k in json['error']){

                    }
                }else{
                    location.reload();
                }
            },
        'json');
    });
});
//--></script>
<script type="text/javascript"><!--
    $('._edit').bind('click',function(){
        $.get(
            'index.php?route=service/website/detail&token=<?php echo $token ?>',
            {website_id:$(this).attr('data-entry')},
            function (json) {
                $('#website-form input[name="website_id"]').val(json.website_id);
                $('#website-form select[name="product_id"]').val(json.product_id);
                $('#website-form input[name="domain"]').val(json.domain);
                $('#website-form textarea[name="note"]').val(json.note);
                $('#edit-dialog').dialog({
                    autoOpen:true,
                    width: 600,
                    resizable:false,
                    buttons:{
                        '<?php echo $button_save ?>':function(){
                            $('#website-form').submit();
                        }
                    }

                }).dialog('option','title','<?php echo $text_edit;?> : '+json.website_sn);
            },
            'json'
        );

    });


    function toggleValue(el,type){
        var website = $(el).parentsUntil('tr').last().siblings().find('input[name^="selected"]').val();
        $.ajax({
            url:'index.php?route=service/website/save&token=<?php echo $token ?>',
            data:{website_id:website,field:type,value:'toggle'},
            type:'post',
            dataType:'json',
            success:function(json){
                if(json.status == 0 || json.status == -1){
                    alert(json.msg);
                }
                if(json.status !=0 ){
                    location.reload();
                }
            }
        });
    }
    $('._history').click(function(e){
        $('#ws-history').empty().load($(this).attr('data-href'))
        .dialog({
            title:'<?php echo $text_title_history ?>',
            autoOpen:true,
            width: 600,
            resizable:false,
            <?php if($customers && $products){ ?>
            buttons:{
                '<?php echo $button_close ?>':function(){
                    $(this).dialog('close');
                }
            }
            <?php }?>
        });
    })

    $('#button-filter').on('click', function() {
        url = 'index.php?route=service/website&token=<?php echo $token; ?>';
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

    $('#input-customer').autocomplete({
        'delay':500,
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['username']+' '+item['name'],
                            value: item['customer_id']
                        }
                    }));
                }
            });
        },
        'select': function(event,ui) {
            $('#input-customer').val(ui.item['label']);
            $('input[name="filter_customer_id"]').val(ui.item['value']);
            return false;
        },
        focus: function(event, ui) {
            return false;
        }
    });

    $('input[name^=\'selected\']:first').trigger('change');


    $('.date').datetimepicker({ pickTime: false});
//-->
</script>

<?php echo $footer; ?>