<?php
	class WidgetForum extends CWidget {
		var $onlymain = null;
		var $topics = null;

		function run() {
			if (( !$this->onlymain || ( Yii::app(  )->getController(  )->id == 'news' && Yii::app(  )->getController(  )->action->id == 'index' ) )) {
				
				$model = Yii::app()->forum->createCommand()->
                select( 'posts, views, last_poster_id, last_post, title, tid, last_poster_name' )->
                from( 'topics' )->
                order( 'last_post DESC' )->
                limit( $this->topics )->queryAll();
				$this->controller->renderPartial( '//widgets/forum', array( 'model' => $model ) );
			}

		}
	}

?>