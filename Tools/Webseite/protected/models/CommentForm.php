<?php

	class CommentForm extends CFormModel {
		var $message = null;

		function rules() {
			return array( array( 'message', 'required', 'message' => Yii::t( 'model', 'mustInputMessage' ) ), array( 'message', 'length', 'min' => 3, 'tooShort' => Yii::t( 'model', 'messageTooShort' ) ), array( 'message', 'length', 'max' => 1024, 'tooLong' => Yii::t( 'model', 'messageTooLong' ) ) );
		}

		function attributeLabels() {
			return array( 'message' => Yii::t( 'model', 'message' ) );
		}
	}

?>