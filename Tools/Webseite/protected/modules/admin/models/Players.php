<?php


	class Players extends CActiveRecord {
		function getDbConnection() {
			return Yii::app(  )->gs;
		}

		public static function model($className = 'Players') {
			return parent::model( $className );
		}

		function tableName() {
			return Config::db( 'gs' ) . '.players';
		}

		function rules() {
			return array( array( 'account_id, exp, title_id, show_inventory, show_location', 'numerical', 'integerOnly' => true ), array( 'name', 'unique' ), array( 'account_name', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute} может содержать только латинские буквы и цифры' ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Имя персонажа', 'account_id' => 'ID Аккаунта', 'account_name' => 'Имя аккаунта', 'exp' => 'Опыт', 'title_id' => 'ID титула', 'show_inventory' => 'Показывать инвентарь', 'show_location' => 'Показывать локацию' );
		}
	}

?>