<?php $this->setPageTitle($model['title']); ?>

<div class="note">
	<div class="note-title"><?php echo $model['title']; ?></div>
	<div class="note-body">
		<?php echo htmlspecialchars_decode($model['text']); ?>
	</div>
</div>