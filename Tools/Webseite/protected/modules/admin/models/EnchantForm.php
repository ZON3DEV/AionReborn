<?php


	class EnchantForm extends CFormModel {
		var $enchantValue = null;
		var $enchantPrice = null;
		var $enchantGroupId = null;
		var $groupId = null;
		var $groupItemId = null;

		function rules() {
			return array( array( 'enchantValue, enchantPrice', 'required', 'on' => 'enchant' ), array( 'enchantValue, enchantPrice, enchantGroupId', 'numerical', 'integerOnly' => true ), array( 'groupId, groupItemId', 'required', 'on' => 'group' ), array( 'groupId, groupItemId', 'numerical', 'integerOnly' => true ), array( 'groupItemId', 'length', 'is' => 9 ) );
		}

		function attributeLabels() {
			return array( 'enchantValue' => 'Уровень заточки', 'enchantPrice' => 'Цена', 'enchantGroupId' => 'Группа', 'groupId' => 'ID Группы', 'groupItemId' => 'ID вещи' );
		}
	}

?>