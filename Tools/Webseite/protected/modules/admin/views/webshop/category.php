<?php

	$this->setPageTitle( 'Category Management' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/jquery.ddslick.min.js' );
	echo '"></script>
';
	echo '<s';
	echo 'cript>
	$(\'document\').ready(function(){
		$(\'#backgroundImageDropdown\').ddslick({
			data: ';
	echo @WebshopCategory::geticons(  );
	echo ',
			width: 140,
			height: 362,
			imagePosition:"left",
			onSelected: function(data){
				var img = data.selectedData.imageSrc;
				var name = img.split(\'/\');
				name = name[name.length-1];
				$(\'#WebshopCategory_image_id\').val(name);
			}
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Editing Categories';
	echo '</div>
		<div class="note-body">
			';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $post );
	echo @Power::message(  );
	echo '			<table class="form">
				<tr>
					<td>';
	echo $form->label( $post, 'name' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'name', array( 'size' => 32, 'maxlength' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'url' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'url', array( 'size' => 32, 'maxlength' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'image_id' );
	echo '</td>
					<td>
						<div id="backgroundImageDropdown"></div>
						';
	echo $form->hiddenField( $post, 'image_id' );
	echo '					</td>
				</tr>
				<tr>
					<td></td>
					<td>';
	echo CHtml::submitbutton( ($post->isNewRecord ? 'Add category' : 'Save changes'), array( 'class' => 'button' ) );
	echo '</td>
				</tr>
			</table>
			';
	$this->endWidget(  );
	echo '		</div>
	</div>
</div>


<div class="note-border">
	<div class="note">
		<div class="note-title">Category List</div>
		<div class="note-body">
			<table class="table">
				<tr>
					<th width="200px">Title</th>
					<th width="200px">Address</th>
					<th width="200px">Picture</th>
					<th width="200px">Operations</th>
				</tr>
				';
	foreach ($model as $data) {
		echo '				<tr>
					<td>';
		echo $data['name'];
		echo '</td>
					<td><a href="';
		echo @Power::url( 'webshop', $data['url'] );
		echo '">';
		echo $data['url'];
		echo '</a></td>
					<td><img src="';
		echo @Power::url( 'images/webshop', $data['image_id'] );
		echo '" width="32px" height="32px" /></td>
					<td>
						<a href="';
		echo @Power::url( 'admin/webshop/category', $data['id'] );
		echo '" class="btn mr10" title="Edit"><i class="btn-edit"></i></a>
						';
		echo '<s';
		echo 'pan url="';
		echo @Power::url( 'admin/webshop/categorydelete', $data['id'] );
		echo '" confirm="Delete category" class="ajaxbutton" title="Delete"><i class="btn-delete"></i></span>
					</td>
				</tr>
				';
	}

	echo '			</table>
		</div>
	</div>
</div>';
?>