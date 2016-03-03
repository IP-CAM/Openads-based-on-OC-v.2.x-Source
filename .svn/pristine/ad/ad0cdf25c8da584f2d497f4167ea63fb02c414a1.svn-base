<?php echo $header; ?>
<div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <div class="row">  
	<div id="column-left" class="col-sm-3"><?php echo $column_left; ?></div>	
    <div id="content" class="col-sm-9">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand"><?php echo $text_welcome ?></a>
                </div>
            </div>
        </nav>
        <div class="">
            <div class="table-responsive">
				<table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align:middle;"><?php echo $text_priority ?></th>
                            <th rowspan="2" class="text-center" style="vertical-align:middle;"><?php echo $text_money ?></th>
                            <th colspan="2" class="text-center"><?php echo $text_all_ad ?></th>
                            <th colspan="4" class="text-center"><?php echo $text_my_ad ?></th>
                        </tr>
                        <tr>
                            <th class="text-center"><?php echo $text_queuing ?></th>
                            <th class="text-center"><?php echo $text_developing ?></th>
                            <th class="text-center"><?php echo $text_queuing ?></th>
                            <th class="text-center"><?php echo $text_developing ?></th>
                            <th class="text-center"><?php echo $text_deliveried ?></th>
                            <th class="text-center"><?php echo $text_terminated ?></th>
                        </tr>
                    </thead>
                    <tbody>
    				    <?php foreach ($priority as $item):?>
    				    <tr>
    					    <td class="text-center active"><?php echo $item['name'] ?></td>
    					    <td class="text-center success">
                                <?php echo $item['amount'] ?>
                            </td>	
                            <td class="text-center warning">
                                <?php if(isset($item['all']['queuing']) && $item['all']['queuing']){ ?> 
                                    <span class="number">
                                        <?php echo $item['all']['queuing'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>
                            <td class="text-center warning">
                                <?php if(isset($item['all']['designing']) && $item['all']['designing']){ ?> 
                                    <span class="number">
                                        <?php echo $item['all']['designing'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>				 
    					    <td class="text-center info">
                                <?php if(isset($item['my']['queuing']) && $item['my']['queuing']){ ?> 
                                    <span class="number">
                                        <?php echo $item['my']['queuing'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>
                            <td class="text-center info">
                                <?php if(isset($item['my']['designing']) && $item['my']['designing']){ ?> 
                                    <span class="number">
                                        <?php echo $item['my']['designing'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>
                            <td class="text-center info">
                                <?php if(isset($item['my']['deliveried']) && $item['my']['deliveried']){ ?> 
                                    <span class="number">
                                        <?php echo $item['my']['deliveried'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>
                            <td class="text-center info">
                                <?php if(isset($item['my']['termination']) && $item['my']['termination']){ ?> 
                                    <span class="number">
                                        <?php echo $item['my']['termination'] ?>
                                    </span>
                                <?php }else{ ?>
                                    0
                                <?php }?>
                            </td>
    					</tr>
    				   <?php endforeach ?>
                    </tbody>
				</table>				  
			 </div>
        </div>
    </div>
  </div>
</div>
<style type="text/css">
    span.number{color:blue;font-weight: bold;}
</style>
<?php echo $footer; ?>
