<?php echo $header; ?>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>
    <div class="row">
        <div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>
        <div id="content" class="col-sm-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $heading_title ?></h3>
                </div>
                <div class="panel-body">
                    <div class="jumbotron">
                        <h2><?php echo $text_success ?></h2>
                        <p><?php echo $text_ad_desc ?></p>
                        <p>
      
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if($redirect){?>
<script type="text/javascript">
    $(function(){
        setTimeout('location.href="<?php echo htmlspecialchars_decode($redirect) ?>"',5500);
    });
</script>
<?php }?>
<?php echo $footer; ?>