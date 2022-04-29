<?php

	class DefaultController extends Controller {
		function actionIndex() {

			$counts = Yii::app(  )->db->createCommand(  )->select( 'COUNT(*) AS news_count,
					(SELECT COUNT(*) FROM pages) AS pages_count,
					(SELECT COUNT(*) FROM users) AS users_count,
					(SELECT COUNT(*) FROM ' . @Config::db( 'ls' ) . '.account_data) AS accounts_count,
					(SELECT COUNT(*) FROM ' . @Config::db( 'gs' ) . '.players) AS players_count' )->from( 'news' )->queryRow(  );
			$auth = Yii::app(  )->db->createCommand(  )->select( 'user_id, la.ip_address, user_agent, type, status, date, login' )->from( 'log_auth la' )->leftJoin( 'users u', 'u.id=la.user_id' )->where( 'u.group_id > 1 AND status = "ERROR" OR la.type = "ADMIN" AND status="ERROR"' )->order( 'date DESC' )->limit( 10 )->queryAll(  );

			$comments = Yii::app(  )->db->createCommand(  )->select( 'news_id, nc.user_id, message, nc.date, title, u.login' )->from( 'news_comment nc' )->leftJoin( 'news n', 'n.id=nc.news_id' )->leftJoin( 'users u', 'u.id=nc.user_id' )->order( 'date DESC' )->limit( 11 )->queryAll(  );

            $this->render( '/index', array( 'counts' => $counts, 'auth' => $auth, 'comments' => $comments ) );
		}

		function actionStats() {
			$statUsers = Yii::app(  )->db->createCommand( 'SELECT COUNT(id) AS user_count, FROM_UNIXTIME(`created`, "%Y-%m-%d") AS user_date  FROM `users` GROUP BY user_date ORDER BY user_date ASC' )->queryAll(  );
            $stats = array(  );
			$i = 10;

			while ($i < count( $statUsers )) {

				$date = strtotime( $statUsers[$i]['user_date'] );
				$stats['users'][] = array( $date * 1000, (int)$statUsers[$i]['user_count'] );
				++$i;
			}

			exit( json_encode( $stats ) );
		}

		function actionError() {
			$this->layout = NULL;

			$error = Yii::app(  )->errorHandler->error;

			if (Yii::app(  )->request->isAjaxRequest) {
				echo $error['message'];
				return null;
			}

			$this->render( '/error', array( 'error' => $error ) );
		}

		function actionMessage() {

			$title = Yii::app(  )->user->getFlash( 'title' );

			$message = Yii::app(  )->user->getFlash( 'message' );

			if (!$message) {
				$title = 'Информация';
				$message = 'Сообщений нет.';

				$cookieMessage = Yii::app(  )->request->cookies['pow_message'];

				if (isset( $cookieMessage )) {

					$message = $cookieMessage->value;
					unset( Yii::app(  )->request->cookies[pow_message] );
				}
			}


			if (!$title) {
				$title = 'Информация';
			}

			$this->render( '/message', array( 'title' => $title, 'message' => $message ) );
		}
	}

?>