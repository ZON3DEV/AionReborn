<?php

	$this->pageTitle = 'Покупка привилегий';
	echo '
<div class="box">
	<div class="box_title">';
	echo $this->pageTitle;
	echo '</div>
	<table class="table" frame="hsides vsides">
		<tr>
			<th>Аккаунт</th>
			<th>Название</th>
			<th>Тип</th>
			<th>Длительность</th>
			<th>Цена</th>
			<th>Дата</th>
		</tr>
		';
	foreach ($model as $data) {

		echo '		<tr>
			<td><a href="';
		echo Power::url( 'admin/account/edit', $data['account_id'] );
		echo '">';
		echo $data['account_name'];
		echo '</a></td>
			<td>';
		echo $data['title'];
		echo '</td>
			<td>';
		echo $data['type'];
		echo '</td>
			<td>';
		echo $data['duration'];
		echo '</td>
			<td>';
		echo $data['price'];
		echo '</td>
			<td>';
		echo Config::datetime( $data['date'] );
		echo '</td>
		</tr>
		';
	}

	echo '	</table>
</div>

<div class="pages">
	';
	$this->widget( 'CLinkPager', Config::pages( $pages ) );
	echo '</div>';
?>