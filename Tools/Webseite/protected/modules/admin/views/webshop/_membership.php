<?php

	$this->setPageTitle( 'Управление привилегиями' );
	echo '


membership
membership_expire

craftship
craftship_expire

apship
apship_expire

collectionship
collectionship_expire



<div class="box">
	<div class="box_title">';
	echo $this->pageTitle;
	echo '</div>
	<table class="table" frame="hsides vsides">
		<tr>
			<th>Название</th>
			<th>Тип</th>
			<th>Длительность</th>
			<th>Цена</th>
			<th width="100px">Операции</th>
		</tr>
		';
	foreach ($model as $data) {

		echo '		<tr>
			<td><a href="#" class="editable" id="';
		echo $data['id'] . 'b';
		echo '" data-pk="';
		echo $data['id'];
		echo '" data-name="title">';
		echo $data['title'];
		echo '</a></td>
			<td><a href="#" class="editable" id="';
		echo $data['id'] . 'c';
		echo '" data-pk="';
		echo $data['id'];
		echo '" data-name="type">';
		echo $data['type'];
		echo '</a></td>
			<td><a href="#" class="editable" id="';
		echo $data['id'] . 'd';
		echo '" data-pk="';
		echo $data['id'];
		echo '" data-name="duration">';
		echo $data['duration'];
		echo '</a></td>
			<td><a href="#" class="editable" id="';
		echo $data['id'] . 'e';
		echo '" data-pk="';
		echo $data['id'];
		echo '" data-name="price">';
		echo $data['price'];
		echo '</a></td>
			<td><a href="';
		echo Power::url( 'admin/webshop/mdelete', $data['id'] );
		echo '" class="btn" title="Удалить"><i class="pow-cross"></i></a></td>
		</tr>
		';
	}

	echo '		';
	
	$form = $this->beginWidget( 'CActiveForm' );
	echo $form->errorSummary( $post );
	echo Power::message(  );
	echo '		<tr>
			<td>';
	echo $form->textField( $post, 'title' );
	echo '</td>
			<td>';
	echo $form->textField( $post, 'type' );
	echo '</td>
			<td>';
	echo $form->textField( $post, 'duration' );
	echo '</td>
			<td>';
	echo $form->textField( $post, 'price' );
	echo '</td>
			<td>';
	echo CHtml::submitbutton( 'Добавить', array( 'class' => 'button' ) );
	echo '</td>
		</tr>
		';
	$this->endWidget(  );
	echo '	</table>
</div>';
?>