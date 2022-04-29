<?php


	class PageController extends Controller {
		function actionIndex() {
			if (isset( $_GET['page'] )) {
				$page = (int)$_GET['page'];
			} 
            else {
				$page = 0;
			}

			$pagesize = 34;
            $count = Yii::app(  )->db->createCommand(  )->select( 'count(*) AS count' )->from( 'pages' )->queryRow(  );
			$model = Yii::app(  )->db->createCommand(  )->
                select( 'id, name, title, (SELECT COUNT(*) FROM `news`) AS `count`' )->
                from( 'pages' )->
                order( 'id DESC' )->
                limit( $pagesize )->
                offset( $page * $pagesize - $pagesize )->
                queryAll();

            $this->pagination = array( $pagesize, $count['count'] );
			$this->render( 'index', array( 'model' => $model ) );
		}

		function actionAdd() {


			$model = new Pages();

			if (isset( $_POST['Pages'] )) {
				$model->attributes = $_POST['Pages'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'title', Yii::t( 'admin', 'pageAddedTitle' ) );
					Yii::app(  )->user->setFlash( 'message', Yii::t( 'admin', 'pageAddedMessage', array( '{urlAddPage}' => @Power::url( 'admin/page/add' ), '{urlViewAddedPage}' => @Power::url( 'page', $model->name ) ) ) );
					$this->redirect( @Power::url( 'admin/message' ) );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}

		function actionEdit() {

			$id = $_GET['id'];

			$model = Pages::model(  )->findByPK( $id );

			if (isset( $_POST['Pages'] )) {
				$model->attributes = $_POST['Pages'];

				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'data_updated' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}

		function actionDelete() {
			@Power::checkajax(  );
			$id = (int)$_GET['id'];
			Yii::app(  )->db->createCommand(  )->delete( 'pages', 'id=:id', array( ':id' => $id ) );
			exit( true );
		}
	}

?>