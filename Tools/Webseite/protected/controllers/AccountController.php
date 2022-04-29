<?php

	class AccountController extends Controller {
		function actions() {
			return @Config::captcha(  );
		}

		function actionIndex() {
			@Power::checkauth(  );
			
			
			$post = new AccountForm(  );
			$post->scenario = 'new';
			$this->accountNew( $post );

			if (@Config::getmembershiptype(  ) == 1) {
				$accounts = Yii::app(  )->ls->createCommand(  )->select( 'id, name, access_level, membership, expire, last_ip, ' . @Config::get( 'money_column' ) . ' AS money' )->from( 'account_data' )->where( 'pow_user_id=:id', array( ':id' => @Power::userid(  ) ) )->queryAll(  );
			} 
			else {
				$accounts = Yii::app(  )->ls->createCommand(  )->select( 'ad.id, name, access_level, membership, membership_expire AS expire, last_ip, at.toll AS money' )->from( 'account_data ad' )->leftJoin( 'account_membership am', 'am.id = ad.id' )->leftJoin( 'account_tolls at', 'at.id = ad.id' )->where( 'pow_user_id=:id', array( ':id' => Power::userid(  ) ) )->queryAll(  );	
			}

			$players = Yii::app(  )->gs->createCommand(  )->select( 'p.id, p.name, account_name, exp, race, player_class, creation_date, show_location, show_inventory' )->from( 'players p' )->where( 'ad.pow_user_id=:id', array( ':id' => @Power::userid(  ) ) )->leftJoin( @Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->order( 'p.account_id' )->queryAll(  );
			
			$this->render( 'index', array( 'accounts' => $accounts, 'players' => $players, 'post' => $post ) );
		}

		function accountNew($post) {
			if (isset( $_POST['AccountForm'] )) {
				$post->attributes = $_POST['AccountForm'];

				if ($post->validate(  )) {
					$check = Yii::app(  )->ls->createCommand(  )->select( 'count(*) as count' )->from( 'account_data' )->where( 'name=:name', array( ':name' => $post->name ) )->queryRow(  );
					

					if (0 < $check['count']) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'login_already_taken' ) . '</div>' );
						Yii::app(  )->controller->refresh(  );
					}

					Yii::app(  )->ls->createCommand(  )->insert( 'account_data', array( 'name' => $post->name, 'password' => @Power::clienthash( $post->password ), 'pow_user_id' => @Power::userid(  ) ) );
					$accountId = Yii::app(  )->ls->getLastInsertID(  );
					

					if (Config::get( 'demo_membership_enable' ) == 1) {
						$membership = Yii::app(  )->db->createCommand(  )->select( '*' )->from( 'membership' )->where( 'id=:id', array( ':id' => Config::get( 'demo_membership_id' ) ) )->queryRow(  );
						$membershipType = @Config::getmembershiptype(  );

						if ($membershipType == 1) {
							$expire = date( 'Y-m-d', time(  ) + $membership['membership_duration'] * 3600 );
							Yii::app(  )->ls->createCommand(  )->update( 'account_data', array( 'membership' => $membership['membership_type'], 'expire' => $expire ), 'id=:id', array( ':id' => $accountId ) );
						} 
						else {
							Yii::app(  )->ls->createCommand(  )->insert( 'account_membership', array( 'id' => $accountId, 'membership' => $membership['membership_type'], 'membership_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['membership_duration'] * 3600 ), 'craftship' => $membership['craftship_type'], 'craftship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['craftship_duration'] * 3600 ), 'apship' => $membership['apship_type'], 'apship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['apship_duration'] * 3600 ), 'collectionship' => $membership['collectionship_type'], 'collectionship_expire' => date( 'Y-m-d, H:i:s', time(  ) + $membership['collectionship_duration'] * 3600 ) ) );
						}
					}

					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'account_created' ) . '</div>' );
					Yii::app(  )->controller->refresh(  );
				}
			}

		}

		function actionAdd() {
			@Power::checkauth();
			
			
			$post = new AccountForm();
			$post->scenario = 'add';

			if (isset( $_POST['AccountForm'] )) {
				$post->attributes = $_POST['AccountForm'];

				if ($post->validate(  )) {
					$model = Yii::app(  )->ls->createCommand(  )->select( 'id, name, pow_user_id' )->from( 'account_data' )->where( 'name=:name and password=:password', array( ':name' => $post->name, ':password' => @Power::clienthash( $post->password ) ) )->queryRow(  );
					
					if (( $model && $model['pow_user_id'] == 0 )) {
						Yii::app(  )->ls->createCommand(  )->update( 'account_data', array( 'pow_user_id' => @Power::userid(  ) ), 'id=:id', array( ':id' => $model['id'] ) );
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'account_added' ) . '</div>' );
						$this->refresh(  );
					} 
					else {
						if (( $model && $model['pow_user_id'] != 0 )) {
							Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'account_already_added' ) . '</div>' );
							$this->refresh(  );
						} 
						else {
							Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'account_not_found' ) . '</div>' );
							$this->refresh(  );
						}
					}
				}
			}

			$this->render( 'add', array( 'post' => $post ) );
		}

		function actionChangePassword() {
			@Power::checkauth(  );
			

			if (isset( $_POST['AccountForm'] )) {
				$post = @Power::checkajax(  );

				if (( ( ( empty( $post['passwordCurrent'] ) || empty( $post['passwordNew'] ) ) || empty( $post['passwordConfirm'] ) ) || empty( $post['accountId'] ) )) {
					echo '<div class="flash_error">' . Yii::t( 'data', 'fill_all_fields' ) . '</div>';
					return null;
				}


				if ($post['passwordNew'] != $post['passwordConfirm']) {
					echo '<div class="flash_error">' . Yii::t( 'data', 'passwords_not_match' ) . '</div>';
					return null;
				}

				Yii::app(  )->ls->createCommand(  )->select( 'password' )->from( 'account_data' )->where( 'id=:id AND pow_user_id=:pid', array( ':id' => $post['accountId'], ':pid' => @Power::userid(  ) ) )->queryRow(  );
				$model = $_POST['AccountForm'];

				if ($model['password'] != @Power::clienthash( $post['passwordCurrent'] )) {
					echo '<div class="flash_error">' . Yii::t( 'data', 'wrong_current_password' ) . '</div>';
					return null;
				}

				Yii::app(  )->ls->createCommand(  )->update( 'account_data', array( 'password' => @Power::clienthash( $post['passwordNew'] ) ), 'id=:id AND pow_user_id=:pid', array( ':id' => $post['accountId'], ':pid' => @Power::userid(  ) ) );
				echo '<div class="flash_success">' . Yii::t( 'data', 'password_changed' ) . '</div>';
			}

		}

		function actionResetPassword() {
			$id = (int)$_GET['id'];
			
			$accounts = @Power::getuseraccounts(  );

			if (!isset( $accounts[$id] )) {
				exit( 'account error' );
			}

			
			$newPassword = SHA1( uniqid(  ) );
			$newPassword = substr( $newPassword, 0, 8 );
			Yii::app(  )->ls->createCommand(  )->update( 'account_data', array( 'password' => @Power::clienthash( $newPassword ) ), 'id=:id AND pow_user_id=:pid', array( ':id' => $id, ':pid' => Power::userid(  ) ) );
			@Power::sendemail( @Power::useremail(  ), Yii::t( 'data', 'reset_password_email_title', array( '{site_name}' => Config::get( 'site_name' ) ) ), Yii::t( 'data', 'reset_password_email_message', array( '{site_url}' => @Power::url(  ), '{site_name}' => Config::get( 'site_name' ), '{new_password}' => $newPassword ) ) );
			Yii::app(  )->user->setFlash( 'title', Yii::t( 'data', 'reset_password_title' ) );
			Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'reset_password_message' ) );
			$this->redirect( @Power::url( 'message' ) );
		}

		function actionCharSettings() {
			@Power::checkauth(  );
			@Power::checkajax(  );
			$id = (int)substr( $_GET['status'], 1 );
			
			$type = $_GET['status'][0];

			if ($type == 'l') {
				$type = 'show_location';
			} 
			else {
				$type = 'show_inventory';
			}

			$check = Yii::app(  )->gs->createCommand(  )->select( 'p.id, show_location, show_inventory' )->from( 'players p' )->where( 'p.id=:id and account_id=ad.id', array( ':id' => $id ) )->join( Config::db( 'ls' ) . '.account_data ad', 'ad.pow_user_id = ' . @Power::userid(  ) )->queryRow(  );
			

			if ($check) {
				Yii::app(  )->gs->createCommand( 'UPDATE players SET ' . $type . ' = ABS(' . $type . ' - 1) WHERE id=' . $id )->execute(  );

				if ($check[$type] == 1) {
					$out['css'] = 'hide';
				} 
				else {
					if ($check[$type] == 0) {
						$out['css'] = 'show';
					}
				}

				echo json_encode( $out );
			}

		}
	}

?>