<?php

	class TransferPointsForm extends CFormModel {
		var $type = null;
		var $sender = null;
		var $sum = null;
		var $recipient_user = null;
		var $recipient_account = null;

		function rules() {
			return array( array( 'type, sender, sum', 'required' ), array( 'type', 'in', 'range' => array( 'ACCOUNT', 'USER' ) ), array( 'sender', 'numerical', 'integerOnly' => true, 'min' => '1', 'max' => 10 ), array( 'recipient_user', 'checkUser' ), array( 'recipient_user', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => Yii::t( 'model', 'rusEngSymbolsAllowed', array( '{attribute}' => '{attribute}' ) ) ), array( 'recipient_account', 'checkAccount' ), array( 'recipient_account', 'numerical', 'integerOnly' => true, 'message' => Yii::t( 'model', 'numberGreaterZero', array( '{attribute}' => '{attribute}' ) ) ), array( 'sum', 'numerical', 'integerOnly' => true, 'min' => '1', 'message' => Yii::t( 'model', 'numberGreaterZero', array( '{attribute}' => '{attribute}' ) ) ) );
		}

		function attributeLabels() {
			return array( 'type' => Yii::t( 'model', 'type' ), 'sender' => Yii::t( 'model', 'sender' ), 'recipient_account' => Yii::t( 'model', 'recipientAccount' ), 'recipient_user' => Yii::t( 'model', 'recipientUser' ), 'sum' => Yii::t( 'model', 'sum' ) );
		}

		function checkUser($attribute) {
			if ($this->type === 'USER') {
				if ($this->recipient_user == '') {
					$this->addError( $attribute, Yii::t( 'data', 'input_user_name' ) );
				}

				return false;
			}

			return false;
		}

		function checkAccount($attribute) {
			if ($this->type === 'ACCOUNT') {
				if ($this->recipient_account == null) {
					$this->addError( $attribute, Yii::t( 'data', 'select_account' ) );
				}

				return false;
			}

			return false;
		}
	}

?>