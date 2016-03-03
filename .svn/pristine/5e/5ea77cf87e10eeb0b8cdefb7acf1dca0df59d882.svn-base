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
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($faqs) { ?>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php foreach ($faqs as $item) { ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="faq-<?php echo $item['faq_id'];?>">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#reply-<?php echo $item['faq_id'];?>" aria-expanded="false" aria-controls="reply-<?php echo $item['faq_id'];?>">
                  <em><?php echo $item['date_added'] ?></em> : <?php echo $item['title'] ?>
                </a>
              </h4>
              
            </div>
            <div id="reply-<?php echo $item['faq_id'];?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="faq-<?php echo $item['faq_id'];?>">
              <div class="panel-body">
                <p><?php echo $item['text'] ?></p>
              </div>
            </div>
        </div>
        <?php } ?>
      </div>
      <div class="text-right"><?php echo $pagination; ?></div>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
      <div class="buttons clearfix">
        <div class="pull-right"></div>
      </div>
      </div>
    </div>
</div>

<?php echo $footer; ?>