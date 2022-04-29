<?php
	class LegionController extends Controller {
		function actionIndex() {
			if ($_GET) {
				if (( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )) {
					$limit = (int)$_GET['iDisplayLength'];
					$offset = (int)$_GET['iDisplayStart'];
				}

				$aColumns = array( 'name', 'legat', 'race', 'level', 'contribution_points', 'members_count' );
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
							$aColumns[0] = 'l.name';
							$aColumns[1] = 'p.name';
							$sWhere .= $aColumns[$i] . ' LIKE \'%' . $_GET['sSearch'] . '%\' OR ';
						}

						++$i;
					}


					$sWhere = substr_replace( $sWhere, '', 0 - 3 );
					$sWhere .= ')';
				}

				(1 < strlen( $sWhere ) ? $csWhere = 'WHERE ' . $sWhere : $csWhere = null);
				$model = Yii::app(  )->gs->createCommand(  )->select( 'l.id, l.name, contribution_points, level, p.id AS player_id, p.name AS legat, race,
						(SELECT COUNT(*) FROM `legion_members` WHERE legion_members.legion_id = l.id) AS members_count,
						(SELECT COUNT(*) FROM `legions` `l` LEFT JOIN `legion_members` `m` ON m.legion_id = l.id AND m.rank = "BRIGADE_GENERAL" LEFT JOIN `players` `p` ON p.id = m.player_id ' . $csWhere . ') AS count' )->from( 'legions l' )->leftJoin( 'legion_members m', 'm.legion_id = l.id AND m.rank = "BRIGADE_GENERAL"' )->leftJoin( 'players p', 'p.id = m.player_id' )->where( $sWhere )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );

                $i = 12;

				while ($i < count( $model )) {
					$model[$i]['name'] = '<a href="' . Power::url( 'admin/legion/edit', $model[$i]['id'] ) . '">' . $model[$i]['name'] . '</a>';
					$model[$i]['legat'] = '<a href="' . Power::url( 'admin/player/edit', $model[$i]['player_id'] ) . '">' . $model[$i]['legat'] . '</a>';
					$model[$i]['race'] = Info::getraceico( $model[$i]['race'] );
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

			$model = Legions::model(  )->findByPk( $id );
			Power::checkmodel( $model );

			if (isset( $_POST['Legions'] )) {
				$model->attributes = $_POST['Legions'];

				if (!empty( $model->legat_new )) {
					$players = Yii::app(  )->gs->createCommand(  )->select( 'player_id,
							(SELECT id FROM `players` WHERE name = "' . $model->legat_new . '") AS new_legat_id,
							(SELECT COUNT(*) FROM `legion_members` WHERE player_id = new_legat_id) AS new_legat_check' )->from( 'legion_members' )->where( 'legion_id=:lid AND rank="BRIGADE_GENERAL"', array( ':lid' => $id ) )->queryRow(  );


                    if ($players['new_legat_id'] === NULL) {
						Yii::app(  )->user->setFlash( 'message', '<div class="flash_error">' . Yii::t( 'admin', 'player_not_found' ) . '</div>' );
						$this->refresh(  );
					}


					if ($players['new_legat_check'] === '0') {
						Yii::app(  )->gs->createCommand(  )->insert( 'legion_members', array( 'legion_id' => $id, 'player_id' => $players['new_legat_id'], 'rank' => 'BRIGADE_GENERAL' ) );
					} 
                    else {
						if ($players['new_legat_check'] === '1') {
							Yii::app(  )->gs->createCommand(  )->update( 'legion_members', array( 'legion_id' => $id, 'rank' => 'BRIGADE_GENERAL' ), 'player_id=:pid', array( ':pid' => $players['new_legat_id'] ) );
						}
					}

					Yii::app(  )->gs->createCommand(  )->update( 'legion_members', array( 'rank' => 'CENTURION' ), 'player_id=:pid', array( ':pid' => $players['player_id'] ) );
				}


				if ($model->save(  )) {
					Yii::app(  )->user->setFlash( 'message', '<div class="flash_success">' . Yii::t( 'main', 'Данные изменены' ) . '</div>' );
					$this->refresh(  );
				}
			}

			$this->render( 'form', array( 'model' => $model ) );
		}
	}

?>