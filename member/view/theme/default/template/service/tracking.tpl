<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title"><?php echo $title_tracking ?></h3></div>
    <div class="panel-body" id="tracking-teextarea">
        <div class="form-group clearfix">
            <div class="col-sm-12">
                <textarea id="input-text" name="tracking_note" class="form-control"></textarea>
                <div id="_uploads" class="uploads"></div>
            </div>
        </div>
    </div>
</div>
<div style="background: #dddddd;background: rgba(0, 0, 0, 0.05);}">
<?php if($trackings){ ?>
<ul class="timeline animated">
    <?php foreach ($trackings as $item): ?>
        <li class="active">
            <div class="timeline-time">
                <strong><?php echo $item['date'] ?></strong><?php echo $item['time'] ?>
            </div>
            <div class="timeline-icon">
                <?php if($item['from']=='member'){ ?>
                <div class="bg-primary">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <?php }else{ ?>
                <div class="bg-info">
                    <span class="glyphicon glyphicon-eye-open"></span>
                </div>
                <?php }?>
            </div>
            <div class="timeline-content">
                <blockquote>
                    <p><?php echo htmlspecialchars_decode($item['text']) ?></p>
                    <small>
                        <?php if($item['from']=='member'){ ?>
                        <i><?php echo $text_member ?></i>
                        <?php }else{ ?>
                        
                        <i><?php echo $text_backend ?></i>
                        <?php }?>
                    </small>
                    <?php if(is_array($item['attach'])){ ?>
                    <div class="uploads">
                        <?php foreach ($item['attach'] as $attach): ?>
                        <div class="attach">
                            <a href="<?php echo $attach['realpath'] ?>" class="fancy-img">
                                <img src="<?php echo $attach['image'] ?>" title="<?php echo $attach['name'] ?>" style="width:70px;height:70px" class="img-thumbnail">
                            </a>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php }?>
                </blockquote>
            </div>
        </li>
    <?php endforeach ?>
</ul>
<?php }?>
</div>
<link href="member/view/theme/default/stylesheet/timeline.css" type="text/css" rel="stylesheet">
<link href="<?php echo TPL_JS ?>summernote/summernote.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="<?php echo TPL_JS ?>summernote/summernote.js" ></script>
 <script type="text/javascript" src="<?php echo TPL_JS ?>summernote/plugin/summernote-ext-ajaxuploads.js" ></script>
<script type="text/javascript">
$(function(){
    var toolbar = [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['photo']],
        ['insert',['send']]
    ]
    $('#input-text').summernote({ 
        toolbar:toolbar, 
        height: 100,
        onImageUpload: function(files, editor, $editable) {
            console.log('image upload:', files, editor, $editable);
        }
    });
    new AjaxUpload('#_photo-upload', {
        action: 'index.php?route=common/filemanager/upload&token=<?php echo $token; ?>',
        name: 'attachment',
        autoSubmit: false,
        responseType: 'json',
        onChange: function(file, extension) {this.submit();},
        onComplete: function(file, json) {
            if(json.success) { 
                var html = '<div class="attach">';
                html +='<img title="'+file+'" filename="'+file+'" filepath="'+json.path+'" src="'+getImgURL(json.path)+'" class="img-thumbnail">';
                html +='<a class="img-remove" onclick="$(this).parent().remove();"><?php echo $button_delete ?></a>';
                html += '</div>';
                $("#_uploads").append(html);
            }else{
                alert(json.error);
            }
        }
    });
});
$('#_send-tracking').bind('click',function(){
    var text = $('#input-text').code();
    var attach = '' ;
    if(text.length>0){
        if($('#_uploads img').length>0){
            var uploads = [];
            $.each($('#_uploads img'),function(){
                uploads.push({name:$(this).attr('filename'),path:$(this).attr('filepath')});
            });
            attach = $.toJSON(uploads)
        }
        $.ajax({
            url:'index.php?route=service/advertise/tracking&token=<?php echo $token; ?>',
            data:{ad:'<?php echo $advertise_id ?>',text:text,attach:attach},
            type:'post',
            dataType:'html',
            success:function(html){
                $('#timeline').html(html);
            }
        })
    }else{
        alert('Content should not be empty!');
        return false;
    }
});
</script>
<style type="text/css">

</style>