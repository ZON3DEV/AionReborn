<?php

	class InterkassaController extends Controller {
		function actionGetSign() {
			if (Power::isajax(  )) {
				
				$model = Yii::app(  )->db->createCommand(  )->select( 'secret_key' )->from( 'settings_interkassa' )->queryRow(  );
				$dataSet = $model;
				array_pop( $dataSet );
				ksort( $dataSet, SORT_STRING );
				array_push( $dataSet, $model['secret_key'] );
				implode( ':', $dataSet );
				$signString = $_GET;
				$out['sign'] = base64_encode( hash( 'sha256', $signString, true ) );
				echo json_encode( $out );
			}

		}

		function actionAction() {
			if (!$_GET) {
				exit(  );
			}

			$model = $_GET;
			
			$_GET['ik_inv_id'];
			$_GET['ik_pm_no'];
			$_GET['ik_am'];
			$ik_am = $ik_inv_id = Yii::app(  )->db->createCommand(  )->select( 'ik_co_id, ik_desc, secret_key, test_key' )->from( 'settings_interkassa' )->queryRow(  );
			$_GET['ik_inv_crt'];
			$ik_inv_crt = $ik_pm_no = $data = ;

			if (( isset( $_GET['ik_pw_via'] ) && $_GET['ik_pw_via'] === 'test_interkassa_test_xts' )) {
				$model['test_key'];
				$secretKey = ;
			} 
			else {
				
				$secretKey = $model['secret_key'];
			}

			unset( $data[ik_sign] );
			ksort( $data, SORT_STRING );
			array_push( $data, $secretKey );
			
			$signString = implode( ':', $data );
			
			$sign = base64_encode( hash( 'sha256', $signString, true ) );

			if (( $_GET['ik_inv_st'] === 'success' && $_GET['ik_sign'] === $sign )) {
				Yii::app(  )->db->createCommand(  )->insert( 'log_payments', array( 'payment_id' => $ik_inv_id, 'system' => 'INTERKASSA', 'user_id' => $ik_pm_no, 'sum' => $ik_am, 'status' => 'SUCCESS', 'date' => strtotime( $ik_inv_crt ) ) );
				Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $ik_am . ' WHERE id = ' . $ik_pm_no )->execute(  );
				exit( 'ok' );
				return null;
			}

			exit( 'wrong signature' );
		}

		function actionSuccess() {
			
			$sum = $_GET['ik_am'];
			Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'payment_successful' ) . '</div>' );
			$this->redirect( Power::url( 'balance' ) );
		}

		function actionFail() {
			Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'payment_canceled' ) . '</div>' );
			$this->redirect( Power::url( 'balance' ) );
		}
	}

?>