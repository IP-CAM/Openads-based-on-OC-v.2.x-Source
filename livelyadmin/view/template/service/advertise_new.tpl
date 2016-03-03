<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-order" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                </button>
                <a href="<?php echo $cancel; ?>" class="btn btn-default">
                    <i class="fa fa-reply"></i> <?php echo $button_cancel; ?>
                </a>
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
                <h3 class="panel-title">
                    <i class="fa fa-pencil"></i> <?php echo $text_form; ?>
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" id="form-order">
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"><?php echo $entry_website ?></label>
                        <div class="col-sm-10 ">
                            <select name="website_id" id="input-website" class="form-control">
                            <?php foreach ($websites as $item): ?>
                                <option value="<?php echo $item['website_id'] ?>" 
                                    data-product="<?php echo $item['product'] ?>" data-product-id="<?php echo $item['product_id'] ?>" 
                                    data-customer="<?php echo $item['customer'].' <i>'.$item['company'].'</i>' ?>" data-customer-id="<?php echo $item['customer_id'] ?>" 
                                    data-charger="<?php echo $item['charger'] ?>" data-in-charge="<?php echo $item['in_charge'] ?>" 
                                    <?php echo $website_id==$item['website_id'] ? 'selected="selected"' : '' ?>>
                                    <?php echo $item['domain'] ?></option>
                            <?php endforeach ?>   
                            </select>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"><?php echo $entry_product; ?></label>
                        <div class="col-sm-10">
                            <label class="label label-default" id="input-product"><?php echo $product; ?></label>
                            <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"><?php echo $entry_customer; ?></label>
                        <div class="col-sm-10">
                          <span class="form-control" id="input-customer"> <?php echo $company; ?> <i><?php echo $customer; ?></i> </span>
                          <input type="hidden" name="customer_id" value="<?php echo $customer_id ?>">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label class="col-sm-2 control-label"><?php echo $entry_in_charge; ?></label>
                        <div class="col-sm-10">
                          <span class="form-control" id="input-charger"> <?php echo $charger; ?></span>
                          <input type="hidden" name="in_charge" value="<?php echo $in_charge ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_target_url; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="target_url" class="form-control" <?php echo $target_url ?>>
                            <?php if(!empty($error_target_url)){ ?>
                            <div class="text-danger"><?php echo $error_target_url ?></div>
                            <?php }?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" ><?php echo $entry_note; ?></label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="note"><?php echo $note ?></textarea>
                        </div>
                    </div>            
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"><!--
$('#input-website').trigger('change');
$('#input-website').bind('change',function(){
    $option = $(this).find('option[value="'+$(this).val()+'"]');
    $('#input-product').html($option.attr('data-product'));
    $('input[name="product_id"]').val($option.attr('data-product-id'));
    $('#input-customer').html($option.attr('data-customer'));
    $('input[name="customer_id"]').val($option.attr('data-customer-id'));
    $('#input-charger').html($option.attr('data-charger'));
    $('input[name="in_charge"]').val($option.attr('data-in-charge'));
})


//--></script> 


<?php echo $footer; ?>