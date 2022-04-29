<?php $this->setPageTitle('Character Information '.$player['name']); ?>


<?php if (@power::isAdmin()): ?>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			var oTable = $('#player-inventory').dataTable({
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": '<?php echo @power::url('player/getPlayerInventory', $player['id']); ?>',
				"bDeferRender": true,
				"bFilter": false,
				"bLengthChange": true,
				"fnServerData": function ( sSource, aoData, fnCallback ) {
					 $.getJSON( sSource, aoData, function (json) {
						fnCallback(json);
						aionLink();
					} );
				 },
				"sPaginationType": "full_numbers",
				'iDisplayLength': 10,
				"aoColumns": [{ "mData": "item_id" }, { "mData": "item_count" }, { "mData": "item_location" }],
				"oLanguage": {"sUrl": "<?php echo @power::url('js/datatables-1.9.4/ru.txt'); ?>"},
				"aoColumnDefs": [
					{"aTargets": [0], "mData": "inventory", "mRender": function (data, type, full) {return '<a class="aion-item-icon-large"><a href="http://aiondb.ru/items/'+data+'">'+data+'</a>';}}
				]
			});
			var oTable2 = $('#player-mail').dataTable({
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?php echo @power::url('player/getPlayerMail', $player['id']); ?>",
				"bDeferRender": true,
				"bFilter": false,
				"bLengthChange": true,
				"fnServerData": function ( sSource, aoData, fnCallback ) {
					$.getJSON( sSource, aoData, function (json) {
						fnCallback(json);
						tooltips();
					} );
				},
				"sPaginationType": "full_numbers",
				'iDisplayLength': 10,
				"aoColumns": [{"mData":"sender_name"}, {"mData":"mail_title"}, {"mData":"mail_message"}, {"mData":"item_id"},
					{"mData":"attached_kinah_count"}, {"mData":"express"}, {"mData":"recieved_time"}],
				"oLanguage": {"sUrl": "<?php echo @power::url('js/datatables-1.9.4/ru.txt'); ?>"},
				"aoColumnDefs": [
					{"aTargets": [0], "mData": "mail", "mRender": function (data, type, full) {return '<a href="<?php echo @power::url('player'); ?>'+data+'">'+data+'</a>';}},
					{"aTargets": [1], "mData": "mail", "mRender": function (data, type, full) {return '<img src="<?php echo @power::url('images/mail.png'); ?>" title="'+data+'" />';}},
					{"aTargets": [2], "mData": "mail", "mRender": function (data, type, full) {return '<img src="<?php echo @power::url('images/mail.png'); ?>" title="'+data+'" />';}},
					{"aTargets": [3], "mData": "mail", "mRender": function (data, type, full) {return '<a class="aion-item-icon-large"><a href="http://aiondb.ru/items/'+data+'">'+data+'</a>';}}
				]
			});
		});
	</script>
<?php endif; ?>


<div class="note">
	<div class="note-title"></div>
	<div class="note-body">
		<table class="table">
			<tr>
				<td rowspan="4" width="112px"><?php echo @Info::getRaceGenderIco($player['race'], $player['gender']); ?></td>
				<td width="250px"><b><?php echo $player['name']; ?></b></td>
				<td width="200px"></td>
				<td width="200px"><?php echo @Info::getLevel($player['exp']); ?> level</td>
			</tr>
			<tr>
				<td>Class: <?php echo @Info::getClassText($player['player_class']); ?></td>
				<td>AP: <?php echo number_format($player['ap'],0,' ',' '); ?></td>
				<td>HP: <?php echo $player['hp']; ?></td>
			</tr>
			<tr>
				<td>Race: <?php echo @Info::getRaceText($player['race']); ?></td>
				<td>Kills: <?php echo $player['all_kill']; ?></td>
				<td>MP: <?php echo $player['mp']; ?></td>
			</tr>
		</table>
	</div>
</div>		


<div class="note half mr20">
	<div class="note-title">Statistics</div>
	<div class="note-body">	
		<table class="table tleft">
			<tr>
				<td width="150px">Статус</td>
				<td><?php echo @Info::getOnlineIco($player['online']); ?></td>
			</tr>
			<tr>
				<td>Location</td>
				<td>
					<?php if ($player['show_location'] == 1 OR @power::isAdmin()): ?><?php echo @Adb::url('world', $player['world_id'], 2); ?>
					<?php else: ?>Is hidden<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td>Title</td>
				<td><?php echo @Adb::url('title', $player['title_id'], 2); ?></td>
			</tr>
			<tr>
				<td>Experience</td>
				<td><?php echo number_format($player['exp'], 0,' ',' '); ?></td>
			</tr>
			<tr>
				<td>AP</td>
				<td>
					<span title="За все время"><?php echo number_format($player['ap'], 0,' ',' '); ?></span> /
					<span title="За неделю "><?php echo number_format($player['weekly_ap'], 0,' ',' '); ?></span> /
					<span title="За прошлый день"><?php echo number_format($player['daily_ap'], 0,' ',' '); ?></span>
				<td>
			</tr>
			<tr>
				<td>Kills</td>
				<td title="Total / Weekly / Yesterday"><?php echo $player['all_kill']; ?> / <?php echo $player['weekly_kill']; ?> / <?php echo $player['daily_kill']; ?></td>
			</tr>
			<tr>
				<td>Rank</td>
				<td><?php echo @Info::getAbyssRankText($player['rank']); ?></td>
			</tr>
			<tr>
				<td>Legion</td>
				<td>
					<?php if ($player['legion_rank']): ?><a href="<?php echo @power::url('legion', $player['legion']); ?>"><?php echo $player['legion']; ?></a> (<?php echo @Info::getLegionRankText($player['legion_rank']); ?>)
					<?php else: ?>Not a member of the legion<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td>date of creation</td>
				<td><?php echo Yii::app()->dateFormatter->format('dd.MM.y, HH:mm:ss', $player['creation_date']); ?></td>
			</tr>
			<tr>
				<td>last visit</td>
				<td><?php echo Yii::app()->dateFormatter->format('dd.MM.y, HH:mm:ss', $player['last_online']); ?></td>
			</tr>
		</table>
	</div>
</div>

<div class="note half">
	<div class="note-title">Equipment</div>
	<div class="note-body">
			<?php if ($player['show_inventory'] == 1 OR @power::isAdmin()): ?>
				<div class="equip">
					<?php foreach ($equip as $data) echo @Info::equip($data['item_id'], $data['slot']); ?>
				</div>
			<?php else: ?>User hide inventory<?php endif; ?>
		<div class="clear"></div>
	</div>
</div>
<div class="clear"></div>


<?php if (@power::isAdmin()): ?>
	<div class="note">
		<div class="note-title">Player Inventory</div>
		<div class="note-body">
			<table id="player-inventory" class="table">
				<thead>
					<tr>
						<th>Item</th>
						<th width="100px">Qty</th>
						<th width="150px">Located</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>

<?php if (@power::isAdmin()): ?>
	<div class="note">
		<div class="note-title">Player Mail</div>
		<div class="note-body">
			<table id="player-mail" class="table">
				<thead>
					<tr>
						<th>Sender</th>
						<th>Theme</th>
						<th>Message</th>
						<th>Thing</th>
						<th>Kinah</th>
						<th>Express</th>
						<th>Received</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
<?php endif; ?>