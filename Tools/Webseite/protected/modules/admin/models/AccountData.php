<?php

	class AccountData extends CActiveRecord {
		var $password_new = null;

		function getDbConnection() {
			return Yii::app(  )->ls;
		}

		public static function model($className = 'AccountData') {
			return parent::model( $className );
		}

		function tableName() {
			return Config::db( 'ls' ) . '.account_data';
		}

		function rules() {
			return array( array( 'name, activated, access_level, ' . Config::get( 'money_column' ) . ', pow_user_id', 'required' ), array( 'name', 'unique' ), array( 'password_new', 'length', 'min' => 3 ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Логин аккаунта', 'password_new' => 'Новый пароль', 'activated' => 'Аккаунт активирован', 'access_level' => 'Уровень доступа', 'membership' => 'Привилегии', 'expire' => 'Дата окончания привилегий', 'last_ip' => 'Последний IP', 'pow_user_id' => 'ID пользователя', 'money' => 'Баланс' );
		}
	}

?>