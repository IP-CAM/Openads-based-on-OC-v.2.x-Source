                <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-left"><?php if ($sort == 'a.user_id') { ?>
                                        <a href="<?php echo $sort_operator; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_operator; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_operator; ?>"><?php echo $column_operator; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-left"><?php if ($sort == 'a.mode') { ?>
                                        <a href="<?php echo $sort_mode; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_mode; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_mode; ?>"><?php echo $column_mode; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-left"><?php if ($sort == 'a.status') { ?>
                                        <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'a.status_score') { ?>
                                        <a href="<?php echo $sort_status_score; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status_score; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_status_score; ?>"><?php echo $column_status_score; ?></a>
                                        <?php } ?>
                                    </td>
                                    
                                    <td class="text-left"><?php if ($sort == 'qty') { ?>
                                        <a href="<?php echo $sort_qty; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_qty; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_qty; ?>"><?php echo $column_qty; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'a.score') { ?>
                                        <a href="<?php echo $sort_score; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_score; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_score; ?>"><?php echo $column_score; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right"><?php echo $column_date; ?></td>
                                    <td class="text-right"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($records) { ?>
                                <?php foreach ($records as $item) { ?>
                                <tr>
                                    <td class="text-left"><?php echo $item['operator']; ?></td>
                                  <td class="text-left"><?php echo $item['mode']; ?></td>
                                  <td class="text-left"><?php echo $item['status_name']; ?></td>
                                  <td class="text-left"><?php echo $item['status_score']; ?></td>
                                  
                                  <td class="text-left"><?php echo $item['qty']; ?></td>
                                  <td class="text-left"><?php echo $item['score']; ?></td>
                                  <td class="text-left"><?php echo $item['date']; ?></td>
                                  <td class="text-right">
                                      <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-default"><i class="fa fa-eye"></i></a> 
                                  </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="10"><?php echo $text_no_results; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>