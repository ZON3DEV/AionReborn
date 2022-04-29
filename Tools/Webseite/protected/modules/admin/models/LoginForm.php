<?php

	class LoginForm extends CFormModel {
		var $username = null;
		var $password = null;
		var $captcha = null;
		var $rememberMe = null;
		protected $_identity = null;

		function rules() {
			return array( array( 'username, password, captcha', 'required', 'message' => 'Введите {attribute}' ), array( 'rememberMe', 'boolean' ), array( 'captcha', 'captcha', 'allowEmpty' => !extension_loaded( 'gd' ) ), array( 'password', 'authenticate' ) );
		}

		function attributeLabels() {
			return array( 'username' => 'Логин', 'password' => 'Пароль', 'captcha' => 'Код с картинки', 'rememberMe' => 'Запомнить' );
		}

		function authenticate($attribute, $params) {

			$this->_identity = new UserIdentity( $this->username, $this->password );

			if (( ( !$this->_identity->authenticate( $this ) && !empty( $this->username ) ) && !empty( $this->password ) )) {
				if ($this->_identity->errorCode == 1) {
					$this->addError( 'username', Yii::t( 'data', 'login_error' ) );
					return null;
				}


				if ($this->_identity->errorCode == 2) {
					$this->addError( 'username', Yii::t( 'data', 'not_activated' ) );
					return null;
				}


				if ($this->_identity->errorCode == 3) {
					$this->addError( 'password', Yii::t( 'data', 'password_error' ) );
					return null;
				}


				if ($this->_identity->errorCode == 'auth_error') {
					$this->addError( 'password', Yii::t( 'data', 'auth_error' ) );
				}
			}

		}

		function login() {
			if ($this->_identity === null) {

				$this->_identity = new UserIdentity( $this->username, $this->password );
				$this->_identity->authenticate(  );
			}


			if ($this->_identity->errorCode ===UserIdentity:: ERROR_NONE) {
				$duration = ($this->rememberMe ? 3600 * 24 * 30 : 0);
				Yii::app(  )->user->login( $this->_identity, $duration );
				return true;
			}

			return false;
		}
	}

?>