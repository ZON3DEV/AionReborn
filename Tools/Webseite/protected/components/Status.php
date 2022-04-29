<?php
	class Status extends Controller {
	
	public static $_online = null;
	
		function server($ip, $port) {
			if (@fsockopen( $ip, $port, $errno, $errstr, 3 )) {
				return 'online';
			}

			return 'offline';
		}
		function online($param = NULL) {
			if ($param == 'asmo') {
				$where = 'AND race = "ASMODIANS"';
			} 
			else {
				if ($param == 'ely') {
					$where = 'AND race = "ELYOS"';
				} 
			else {
					$where = null;
				}
			}

			
			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'COUNT(*) AS `' . $param . '`' )->from( 'players' )->where( 'online = 1 ' . $where )->queryRow(  );
			return $model[$param];
		}
		/* public function online($param = NULL) {

			if (self::$_online) {
				self::$model = $_online;
			} 
			else {
				
				$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'COUNT(*) AS `total`,
						(SELECT COUNT(*) FROM `players` WHERE online = 1) AS `total_online`,
						(SELECT COUNT(*) FROM `players` WHERE race = "ASMODIANS" AND online = 1) AS `online_asmo`,
						(SELECT COUNT(*) FROM `players` WHERE race = "ELYOS" AND online = 1) AS `online_ely`' )->from( 'players' )->queryRow(  );

				self::$_online = $model;
			}


			if ($param == 'asmo') {
				return $model['online_asmo'];
			}


			if ($param == 'ely') {
				return $model['online_ely'];
			}


			if ($param == 'all') {
				return $model['total_online'];
			}

			return $model;
		} */

		function accounts() {
			$model = Yii::app(  )->ls->createCommand(  )->select( 'count(*) as count' )->from( 'account_data' )->queryRow(  );
			return $model['count'];
		}
	}

?>