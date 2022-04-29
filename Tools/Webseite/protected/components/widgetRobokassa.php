<?php

	class widgetRobokassa extends CWidget {
		function run() {

			$model = Yii::app(  )->db->createCommand(  )->select( 'mrh_login, inv_desc' )->from( 'settings_robokassa' )->queryRow(  );

			if ($model['mrh_login'] != NULL) {
				$this->controller->renderPartial( '/widgets/robokassa', array( 'model' => $model ) );
			}

		}
	}

?>