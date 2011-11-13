<?php
include('db.php');
include('functions.php');
catalog_header('Добавление форума');

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
if ($_POST['send'] == "send")
{
	$data_name = (string) $_POST['name'];
	$data_url = (string) $_POST['url'];
	$data_description = (string) $_POST['description'];
	$data_engine = (string) $_POST['engine'];
	$data_portal = (int) $_POST['portal'];
	$data_cms = (string) $_POST['cms'];
	$data_category = (int) $_POST['category'];
	$data_year = (int) $_POST['year'];
	$data_email = (string) $_POST['email'];
	$data_abq = (string) $_POST['abq'];
	$data_rss = (string) $_POST['rss'];
	// Удаление повторных пробелов
	$data_name = preg_replace("/  +/", " ", $data_name);
	$data_url = preg_replace("/ +/", "", $data_url);
	$data_description = preg_replace("/  +/", " ", $data_description);
	$data_rss = preg_replace("/ +/", "", $data_rss);
	$data_url = preg_replace("~^[a-z]+~ie", "strtolower('\\0')", $data_url); // все символы в нижний регистр
	$data_rss = preg_replace("~^[a-z]+~ie", "strtolower('\\0')", $data_rss); // все символы в нижний регистр
	if (!strstr($data_url, "://")) // добавляем http:// если его нет
	{
		$data_url = "http://" . $data_url;
	}
/*
	if (!strstr($data_rss, "://")) // добавляем http:// если его нет
	{
		$data_rss = "http://" . $data_rss;
	}
*/
	// Проверка входящих данных
	$valid = validate($data_name, $data_url, $data_description, $data_engine, $data_portal, $data_cms, $data_category, $data_year, $data_email, $data_abq, $data_rss);
	if ($valid == "")
	{
		// Добавление форума в базу данных
		$sql = "INSERT
				INTO " . $dbprefix . "forums
				VALUES (NULL, '" . $data_name . "', '" . $data_url . "', '" . $data_description . "', '" . $data_engine . "', '" . $data_portal . "', '" . $data_cms . "', '" . $data_category . "', '" . $data_year . "', '" . $data_email . "', '0', '', '" . time() . "', '0', '" . $data_rss . "', '0')";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		echo "					<div class=\"news\">\n";
		echo "						<h1>Добавление форума</h1>\n";
		echo "						<p>Ваша заявка принята к рассмотрению! В ближайшее время модераторы каталога рассмотрят её и, возможно, одобрят её для публикации в каталоге.</p>\n";
		email("add", $data_email);
		//forum_logo($data_id, $data_url);
	}
	else
	{
		echo "					<div class=\"news\">\n";
		echo "						<h1>Добавление форума</h1>\n";
		echo $valid;
	}
}
else
{
	echo "					<div class=\"forumadd\">\n";
	echo "						<h1>Добавление форума</h1>\n";
	echo "						<form method=\"post\" action=\"../add/\">\n";
	echo "						<div class=\"column\">\n";
	echo "							Название форума\n";
	echo "							<div class=\"textfield\">\n";
	echo "								<input type=\"text\" name=\"name\" id=\"name\" value=\"\">\n";
	echo "							</div>\n";
	echo "							<div class=\"formbox\">\n";
	echo "								<div class=\"box_top\">\n";
	echo "									<div class=\"box_bottom\">\n";
	echo "										О чём ваш форум?<br>\n";
	echo "										Для кого форум предназначен в первую очередь?<br>\n";
	echo "										Какие вопросы обсуждаются на форуме?<br>\n";
	echo "										Какие основные тематические разделы есть на форуме?<br>\n";
	echo "										Чем форум отличается от аналогичных по тематике?\n";
	echo "									</div>\n";
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							Движок форума\n";
	echo "							<div class=\"selectfield\">\n";
	echo "								<div class=\"inner\">\n";
	echo "								</div>\n";
	echo "								<input name=\"engine\" type=\"hidden\" value=\"\">\n";
	echo "								<div class=\"options\">\n";
	echo "									<div>phpBB 2.x<input name=\"engine_\" type=\"hidden\" value=\"phpbb2\"></div>\n";
	echo "									<div>phpBB 3.x<input name=\"engine_\" type=\"hidden\" value=\"phpbb3\"></div>\n";
	echo "									<div>IPB 1.x<input name=\"engine_\" type=\"hidden\" value=\"ipb1\"></div>\n";
	echo "									<div>IPB 2.x<input name=\"engine_\" type=\"hidden\" value=\"ipb2\"></div>\n";
	echo "									<div>IPB 3.x<input name=\"engine_\" type=\"hidden\" value=\"ipb3\"></div>\n";
	echo "									<div>SMF 1.x<input name=\"engine_\" type=\"hidden\" value=\"smf1\"></div>\n";
	echo "									<div>SMF 2.x<input name=\"engine_\" type=\"hidden\" value=\"smf2\"></div>\n";
	echo "									<div>vBulletin 1.x<input name=\"engine_\" type=\"hidden\" value=\"vb1\"></div>\n";
	echo "									<div>vBulletin 2.x<input name=\"engine_\" type=\"hidden\" value=\"vb2\"></div>\n";
	echo "									<div>vBulletin 3.x<input name=\"engine_\" type=\"hidden\" value=\"vb3\"></div>\n";
	echo "									<div>vBulletin 4.x<input name=\"engine_\" type=\"hidden\" value=\"vb4\"></div>\n";
	echo "									<div>XenForo<input name=\"engine_\" type=\"hidden\" value=\"xen\"></div>\n";
	echo "									<div>punBB<input name=\"engine_\" type=\"hidden\" value=\"punbb\"></div>\n";
	echo "									<div>DLE Forum<input name=\"engine_\" type=\"hidden\" value=\"dle\"></div>\n";
	echo "									<div>ExBB<input name=\"engine_\" type=\"hidden\" value=\"exbb\"></div>\n";
	echo "									<div>YaBB<input name=\"engine_\" type=\"hidden\" value=\"yabb\"></div>\n";
	echo "									<div>Vanilla<input name=\"engine_\" type=\"hidden\" value=\"vanilla\"></div>\n";
	echo "									<div>bbPress (Wordpress)<input name=\"engine_\" type=\"hidden\" value=\"bbpress\"></div>\n";
	echo "									<div>PyBB<input name=\"engine_\" type=\"hidden\" value=\"pybb\"></div>\n";
	echo "									<div>UcoZ<input name=\"engine_\" type=\"hidden\" value=\"ucoz\"></div>\n";
	echo "									<div>FluxBB<input name=\"engine_\" type=\"hidden\" value=\"fluxbb\"></div>\n";
	echo "									<div>Discuz<input name=\"engine_\" type=\"hidden\" value=\"discuz\"></div>\n";
	echo "									<div>Borda.ru / forum24.ru<input name=\"engine_\" type=\"hidden\" value=\"borda.ru\"></div>\n";
	echo "									<div>AutoBB (Joomla)<input name=\"engine_\" type=\"hidden\" value=\"autobb\"></div>\n";
	echo "									<div>Самописный движок<input name=\"engine_\" type=\"hidden\" value=\"diy\"></div>\n";
	echo "									<div>Другой вариант<input name=\"engine_\" type=\"hidden\" value=\"other\"></div>\n";
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							Портал на движке форума\n";
	echo "							<div class=\"selectfield\">\n";
	echo "								<div class=\"inner\">\n";
	echo "								</div>\n";
	echo "								<input name=\"portal\" type=\"hidden\" value=\"\">\n";
	echo "								<div class=\"options\">\n";
	echo "									<div class=\"selected\">Не используется<input name=\"portal_\" type=\"hidden\" value=\"0\"></div>\n";
	echo "									<div>Используется<input name=\"portal_\" type=\"hidden\" value=\"1\"></div>\n";
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							Тематика форума\n";
	echo "							<div class=\"selectfield\">\n";
	echo "								<div class=\"inner\">\n";
	echo "								</div>\n";
	echo "								<input type=\"hidden\" name=\"category\" value=\"\">\n";
	echo "								<div class=\"options\">\n";
	echo									category_list("div", 0);
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							RSS форума (необязательно)\n";
	echo "							<div class=\"textfield\">\n";
	echo "								<input type=\"text\" name=\"rss\" id=\"rss\" value=\"\">\n";
	echo "							</div>\n";
	echo "							Шифр с <a href=\"http://forumadmins.ru/viewtopic.php?f=14&t=100&r=2\" target=\"_blank\">ForumAdmins</a>:\n";
	echo "							<div class=\"textfield\">\n";
	echo "								<input type=\"text\" name=\"abq\" id=\"abq\" value=\"\">\n";
	echo "							</div>\n";
	echo "						</div>\n";
	echo "						<div class=\"column\">\n";
	echo "							Адрес форума\n";
	echo "							<div class=\"textfield\">\n";
	echo "								<input type=\"text\" name=\"url\" id=\"url\" value=\"\">\n";
	echo "							</div>\n";
	echo "							Описание форума\n";
	echo "							<div class=\"textareafield\">\n";
	echo "								<script type=\"text/javascript\">\n";
	echo "									$(document).ready(function() {\n";
	echo "										$(\"#description\").markItUp(mySettings);\n";
	echo "									});\n";
	echo "								</script>\n";
	echo "								<textarea name=\"description\" id=\"description\" cols=\"5\" rows=\"5\"></textarea>\n";
	echo "							</div>\n";
	echo "							Интеграция с CMS\n";
	echo "							<div class=\"selectfield\">\n";
	echo "								<div class=\"inner\">\n";
	echo "								</div>\n";
	echo "								<input type=\"hidden\" name=\"cms\" id=\"cms\" value=\"\">\n";
	echo "								<div class=\"options\">\n";
	echo "									<div>Нет интеграции с cms<input name=\"cms_\" type=\"hidden\" value=\"none\"></div>\n";
	echo "									<div>Danneo CMS<input name=\"cms_\" type=\"hidden\" value=\"danneo\"></div>\n";
	echo "									<div>DLE (DataLife Engine)<input name=\"cms_\" type=\"hidden\" value=\"dle\"></div>\n";
	echo "									<div>Drupal<input name=\"cms_\" type=\"hidden\" value=\"drupal\"></div>\n";
	echo "									<div>e107<input name=\"cms_\" type=\"hidden\" value=\"e107\"></div>\n";
	echo "									<div>Host CMS<input name=\"cms_\" type=\"hidden\" value=\"hostcms\"></div>\n";
	echo "									<div>Instant CMS<input name=\"cms_\" type=\"hidden\" value=\"instantcms\"></div>\n";
	echo "									<div>Instant Site<input name=\"cms_\" type=\"hidden\" value=\"instantsite\"></div>\n";
	echo "									<div>Joomla<input name=\"cms_\" type=\"hidden\" value=\"joomla\"></div>\n";
	echo "									<div>Joostina<input name=\"cms_\" type=\"hidden\" value=\"joostina\"></div>\n";
	echo "									<div>Klarnet CMS<input name=\"cms_\" type=\"hidden\" value=\"klarnetcms\"></div>\n";
	echo "									<div>Kasseler CMS<input name=\"cms_\" type=\"hidden\" value=\"kasselercms\"></div>\n";
	echo "									<div>ModX<input name=\"cms_\" type=\"hidden\" value=\"modx\"></div>\n";
	echo "									<div>NetCat<input name=\"cms_\" type=\"hidden\" value=\"netcat\"></div>\n";
	echo "									<div>php-fusion<input name=\"cms_\" type=\"hidden\" value=\"php-fusion\"></div>\n";
	echo "									<div>PHP-Nuke<input name=\"cms_\" type=\"hidden\" value=\"php-nuke\"></div>\n";
	echo "									<div>PHPShop<input name=\"cms_\" type=\"hidden\" value=\"phpshop\"></div>\n";
	echo "									<div>RunCms<input name=\"cms_\" type=\"hidden\" value=\"runcms\"></div>\n";
	echo "									<div>Slaed CMS<input name=\"cms_\" type=\"hidden\" value=\"slaed\"></div>\n";
	echo "									<div>Seditio CMS<input name=\"cms_\" type=\"hidden\" value=\"seditio\"></div>\n";
	echo "									<div>TYPO3<input name=\"cms_\" type=\"hidden\" value=\"typo3\"></div>\n";
	echo "									<div>Twilight CMS<input name=\"cms_\" type=\"hidden\" value=\"twilight\"></div>\n";
	echo "									<div>UMI CMS<input name=\"cms_\" type=\"hidden\" value=\"umi\"></div>\n";
	echo "									<div>Wordpress<input name=\"cms_\" type=\"hidden\" value=\"wordpress\"></div>\n";
	echo "									<div>Самописная cms<input name=\"cms_\" type=\"hidden\" value=\"diy\"></div>\n";
	echo "									<div>Другая cms<input name=\"cms_\" type=\"hidden\" value=\"other\"></div>\n";
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							Год запуска\n";
	echo "							<div class=\"selectfield\">\n";
	echo "								<div class=\"inner\">\n";
	echo "								</div>\n";
	echo "								<input type=\"hidden\" name=\"year\" value=\"\">\n";
	echo "								<div class=\"options\">\n";
	echo "									<div>----<input name=\"year_\" type=\"hidden\" value=\"0\"></div>\n";
	echo "									<div>1998<input name=\"year_\" type=\"hidden\" value=\"1998\"></div>\n";
	echo "									<div>1999<input name=\"year_\" type=\"hidden\" value=\"1999\"></div>\n";
	echo "									<div>2000<input name=\"year_\" type=\"hidden\" value=\"2000\"></div>\n";
	echo "									<div>2001<input name=\"year_\" type=\"hidden\" value=\"2001\"></div>\n";
	echo "									<div>2002<input name=\"year_\" type=\"hidden\" value=\"2002\"></div>\n";
	echo "									<div>2003<input name=\"year_\" type=\"hidden\" value=\"2003\"></div>\n";
	echo "									<div>2004<input name=\"year_\" type=\"hidden\" value=\"2004\"></div>\n";
	echo "									<div>2005<input name=\"year_\" type=\"hidden\" value=\"2005\"></div>\n";
	echo "									<div>2006<input name=\"year_\" type=\"hidden\" value=\"2006\"></div>\n";
	echo "									<div>2007<input name=\"year_\" type=\"hidden\" value=\"2007\"></div>\n";
	echo "									<div>2008<input name=\"year_\" type=\"hidden\" value=\"2008\"></div>\n";
	echo "									<div>2009<input name=\"year_\" type=\"hidden\" value=\"2009\"></div>\n";
	echo "									<div>2010<input name=\"year_\" type=\"hidden\" value=\"2010\"></div>\n";
	echo "									<div>2011<input name=\"year_\" type=\"hidden\" value=\"2011\"></div>\n";
	echo "								</div>\n";
	echo "							</div>\n";
	echo "							Электронная почта\n";
	echo "							<div class=\"textfield\">\n";
	echo "								<input type=\"text\" name=\"email\" value=\"\">\n";
	echo "							</div>\n";
	echo "							<div class=\"clink\">\n";
	echo "								<input type=\"reset\" value=\"Очистить все\">\n";
	echo "							</div>\n";
	echo "						</div>\n";
	echo "						<div class=\"clear\"></div>\n";
	echo "						<div class=\"submit\">\n";
	echo "							<input type=\"hidden\" value=\"send\" name=\"send\" id=\"send\" style=\"display:none;\" />\n";
	echo "							<input type=\"submit\" value=\"Отправить\">\n";
	echo "						</div>\n";
	echo "						</form>\n";
}
// Закрытие соединения с mysql
mysql_close($connection);
?>
<?php
include('temp/footer.tpl');
?>