<?php

	class RetrievePointsForm extends CFormModel {
		var $accountId = null;
		var $sum = null;

		function rules() {
			return array( array( 'accountId, sum', 'required' ), array( 'accountId', 'numerical', 'integerOnly' => true ), array( 'sum', 'numerical', 'integerOnly' => true, 'min' => '1', 'message' => Yii::t( 'model', 'numberGreaterZero', array( '{attribute}' => '{attribute}' ) ) ) );
		}

		function attributeLabels() {
			return array( 'accountId' => Yii::t( 'model', 'recipientAccount' ), 'sum' => Yii::t( 'model', 'sum' ) );
		}
	}

?>