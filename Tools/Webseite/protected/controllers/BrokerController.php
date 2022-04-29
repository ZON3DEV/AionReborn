<?php

	class BrokerController extends Controller {
		function actionIndex() {
			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
			else {
				$page = 0;
			}

			$pagesize = 401;
			$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( @Config::column( 'item_id' ) . ' AS item_id, ' . @Config::column( 'item_count' ) . ' AS item_count, seller, price, ' . @Config::column( 'broker_race' ) . ' AS broker_race, ' . @Config::column( 'expire_time' ) . ' AS expire_time,
					(SELECT COUNT(*) FROM `broker`) AS `count`' )->from( 'broker' )->where( @Config::column( 'is_sold' ) . ' = 0' )->order( 'id DESC' )->limit( $pagesize )->offset( $page * $pagesize - $pagesize )->queryAll(  );
			
			(isset( $model[0] ) ? $count = 0 : $count = 0);
			$this->pagination = array( $pagesize, $count );
			$this->render( '/broker', array( 'model' => $model ) );
		}
	}

?>