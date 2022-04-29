<?php $this->setPageTitle('Mitgliedschaft erwerben'); ?>


<script>
	$('document').ready(function(){
		$('select[name="membership_accounts"]').change(function(){
			var b = $(this).next();
			var v = $(this).val();
			b.removeAttr('disabled');
			b.attr('aid', v);
			if (v == '') b.attr('disabled', 'true');
		});
		$('button.button').click(function(){
			var e = $(this);
			var mid = e.attr('id');
			var aid = e.attr('aid');

			$.ajax({
				url: "<?php echo @Power::url('webshop/buymembership'); ?>",
				type: "POST",
				data:  {mid:mid, aid:aid, YII_CSRF_TOKEN:"<?php echo Yii::app()->request->csrfToken; ?>"},
				dataType: "json",
				cache: false,
				async: true,
				beforeSend: function() {
					e.attr('disabled', 'true');
				},
				success: function(data) {
					e.attr('hidden', 'true');
					e.prev().attr('hidden', 'true');
					$('#membership-status-'+mid).html('<div class="membership-status-'+data.status+'">'+data.message+'</div>')
				},
				error: function(data) {
					alert('Fehler '+data.status+': '+data.statusText);
				}
			});
			$('#membership-status-'+mid).click(function(){
				var b = $('#'+mid);
				b.removeAttr('hidden');
				b.prev().removeAttr('hidden');
				$(this).text('');
			});
		});
	});
</script>


<div class="note">
	<div class="note-title">Buying Membership</div>
	<div class="note-body">
		<?php foreach ($model as $data): ?>
			<div class="membership">
				<div class="membership-name"><?php echo $data['name']; ?></div>
				<div class="membership-info">
					<div class="table border">
						<div class="row ">
							<div class="w75">General</div>
							<div class="w45"><?php echo @Info::getMembershipIco($data['membership_type']); ?></div>
							<div><?php echo @Info::getMembershipDuration($data['membership_duration']); ?></div>
						</div>
						<div class="row ">
							<div class="w75">Craft</div>
							<div class="w45"><?php echo @Info::getMembershipIco($data['craftship_type']); ?></div>
							<div><?php echo @Info::getMembershipDuration($data['craftship_duration']); ?></div>
						</div>
						<div class="row ">
							<div class="w75">AP</div>
							<div class="w45"><?php echo @Info::getMembershipIco($data['apship_type']); ?></div>
							<div><?php echo @Info::getMembershipDuration($data['apship_duration']); ?></div>
						</div>
						<div class="row ">
							<div class="w75">Collection</div>
							<div class="w45"><?php echo @Info::getMembershipIco($data['collectionship_type']); ?></div>
							<div><?php echo @Info::getMembershipDuration($data['collectionship_duration']); ?></div>
						</div>
						<div class="row ">
							<div class="w75">Price</div>
							<div><b><?php echo $data['price']; ?></b> <img class="fix" src="<?php echo @Power::url('images/point_gold.png'); ?>" /></div>
						</div>
					</div>
				</div>
				<div class="membership-button">
					<?php echo CHtml::dropDownList("membership_accounts", false, @Power::getUserAccounts(), array('empty' => '-- Account --')); ?>
					<button id="<?php echo $data['id']; ?>" class="button" disabled="true">Buy</button>
					<div id="membership-status-<?php echo $data['id']; ?>"></div>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
</div>