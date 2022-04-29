<div class="menu">
	<div class="menu-title">Новые сообщения на форуме</div>
	<div class="menu-body">
		<ul class="widget-topics">
			<?php foreach($model as $data): ?>
				<li>
					<div class="topics-title"><a href="http://msn/index.php?showtopic=<?php echo $data['tid']; ?>&view=getlastpost"><?php echo $data['title']; ?></a></div>
					<span class="topics-author"><?php echo $data['last_poster_name']; ?></span> - <span class="topics-date"><?php echo Power::date($data['last_post'], 'd MMMM yyyy, HH:mm'); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>