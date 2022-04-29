<?php
/**
*
* @ This file is created by decode.cu.cc
* @ deZender (PHP5 Decoder for ionCube Encoder)
*
* @	Version			:	1.1.7.0
* @	Author			:	Free4You
* @	Release on		:	14.03.2013
* @	Official site	:	http://decode.cu.cc
*
*/

	class SystemController extends Controller {
		var $layout = '//content';

		function actionIndex() {
			echo '<title>Проверка минимальных требований сервера</title>
		<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
		<style>
			body {font: 12pt Verdana, sans-serif !important; color:#444; background: #EBEDF0;}
			table {font: 10pt Verdana, sans-serif; color:#444; margin: auto; border-spacing: 10px;}
			td {border: solid 1px #888; background: #FAFAFA; padding: 10px 20px;}
		</style>
		<table>
			<tr>
				<td width=300px>Версия PHP: <b>' . PHP_VERSION . '</b></td>
				<td width=300px>' . $this->php_check(  ) . '</td>
			</tr>
			<tr>
				<td>Расширение pdo_mysql</td>
				<td>' . $this->pdo_mysql_check(  ) . '</td>
			</tr>
		</table>
		<br />';
		}

		function php_check() {
			if (5.20000000000000017763568 <= PHP_VERSION) {
				return '<font color="green">Успешно</font>';
			}

			return '<font color="red">Для работы скрипта необходимо обновить PHP до версии <b>5.2</b> или <b>5.3</b></font>';
		}

		function pdo_mysql_check() {
			if (extension_loaded( 'pdo_mysql' )) {
				return '<font color="green">Успешно</font>';
			}

			return '<font color="red">Для работы скрипта необходимо установить расширение PHP <b>pdo_mysql</b></font>';
		}

		function actionFull() {
			phpinfo(  );
		}
	}

?>