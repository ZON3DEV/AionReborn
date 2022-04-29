<?php
	$this->setPageTitle( 'Sending mail' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Sending mail</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $model, @Config::column( 'mail_title' ) );
	echo '</td>
					<td>';
	echo $form->textField( $model, @Config::column( 'mail_title' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'player_name' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'player_name' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'item_id' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'item_id' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'item_count' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'item_count' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, @Config::column( 'mail_message' ) );
	echo '</td>
					<td>';
	echo $form->textArea( $model, @Config::column( 'mail_message' ), array( 'rows' => 5, 'cols' => 52 ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( 'Submit', array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>