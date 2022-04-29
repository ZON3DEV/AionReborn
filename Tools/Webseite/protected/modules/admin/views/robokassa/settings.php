<?php

	$this->setPageTitle( 'Set up Robokassa' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Set up Robokassa</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $model, 'mrh_login' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'mrh_login' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'mrh_pass1' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'mrh_pass1' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'mrh_pass2' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'mrh_pass2' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'inv_desc' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'inv_desc', array( 'class' => 'w500' ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( 'Save Settings', array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>