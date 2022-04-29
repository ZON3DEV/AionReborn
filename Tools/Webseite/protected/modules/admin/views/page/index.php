<?php

	$this->setPageTitle( 'Page list' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">';
	echo $this->getPageTitle(  );
	echo '</div>
		<div class="note-body">
			<table class="table">
				<tr>
					<th>Headline</th>
					<th>Address</th>
					<th width="100px">Operations</th>
				</tr>
				';
	foreach ($model as $data) {
		echo '				<tr>
					<td class="tleft"><a href="';
		echo @Power::url( 'page', $data['name'] );
		echo '">';
		echo $data['title'];
		echo '</a></td>
					<td>';
		echo $data['name'];
		echo '</td>
					<td>
						<a href="';
		echo @Power::url( 'admin/page/edit', $data['id'] );
		echo '" class="btn mr10" title="Edit"><i class="btn-edit"></i></a>
						';
		echo '<s';
		echo 'pan url="';
		echo @Power::url( 'admin/page/delete', $data['id'] );
		echo '" confirm="Удалить страницу" class="ajaxbutton" title="Удалить"><i class="btn-delete"></i></span>
					</td>
				</tr>
				';
	}

	echo '			</table>
			<div class="pages">';
	@Config::pages(  );
	echo '</div>
		</div>
	</div>
</div>';
?>