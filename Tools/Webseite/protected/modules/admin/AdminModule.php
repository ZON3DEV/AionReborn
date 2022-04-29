<?php


	class AdminModule extends CWebModule {
		function init() {
			$this->setImport( array( 'admin.models.*', 'admin.components.*' ) );
		}

		function beforeControllerAction($controller, $action) {
			if (parent::beforecontrolleraction( $controller, $action )) {
				if (( @Power::isadmin(  ) && @Power::isadminlogin(  ) )) {
					return TRUE;
				}


				if ($controller->id != 'login') {
					$controller->redirect( @Power::url( 'admin/login' ) );
					return TRUE;
				}


				if (@Power::isuser(  )) {
					$controller->redirect( @Power::url(  ) );
				}

				return TRUE;
			}

			return FALSE;
		}
	}

?>