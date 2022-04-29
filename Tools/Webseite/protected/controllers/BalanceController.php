<?php

	class BalanceController extends Controller {
		function actionIndex() {
			@Power::checkauth(  );
			$payments = Yii::app(  )->db->createCommand(  )->select( 'SUM(sum) AS sum, count(*) AS count' )->from( 'log_payments' )->where( 'user_id=:uid AND status="SUCCESS"', array( ':uid' => @Power::userid(  ) ) )->queryRow(  );
			
			$balance = array( 'total' => $payments['sum'], 'payments' => $payments['count'], 'current' => @Power::usermoney(  ) );
			
			$post = new TransferPointsForm(  );

			if (isset( $_POST['TransferPointsForm'] )) {
				self::sendpoints( $post );
			}

			$retrieve = new RetrievePointsForm(  );

			if (isset( $_POST['RetrievePointsForm'] )) {
				self::retrievepoints( $retrieve );
			}

			$this->render( '/balance', array( 'balance' => $balance, 'post' => $post, 'retrieve' => $retrieve ) );
		}

		function sendPoints($post) {
			$post->attributes = $_POST['TransferPointsForm'];
			$post->sender = @Power::userid(  );

			if ($post->validate(  )) {
				if ($post->type === 'USER') {
					$recipient = Yii::app(  )->db->createCommand(  )->select( 'id' )->from( 'users' )->where( 'login=:login', array( ':login' => $post->recipient_user ) )->queryRow(  );
					

					if (!$recipient) {
						Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_error">' . Yii::t( 'data', 'user_not_found' ) . '</div>' );
						$this->refresh(  );
					}


					if (@Power::usermoney(  ) < $post->sum) {
						Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_error">' . Yii::t( 'data', 'insufficient_funds' ) . '</div>' );
						$this->refresh(  );
					}

					
					$recipient['id'];
					$recipientId = @Power::updatemoney( $post->sum, $recipient['id'] );
				} 
				else {
					if ($post->type === 'ACCOUNT') {
						$checkOnline = Yii::app(  )->gs->createCommand(  )->select( 'count(*) AS count' )->from( 'players p' )->where( 'p.account_id=:aid AND online = 1', array( ':aid' => $post->recipient_account ) )->queryAll(  );

						if (0 < $checkOnline[0]['count']) {
							Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_error">' . Yii::t( 'data', 'logout_game' ) . '</div>' );
							$this->refresh(  );
						}


						if (@Power::usermoney(  ) < $post->sum) {
							Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_error">' . Yii::t( 'data', 'insufficient_funds' ) . '</div>' );
							$this->refresh(  );
						}


						if (Config::getaccountmoneytype(  ) == 2) {
							$account = Yii::app(  )->ls->createCommand(  )->select( '*' )->from( 'account_tolls' )->where( 'id=:id', array( ':id' => $post->recipient_account ) )->queryRow(  );
							

							if (!$account) {
								Yii::app(  )->ls->createCommand(  )->insert( 'account_tolls', array( 'id' => $post->recipient_account, 'toll' => $post->sum ) );
							} 
							else {
								Yii::app(  )->ls->createCommand( 'UPDATE account_tolls SET toll = toll + ' . $post->sum . ' WHERE id = ' . $post->recipient_account )->execute(  );
							}
						} 
						else {
							$moneyColumn = Config::get( 'money_column' );
							Yii::app(  )->ls->createCommand( 'UPDATE account_data SET ' . $moneyColumn . ' = ' . $moneyColumn . ' + ' . $post->sum . ' WHERE id = ' . $post->recipient_account )->execute(  );
						}
						$recipientId = $post->recipient_account;
					}
				}

				@Power::updatemoney( 0 - $post->sum );
				Yii::app(  )->db->createCommand(  )->insert( 'log_transfer_points', array( 'sender_id' => @Power::userid(  ), 'recipient_id' => $recipientId, 'type' => $post->type, 'sum' => $post->sum, 'date' => time(  ) ) );
				Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_success">' . Yii::t( 'data', 'points_transferred' ) . '</div>' );
				$this->refresh();
			}

		}

		function retrievePoints($retrieve) {
			$retrieve->attributes = $_POST['RetrievePointsForm'];
			
			$moneyColumn = Config::get( 'money_column' );

			if ($retrieve->validate(  )) {
				if (Config::getaccountmoneytype(  ) == 2) {
					$account = Yii::app(  )->ls->createCommand(  )->select( 'toll AS money' )->from( 'account_tolls' )->where( 'id=:id', array( ':id' => $retrieve->accountId ) )->queryRow(  );
				} 
				else {
					$account = Yii::app(  )->ls->createCommand(  )->select( $moneyColumn . ' AS money' )->from( 'account_data' )->where( 'id=:id', array( ':id' => $retrieve->accountId ) )->queryRow(  );
					
				}


				if ($account['money'] < $retrieve->sum) {
					Yii::app(  )->user->setFlash( 'message-retrieve', '<div class="flash_error">' . Yii::t( 'data', 'insufficient_funds' ) . '</div>' );
					$this->refresh(  );
				}

				$checkOnline = Yii::app(  )->gs->createCommand(  )->select( 'count(*) AS count' )->from( 'players p' )->where( 'p.account_id=:aid AND online = 1', array( ':aid' => $retrieve->accountId ) )->queryAll(  );
				

				if (0 < $checkOnline[0]['count']) {
					Yii::app(  )->user->setFlash( 'message-transfer', '<div class="flash_error">' . Yii::t( 'data', 'logout_game' ) . '</div>' );
					$this->refresh(  );
				}


				if (Config::getaccountmoneytype(  ) == 2) {
					Yii::app(  )->ls->createCommand( 'UPDATE account_tolls SET toll = toll - ' . $retrieve->sum . ' WHERE id = ' . $retrieve->accountId )->execute(  );
				} 
				else {
					Yii::app(  )->ls->createCommand( 'UPDATE account_data SET ' . $moneyColumn . ' = ' . $moneyColumn . ' - ' . $retrieve->sum . ' WHERE id = ' . $retrieve->accountId )->execute(  );
				}

				@Power::updatemoney( $retrieve->sum );
				Yii::app(  )->user->setFlash( 'message-retrieve', '<div class="flash_success">' . Yii::t( 'data', 'points_transferred' ) . '</div>' );
				$this->refresh(  );
			}

		}
	}

?>