<?php
	($model->isNewRecord ? $this->setPageTitle( 'Adding News' ) : $this->setPageTitle( 'Editing News' ));
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/tinymce/tinymce.min.js' );
	echo '"></script>
';
	echo '<s';
	echo 'cript type="text/javascript">
	tinymce.init({
		selector: "#News_text_short, #News_text_full",
		width : 806,
		height : 300,
		language_url : \'';
	echo @Power::url( 'js/tinymce/langs/en.js' );
	echo '\',
		plugins: [
			"advlist autolink lists link image charmap print preview anchor textcolor",
			"searchreplace visualblocks code fullscreen",
			"insertdatetime media table contextmenu paste"
		],
		toolbar: "insertfile undo redo | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist | hr link image media | fullscreen code preview"
	});
</script>


<di';
	echo 'v class="note-border">
	<div class="note">
		<div class="note-title">';
	echo $this->getPageTitle(  );
	echo '</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $model );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $model, 'title' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'title', array( 'maxlength' => 128, 'class' => 'w500' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'category_id' );
	echo '</td>
					<td>';
	echo $form->dropDownList( $model, 'category_id', CHtml::listdata( @NewsCategory::getcategories(  ), 'id', 'name' ) );
	echo '</td>
				</tr>
				<tr>
					<td class="w0">
						<div class="form-label">';
	echo $form->label( $model, 'text_short' );
	echo '</div>
						';
	echo CHtml::activetextarea( $model, 'text_short' );
	echo '					</td>
				</tr>
				<tr>
					<td class="w0">
						<div class="form-label">';
	echo $form->label( $model, 'text_full' );
	echo '</div>
						';
	echo CHtml::activetextarea( $model, 'text_full' );
	echo '					</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'comments_enable' );
	echo '</td>
					<td>';
	echo $form->dropDownList( $model, 'comments_enable', array( 1 => 'On', 0 => 'Off' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'description' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'description', array( 'maxlength' => 255, 'class' => 'w500' ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'keywords' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'keywords', array( 'maxlength' => 255, 'class' => 'w500' ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( ($model->isNewRecord ? 'Add news' : 'Save changes'), array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>