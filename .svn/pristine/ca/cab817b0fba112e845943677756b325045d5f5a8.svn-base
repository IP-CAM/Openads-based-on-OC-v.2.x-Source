<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/log.png" /> <?php echo $heading_title; ?></h1>
            <div class="buttons">          </div>
        </div>
        <div id="vtabs" class="vtabs">
            <a href="#tab-status" ><?php echo $tab_status;?></a>
            <a href="#tab-publish" ><?php echo $tab_publish;?></a>
            <a href="#tab-product" ><?php echo $tab_product;?></a>
            <a href="#tab-auditor" ><?php echo $tab_auditor;?></a>
            <a href="#tab-author" ><?php echo $tab_author;?></a>
        </div>
        <div class="content">
            <div id="tab-status" class="tab-pane">
                <h3><?php echo $title_photo_fbaccount ?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_status ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($photo_fbaccount_status){ ?>
                <?php foreach ($photo_fbaccount_status as $item) {?>
                        <tr>
                            <td><?php echo $item['status_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
                <h3><?php echo $title_fbaccount ?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_status ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($fbaccount_status){ ?>
                <?php foreach ($fbaccount_status as $item) {?>
                        <tr>
                            <td><?php echo $item['status_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
                <h3><?php echo $title_fbpage ?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_status ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($fbpage_status){ ?>
                <?php foreach ($fbpage_status as $item) {?>
                        <tr>
                            <td><?php echo $item['status_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="tab-publish" class="tab-pane">

                <h3><?php echo $title_photo_fbaccount ?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_publish ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($photo_fbaccount_publish){ ?>
                <?php foreach ($photo_fbaccount_publish as $item) {?>
                        <tr>
                            <td><?php echo $item['publish_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
                <h3><?php echo $title_fbaccount;?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_publish ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($fbaccount_publish){ ?>
                <?php foreach ($fbaccount_publish as $item) {?>
                        <tr>
                            <td><?php echo $item['publish_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
                <h3><?php echo $title_fbpage;?></h3>
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_publish ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_posts ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($fbpage_publish){ ?>
                <?php foreach ($fbpage_publish as $item) {?>
                        <tr>
                            <td><?php echo $item['publish_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts'] ?></td>
                        </tr>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="3"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="tab-product">
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_product ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_photo_fbaccount ?></td>
                            <td><?php echo $column_fbaccount ?></td>
                            <td><?php echo $column_fbpage ?></td>
                            <td><?php echo $column_total ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($post_product){ ?>
                <?php foreach ($post_product as $item) {?>
                <?php if($item['contribute_config_id']){?>
                        <tr>
                            <td><?php echo $item['contribute_config_id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['posts1'] ?></td>
                            <td><?php echo $item['posts2'] ?></td>
                            <td><?php echo $item['posts3'] ?></td>
                            <td><?php echo $item['posts1']+$item['posts2']+$item['posts3'] ?></td>
                        </tr>
                <?php }?>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="6"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="tab-auditor" class="tab-pane">
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_auditor ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_photo_fbaccount ?></td>
                            <td><?php echo $column_fbaccount ?></td>
                            <td><?php echo $column_fbpage ?></td>
                            <td><?php echo $column_total ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($post_auditor){ ?>
                <?php foreach ($post_auditor as $item) {?>
                <?php if($item['user_id']){?>
                        <tr>
                            <td><?php echo $item['user_id'] ?></td>
                            <td><?php echo $item['lastname'].$item['firstname'] ?></td>
                            <td><?php echo $item['posts1'] ?></td>
                            <td><?php echo $item['posts2'] ?></td>
                            <td><?php echo $item['posts3'] ?></td>
                            <td><?php echo $item['posts1']+$item['posts2']+$item['posts3'] ?></td>
                        </tr>
                <?php }?>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="6"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
            </div>
            <div id="tab-author">
                <table class="list">
                    <thead>
                        <tr>
                            <td><?php echo $column_author ?></td>
                            <td><?php echo $column_name ?></td>
                            <td><?php echo $column_photo_fbaccount ?></td>
                            <td><?php echo $column_fbaccount ?></td>
                            <td><?php echo $column_fbpage ?></td>
                            <td><?php echo $column_total ?></td>
                        </tr>
                    </thead>
                    <tbody>
                <?php if($post_author){ ?>
                <?php foreach ($post_author as $item) {?>
                <?php if($item['customer_id']){?>
                        <tr>
                            <td><?php echo $item['customer_id'] ?></td>
                            <td><?php echo $item['firstname'].$item['lastname'] ?></td>
                            <td><?php echo $item['posts1'] ?></td>
                            <td><?php echo $item['posts2'] ?></td>
                            <td><?php echo $item['posts3'] ?></td>
                            <td><?php echo $item['posts1']+$item['posts2']+$item['posts3'] ?></td>
                        </tr>
                <?php }?>
                <?php }?>
                <?php }else{ ?>
                        <tr><td colspan="6"><?php echo $text_no_results ?></td></tr>
                <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .list td{padding: 5px  !important;}
</style>
<script type="text/javascript"><!-- 
    $('.vtabs a').tabs();
    $('.htabs a').tabs();
//--></script>

<?php echo $footer; ?>