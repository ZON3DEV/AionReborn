<?php $this->setPageTitle('Информация о легионе '.$model['name']); ?>


<div class="note">
	<div class="note-title"><?php echo $this->pageTitle; ?></div>
	<div class="note-body">
		<table class="table tleft">
			<tr>
				<td width="300">Название</td>
				<td><?php echo $model['name']; ?></td>
			</tr>
			<tr>
				<td>Легат</td>
				<td><a href="<?php echo Power::url('player', $model['legat']); ?>"><?php echo $model['legat']; ?></a></td>
			</tr>
			<tr>
				<td>Раса</td>
				<td><?php echo Info::getRaceIco($model['race']); ?></td>
			</tr>
			<tr>
				<td>Уровень</td>
				<td><?php echo $model['level']; ?></td>
			</tr>
			<tr>
				<td>Очки</td>
				<td><?php echo $model['contribution_points']; ?></td>
			</tr>
			<tr>
				<td>Участников</td>
				<td><?php echo $model['members']; ?></td>
			</tr>
			<tr>
				<td>Дата создания</td>
				<td><?php echo Power::date($model['date']); ?></td>
			</tr>
		</table>
	</div>
</div>


<div class="note">
	<div class="note-title">
		Список персонажей легиона
	</div>
	<div class="note-body">
		<table class="table">
			<tr>
				<th>Имя</th>
				<th>Ранг</th>
				<th>Уровень</th>
				<th>Класс</th>
				<th>Статус</th>
			</tr>
			<?php foreach($players as $player): ?>
			<tr class="center">
				<td><a href="<?php echo Power::url('player', $player['name']); ?>"><?php echo $player['name']; ?></a></td>
				<td><?php echo Info::getLegionRankText($player['rank']); ?></td>
				<td><?php echo Info::getLevel($player['exp']); ?></td>
				<td><?php echo Info::getClassIco($player['player_class']) ?></td>
				<td><?php echo Info::getOnlineIco($player['online']); ?></td>
			</tr>
			<?php endforeach ?>
		</table>
		<div class="pages"><?php Config::pages(); ?></div>
	</div>
</div>