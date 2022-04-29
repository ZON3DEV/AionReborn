<?php
	$this->setPageTitle( 'Adding stuff' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Adding stuff</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td width="300px">';
	echo $form->label( $model, 'item_id' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'item_id' );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'category_id' );
	echo '</td>
					<td>';
	echo $form->dropDownList( $model, 'category_id', CHtml::listdata( @WebshopCategory::getcategories(  ), 'id', 'name' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'quantity' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'quantity', array( 'class' => 'w150' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'change_quantity_enable' );
	echo '</td>
					<td>';
	echo $form->checkBox( $model, 'change_quantity_enable' );
	echo '</td>
					<td><i class="ml10 btn-question" title="Allow users to change the amount of goods when buying in web shop.<br />The price will be calculated automatically from the calculation of the current price to the quantity."></i></td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'price' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'price', array( 'class' => 'w150' ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( ($model->isNewRecord ? 'Add' : 'Save changes'), array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>