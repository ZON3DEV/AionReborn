<?php

	$this->setPageTitle( 'Quests' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">Quests</div>
		<div class="note-body">
			<table class="table">
				<tr>
					<th>Character</th>
					<th>Quest ID</th>
					<th>Walkthroughs</th>
				</tr>
				';
	foreach ($model as $data ) {

		
		echo '					<tr>
						<td><a href="';
		echo @Power::url( 'admin/player/edit', $data['player_id'] );
		echo '">';
		echo $data['name'];
		echo '</a></td>
						<td>';
		echo $data['quest_id'];
		echo '</td>
						<td>';
		echo $data['complete_count'];
		echo '</td>
					</tr>
				';
	}

	echo '			</table>
		</div>
	</div>
</div>';
?>