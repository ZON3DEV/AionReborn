<?php


	class LogController extends Controller {
		function actionPayments() {
			if ($_GET) {
				$aColumns = array( 'payment_id', 'system', 'login', 'sum', 'status', 'date' );

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
				$model = Yii::app(  )->db->createCommand(  )->select( 'payment_id, system, user_id, sum, status, date, login,
						(SELECT COUNT(*) FROM `log_payments` `lp` LEFT JOIN `users` `u` ON u.id = lp.user_id ' . $csWhere . ') AS `count`' )->from( 'log_payments lp' )->leftJoin( 'users u', 'u.id=lp.user_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'payments' );
		}

		function actionWebshop() {
			if ($_GET) {
				$aColumns = array( 'login', 'account_name', 'name', 'item_id', 'quantity', 'price', 'date' );

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

				$gs = Config::db( 'gs' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'user_id, lw.account_id, player_id, item_id, quantity, price, date, login, account_name, name,
						(SELECT COUNT(*) FROM `log_webshop` `lw` LEFT JOIN `users` `u` ON u.id=lw.user_id LEFT JOIN ' . $gs . '.players `p` ON p.id=lw.player_id ' . $csWhere . ') AS `count`' )->from( 'log_webshop lw' )->leftJoin( 'users u', 'u.id=lw.user_id' )->leftJoin( $gs . '.players p', 'p.id=lw.player_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['account_name'] = '<a href="' . Power::url( 'admin/account/edit', $model[$i]['account_id'] ) . '">' . $model[$i]['account_name'] . '</a>';
					$model[$i]['name'] = '<a href="' . Power::url( 'admin/player/edit', $model[$i]['player_id'] ) . '">' . $model[$i]['name'] . '</a>';
					$model[$i]['item_id'] = Adb::url( 'item', $model[$i]['item_id'], 3 );
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'webshop' );
		}

		function actionMembership() {
			if ($_GET) {
				$aColumns = array( 'name', 'login', 'account_name', 'date' );

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
							$aColumns[0] = 'm.name';
							$aColumns[2] = 'ad.name';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);

				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'membership_id, user_id, account_id, date, m.name, u.id AS user_id, u.login, ad.id AS account_id, ad.name AS account_name,
						(SELECT COUNT(*) FROM `log_membership` `lm`
							LEFT JOIN `membership` `m` ON m.id=lm.membership_id LEFT JOIN `users` `u` ON u.id=lm.user_id LEFT JOIN ' . $ls . '.`account_data` `ad` ON ad.id=lm.account_id
							' . $csWhere . ') AS `count`' )->from( 'log_membership lm' )->leftJoin( 'membership m', 'm.id=lm.membership_id' )->leftJoin( 'users u', 'u.id=lm.user_id' )->leftJoin( $ls . '.account_data ad', 'ad.id=lm.account_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['account_name'] = '<a href="' . Power::url( 'admin/account/edit', $model[$i]['account_id'] ) . '">' . $model[$i]['account_name'] . '</a>';
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'membership' );
		}

		function actionVotes() {
			if ($_GET) {
				$aColumns = array( 'rating', 'login', 'name', 'date', 'completed' );

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

				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'user_id, account_id, rating, type, date, completed, u.login, ad.name,
						(SELECT COUNT(*) FROM `log_votes` `lv` LEFT JOIN `users` `u` ON u.id=lv.user_id LEFT JOIN ' . $ls . '.`account_data` `ad` ON ad.id=lv.account_id ' . $csWhere . ') AS `count`' )->from( 'log_votes lv' )->leftJoin( 'users u', 'u.id=lv.user_id' )->leftJoin( $ls . '.account_data ad', 'ad.id=lv.account_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['name'] = '<a href="' . Power::url( 'admin/account/edit', $model[$i]['account_id'] ) . '">' . $model[$i]['name'] . '</a>';
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

			$this->render( 'votes' );
		}

		function actionTransferPoints() {
			if ($_GET) {
				$aColumns = array( 'sender', 'recipient_account', 'recipient_user', 'sum', 'date' );

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
							$aColumns[0] = 'u.login';
							$aColumns[1] = 'ad.name';
							$aColumns[2] = 'ur.login';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);

				$ls = Config::db( 'ls' );
				$model = Yii::app(  )->db->createCommand(  )->select( 'sender_id, u.login AS sender, ur.login AS recipient_user, ad.name AS recipient_account, type, sum, date,
						(SELECT COUNT(*) FROM `log_transfer_points` `lt`
						LEFT JOIN `users` `u` ON u.id=lt.sender_id LEFT JOIN `users` `ur` ON ur.id=lt.recipient_id AND type="USER"
						LEFT JOIN ' . $ls . '.`account_data` `ad` ON ad.id=lt.recipient_id AND type="ACCOUNT" ' . $csWhere . ') AS `count`' )->from( 'log_transfer_points lt' )->leftJoin( 'users u', 'u.id=lt.sender_id' )->leftJoin( 'users ur', 'ur.id=lt.recipient_id AND type="USER"' )->leftJoin( $ls . '.account_data ad', 'ad.id=lt.recipient_id AND type="ACCOUNT"' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['sender'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['sender_id'] ) . '">' . $model[$i]['sender'] . '</a>';
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'transferpoints' );
		}

		function actionReferrals() {
			if ($_GET) {
				$aColumns = array( 'user', 'referral', 'status', 'created', 'completed' );

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
							$aColumns[0] = 'u.login';
							$aColumns[1] = 'ur.login';
							$aColumns[3] = 'lr.created';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);
				$model = Yii::app(  )->db->createCommand(  )->select( 'user_id, referral_id, status, lr.created, completed, u.login AS user, ur.login AS referral,
						(SELECT COUNT(*) FROM `log_referrals` `lr` LEFT JOIN `users` `u` ON u.id = lr.user_id LEFT JOIN `users` `ur` ON ur.id=lr.referral_id ' . $csWhere . ') AS `count`' )->from( 'log_referrals lr' )->leftJoin( 'users u', 'u.id=lr.user_id' )->leftJoin( 'users ur', 'ur.id=lr.referral_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['user'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['user'] . '</a>';
					$model[$i]['referral'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['referral_id'] ) . '">' . $model[$i]['referral'] . '</a>';
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

			$this->render( 'referrals' );
		}

		function actionAuth() {
			if ($_GET) {
				$aColumns = array( 'login', 'ip_address', 'user_agent', 'type', 'status', 'date' );

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
							$aColumns[1] = 'la.ip_address';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);
				$model = Yii::app(  )->db->createCommand(  )->select( 'user_id, la.ip_address, user_agent, type, status, date, u.login,
						(SELECT COUNT(*) FROM `log_auth` `la` LEFT JOIN `users` `u` ON u.id=la.user_id ' . $csWhere . ') AS `count`' )->from( 'log_auth la' )->leftJoin( 'users u', 'u.id=la.user_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['login'] = '<a href="' . Power::url( 'admin/user/edit', $model[$i]['user_id'] ) . '">' . $model[$i]['login'] . '</a>';
					$model[$i]['date'] = Power::date( $model[$i]['date'], 'dd.MM.yyyy, HH:mm' );
					++$i;
				}


				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'auth' );
		}
	}

?>