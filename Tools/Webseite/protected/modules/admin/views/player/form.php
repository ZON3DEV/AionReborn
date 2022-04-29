<?php

	$this->setPageTitle( 'Редактирование персонажа ' . $model['name'] );
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
	echo $form->label( $model, 'name' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'name' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'account_id' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'account_id' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'account_name' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'account_name' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'exp' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'exp' );
	echo '</td>
				</tr>
				
				<tr>
					<td>';
	echo $form->label( $model, 'title_id' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'title_id', array( 'class' => 'w150' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'show_inventory' );
	echo '</td>
					<td>';
	echo $form->checkBox( $model, 'show_inventory' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'show_location' );
	echo '</td>
					<td>';
	echo $form->checkBox( $model, 'show_location' );
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
</div>';
?>