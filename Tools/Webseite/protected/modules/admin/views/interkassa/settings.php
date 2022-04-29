<?php

	$this->setPageTitle( 'Настройка Интеркассы' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Настройка Интеркассы</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $model, 'ik_co_id' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'ik_co_id' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'secret_key' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'secret_key' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'test_key' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'test_key' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'ik_desc' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'ik_desc', array( 'class' => 'w500' ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( 'Сохранить настройки', array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>