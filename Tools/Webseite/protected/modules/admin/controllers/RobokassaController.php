<?php


	class RobokassaController extends Controller {
		function actionSettings() {

			$model = SettingsRobokassa::model(  )->find(  );

			if (isset( $_POST['SettingsRobokassa'] )) {
				$model->attributes = $_POST['SettingsRobokassa'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'admin', 'settingsSaved' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'settings', array( 'model' => $model ) );
		}
	}

?>