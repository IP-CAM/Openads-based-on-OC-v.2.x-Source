<table class="list">
  <thead>
    <tr>            	
      <td class="left sort"><?php if ($sort == 'f.entry_sn') { ?>
        <a href="<?php echo $sort_entry_sn; ?>" class="<?php echo strtolower($order); ?>">Product SN</a>
        <?php } else { ?>
        <a href="<?php echo $sort_entry_sn; ?>">Product SN</a>
        <?php } ?>
      </td>
      <td class="left"><?php echo $dateStart; ?></td>
      <td class="left"><?php echo $dateEnd?></td>
      <td class="left"></td>
    </tr>
  </thead>
  <tbody>

    <?php if ($variation) { ?>
    <?php foreach ($variation as $item) { ?>
    <tr>
      <td class="left"><?php echo $item['entry_sn']; ?></td>
      <td class="left"><?php echo $item['startValue'] ?></td>
      <td class="left"><?php echo $item['endValue'] ?></td>  
      <td class="left"><?php echo $item['d-value']; ?></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="4"> No Results</td>
    </tr>
    <?php } ?>
  </tbody>
</table>

<div class="pagination"><?php echo $pagination; ?></div>