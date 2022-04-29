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
	echo @NewsCategory::geticons(  );
	echo ',
			width: 72,
			height: 265,
			imagePosition:"left",
			onSelected: function(data){
				var img = data.selectedData.imageSrc;
				var name = img.split(\'/\');
				name = name[name.length-1];
				$(\'#NewsCategory_image_id\').val(name);
			}
		});
	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Editing Categories </div';
	echo '>
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
	echo $form->label( $post, 'alt_name' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'alt_name', array( 'size' => 32, 'maxlength' => 32 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'title' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'title', array( 'size' => 64, 'maxlength' => 128 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'image_id' );
	echo '</td>
					<td>
						';
	echo '						<div id="backgroundImageDropdown"></div>
						';
	echo $form->hiddenField( $post, 'image_id' );
	echo '					</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'description' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'description', array( 'size' => 64, 'maxlength' => 255 ) );
	echo '</td>
				</tr>
				<tr>
					<td>';
	echo $form->label( $post, 'keywords' );
	echo '</td>
					<td>';
	echo $form->textField( $post, 'keywords', array( 'size' => 64, 'maxlength' => 255 ) );
	echo '</td>
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
					<th>Title</th>
					<th>Address</th>
					<th width="50px">Picture</th>
					<th>Headline</th>
					<th width="80px">Operations</th>
				</tr>
				';
	foreach ($model as $data) {
		echo '				<tr>
					<td>';
		echo $data['name'];
		echo '</td>
					<td><a href="';
		echo @Power::url( 'news/category', $data['alt_name'] );
		echo '">';
		echo $data['alt_name'];
		echo '</a></td>
					<td>
						';
		($data['image_id'] ? $title = '<img src=' . @Power::url( 'images/news', $data['image_id'] ) . ' />' : $title = 'No picture');
		echo '						<i class="btn-image" title="';
		echo $title;
		echo '"></i>
					</td>
					<td>';
		echo $data['title'];
		echo '</td>
					<td>
						<a href="';
		echo @Power::url( 'admin/news/category', $data['id'] );
		echo '" class="btn mr10" title="Edit"><i class="btn-edit"></i></a>
						';
		echo '<s';
		echo 'pan url="';
		echo @Power::url( 'admin/news/categorydelete', $data['id'] );
		echo '" confirm="Delete category" class="ajaxbutton" title="Delete"><i class="btn-delete"></i></span>
					</td>
				</tr>
				';
	}

	echo '			</table>
		</div>
	</div>
</div>
';
?>