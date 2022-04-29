<?php

	class UsersAdmin extends CActiveRecord {
		var $password_new = null;

		public static function model($className = 'UsersAdmin') {
			return parent::model( $className );
		}

		function tableName() {
			return 'users';
		}

		function rules() {
			return array( array( 'login, email, group_id, activated', 'required' ), array( 'login', 'length', 'min' => 3, 'max' => 16 ), array( 'login', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute} может содержать только латинские буквы и цифры' ), array( 'email', 'email', 'message' => 'Указан некорректный E-Mail адрес' ), array( 'email', 'length', 'min' => 6, 'max' => 32 ), array( 'email', 'filter', 'filter' => 'mb_strtolower' ), array( 'login, email', 'unique' ), array( 'money', 'numerical', 'integerOnly' => true, 'min' => '0', 'message' => '{attribute} должен быть целым положительным числом' ) );
		}

		function attributeLabels() {
			return array( 'login' => 'Логин пользователя', 'email' => 'E-Mail адрес', 'group_id' => 'Группа пользователя', 'activated' => 'Активирован', 'money' => 'Баланс', 'password_new' => 'Новый пароль' );
		}
	}

?>