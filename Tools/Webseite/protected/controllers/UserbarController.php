<?php

	class UserbarController extends Controller {
		function actionIndex() {
			@Power::checkauth(  );


			$post = new UserbarForm(  );
			$image = null;
			$playersDb = Yii::app(  )->gs->createCommand(  )->select( 'p.id, p.name, account_name' )->from( 'players p' )->where( 'ad.pow_user_id=:id', array( ':id' => @Power::userid(  ) ) )->leftJoin( @Config::db( 'ls' ) . '.account_data ad', 'ad.id = p.account_id' )->order( 'p.account_id' )->queryAll(  );

            $players = array(  );
			$i = 0;

			while ($i < count( $playersDb )) {
				$players[$playersDb[$i]['account_name']][] = $playersDb[$i];
				++$i;
			}


			if (isset( $_POST['UserbarForm'] )) {
				$post->attributes = $_POST['UserbarForm'];

				if ($post->validate(  )) {
					$player = Yii::app(  )->gs->createCommand(  )->select( 'p.name, exp, gender, race, player_class, weekly_kill, all_kill, hp, mp, l.name AS legion' )->from( 'players p' )->leftJoin( 'abyss_rank a', 'a.player_id=p.id' )->leftJoin( 'player_life_stats ls', 'ls.player_id=p.id' )->leftJoin( 'legion_members lm', 'lm.player_id = p.id' )->leftJoin( 'legions l', 'l.id=lm.legion_id' )->where( 'p.id=:id', array( ':id' => $post->id ) )->queryRow(  );


                    if (!isset( $player['all_kill'] )) {
						$player['all_kill'] = 0;
					}


					if (!isset( $player['weekly_kill'] )) {
						$player['weekly_kill'] = 0;
					}


					if (!isset( $player['legion'] )) {
						$player['legion'] = ' ';
					}

					Yii::app(  )->ih->load( $post->image )->text( $player['name'], Yii::app(  )->basePath . '/fonts/romic.ttf', 14, $this->rgb( $post->shadow ), CORNER_LEFT_TOP, 8, 8 )->text( $player['name'], Yii::app(  )->basePath . '/fonts/romic.ttf', 14, $this->rgb( $post->name ), CORNER_LEFT_TOP, 8, 7 )->text( $player['legion'], Yii::app(  )->basePath . '/fonts/monaco.ttf', 10, $this->rgb( $post->shadow ), CORNER_LEFT_TOP, 8, 36 )->text( $player['legion'], Yii::app(  )->basePath . '/fonts/monaco.ttf', 10, $this->rgb( $post->legion ), CORNER_LEFT_TOP, 8, 35 )->text( @Info::getclasstext( $player['player_class'] ) . ', ' . @Info::getracegendertext( $player['race'], $player['gender'] ), Yii::app(  )->basePath . '/fonts/verdana.ttf', 8, $this->rgb( $post->shadow ), CORNER_LEFT_BOTTOM, 8, 9 )->text( @Info::getclasstext( $player['player_class'] ) . ', ' . @Info::getracegendertext( $player['race'], $player['gender'] ), Yii::app(  )->basePath . '/fonts/verdana.ttf', 8, $this->rgb( $post->race_class ), CORNER_LEFT_BOTTOM, 8, 10 )->text( @Info::getlevel( $player['exp'] ) . ' уровень', Yii::app(  )->basePath . '/fonts/romic.ttf', 14, $this->rgb( $post->shadow ), CORNER_RIGHT_TOP, 8, 6 )->text( @Info::getlevel( $player['exp'] ) . ' уровень', Yii::app(  )->basePath . '/fonts/romic.ttf', 14, $this->rgb( $post->level ), CORNER_RIGHT_TOP, 8, 5 )->text( $player['all_kill'] . '/' . $player['weekly_kill'] . ' убийств', Yii::app(  )->basePath . '/fonts/monaco.ttf', 10, $this->rgb( $post->shadow ), CORNER_RIGHT_TOP, 8, 34 )->text( $player['all_kill'] . '/' . $player['weekly_kill'] . ' убийств', Yii::app(  )->basePath . '/fonts/monaco.ttf', 10, $this->rgb( $post->pvp ), CORNER_RIGHT_TOP, 8, 33 )->text( $player['hp'] . ' Hp, ' . $player['mp'] . ' Mp', Yii::app(  )->basePath . '/fonts/verdana.ttf', 8, $this->rgb( $post->shadow ), CORNER_RIGHT_BOTTOM, 8, 9 )->text( $player['hp'] . ' Hp, ' . $player['mp'] . ' Mp', Yii::app(  )->basePath . '/fonts/verdana.ttf', 8, $this->rgb( $post->hp_mp ), CORNER_RIGHT_BOTTOM, 8, 10 )->save( $_SERVER['DOCUMENT_ROOT'] . Yii::app(  )->baseUrl . '/userbars/' . $post->id . '.png' );
					$image = @Power::url( 'userbars' ) . $post->id . '.png';
				}
			}

			$this->render( '/userbar', array( 'post' => $post, 'players' => $players, 'image' => $image ) );
		}

		function rgb($hexStr, $returnAsString = false, $seperator = ',') {

			$hexStr = preg_replace( '/[^0-9A-Fa-f]/', '', $hexStr );
			$rgbArray = array( 0, 0, 0 );

			if (strlen( $hexStr ) == 6) {
				$colorVal = hexdec( $hexStr );
				$rgbArray[0] = 255 & $colorVal >> 16;
				$rgbArray[1] = 255 & $colorVal >> 8;
				$rgbArray[2] = 255 & $colorVal;
			} 
            else {
				if (strlen( $hexStr ) == 3) {
					$rgbArray[0] = hexdec( str_repeat( substr( $hexStr, 0, 1 ), 2 ) );
					$rgbArray[1] = hexdec( str_repeat( substr( $hexStr, 1, 1 ), 2 ) );
					$rgbArray[2] = hexdec( str_repeat( substr( $hexStr, 2, 1 ), 2 ) );
				} 
                else {
					return false;
				}
			}

			return ($returnAsString ? implode( $seperator, $rgbArray ) : $rgbArray);
		}

		function actionGetFiles() {
			@Power::checkajax(  );
			$images = scandir( 'images/userbars' );
			$images = array_slice( $images, 2 );
			$out = array(  );
			$i = 0;

			while ($i < count( $images )) {
				$out[$i]['value'] = $i + 1;
				$out[$i]['imageSrc'] = @Power::url( 'images/userbars', $images[$i] );
				++$i;
			}

			echo json_encode( $out );
		}
	}

?>