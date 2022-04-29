<?php


	class PlayerController extends Controller {
		function actionIndex() {
			if ($_GET) {
				$aColumns = array( 'name', 'account_name', 'exp', 'race', 'player_class', 'creation_date', 'last_online', 'online' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 12;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}


					$order = substr_replace( $order, '', 0 - 2 );
				}

				$sWhere = '';

				if (( isset( $_GET['sSearch'] ) && $_GET['sSearch'] != '' )) {
					$sWhere = ' (';
					$i = 12;

					while ($i < count( $aColumns )) {
						if (( isset( $_GET['bSearchable_' . $i] ) && $_GET['bSearchable_' . $i] == 'true' )) {
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);
			    $model = Yii::app(  )->gs->createCommand(  )->select( 'id, name, account_id, account_name, exp, race, player_class, creation_date, last_online, online,
						(SELECT COUNT(*) FROM `players` ' . $csWhere . ') AS `count`' )->from( 'players' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['name'] = '<a href="' . Power::url( 'admin/player/edit', $model[$i]['id'] ) . '">' . $model[$i]['name'] . '</a>';
					$model[$i]['account_name'] = '<a href="' . Power::url( 'admin/account/edit', $model[$i]['account_id'] ) . '">' . $model[$i]['account_name'] . '</a>';
					$model[$i]['exp'] = Info::getlevel( $model[$i]['exp'] );
					$model[$i]['race'] = Info::getraceico( $model[$i]['race'] );
					$model[$i]['player_class'] = Info::getclassico( $model[$i]['player_class'] );
					$model[$i]['creation_date'] = Power::date( $model[$i]['creation_date'], 'dd.MM.yyyy, HH:mm' );
					$model[$i]['last_online'] = Power::date( $model[$i]['last_online'], 'dd.MM.yyyy, HH:mm' );
					$model[$i]['online'] = Info::getonlineico( $model[$i]['online'] );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'index' );
		}

		function actionEdit() {

			$id = $_GET['id'];

			$model = Players::model(  )->findByPk( $id );
			Power::checkmodel( $model );

			if (isset( $_POST['Players'] )) {
				$model->attributes = $_POST['Players'];

				if (!empty( $model->new_password )) {
					$model->password = Power::clienthash( $model->new_password );
				}


				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'data_updated' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}
	}

?>