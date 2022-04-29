<?php

	class SettingsRobokassa extends CActiveRecord {
		public static function model($className = 'SettingsRobokassa') {
			return parent::model( $className );
		}

		function tableName() {
			return 'settings_robokassa';
		}

		function rules() {
			return array( array( 'mrh_login, mrh_pass1, mrh_pass2', 'length', 'max' => 32 ), array( 'inv_desc', 'length', 'max' => 255 ) );
		}

		function attributeLabels() {
			return array( 'mrh_login' => 'Login ID', 'mrh_pass1' => 'Password # 1', 'mrh_pass2' => 'Password # 2', 'inv_desc' => 'Order Description' );
		}
	}

?>