<?php

	class SearchForm extends CFormModel {
		var $captcha = null;
		var $name = null;
		var $mob_id = null;
		var $item_id = null;

		function rules() {
			return array( array( 'captcha', 'required' ), array( 'captcha', 'captcha', 'allowEmpty' => !CCaptcha::checkrequirements(  ) ), array( 'name', 'required', 'on' => 'player' ), array( 'name', 'length', 'min' => 3, 'max' => 45, 'on' => 'player' ), array( 'name', 'match', 'pattern' => '/^[A-z0-9А-я\s]+$/u', 'message' => Yii::t( 'model', 'playerNameAllowedSymbols' ), 'on' => 'player' ), array( 'mob_id, item_id', 'numerical', 'integerOnly' => true, 'on' => 'droplist' ), array( 'mob_id', 'length', 'is' => 6, 'on' => 'droplist' ), array( 'item_id', 'length', 'is' => 9, 'on' => 'droplist' ) );
		}

		function attributeLabels() {
			return array( 'mob_id' => Yii::t( 'model', 'mobId' ), 'item_id' => Yii::t( 'model', 'itemId' ), 'name' => Yii::t( 'model', 'playerName' ), 'captcha' => Yii::t( 'model', 'captcha' ) );
		}
	}

?>