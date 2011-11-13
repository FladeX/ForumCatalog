<?php
/**
* project: ForumCatalog
* version: 2.0
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: db.php
* last update: 2011.10.02
**/
// DataBase settings
$dbhost = '';
$dbport = '';
$dbname = '';
$dbuser = '';
$dbpass = '';
$dbprefix = '';

// Admin password
$admin_password = '';
$admin_session = '';

// Соединение с базой данных
$connection = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connection)
{
	die("Невозможно подключиться к базе данных: <br />" . mysql_error());
}
// Выбор базы данных
$db_select = mysql_select_db($dbname);
if (!$db_select)
{
	die("Невозможно выбрать базу данных: <br />" . mysql_error());
}
mysql_query("SET character_set_client = 'utf8'");
mysql_query("SET character_set_connection = 'utf8'");
mysql_query("SET character_set_results = 'utf8'");
mysql_query("SET NAMES 'utf8'");
mysql_set_charset("utf8");
?>