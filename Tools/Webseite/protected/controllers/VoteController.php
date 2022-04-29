<?php

	class VoteController extends Controller {
		function actionIndex() {
			@Power::checkauth(  );
			$logs = Yii::app(  )->db->createCommand(  )->select( 'rating, count(rating) as count, MAX(date) as date, MAX(completed) as completed' )->from( 'log_votes' )->where( 'user_id=:uid', array( ':uid' => @Power::userid(  ) ) )->group( 'rating' )->queryAll(  );

			$config = Yii::app(  )->db->createCommand(  )->select( 'mmotopru_link, l2topru_link, aiontopinfo_link' )->from( 'settings_votes' )->queryRow(  );

            $model = array( 'AIONTOPINFO' => array( 'count' => 0, 'date' => 0, 'completed' => 0 ), 'L2TOPRU' => array( 'count' => 0, 'date' => 0, 'completed' => 0 ), 'MMOTOPRU' => array( 'count' => 0, 'date' => 0, 'completed' => 0 ) );
			foreach ($logs as $data) {

				if ($data['rating'] == 'AIONTOPINFO') {
					$model['AIONTOPINFO'] = array( 'count' => $data['count'], 'date' => $data['date'], 'completed' => $data['completed'] );
					continue;
				}


				if ($data['rating'] == 'L2TOPRU') {
					$model['L2TOPRU'] = array( 'count' => $data['count'], 'date' => $data['date'], 'completed' => $data['completed'] );
					continue;
				}


				if ($data['rating'] == 'MMOTOPRU') {
					$model['MMOTOPRU'] = array( 'count' => $data['count'], 'date' => $data['date'], 'completed' => $data['completed'] );
					continue;
				}
			}

			$this->render( '/vote', array( 'model' => $model, 'config' => $config ) );
		}

		function actionGetAiontopinfoVotes() {
			@Power::checkajax(  );

			$accounts = @Power::getuseraccounts(  );

			$settings = Yii::app(  )->db->createCommand(  )->select( 'aiontopinfo_link, aiontopinfo_bonus' )->from( 'settings_votes' )->queryRow(  );
			$votes = array(  );

			$file = file( $settings['aiontopinfo_link'] );

			$file = array_slice( $file, 1, 0 - 1 );
			$file[0] = str_replace( '<meta http-equiv="content-type" content="text/html; charset=windows-1252"></head><body>', '', $file[0] );
			$lastVotesDb = Yii::app(  )->db->createCommand(  )->select( 'account_id, MAX(date) as date' )->from( 'log_votes' )->where( 'rating=:rating AND user_id=:uid', array( ':rating' => 'AIONTOPINFO', ':uid' => @Power::userid(  ) ) )->group( 'account_id' )->queryAll(  );

            foreach ($lastVotesDb as $data) {
				$lastVotes[$data['account_id']] = $data['date'];
			}

			foreach ($file as $data) {

				$vote = explode( ' ', $data );

				$date = @strtotime( $vote[0] . $vote[1] );

				$name = @trim( $vote[2] );

				$day = date( 'Y-m-d', $date );

				if (in_array( $name, $accounts )) {

					$accountId = array_search( $name, $accounts );

					if (isset( $lastVotes[$accountId] )) {

						$lastVote = date( 'Y-m-d', $lastVotes[$accountId] );
					} 
                    else {

						$lastVote = date( 'Y-m-d', 0 );
					}


					if ($lastVote < date( 'Y-m-d', $date )) {
						$votes[$day][$name]['account_name'] = $name;
						$votes[$day][$name]['account_id'] = $accountId;
						$votes[$day][$name]['user_id'] = @Power::userid(  );
						$votes[$day][$name]['date'] = $date;
						continue;
					}

					continue;
				}
			}


			$votes = array_reverse( $votes );
			$i = 0;
			$query = array(  );
			foreach ($votes as $array) {
				foreach ($array as $data) {
					$query[$i]['account_id'] = $data['account_id'];
					$query[$i]['user_id'] = $data['user_id'];
					$query[$i]['rating'] = 'AIONTOPINFO';
					$query[$i]['type'] = 1;
					$query[$i]['date'] = $data['date'];
					$query[$i]['completed'] = time(  );
					++$i;
				}
			}

			$out['sum'] = $i * $settings['aiontopinfo_bonus'];
			$out['votes'] = $i;

			if (!empty( $query )) {
				$builder = Yii::app(  )->db->schema->commandBuilder;
				$command = $builder->createMultipleInsertCommand( 'log_votes', $query );
				$command->execute(  );
			}

			Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $out['sum'] . ' WHERE id = ' . @Power::userid(  ) )->execute(  );
			echo json_encode( $out );
		}

		function actionGetL2topruVotes() {
			$accounts = @Power::getuseraccounts(  );
			$settings = Yii::app(  )->db->createCommand(  )->select( 'l2topru_link, l2topru_bonus' )->from( 'settings_votes' )->queryRow(  );
			$votes = array(  );
			$file = file( $settings['l2topru_link'] );
			$file = array_slice( $file, 2, 0 - 1 );
			$lastVotesDb = Yii::app(  )->db->createCommand(  )->select( 'account_id, MAX(date) as date' )->from( 'log_votes' )->where( 'rating=:rating AND user_id=:uid', array( ':rating' => 'L2TOPRU', ':uid' => @Power::userid(  ) ) )->group( 'account_id' )->queryAll(  );

            foreach ($lastVotesDb as $data) {
				$lastVotes[$data['account_id']] = $data['date'];
			}

			foreach ($file as $data) {

				$vote = explode( '	', $data );

				$date = @strtotime( $vote[0] );

				$name = @trim( $vote[1] );

				$day = date( 'Y-m-d', $date );

				if (in_array( $name, $accounts )) {

					$accountId = array_search( $name, $accounts );

					if (isset( $lastVotes[$accountId] )) {

						$lastVote = date( 'Y-m-d', $lastVotes[$accountId] );
					} 
                    else {

						$lastVote = date( 'Y-m-d', 0 );
					}


					if ($lastVote < date( 'Y-m-d', $date )) {
						$votes[$day][$name]['account_name'] = $name;
						$votes[$day][$name]['account_id'] = $accountId;
						$votes[$day][$name]['user_id'] = @Power::userid(  );
						$votes[$day][$name]['date'] = $date;
						continue;
					}

					continue;
				}
			}


			$votes = array_reverse( $votes );
			$i = 0;
			$query = array(  );
			foreach ($votes as $array) {
				foreach ($array as $data) {
					$query[$i]['account_id'] = $data['account_id'];
					$query[$i]['user_id'] = $data['user_id'];
					$query[$i]['rating'] = 'L2TOPRU';
					$query[$i]['type'] = 1;
					$query[$i]['date'] = $data['date'];
					$query[$i]['completed'] = time(  );
					++$i;
				}
			}

			$out['sum'] = $i * $settings['l2topru_bonus'];
			$out['votes'] = $i;

			if (!empty( $query )) {
				$builder = Yii::app(  )->db->schema->commandBuilder;
				$command = $builder->createMultipleInsertCommand( 'log_votes', $query );
				$command->execute(  );
			}

			Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $out['sum'] . ' WHERE id = ' . @Power::userid(  ) )->execute(  );
			echo json_encode( $out );
		}

		function actionGetMmotopruVotes() {
			@Power::checkajax(  );

			$accounts = @Power::getuseraccounts(  );
			$settings = Yii::app(  )->db->createCommand(  )->select( 'mmotopru_link, mmotopru_bonus, mmotopru_bonus_sms' )->from( 'settings_votes' )->queryRow(  );
            $votes = array(  );
			$file = file( $settings['mmotopru_link'] );
			$lastVotesDb = Yii::app(  )->db->createCommand(  )->select( 'account_id, MAX(date) as date' )->from( 'log_votes' )->where( 'rating=:rating AND user_id=:uid', array( ':rating' => 'MMOTOPRU', ':uid' => @Power::userid(  ) ) )->group( 'account_id' )->queryAll(  );

            foreach ($lastVotesDb as $data) {
				$lastVotes[$data['account_id']] = $data['date'];
			}

			foreach ($file as $data) {

				$vote = explode( '	', $data );

				$name = $vote[3];

				$date = @strtotime( $vote[1] );

				$type = @trim( $vote[4] );

				$day = date( 'Y-m-d', $date );

				if (in_array( $name, $accounts )) {

					$accountId = array_search( $name, $accounts );

					if (isset( $lastVotes )) {

						$lastVote = date( 'Y-m-d', $lastVotes[$accountId] );
					} 
                    else {

						$lastVote = date( 'Y-m-d', 0 );
					}


					if ($lastVote < date( 'Y-m-d', $date )) {
						$votes[$day][$name]['account_name'] = $name;
						$votes[$day][$name]['account_id'] = $accountId;
						$votes[$day][$name]['user_id'] = @Power::userid(  );
						$votes[$day][$name]['type'] = $type;
						$votes[$day][$name]['date'] = $date;
						continue;
					}

					continue;
				}
			}


			$votes = array_reverse( $votes );
			$sms = 0;
			$reg = 0;
			$i = 0;
			$query = array(  );
			foreach ($votes as $array) {
				foreach ($array as $data) {
					if ($data['type'] == 2) {
						++$sms;
					} 
                    else {
						++$reg;
					}

					$query[$i]['account_id'] = $data['account_id'];
					$query[$i]['user_id'] = $data['user_id'];
					$query[$i]['rating'] = 'MMOTOPRU';
					$query[$i]['type'] = $data['type'];
					$query[$i]['date'] = $data['date'];
					$query[$i]['completed'] = time(  );
					++$i;
				}
			}

			$out['sum'] = $sms * $settings['mmotopru_bonus_sms'] + $reg * $settings['mmotopru_bonus'];
			$out['votes'] = $sms + $reg;

			if (!empty( $query )) {
				$builder = Yii::app(  )->db->schema->commandBuilder;
				$command = $builder->createMultipleInsertCommand( 'log_votes', $query );
				$command->execute(  );
			}

			Yii::app(  )->db->createCommand( 'UPDATE users SET money = money + ' . $out['sum'] . ' WHERE id = ' . @Power::userid(  ) )->execute(  );
			echo json_encode( $out );
		}

		function actionVoteGamesites200() {
			$config = Yii::app(  )->db->createCommand(  )->select( 'gamesites200com_link, gamesites200com_bonus' )->from( 'settings_votes' )->queryRow(  );


            if (!$config['gamesites200com_link']) {
				exit( 'disabled' );
			}

			(!@Power::isguest(  ) ? false : $this->redirect( $config['gamesites200com_link'] ));
			$logs = Yii::app(  )->db->createCommand(  )->select( 'MAX(date) as date' )->from( 'log_votes' )->where( 'user_id=:uid AND rating = "GAMESITES200COM"', array( ':uid' => @Power::userid(  ) ) )->queryRow(  );


            if ($logs['date'] < time(  ) - 86400) {
				@Power::updatemoney( $config['gamesites200com_bonus'] );
				Yii::app(  )->db->createCommand(  )->insert( 'log_votes', array( 'user_id' => @Power::userid(  ), 'rating' => 'GAMESITES200COM', 'type' => 1, 'date' => time(  ), 'completed' => time(  ) ) );
			}

			$this->redirect( $config['gamesites200com_link'] );
		}

		function actionVoteGtop100() {
			$config = Yii::app(  )->db->createCommand(  )->select( 'gtop100com_link, gtop100com_bonus' )->from( 'settings_votes' )->queryRow(  );


            if (!$config['gtop100com_link']) {
				exit( 'disabled' );
			}

			(!@Power::isguest(  ) ? false : $this->redirect( $config['gtop100com_link'] ));
			$logs = Yii::app(  )->db->createCommand(  )->select( 'MAX(date) as date' )->from( 'log_votes' )->where( 'user_id=:uid AND rating = "GTOP100COM"', array( ':uid' => @Power::userid(  ) ) )->queryRow(  );


            if ($logs['date'] < time(  ) - 86400) {
				@Power::updatemoney( $config['gtop100com_bonus'] );
				Yii::app(  )->db->createCommand(  )->insert( 'log_votes', array( 'user_id' => @Power::userid(  ), 'rating' => 'GTOP100COM', 'type' => 1, 'date' => time(  ), 'completed' => time(  ) ) );
			}

			$this->redirect( $config['gtop100com_link'] );
		}

		function actionVoteTopg() {
			$config = Yii::app(  )->db->createCommand(  )->select( 'topgorg_link, topgorg_bonus' )->from( 'settings_votes' )->queryRow(  );

			if (!$config['topgorg_link']) {
				exit( 'disabled' );
			}

			(!@Power::isguest(  ) ? false : $this->redirect( $config['topgorg_link'] ));
			$logs = Yii::app(  )->db->createCommand(  )->select( 'MAX(date) as date' )->from( 'log_votes' )->where( 'user_id=:uid AND rating = "TOPGORG"', array( ':uid' => @Power::userid(  ) ) )->queryRow(  );


            if ($logs['date'] < time(  ) - 86400) {
				@Power::updatemoney( $config['topgorg_bonus'] );
				Yii::app(  )->db->createCommand(  )->insert( 'log_votes', array( 'user_id' => @Power::userid(  ), 'rating' => 'TOPGORG', 'type' => 1, 'date' => time(  ), 'completed' => time(  ) ) );
			}

			$this->redirect( $config['topgorg_link'] );
		}

		function actionVoteXtremetop100() {
			$config = Yii::app(  )->db->createCommand(  )->select( 'xtremetop100com_link, xtremetop100com_bonus' )->from( 'settings_votes' )->queryRow(  );


            if (!$config['xtremetop100com_link']) {
				exit( 'disabled' );
			}

			(!@Power::isguest(  ) ? false : $this->redirect( $config['xtremetop100com_link'] ));
			$logs = Yii::app(  )->db->createCommand(  )->select( 'MAX(date) as date' )->from( 'log_votes' )->where( 'user_id=:uid AND rating = "XTREMETOP100COM"', array( ':uid' => @Power::userid(  ) ) )->queryRow(  );


            if ($logs['date'] < time(  ) - 86400) {
				@Power::updatemoney( $config['xtremetop100com_bonus'] );
				Yii::app(  )->db->createCommand(  )->insert( 'log_votes', array( 'user_id' => @Power::userid(  ), 'rating' => 'XTREMETOP100COM', 'type' => 1, 'date' => time(  ), 'completed' => time(  ) ) );
			}

			$this->redirect( $config['xtremetop100com_link'] );
		}
	}

?>