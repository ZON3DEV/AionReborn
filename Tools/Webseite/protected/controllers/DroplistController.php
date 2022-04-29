<?php

	class DroplistController extends Controller {
		function actions() {
			return @Config::captcha(  );
		}

		function actionIndex() {
			if (@Config::getservertype(  ) === 2) {
				$this->redirect( Power::url(  ) );
			}

			$post = new SearchForm(  );
			$post->scenario = 'droplist';
			$model = array();

			if (isset( $_POST['SearchForm'] )) {
				$post->attributes = $_POST['SearchForm'];

				if ($post->validate(  )) {
					if (( !empty( $post->mob_id ) && !empty( $post->item_id ) )) {
						$where = 'mobId = ' . $post->mob_id . ' AND itemid = ' . $post->item_id;
					} 
					else {
						if (!empty( $post->mob_id )) {
							$where = 'mobId = ' . $post->mob_id;
						} 
						else {
							if (!empty( $post->item_id )) {
								$where = 'itemId = ' . $post->item_id;
							} 
							else {
								$where = null;
							}
						}
					}

					$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'mobId AS mob_id, itemId AS item_id, min, max, chance' )->from( 'droplist' )->where( $where )->order( 'chance DESC, min DESC' )->limit( 100 )->queryAll(  );
					

					if (!$model) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'data', 'nothing_found' ) . '</div>' );
					}
				}
			}

			$this->render( '/droplist', array( 'model' => $model, 'post' => $post ) );
		}
	}

?>