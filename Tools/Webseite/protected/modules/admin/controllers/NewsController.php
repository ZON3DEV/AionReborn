<?php
	class NewsController extends Controller {
		function actionIndex() {
			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
            else {
				$page = 0;
			}

			$pagesize = 34;
            $count = Yii::app(  )->db->createCommand(  )->
                select( 'count(*) AS count' )->
                from( 'news' )->queryRow(  );
			$model = Yii::app()->db->createCommand()->
            select( 'n.id, n.title, user_id, comments_enable, date, c.name AS category_name, c.alt_name AS category_alt_name, u.login AS user_name,
					(SELECT COUNT(*) FROM `news`) AS `count`' )->
                from( 'news n' )->
                leftJoin( 'news_category c', 'c.id = n.category_id' )->
                leftJoin( 'users u', 'u.id = n.user_id' )->
                order( 'id DESC' )->
                limit( $pagesize )->
                offset( $page * $pagesize - $pagesize )->
                queryAll(  );
            $this->pagination = array( $pagesize, $count['count'] );
			$this->render( 'index', array( 'model' => $model ) );
		}

		function actionAdd() {


			$model = new News();

			if (isset( $_POST['News'] )) {
				$model->attributes = $_POST['News'];
				$model->user_id = @Power::userid(  );
				$model->date = time(  );

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'title', Yii::t( 'admin', 'newsAddedTitle' ) );
					Yii::app(  )->user->setFlash( 'message', Yii::t( 'admin', 'newsAddedMessage', array( '{urlAddNews}' => @Power::url( 'admin/news/add' ), '{urlViewAddedNews}' => @Power::url( 'news', $model->id ) ) ) );
					$this->redirect( @Power::url( 'admin/message' ) );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}

		function actionEdit() {
			$id = (int)$_GET['id'];
			$model = News::model(  )->findByPK( $id );
			@Power::checkmodel( $model );

			if (isset( $_POST['News'] )) {
				$model->attributes = $_POST['News'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'data_updated' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}

		function actionAllowComment() {
			@Power::checkajax(  );
			$id = (int)$_GET['id'];
			$show = (int)$_GET['show'];
			$show = abs( $show - 1 );
			Yii::app(  )->db->createCommand( 'UPDATE news SET comments_enable = ' . $show . ' WHERE id=' . $id )->execute(  );

			($show == 1 ?  : $out['css'] = 'btn-off');
			$out['attrName'] = 'url';
			$out['attrValue'] = @Power::url( 'admin/news/allowcomment', $id, array( 'show' => $show ) );
			exit( json_encode( $out ) );
		}

		function actionDelete() {
			@Power::checkajax(  );
			$id = (int)$_GET['id'];
			Yii::app(  )->db->createCommand(  )->delete( 'news', 'id=:id', array( ':id' => $id ) );
			exit( true );
		}

		function actionCategory() {
			$model = Yii::app(  )->db->createCommand(  )->
			select( 'id, name, alt_name, image_id, title' )->
			from( 'news_category' )->
			order( 'id ASC' )->
			queryAll(  );


            if (isset( $_GET['id'] )) {

				$id = $_GET['id'];
				$post = NewsCategory::model(  )->findByPK( $id );
				@Power::checkmodel( $post );
			} 
            else {


				$post = new NewsCategory();
			}


			if (isset( $_POST['NewsCategory'] )) {
				$post->attributes = $_POST['NewsCategory'];

				if ($post->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'admin', 'categoryAddedMessage' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'category', array( 'model' => $model, 'post' => $post ) );
		}

		function actionCategoryDelete() {
			@Power::checkajax(  );

			$id = $_GET['id'];
			Yii::app(  )->db->createCommand(  )->delete( 'news_category', 'id=:id', array( ':id' => $id ) );
			exit( true );
		}
	}

?>