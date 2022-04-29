<?php
	class widgetGm extends CWidget {
		function run() {
			$model =Yii::app()->gs->cache(300)->createCommand()->
			select('p.name, race, a.access_level' )->
			from( 'players p' )->
			join( @Config::db( 'ls' ) . '.account_data a', 'a.id = p.account_id' )->
			where( 'online = 1 AND a.access_level > 0 AND a.access_level <= ' . Config::get( 'hide_gm_access_level' ) )->
			queryAll(  );
			$this->controller->renderPartial( '/widgets/gm', array( 'model' => $model ) );
		}
	}

?>