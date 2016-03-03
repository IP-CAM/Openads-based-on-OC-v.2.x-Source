<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">

      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">

    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
       
      </div>
      <div class="panel-body">

       <form action="<?php echo $action; ?>" method="post" id="start_form">
       <div class="table-responsive">
        <table class="table table-bordered table-hover">
         
          <tr>
            <td><?php echo $text_status; ?></td>
            <td><?php if($status==1) {echo $text_status_start;}else{echo $text_status_stop;} ?>
             <?php echo $text_status_note; ?></td>
            
          </tr>

          <tr>
            <td><?php echo $text_interval; ?></td>
            <td><input type="text" name="interval" value="<?php echo $similar_text_interval; ?>" /><?php echo $text_minutes; ?></td>
            
          </tr>

          <tr>
            
            <td><input type="submit" name="start" value="<?php echo $button_start; ?>" ></></td>
              
          </tr>
                   
        </table>
        </div>
      </form>
      <form action="<?php echo $action; ?>" method="post" id="stop_form">
        <div class="table-responsive">
        <table class="table table-bordered table-hover">
         
          <tr>
                <td><input type="submit" name="stop" value="<?php echo $button_stop; ?>" ></></td>
          </tr>

                   
        </table>
        </div>
      </form>
        <div class="row">
          
        </div>
      </div>
    </div>
  </div>
  
</div>
<?php echo $footer; ?>