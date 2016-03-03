<?php if($list){ ?>
<?php foreach ($priority_info as $item): ?>
<li <?php echo $priority_id == $item['priority_id'] ? '' : 'class="change-item"' ?> data-priority="<?php echo $item['priority_id'] ?>" data-entry="<?php echo $advertise_id ?>">
  <a href="javascript:void(0);" >
  <?php if($priority_id == $item['priority_id']){?>
    <i class="fa fa-check-square-o"></i>
  <?php }else{ ?>
    <i class="fa fa-square-o"></i>
  <?php }?>
    &nbsp;
    <?php echo $item['name'] ?> 
    &nbsp; 
    <?php echo $text_queuing ?> <?php echo $item['quantity'] ?> 
    &nbsp;
    <?php echo $text_money ?> <?php echo $item['operator'].$item['amount'] ?>
  </a>
</li>
<?php endforeach ?>
<?php }else{ ?>
<hr>
<div class="col-sm-offset-1" id="priority-form" >    
    <?php foreach ($priority_info as $item):?>
    <div class="radio">
        <label <?php echo $priority_id == $item['priority_id'] ? 'class="text-danger"' : '' ?> >
            <input type="radio" name="priority_id" value="<?php echo $item['priority_id'] ?>" <?php echo $priority_id == $item['priority_id'] ? 'checked="checked"' : '' ?> data-balance="<?php echo $item['balance'] ?>" data-operator="<?php echo $item['operator'] ?>" data-amount="<?php echo $item['amount'] ?>"> 
            &nbsp;
            <?php echo $item['priority'] ?> 
            &nbsp; 
            <?php echo $text_queuing ?> <?php echo $item['quantity'] ?> 
            &nbsp;
            <?php echo $text_money ?> <b><?php echo $item['operator']?></b><?php echo $item['amount'] ?>
        </label>
    </div>
    <?php endforeach ?>
    <input type="hidden" name="advertise_id" value="<?php echo $advertise_id ?>" />
</div>
<hr>
<div class="col-sm-offset-1 clearfix"> 
    <div class="form-group col-sm-4">   
        <div class="input-group">
            <div class="input-group-addon">+</div>
            <input type="text" id="ad-amount" class="form-control" readonly>
        </div>
    </div>
    <div class="col-sm-5">
        <button type="button" class="btn btn-success" id="change-priority">
            <i class="fa fa-save"></i>
            <?php echo $button_priority ?>
        </button>
    </div>
    <div class="col-sm-2">        
        <button type="button" class="btn btn-primary pull-right" onclick="reloadQueue(<?php echo $advertise_id ?>,<?php echo $priority_id ?>)" data-toggle="tooltip" title="<?php echo $text_update_priority ?>">
            <i class="fa fa-refresh"></i>            
        </button>
    </div>
    
</div>
<div id="level-down" class="text-warning col-sm-offset-1" style="display:none;"><?php echo $text_demotion ?></div>
<script type="text/javascript">
    $('input[name="priority_id"]').change(function(){            
        $.ajax({
            url:'index.php?route=service/advertise/valideteBalance',
            data:{priority_id:$('input[name="priority_id"]:checked').val(),ad:<?php echo $advertise_id ?>},
            type:'post',
            dataType:'json',
            success:function(json){
                if(json.status==0){
                    alert(json.msg);
                    $('input[name="priority_id"]').prop('checked',false);
                    $('label.text-danger input[name="priority_id"]').prop('checked',true);
                }
                $('#ad-amount').val($('input[name="priority_id"]:checked').attr('data-amount'));
                var _operator = $('input[name="priority_id"]:checked').attr('data-operator');
                $('#level-down').toggle(_operator=='-');
                $('#ad-amount').prev('.input-group-addon').html(_operator);
                $('input[name="priority_id"]:checked').parent().parent().parent().find('label.text-danger').removeClass('text-danger');
                $('input[name="priority_id"]:checked').parent('label').addClass('text-danger');
                if(parseFloat($('input[name="priority_id"]:checked').attr('data-balance')).toFixed(2)==0.00){
                    $('#change-priority').attr('disabled','disabled');
                }else{
                    $('#change-priority').removeAttr('disabled');
                }
            }
        });
    });
    $('input[name="priority_id"]:checked').trigger('change');
    $('#change-priority').bind('click',function(){
        var text_confirm = '<?php echo $text_confirm_change ?>';
        if('none' != $('#level-down').css('display')){
            text_confirm = '<?php echo $confirm_demotion ?>';
        }
        if(confirm(text_confirm)){
            $.ajax({
                url:'index.php?route=service/advertise/priority',
                data:{priority_id:$('input[name="priority_id"]:checked').val(),ad:$('input[name="advertise_id"]').val()},
                type:'post',
                dataType:'json',
                success:function(json){
                    if(json.status == 0){
                        $('#component-status .do-result').html('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    }else{
                        $('#component-status .do-result').html('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json.msg + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>')
                        setTimeout('location.reload();',2000);
                    }
                }
            })
        }
    })
</script>
<?php }?>