<?php

	$this->pageTitle = 'Legion Settings ' . $model['name'];
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Legion Settings</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo Power::message(  );
	echo '			<table class="form">
				<tr>
					<td width="200px">';
	echo $form->label( $model, 'name' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'name' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'level' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'level', array( 'class' => 'w150' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'contribution_points' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'contribution_points' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'legat_new' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'legat_new' );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" class="button" name="yt0" value="Save"></td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>