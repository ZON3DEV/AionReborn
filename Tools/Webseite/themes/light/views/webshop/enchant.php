<?php $this->pageTitle = 'Enchant Item'; ?>

<script>
$('document').ready(function(){
	$('span.enchant-value').click(function(){
		var elem = $(this);
		var enchant = elem.html();
		var uid = elem.attr('uid');
		var group = elem.attr('group');
		var curenchant = elem.attr('curenchant');
		var price = $(elem).parent().next();
		var tr = $(elem).parent().parent();

		$('span.enchant-value').removeClass('enchant-value-selected');
		elem.addClass('enchant-value-selected');
		$('tr.selected').removeClass('selected');
		tr.addClass('selected');
		$('td.price').html('0');

		$.ajax({
			url: "<?php echo Power::url('enchant/getprice'); ?>",
			type: 'POST',
			data:  {uid: uid, enchant:enchant, group:group, curenchant:curenchant, YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken; ?>'},
			cache: false,
			async: false,
			success: function(data) {
				price.html(data+ ' pts');
				$('#EnchantForm_uid').val(uid);
				$('#EnchantForm_enchant').val(enchant);
			},
			error: function(data) {console.log(data)}
		});
	});
});
</script>


<div class="note">
	<div class="note-title">Заточка вещей у персонажа <?php echo $model[0]['name']; ?></div>
	<div class="note-body">
		<?php /*$form=$this->beginWidget('CActiveForm'); echo $form->errorSummary($post);*/ echo Power::message(); ?>
		<table class="table">
			<tr>
				<th>Вещь для заточки</th>
				<th>Заточить до</th>
				<th width="100px">Цена</th>
			</tr>
			<?php foreach ($model as $data): ?>
			<tr>
				<td align="left">
					<?php echo Adb::url('item', $data['item_id']); ?>
					<?php if ($data['enchant'] > 0): ?><span class="current-enchant">(+<?php echo $data['enchant']; ?>)</span><?php endif; ?>
				</td>
				<td>
					<?php foreach ($data['enchant_values'] as $enchant): ?>
					<?php if ($enchant > $data['enchant']): ?>
						<span class="enchant-value" uid="<?php echo $data['item_unique_id']; ?>" group="<?php echo $data['group_id']; ?>" curenchant="<?php echo $data['enchant']; ?>">
							<?php echo $enchant; ?>
						</span>
					<?php endif; ?>
					<?php endforeach; ?>
				</td>
				<td class="price">0</td>
			</tr>
			<?php endforeach; ?>
		</table>
		<div class="center"><?php echo CHtml::submitButton('Заточить вещь', array('id'=>'submit-enchant','class'=>'button')); ?></div>
		<?php //echo $form->hiddenField($post,'uid'); ?>
		<?php //echo $form->hiddenField($post,'enchant'); ?>
		<?php //$this->endWidget(); ?>
	</div>
</div>