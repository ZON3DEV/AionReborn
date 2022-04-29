<?php

	class widgetLogin extends CWidget {
		function run() {
			
			
			$model = new LoginForm(  );

			if (isset( $_POST['LoginForm'] )) {
				$model->attributes = $_POST['LoginForm'];

				if (( $model->validate(  ) && $model->login(  ) )) {
					$this->controller->refresh(  );
				}
			}

			$this->controller->renderPartial( '/widgets/login', array( 'model' => $model ) );
		}
	}

?>