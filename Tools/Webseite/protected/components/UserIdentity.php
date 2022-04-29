<?php

	class UserIdentity extends CUserIdentity {
		protected $_id = null;

		function authenticate() {




			$time = time(  ) - 900;
			$model = Yii::app(  )->db->createCommand(  )->
                select( 'id, login, password, email, group_id, activated,
					(SELECT count(*) FROM log_auth WHERE status = "ERROR" AND ip_address = "'
                    . $_SERVER['REMOTE_ADDR'] . '" AND date > ' . $time . ') AS errors' )->
                from( 'users' )->
                where( 'login=:login', array( ':login' => $this->username ) )->queryRow(  );

            if (( Config::get( 'authorization_protect_enable' ) == 1 && 5 < $model['errors'] )) {
				Yii::app(  )->user->setFlash( 'message', Yii::t( 'data', 'authorization_error_message' ) );
				Yii::app(  )->controller->redirect( 'message' );
			}


			if (!$model) {
				$this->errorCode = 1;
			} 
            else {
				if (( Config::get( 'email_activation_enable' ) == 1 && $model['activated'] != 1 )) {
					$this->errorCode = 2;
				} 
                else {
					if (!CPasswordHelper::verifypassword( $this->password, $model['password'] )) {
						$this->addLog( $model, 'ERROR' );
						$this->errorCode = 3;
					} 
                    else {
						$this->errorCode = self::ERROR_NONE;
						$this->_id = $model['id'];
						$this->username = $model['login'];
						$this->setState( 'email', $model['email'] );
						$this->setState( 'group', $model['group_id'] );
						$this->addLog( $model, 'SUCCESS' );
						$this->updateIp( $model['id'] );
					}
				}
			}

			return $this->errorCode == self::ERROR_NONE;
		}

		function getId() {
			return $this->_id;
		}

		function addLog($model, $status) {

			if (( ( Config::get( 'authorization_log_level' ) === 'NONE' && self:: $type === 'SITE' ) || ( ( Config::get( 'authorization_log_level' ) === 'ERROR' && $status === 'SUCCESS' ) && self::$type === 'SITE' ) )) {
				return false;
			}





		}

		function updateIp($id) {
			Yii::app(  )->db->createCommand(  )->update( 'users', array( 'ip_address' => $_SERVER['REMOTE_ADDR'] ), 'id=:id', array( ':id' => $id ) );
		}

		function user_browser() {

			$agent = $_SERVER['HTTP_USER_AGENT'];
			preg_match( '/(MSIE|Opera|Firefox|Chrome|Version|Opera Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/', $agent, $browser_info );

			$version = $browser = $browser_info[2];



			if (preg_match( '/Opera ([0-9.]+)/i', $agent, $opera )) {
				return 'Opera ' . $opera[1];
			}


			if ($browser == 'MSIE') {
				preg_match( '/(Maxthon|Avant Browser|MyIE2)/i', $agent, $ie );

				if ($ie) {
					return $ie[1] . ' based on IE ' . $version;
				}

				return 'IE ' . $version;
			}


			if ($browser == 'Firefox') {
				preg_match( '/(Flock|Navigator|Epiphany)\/([0-9.]+)/', $agent, $ff );

				if ($ff) {
					return $ff[1] . ' ' . $ff[2];
				}
			}


			if (( $browser == 'Opera' && $version == '9.80' )) {
				return 'Opera ' . substr( $agent, 0 - 5 );
			}


			if ($browser == 'Version') {
				return 'Safari ' . $version;
			}


			if (( !$browser && strpos( $agent, 'Gecko' ) )) {
				return 'Browser based on Gecko';
			}

			return $browser . ' ' . $version;
		}
	}

?>