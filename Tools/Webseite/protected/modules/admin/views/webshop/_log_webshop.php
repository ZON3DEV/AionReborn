<?php

	$this->pageTitle = 'Purchase Items';
	echo '
<div class="box">
	<div class="box_title">';
	echo $this->pageTitle;
	echo '</div>
	<table class="table" frame="hsides vsides">
		<tr>
			<th>Items</th>
			<th>Character</th>
			<th>Account</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Date</th>
		</tr>
		';
	foreach ($model as $data) {
		echo '		<tr>
			<td class="tleft"><a class="aion-icon-text" href="http://aiona.net/item/';
		echo $data['item_id'];
		echo '">';
		echo $data['item_id'];
		echo '</a></td>
			<td><a href="';
		echo Power::url( 'admin/player/edit', $data['player_id'] );
		echo '">';
		echo $data['player_name'];
		echo '</a></td>
			<td><a href="';
		echo Power::url( 'admin/account/edit', $data['account_id'] );
		echo '">';
		echo $data['account_name'];
		echo '</a></td>
			<td>';
		echo $data['amount'];
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