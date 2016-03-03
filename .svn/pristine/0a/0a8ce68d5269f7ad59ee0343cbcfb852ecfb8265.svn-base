<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row">
    <div id="column-left" class="col-sm-3">
        <?php echo $column_left; ?>
    </div>
    <div id="content" class="col-sm-9">
      <h1><?php echo $heading_title; ?></h1>
        <div class="well filter">
          <div class="row">
            <div class="col-sm-3">
              <div class="form-group"> 
                <label class="control-label" for="input-modified-start"><?php echo $entry_modified_start; ?></label>               
                <div class="input-group date">
                  
                  <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" data-date-format="YYYY-MM-DD" id="input-modified-start" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
              </div>
              <div class="form-group">     
                <label class="control-label" for="input-modified-end"><?php echo $entry_modified_end; ?></label>           
                <div class="input-group date">
                  
                  <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end; ?>" placeholder="<?php echo $entry_modified_end; ?>" data-date-format="YYYY-MM-DD" id="input-modified-end" class="form-control" />
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label class="control-label" for="input-website"><?php echo $entry_website; ?></label>
                <input type="text" name="filter_domain" value="<?php echo $filter_domain; ?>" placeholder="<?php echo $entry_website; ?>" id="input-website" class="form-control" />
              </div>
              <div class="form-group">  
                <label class="control-label" for="input-target_url"><?php echo $entry_target_url; ?></label>              
                <input type="text" name="filter_target_url" value="<?php echo $filter_target_url; ?>" placeholder="<?php echo $entry_target_url; ?>" id="input-target_url" class="form-control" />
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">   
                <label class="control-label" for="input-product"><?php echo $entry_product; ?></label>
                <select name="filter_product" id="input-product" class="form-control" placeholder="<?php echo $entry_product; ?>">
                  <option value="*"></option>
                  <?php foreach ($products as $item) { ?>
                  <?php if ($item['product_id'] == $filter_product) { ?>
                  <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['product_id']; ?>"><?php echo $item['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
                            
              <div class="form-group">
                <label class="control-label" for="input-priority"><?php echo $entry_priority; ?></label>
                <select name="filter_priority" id="input-priority" class="form-control">
                  <option value="*"></option>
                  <?php foreach ($ad_priorities as $item) { ?>
                  <?php if ($item['priority_id'] == $filter_priority) { ?>
                  <option value="<?php echo $item['priority_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['priority_id']; ?>"><?php echo $item['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-sm-3">
              
              <div class="form-group">
                <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label><select name="filter_publish" id="input-publish" class="form-control">
                  <option value="*"></option>
                  <option value="1" <?php echo ($filter_publish ==1) ? 'selected="selected"' : '' ?>>
                    <?php echo $text_queue ?>
                  </option>
                  <?php foreach ($ad_publishes as $item) { ?>
                  <?php if ($item['publish_id'] == $filter_publish) { ?>
                  <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group pull-right">
                <div class="control-label clearfix" for="input-filter"> &nbsp;</div>
                <button type="button" id="button-filter" class="btn btn-primary">
                  <i class="fa fa-search"></i> <?php echo $button_filter; ?>
                </button>
            </div>
            </div>
          </div>
        </div>
        <?php if ($ads) { ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th class="text-left">
                  <?php if ($sort == 'a.advertise_sn') { ?>
                    <a href="<?php echo $sort_sn; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_sn; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_sn; ?>"><?php echo $column_ad_sn; ?></a>
                    <?php } ?>
                </th>
                <th class="text-left">
                  <?php if ($sort == 'a.date_modified') { ?>
                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                    <?php } ?>
                </th>
                <th class="text-center"><?php echo $column_product; ?></th>             
                <th class="text-left"><?php echo $column_target_url; ?></th>
                <th class="text-left">
                <?php if ($sort == 'a.publish') { ?>
                    <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                    <?php } ?>
                </th>
                <th class="text-right"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($ads as $item) { ?>
              <tr>
                <td class="text-left"><?php echo $item['advertise_sn']; ?></td>
                <td class="text-left"><?php echo $item['date_modified']; ?></td>
                <td class="text-center">
                  <b class="gh-btn">
                    <i class="fa fa-tag hidden"></i>
                    <span class="gh-text"><?php echo $item['product']; ?></span>
                  </b>
                </td>              

                <td class="text-left" style="word-break:break-all;width:30%;">
                  <a target="_blank" href="<?php echo $item['target_url']; ?>"><?php echo lively_truncate($item['target_url'],80); ?></a>
                </td>
                <td class="text-left"><?php echo $item['publish_text']; ?>
                  <div class="btn-group btns-queue">
                    <button type="button" class="btn btn-primary">
                      <?php echo $item['priority']; ?>                    
                    </button> 
                    <?php if(!empty($item['demotion'])){?>
                    <button type="button" class="btn btn-warning"><?php echo $item['demotion']; ?> </button>
                    <?php }else{?>
                     
                    <?php if($item['publish']==1){?>               
                    <button type="button" class="btn btn-info"># <?php echo $item['number'] ?></button>
                    <?php }?>
                                    
                    <button type="button" class="btn btn-success">
                      <?php echo $item['amount'] ?>
                    </button>
                    <?php }?>
                  </div>
                </td>
                <td class="text-right">
                  <a href="<?php echo $item['href']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>"><?php echo $button_view; ?></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="text-right"><?php echo $pagination; ?></div>
        <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#button-filter').on('click', function() {
    url = 'index.php?route=service/advertise';
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
  $('.date').datetimepicker({ pickTime: false});
</script>

<?php echo $footer; ?>