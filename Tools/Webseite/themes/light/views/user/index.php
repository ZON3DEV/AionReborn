<?php $this->setPageTitle('User '.$model['login']); ?>


<div class="note">
	<div class="note-title"></div>
	<div class="note-body">
		<table class="table tleft">
			<tr>
				<td rowspan="5" style="width: 80px; vertical-align:top;">
					<?php ($model['avatar_id']) ? $avatar = @Power::url('avatars', $model['avatar_id']) : $avatar = @Power::url('images/noavatar.png') ; ?>
					<img src="<?php echo $avatar; ?>" />
				</td>
				<td width="100px">Login: </td>
				<td><b><?php echo $model['login']; ?></b></td>
			</tr>
			<tr>
				<td>Group: </td>
				<td><?php echo @Info::getGroupIco($model['group_id']); ?></td>
			</tr>
			<tr>
				<td>Register Date: </td>
				<td><?php echo @Power::date($model['created'], 'd MMMM y, HH:mm'); ?></td>
			</tr>
			<tr>
				<td>Comments: </td>
				<td><?php echo $model['comments_count']; ?></td>
			</tr>
		</table>
	</div>
</div>


<div class="note">
	<div class="note-title">latest comments</div>
	<div class="note-body">
		<table class="table tleft">
			<tr>
				<th>News</th>
				<th width="150px">Date</th>
			</tr>
			<?php foreach ($comments as $data): ?>
			<tr>
				<td title="<?php echo $data['message']; ?>">
					<a href="<?php echo Power::url('news', $data['news_id']); ?>"><?php echo $data['title']; ?></a>
				</td>
				<td><?php echo Power::date($data['date'], 'd MMMM y, HH:mm'); ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>