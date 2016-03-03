<div class="col-sm-12 clearfix ">
<table class="table table-bordered">
  <thead>
    <tr>
      <td class="text-left"><?php echo $column_date_added; ?></td>
      <td class="text-left"><?php echo $column_status; ?></td>
      <td class="text-left"><?php echo $column_note; ?></td>
      
    </tr>
  </thead>
  <tbody>
    <?php if ($histories) { ?>
    <?php foreach ($histories as $history) { ?>
    <tr>
      <td class="text-left"><?php echo $history['date_added']; ?></td>
      <td class="text-left"><?php echo $history['status']; ?></td>
      <td class="text-left" style="width:20%;word-break:break-all;">
        <?php if(!empty($history['note'])){?>
        <a class="note-entry" onclick="$('.note-info').hide();$('.note-entry').show();$(this).hide().next('.note-info').show();"><?php echo $text_more_note; ?></a>
        <span class="note-info" style="display:none;"><?php echo $history['note'] ?></span>
        <?php } ?>
      </td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="text-center" colspan="3"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
</div>
<style type="text/css">
  .note-entry{cursor: pointer;}
</style>