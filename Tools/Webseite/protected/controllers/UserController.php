<?php

	class UserController extends Controller {
		function actions() {
			return @Config::captcha(  );
		}

		function actionIndex() {
			@Power::checkauth(  );
			$model = Yii::app(  )->db->createCommand(  )->select( 'id, login, email, group_id, avatar_id, created, money, 
					(SELECT count(*) FROM news_comment WHERE user_id = ' . @Power::userid(  ) . ') AS comments_count' )->from( 'users' )->where( 'id = :id', array( ':id' => @Power::userid(  ) ) )->queryRow(  );
			
			$comments = Yii::app(  )->db->createCommand(  )->select( 'news_id, message, c.date, n.title' )->from( 'news_comment c' )->where( 'c.user_id=:uid', array( ':uid' => @Power::userid(  ) ) )->leftJoin( 'news n', 'c.news_id=n.id' )->limit( 15 )->queryAll(  );
			
			$this->render( 'index', array( 'model' => $model, 'comments' => $comments ) );
		}

		function actionLogout() {
			@Power::checkauth(  );
			Yii::app(  )->user->logout(  );
			$this->redirect( @Power::url(  ) );
		}

		function actionRegistration() {
			@Power::checkguest(  );
			
			
			$post = new Users();
			$post->scenario = 'registration';

			if (isset( $_GET['id'] )) {
				$cookie = new CHttpCookie( 'pow_referrals', $_GET['id'] );
				$cookie->expire = time(  ) + 60 * 60 * 24;
				Yii::app(  )->request->cookies['pow_referrals'] = $cookie;
			}


			if (Config::get( 'user_registration_limit' ) == 1) {
				if (( isset( Yii::app(  )->request->cookies['pow_reg_limit']->value ) && Yii::app(  )->request->cookies['pow_reg_limit']->value == $_SERVER['REMOTE_ADDR'] )) {
					Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'reg_limit_forbidden' ) );
					$this->redirect( @Power::url( 'message' ) );
				}
			}


			if (isset( $_POST['Users'] )) {
				$post->attributes = $_POST['Users'];

				if ($post->validate(  )) {
					if (Config::get( 'email_activation_enable' ) == 1) {
						$activated = 0;
						$code = @Power::uid(  );
						$link = '<a href="' . @Power::url( 'user/activation', $code ) . '">' . @Power::url( 'user/activation', $code ) . '</a>';
						@Power::sendemail( $post->email, Yii::t( 'data', 'activation_email_title', array( '{site_name}' => Config::get( 'site_name' ) ) ), Yii::t( 'data', 'activation_email_message', array( '{site_url}' => @Power::url(  ), '{site_name}' => Config::get( 'site_name' ), '{link}' => $link ) ) );
						Yii::app(  )->user->setFlash( 'title', Yii::t( 'data', 'registration_complete' ) );
						Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'activation_message', array( '{email}' => $post->email ) ) );
					} 
					else {
						$code = null;
						$activated = 1;
						Yii::app(  )->user->setFlash( 'title', Yii::t( 'data', 'registration complete' ) );
						Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'account created' ) );
					}

					$post->group_id = 1;
					$post->avatar_id = 0;
					$post->ip_address = $_SERVER['REMOTE_ADDR'];
					$post->activated = $activated;
					$post->code = $code;
					$post->created = time(  );
					$post->save( FALSE );

					if (Config::get( 'user_registration_limit' ) == 1) {
						
						
						$cookie = new CHttpCookie( 'pow_reg_limit', $_SERVER['REMOTE_ADDR'] );
						$cookie->expire = time() + 60 * 60 * 24;
						Yii::app()->request->cookies['pow_reg_limit'] = $cookie;
					}


					if (( isset( Yii::app(  )->request->cookies['pow_referrals']->value ) && Config::get( 'referrals_enable' ) == 1 )) {
						Yii::app(  )->db->createCommand(  )->insert( 'log_referrals', array( 'user_id' => Yii::app(  )->request->cookies['pow_referrals']->value, 'referral_id' => $post->id, 'status' => 'PENDING', 'created' => time(  ) ) );
						unset( Yii::app(  )->request->cookies[pow_referrals] );
					}

					$this->redirect( @Power::url( 'message' ) );
				}
			}

			$this->render( 'registration', array( 'post' => $post ) );
		}

		function actionLogin() {
			@Power::checkguest(  );
			
			
			$model = new LoginForm(  );
			$model->scenario = 'page';

			if (( isset( $_POST['ajax'] ) && $_POST['ajax'] === 'login-form' )) {
				echo CActiveForm::validate( $model );
				Yii::app(  )->end(  );
			}


			if (isset( $_POST['LoginForm'] )) {
				$model->attributes = $_POST['LoginForm'];

				if (( $model->validate(  ) && $model->login(  ) )) {
					$this->redirect( @Power::url(  ) );
				}
			}

			$this->render( 'login', array( 'model' => $model ) );
		}

		function actionActivation() {
			@Power::checkguest(  );

			if (isset( $_GET['name'] )) {
				$code = $_GET['name'];
				
				$model = Yii::app(  )->db->createCommand(  )->select( 'id' )->from( 'users' )->where( 'code=:code', array( ':code' => $code ) )->queryRow(  );
				

				if ($model) {
					Yii::app(  )->db->createCommand(  )->update( 'users', array( 'activated' => 1, 'code' => NULL ), 'id=:id', array( ':id' => $model['id'] ) );
					$title = Yii::t( 'data', 'account_activated' );
					$message = Yii::t( 'data', 'activation_success' );
					$this->render( '/message', array( 'title' => $title, 'message' => $message ) );
					return null;
				}

				
				throw new CHttpException( 404, 'The requested page does not exist.' );
				return null;
			}

			
			
			$post = new Users( 'activation' );

			if (isset( $_POST['Users'] )) {
				$post->attributes = $_POST['Users'];

				if ($post->validate(  )) {
					
					$model = Yii::app(  )->db->createCommand(  )->select( 'id, login, email, activated' )->from( 'users' )->where( 'login=:login', array( ':login' => $post->login ) )->queryRow(  );

					if ($model['activated'] == 1) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'account_already_activated' ) . '</div>' );
						$this->refresh(  );
					}

					
					$code = @Power::uid(  );
					$link = '<a href="' . @Power::url( 'user/activation', $code ) . '">' . @Power::url( 'user/activation', $code ) . '</a>';
					Yii::app(  )->db->createCommand(  )->update( 'users', array( 'code' => $code ), 'id=:id', array( ':id' => $model['id'] ) );
					@Power::sendemail( $model['email'], Yii::t( 'data', 'activation_email_title', array( '{site_name}' => Config::get( 'site_name' ) ) ), Yii::t( 'data', 'activation_email_message', array( '{site_url}' => @Power::url(  ), '{site_name}' => Config::get( 'site_name' ), '{link}' => $link ) ) );
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'activation_resend', array( '{email}' => $model['email'] ) ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'activation', array( 'post' => $post ) );
		}

		function actionResetPassword() {
			@Power::checkguest(  );
			
			
			$post = new Users(  );
			$post->setScenario( 'resetpassword' );

			if (isset( $_POST['Users'] )) {
				$post->attributes = $_POST['Users'];

				if ($post->validate(  )) {
					$code = Power::uid(  );
					
					$model = Yii::app(  )->db->createCommand(  )->update( 'users', array( 'code' => $code ), 'login=:login', array( ':login' => $post->login ) );
					$model['email'];
					$address = Yii::app(  )->db->createCommand(  )->select( 'email' )->from( 'users' )->where( 'login=:login', array( ':login' => $post->login ) )->queryRow(  );
					$subject =Yii::t( 'data', 'restore_email_title', array( '{site_name}' => Yii::app(  )->name ) );
					$link = '<a href="' . Power::url( 'user/changepassword', $code ) . '">' . Power::url( 'user/changepassword', $code ) . '</a>';
					$message = Yii::t( 'data', 'restore_email_message', array( '{site_url}' => Power::url(  ), '{site_name}' => Config::get( 'site_name' ), '{link}' => $link ) );
					@Power::sendemail( $address, $subject, $message );
					Yii::app(  )->user->setFlash( 'title', Yii::t( 'data', 'restore_password' ) );
					Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'restore_message' ) );
					$this->redirect( @Power::url( 'message' ) );
				}
			}

			$this->render( 'resetpassword', array( 'post' => $post ) );
		}

		function actionChangePassword() {
			@Power::checkguest(  );

			if (isset( $_GET['code'] )) {
				
				$code = $_GET['code'];
			} 
			else {
				exit(  );
			}

			$model = Yii::app(  )->db->createCommand(  )->select( 'id' )->from( 'users' )->where( 'code=:code', array( ':code' => $code ) )->queryRow(  );
			

			if ($model) {
				exit(  );
			}

			
			
			$post = new Users(  );
			$post->setScenario( 'changepassword' );

			if (isset( $_POST['Users'] )) {
				$post->attributes = $_POST['Users'];

				if ($post->validate(  )) {
					Yii::app(  )->db->createCommand(  )->update( 'users', array( 'password' => CPasswordHelper::hashpassword( $post->password_new ), 'code' => NULL ), 'id=:id', array( ':id' => $model['id'] ) );
					Yii::app(  )->user->setFlash( 'title', Yii::t( 'data', 'password_changed' ) );
					Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'changed_message' ) );
					$this->redirect( @Power::url( 'message' ) );
				}
			}

			$this->render( 'changepassword', array( 'post' => $post ) );
		}

		function actionSettings() {
			@Power::checkauth(  );
			
			$post = Users::model(  )->findByPk( @Power::userid() );
			$post->scenario = 'settings';

			if (isset( $_POST['Users'] )) {
				$post->attributes = $_POST['Users'];

				if ($post->validate(  )) {
					if (CPasswordHelper::verifypassword( $post->password_current, $post->password )) {
						if (!empty( $post->password_new )) {
							$post->password = CPasswordHelper::hashpassword( $post->password_new );
							$post->save(  );
							$message = Yii::t( 'data', 'password_changed' ) . ' ' . Yii::t( 'data', 'changed_message' );
							$cookie = new CHttpCookie( 'pow_message', $message );
							Yii::app(  )->request->cookies['pow_message'] = $cookie;
							Yii::app(  )->db->createCommand( 'DELETE FROM session WHERE data LIKE \'%|s:3:"' . @Power::username(  ) . '";%\' ' )->execute(  );
							Yii::app(  )->user->logout(  );
							$this->redirect( @Power::url( 'message' ) );
						}


						if (!empty( $_FILES['Users']['size']['image'] )) {
							$image = $_FILES['Users'];
							$filename = @Power::userid(  ) . '.png';

							if (!in_array( $image['type']['image'], array( 'image/jpeg', 'image/png', 'image/gif' ) )) {
								Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'avatar_extension_error' ) . '</div>' );
								$this->refresh(  );
							}


							if (1048576 < $image['size']['image']) {
								Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'avatar_size_error' ) . '</div>' );
								$this->refresh(  );
							}

							Yii::app(  )->ih->load( $image['tmp_name']['image'] )->adaptiveThumb( 64, 64 )->save( $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $filename, false, 100 );
							$post->avatar_id = $filename;
						}


						if ($post->save(  )) {
							Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'data_updated' ) . '</div>' );
							$this->refresh(  );
						}
					} 
					else {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'wrong_password' ) . '</div>' );
						$this->refresh(  );
					}
				}
			}

			$this->render( 'settings', array( 'post' => $post ) );
		}

		function actionTrouble() {
			$this->render( 'trouble' );
		}
	}

?>