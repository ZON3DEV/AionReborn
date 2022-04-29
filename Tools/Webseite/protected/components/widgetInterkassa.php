<?php


	class widgetInterkassa extends CWidget {
		function run() {

			$model = Yii::app(  )->db->createCommand(  )->select( 'ik_co_id, ik_desc' )->from( 'settings_interkassa' )->queryRow(  );

			if ($model['ik_co_id'] != NULL) {
				$this->controller->renderPartial( '/widgets/interkassa', array( 'model' => $model ) );
			}

		}
	}

?>