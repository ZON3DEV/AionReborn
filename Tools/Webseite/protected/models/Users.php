<?php

	class Users extends CActiveRecord {
		var $password_repeat = null;
		var $password_new = null;
		var $password_current = null;
		var $captcha = null;
		var $image = null;

		public static function model($className = 'Users') {
			return parent::model( $className );
		}

		function tableName() {
			return 'users';
		}

		function rules() {
			return array( 
			array( 'login, password, email, captcha', 'required', 'on' => 'registration' ), 
			array( 'password_repeat', 'required', 'message' => Yii::t( 'model', 'passwordConfirm' ), 'on' => 'registration' ), 
			array( 'login', 'length', 'min' => 3, 'max' => 16, 'on' => 'registration' ), 
			array( 'login', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => Yii::t( 'model', 'engSymbolsAllowed' ), 'on' => 'registration' ), 
			array( 'email', 'email', 'message' => Yii::t( 'model', 'incorrectEmail' ), 'on' => 'registration' ), 
			array( 'email', 'length', 'min' => 6, 'max' => 32, 'on' => 'registration' ), 
			array( 'email', 'filter', 'filter' => 'mb_strtolower', 'on' => 'registration' ), 
			array( 'login, email', 'unique', 'on' => 'registration' ), 
			array( 'password_repeat', 'compare', 'message' => Yii::t( 'model', 'passwordsNotMatch' ), 'compareAttribute' => 'password', 'on' => 'registration' ), 
			array( 'captcha', 'captcha', 'allowEmpty' => !CCaptcha::checkrequirements(  ), 'on' => 'registration' ), 
			array( 'login', 'required', 'on' => 'activation' ), 
			array( 'login', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => Yii::t( 'model', 'engSymbolsAllowed' ), 'on' => 'activation' ), 
			array( 'login', 'length', 'min' => 3, 'max' => 16, 'on' => 'activation' ), 
			array( 'login', 'exist', 'message' => Yii::t( 'model', 'loginNotFound', 
			array( '{value}' => '{value}' ) ), 'on' => 'activation' ), 
			array('login, email, captcha', 'required', 'on'=>'lost'),
			array('id, new_password, password', 'safe', 'on'=>'lost'),
			array( 'email, password_current', 'required', 'on' => 'settings' ), 
			array( 'password_repeat', 'compare', 'compareAttribute' => 'password_new', 'message' => Yii::t( 'model', 'passwordsNotMatch' ), 'on' => 'settings' ), 
			array( 'password_new', 'safe', 'on' => 'settings' ) );
		}

		function attributeLabels() {
			return array( 'login' => Yii::t( 'model', 'login' ), 'password' => Yii::t( 'model', 'password' ), 'password_repeat' => Yii::t( 'model', 'passwordConfirm' ), 'password_new' => Yii::t( 'model', 'passwordNew' ), 'password_current' => Yii::t( 'model', 'passwordСurrent' ), 'email' => Yii::t( 'model', 'email' ), 'captcha' => Yii::t( 'model', 'captcha' ), 'image' => Yii::t( 'model', 'avatar' ) );
		}

		function beforeSave() {
			if (parent::beforesave(  )) {
				if ($this->isNewRecord) {
					$this->password = CPasswordHelper::hashpassword( $this->password );
				}

				return true;
			}

			return false;
		}
	}

?>