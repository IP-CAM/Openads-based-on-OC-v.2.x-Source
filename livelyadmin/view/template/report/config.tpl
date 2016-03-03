<div class="col-sm-12">
	<div class="do-result"></div>
	<form class="form-horizontal" id="config-form">
		<div class="form-group">
			<label for="input-report-publish-indesign" class="control-label col-sm-3"><?php echo $text_report_indesign?></label>
			<div class="col-sm-9">
				<div class="well well-sm" style="height: 150px; overflow: auto;" id="input-report-publish-indesign">
                    <?php foreach ($post_publishes as $item) { ?>
                    <div class="checkbox">
                        <label>
	                        <?php if (in_array($item['publish_id'], $report_indesign)) { ?>
	                        <input type="checkbox" name="report_ad_publish_indesign[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
	                        <?php echo $item['name']; ?>
	                        <?php } else { ?>
	                        <input type="checkbox" name="report_ad_publish_indesign[]" value="<?php echo $item['publish_id']; ?>" />
	                        <?php echo $item['name']; ?>
	                        <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
			</div>
		</div>
		<div class="form-group">
			<label for="input-report-publish-waiting" class="control-label col-sm-3"><?php echo $text_report_waiting?></label>
			<div class="col-sm-9">
				<div class="well well-sm" style="height: 150px; overflow: auto;" id="input-report-publish-waiting">
                    <?php foreach ($post_publishes as $item) { ?>
                    <div class="checkbox">
                        <label>
	                        <?php if (in_array($item['publish_id'], $report_waiting)) { ?>
	                        <input type="checkbox" name="report_ad_publish_waiting[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
	                        <?php echo $item['name']; ?>
	                        <?php } else { ?>
	                        <input type="checkbox" name="report_ad_publish_waiting[]" value="<?php echo $item['publish_id']; ?>" />
	                        <?php echo $item['name']; ?>
	                        <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
			</div>
		</div>	
		<div class="form-group">
			<label for="input-report-publish-doing" class="control-label col-sm-3"><?php echo $text_report_doing?></label>
			<div class="col-sm-9">
				<div class="well well-sm" style="height: 150px; overflow: auto;" id="input-report-publish-doing">
                    <?php foreach ($post_publishes as $item) { ?>
                    <div class="checkbox">
                        <label>
	                        <?php if (in_array($item['publish_id'], $report_doing)) { ?>
	                        <input type="checkbox" name="report_ad_publish_doing[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
	                        <?php echo $item['name']; ?>
	                        <?php } else { ?>
	                        <input type="checkbox" name="report_ad_publish_doing[]" value="<?php echo $item['publish_id']; ?>" />
	                        <?php echo $item['name']; ?>
	                        <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
			</div>
		</div>
		<div class="form-group">
			<label for="input-report-publish-running" class="control-label col-sm-3"><?php echo $text_report_running?></label>
			<div class="col-sm-9">
				<div class="well well-sm" style="height: 150px; overflow: auto;" id="input-report-publish-running">
                    <?php foreach ($post_publishes as $item) { ?>
                    <div class="checkbox">
                        <label>
	                        <?php if (in_array($item['publish_id'], $report_running)) { ?>
	                        <input type="checkbox" name="report_ad_publish_running[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
	                        <?php echo $item['name']; ?>
	                        <?php } else { ?>
	                        <input type="checkbox" name="report_ad_publish_running[]" value="<?php echo $item['publish_id']; ?>" />
	                        <?php echo $item['name']; ?>
	                        <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
			</div>
		</div>	
		<div class="form-group">
			<label for="input-report-publish-banned" class="control-label col-sm-3"><?php echo $text_report_banned?></label>
			<div class="col-sm-9">
				<div class="well well-sm" style="height: 150px; overflow: auto;" id="input-report-publish-banned">
                    <?php foreach ($post_publishes as $item) { ?>
                    <div class="checkbox">
                        <label>
	                        <?php if (in_array($item['publish_id'], $report_banned)) { ?>
	                        <input type="checkbox" name="report_ad_publish_banned[]" value="<?php echo $item['publish_id']; ?>" checked="checked" />
	                        <?php echo $item['name']; ?>
	                        <?php } else { ?>
	                        <input type="checkbox" name="report_ad_publish_banned[]" value="<?php echo $item['publish_id']; ?>" />
	                        <?php echo $item['name']; ?>
	                        <?php } ?>
                        </label>
                    </div>
                    <?php } ?>
                </div>
			</div>
		</div>			
	</form>
</div>