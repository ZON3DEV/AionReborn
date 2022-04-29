<?php
	($model->isNewRecord ? $this->setPageTitle( 'Adding a Page' ) : $this->setPageTitle( 'Page editing' ));
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
		selector: "#Pages_text",
		width : 806,
		height : 400,
		language_url : \'';
	echo @Power::url( 'js/tinymce/langs/id.js' );
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
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td width="150px">';
	echo $form->label( $model, 'title' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'title', array( 'size' => 64, 'maxlength' => 128 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'name' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'name', array( 'size' => 32, 'maxlength' => 128 ) );
	echo '</td>
				</tr>
				<tr>
					<td class="w0">
						<div class="form-label">';
	echo $form->label( $model, 'text' );
	echo '</div>
						';
	echo CHtml::activetextarea( $model, 'text' );
	echo '					</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'description' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'description', array( 'size' => 64, 'maxlength' => 255 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $model, 'keywords' );
	echo '</td>
					<td>';
	echo $form->textField( $model, 'keywords', array( 'size' => 64, 'maxlength' => 255 ) );
	echo '</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( ($model->isNewRecord ? 'Добавить страницу' : 'Сохранить изменения'), array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>';
?>