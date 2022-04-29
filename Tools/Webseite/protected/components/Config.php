<?php

	class Config extends Controller {
	
	public static $_config = null;
	
		public static function get($var) {
        
		if (!(self::$_config))
		{
			$model = Yii::app()->db->createCommand()->select("*")->from("settings")->queryRow();
			self::$_config = $model;
		}
		 else 
		{
			$model = self::$_config;
		}
		return $model[$var];
	}

		function db($id = NULL, $param = NULL) {
			if (isset( Yii::app(  )->$id )) {
				
				$connectionString = Yii::app(  )->$id->connectionString;
				
				$matches = explode( '=', $connectionString );

				if ($param == 'SAFE') {
					return '`' . $matches[3] . '`';
				}

				return $matches[3];
			}

		}

		function getServerType() {
			



				$model = Yii::app()->gs->cache( 86400 )->createCommand( 'SHOW COLUMNS FROM `abyss_rank` WHERE FIELD = "player_id"' )->execute(  );
				//self::$_serverType = $model;


			


			return 1;
		}

		function getMembershipType() {
			
			$query = Yii::app(  )->ls->createCommand( 'SHOW TABLES LIKE "account_membership"' )->execute(  );

			if ($query) {
				return 2;
			}

			return 1;
		}

		function getAccountMoneyType() {
			
			$query = Yii::app(  )->ls->createCommand( 'SHOW TABLES LIKE "account_tolls"' )->execute(  );

			if ($query) {
				return 2;
			}

			return 1;
		}

		function getWebRewardType() {
			return 1;
		}

		function column($str) {
			$column = array( 
							'item_id' => 'item_id', 
							'item_count' => 'item_count', 
							'item_pointer' => 'item_pointer', 
							'broker_race' => 'broker_race', 
							'expire_time' => 'expire_time', 
							'settle_time' => 'settle_time', 
							'seller_id' => 'seller_id', 
							'is_sold' => 'is_sold', 
							'is_settled' => 'is_settled', 
							'mob_id' => 'mob_id', 
							'item_unique_id' => 'item_unique_id', 
							'item_owner' => 'item_owner', 
							'is_equiped' => 'is_equiped', 
							'item_location' => 'item_location', 
							'item_creator' => 'item_creator', 
							'item_skin' => 'item_skin', 
							'fusioned_item' => 'fusioned_item', 
							'mail_unique_id' => 'mail_unique_id', 
							'mail_recipient_id' => 'mail_recipient_id', 
							'sender_name' => 'sender_name', 
							'mail_title' => 'mail_title', 
							'mail_message' => 'mail_message', 
							'attached_item_id' => 'attached_item_id', 
							'attached_kinah_count' => 'attached_kinah_count', 
							'daily_ap'=>'daily_ap',
							'daily_kill'=>'daily_kill',
							'weekly_ap'=>'weekly_ap',
							'weekly_kill'=>'weekly_kill',
							'all_kill'=>'all_kill',
							'npc_expands' => 'cube_size' );

			if (self::getservertype(  ) == 1) {
				return $column[$str];
			}

			return $str;
		}

		function captcha() {
			return array( 'captcha' => array( 'class' => 'CCaptchaAction', 'maxLength' => 4, 'minLength' => 4, 'foreColor' => 12303291, 'backColor' => 16777215, 'height' => 30, 'width' => 100, 'offset' => 5, 'fontFile' => Yii::app(  )->basePath . '/fonts/romic.ttf', 'testLimit' => 2 ) );
		}

		function pages() {
			
			$pagesize = Yii::app(  )->controller->pagination[0];
			$count = Yii::app(  )->controller->pagination[1];
			$pages = new CPagination ( $count );
			$pages->pageSize = $pagesize;
			$config = array( 'pages' => $pages, 'maxButtonCount' => 7, 'nextPageLabel' => '&rarr;', 'prevPageLabel' => '&larr;', 'firstPageLabel' => '&larr;|', 'lastPageLabel' => '|&rarr;', 'header' => false, 'cssFile' => false, 'internalPageCssClass' => false );
			return Yii::app(  )->controller->widget( 'CLinkPager', $config );
		}
		
		
	}

?>