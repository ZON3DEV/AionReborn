<?php

	class TopController extends Controller {
	
		function actionOnline() {
			if ($_GET) {
				$aColumns = array( 'name', 'exp', 'ap', 'all_kill', 'race', 'player_class' );

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

				$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'p.name, exp, race, player_class, world_id, show_location, ap, all_kill,
						(SELECT COUNT(*) FROM `players` WHERE online = 1) AS `count`' )->from( 'players p' )->where( 'online = 1 AND ad.access_level <= ' . Config::get( 'hide_top_access_level' ) )->leftJoin( 'abyss_rank ar', 'ar.player_id = p.id' )->leftJoin( Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['exp'] = Info::getlevel( $model[$i]['exp'] );
					$model[$i]['race'] = Info::getraceico( $model[$i]['race'] );
					$model[$i]['player_class'] = Info::getclassico( $model[$i]['player_class'] );

					if ($model[$i]['show_location'] == 0) {
						$model[$i]['world_id'] = 'Скрыто';
					}

					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
			}

			$this->render( 'online' );
		}

		function actionPlayers() {
			if ($_GET) {
				$aColumns = array( 'name', 'exp', 'ap', 'all_kill', 'race', 'player_class', 'online' );

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

				$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'p.name, exp, race, player_class, online, ap, all_kill,
						(SELECT COUNT(*) FROM `players`) AS `count`' )->from( 'players p' )->where( 'ad.access_level <= ' . Config::get( 'hide_top_access_level' ) )->leftJoin( 'abyss_rank ar', 'ar.player_id = p.id' )->leftJoin( Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['exp'] = Info::getlevel( $model[$i]['exp'] );
					$model[$i]['race'] = Info::getraceico( $model[$i]['race'] );
					$model[$i]['player_class'] = Info::getclassico( $model[$i]['player_class'] );
					$model[$i]['online'] = Info::getonlineico( $model[$i]['online'] );
					++$i;
				}

				
				(isset( $model[0] ) ? $count = count( $model ) : $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
				Yii::app(  )->end(  );
			}

			$this->render( 'players' );
		}

		function actionLegions() {
		
			if ($_GET) {
				$aColumns = array( 'name', 'race', 'legat', 'members_count', 'level', 'contribution_points' );

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

				$model = Yii::app(  )->gs->cache( 300 )->createCommand(  )->select( 'l.name, contribution_points, level, p.name AS legat, race,
						(SELECT COUNT(*) FROM legion_members WHERE legion_members.legion_id = l.id) AS members_count,
						(SELECT COUNT(*) FROM `legions`) AS `count`' )->from( 'legions l' )->leftJoin( 'legion_members m', 'm.legion_id = l.id AND m.rank = "BRIGADE_GENERAL"' )->leftJoin( 'players p', 'p.id = m.player_id' )->group( 'l.name' )->limit( $limit )->offset( $offset )->order( $order )->queryAll(  );
				
				$i = 0;

				while ($i < count( $model )) {
					$model[$i]['race'] = Info::getraceico( $model[$i]['race'] );
					++$i;
				}

				
				(isset( $model[0] ) ? $count =  count( $model ): $count = count( $model ));
				$out['iTotalRecords'] = $count;
				$out['iTotalDisplayRecords'] = $count;
				$out['aaData'] = $model;
				exit( json_encode( $out ) );
				Yii::app(  )->end(  );
			}

			$this->render( 'legions' );
		}
	}

?>