<?php

	class widgetServerStatus extends CWidget {
		function run() {
			$this->controller->renderPartial( '/widgets/serverstatus' );
		}
	}

?>