<?php

	class widgetTop extends CWidget {
		var $onlyMain = null;
		var $limit = null;
		var $order = null;

		function run() {
			if (( !$this->onlyMain || ( Yii::app(  )->getController(  )->id == 'news' && Yii::app(  )->getController(  )->action->id == 'index' ) )) {
				$model =Yii::app(  )->gs->cache( 300 )->createCommand(  )->
						select( 'p.name, exp, race, player_class, online, ap, daily_kill, weekly_kill, all_kill' )->
						from( 'players p' )->
						join( 'abyss_rank ar', 'ar.player_id = p.id' )->
						join( @Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->
						where( 'ad.access_level <= ' . Config::get( 'hide_top_access_level' ) )->
						order( $this->order )->
						limit( $this->limit )->
						queryAll(  );
				$this->controller->renderPartial( '/widgets/top', array( 'model' => $model ) );
			}

		}
	}

?>