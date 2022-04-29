<?php

	$this->pageTitle = 'Редактирование аккаунта ' . $model['name'];
	echo '
';
	echo '<s';
	echo 'cript>
	$(function() {
		$( "#AccountData_expire" ).datepicker({
			numberOfMonths: 2,
			firstDay: 1,
			dateFormat: \'yy-mm-dd\',
			showButtonPanel: false
		});
	});
</script>

<div class="box">
	<div class="box_title">';
	echo $this->pageTitle;
	echo '</div>
	<div class="box_body">
		';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo '		';

	if (Yii::app(  )->user->hasFlash( 'message' )) {
		echo Yii::app(  )->user->getFlash( 'message' );
	}

	echo $form->errorSummary( $model );
	echo '		<table class="table_form">
			<tr>
				<td width="300px">';
	echo $form->label( $model, 'name' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'name' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'email' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'email' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'access_level' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'access_level' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'membership' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'membership' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'expire' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'expire' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'donatemoney' );
	echo '</td>
				<td>';
	echo $form->textField( $model, Yii::app(  )->params->money );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'activated' );
	echo '</td>
				<td>';
	echo $form->checkBox( $model, 'activated' );
	echo '</td>
			</tr>
			<tr>
				<td>';
	echo $form->label( $model, 'new_password' );
	echo '</td>
				<td>';
	echo $form->textField( $model, 'new_password' );
	echo '</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="button" name="yt0" value="Сохранить"></td>
			</tr>
		</table>
		';
	$this->endWidget(  );
	echo '	</div>
</div>

<div class="box">
	<div class="box_title">Список персонажей</div>
	<table class="table" frame="hsides vsides">
		<tr>
			<th>Имя</th>
			<th>Уровень</th>
			<th>Раса</th>
			<th>Класс</th>
			<th>Создан</th>
			<th>Был онлайн</th>
			<th>Онлайн</th>
		</tr>
		';
	foreach ($players as $data) {

		echo '		<tr>
			<td><a href="';
		echo Power::url( 'admin/player/edit', $data['id'] );
		echo '">';
		echo $data['name'];
		echo '</a></td>
			<td>';
		echo Info::lvl( $data['exp'] );
		echo '</td>
			<td>';
		echo Info::race( $data['race'] );
		echo '</td>
			<td>';
		echo Info::player_class( $data['player_class'] );
		echo '</td>
			<td>';
		echo Config::datetimetext( $data['creation_date'] );
		echo '</td>
			<td>';
		echo Config::datetimetext( $data['last_online'] );
		echo '</td>
			<td>';
		echo Info::online( $data['online'] );
		echo '</td>
		</tr>
		';
	}

	echo '	</table>
</div>';
?>