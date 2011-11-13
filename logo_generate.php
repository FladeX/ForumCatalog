<?php
include('db.php');
include('functions.php');
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

$id = $_GET['id'];

$sql = "SELECT *
		FROM " . $dbprefix . "forums
		WHERE id = " . $id . "
			AND active = 1";
$result = mysql_query($sql);
if (!$result)
{
	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
}
// Вывод полученного результата
$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
if (($result_row['active'] == 1) && ($result_row['title'] != ''))
{
	$text = $result_row['url'];
	forum_logo($id, $text);
}
?>