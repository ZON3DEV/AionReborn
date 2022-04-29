<?php

	$this->setPageTitle( 'Редактирование пользователя ' . $model['login'] );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">';
	echo $this->getPageTitle(  );
	echo '</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $model, 'login' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'login', array( 'size' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'email' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'email', array( 'size' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'group_id' );
	echo '</td>
					<td>';
	echo $form->dropDownList( $model, 'group_id', array( '1' => 'Пользователь', '8' => 'Администратор' ) );
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
	echo $form->label( $model, 'money' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'money', array( 'size' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'password_new' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'password_new', array( 'size' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" class="button" name="yt0" value="Сохранить"></td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>


<div class="note-border">
	<div class="note">
		<div class="note-title">Список игровых аккаунтов</div>
		<div class="note-body">
			<table class="table">
			<tr>
				<th>Аккаунт</th>
				<th>Группа</th>
				<th>Последний IP</th>
				<th>Баланс</th>
			</tr>
			';
	foreach ($accounts as $data) {
		echo '			<tr>
				<td><a href="';
		echo Power::url( 'admin/account/edit', $data['id'] );
		echo '">';
		echo $data['name'];
		echo '</a></td>
				<td>';
		echo Info::getaccesslevelico( $data['access_level'] );
		echo '</td>
				<td>';
		echo $data['last_ip'];
		echo '</td>
				<td>';
		echo $data['money'];
		echo '</td>
			</tr>
			';
	}

	echo '		</table>
		</div>
	</div>
</div>
';
?>