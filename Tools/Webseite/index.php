<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (!date_default_timezone_get()) date_default_timezone_set("UTC");
defined('YII_DEBUG') or define('YII_DEBUG', true);
require_once('framework/yii.php');
$app = Yii::createWebApplication('protected/config/main.php');
$app->run();

