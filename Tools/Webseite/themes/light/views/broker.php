<?php $this->setPageTitle('Auction'); ?>

<div class="note">
	<div class="note-title">Auction</div>
	<div class="note-body">
		<table class="table">
			<tr>
				<th>Product</th>
				<th width="90px">Price</th>
				<th>Qty</th>
				<th width="90px">Seller</th>
				<th>Race</th>
				<th width="110px">Expires</th>
			</tr>
			<?php foreach ($model as $data) : ?>
			<tr class="center">
				<td><?php echo @Adb::url('item', $data['item_id'], 3); ?></td>
				<td><?php echo number_format($data['price'],0,' ',' '); ?></td>
				<td><?php echo $data['item_count']; ?></td>
				<td><a href="<?php echo @Power::url('player', $data['seller']); ?>"><?php echo $data['seller']; ?></a></td>
				<td><?php echo @Info::getRaceIco($data['broker_race']); ?></td>
				<td><?php echo @Power::date($data['expire_time'], 'd.MM.yyyy, HH:mm'); ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<div class="pages"><?php @Config::pages(); ?></div>
	</div>
</div>

