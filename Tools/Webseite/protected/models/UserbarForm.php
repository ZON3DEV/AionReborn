<?php

	class UserbarForm extends CFormModel {
		var $id = null;
		var $name = null;
		var $legion = null;
		var $race_class = null;
		var $level = null;
		var $pvp = null;
		var $hp_mp = null;
		var $shadow = null;
		var $image = null;

		function rules() {
			return array( array( 'id, name, legion, race_class, level, pvp, hp_mp, shadow, image', 'required' ), array( 'id', 'numerical', 'integerOnly' => true, 'min' => 1 ), array( 'name, legion, race_class, level, pvp, hp_mp, shadow', 'length', 'max' => 7 ) );
		}

		function attributeLabels() {
			return array( 'id' => Yii::t( 'model', 'playerId' ), 'player' => Yii::t( 'model', 'player' ), 'name' => Yii::t( 'model', 'nameColor' ), 'legion' => Yii::t( 'model', 'legionColor' ), 'race_class' => Yii::t( 'model', 'raceClassColor' ), 'level' => Yii::t( 'model', 'levelColor' ), 'pvp' => Yii::t( 'model', 'pvpColor' ), 'hp_mp' => Yii::t( 'model', 'hpMpColor' ), 'shadow' => Yii::t( 'model', 'shadowColor' ) );
		}
	}

?>