<?php

return array(
	'message' => 'site/message',

	// UserController
	'user/registration/<id:\d+>' => 'user/registration',
	'user/activation/<code:\w+>' => 'user/activation',
	'user/changepassword/<code:\w+>' => 'user/changepassword',

	// NewsController
	'news/page/<page:\d+>' => 'news/index',
	'news/category/<name:\w+>/page/<page:\d+>' => 'news/category',
	'news/category/<name:\w+>' => 'news/category',

	// PageController
	'page/<name:\w+>' => 'page/view',

	// PlayerController
	'player/captcha' => 'player/captcha',
	'player/search' => 'player/search',
	'player/<name:\w+>'=>'player/view',

	// WebshopController
	'webshop/buy'=>'webshop/buy',
	'webshop/membership'=>'webshop/membership',
	'webshop/buymembership'=>'webshop/buymembership',
	'webshop/enchant'=>'webshop/enchant',
	'webshop/getenchantprice'=>'webshop/getenchantprice',
	'webshop/<name:\w+>'=>'webshop/view',
	'webshop/<name:\w+>/<id:\d+>'=>'webshop/view',

	// LegionController
	'legion/<name:.*?>'=>'legion/view',

	// Admin CP
	'admin/message' => 'admin/default/message',
	'admin/news/allowcomment/<id:\d+>/*' => 'admin/news/allowcomment',
	'admin/account/<id:\d+>' => 'admin/account/view',

	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
	'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
	'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
);
