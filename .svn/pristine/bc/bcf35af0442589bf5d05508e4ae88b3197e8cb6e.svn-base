<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                    <div class="pull-right">
                        <a class="btn btn-link btn-sm" id="filter-columns" data-toggle="tooltip" title="<?php echo $text_filter_title;?>">
                            <i class="fa fa-filter"></i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="photo-list">
                            <thead>
                            <tr>
                                <td class="text-center"><?php if ($sort == 'ap.date_modified') { ?>
                                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center"><?php if ($sort == 'a.advertise_sn') { ?>
                                    <a href="<?php echo $sort_ad_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_sn; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_ad_sn; ?>"><?php echo $column_ad_sn; ?></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center"><?php if ($sort == 'ap.status') { ?>
                                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                    <?php } ?>
                                </td>

                                <td class="text-center"><?php if ($sort == 'ap.in_charge') { ?>
                                    <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if ($photos) { ?>
                            <?php foreach ($photos as $item) { ?>
                            <tr onclick="load_component(this)" style="cursor: pointer" data-entry="<?php echo $item['photo_id']?>" data-advertise="<?php echo $item['advertise_sn']; ?>">
                                <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                <td class="text-center"><?php echo $item['status_text']; ?></td>
                                <td class="text-center"><?php echo $item['charger']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right"><?php echo $results; ?></div>
                        <div class="col-sm-12 text-left"><?php echo $pagination; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary" >
                <div class="panel-heading" id="panel-header"><?php echo $text_edit ?></div>
                <div class="panel-body">
                    <div id="detail-panel" ></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="filter-block" >
    <div class="filter">
        <div class="form-group">
            <label for="input-advertise-sn"><?php echo $entry_advertise_sn?></label>
            <input type="text" id="input-advertise-sn" class="form-control" name="filter_advertise_sn" value="<?php echo $filter_advertise_sn?>"/>
        </div>
        <div class="form-group">
            <label for="input-in-charge"><?php echo $entry_in_charge?></label>
            <select name="filter_in_charge" id="input-in-charge" class="form-control">
                <option value="*"></option>
                <?php foreach ($managers as $item) { ?>
                <?php if ($item['user_id'] == $filter_in_charge) { ?>
                <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="input-status"><?php echo $entry_status?></label>
            <select name="filter_status" id="input-status" class="form-control">
                <option value="*"></option>
                <?php foreach ($statuses as $item) { ?>
                <?php if ($item['status_id'] == $filter_status) { ?>
                <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $item['status_id']; ?>">
                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="input-date-start"><?php echo $entry_modified_start?></label>
            <div class="input-group date">
                <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" id="input-date-start" data-date-format="YYYY-MM-DD" class="form-control" />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="input-date-end"><?php echo $entry_modified_end?></label>
            <div class="input-group date">
                <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end;?>" placeholder="<?php echo $entry_modified_end; ?>" id="input-date-end" data-date-format="YYYY-MM-DD" class="form-control" />
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                </span>
            </div>
        </div>
        <div class="text-right">
            <a class="btn btn-primary" onclick="filter();"><?php echo $button_filter;?></a>
            <a class="btn btn-default" href="<?php echo $list;?>"><?php echo $button_reset;?></a>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
    $('#photo-list > tbody > tr[data-entry="<?php echo $selected ?>"]').trigger('click');

    function load_component(el){
        $('#photo-list tr.active-line').removeClass('active-line');
        $(el).addClass('active-line');
        $('#panel-header').text('<?php echo $text_edit ?> : '+ $(el).attr('data-advertise'));
        $('#detail-panel').load('index.php?route=service/advertise_photo/detail&token=<?php echo $token?>&photo_id='+$(el).attr('data-entry'));
    }

    function filter(){
        var url = 'index.php?route=service/advertise_photo&token=<?php echo $token; ?>',
        paramArr=[];
        $(".filter input[name],.filter select[name]").each(function(){
            if($(this).val() && $(this).val()!='*'){
                paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
            }
        });
        if(paramArr.length>0){
            url+="&"+paramArr.join("&");
        }
        location = url;
    }

    $(function () {
        $('a.fancy-img').fancybox();

        $('#filter-columns').popover({
            placement: 'bottom',
            html : true,
            title:'<?php echo $text_filter_title;?>',
            content: function() {
                return $('#filter-block').html();
            }
        }).on('shown.bs.popover', function () {
            $('.date').datetimepicker({	pickTime: false});
        });
    });
//--></script>

<?php echo $footer; ?>