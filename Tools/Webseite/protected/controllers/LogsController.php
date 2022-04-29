<?php

	class LogsController extends Controller {
		function actionIndex() {
			$this->render( 'index' );
		}

		function actionViewAuthLogs() {
			$this->renderPartial( '_auth' );
		}

		function actionGetAuthLogs() {
			if ($_GET) {
				$aColumns = array( 'ip_address', 'user_agent', 'status', 'date' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				$model = Yii::app(  )->db->createCommand(  )->select( 'ip_address, user_agent, status, date,
						(SELECT COUNT(*) FROM `log_auth` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_auth' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewPaymentsLogs() {
			$this->renderPartial( '_payments' );
		}

		function actionGetPaymentsLogs() {
			if ($_GET) {
				$aColumns = array( 'payment_id', 'system', 'user_id', 'sum', 'status', 'date' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				$model = Yii::app(  )->db->createCommand(  )->select( 'payment_id, system, sum, status, date,
						(SELECT COUNT(*) FROM `log_payments` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_payments' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ): $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewTransferLogs() {
			$this->renderPartial( '_transfer' );
		}

		function actionGetTransferLogs() {
			if ($_GET) {
				$aColumns = array( 'recipient_id', 'type', 'sum', 'date' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				
				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'ur.login AS recipient_user, ad.name AS recipient_account, type, sum, date,
						(SELECT COUNT(*) FROM `log_transfer_points` `lt` WHERE `sender_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_transfer_points lt' )->leftJoin( 'users ur', 'ur.id=lt.recipient_id AND type="USER"' )->leftJoin( $ls . '.account_data ad', 'ad.id=lt.recipient_id AND type="ACCOUNT"' )->where( 'sender_id=:uid', array( ':uid' => Power::userid(  ) ) )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewWebshopLogs() {
			$this->renderPartial( '_webshop' );
		}

		function actionGetWebshopLogs() {
			if ($_GET) {
				$aColumns = array( 'item_id', 'quantity', 'price', 'date' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				$model = Yii::app(  )->db->createCommand(  )->select( 'item_id, quantity, price, date,
						(SELECT COUNT(*) FROM `log_webshop` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_webshop' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewMembershipLogs() {
			$this->renderPartial( '_membership' );
		}

		function actionGetMembershipLogs() {
			if ($_GET) {
				$aColumns = array( 'account_name', 'membership_name', 'price', 'date' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				
				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'ad.name AS account_name, date, m.name AS membership_name, m.price,
						(SELECT COUNT(*) FROM `log_membership` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_membership lm' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->leftJoin( 'membership m', 'm.id=lm.membership_id' )->leftJoin( $ls . '.account_data ad', 'ad.id=lm.account_id' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewVotesLogs() {
			$this->renderPartial( '_votes' );
		}

		function actionGetVotesLogs() {
			if ($_GET) {
				$aColumns = array( 'account_name', 'rating', 'date', 'completed' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				
				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'ad.name AS account_name, rating, date, completed,
						(SELECT COUNT(*) FROM `log_votes` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_votes lv' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->leftJoin( $ls . '.account_data ad', 'ad.id=lv.account_id' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					$model[$i]['completed'] = Power::date( $model[$i]['completed'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}

		function actionViewReferralsLogs() {
			$this->renderPartial( '_referrals' );
		}

		function actionGetReferralsLogs() {
			if ($_GET) {
				$aColumns = array( 'login', 'status', 'created', 'completed' );

				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$order = null;

				if (isset( $_GET['iSortCol_0'] )) {
					$i = 0;

					while ($i < intval( $_GET['iSortingCols'] )) {
						if ($_GET['bSortable_' . intval( $_GET['iSortCol_' . $i] )] == 'true') {
							$order .= $aColumns[intval( $_GET['iSortCol_' . $i] )] . ' ' . $_GET['sSortDir_' . $i] . ', ';
						}

						++$i;
					}

					$order = substr_replace( $order, '', 0 - 2 );
					
				}

				
				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'status, lr.created, completed, u.login,
						(SELECT COUNT(*) FROM `log_referrals` WHERE `user_id` = ' . Power::userid(  ) . ') AS `count`' )->from( 'log_referrals lr' )->where( 'user_id=:uid', array( ':uid' => Power::userid(  ) ) )->leftJoin( 'users u', 'u.id=lr.referral_id' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['created'] = Power::date( $model[$i]['created'], 'dd.MM.yyyy, HH:mm' );
					$model[$i]['completed'] = Power::date( $model[$i]['completed'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

		}
	}

?>