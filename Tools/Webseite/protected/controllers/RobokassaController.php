<?php

	class RobokassaController extends Controller {
		function actionGetSign() {
			if (Power::isajax(  )) {
				$model = Yii::app(  )->db->createCommand(  )->select( 'mrh_login, mrh_pass1, inv_desc' )->from( 'settings_robokassa' )->queryRow(  );
				$outSum = $_GET['out_sum'];
				$invId = null;
				$shpAccount = Power::userid(  );
				$out['sign'] = md5( $model['mrh_login'] . ':' . $outSum . ':' . $invId . ':' . $model['mrh_pass1'] . ':Shp_account=' . $shpAccount );
				echo json_encode( $out );
			}

		}

		function actionAction() {
			if (!$_GET) {
				exit(  );
			}

			$settings = Yii::app(  )->db->createCommand(  )->select( 'mrh_pass2' )->from( 'settings_robokassa' )->queryRow(  );
			$outSum = $_GET['OutSum'];
			$invId = $_GET['InvId'];
			$shpAccount = $_GET['Shp_account'];
			$stateDate = $_GET['StateDate'];
			$crc = $_GET['SignatureValue'];
			$crc = strtoupper( $crc );
			$myCrc = strtoupper( md5( '' . $outSum . ':' . $invId . ':' . $settings['mrh_pass2'] . ':Shp_account=' . $shpAccount ) );
			

			if ($myCrc == $crc) {
				Yii::app(  )->db->createCommand(  )->insert( 'log_auth', array( 'payment_id' => $invId, 'system' => 'ROBOKASSA', 'user_id' => $shpAccount, 'sum' => $outSum, 'status' => 'SUCCESS', 'date' => strtotime( $stateDate ) ) );
				Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $outSum . ' WHERE id = ' . $shpAccount )->execute(  );
				exit( 'ok' );
				return null;
			}

			exit( 'wrong signature' );
		}

		function actionSuccess() {
			Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', ' payment_successful' ) . '</div>' );
			$this->redirect( Power::url( 'balance' ) );
		}

		function actionFail() {
			Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'payment_canceled' ) . '</div>' );
			$this->redirect( Power::url( 'balance' ) );
		}
	}

?>