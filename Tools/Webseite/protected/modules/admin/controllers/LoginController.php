<?php


	class LoginController extends Controller {
		var $layout = false;

		function actions() {
			return array( 'captcha' => array( 'class' => 'CCaptchaAction', 'maxLength' => 4, 'minLength' => 4, 'foreColor' => 10066329, 'backColor' => 16579836, 'height' => 30, 'width' => 100, 'offset' => 5, 'fontFile' => Yii::app(  )->basePath . '/fonts/romic.ttf', 'testLimit' => 2 ) );
		}

		function actionIndex() {
			if (@Power::isadminlogin(  )) {
				$this->redirect( @Power::url( 'admin' ) );
			}



			$post = new LoginForm(  );

			if (isset( $_POST['LoginForm'] )) {
				$post->attributes = $_POST['LoginForm'];

				//$type = UserIdentity::('ADMIN');

				if (( $post->validate(  ) && $post->login(  ) )) {
					Yii::app(  )->session['adminLogin'] = 'TRUE';
					$this->redirect( @Power::url( 'admin' ) );
				}
			}

			$this->render( '/login', array( 'post' => $post ) );
		}
	}

?>