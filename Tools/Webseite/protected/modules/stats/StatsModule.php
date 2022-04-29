<?php

	class StatsModule extends CWebModule {
		function init() {
			$this->setImport( array(  ) );
		}

		function beforeControllerAction($controller, $action) {
			$this->setViewPath( Yii::app(  )->theme->basePath . DIRECTORY_SEPARATOR . 'views' );

			if (parent::beforecontrolleraction( $controller, $action )) {
				return true;
			}

			return false;
		}
	}

?>