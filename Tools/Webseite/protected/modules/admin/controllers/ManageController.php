<?php


	class ManageController extends Controller {
		function actionFusionedItems() {
			$model = Yii::app(  )->gs->createCommand(  )->select( @Config::column( 'item_unique_id' ) . ' AS item_unique_id, ' . @Config::column( 'item_id' ) . ' AS item_id,
					' . @Config::column( 'item_owner' ) . ' AS item_owner, ' . @Config::column( 'fusioned_item' ) . ' AS fusioned_item, name' )->from( 'inventory i' )->join( 'players p', 'p.id = i.' . @Config::column( 'item_owner' ) )->where( @Config::column( 'fusioned_item' ) . ' NOT LIKE "100%" AND ' . @Config::column( 'fusioned_item' ) . ' NOT LIKE "101%" AND ' . @Config::column( 'fusioned_item' ) . ' NOT LIKE "0"
					OR ' . @Config::column( 'fusioned_item' ) . ' LIKE "1000*" OR ' . @Config::column( 'fusioned_item' ) . ' LIKE "1001*" OR ' . @Config::column( 'fusioned_item' ) . ' LIKE "1002*"' )->queryAll(  );

            $this->render( 'fusioneditems', array( 'model' => $model ) );
		}

		function actionDeleteItem() {
			Power::checkajax(  );
			$id = (int)$_GET['id'];
			Yii::app(  )->gs->createCommand(  )->delete( 'inventory', @Config::column( 'item_unique_id' ) . '=:id', array( ':id' => $id ) );
			exit( true );
		}

		function actionQuestCount() {
			$model = Yii::app(  )->gs->createCommand(  )->select( 'player_id, quest_id, complete_count, name' )->from( 'player_quests q' )->where( 'complete_count > 255' )->join( 'players p', 'p.id = q.player_id' )->queryAll(  );

            $this->render( 'questcount', array( 'model' => $model ) );
		}
	}

?>