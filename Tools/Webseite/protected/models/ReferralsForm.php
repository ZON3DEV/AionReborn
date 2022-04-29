<?php

	class ReferralsForm extends CFormModel {
		var $pow_user_id = null;
		var $account_id = null;
		var $player_id = null;

		function rules() {
			return array( array( 'pow_user_id, account_id, player_id', 'required' ), array( 'pow_user_id, account_id, player_id', 'numerical', 'integerOnly' => true ) );
		}

		function attributeLabels() {
			return array( 'pow_user_id' => Yii::t( 'model', 'powUserId' ), 'account_id' => Yii::t( 'model', 'accountId' ), 'player_id' => Yii::t( 'model', 'playerId' ) );
		}
	}

?>