<?php

	class PlayerController extends Controller {
		function actions() {
			return @Config::captcha(  );
		}

		function actionView() {
			
			$name = $_GET['name'];
			$player = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'p.id, p.name, exp, gender, race, player_class, online, world_id, title_id, creation_date, last_online, show_location, show_inventory,
				' . @Config::column( 'daily_ap' ) . ', ' . @Config::column( 'daily_kill' ) . ', ' . @Config::column( 'weekly_ap' ) . ', ap, ' . @Config::column( 'weekly_kill' ) . ', ' . @Config::column( 'all_kill' ) . ', a.rank,
				hp, mp, l.name AS legion, lm.rank AS legion_rank' )->from( 'players p' )->leftJoin( 'abyss_rank a', 'a.player_id=p.id' )->leftJoin( 'player_life_stats ls', 'ls.player_id=p.id' )->leftJoin( 'legion_members lm', 'lm.player_id = p.id' )->leftJoin( 'legions l', 'l.id=lm.legion_id' )->where( 'p.name=:name', array( ':name' => $name ) )->queryRow(  );
			
			@power::checkmodel( $player );
			$equip = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( @Config::column( 'item_id' ) . ' AS item_id, slot' )->from( 'inventory' )->where( @Config::column( 'item_owner' ) . ' = ' . $player['id'] . ' AND ' . @Config::column( 'is_equiped' ) . ' = 1' )->queryAll(  );
			
			$this->render( 'view', array( 'player' => $player, 'equip' => $equip ) );
		}

		function actionGetPlayerInventory() {
			
			$id = $_GET['id'];
			$aColumns = array( 'item_id', 'item_count', 'item_location' );

			if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
				$limit = (int)$_GET['iDisplayLength'];
				$offset = (int)$_GET['iDisplayStart'];
			}

			$order = '';

			if (isset( $_GET['iSortCol_0'] )) {
				$i = 0;

				while ($i < intval( $_GET['iSortingCols'] )) {
					if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
						$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
					}

					++$i;
				}

				
				$order = substr_replace( $order, '', 0 - 2 );
			}

			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( @Config::column( 'item_id' ) . ' AS item_id, ' . @Config::column( 'item_count' ) . ' AS item_count, ' . @Config::column( 'item_location' ) . ' AS item_location,
					(SELECT COUNT(*) FROM `inventory` WHERE ' . @Config::column( 'item_owner' ) . ' = ' . $id . ' AND ' . @Config::column( 'is_equiped' ) . ' = 0) AS `count`' )->from( 'inventory' )->where( @Config::column( 'item_owner' ) . ' = ' . $id . ' AND ' . @Config::column( 'is_equiped' ) . ' = 0' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
			
			$i = 0;
			foreach ($model as $data) {
				$model[$i]['item_location'] = Info::getitemlocationtext( $data['item_location'] );
				++$i;
			}

			
			(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
			$out['iTotalRecords'] = $count;
			$out['iTotalDisplayRecords'] = $count;
			$out['aaData'] = $model;
			exit( json_encode( $out ) );
		}

		function actionGetPlayerMail() {
			
			$id = $_GET['id'];
			$aColumns = array( 'sender_name', 'mail_title', 'mail_message', 'attached_item_id', 'attached_kinah_count', 'express', 'recieved_time', 'item_id' );

			if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
				$limit = (int)$_GET['iDisplayLength'];
				$offset = (int)$_GET['iDisplayStart'];
			}

			$order = '';

			if (isset( $_GET['iSortCol_0'] )) {
				$i = 0;

				while ($i < intval( $_GET['iSortingCols'] )) {
					if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
						$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
					}

					++$i;
				}

				$order = substr_replace( $order, '', 0 - 2 );
				
			}

			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( @Config::column( 'sender_name' ) . ' AS sender_name, ' . @Config::column( 'mail_title' ) . ' AS mail_title, ' . @Config::column( 'mail_message' ) . ' AS mail_message,
				' . @Config::column( 'attached_item_id' ) . ' AS attached_item_id, ' . @Config::column( 'attached_kinah_count' ) . ' AS attached_kinah_count, express,
				' . @Config::column( 'recieved_time' ) . ' AS recieved_time, ' . @Config::column( 'item_id' ) . ' AS item_id,
				(SELECT COUNT(*) FROM `mail` WHERE ' . @Config::column( 'mail_recipient_id' ) . ' = ' . $id . ') AS `count`' )->from( 'mail m' )->where( @Config::column( 'mail_recipient_id' ) . ' = ' . $id )->leftJoin( 'inventory i', 'm.' . @Config::column( 'attached_item_id' ) . '=i.' . @Config::column( 'item_unique_id' ) )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
			
			$i = 0;

			while ($i < count( $model )) {
				$model[$i]['express'] = Info::getmailtypeico( $model[$i]['express'] );
				$model[$i]['recieved_time'] = @power::date( $model[$i]['recieved_time'], 'yyyy.MM.dd, HH:mm' );
				++$i;
			}

			(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
			$out['iTotalRecords'] = $count;
			$out['iTotalDisplayRecords'] = $count;
			$out['aaData'] = $model;
			exit( json_encode( $out ) );
		}

		function actionSearch() {
			
			
			$post = new SearchForm();
			$post->scenario = 'player';
			$model = array();

			if (isset( $_POST['SearchForm'] )) {
				$post->attributes = $_POST['SearchForm'];

				if ($post->validate(  )) {
					$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'name, exp, gender, race, player_class, online' )->from( 'players p' )->where( array( 'like', 'name', '%' . $post['name'] . '%' ) )->queryAll(  );

					if (!$model) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'nothing_found' ) . '</div>' );
					}
				}
			}

			$this->render( 'search', array( 'model' => $model, 'post' => $post ) );
		}
	}

?>