<?php

	class ReferralsController extends Controller {
		function actionIndex() {
			@Power::checkauth(  );


			$post = new ReferralsForm(  );
			$referralAccounts = Yii::app(  )->db->createCommand(  )->select( 'user_id, referral_id' )->from( 'log_referrals' )->where( 'user_id=:id AND status = "PENDING"', array( ':id' => @Power::userid(  ) ) )->queryAll(  );

            $referralsId = null;
			foreach ($referralAccounts as $data) {
				$referralsId .= $data['referral_id'] . ',';
			}


			$referralsId = substr( $referralsId, 0, 0 - 1 );
			$filter = array( 'name' => Config::get( 'referrals_filter_name' ), 'value' => Config::get( 'referrals_filter_value' ) );

			$bonusOwner = Config::get( 'referrals_bonus_owner' );

			$bonusReferral = Config::get( 'referrals_bonus_referral' );
			$filter['bonusOwner'] = $bonusOwner;
			$filter['bonusReferral'] = $bonusReferral;
			$referrals = array(  );

			if ($referralsId) {
				$players = Yii::app(  )->gs->createCommand(  )->select( 'p.id, p.name, p.account_id, MAX(exp) AS exp, race, player_class, creation_date, MAX(ar.ap) AS ap, MAX(ar.all_kill) AS all_kill, pow_user_id' )->from( 'players p' )->join( 'abyss_rank ar', 'ar.player_id = p.id' )->group( 'p.id' )->join( Config::db( 'ls' ) . '.account_data ad', 'p.account_id = ad.id' )->where( 'ad.pow_user_id IN (' . $referralsId . ')' )->order( 'pow_user_id ASC, ' . $filter['name'] . ' DESC' )->queryAll(  );

                foreach ($players as $data) {

					if (!isset( $referrals[$data['pow_user_id']] )) {
						$referrals[$data['pow_user_id']] = $data;
						continue;
					}
				}
			}


			if (isset( $_POST['ReferralsForm'] )) {
				$post->attributes = $_POST['ReferralsForm'];

				if ($post->validate(  )) {
					$checkReferral = Yii::app(  )->db->createCommand(  )->select( 'id' )->from( 'log_referrals' )->where( 'user_id=:uid AND referral_id=:rid AND status = "PENDING"', array( ':uid' => @Power::userid(  ), 'rid' => $post->pow_user_id ) )->queryRow(  );


                    if (!$checkReferral) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'referral_error (checkReferral)' ) . '</div>' );
						$this->refresh(  );
					}


					$checkType = Config::get( 'referrals_check_type' );
					$ownerAcc = Yii::app(  )->ls->createCommand(  )->select( 'id, name, ' . $checkType . ', pow_user_id' )->from( 'account_data' )->where( 'pow_user_id=:pow_user_id', array( ':pow_user_id' => @Power::userid(  ) ) )->queryAll(  );
					$referralAcc = Yii::app()->ls->createCommand(  )->select( 'id, name, ' . $checkType . ', pow_user_id' )->from( 'account_data' )->where( 'id=:id', array( ':id' => $post->account_id ) )->queryRow(  );

                    foreach ($ownerAcc as $data) {

						if (in_array( $referralAcc[$checkType], $data )) {
							$checkClone = 13;
							continue;
						}
					}


					if (isset( $checkClone )) {
						Yii::app(  )->db->createCommand(  )->update( 'log_referrals', array( 'status' => 'CLONE', 'completed' => time(  ) ), 'user_id=:oid AND referral_id=:rid', array( ':oid' => @Power::userid(  ), ':rid' => $post->pow_user_id ) );
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'referral_clone' ) . '</div>' );
						$this->refresh(  );
					}

					$checkFilter = Yii::app(  )->gs->createCommand(  )->select( 'p.id' )->from( 'players p' )->join( 'abyss_rank ar', 'ar.player_id = p.id' )->where( 'p.id = ' . $post->player_id . ' AND ' . $filter['name'] . ' >= ' . $filter['value'] )->queryRow(  );


                    if (!$checkFilter) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'referral_error (checkFilter)' ) . '</div>' );
						$this->refresh(  );
					}

					Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $bonusOwner . ' WHERE id = ' . @Power::userid(  ) )->execute(  );
					Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $bonusReferral . ' WHERE id = ' . $post->pow_user_id )->execute(  );
					Yii::app(  )->db->createCommand(  )->update( 'log_referrals', array( 'status' => 'SUCCESS', 'completed' => time(  ) ), 'user_id=:uid AND referral_id=:rid', array( ':uid' => @Power::userid(  ), ':rid' => $post->pow_user_id ) );
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'bonus_completed' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( '/referrals', array( 'post' => $post, 'referrals' => $referrals, 'filter' => $filter ) );
		}
	}

?>