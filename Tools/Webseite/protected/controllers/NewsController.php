<?php

	class NewsController extends Controller {
		function actionIndex() {
			Yii::app()->clientScript->registerMetaTag( 'Powered By PowerWeb ' . @Power::version(  ), 'generator' );

			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
			else {
				$page = 0;
			}

			
			$pagesize = Config::get( 'news_per_page' );
			
			$dependency = new CDbCacheDependency( 'SELECT MAX(updated) FROM news' );
			
			$model = Yii::app(  )->db->cache( 86400, $dependency )->createCommand(  )->select( 'n.id, user_id, n.title, text_short, date, c.name AS category_name, c.alt_name AS category_alt_name, image_id,
					(SELECT COUNT(*) FROM `news`) AS `count`' )->from( 'news n' )->leftJoin( 'news_category c', 'c.id = n.category_id' )->order( 'id DESC' )->limit( $pagesize )->offset( $page * $pagesize - $pagesize )->queryAll(  );
			
			(isset( $model[0] ) ? $count = 0 : $count = 0);
			$this->pagination = array( $pagesize, $count );
			$this->render( 'index', array( 'model' => $model ) );
		}

		function actionView() {
			$id = (int)$_GET['id'];
			
			
			$dependency = new CDbCacheDependency( 'SELECT updated FROM news WHERE id = ' . $id );
			$model = Yii::app(  )->db->cache( 86400, $dependency )->createCommand(  )->select( 'n.id, user_id, n.title, text_short, text_full, comments_enable, n.date, n.description, n.keywords, c.name AS category_name, c.alt_name AS category_alt_name, image_id' )->from( 'news n' )->where( 'n.id=:id', array( ':id' => $id ) )->leftJoin( 'news_category c', 'c.id = n.category_id' )->queryRow(  );
			
			
			
			$dependency = new CDbCacheDependency( 'SELECT MAX(updated) FROM news_comment WHERE news_id = ' . $id );
			$comments = Yii::app(  )->db->cache( 86400, $dependency )->createCommand(  )->select( 'user_id, message, date, u.login, u.avatar_id' )->from( 'news_comment c' )->where( 'c.news_id=:id', array( ':id' => $id ) )->leftJoin( 'users u', 'c.user_id = u.id' )->queryAll(  );
			
			@Power::checkmodel( $model );

			if (!empty( $model['text_full'] )) {
				$model['text_full'] = htmlspecialchars_decode( $model['text_full'] );
			} 
			else {
				$model['text_full'] = htmlspecialchars_decode( $model['text_short'] );
			}

			
			
			$post = new CommentForm(  );

			if (isset( $_POST['CommentForm'] )) {
				@Power::checkauth(  );
				$post->attributes = $_POST['CommentForm'];

				if ($post->validate(  )) {
					Yii::app(  )->db->createCommand(  )->insert( 'news_comment', array( 'news_id' => $model['id'], 'user_id' => @Power::userid(  ), 'message' => strip_tags( $post->message ), 'ip' => $_SERVER['REMOTE_ADDR'], 'date' => time(  ), 'status' => 1 ) );
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'comment_added' ) . '</div>' );
					$this->refresh(  );
				}
			}

			Yii::app(  )->clientScript->registerMetaTag( $model['description'], 'description' );
			Yii::app(  )->clientScript->registerMetaTag( $model['keywords'], 'keywords' );
			$this->render( 'view', array( 'model' => $model, 'comments' => $comments, 'post' => $post ) );
		}

		function actionCategory() {
			
			$name = $_GET['name'];

			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
			else {
				$page = 0;
			}

			$pagesize = Config::get( 'news_per_page' );
			$dependency = new CDbCacheDependency( 'SELECT MAX(updated) FROM news' );
			$model = Yii::app(  )->db->cache( 86400, $dependency )->createCommand(  )->select( 'n.id, user_id, n.title, text_short, date, c.name AS category_name, c.alt_name AS category_alt_name, image_id, c.title AS category_title, c.description, c.keywords,
					(SELECT COUNT(*) FROM news n LEFT JOIN news_category c ON c.id=n.category_id WHERE c.alt_name = "' . $name . '") AS `count`' )->from( 'news n' )->where( 'c.alt_name=:name', array( ':name' => $name ) )->leftJoin( 'news_category c', 'c.id = n.category_id' )->order( 'id DESC' )->limit( $pagesize )->offset( $page * $pagesize - $pagesize )->queryAll(  );
			
			@Power::checkmodel( $model );
			$this->pageTitle = $model[0]['category_title'];
			Yii::app(  )->clientScript->registerMetaTag( $model[0]['description'], 'description' );
			Yii::app(  )->clientScript->registerMetaTag( $model[0]['keywords'], 'keywords' );
			$this->pagination = array( $pagesize, $model[0]['count'] );
			$this->render( 'index', array( 'model' => $model ) );
		}
	}

?>