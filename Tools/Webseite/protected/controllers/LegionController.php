<?php

	class LegionController extends Controller {
		function actionView() {
			
			$name = $_GET['name'];
			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'l.id, l.name, contribution_points, level, date, p.name AS legat, race,
					(SELECT COUNT(*) FROM legion_members WHERE legion_id = l.id) AS members,
					(SELECT COUNT(*) FROM `legion_members` WHERE `legion_id` = l.id) AS `count`' )->from( 'legions l' )->where( 'l.name=:name', array( ':name' => $name ) )->leftJoin( 'legion_history h', 'h.legion_id = l.id AND history_type = "CREATE"' )->leftJoin( 'legion_members m', 'm.legion_id = l.id AND m.rank = "BRIGADE_GENERAL"' )->leftJoin( 'players p', 'p.id = m.player_id' )->queryRow(  );
			
			Power::checkmodel( $model );

			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
			else {
				$page = 0;
			}

			$pagesize = 390;
			$players = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'rank, name, race, exp, player_class, online' )->from( 'legion_members m' )->leftJoin( 'players p', 'm.player_id=p.id' )->where( 'legion_id = ' . $model['id'] )->order( 'FIELD(rank, "BRIGADE_GENERAL", "CENTURION", "LEGIONARY"), exp DESC' )->limit( $pagesize )->offset( $page * $pagesize - $pagesize )->queryAll(  );
			
			$this->pagination = array( $pagesize, $model['count'] );
			$this->render( '/legion', array( 'model' => $model, 'players' => $players ) );
		}
	}

?>