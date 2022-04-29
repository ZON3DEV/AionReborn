<?php


	class InterkassaController extends Controller {
		function actionSettings() {

			$model = SettingsInterkassa::model(  )->find(  );

			if (isset( $_POST['SettingsInterkassa'] )) {
				$model->attributes = $_POST['SettingsInterkassa'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'admin', 'settingsSaved' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'settings', array( 'model' => $model ) );
		}
	}

?>