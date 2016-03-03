<ul class="timeline animated">
    <li class="active">
        <div class="timeline-time">
            <strong><?php echo date('Y-m-d') ?></strong><?php echo date('H:i') ?>
        </div>
        <div class="timeline-icon">
            <div id="button-send" class="bg-success" title="<?php echo $button_send ?>" data-toggle="tooltip">
                <span class="glyphicon glyphicon-send"></span>
            </div>
        </div>
        <div class="timeline-content">
            <textarea id="input-text" name="tracking_note"></textarea>
            <div id="_uploads" class="uploads"></div>
        </div>
    </li>
    <?php if($trackings){ ?>
    <?php foreach ($trackings as $item): ?>
        <li class="active">
            <div class="timeline-time">
                <strong><?php echo $item['date'] ?></strong><?php echo $item['time'] ?>
            </div>
            <div class="timeline-icon">
                <?php if($item['from']=='backend'){ ?>
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
                        <?php if($item['from']=='backend'){ ?>
                        <i><?php echo $item['charger'] ?></i>
                        <?php }else{ ?>
                        <?php echo $item['customer'] ?>
                        <?php if(!empty($item['company'])){ ?>
                        <i><?php echo $item['company'] ?></i>
                        <?php } ?>
                        <?php }?>
                    </small>
                    <?php if(is_array($item['attach'])){ ?>
                    <div class="uploads">
                        <?php foreach ($item['attach'] as $attach): ?>
                        <div class="attach">
                            <a href="<?php echo $attach['realpath'] ?>" class="fancy-img">
                                <img src="<?php echo $attach['image'] ?>" title="<?php echo $attach['name'] ?>" style="width:70px;height:70px" class="img-thumbnail">
                            </a>
                            <a class="img-download" href="<?php echo $attach['download'] ?>"><?php echo $button_download ?></a>
                        </div>
                        <?php endforeach ?>
                    </div>
                    <?php }?>
                </blockquote>
            </div>
        </li>
    <?php endforeach ?>

    <?php }?>
</ul>
<link href="view/stylesheet/timeline.css" type="text/css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo TPL_JS ?>summernote/plugin/summernote-ext-ajaxuploads.js" ></script>
<script type="text/javascript">
$(function(){
    var toolbar = [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough']],
        ['insert', ['photo']],
    ]
    $('#input-text').summernote({ 
        toolbar:toolbar, 
        height: 120,
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
$('#button-send').bind('click',function(){
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
            data:{advertise_id:'<?php echo $advertise_id ?>',text:text,attach:attach},
            type:'post',
            dataType:'html',
            success:function(html){
                $('#timeline').html(html);
            }
        })
    }else{
        alert('<?php echo $error_content ?>');
        return false;
    }
});
</script>
