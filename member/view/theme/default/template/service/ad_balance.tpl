<table class="table table-bordered">
  <thead>
    <tr>
      <td class="text-left"><?php echo $column_date_priority; ?></td>
      <td class="text-left"><?php echo $column_type; ?></td>
      <td class="text-left"><?php echo $column_amount; ?></td>
      <td class="text-left"><?php echo $column_priority; ?></td>
      <td class="text-left"><?php echo $column_note; ?></td>
      
    </tr>
  </thead>
  <tbody>
    <?php if ($balances) { ?>
    <?php foreach ($balances as $item) { ?>
    <tr>
      <td class="text-left"><?php echo $item['date_added']; ?></td>
      <td class="text-left"><?php echo $item['type']; ?></td>
      <td class="text-left"><?php echo $item['amount']; ?></td>
      <td class="text-left"><?php echo $item['priority']; ?></td>
      <td class="text-left"><?php echo $item['note']; ?></td>
      
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="row">
  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
</div>
