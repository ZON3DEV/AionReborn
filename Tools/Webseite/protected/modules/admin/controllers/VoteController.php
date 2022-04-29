<?php

	class VoteController extends Controller {
		function actionSettings() {

			$model = SettingsVotes::model(  )->find(  );

			if (isset( $_POST['SettingsVotes'] )) {
				$model->attributes = $_POST['SettingsVotes'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'admin', 'settingsSaved' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'settings', array( 'model' => $model ) );
		}
	}

?>