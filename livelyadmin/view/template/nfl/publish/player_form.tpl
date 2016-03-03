<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
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
        <?php if($locked){ ?>
        <div class="alert alert-warning">
            <i class="fa fa-lock"></i> <?php echo $text_lock;?>
        </div>
        <?php } ?>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> 
                    <?php echo $contribute_sn; ?>
                </h3>
                <div class="pull-right">
                    <a href="<?php echo $cancel ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" titile="<?php echo $button_cancel; ?>">
                        <i class="fa fa-reply"></i>
                        <?php echo $button_cancel; ?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                    <li><a href="#tab-history" data-toggle="tab">History</a></li>
                </ul>
                
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-general">
                        <div class="col-sm-4">
                            <div class="panel panel-info">
                                <div class="panel-heading"><?php echo $tab_info ?></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="" class="control-label">SN</label>
                                        <span class="form-control"><?php echo $contribute_sn;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class=" control-label">Author</label>
                                        <span class="form-control"><?php echo $author;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Submite Date</label>
                                            <span class="form-control"><?php echo $submited_date;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Submite Times</label>
                                            <span class="form-control"><?php echo $submited_times;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Last Operator</label>
                                            <span class="form-control"><?php echo $user;?></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <?php foreach ($post_statuses as $item) { ?>
                                        <?php if ($item['status_id']==$status) { ?>
                                        <span class="form-control" ><?php echo $item['name']; ?></span>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>   
                                    <?php if(is_array($notes)){ rsort($notes);?>   
                                    <div class="form-group">
                                        <label class="control-label">Note</label>
                                        <div style="overflow-y:auto;max-height: 120px; ">
                                            <?php foreach ($notes as $item): ?>
                                            <blockquote style="margin-bottom: 2px;padding: 5px;">
                                                <p><?php echo $item['msg'] ?></p>
                                                <footer><?php echo $item['operator'] ?> : <?php echo (isset($item['time']) ? date("m-d H:i:s",$item['time']) : '') ?></footer>
                                            </blockquote>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                    <?php } ?> 
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                        <form method="post" id="post-save-form">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <?php echo $tab_post ?>
                                    <div class="pull-right">
                                        <?php if($relax || $modify){?>
                                        <a id="btn-relax" class="btn btn-warning btn-sm" data-toggle ="tooltip" title="<?php echo $button_unlock ?>">
                                            <i class="fa fa-unlock"></i>
                                            <?php echo $button_unlock ?>
                                        </a>
                                        <?php }else if($modify){?>                
                                        <a id="btn-save" class="btn btn-success btn-sm" data-toggle="tooltip" titile="<?php echo $button_save; ?>">
                                            <i class="fa fa-save"></i>
                                            <?php echo $button_save; ?>
                                        </a>
                                        <?php }?>
                                        <input type="hidden" name="contribute_id" value="<?php echo $contribute_id ?>">
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="" class="control-label">Team</label> 
                                        <?php if($modify) {?>
                                        <div class="input-group">
                                            <span class="form-control"><b><?php echo $team; ?></b></span>
                                            <span class="modified input-group-addon btn">
                                                <i class="fa fa-pencil"></i>
                                                <input type="checkbox" name="team_modified" value="1"/>
                                            </span>
                                        </div>
                                        <input id="_team" type="text" class="form-control hidden -toggle">
                                        <input name="team_id" type="hidden"/>
                                        <?php }else{?>           
                                        <span class="form-control"><b><?php echo $team; ?></b></span>
                                        <?php }?>
                                    </div>
                                    <?php if (!empty($player)): ?>
                                    <div class="form-group">
                                        <label class="control-label">Player</label>
                                        <span class="form-control"><b><?php echo $player ?></b></span>
                                    </div>    
                                    <?php endif ?>
                                    <div class="form-group">
                                        <label class="control-label">Expiration Date</label>
                                        <?php if($modify){ ?>
                                        <div class="input-group">
                                            <input type="text" name="expired" value="<?php echo $expired;?>" class="form-control cdate" disabled data-date-format="YYYY-MM-DD"/>
                                            <span class="modified input-group-addon btn">
                                                <i class="fa fa-pencil"></i>
                                                <input type="checkbox" name="expired_modified" value="1"/>
                                            </span>
                                        </div>
                                        <?php }else{ ?>
                                        <span class="form-control"><?php echo $expired;?></span>
                                        <?php }?>
                                    </div>             
                                    <div class="form-group">
                                        <label class="control-label">Post Text</label>
                                        <?php if ( $modify) { ?>
                                        <div class="input-group">
                                            <textarea name="content" rows="5" class="form-control" disabled><?php echo $content;?></textarea>               
                                            <span class="modified input-group-addon btn">
                                                <i class="fa fa-pencil"></i>
                                                <input type="checkbox" name="content_modified" value="1"/>
                                            </span>
                                        </div>  
                                        <?php }else{ ?>
                                        <pre style="height: 100px" class="form-control" ><?php echo $content;?></pre>
                                        <?php }?>                                           
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Publish Status</label>
                                        <?php if($modify){ ?>
                                        <select name="publish" class="level-copy form-control">
                                            <?php foreach ($post_publishes as $item) { ?>
                                            <?php if ($item['publish_id']==$publish) { ?>
                                            <option value="<?php echo $item['publish_id']; ?>" selected>
                                            <?php echo $item['name']; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $item['publish_id']; ?>" >
                                            <?php echo $item['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <?php  if(!$copied){ ?>
                                        <a class="copy-btn hide"><?php echo $entry_copy; ?></a>
                                        <?php } ?>
                                        <?php }else{?>
                                        <span class="form-control">
                                            <?php foreach ($post_publishes as $item) { ?>
                                            <?php if ($item['publish_id']==$publish) { ?>
                                            <?php echo $item['name']?>
                                            <?php }?>
                                            <?php }?>
                                        </span>
                                        <?php } ?>
                                    </div>
                                    <?php if(!$modify){ ?>
                                    <div class="form-group">
                                        <label class="control-label">Note</label>
                                        <textarea name="note" class="form-control"></textarea>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </form> 
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-history"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#tab-history').load('index.php?route=nfl/publish_player/history&token=<?php echo $token;?>&contribute_id=<?php echo $contribute_id;?>');

    $('#tab-history ').delegate('.pagination a','click', function() {
        $('#tab-history').load(this.href);  
        return false;
    });
    <?php if($relax){ ?>
    $('#btn-relax').bind('clcik', function(){
        if(confirm('<?php echo $text_confirm_relax ?>')){
            var res = resetTempLocker('index.php?route=nfl/publish_player/ajax_data&set=1&token=<?php echo $token;?>',<?php echo (int)$contribute_id;?>,<?php echo (int)$locker;?>);
            
            location.reload();
        }
    });
    <?php }?>
    <?php if($modify){ ?>
    $('#btn-save').bind('click',function(){
        if($('input[name="content_modified"]').is(':checked')){
            var _content = $('textarea[name="content"]').val();
            if( _content ==''){
                $('.do-result').html('<div class="alert alert-warning"><?php echo $error_text?></div>');
                return false;
            }
            var _msg = check_contribute(_content);
            if(_msg!==true){
                $('.do-result').html('<div class="alert alert-warning">'+_msg+'</div>');
                return false;
            }
        }
        $.ajax({
            url:'index.php?route=nfl/publish_player/save&token=<?php echo $token;?>',
            type:'POST',
            data:$('#post-save-form :input'),
            dataType:'json',
            success:function(data){
                $('.alert').remove();
                if(data.status==1){                         
                    $('.do-result').html('<div class="alert alert-success">'+data.msg+'</div>');
                    location.reload();                  
                }else{
                    $('.do-result').html('<div class="alert alert-warning">'+data.msg+'</div>');
                }
            }                   
        });
    });

    $('.modified').bind('click',function(){
        if($(this).hasClass('focusin')){
            $(this).children('input[type="checkbox"]').removeProp('checked');
            $(this).parent('.input-group').find('input[type="text"],textarea').prop('disabled','disabled');
            $(this).parent('.input-group').next('.-toggle').addClass('hidden');
            $(this).removeClass('focusin');
        }else{
            $(this).children('input[type="checkbox"]').prop('checked',true);
            $(this).parent('.input-group').find('input[type="text"],textarea').removeProp('disabled').focus();
            $(this).parent('.input-group').next('.-toggle').removeClass('hidden');
            $(this).addClass('focusin');
            $('.cdate').datetimepicker({pickTime:false});
        }        
    });

    <?php  if( !$copied){ ?>
    var level_status = [<?php echo implode(',', $level_statuses); ?>];

    $('.level-copy').bind('change',function(){
        $('.copy-btn').toggleClass('hide',($.inArray(parseInt($(this).val()),level_status)==-1));
    });
    $('.copy-btn').bind('click',function(){
        var that = this;
        if(confirm('Copy to with photo?')){
            $.ajax({
                url:'index.php?route=nfl/publish_player/ajax_data&token=<?php echo $token;?>',
                type:'Post',
                data:{ajax:1,action:'copy',contribute_id:<?php echo $contribute_id;?>},
                dataType:'json',
                beforeSend:function(){
                    $(that).html('<div class="alert alert-warning"><img src="<?php echo TPL_IMG?>loading.gif" class="loading"></div>');
                },
                success:function(data){
                    $('.alert').remove();
                    if(data.status == 0){
                        $(that).html('<div class="alert alert-warning">'+data.msg+'</div>');
                    }else{
                        $(that).html('<div class="alert alert-success">'+data.msg+' <b>New SN: '+data.last+'</b></div>');
                    }
                    $('.loading').remove();
                }
            });                   
        }   
    });
    <?php } ?>

    $('#_team').autocomplete({
        'source': function(request, response) {
            $.ajax({
                url: 'index.php?route=nfl/team/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
        'select': function(item) {
            $(this).val(item.label).siblings('input[name="team_id"]').val(item.value);               
            return false; 
        }
    });
    <?php } ?>
</script> 

<?php echo $footer ?>