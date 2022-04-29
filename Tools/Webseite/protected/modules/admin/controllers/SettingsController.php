<?php


	class SettingsController extends Controller {
		function actionIndex() {

			$model = Settings::model(  )->find(  );

			if (isset( $_POST['Settings'] )) {
				$model->attributes = $_POST['Settings'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'main', 'Настройки сохранены' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( '/settings', array( 'model' => $model ) );
		}

		function actionClearCache() {
			Yii::app(  )->cache->flush(  );
		}
	}

?>