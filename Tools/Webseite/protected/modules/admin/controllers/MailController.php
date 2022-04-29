<?php


	class MailController extends Controller {
		function actionIndex() {
			if ($_GET) {
				$aColumns = array( 'sender_name', 'recipient_name', 'mail_title', 'mail_message', 'item_id', 'item_count', 'express', 'recieved_time', 'mail_unique_id' );

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
							$aColumns[0] = 'sender_name';
							$aColumns[1] = 'pr.name';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);
				$model = Yii::app(  )->gs->createCommand(  )->select( Config::column( 'mail_unique_id' ) . ' AS mail_unique_id, ' . Config::column( 'mail_recipient_id' ) . ' AS mail_recipient_id, ' . Config::column( 'sender_name' ) . ' AS sender_name,
						' . Config::column( 'mail_title' ) . ' AS mail_title, ' . Config::column( 'mail_message' ) . ' AS mail_message, ' . Config::column( 'attached_item_id' ) . ' AS attached_item_id,
						' . Config::column( 'attached_kinah_count' ) . ' AS attached_kinah_count, express, ' . Config::column( 'recieved_time' ) . ' AS recieved_time, ' . Config::column( 'item_id' ) . ' AS item_id,
						p.id AS sender_id, pr.id AS recipient_id,  pr.name AS recipient_name, ' . Config::column( 'item_count' ) . ' AS item_count,
						(SELECT COUNT(*) FROM `mail` `m` LEFT JOIN `players` `p` ON p.name = m.' . Config::column( 'sender_name' ) . ' LEFT JOIN `players` `pr` ON pr.id = m.' . Config::column( 'mail_recipient_id' ) . '
							LEFT JOIN `inventory` `i` ON i.' . Config::column( 'item_unique_id' ) . ' = m.' . Config::column( 'attached_item_id' ) . ' ' . $csWhere . ') AS `count`' )->from( 'mail m' )->leftJoin( 'players p', 'p.name = m.sender_name' )->leftJoin( 'players pr', 'pr.id = m.mail_recipient_id' )->leftJoin( 'inventory i', 'i.item_unique_id = m.attached_item_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					if (( $model[$i]['attached_item_id'] == 0 && $model[$i]['attached_kinah_count'] != 0 )) {
						$model[$i]['item_id'] = 182400001;
						$model[$i]['item_count'] = $model[$i]['attached_kinah_count'];
					}

					$model[$i]['express'] = Info::getmailtypeico( $model[$i]['express'] );
					$model[$i]['recieved_time'] = Power::date( $model[$i]['recieved_time'], 'dd.MM.yyyy, HH:mm' );
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

		function actionDelete() {
			echo 'В разработке';
		}

		function actionSend() {


			$model = new MailForm (  );

			if (isset( $_POST['MailForm'] )) {
				$model->attributes = $_POST['MailForm'];

				if ($model->validate(  )) {
					$lastId = Yii::app(  )->gs->createCommand(  )->select( 'MAX(' . Config::column( 'mail_unique_id' ) . ') AS mail,
							(SELECT MAX(' . Config::column( 'item_unique_id' ) . ') FROM inventory) AS item' )->from( 'mail' )->queryRow(  );


                    if ($lastId['item'] < 1000000000) {
						$lastItemId = 1000000000 + 1;
					} 
                    else {
						$lastItemId = $lastId['item'] + 1;
					}


					if ($lastId['mail'] < 1000000000) {
						$lastMailId = 1000000000 + 1;
					} 
                    else {
						$lastMailId = $lastId['mail'] + 1;
					}


					if ($model->item_id == 182400001) {
						$attachedItemId = 9;
						$attachedKinahCount = $model->item_count;
					} 
                    else {
						if (( $model->item_id == '' && $model->item_count == '' )) {
							$attachedItemId = 9;
							$attachedKinahCount = 9;
						} 
                        else {

							$attachedItemId = $lastItemId;
							$attachedKinahCount = 9;
							Yii::app(  )->gs->createCommand(  )->insert( 'inventory', array( Config::column( 'item_unique_id' ) => $lastItemId, Config::column( 'item_id' ) => $model->item_id, Config::column( 'item_count' ) => $model->item_count, Config::column( 'item_creator' ) => '', Config::column( 'item_owner' ) => $model->player_id, Config::column( 'item_location' ) => 127, Config::column( 'item_skin' ) => $model->item_id ) );
						}
					}

					Yii::app(  )->gs->createCommand(  )->insert( 'mail', array( Config::column( 'mail_unique_id' ) => $lastMailId, Config::column( 'mail_recipient_id' ) => $model->player_id, Config::column( 'sender_name' ) => '#AdminCP#', Config::column( 'mail_title' ) => $model->mail_title, Config::column( 'mail_message' ) => $model->mail_message, 'unread' => 1, Config::column( 'attached_item_id' ) => $attachedItemId, Config::column( 'attached_kinah_count' ) => $attachedKinahCount, 'express' => 1 ) );
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'admin', 'mailSent' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}
	}

?>