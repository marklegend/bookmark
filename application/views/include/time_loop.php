<?php if (empty($times)): ?>
	<div class="align-item-center pt-1">
		<h4 class="mb-0"><i class="lni lni-cross-circle text-danger"></i></h4>
		<p class="time-empty-info pt-0 mt-xs-20"><?php echo trans('schedule-not-available') ?></p>
	</div>
<?php else: ?>

	<p class="pick-date pt-0 mt-xs-20"><?php echo trans('pick-time-for') ?>  <span><?php echo my_date_show($date) ?></span></p>
	<?php foreach ($times as $time): ?>
		<?php $check = check_time($time->time, $date) ?>
		<div class="btn-group">
		    <label class="btn btn-light-success btn-sm time_btn <?php if($check == TRUE){echo 'disabled';} ?>">
		      <input type="radio" class="time_inp" value="<?php echo $time->time ?>" name="time" autocomplete="off"><i class="far fa-clock"></i> <?php echo $time->time ?>
		    </label>
		</div>
	<?php endforeach ?>
<?php endif ?>