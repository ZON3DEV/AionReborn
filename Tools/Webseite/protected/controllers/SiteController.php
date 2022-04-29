<?php

	class SiteController extends Controller {
		function actionError() {
			$this->layout = NULL;
			
			$error = Yii::app(  )->errorHandler->error;

			if (Yii::app(  )->request->isAjaxRequest) {
				echo $error['message'];
				return null;
			}

			$this->render( '/error', array( 'error' => $error ) );
		}

		function actionMessage() {
			
			$title = Yii::app(  )->user->getFlash( 'title' );
			
			$message = Yii::app(  )->user->getFlash( 'message' );

			if (!$message) {
				
				$title = Yii::t( 'data', 'info' );
				
				$message = Yii::t( 'data', 'no_messages' );
				
				$cookieMessage = Yii::app(  )->request->cookies['pow_message'];

				if (isset( $cookieMessage )) {
					
					$message = $cookieMessage->value;
					//unset( Yii::app(  )->request->cookies[pow_message] );
				}
			}


			if (!$title) {
				
				$title = Yii::t( 'data', 'info' );
			}

			$this->render( '/message', array( 'title' => $title, 'message' => $message ) );
		}
	}

?>