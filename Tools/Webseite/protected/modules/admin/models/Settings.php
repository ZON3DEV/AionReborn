<?php

	class Settings extends CActiveRecord {
		public static function model($className = 'Settings') {
			return parent::model( $className );
		}

		function tableName() {
			return 'settings';
		}

		function rules() {
			return array( array( 'site_name, admin_email, hide_top_access_level, hide_gm_access_level, news_per_page, news_comment_enable, webshop_per_page, top_per_page,
					email_activation_enable, user_registration_limit, authorization_protect_enable, authorization_log_level, points_transfer_enable, demo_membership_enable, demo_membership_id
					referrals_enable, referrals_check_type, referrals_filter_name, referrals_filter_value, referrals_bonus_owner, referrals_bonus_referral', 'required' ), array( 'money_column, anticheat_salt', 'safe' ) );
		}

		function attributeLabels() {
			return array( 'site_name' => 'Website Name', 'admin_email' => 'Admin E-mail address', 'hide_top_access_level' => 'Hide players from tops with access level higher', 'hide_gm_access_level' => 'Hide players from the list of GMs with access level higher', 'news_per_page' => 'Number of news per page', 'news_comment_enable' => 'Enable news commenting', 'webshop_per_page' => 'The number of entries on the web shop page', 'top_per_page' => 'The number of entries on the top page', 'money_column' => 'Account Money Column Name<i class="ml5 btn-question" title="The name of the column in the database of the login server in which the money of the game account is stored"></i>', 'email_activation_enable' => 'Enable email confirmation<i class="ml5 btn-question" title="To activate the account, the user will have to follow the link provided in the letter"></i>', 'user_registration_limit' => 'Enable registration restriction<i class="ml5 btn-question" title="If enabled, then the user will be able to register only one account per day"></i>', 'authorization_protect_enable' => 'Enable authorization protection <i class="ml5 btn-question" title="If the user entered the password incorrectly 5 times in a row in the last 15 minutes, instead of logging in, he will be redirected to a page with a message that he was blocked for 15 minutes"></i>', 'authorization_log_level' => 'Record user authorization', 'anticheat_salt' => 'Extra characters for password <i class="ml5 btn-question" title="Adds a set of specified characters to the password. Actual for some anti-cheats. <br>Attention! After changing this parameter, users will need to reset the password for the game account"></i>', 'points_transfer_enable' => 'Enable Point Transfer', 'demo_membership_enable' => 'Enable Demo Premium', 'demo_membership_id' => 'Activate as demo premium', 'referrals_enable' => 'Enable referral system <i class="ml5 btn-question" title="Allows you to receive bonuses for registering new users"></i>', 'referrals_check_type' => 'Checking referral clones <i class="ml5 btn-question" title="Allows you to indirectly determine whether a referral is a clone or not. Checking by MAC address only works if there is a column in the accounts table in the login server database last_mac"></i>', 'referrals_filter_name' => 'Parameter for receiving a bonus', 'referrals_filter_value' => 'Bonus Value', 'referrals_bonus_owner' => 'Bonus to the owner', 'referrals_bonus_referral' => 'Referral bonus' );
		}

		function getmembershipList() {
			return Yii::app(  )->db->createCommand(  )->select( 'id, name' )->from( 'membership' )->order( 'id ASC' )->queryAll(  );
		}
	}

?>