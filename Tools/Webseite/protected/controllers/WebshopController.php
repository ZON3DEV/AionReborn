<?php

	class WebshopController extends Controller {
		function actionIndex() {
			@Power::checkauth(  );
			$model = Yii::app(  )->db->createCommand(  )->select( '*' )->from( 'webshop_category' )->queryAll(  );
			
			$this->render( 'index', array( 'model' => $model ) );
		}

		function actionView() {
			@Power::checkauth(  );
			
			$name = $_GET['name'];

			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
			else {
				$page = 0;
			}

			
			$pagesize = @Config::get( 'webshop_per_page' );
			$category = Yii::app(  )->db->createCommand(  )->select( 'name, id' )->from( 'webshop_category' )->where( 'url=:name', array( ':name' => $name ) )->queryRow(  );
			
			$count = Yii::app(  )->db->createCommand(  )->select( 'count(*) AS count' )->from( 'webshop' )->where( 'category_id=:id', array( ':id' => $category['id'] ) )->queryRow(  );
			
			$model = Yii::app(  )->db->createCommand(  )->select( 'item_id, quantity, price, change_quantity_enable' )->from( 'webshop' )->where( 'category_id=:id', array( ':id' => $category['id'] ) )->order( 'id DESC' )->limit( $pagesize )->offset( $page * $pagesize - $pagesize )->queryAll(  );
			
			@Power::checkmodel( $model );
			$playersDb = Yii::app(  )->gs->createCommand(  )->select( 'p.id, p.name, account_id, account_name' )->from( 'players p' )->where( 'ad.pow_user_id=:id', array( ':id' => @Power::userid(  ) ) )->leftJoin( @Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->order( 'p.account_id' )->queryAll(  );
			
			$players = array(  );
			$i = 0;

			while ($i < count( $playersDb )) {
				$players[$playersDb[$i]['account_name']][] = $playersDb[$i];
				++$i;
			}

			$this->setPageTitle( $category['name'] );
			$this->pagination = array( $pagesize, $count['count'] );
			$this->render( 'view', array( 'model' => $model, 'players' => $players ) );
		}

		function actionBuy() {
			
			@Power::checkauth(  );

			if (isset( $_POST['WebshopForm'] )) {
				$_POST['WebshopForm'];
				$post = @Power::checkajax(  );

				if ($post['playerId'] == 0) {
					Yii::app(  )->end( '<div class="flash_error">' . Yii::t( 'data', 'select_player' ) . '</div>' );
				}

				$webshop = Yii::app(  )->db->createCommand(  )->select( 'item_id, quantity, price' )->from( 'webshop' )->where( 'item_id=:id', array( ':id' => $post['itemId'] ) )->queryRow(  );
				

				if (isset( $post['itemCount'] )) {
					
					$itemCount = $post['itemCount'];
					$realPrice = ceil( $itemCount * ( $webshop['price'] / $webshop['quantity'] ) );
					
				} 
				else {
					
					$itemCount = $webshop['quantity'];
					
					$realPrice = $webshop['price'];
				}


				if ($realPrice <= 0) {
					exit( 'price error' );
				}


				if (@Power::usermoney(  ) < $realPrice) {
					Yii::app(  )->end( '<div class="flash_error">' . Yii::t( 'data', 'insufficient_funds' ) . '</div>' );
				}

				$player = Yii::app(  )->gs->createCommand(  )->select( 'id, account_id, online' )->from( 'players' )->where( 'id=:id', array( ':id' => $post['playerId'] ) )->queryRow(  );
				

				if ($player['online'] == 1) {
					Yii::app(  )->end( '<div class="flash_error">' . Yii::t( 'data', 'logout_game' ) . '</div>' );
				}


				if (@Config::getwebrewardtype(  ) === 2) {
				} 
				else {
					$lastId = Yii::app(  )->gs->createCommand(  )->select( 'MAX(' . @Config::column( 'mail_unique_id' ) . ') AS mail,
							(SELECT MAX(' . @Config::column( 'item_unique_id' ) . ') FROM inventory) AS item' )->from( 'mail' )->queryRow(  );
					
					$lastItemId = $lastId['item'] + 1;
					$lastMailId = $lastId['mail'] + 1;
				}


				if ($post['itemId'] == 182400001) {
					$attachedItemId = 622;
					
					$attachedKinahCount = $itemCount;
				} 
				else {
					$attachedItemId = $lastItemId;
					$attachedKinahCount = 622;
				}

				Yii::app(  )->gs->createCommand(  )->insert( 'inventory', array( @Config::column( 'item_unique_id' ) => $lastItemId, @Config::column( 'item_id' ) => $webshop['item_id'], @Config::column( 'item_count' ) => $itemCount, @Config::column( 'item_creator' ) => '', @Config::column( 'item_owner' ) => $player['id'], @Config::column( 'item_location' ) => 127, @Config::column( 'item_skin' ) => $webshop['item_id'] ) );
				Yii::app(  )->gs->createCommand(  )->insert( 'mail', array( @Config::column( 'mail_unique_id' ) => $lastMailId, @Config::column( 'mail_recipient_id' ) => $player['id'], @Config::column( 'sender_name' ) => '#Webshop#', @Config::column( 'mail_title' ) => Yii::t( 'data', 'webshop_mail_title' ), @Config::column( 'mail_message' ) => Yii::t( 'data', 'webshop_mail_message', array( '{id}' => $webshop['item_id'], '{count}' => $itemCount, '{price}' => $realPrice ) ), 'unread' => 1, @Config::column( 'attached_item_id' ) => $attachedItemId, @Config::column( 'attached_kinah_count' ) => $attachedKinahCount, 'express' => 1 ) );
				@Power::updatemoney( 0 - $realPrice );
				Yii::app(  )->db->createCommand(  )->insert( 'log_webshop', array( 'user_id' => @Power::userid(  ), 'player_id' => $player['id'], 'account_id' => $player['account_id'], 'item_id' => $webshop['item_id'], 'quantity' => $itemCount, 'price' => $realPrice, 'date' => time(  ) ) );
				Yii::app(  )->end( '<div class="flash_success">' . Yii::t( 'data', 'successfully_purchased' ) . '</div>' );
			}

		}

		function actionMembership() {
			@Power::checkauth(  );
			$model = Yii::app(  )->db->createCommand(  )->select( '*' )->from( 'membership' )->order( 'id DESC' )->queryAll(  );
			
			$this->render( 'membership', array( 'model' => $model ) );
		}

		function actionBuyMembership() {
			@Power::checkajax(  );
			@Power::checkauth(  );
			$membershipId = (int)$_POST['mid'];
			$accountId = (int)$_POST['aid'];
			
			$money = @Power::usermoney(  );
			$out = array(  );
			$membership = Yii::app(  )->db->createCommand(  )->select( '*' )->from( 'membership' )->where( 'id=:id', array( ':id' => $membershipId ) )->queryRow(  );
			

			if ($money < $membership['price']) {
				$out['status'] = 'error';
				$out['message'] = Yii::t( 'data', 'insufficient_funds' );
				exit( json_encode( $out ) );
			}

			
			$membershipType = @@Config::getmembershiptype(  );

			if ($membershipType == 1) {
				$account = Yii::app(  )->ls->createCommand(  )->select( 'membership, expire' )->from( 'account_data' )->where( 'id=:id', array( ':id' => $accountId ) )->queryRow(  );
				

				if (time(  ) < strtotime( $account['expire'] )) {
					$out['status'] = 'error';
					$out['message'] = Yii::t( 'data', 'membership_exist' );
					exit( json_encode( $out ) );
				}

				$expire = date( 'Y-m-d', time(  ) + $membership['membership_duration'] * 3600 );
				
				Yii::app(  )->ls->createCommand(  )->update( 'account_data', array( 'membership' => $membership['membership_type'], 'expire' => $expire ), 'id=:id', array( ':id' => $accountId ) );
			} 
			else {
				$account = Yii::app(  )->ls->createCommand(  )->select( '*' )->from( 'account_membership' )->where( 'id=:id', array( ':id' => $accountId ) )->queryRow(  );
				

				if (!$account) {
					Yii::app(  )->ls->createCommand(  )->insert( 'account_membership', array( 'id' => $accountId, 'membership' => $membership['membership_type'], 'membership_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['membership_duration'] * 3600 ), 'craftship' => $membership['craftship_type'], 'craftship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['craftship_duration'] * 3600 ), 'apship' => $membership['apship_type'], 'apship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['apship_duration'] * 3600 ), 'collectionship' => $membership['collectionship_type'], 'collectionship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['collectionship_duration'] * 3600 ) ) );
				} 
				else {
					if (( ( ( time(  ) < strtotime( $account['membership_expire'] ) || time(  ) < strtotime( $account['craftship_expire'] ) ) || time(  ) < strtotime( $account['apship_expire'] ) ) || time(  ) < strtotime( $account['collectionship_expire'] ) )) {
						$out['status'] = 'error';
						$out['message'] = Yii::t( 'data', 'membership_exist' );
						exit( json_encode( $out ) );
					}

					Yii::app(  )->ls->createCommand(  )->update( 'account_membership', array( 'membership' => $membership['membership_type'], 'membership_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['membership_duration'] * 3600 ), 'craftship' => $membership['craftship_type'], 'craftship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['craftship_duration'] * 3600 ), 'apship' => $membership['apship_type'], 'apship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['apship_duration'] * 3600 ), 'collectionship' => $membership['collectionship_type'], 'collectionship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['collectionship_duration'] * 3600 ) ), 'id=:id', array( ':id' => $accountId ) );
				}
			}

			@Power::updatemoney( 0 - $membership['price'] );
			Yii::app(  )->db->createCommand(  )->insert( 'log_membership', array( 'membership_id' => $membershipId, 'account_id' => $accountId, 'user_id' => @Power::userid(  ), 'date' => time(  ) ) );
			$out['status'] = 'success';
			$out['message'] = Yii::t( 'data', 'membership_activated' );
			exit( json_encode( $out ) );
		}
	}

?>