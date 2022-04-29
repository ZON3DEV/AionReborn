<?php

	class ApiController extends Controller {
		function actionServerStatus() {
			
			$model = Yii::app(  )->cache->get( 'serverStatus' );

			if ($model === FALSE) {
				$out = array( 'login' => Status::server( Yii::app(  )->params['lsIp'], Yii::app(  )->params['lsPort'] ), 'game' => Status::server( Yii::app(  )->params['gsIp'], Yii::app(  )->params['gsPort'] ) );
				Yii::app(  )->cache->set( 'serverStatus', $model, 60 );
			}

			exit( json_encode( $out ) );
		}

		function actionOnline() {
			
			$model = Status::online(  );
			exit( json_encode( $model ) );
		}
	}

?>