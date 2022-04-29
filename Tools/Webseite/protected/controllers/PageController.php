<?php

	class PageController extends Controller {
		function actionView() {
			$name = $_GET['name'];
			$dependency = new CDbCacheDependency( 'SELECT MAX(updated) FROM pages WHERE name = "' . $name . '"' );
			$model = Yii::app(  )->db->cache( 86400, $dependency )->createCommand(  )->select( '*' )->from( 'pages' )->where( 'name=:name', array( ':name' => $name ) )->queryRow(  );
			
			@Power::checkmodel( $model );
			Yii::app(  )->clientScript->registerMetaTag( $model['description'], 'description' );
			Yii::app(  )->clientScript->registerMetaTag( $model['keywords'], 'keywords' );
			$this->render( '/page', array( 'model' => $model ) );
		}
	}

?>