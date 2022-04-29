<?php $this->setPageTitle('Редактирование аккаунта '.$model['name']); ?>


<div class="note-border">
	<div class="note">
		<div class="note-title"><?php echo $this->getPageTitle(); ?></div>
		<div class="note-body">
			<?php $form=$this->beginWidget('CActiveForm'); echo $form->errorSummary($model); echo Power::message(); ?>
			<table class="form">
				<tr>
					<td><?php echo $form->label($model,'name'); ?></td>
					<td><?php echo $form->textField($model,'name', array('size'=>32)); ?></td>
				</tr>
				<tr>
					<td><?php echo $form->label($model,'access_level'); ?></td>
					<td><?php echo $form->dropDownList($model,'access_level', range(0, 6)); ?></td>
				</tr>
				<tr>
					<td><?php echo $form->label($model,'activated'); ?></td>
					<td><?php echo $form->checkBox($model,'activated'); ?></td>
				</tr>
				<tr>
					<td><?php echo $form->label($model,'money'); ?></td>
					<td><?php echo $form->textField($model, Config::get('money_column'), array('size'=>32)); ?></td>
				</tr>
				<tr>
					<td><?php echo $form->label($model,'pow_user_id'); ?></td>
					<td><?php echo $form->textField($model,'pow_user_id', array('size'=>32)); ?></td>
					<td><i class="ml10 btn-question" title="ID пользователя (владельца), за которым закреплен данный аккаунт"></i></td>
				</tr>
				<tr>
					<td><?php echo $form->label($model,'password_new'); ?></td>
					<td><?php echo $form->textField($model,'password_new', array('size'=>32)); ?></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" class="button" name="yt0" value="Сохранить"></td>
				</tr>
			</table>
			<?php $this->endWidget(); ?>
		</div>
	</div>
</div>


<div class="note-border">
	<div class="note">
		<div class="note-title">Список персонажей</div>
		<div class="note-body">
			<table class="table">
			<tr>
				<th>Имя</th>
				<th>Уровень</th>
				<th>Раса</th>
				<th>Класс</th>
				<th>Создан</th>
				<th>Последний онлайн</th>
				<th>Онлайн</th>
			</tr>
			<?php foreach($players as $data): ?>
			<tr>
				<td><a href="<?php echo Power::url('admin/player/edit', $data['id']); ?>"><?php echo $data['name']; ?></a></td>
				<td><?php echo Info::getLevel($data['exp']); ?></td>
				<td><?php echo Info::getRaceIco($data['race']); ?></td>
				<td><?php echo Info::getClassIco($data['player_class']); ?></td>
				<td><?php echo Power::date($data['creation_date'], 'yyyy.MM.dd, HH:mm'); ?></td>
				<td><?php echo Power::date($data['last_online'], 'yyyy.MM.dd, HH:mm'); ?></td>
				<td><?php echo Info::getOnlineIco($data['online']); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
		</div>
	</div>
</div>
