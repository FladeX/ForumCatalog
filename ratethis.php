<?php
	include('db.php');
	sleep(1);
// Соединение с базой данных
$connection = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connection)
{
//	die("Невозможно подключиться к базе данных: <br />" . mysql_error());
	die();
}
// Выбор базы данных
$db_select = mysql_select_db($dbname);
if (!$db_select)
{
//	die("Невозможно выбрать базу данных: <br />" . mysql_error());
	die();
}
mysql_query("SET character_set_client = 'utf8'");
mysql_query("SET character_set_connection = 'utf8'");
mysql_query("SET character_set_results = 'utf8'");
mysql_query("SET NAMES 'utf8'");
mysql_set_charset("utf8");
	// код для определения ip с учетом прокси взят с http://www.tigir.com/php.htm
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
	{
		$ip = getenv("HTTP_CLIENT_IP");
	}
	elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
	{
		$ip = getenv("HTTP_X_FORWARDED_FOR");
	}
	elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
	{
		$ip = getenv("REMOTE_ADDR");
	}
	elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	else
	{
		$ip = "unknown";
	}
	if (isset($_POST['id']))
	{
		$id = (int) $_POST['id'];
	}
	if (isset($_POST['type']))
	{
		$type = (string) $_POST['type'];
	}
	$status = 0; // голосовал ли пользователь с таким $ip за форум с таким $id. Сначала примем, что нет
	$sql = "SELECT *
			FROM fc_votes
			WHERE ip = '" . $ip . "'";
	$result = mysql_query($sql);
	if (!$result)
	{
	//	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		die();
	}
	while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		if ($result_row['forum_id'] == $id)
		{
			$status = 1; // пользователь уже голосовал
		}
	}
	if ($status == 1)
	{
		$message = 'Вы уже голосовали за этот форум. Повторное голосование не разрешено.';
	}
	else
	{
		// добавление информации о текущем голосе
		$sql = "INSERT
				INTO fc_votes
				VALUES ('" . $id . "', '" . $type . "', '" . $ip . "', '" . time() . "')";
		$result = mysql_query($sql);
		if (!$result)
		{
		//	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			die();
		}
		// обновление рейтинга форума
		$sql = "UPDATE fc_forums ";
		if ($type == 'plus')
		{
			$sql .= "SET rating = (rating + 1)";
		}
		else
		{
			$sql .= "SET rating = (rating - 1)";
		}
		$sql .= " WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
		//	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			die();
		}
		$message = 'Вы успешно проголосовали за форум. Рейтинг будет обновлён при следующем просмотре форума.';
	}
	// обновление значение рейтинга на странице
	$sql = "SELECT rating
			FROM fc_forums
			WHERE id = " . $id;
	$result = mysql_query($sql);
	if (!$result)
	{
	//	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		die();
	}
	$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
	$rating = $result_row['rating'];
	echo $rating . " <script>alert(" . $message . ");</script>";
// Закрытие соединения с mysql
mysql_close($connection);
?>