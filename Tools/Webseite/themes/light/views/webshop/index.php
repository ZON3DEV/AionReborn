<?php $this->setPageTitle('Marketplace'); ?>


<div class="note">
	<div class="note-title">Marketplace</div>
	<div class="note-body">
		<div class="webshop-category">
			<a href="<?php echo @Power::url('webshop/membership'); ?>">
				<div class="webshop-category-ico"><img src="<?php echo @Power::url('images/webshop/membership.png'); ?>" /></div>
				<div class="webshop-category-name">Premium accounts</div>
			</a>
		</div>
		<?php foreach ($model as $data): ?>
			<div class="webshop-category">
				<a href="<?php echo @Power::url('webshop', $data['url']); ?>">
					<div class="webshop-category-ico"><img src="<?php echo @Power::url('images/webshop', $data['image_id']); ?>" /></div>
					<div class="webshop-category-name"><?php echo $data['name']; ?></div>
				</a>
			</div>
		<?php endforeach; ?>
		<div class="clear"></div>
	</div>
</div>