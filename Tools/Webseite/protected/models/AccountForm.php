<?php
	class AccountForm extends CFormModel {
		var $name = null;
		var $password = null;
		var $passwordConfirm = null;
		var $captcha = null;

		function rules() {
			return array( array( 'name, password', 'required', 'on' => 'new' ), array( 'passwordConfirm', 'required', 'message' => Yii::t( 'model', 'mustConfirmPassword' ), 'on' => 'new' ), array( 'name', 'length', 'min' => 3, 'max' => 32, 'on' => 'new' ), array( 'name', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => Yii::t( 'model', 'loginAllowedSymbols' ), 'on' => 'new' ), array( 'passwordConfirm', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t( 'model', 'passwordsNotMatch' ), 'on' => 'new' ), array( 'name, password, captcha', 'required', 'on' => 'add' ), array( 'name', 'length', 'min' => 3, 'max' => 32, 'on' => 'add' ), array( 'name', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => Yii::t( 'model', 'loginAllowedSymbols' ), 'on' => 'add' ), array( 'captcha', 'captcha', 'allowEmpty' => !CCaptcha::checkrequirements(  ), 'on' => 'add' ) );
		}

		function attributeLabels() {
			return array( 'name' => Yii::t( 'model', 'login' ), 'password' => Yii::t( 'model', 'password' ), 'passwordConfirm' => Yii::t( 'model', 'passwordConfirm' ), 'captcha' => Yii::t( 'model', 'captcha' ) );
		}
	}

?>