<?php if(is_array($mode_data) && count($mode_data)){ ?>
<table class="table score-status">
    <thead>
        <td><?php echo $column_status ?></td>
        <td><?php echo $column_qty ?></td>
        <td><?php echo $column_score ?></td>
        <td> <b class="total-score"><?php echo $total_score ?></b> </td>
    </thead>
    <?php foreach ($mode_data as $item) { ?>
    <tr>
        <td><?php echo $item['status_name'] ?></td>
        <td><?php echo $item['qty'] ?></td>
        <td><?php echo $item['status_score'] ?></td>
        <td><?php echo $item['score'] ?></td>
    </tr>
    <?php }?>
</table>
<?php }else{?>
<b class="total-score"><?php echo $total_score ?></b>
<?php } ?>