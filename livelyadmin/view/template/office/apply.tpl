<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">      
            <div class="pull-right">
                <a href="<?php echo $this_week; ?>" class="btn btn-primary"><i class="fa fa-calendar-o"></i> <?php echo $text_this_week; ?></a>
                <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i> <?php echo $button_cancel; ?></a>
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
            </div>
            <div class="panel-body">
                <form method="post" id="form-order">
                    <table class="table table-bordered table-apply">
                        <thead>
                            <tr>
                                <td class="text-center active" rowspan="2" width="120px">
                                    <?php if (is_array($prev)): ?>
                                    <p>
                                        <a href="<?php echo $prev['href'] ?>">
                                            <button type="button" class="btn btn-warning btn-xs" title="<?php echo $prev['text'] ?>" data-toggle="tooltip">
                                                <?php echo $prev['week'] ?>                
                                            </button>
                                        </a>
                                    </p>
                                    <?php endif ?>

                                    <?php if (is_array($current)): ?>
                                        <p>
                                            <button type="button" class="btn <?php echo $edit ? 'btn-primary' : 'btn-default' ?> btn-xs" title="<?php echo $current['text'] ?>" data-toggle="tooltip">
                                                <?php echo $current['week'] ?>                
                                            </button>
                                        </p>
                                    <?php endif ?>
                                    
                                    <?php if (is_array($next)): ?>
                                    <p>
                                        <a href="<?php echo $next['href'] ?>">
                                        <button type="button" class="btn btn-info btn-xs" title="<?php echo $next['text'] ?>" data-toggle="tooltip">
                                            <?php echo $next['week'] ?>                
                                        </button>
                                        </a>
                                    </p>
                                    <?php endif ?>                                    
                                </td>
                                <?php foreach ($weekday as $day): ?>
                                <td class="text-center active">
                                    <?php echo $day ?>
                                </td>    
                                <?php endforeach ?>                                    
                            </tr>
                            <tr>
                                <?php foreach ($weekday as $day): ?>
                                <td class="text-center active">
                                    <?php echo getWeekDayText(date('w',strtotime($day))); ?>
                                </td>    
                                <?php endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($applies) { ?>
                            <?php foreach ($applies as $item) { ?>
                            <tr>
                                <td class="text-center active">
                                    <?php echo $item['time_name']; ?><br>
                                    <?php echo $item['price'] ?>
                                </td>
                                <?php foreach ($item['apply'] as $key => $apply): ?>
                                <td class="text-center <?php echo $edit ? 'edit-field' : '' ?>">
                                    <div class="applicant">
                                        <?php if($apply['users']){ ?>
                                        <?php foreach ($apply['users'] as $user): ?>
                                        <span class="label label-success" data-apply="<?php echo $apply['apply_id'] ?>" data-val="<?php echo $user['office_id'] ?>" title="<?php echo $user['handphone'] ?>" data-toggle="tooltip">
                                            <?php if($edit){ ?>
                                            <i class="fa fa-remove remove"></i>
                                            <?php }?>
                                            <?php echo $user['nickname'] ?>
                                        </span>    
                                        <?php endforeach ?>
                                        <?php }?>
                                    </div> 
                                    <?php if($edit){ ?>                                       
                                    <div class="edit-btns" style="display:none;" data-key="<?php echo $key ?>">
                                        <a class="btn btn-xs btn-default edit-btn" data-apply="<?php echo $apply['apply_id'] ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="applicants" style="display:none;">
                                        <div class="btn-group dropup" >
                                            <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                设置人员 
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu offices"></ul>
                                        </div>
                                    </div>
                                    <?php }?>
                                </td>    
                                <?php endforeach ?>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"><!--
    $('.edit-field').bind('mouseover',function(){
        $(this).find('.edit-btns').show();
    }).bind('mouseout',function(){
        $(this).find('.edit-btns').hide();        
    }).bind('mouseleave',function(){
        $(this).find('.applicants').hide();
    });
    $('.edit-field').delegate('.applicant span','mouseover',function(){
        $(this).find('.remove').show();
    }).bind('mouseout',function(){
        $(this).find('.remove').hide();        
    });
    $('.edit-btn').bind('click',function(){
        $('.applicants').hide().find('.offices').empty();
        var $that = $(this);
        var obj = $(this).parent().next('.applicants');
        obj.toggle();
        var apply_id = $(this).attr('data-apply');
        var apply_sn = $(this).parent().attr('data-key');
        $.ajax({
            url:'index.php?route=office/apply/getUsers&token=<?php echo $token ?>',
            data:{apply_sn:apply_sn,apply_id:apply_id},
            dataType:'json',
            success:function(json){
                var data = json.data;
                var html = '';
                for (var i = 0 ;i < data.length ;  i++) {
                    html += '<li title="'+data[i]['handphone']+'" data-val="'+data[i]['office_id']+'">';
                    html += '<a>'+data[i]['nickname']+'</a>';
                    html += '</li>';
                }; 
                $that.attr('data-apply',json.apply);                
                obj.find('.offices').attr('data-apply',json.apply).append(html);
            }
        })
    });
    $('.edit-field').delegate('.remove','click',function(){
        var $that = $(this);
        $.ajax({
            url:'index.php?route=office/apply/remove&token=<?php echo $token ?>',
            data:{apply_id:$(this).parent().attr('data-apply'),office_id:$(this).parent().attr('data-val')},
            dataType:'json',
            success:function(json){
                if(json.status==1){
                    $that.parent().remove();
                }else{
                    alert(json.msg);
                }
            }
        });        
    });
    $('.offices').delegate('li','click',function(){
        var $that = $(this);
        var apply_id = $(this).parent().attr('data-apply');
        var office_id = $(this).attr('data-val');
        $.ajax({
            url:'index.php?route=office/apply/insert&token=<?php echo $token ?>',
            data:{apply_id:apply_id,office_id:office_id},
            type:'get',
            dataType:'json',
            success:function(json){
                if(json.status==1){
                    var html = '<span class="label label-success" title="'+$that.attr('title')+'" data-apply="'+apply_id+'" data-val="'+office_id+'" data-toggle="tooltip">';
                    html += '<i class="fa fa-remove remove"></i>';
                    html += $that.children('a').text();
                    html += '</span>';
                    $that.parentsUntil('.edit-field').siblings('.applicant').append(html);
                    $that.remove();
                }else{
                    alert(json.msg);
                }
            }
        });
        
    })
//--></script>
<style type="text/css">
.edit-field{
    position: relative;
}
.edit-btns{
    position: absolute;
    right:3px;
    top:3px;
}
.applicant span{
    margin:0 auto;
    position: relative;
    width: 80px;
    display: block;
    margin-bottom: 2px;
}
.applicant span .remove{
    position: absolute;
    left:-6px;
    top: -3px;
    background: #CC6666;
    border-radius: 12px;
    width: 14px;
    height: 14px;
    display: none;
    cursor: pointer;
}
.applicants{
    border-top: 1px dashed #cccccc;
    margin: 3px;
    padding: 3px;
}
ul.offices{overflow-y: scroll;max-height: 220px;}
.table-apply span.label{

}
</style>
<?php echo $footer; ?>