<?php $this->setPageTitle('Покупка привилегий'); ?>


<div class="note">
	<div class="note-title">Покупка привилегий</div>
	<div class="note-body">
		<?php if(Yii::app()->user->hasFlash('message')) echo Yii::app()->user->getFlash('message'); ?>
		<?php echo CHtml::beginForm(); ?>
		<div class="form"><?php //echo CHtml::errorSummary($membership); ?></div>
		<table class="table">
			<tr>
				<th width="20%">Название</th>
				<th width="20%">Тип</th>
				<th width="20%">Дни</th>
				<th width="20%">Цена</th>
				<th width="20%">Выбрать</th>
			</tr>
		<?php foreach ($model as $data): ?>
			<tr class="center">
				<td><label for="Membership_id_<?php echo $data['id']; ?>"><?php echo $data['name']; ?></label></td>
				<td><?php echo Info::membership($data['membership_type']); ?></td>
				<td><?php echo $data['membership_duration']; ?></td>
				<td><?php echo $data['price']; ?> points</td>
				<td><input type="radio" id="Membership_id_<?php echo $data['id']; ?>" name="Membership[id]" value="<?php echo $data['id']; ?>" /></td>
			</tr>
		<?php endforeach; ?>
			<tr class="center">
				<td colspan="5"><input type="submit" name="yt0" value="Активировать привилегии" class="button"></td>
			</tr>
		</table>
		<?php echo CHtml::endForm(); ?>
	</div>
</div>