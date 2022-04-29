<?php

	class SettingsVotes extends CActiveRecord {
		public static function model($className = 'SettingsVotes') {
			return parent::model( $className );
		}

		function tableName() {
			return 'settings_votes';
		}

		function rules() {
			return array( array( 'mmotopru_link, l2topru_link, aiontopinfo_link, gamesites200com_link, gtop100com_link, topgorg_link, xtremetop100com_link', 'length', 'max' => 128 ), array( 'mmotopru_bonus, mmotopru_bonus_sms, l2topru_bonus, aiontopinfo_bonus, gamesites200com_bonus, gtop100com_bonus, topgorg_bonus, xtremetop100com_bonus', 'numerical', 'integerOnly' => true ) );
		}

		function attributeLabels() {
			return array( 'mmotopru_link' => 'Link to the page with the list of votes', 'mmotopru_bonus' => 'Voice Bonus', 'mmotopru_bonus_sms' => 'Bonus for SMS voice', 'l2topru_link' => 'Link to the page with the list of votes', 'l2topru_bonus' => 'Voice Bonus', 'aiontopinfo_link' => 'Link to the page with the list of votes', 'aiontopinfo_bonus' => 'Voice Bonus', 'gamesites200com_link' => 'Voting link', 'gamesites200com_bonus' => 'Voice Bonus', 'gtop100com_link' => 'Voting link', 'gtop100com_bonus' => 'Voice Bonus', 'topgorg_link' => 'Voting link', 'topgorg_bonus' => 'Voice Bonus', 'xtremetop100com_link' => 'Voting link', 'xtremetop100com_bonus' => 'Voice Bonus' );
		}
	}

?>