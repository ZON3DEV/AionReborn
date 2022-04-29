<?php $this->setPageTitle('Список приведенных игроков'); ?>


<script>
	$(document).ready(function(){
		$('input.button').click(function(){
			$('#ReferralsForm_pow_user_id').val($(this).attr('pow_user_id'));
			$('#ReferralsForm_account_id').val($(this).attr('account_id'));
			$('#ReferralsForm_player_id').val($(this).attr('player_id'));
		});
	});
</script>


<div class="note">
	<div class="note-title">Список приведенных игроков</div>
	<div class="note-body">
		<div class="flash_info mb10">
			<p>• Ваша реферальная ссылка для приглашения игроков: <b><?php echo Power::url('user/registration', Power::userId()); ?></b></p>
			<p>• Для получения награды необходимо чтобы у игрока было <b><?php echo Info::getReferalFilterName($filter['name']); ?></b> не меньше <b><?php echo $filter['value']; ?></b></p>
			<p>• Ваша награда: <b><?php echo $filter['bonusOwner']; ?></b> <i class="btn-point-gold s16"></i>. Награда реферала: <b><?php echo $filter['bonusReferral']; ?></b> <i class="btn-point-gold s16"></i></p>
		</div>
		<?php if ($referrals): ?>
			<?php $form=$this->beginWidget('CActiveForm'); echo $form->errorSummary($post); echo Power::message(); ?>
			<table class="table">
				<tr>
					<th>ID</th>
					<th>Имя</th>
					<th>Уровень</th>
					<th>AP</th>
					<th>PvP</th>
					<th>Раса</th>
					<th>Класс</th>
					<th width="120px">Создан</th>
					<th>Бонус</th>
				</tr>
				<?php foreach ($referrals as $data): ?>
				<tr>
					<td><?php echo $data['pow_user_id']; ?></td>
					<td><a href="<?php echo Power::url('player', $data['name']); ?>"><?php echo $data['name']; ?></a></td>
					<td><?php echo Info::getLevel($data['exp']); ?></td>
					<td><?php echo $data['ap']; ?></td>
					<td><?php echo $data['all_kill']; ?></td>
					<td><?php echo Info::getRaceIco($data['race']); ?></td>
					<td><?php echo Info::getClassIco($data['player_class']); ?></td>
					<td><?php echo Power::date($data['creation_date'], 'dd.MM.y, HH:mm'); ?></td>
					<td>
						<?php $data[$filter['name']] >= $filter['value'] ? $disabled = NULL : $disabled = 'true'; ?>
						<?php echo CHtml::submitButton('+', array('class'=>'button', 'disabled'=>$disabled, 'pow_user_id'=>$data['pow_user_id'], 'account_id'=>$data['account_id'], 'player_id'=>$data['id'])); ?>
					</td>
				</tr>
				<?php endforeach ?>
			</table>
			<?php echo $form->hiddenField($post,'pow_user_id'); ?>
			<?php echo $form->hiddenField($post,'account_id'); ?>
			<?php echo $form->hiddenField($post,'player_id'); ?>
			<?php $this->endWidget(); ?>
		<?php else: ?>
			Рефералы отсутствуют
		<?php endif; ?>
	</div>
</div>