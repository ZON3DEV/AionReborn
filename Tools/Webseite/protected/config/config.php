<?php
$config = array(
	// Данные для подключения к БД обвязки
	'hostWeb' => 'localhost',			// адрес базы данных
	'dbnameWeb' => 'pow',				// имя базы данных
	'userWeb' => 'root',				// логин
	'passWeb' => 'changme',			// пароль

	// Данные для подключения к БД форума
	'hostForum' => 'localhost',			// адрес базы данных
	'dbnameForum' => 'forum',			// имя базы данных
	'userForum' => 'root',				// логин
	'passForum' => 'changme',			// пароль
	'prefixForum' => '',				// префикс таблиц

	// Данные для подключения к БД логинсервера
	'hostLs' => 'localhost',			// адрес базы данных
	'dbnameLs' => 'al_server_ls',			// имя базы данных
	'userLs' => 'root',					// логин
	'passLs' => 'changme',				// пароль

	// Данные для подключения к БД геймсервера
	'hostGs' => 'localhost',			// адрес базы данных
	'dbnameGs' => 'al_server_gs',			// имя базы данных
	'userGs' => 'root',					// логин
	'passGs' => 'changme',				// пароль

	// Общие настройки
	'url' => 'http://localhost/',			// адрес главной страницы (слэш на конце обязателен)
	'theme' => 'light',					// название темы
	'lang' => 'en',						// язык сайта
	'caching' => 'CFileCache',			// кеширование (CFileCache - файлы, CDbCache - SQLite, CDummyCache - отключено)
);

$params = array(
	'lsIp' => 'localhost',				// ip адрес логин-сервера
	'lsPort' => '2106',					// порт логин-сервера
	'gsIp' => 'localhost',				// ip адрес гейм-сервера
	'gsPort' => '7777',					// порт гейм-сервера
);