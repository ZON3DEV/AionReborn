<?php $this->setPageTitle('Player search'); ?>

<div class="note">
	<div class="note-title">Player search</div>
	<div class="note-body">
		<?php $form=$this->beginWidget('CActiveForm'); echo @Power::message(); ?>
		<div class="table">
			<div class="row">
				<div><?php echo $form->label($post,'name'); ?></div>
				<div class="w200"><?php echo $form->textField($post,'name', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'name', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div><?php $this->widget('CCaptcha', array('showRefreshButton' => false, 'clickableImage' => true)); ?></div>
				<div class="w200"><?php echo $form->textField($post,'captcha', array('class'=>'text')); ?></div>
				<div><?php echo $form->error($post,'captcha', array('class' => 'errorPopup')); ?></div>
			</div>
			<div class="row">
				<div></div>
				<div class="w200"><?php echo CHtml::submitButton('Search', array('class'=>'button')); ?></div>
				<div></div>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php if ($model): ?>
<div class="note">
	<div class="note-title">Список игроков</div>
	<div class="note-body">
		<table class="table">
			<tr>
				<th>Имя</th>
				<th>Уровень</th>
				<th>Раса</th>
				<th>Класс</th>
				<th>Статус</th>
			</tr>
			<?php foreach ($model as $data): ?>
			<tr class="center">
				<td><a href="<?php echo Yii::app()->homeUrl.'player/'.$data['name']; ?>"><?php echo $data['name']; ?></a></td>
				<td><?php echo Info::getLevel($data['exp']); ?></td>
				<td><?php echo Info::getRaceIco($data['race']) ?></td>
				<td><?php echo Info::getClassIco($data['player_class']) ?></td>
				<td><?php echo Info::getOnlineIco($data['online']); ?></td>
			</tr>
			<?php endforeach ?>
		</table>
	</div>
</div>
<?php endif; ?>