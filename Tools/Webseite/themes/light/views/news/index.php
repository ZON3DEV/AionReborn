<?php foreach ($model as $data): ?>
<div class="note">

	<a class="note-category" href="<?php echo @Power::url('news/category', $data['category_alt_name']); ?>">
		<img src="<?php echo @Power::url('images/news', $data['image_id']); ?>" title="<?php echo $data['category_name']; ?>" />
	</a>
	<div class="note-title"><a href="<?php echo @Power::url('news', $data['id']); ?>"><?php echo $data['title']; ?></a></div>



	<div class="note-body">
		<div class="note-text"><?php echo nl2br($data['text_short']); ?></div>
		<a class="note-read" href="<?php echo @Power::url('news', $data['id']); ?>">Read more &#187;</a>
		<div class="note-date"><?php echo @Power::date($data['date'], 'd MMMM yyyy, HH:mm'); ?></div>
		<div class="clear"></div>
	</div>
</div>
<?php endforeach; ?>


<div class="pages">
	<?php @Config::pages(); ?>
</div>