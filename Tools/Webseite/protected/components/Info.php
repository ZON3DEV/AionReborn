<?php

	class Info extends Controller {
		function getLevel($exp) {
			return Exp::getlvl( $exp );
		}

		function getRaceText($var) {
			if ($var === 'ELYOS') {
				return Yii::t( 'com', 'elyos' );
			}


			if (( $var === 'ASMODIANS' || $var === 'ASMODIAN' )) {
				return Yii::t( 'com', 'asmodians' );
			}

			return $var;
		}

		function getRaceIco($var) {
			if ($var === 'ELYOS') {
				return '<img src="' . @Power::url( 'images/classes/ely.png' ) . '" alt="" title = "' . Yii::t( 'com', 'elyos' ) . '" />';
			}


			if (( $var === 'ASMODIANS' || $var === 'ASMODIAN' )) {
				return '<img src="' . @Power::url( 'images/classes/asmo.png' ) . '" alt="" title = "' . Yii::t( 'com', 'asmodians' ) . '" />';
			}

			return $var;
		}

		function getClassText($var) {
			if ($var === 'WARRIOR') {
				return Yii::t( 'com', 'warrior' );
			}


			if ($var === 'GLADIATOR') {
				return Yii::t( 'com', 'gladiator' );
			}


			if ($var === 'TEMPLAR') {
				return Yii::t( 'com', 'templar' );
			}


			if ($var === 'SCOUT') {
				return Yii::t( 'com', 'scout' );
			}


			if ($var === 'ASSASSIN') {
				return Yii::t( 'com', 'assassin' );
			}


			if ($var === 'RANGER') {
				return Yii::t( 'com', 'ranger' );
			}


			if ($var === 'MAGE') {
				return Yii::t( 'com', 'mage' );
			}


			if ($var === 'SORCERER') {
				return Yii::t( 'com', 'sorcerer' );
			}


			if ($var === 'SPIRIT_MASTER') {
				return Yii::t( 'com', 'spiritMaster' );
			}


			if ($var === 'PRIEST') {
				return Yii::t( 'com', 'priest' );
			}


			if ($var === 'CLERIC') {
				return Yii::t( 'com', 'cleric' );
			}


			if ($var === 'CHANTER') {
				return Yii::t( 'com', 'chanter' );
			}


			if ($var === 'ARTIST') {
				return Yii::t( 'com', 'artist' );
			}


			if ($var === 'BARD') {
				return Yii::t( 'com', 'bard' );
			}


			if ($var === 'ENGINEER') {
				return Yii::t( 'com', 'engineer' );
			}


			if ($var === 'GUNNER') {
				return Yii::t( 'com', 'gunner' );
			}
			
			if ($var === 'RIDER') {
				return Yii::t( 'com', 'aethertech' );
			}
			
			if ($var === 'PAINTER') {
				return Yii::t( 'com', 'vandal' );
			}

			return $var;
		}

		function getClassIco($var) {
			if ($var === 'WARRIOR') {
				return '<img src="' . @Power::url( 'images/classes/warrior.png' ) . '" alt="" title="' . Yii::t( 'com', 'warrior' ) . '" />';
			}


			if ($var === 'GLADIATOR') {
				return '<img src="' . @Power::url( 'images/classes/gladiator.png' ) . '" alt="" title="' . Yii::t( 'com', 'gladiator' ) . '" />';
			}


			if ($var === 'TEMPLAR') {
				return '<img src="' . @Power::url( 'images/classes/templar.png' ) . '" alt="" title="' . Yii::t( 'com', 'templar' ) . '" />';
			}


			if ($var === 'SCOUT') {
				return '<img src="' . @Power::url( 'images/classes/scout.png' ) . '" alt="" title="' . Yii::t( 'com', 'scout' ) . '" />';
			}


			if ($var === 'ASSASSIN') {
				return '<img src="' . @Power::url( 'images/classes/assassin.png' ) . '" alt="" title="' . Yii::t( 'com', 'assassin' ) . '" />';
			}


			if ($var === 'RANGER') {
				return '<img src="' . @Power::url( 'images/classes/ranger.png' ) . '" alt="" title="' . Yii::t( 'com', 'ranger' ) . '" />';
			}


			if ($var === 'MAGE') {
				return '<img src="' . @Power::url( 'images/classes/mage.png' ) . '" alt="" title="' . Yii::t( 'com', 'mage' ) . '" />';
			}


			if ($var === 'SORCERER') {
				return '<img src="' . @Power::url( 'images/classes/sorcerer.png' ) . '" alt="" title="' . Yii::t( 'com', 'sorcerer' ) . '" />';
			}


			if ($var === 'SPIRIT_MASTER') {
				return '<img src="' . @Power::url( 'images/classes/spiritmaster.png' ) . '" alt="" title="' . Yii::t( 'com', 'spiritMaster' ) . '" />';
			}


			if ($var === 'PRIEST') {
				return '<img src="' . @Power::url( 'images/classes/priest.png' ) . '" alt="" title="' . Yii::t( 'com', 'priest' ) . '" />';
			}


			if ($var === 'CLERIC') {
				return '<img src="' . @Power::url( 'images/classes/cleric.png' ) . '" alt="" title="' . Yii::t( 'com', 'cleric' ) . '" />';
			}


			if ($var === 'CHANTER') {
				return '<img src="' . @Power::url( 'images/classes/chanter.png' ) . '" alt="" title="' . Yii::t( 'com', 'chanter' ) . '" />';
			}


			if ($var === 'ARTIST') {
				return '<img src="' . @Power::url( 'images/classes/artist.png' ) . '" alt="" title="' . Yii::t( 'com', 'artist' ) . '" />';
			}


			if ($var === 'BARD') {
				return '<img src="' . @Power::url( 'images/classes/bard.png' ) . '" alt="" title="' . Yii::t( 'com', 'bard' ) . '" />';
			}


			if ($var === 'ENGINEER') {
				return '<img src="' . @Power::url( 'images/classes/engineer.png' ) . '" alt="" title="' . Yii::t( 'com', 'engineer' ) . '" />';
			}


			if ($var === 'GUNNER') {
				return '<img src="' . @Power::url( 'images/classes/gunner.png' ) . '" alt="" title="' . Yii::t( 'com', 'gunner' ) . '" />';
			}
			
			if ($var === 'RIDER') {
				return '<img src="' . @Power::url( 'images/classes/rider.png' ) . '" alt="" title="' . Yii::t( 'com', 'aethertech' ) . '" />';
			}
			
			if ($var === 'PAINTER') {
				return '<img src="' . @Power::url( 'images/classes/painter.png' ) . '" alt="" title="' . Yii::t( 'com', 'vandal' ) . '" />';
			}

			return $var;
		}

		function getGenderIco($var) {
			if ($var === 'MALE') {
				return '<img src="' . @Power::url( 'images/classes/male.png' ) . '" alt="" title="' . Yii::t( 'com', 'male' ) . '" />';
			}


			if ($var === 'FEMALE') {
				return '<img src="' . @Power::url( 'images/classes/female.png' ) . '" alt="" title="' . Yii::t( 'com', 'female' ) . '" />';
			}

			return $var;
		}

		function getOnlineIco($var) {
			if ($var == 0) {
				return '<span class="status-offline" title="Offline"></span>';
			}


			if ($var == 1) {
				return '<span class="status-online" title="Online"></span>';
			}

			return $var;
		}

		function getAbyssRankText($var) {
			if ($var == 1) {
				return Yii::t( 'com', 'soldier9' );
			}


			if ($var == 2) {
				return Yii::t( 'com', 'soldier8' );
			}


			if ($var == 3) {
				return Yii::t( 'com', 'soldier7' );
			}


			if ($var == 4) {
				return Yii::t( 'com', 'soldier6' );
			}


			if ($var == 5) {
				return Yii::t( 'com', 'soldier5' );
			}


			if ($var == 6) {
				return Yii::t( 'com', 'soldier4' );
			}


			if ($var == 7) {
				return Yii::t( 'com', 'soldier3' );
			}


			if ($var == 8) {
				return Yii::t( 'com', 'soldier2' );
			}


			if ($var == 9) {
				return Yii::t( 'com', 'soldier1' );
			}


			if ($var == 10) {
				return Yii::t( 'com', 'officer1' );
			}


			if ($var == 11) {
				return Yii::t( 'com', 'officer2' );
			}


			if ($var == 12) {
				return Yii::t( 'com', 'officer3' );
			}


			if ($var == 13) {
				return Yii::t( 'com', 'officer4' );
			}


			if ($var == 14) {
				return Yii::t( 'com', 'officer5' );
			}


			if ($var == 15) {
				return Yii::t( 'com', 'general' );
			}


			if ($var == 16) {
				return Yii::t( 'com', 'greatGeneral' );
			}


			if ($var == 17) {
				return Yii::t( 'com', 'commander' );
			}


			if ($var == 18) {
				return Yii::t( 'com', 'governor' );
			}

			return $var;
		}

		function getLegionRankText($var) {
			if (( $var === 'VOLUNTEER' || $var === 'NEW_LEGIONARY' )) {
				return Yii::t( 'com', 'volunteer' );
			}


			if ($var === 'LEGIONARY') {
				return Yii::t( 'com', 'legionary' );
			}


			if ($var === 'CENTURION') {
				return Yii::t( 'com', 'centurion' );
			}


			if (( $var === 'DEPUTY' || $var === 'SUB_GENERAL' )) {
				return Yii::t( 'com', 'deputy' );
			}


			if ($var === 'BRIGADE_GENERAL') {
				return Yii::t( 'com', 'brigadeGeneral' );
			}

			return $var;
		}

		function equip($item, $slot) {
			if ($slot == 1) {
				return '<div style="position:absolute; top:24px; left:33px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 2) {
				return '<div style="position:absolute; top:24px; left:155px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 4) {
				return '<div style="position:absolute; top:65px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 8) {
				return '<div style="position:absolute; top:150px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 16) {
				return '<div style="position:absolute; top:191px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 32) {
				return '<div style="position:absolute; top:273px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 64) {
				return '<div style="position:absolute; top:108px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 128) {
				return '<div style="position:absolute; top:108px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 256) {
				return '<div style="position:absolute; top:232px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 512) {
				return '<div style="position:absolute; top:232px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 1024) {
				return '<div style="position:absolute; top:65px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 2048) {
				return '<div style="position:absolute; top:150px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 4096) {
				return '<div style="position:absolute; top:191px; left:14px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 8192) {
				return '<div style="position:absolute; top:3px; left:118px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 16384) {
				return '<div style="position:absolute; top:3px; left:68px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 32768) {
				return '<div style="position:absolute; top:40px; left:95px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 65536) {
				return '<div style="position:absolute; top:273px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 131072) {
				return '<div style="position:absolute; top:5px; left:12px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}


			if ($slot == 262144) {
				return '<div style="position:absolute; top:5px; left:175px;" class="equip-ico">' . Adb::url( 'item', $item, 3, false ) . '</div>';
			}

		}

		function equipTable($item, $slot) {
			if ($slot == 1) {
				return '<div class="equip-ico-1">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 2) {
				return '<div class="equip-ico-2">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 4) {
				return '<div class="equip-ico-4">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 8) {
				return '<div class="equip-ico-8">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 16) {
				return '<div class="equip-ico-16">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 32) {
				return '<div class="equip-ico-32">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 64) {
				return '<div class="equip-ico-64">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 128) {
				return '<div class="equip-ico-128">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 256) {
				return '<div class="equip-ico-256">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 512) {
				return '<div class="equip-ico-512">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 1024) {
				return '<div class="equip-ico-1024">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 2048) {
				return '<div class="equip-ico-2048">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 4096) {
				return '<div class="equip-ico-4096">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 8192) {
				return '<div class="equip-ico-8192">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 16384) {
				return '<div class="equip-ico-16384">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 32768) {
				return '<div class="equip-ico-65536">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 65536) {
				return '<div  class="equip-ico-65536">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 131072) {
				return '<div class="equip-ico-131072">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}


			if ($slot == 262144) {
				return '<div class="equip-ico-262144">' . Adb::url( 'item', $item, 1, false ) . '</div>';
			}

		}

		function getRaceGenderIco($race, $gender) {
			if (( $race === 'ELYOS' && $gender === 'MALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_00.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'elyos_male' ) . '" />';
			}


			if (( $race === 'ELYOS' && $gender === 'FEMALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_01.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'elyos_female' ) . '" />';
			}


			if (( $race === 'ASMODIANS' && $gender === 'MALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_10.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'asmo_male' ) . '" />';
			}


			if (( $race === 'ASMODIANS' && $gender === 'FEMALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_11.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'asmo_female' ) . '" />';
			}


			if (( $race === 'ASMODIAN' && $gender === 'MALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_10.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'asmo_male' ) . '" />';
			}


			if (( $race === 'ASMODIAN' && $gender === 'FEMALE' )) {
				return '<img src="' . @Power::url( 'images/classes/face_11.jpg' ) . '" alt="" title="' . Yii::t( 'data', 'asmo_female' ) . '" />';
			}

			return $race . $gender;
		}

		function getItemLocationText($var) {
			if (( $var == 0 || $var == 109 )) {
				return Yii::t( 'com', 'inventory' );
			}


			if (( $var == 1 || $var == 104 )) {
				return Yii::t( 'com', 'warehouse' );
			}


			if (( $var == 2 || $var == 17 )) {
				return Yii::t( 'com', 'warehouseAcc' );
			}


			if (( $var == 3 || $var == 25 )) {
				return Yii::t( 'com', 'warehouseLeg' );
			}


			if ($var == 126) {
				return Yii::t( 'com', 'broker' );
			}


			if ($var == 127) {
				return Yii::t( 'com', 'mail' );
			}


			if (( ( ( ( ( ( ( $var == 32 || $var == 33 ) || $var == 34 ) || $var == 35 ) || $var == 6 ) || $var == 12 ) || $var == 18 ) || $var == 24 )) {
				return Yii::t( 'com', 'pet' );
			}

			return $var;
		}

		function getMailTypeIco($var) {
			if ($var == 1) {
				return '<img src="' . @Power::url( 'images/bullet_green.png' ) . '" alt="" title="Express" />';
			}


			if ($var == 0) {
				return '<img src="' . @Power::url( 'images/bullet_black.png' ) . '" alt="" title="Regular" />';
			}

			return $var;
		}

		function getRaceGenderText($race, $gender) {
			if (( $race == 'ELYOS' && $gender == 'MALE' )) {
				return Yii::t( 'data', 'elyos_male' );
			}


			if (( $race == 'ELYOS' && $gender == 'FEMALE' )) {
				return Yii::t( 'data', 'elyos_female' );
			}


			if (( $race == 'ASMODIANS' && $gender == 'MALE' )) {
				return Yii::t( 'data', 'asmo_male' );
			}


			if (( $race == 'ASMODIANS' && $gender == 'FEMALE' )) {
				return Yii::t( 'data', 'asmo_female' );
			}


			if (( $race == 'ASMODIAN' && $gender == 'MALE' )) {
				return Yii::t( 'data', 'asmo_male' );
			}


			if (( $race == 'ASMODIAN' && $gender == 'FEMALE' )) {
				return Yii::t( 'data', 'asmo_female' );
			}

			return $race . $gender;
		}

		function getQuestStatus($var) {
			if ($var === 'START') {
				return '<img src="' . @Power::url( 'images/bullet_green.png' ) . '" alt="" title="' . Yii::t( 'data', 'start' ) . '" />';
			}


			if ($var === 'COMPLETE') {
				return '<img src="' . @Power::url( 'images/bullet_black.png' ) . '" alt="" title="' . Yii::t( 'data', 'complete' ) . '" />';
			}


			if ($var === 'REWARD') {
				return '<img src="' . @Power::url( 'images/bullet_orange.png' ) . '" alt="" title="' . Yii::t( 'data', 'reward' ) . '" />';
			}


			if ($var === 'LOCKED') {
				return '<img src="' . @Power::url( 'images/bullet_red.png' ) . '" alt="" title="' . Yii::t( 'data', 'locked' ) . '" />';
			}

			return $var;
		}

		function getAccessLevelIco($var) {
			return '<span class="access-level-' . $var . '" title="' . Yii::t( 'data', 'level-' . $var ) . '"></span>';
		}

		function getMembershipText($var) {
			if ($var == '0') {
				return 'Normal';
			}


			if ($var == '1') {
				return 'Premium';
			}


			if ($var == '2') {
				return 'VIP';
			}


			if ($var == '3') {
				return 'Premium+';
			}


			if ($var == '4') {
				return 'VIP+';
			}

			return $var;
		}

		function getMembershipIco($id) {
			if ($id == '0') {
				return '-';
			}


			if ($id == '1') {
				return '<img src="' . @Power::url( 'images/medal_silver.png' ) . '" alt="" title="Premium" />';
			}


			if ($id == '2') {
				return '<img src="' . @Power::url( 'images/medal_gold.png' ) . '" alt="" title="VIP" />';
			}


			if ($id == '3') {
				return '<img src="' . @Power::url( 'images/medal_silver_premium.png' ) . '" alt="" title="Premium+" />';
			}


			if ($id == '4') {
				return '<img src="' . @Power::url( 'images/medal_gold_premium.png' ) . '" alt="" title="VIP+" />';
			}

			return $id;
		}

		function getGroupIco($var) {
			return '<span class="group-' . $var . '" title="' . Yii::t( 'data', 'group-' . $var ) . '"></span>';
		}

		function getMembershipDuration($hours) {
			if ($hours == 0) {
				return '-';
			}


			if (24 < $hours) {
				return $hours / 24 . Yii::t( 'data', 'days' );
			}

			return $hours . Yii::t( 'data', 'hours' );
		}

		function getReferalFilterName($str) {
			if ($str == 'all_kill') {
				return Yii::t( 'data', 'all_kill' );
			}


			if ($str == 'ap') {
				return Yii::t( 'data', 'ap' );
			}


			if ($str == 'exp') {
				return Yii::t( 'data', 'exp' );
			}

			return $str;
		}

		function getAuthStatusIco($str) {
			if ($str === 'SUCCESS') {
				return '<span class="btn-success" title="' . Yii::t( 'com', 'success' ) . '"></span>';
			}


			if ($str === 'ERROR') {
				return '<span class="btn-error" title="' . Yii::t( 'com', 'error' ) . '"></span>';
			}

		}

		function getBrowserIco($str) {
			if (strripos( $str, 'chrome' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/chrome.png' ) . '" alt="" title="' . $str . '" />';
			}


			if (strripos( $str, 'firefox' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/firefox.png' ) . '" alt="" title="' . $str . '" />';
			}


			if (strripos( $str, 'opera' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/opera.png' ) . '" alt="" title="' . $str . '" />';
			}


			if (strripos( $str, 'msie' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/internet-explorer.png' ) . '" alt="" title="' . $str . '" />';
			}


			if (strripos( $str, 'ie' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/internet-explorer.png' ) . '" alt="" title="' . $str . '" />';
			}


			if (strripos( $str, 'safari' ) === 0) {
				return '<img src="' . @Power::url( 'images/browser/safari.png' ) . '" alt="" title="' . $str . '" />';
			}

			return '-';
		}
	}

?>