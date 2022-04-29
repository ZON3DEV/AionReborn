<?php
	class UserController extends Controller {
		function actionIndex() {
			if ($_GET) {
				$aColumns = array( 'login', 'email', 'group_id', 'ip_address', 'money', 'created' );

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
				$model = Yii::app(  )->db->createCommand(  )->select( 'id, login, email, group_id, ip_address, created, money,
						(SELECT COUNT(*) FROM `users`' . $csWhere . ') AS `count`' )->from( 'users' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['ip_address'] = '<a href="http://ip2geolocation.com/?ip=' . $model[$i]['ip_address'] . '" target="_blank">' . $model[$i]['ip_address'] . '</a>';
					$model[$i]['group_id'] = Info::getgroupico( $model[$i]['group_id'] );
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['created'] = Power::date( $model[$i]['created'], 'dd.MM.yyyy, HH:mm' );
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

			$model = UsersAdmin::model(  )->findByPk( $id );
			Power::checkmodel( $model );
			$accounts = Yii::app(  )->ls->createCommand(  )->select( 'id, name, access_level, last_ip, ' . Config::get( 'money_column' ) . ' AS money' )->from( 'account_data' )->where( 'pow_user_id = ' . $id )->queryAll(  );


            if (isset( $_POST['UsersAdmin'] )) {
				$model->attributes = $_POST['UsersAdmin'];

				if (!empty( $model->password_new )) {
					$model->password = Power::clienthash( $model->password_new );
				}


				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'data', 'data_updated' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model, 'accounts' => $accounts ) );
		}
	}

?>