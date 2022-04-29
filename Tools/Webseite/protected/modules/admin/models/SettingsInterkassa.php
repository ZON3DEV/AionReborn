<?php


	class SettingsInterkassa extends CActiveRecord {
		public static function model($className = 'SettingsInterkassa') {
			return parent::model( $className );
		}

		function tableName() {
			return 'settings_interkassa';
		}

		function rules() {
			return array( array( 'ik_co_id, secret_key, test_key', 'length', 'max' => 32 ), array( 'ik_desc', 'length', 'max' => 255 ) );
		}

		function attributeLabels() {
			return array( 'ik_co_id' => 'ID кассы', 'secret_key' => 'Секретный ключс', 'test_key' => 'Тестовый ключ', 'ik_desc' => 'Описание заказа' );
		}
	}

?>