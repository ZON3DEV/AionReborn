<?php


	class Legions extends CActiveRecord {
		var $legat_new = null;

		function getDbConnection() {
			return Yii::app(  )->gs;
		}

		public static function model($className = 'Legions') {
			return parent::model( $className );
		}

		function tableName() {
			return Config::db( 'gs' ) . '.legions';
		}

		function rules() {
			return array( array( 'name, level, contribution_points', 'required' ), array( 'level, contribution_points', 'numerical', 'integerOnly' => true ), array( 'name', 'length', 'max' => 16 ), array( 'name', 'match', 'pattern' => '/^[A-z0-9А-я\s][\w]+$/u', 'message' => '{attribute} может содержать только русские и латинские буквы и цифры' ), array( 'name', 'unique' ), array( 'legat_new', 'match', 'pattern' => '/^[A-z0-9А-я\s][\w]+$/u', 'message' => '{attribute} может содержать только русские и латинские буквы и цифры' ) );
		}

		function attributeLabels() {
			return array( 'id' => 'ID', 'name' => 'Имя легиона', 'level' => 'Уровень', 'contribution_points' => 'Очки', 'legat_new' => 'Имя нового легата' );
		}
	}

?>