<?php

	$this->setPageTitle( 'Сообщение' );
	echo '

<div class="note-border">
	<div class="note">
		<div class="note-title">';
	echo $title;
	echo '</div>
		<div class="note-body">';
	echo $message;
	echo '</div>
	</div>
</div>';
?>