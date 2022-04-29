<?php

	$this->setPageTitle( 'Админцентр' );
	echo '

';
	echo '<s';
	echo 'cript type="text/javascript" src="';
	echo Power::url( 'js/highcharts-3.0.4/highcharts.js' );
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
				colors: [
					\'#c42525\',
					\'#2f7ed8\',
//					\'#8bbc21\',
//					\'#910000\',
//					\'#f28f43\',
//					\'#a6c96a\'
				],

				title: {
					text: null
				},

				xA';
	echo 'xis: {
					type: \'datetime\',
					labels: {
						overflow: \'justify\'
					}
				},

				yAxis: {
					title: {
						text: null
					},
					min: 0
				},

				tooltip: {
					crosshairs: true,
					shared: true
				},

				legend: {
					enabled: false
				},

				series: [
					{name: \'Пользователей\', data: data.users},
					//{name: \'Персонажей\', data: data.players}
			';
	echo '	]

			});
		});

	});


</script>


<div class="note-border">
	<div class="note">
		<div class="note-title">Регистрация пользователей</div>
		<div>
			<div id="stats" style="height: 300px;"></div>
		</div>
	</div>
</div>
';
?>