<?php

	echo '<ul class="widget-admin">
	';
	foreach ($model as $data) {

		echo '		<li>
			<a href="';
		echo Power::url( 'admin/user/edit', $data['id'] );
		echo '">
				';
		Power::url( 'images/noavatar.png' );
		($data['avatar_id'] ? $avatar =  : $avatar = );
		echo '				<img src="';
		echo $avatar;
		echo '" class="widget-admin-avatar" />
				';
		echo $data['login'];
		echo '			</a>
		</li>
	';
	}

	echo '</ul>';
?>