CREATE TABLE IF NOT EXISTS `log_auth` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` char(15) NOT NULL,
  `user_agent` char(32) NOT NULL,
  `type` enum('SITE','ADMIN') NOT NULL,
  `status` enum('SUCCESS','ERROR') NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_enchant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `player_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `item_unique_id` int(11) unsigned NOT NULL,
  `enchant_from` int(11) unsigned NOT NULL,
  `enchant_to` int(11) unsigned NOT NULL,
  `price` int(11) unsigned NOT NULL,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membership_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_payments` (
  `payment_id` char(16) NOT NULL,
  `system` enum('ROBOKASSA','INTERKASSA') NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sum` int(10) unsigned NOT NULL,
  `status` enum('PENDING','SUCCESS','FAIL') NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_referrals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `referral_id` int(10) unsigned NOT NULL,
  `status` enum('PENDING','SUCCESS','CLONE') NOT NULL DEFAULT 'PENDING',
  `created` int(10) unsigned NOT NULL,
  `completed` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_transfer_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender_id` int(10) unsigned NOT NULL,
  `recipient_id` int(10) unsigned NOT NULL,
  `type` enum('USER','ACCOUNT') NOT NULL,
  `sum` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `rating` enum('AIONTOPINFO','L2TOPRU','MMOTOPRU','GAMESITES200COM','GTOP100COM','TOPGORG','XTREMETOP100COM') NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `completed` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `log_webshop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `player_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `membership_type` tinyint(3) unsigned NOT NULL,
  `membership_duration` smallint(5) unsigned NOT NULL,
  `craftship_type` tinyint(3) unsigned NOT NULL,
  `craftship_duration` smallint(5) unsigned NOT NULL,
  `apship_type` tinyint(3) unsigned NOT NULL,
  `apship_duration` smallint(5) unsigned NOT NULL,
  `collectionship_type` tinyint(3) unsigned NOT NULL,
  `collectionship_duration` smallint(5) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(128) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `text_short` text NOT NULL,
  `text_full` text,
  `description` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comments_enable` tinyint(1) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `news_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `alt_name` char(32) NOT NULL,
  `image_id` char(32) DEFAULT NULL,
  `title` char(128) NOT NULL,
  `description` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `news_category` (`id`, `name`, `alt_name`, `image_id`, `title`, `description`, `keywords`) VALUES
	(1, 'Новости', 'news', 'news.png', 'Категория Новости', 'Категория Новости', 'Новости, news'),
	(2, 'Обновления', 'updates', 'drive.png', 'Категория Обновления', 'Категория Обновления', 'Обновления, updates');


CREATE TABLE IF NOT EXISTS `news_comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` varchar(1024) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `title` char(128) NOT NULL,
  `text` text NOT NULL,
  `description` char(255) DEFAULT NULL,
  `keywords` char(255) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `session` (
  `id` char(32) NOT NULL,
  `ip_address` int(10) unsigned NOT NULL DEFAULT '0',
  `user_agent` char(32) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(64) NOT NULL,
  `admin_email` varchar(32) NOT NULL,
  `hide_top_access_level` tinyint(1) unsigned NOT NULL,
  `hide_gm_access_level` tinyint(1) unsigned NOT NULL,
  `news_per_page` tinyint(1) unsigned NOT NULL,
  `news_comment_enable` tinyint(1) unsigned NOT NULL,
  `webshop_per_page` tinyint(1) unsigned NOT NULL,
  `_webshop_enchant_enable` tinyint(1) unsigned NOT NULL,
  `top_per_page` tinyint(1) unsigned NOT NULL,
  `money_column` varchar(32) NOT NULL,
  `_offline` tinyint(1) unsigned NOT NULL,
  `email_activation_enable` tinyint(1) unsigned NOT NULL,
  `user_registration_limit` tinyint(1) unsigned NOT NULL,
  `demo_membership_enable` tinyint(1) unsigned NOT NULL,
  `demo_membership_id` tinyint(1) unsigned NOT NULL,
  `authorization_protect_enable` tinyint(1) unsigned NOT NULL,
  `authorization_log_level` enum('ALL','ERROR','NONE') NOT NULL,
  `anticheat_salt` varchar(32) NOT NULL,
  `points_transfer_enable` tinyint(1) unsigned NOT NULL,
  `_points_transfer_commission` tinyint(3) unsigned NOT NULL,
  `referrals_enable` tinyint(1) unsigned NOT NULL,
  `referrals_check_type` enum('last_ip','last_mac') NOT NULL,
  `referrals_filter_name` enum('all_kill','ap','exp') NOT NULL,
  `referrals_filter_value` int(10) unsigned NOT NULL,
  `referrals_bonus_owner` int(10) unsigned NOT NULL,
  `referrals_bonus_referral` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings` (`id`, `site_name`, `admin_email`, `hide_top_access_level`, `hide_gm_access_level`, `news_per_page`, `news_comment_enable`, `webshop_per_page`, `_webshop_enchant_enable`, `top_per_page`, `money_column`, `_offline`, `email_activation_enable`, `user_registration_limit`, `demo_membership_enable`, `demo_membership_id`, `authorization_protect_enable`, `authorization_log_level`, `anticheat_salt`, `points_transfer_enable`, `_points_transfer_commission`, `referrals_enable`, `referrals_check_type`, `referrals_filter_name`, `referrals_filter_value`, `referrals_bonus_owner`, `referrals_bonus_referral`) VALUES
	(1, 'PowerWeb', 'admin@mail.com', 6, 6, 10, 1, 25, 1, 50, 'donatemoney', 0, 1, 0, 1, 4, 1, 'ALL', '', 1, 0, 1, 'last_ip', 'exp', 50000, 100, 50);


CREATE TABLE IF NOT EXISTS `settings_interkassa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ik_co_id` char(32) NOT NULL,
  `secret_key` char(32) NOT NULL,
  `test_key` char(32) NOT NULL,
  `ik_desc` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings_interkassa` (`id`, `ik_co_id`, `secret_key`, `test_key`, `ik_desc`) VALUES
	(1, 'xxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 'Пополнение баланса');


CREATE TABLE IF NOT EXISTS `settings_robokassa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mrh_login` char(32) NOT NULL,
  `mrh_pass1` char(32) NOT NULL,
  `mrh_pass2` char(32) NOT NULL,
  `inv_desc` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings_robokassa` (`id`, `mrh_login`, `mrh_pass1`, `mrh_pass2`, `inv_desc`) VALUES
	(1, 'Login', 'password1', 'password2', 'Order Description');


CREATE TABLE IF NOT EXISTS `settings_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mmotopru_link` char(128) NOT NULL,
  `mmotopru_bonus` tinyint(3) unsigned NOT NULL,
  `mmotopru_bonus_sms` tinyint(3) unsigned NOT NULL,
  `l2topru_link` char(128) NOT NULL,
  `l2topru_bonus` tinyint(3) unsigned NOT NULL,
  `aiontopinfo_link` char(128) NOT NULL,
  `aiontopinfo_bonus` tinyint(3) unsigned NOT NULL,
  `gamesites200com_link` char(128) NOT NULL,
  `gamesites200com_bonus` tinyint(3) unsigned NOT NULL,
  `gtop100com_link` char(128) NOT NULL,
  `gtop100com_bonus` tinyint(3) unsigned NOT NULL,
  `topgorg_link` char(128) NOT NULL,
  `topgorg_bonus` tinyint(3) unsigned NOT NULL,
  `xtremetop100com_link` char(128) NOT NULL,
  `xtremetop100com_bonus` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `settings_votes` (`id`, `mmotopru_link`, `mmotopru_bonus`, `mmotopru_bonus_sms`, `l2topru_link`, `l2topru_bonus`, `aiontopinfo_link`, `aiontopinfo_bonus`, `gamesites200com_link`, `gamesites200com_bonus`, `gtop100com_link`, `gtop100com_bonus`, `topgorg_link`, `topgorg_bonus`, `xtremetop100com_link`, `xtremetop100com_bonus`) VALUES
	(1, 'https://mmotop.ru/votes/xxxxxxxx.txt', 10, 25, 'http://aion.l2top.ru/editServ/?adminAct=lastVotes&uid=7&key=xxxxxxxx', 10, 'http://www.aion-top.info/voting/xxx', 10, 'http://gamesites200.com', 5, 'http://gtop100.com', 5, 'http://topg.org', 5, 'http://xtremetop100.com', 5);


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(32) NOT NULL,
  `group_id` tinyint(1) unsigned NOT NULL,
  `avatar_id` char(16) NOT NULL,
  `ip_address` char(128) NOT NULL,
  `money` int(10) unsigned NOT NULL DEFAULT '0',
  `activated` tinyint(1) unsigned NOT NULL,
  `code` char(45) DEFAULT NULL,
  `created` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `login`, `password`, `email`, `group_id`, `avatar_id`, `ip_address`, `money`, `activated`, `code`, `created`) VALUES
	(2, 'admin', '$2a$13$aUlUWOj0E96nI5qWY0k3sejpKDhAUqA2Yin.m2nAl77slQf0m6Yt.', 'admin@mail.com', 8, 0, '127.0.0.1', 0, 1, NULL, 1393045503);


CREATE TABLE IF NOT EXISTS `webshop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `item_name` varchar(64) DEFAULT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `change_quantity_enable` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `webshop_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(32) NOT NULL,
  `url` char(32) NOT NULL,
  `image_id` char(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `webshop_category` (`id`, `name`, `url`, `image_id`) VALUES
	(1, 'Краски', 'dye', 'dye.png'),
	(2, 'Питомцы', 'pets', 'pets.png'),
	(3, 'Крылья', 'wings', 'wings.png'),
	(4, 'Бижутерия', 'accessory', 'accessories.png'),
	(5, 'Головные уборы', 'head', 'head.png'),
	(6, 'Оружие', 'weapon', 'weapon.png'),
	(7, 'Броня', 'armor', 'armor.png'),
	(8, 'Костюмы', 'suits', 'suits.png'),
	(9, 'Свитки', 'scrolls', 'scrolls.png'),
	(10, 'Зелья', 'potions', 'potions.png'),
	(11, 'Маунты', 'mounts', 'mounts.png'),
	(12, 'Хаусинг', 'housing', 'housing.png');
