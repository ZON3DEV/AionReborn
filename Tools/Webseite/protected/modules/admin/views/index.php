<?php

	$this->setPageTitle( 'Administrator' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo @Power::url( 'js/highcharts-3.0.4/highcharts.js' );
	echo '"></script>
';
	echo '<s';
	echo 'cript>
	$(function () {
		$.getJSON(\'http://power/admin/default/stats/\', function(data) {
			$(\'#stats\').highcharts({
				chart: {
					type: \'line\',
					zoomType: \'x\',
					borderRadius: 3
				},
				credits: {enabled: false},
				colors: [\'#2f7ed8\'],
				title: {text: \'User Registration\'},
				xAxis: {
					type: \'datetime\',
					labels: {overflow: \'justify\'}
			';
	echo '	},
				yAxis: {
					title: {text: null},
					min: 0
				},
				tooltip: {
					crosshairs: true,
					shared: true
				},
				legend: {enabled: false},
				series: [{name: \'Users\', data: data.users}]
			});
		});

	});
</script>


<div class="note-border">
	<div class="note">
		<div class="note-body">
			<div class="center">
				<div class="note-button">
					<a href="';
	echo @Power::url( 'admin/news' );
	echo '"><img src="';
	echo @Power::url( 'themes/admin/newspaper.png' );
	echo '" />news</a>
					';
	echo '<s';
	echo 'pan class="note-button-count">';
	echo $counts['news_count'];
	echo '				</div>
				<div class="note-button">
					<a href="';
	echo @Power::url( 'admin/page' );
	echo '"><img src="';
	echo @Power::url( 'themes/admin/document_image.png' );
	echo '" />Pages</a>
					';
	echo '<s';
	echo 'pan class="note-button-count">';
	echo $counts['pages_count'];
	echo '				</div>
				<div class="note-button">
					<a href="';
	echo @Power::url( 'admin/user' );
	echo '"><img src="';
	echo @Power::url( 'themes/admin/crown_gold.png' );
	echo '" />Users</a>
					';
	echo '<s';
	echo 'pan class="note-button-count">';
	echo $counts['users_count'];
	echo '				</div>
				<div class="note-button">
					<a href="';
	echo @Power::url( 'admin/account' );
	echo '"><img src="';
	echo @Power::url( 'themes/admin/user_suit.png' );
	echo '" />Accounts</a>
					';
	echo '<s';
	echo 'pan class="note-button-count">';
	echo $counts['accounts_count'];
	echo '				</div>
				<div class="note-button">
					<a href="';
	echo @Power::url( 'admin/player' );
	echo '"><img src="';
	echo @Power::url( 'themes/admin/user_gray.png' );
	echo '" />Characters</a>
					';
	echo '<s';
	echo 'pan class="note-button-count">';
	echo $counts['players_count'];
	echo '				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>


<div class="note-border">
	<div class="note">
		<div id="stats" style="height: 300px;"></div>
	</div>
</div>


<div class="note-border" style="display: block; width: 404px; float: left;">
	<div class="note" style="display: block; width: 404px;">
		<div class="note-title">Authorization logs</div>
		<div class="note-body">
			<ta';
	echo 'ble class="table">
				<tr>
					<th>Login</th>
					<th>IP</th>
					<th width="50px">Status</th>
					<th width="120px">Date</th>
				</tr>
				';
	foreach ($auth as $data) {
		echo '				<tr>
					<td>';
		echo $data['login'];
		echo '</td>
					<td>';
		echo $data['ip_address'];
		echo '</td>
					<td>';
		echo Info::getauthstatusico( $data['status'] );
		echo '</td>
					<td>';
		echo @Power::date( $data['date'], 'dd MMM, HH:mm' );
		echo '</td>
				</tr>
				';
	}

	echo '			</table>

		</div>
	</div>
</div>


<div class="note-border" style="display: block; width: 404px; float: right;">
	<div class="note" style="display: block; width: 404px;">
		<div class="note-title">New comments</div>
		<div class="note-body">
			<table class="table">
				';
	foreach ($comments as $data) {
		echo '				<!--<tr>
					<td>';
		echo $data['login'];
		echo '</td>
					<td><img src="';
		echo @Power::url( 'images/news.png' );
		echo '" title="';
		echo $data['title'];
		echo '" /></td>
					<td><img src="';
		echo @Power::url( 'images/mail.png' );
		echo '" title="';
		echo $data['message'];
		echo '" /></td>
					<td>';
		echo @Power::date( $data['date'], 'dd MMM, HH:mm' );
		echo '</td>
				</tr>-->
				<tr class="tleft">
					<td title="<b>';
		echo $data['login'];
		echo ':</b> ';
		echo $data['message'];
		echo '">
						<a href="';
		echo @Power::url( 'news', $data['news_id'] );
		echo '">';
		echo @Power::trim( $data['title'], 55 );
		echo '</a>
					</td>
				</tr>
				';
	}

	echo '			</table>
		</div>
	</div>
</div>


<div class="clear"></div>';
?>