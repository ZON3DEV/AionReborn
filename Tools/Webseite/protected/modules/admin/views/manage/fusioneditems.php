<?php

	$this->setPageTitle( 'List Of Double Items' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">List of double items</div>
		<div class="note-body">
			<table class="table">
				<tr>
					<th>Character</th>
					<th>Unique ID</th>
					<th>Item ID</th>
					<th>Duplicate</th>
					<th width="100px">Delete</th>
				</tr>
				';
	foreach ($model as $data) {
		echo '					<tr>
						<td><a href="';
		echo @Power::url( 'admin/player/edit', $data['item_owner'] );
		echo '">';
		echo $data['name'];
		echo '</a></td>
						<td>';
		echo $data['item_unique_id'];
		echo '</td>
						<td>';
		echo $data['item_id'];
		echo '</td>
						<td>';
		echo $data['fusioned_item'];
		echo '</td>
						<td>';
		echo '<s';
		echo 'pan url="';
		echo @Power::url( 'admin/manage/deleteitem', $data['item_unique_id'] );
		echo '" confirm="Delete item" class="ajaxbutton" title="Delete"><i class="btn-delete"></i></span></td>
					</tr>
				';
	}

	echo '			</table>
		</div>
	</div>
</div>';
?>