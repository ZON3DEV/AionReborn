<?php

	class Power extends Controller {
		function clientHash($password) {
			$anticheatSalt = Config::get( 'anticheat_salt' );
			return base64_encode( sha1( $password . $anticheatSalt, TRUE ) );
		}

		function profile() {
			$t = '<img title="Execution time" alt="" style="margin-bottom: -4px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAodJREFUeNqkU8tLG2EQn92NWjevNSbUbFca2kufiIUEKw0+CBRaIb0q6k0peJOCt9L/w5sWUkKhSbElNw8GK7GVemgp9EGV2i/GhLrmoY3Jbme2u0tKDz104Pft7uz8ft98M/Nxuq7D/5iDlng8DjzPgyAIwHGcG3EF3QrCa8apiG+42XtEudlsgqZpkE6nfwu02CWXxzMSiUZHIgMD4WAgECQnOzhguY2Nzdza2mpZVVfR9eGPDCyyLxC4NzE7O6cEg4okivAsswvnehUQz/SEIrduhy739d1MLC56C4ylLBGeFkzL43S7YxMzM3NdPp/i6ew0FD9/+giazsF+SYfsGx4Oq5IyiRtgljHi2AJ4pmvhaHTYLUmK2N4OPMcZApVKBQSM8Lh4CMkd8GqrDieaWxkcGhomji3QaDRC1/v7w/R+dHwMO8Wiga87u1BCEUL5ZxW6fQKs5X5AfzgcJk6rQJdXks5axTjv9xsol5Hkctm4qEiw+bYIFEscu4j4wVMbNZNMdicWg9HRUXjw8AlonBN0DNWBAw5bTe0mTquAWlHVguj19lpZJJJJmBwfh+eJ+3abaOTUeh1qR0cF4thHOD093Xm9vr7tIGVNM4K9Ph88TiSMpwWXJEEHdiiXzW4Tp7UL2y9SqWy9UmFNU8ASaTWaPv7khD1NJrPEsQXwx+F+Pp95tLCwrJZKTOD5v2aefDVVZQvz88uMsQxxyM/RZcLZBxEnz+l03pBlOT41PT14d2zsao8sd9NE5BkrvVxZebe0tLS+t7eXrlarW7VaDQyuKUDF7Eb4HQ5HV1tb2wWstNx6mTDl73juL2bxDhBF5DYsAcpZNOH4xw1uIqqIGnK1XwIMAPiEMNKmMDl2AAAAAElFTkSuQmCC" />';
			$q = '<img title="Queries" alt="" style="margin-bottom: -4px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAo5JREFUeNqMU19IU1EY/917j7u7191tSg62SB8iLQh8KCiS1JJA1LRBUC++imUF4kPRg/i0ekjoKSb4VI/2tqAeooSiYBiFT+IgKmPhnHqvbm7ObafvHP8wJaEPfuf7vnPu9/+7SkvLBYRCR0F0lRDE/9EfQkwITByZTAZVVVXBycnJiWw2i1wuh2KxhKWlDMlluN0GLMuC1+uFz+fF4OCNIU3TpCdW3NqaXltz2oQSDl87NGRD/XEMj4zBrDb2P/g8Jn85NcXL5TKvlAUX+u69QHwmwX/8snlvb+/tcDgMAba+WcKJppNov9wBIXd1d4PpBjLOqtTz+bzkgjhKEpXEvIEGPBh7hPEn47jSdxMbGxsQdwe5oNmvHzA/P/+GxJldB2qg4RQmnj7G3PffEPLrd58w+/mt5EIXDoQu5HMXOzA0fL+T7M7uOlDOXx+eVjXWdrBpLyKD6H8Y3dPrgzW429+FQF0dRu7cElN4Jksg43aTlWGuJwai0ehEKpXCt7mfeB77iL7W07BMFUa1GzW1/kN6wG1YBRubFZfH6jwI1hhYXLGpgTlwpSwNyzvY58AiBzv0JRKJvGpubu6h0cnal5eXaaGKtEhurHg8SPt8iB1oIhMfCyJ+ZnR0tKdyE1OUgZPL0lhVVHsM2kQLrd0dnSMD92KKosSlg4WFBfj9fhQKBS6iOY6zF3lxdRVOIQvddMHPvVAZh2nqoCAlVVVh2zZYPB5HY2MjdF1n/15ivt0D2YdtUABNZJlIJOTPZNByWKFQyGSM0c/ig8vlkiVotJFmfg2qrsgSTNOAxlSk02kjmUwGyHZdoaOWEDIM4xLn/EipRKPiXO6IAJE4IFImzoVM70uUwXt6T/4VYABh/T+X9QfphwAAAABJRU5ErkJggg==" />';
			$m = '<img title="Memory usage/Memory peak" alt="" style="margin-bottom: -4px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAihJREFUeNqkkz1v01AUht/Yzoed2LHqfKAqCgRBEUsYonxIzRYWpLBUapcixILEjGDoyMSvYOzMUMYgBhZE6A9ogciRUuMoVUjjuLGTOObcKEgUWgkpV3rk63PP+16de88N+L6PVQaHFUeAxt+xW8R94g6RXsa6xBHRIL5dZRAjdpPJ5MNyuXw7l8ulZVlmMQyHw1Gr1eo2m82vvV7vgEL7xIit8UsDlviiUqns1uv1iqqqqUKhENF1nZtMJlyxWIy4rqvl8/kb8/k8axiGRvlfiMlvg6e06yNKzFuWJZAI7XYb0+l0AZuzGMFnMpk0mWimaXqkazKDDU3TXlar1cJ2oyF8VhQ4s9lCuBRdoFQqBcbj8Vqn04k6jvOJGTym3R94nrf2URTxXNfxnuMwJgPbtnF2NqQzGMGybPp3cXz8ncx9PhgMcqZp9Nk13qOaE+SKCZWzJ0l4NRigb5gYjRw65RBCIQmiqECSFEQiMgRBQiqVTTAtM7jO87xYq9XYpcAPS3jmengjRzE/d8DzYRLGyUBewAw2N/OIxVSRaZlBlDVUo/EBHCdClhNQr2XxZHCO/YQCq9eF5/kIk7EghCmHx+Fhi30XWo5a+efpad9WlCTicY0MVGhaGus372L7Rx9vsymY+hGVY13otm73xGZaNt9Z3unJZcjBoNHb2vIvWWOaHdYErBaZEK5o9zrxmtgj3v0RnxHW/7wXnlhffv99TKs+518CDAAhHOlpeYzP9gAAAABJRU5ErkJggg==" />';
			
			$stats = Yii::app(  )->db->getStats(  );
			$stats[0];
			$executionTime = round( Yii::getlogger(  )->getMemoryUsage(  ) / ( 1024 * 1024 ), 2 );
			
			$memoryUsage = $queryCount = round( memory_get_peak_usage(  ) / ( 1024 * 1024 ), 2 );
			$memoryPeak = round( Yii::getlogger(  )->getExecutionTime(  ), 3 );
			$str = '' . '<span style=\'font:11px verdana,tahoma,serif;color:#555;text-shadow:0 1px rgba(255,255,255, 0.9);\'>' . $t . ': ' . $executionTime . ' sec | ' . $q . ': ' . $queryCount . ' | ' . $m . ': ' . $memoryUsage . ' Mb/' . $memoryPeak . ' Mb</span>';
			return $str;
		}

		function copyright() {
			return 'Powered by <a href="http://makeserv.net/" target="_blank" title="PowerWeb - Web Binding Aion">PowerWeb ' . self::version(  ) . '</a>';
		}

		function version() {
			return '3.3';
		}

		function title($title) {
			
			$siteName = Config::get( 'site_name' );
			$module = Yii::app(  )->controller->module;

			if (( ( Yii::app(  )->getController(  )->id === 'news' && Yii::app(  )->getController(  )->action->id === 'index' ) && !$module )) {
				return $siteName;
			}

			return $title . ' - ' . $siteName;
		}

		function url($route = NULL, $id = NULL, $param = NULL) {
			
			$linkArray = explode( '/', $route );
			$fileName = end( $linkArray );

			if ($route === NULL) {
				return Yii::app(  )->homeUrl;
			}


			if (strpos( $fileName, '.' ) == TRUE) {
				return Yii::app(  )->homeUrl . $route;
			}


			if ($param === NULL) {
				return Yii::app(  )->homeUrl . $route . '/' . $id;
			}

			return Yii::app(  )->createAbsoluteUrl( $route . '/' . $id, $param );
		}

		function theme($param = NULL) {
			
			$theme = Yii::app(  )->theme->getName(  );
			$url = Yii::app(  )->createAbsoluteUrl( 'themes/' . $theme . '/' . $param );
			return $url;
		}

		function date($date, $format = NULL) {
			if ((int)$date == 0) {
				return null;
			}


			if ($format == NULL) {
				$format = 'd MMMM yyyy, HH:mm';
			}

			return Yii::app(  )->dateFormatter->format( $format, $date );
		}

		function message($id = 'message') {
			if (Yii::app(  )->user->hasFlash( $id )) {
				return Yii::app(  )->user->getFlash( $id );
			}

		}

		function uid() {
			return uniqid( md5( rand(  ) ) );
		}

		function sendEmail($address, $subject, $message) {
			$to = $address;
			$subject = $subject;
			$message = $message;
			$headers = 'MIME-Version: 1.0' . '';
			$headers .= 'Content-type: text/html; charset=UTF-8' . '';
			$headers .= 'To: ' . $address . '';
			$headers .= 'From: ' . Config::get( 'site_name' ) . ' <' . Config::get( 'admin_email' ) . '>' . '';
			mail( $to, $subject, $message, $headers );
		}

		function trim($str, $num) {
			($num < strlen( $str ) ? $suffix = '&hellip;' : $suffix = null);
			return mb_substr( $str, 0, $num ) . $suffix;
		}

		function userName() {
			return Yii::app(  )->user->name;
		}

		function userId() {
			return Yii::app(  )->user->id;
		}

		function userEmail() {
			return Yii::app(  )->user->email;
		}

		function userMoney() {
			$model = Yii::app(  )->db->createCommand(  )->select( 'money' )->from( 'users' )->where( 'id=:id', array( ':id' => self::userid(  ) ) )->queryRow(  );
			return $model['money'];
		}

		function updateMoney($sum, $userId = NULL) {
			(0 < $sum ? $operator = '+' : $operator = null);

			if ($userId == NULL) {
				
				$userId = self::userid();
			}

			Yii::app(  )->db->createCommand( 'UPDATE users SET money = money ' . $operator . $sum . ' WHERE id = ' . $userId )->execute(  );
		}

		function getUserAccounts() {
			$accounts = Yii::app(  )->ls->createCommand(  )->select( 'id, name' )->from( 'account_data' )->where( 'pow_user_id=:pid', array( ':pid' => Power::userid(  ) ) )->queryAll(  );
			$accountNames = array(  );
			foreach ($accounts as $data) {
				$accountNames[$data['id']] = $data['name'];
			}

			return $accountNames;
		}

		function checkModel($model) {
			if (!$model) {
				
				throw new CHttpException ( 404, 'The requested page does not exist.' );
			}

		}

		function checkAjax() {
			if (!Yii::app(  )->request->isAjaxRequest) {
				exit( 'ajax only' );
			}

		}

		function isAjax() {
			if (Yii::app(  )->request->isAjaxRequest) {
				return TRUE;
			}

			return FALSE;
		}

		function checkGuest() {
			if (!self::isguest(  )) {
				
				throw new CHttpException ( 400, 'Invalid request. Please do not repeat this request again.' );
			}

		}

		function isGuest() {
			if (Yii::app(  )->user->isGuest) {
				return TRUE;
			}

			return FALSE;
		}

		function checkAuth() {
			if (!self::isauth(  )) {
				
				throw new CHttpException( 403, 'You don\'t have enough rights.' );
			}

		}

		function isAuth() {
			if (self::isguest(  )) {
				return FALSE;
			}

			return TRUE;
		}

		function checkAdmin() {
			if (!self::isadmin(  )) {
				
				throw new CHttpException ( 403, 'You don\'t have enough rights.' );
			}

		}

		function isAdmin() {
			if (( self::isauth(  ) && Yii::app(  )->user->group == 8 )) {
				return TRUE;
			}

			return FALSE;
		}

		function isAdminLogin() {
			if (( self::isauth(  ) && Yii::app(  )->session['adminLogin'] === 'TRUE' )) {
				return TRUE;
			}

			return FALSE;
		}

		function checkUser() {
			if (!self::isuser(  )) {
				
				throw new CHttpException( 403, 'You don\'t have enough rights.' );
			}

		}

		function isUser() {
			if (( self::isauth(  ) && Yii::app(  )->user->group == 1 )) {
				return TRUE;
			}

			return FALSE;
		}
	}

?>