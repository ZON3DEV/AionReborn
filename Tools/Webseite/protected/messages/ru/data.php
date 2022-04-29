<?php

return array(
	// Status
	// 'online' => 'on',
	// 'offline' => 'off',


	// Группы пользователей
	'group-1' => 'Пользователь',
	'group-8' => 'Администратор',


	// Раса с учетом пола
	'elyos_male' => 'Элиец',
	'elyos_female' => 'Элийка',
	'asmo_male' => 'Асмодианин',
	'asmo_female' => 'Асмодианка',


	// Уровни доступа
	'level-0' => 'Игрок',
	'level-1' => 'Helper',
	'level-2' => 'GM',
	'level-3' => 'Главный GM',
	'level-4' => 'Администратор',
	'level-5' => 'Главный Администратор',
	'level-6' => 'Developer',
	'level-7' => 'Developer',
	'level-8' => 'Developer',
	'level-9' => 'Developer',


	// Авторизация
	'login_error'					=> 'Аккаунт не найден <a class="question" href="'.Power::url('user/trouble').'"></a>',
	'password_error'				=> 'Аккаунт не найден <a class="question" href="'.Power::url('user/trouble').'"></a>',
	'not_activated' 				=> 'Аккаунт не активирован <a class="question" href="'.Power::url('user/trouble').'"></a>',
	'auth_error' 					=> 'Ошибка при авторизации <a class="question" href="'.Power::url('user/trouble').'"></a>',
	'authorization_error_message' 	=> 'Вы были заблокированы на 15 минут, так как 5 раз подряд ввели неправильный пароль',


	// Разное
	'data_updated' 					=>	'Данные изменены',
	'nothing_found'					=>	'Ничего не найдено',
	'info'							=>	'Информация',
	'no_messages'					=>	'Сообщений нет',


	// UserController
	'reg_limit_forbidden'			=>	'Вы уже регистрировались сегодня',
	'activation_email_title'		=>	'Активация аккаунта на сайте "{site_name}"',
	'activation_email_message'		=>	'Вы успешно зарегистрировались на сайте <a href="{site_url}">{site_name}</a><br /><br />Для активации Вашего аккаунта пройдите по ссылке: {link}</a>',
	'registration_complete'			=>	'Регистрация завершена',
	'activation_message'			=>	'Администрация требует подтверждения всех e-mail адресов, поэтому на адрес <b>{email}</b> было отправлено письмо с ссылкой для активации вашего аккаунта.<br /><br />
											После получения письма по электронной почте, вы должны посетить URL, указанный в письме, чтобы активировать аккаунт.',
	'account_created'				=>	'Аккаунт успешно создан',
	'account_activated'				=>	'Аккаунт активирован',
	'activation_success'			=>	'Аккаунт успешно активирован. Теперь Вы можете авторизоваться на сайте используя свой логин и пароль.',
	'account_already_activated'		=>	'Аккаунт уже активирован.',
	'activation_resend'				=>	'Письмо с инструкциями по активации аккаунта повторно отправлено на адрес {email}.',
	'restore_password'				=>	'Восстановление пароля.',
	'restore_message'				=>	'Письмо с дальнейшими инструкциями было отправлено на ваш e-mail адрес, указанный при регистрации.',
	'restore_email_title'			=>	'Восстановление пароля на сайте "{site_name}"',
	'restore_email_message'			=>	'Вы получили это письмо, поскольку был сделан запрос на восстановление вашего пароля на сайте "{site_name}".<br /><br />
											Если вы не делали такой запрос, проигнорируйте и удалите это сообщение.<br /><br />
											Если же вы в самом деле забыли свой пароль, перейдите по ссылке {link} для смены пароля.',
	'password_changed'				=>	'Пароль успешно изменен.',
	'changed_message'				=>	'Теперь вы можете зайти на сайт используя свой новый пароль.',
	'password_recovery'				=>	'Восстановление пароля',
	'your_new_password'				=>	'Ваш новый пароль',
	'wrong_password'				=>	'Неправильный пароль',
	'avatar_extension_error'		=>	'Неподходящий тип файла. Допустимы только .png, jpg, .gif',
	'avatar_size_error'				=>	'Сликшом большой размер файла. Максимум 1 Мб.',
	
	
	// NewsController
	'comment_added'					=>	'Комментарий добален',


	// ReferralController
	'all_kill'						=>	'Убийств',
	'ap'							=>	'AP',
	'exp' 							=>	'Опыта',
	'referral_clone'				=>	'Данный аккаунт опознан как клон. Бонусы не будут зачисленны.',
	'bonus_completed'				=>	'Бонус зачислен',


	// Webshop
	'membership_activated'			=>	'Привилегии активированы',
	'membership_exist'				=>	'Привилегии уже используются',
	'select_player'					=>	'Выберите персонажа',
	'insufficient_funds'			=>	'Недостаточно средств на счете',
	'logout_game'					=>	'Выйдите из игры',
	'webshop_mail_title'			=>	'Webshop - доставка',
	'webshop_mail_message'			=>	'Спасибо за покупку. Приятной игры. (ID:{id}, C:{count}, P:{price})',
	'successfully_purchased'		=>	'Предмет успешно приобретен. Спасибо за покупку',
	'item_enchanted'				=>	'Вещь успешно заточена',


	// BalanceController
	'user_not_found'				=>	'Пользователь не найден',
	'points_transferred'			=>	'Поинты перечислены',
	'input_user_name'				=>	'Введите имя пользователя',
	'select_account'				=>	'Выберите аккаунт',
	'quit_the_game'					=>	'Выйдите из игры',
	
	
	// RobokassaController
	'payment_successful'			=>	'Баланс успешно пополнен',
	'payment_canceled'				=>	'Платеж отменен',


	// AccountsControoler
	'login_already_taken'			=>	'Логин уже занят',
	'account_added'					=>	'Аккаунт добавлен',
	'account_already_added'			=>	'Аккаунт уже закреплен за другим пользователем',
	'fill_all_fields'				=>	'Заполните все поля',
	'passwords_not_match'			=>	'Пароли не совпадают',
	'wrong_current_password'		=>	'Указан неверный текущий пароль',
	'account_not_found'				=>	'Аккаунт не найден',
	'reset_password_title'			=>	'Сброс пароля от игрового аккаунта',
	'reset_password_message'		=>	'Письмо с новым паролем было отправлено на Ваш email-адрес.',
	'reset_password_email_title'	=>	'Восстановление пароля на сайте "{site_name}"',
	'reset_password_email_message'	=>	'Вы получили это письмо, поскольку был сделан сброс пароля от игрового аккаунта на сайте "{site_name}".<br /><br />Ваш новый пароль: {new_password}.',

);