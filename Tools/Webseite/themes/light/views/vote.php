<?php $this->pageTitle = 'Ratings Bonuses'; ?>


<script>
	$('body').on('click','#aiontopinfo, #l2topru, #mmotopru', function() {
		var e = $(this);
		var id = e.attr('id');
		if (id == 'aiontopinfo') var url = '<?php echo @power::url('vote/getaiontopinfovotes'); ?>';
		else if (id == 'l2topru') var url = '<?php echo @power::url('vote/getl2topruvotes'); ?>';
		else if (id == 'mmotopru') var url = '<?php echo @power::url('vote/getmmotopruvotes'); ?>';
		$.ajax({
			url: url,
			type: "POST",
			data:  {YII_CSRF_TOKEN: "<?php echo Yii::app()->request->csrfToken; ?>"},
			dataType: "json",
			cache: false,
			async: true,
			beforeSend: function() {
				e.html('Loading...');
				e.attr({disabled: true});
			},
			success: function(data) {
				e.html('Get a bonus');
				e.attr({disabled: false});
				$('#'+id+'-status').html('Found votes: <b>'+data.votes+'</b>. Points credited: <b>'+data.sum+'</b>');
			},
			error: function(data) {
				e.html('Get a bonus');
				e.attr({disabled: false});
				$('#'+id+'-status').html('Error '+data.status+': '+data.statusText);
			}
		});
	});
</script>


<div class="note">
	<div class="note-title">Ratings Bonuses</div>
	<div class="note-body">

		<?php if ($config['aiontopinfo_link']) : ?>
		<div class="rating-block">
			<div class="rating-ico"><img src="<?php echo @power::url('images/scr_aiontopinfo.jpg'); ?>"></div>
			<div class="rating-name">Aion-Top.info</div>
		</div>
		<div class="rating-info-bg">
			<div class="rating-info">
				<ul class="rating-stats">
					<li>Total votes: <?php echo $model['AIONTOPINFO']['count']; ?></li>
					<li>Last voice: <?php echo @power::date($model['AIONTOPINFO']['date']); ?></li>
					<li>Last enrollment: <?php echo @power::date($model['AIONTOPINFO']['completed']); ?></li>
				</ul>
				<div id="aiontopinfo-status" class="rating-status">Bonus not yet credited</div>
				<button id="aiontopinfo" class="button">Get a bonus</button>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($config['l2topru_link']) : ?>
		<div class="rating-block">
			<div class="rating-ico"><img src="<?php echo @power::url('images/scr_l2topru.jpg'); ?>"></div>
			<div class="rating-name">L2TOP.ru</div>
		</div>
		<div class="rating-info-bg">
			<div class="rating-info">
				<ul class="rating-stats">
					<li>Total votes: <?php echo $model['L2TOPRU']['count']; ?></li>
					<li>Last voice: <?php echo @power::date($model['L2TOPRU']['date']); ?></li>
					<li>Last enrollment: <?php echo @power::date($model['L2TOPRU']['completed']); ?></li>
				</ul>
				<div id="l2topru-status" class="rating-status">Bonus not yet credited</div>
				<button id="l2topru" class="button">Get a bonus</button>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($config['aiontopinfo_link']) : ?>
		<div class="rating-block">
			<div class="rating-ico"><img src="<?php echo @power::url('images/scr_mmotopru.jpg'); ?>"></div>
			<div class="rating-name">MMOTOP.ru</div>
		</div>
		<div class="rating-info-bg">
			<div class="rating-info">
				<ul class="rating-stats">
					<li>Total votes: <?php echo $model['MMOTOPRU']['count']; ?></li>
					<li>Last voice: <?php echo @power::date($model['MMOTOPRU']['date']); ?></li>
					<li>Last enrollment: <?php echo @power::date($model['MMOTOPRU']['completed']); ?></li>
				</ul>
				<div id="mmotopru-status" class="rating-status">Bonus not yet credited</div>
				<button id="mmotopru" class="button">Get a bonus</button>
			</div>
		</div>
		<?php endif; ?>
		
	</div>
</div>
