<?php
/**
*
* @ This file is created by decode.cu.cc
* @ deZender (PHP5 Decoder for ionCube Encoder)
*
* @	Version			:	1.1.7.0
* @	Author			:	Free4You
* @	Release on		:	14.03.2013
* @	Official site	:	http://decode.cu.cc
*
*/

	class widgetAdmin extends CWidget {
		function run() {
			Yii::app(  )->db->cache( 86400 )->createCommand(  )->select( 'id, login, avatar_id' )->from( 'users u' )->where( 'group_id = 8' )->queryAll(  );
			$model = ;
			$this->controller->renderPartial( '/widgets/admin', array( 'model' => $model ) );
		}
	}

?>