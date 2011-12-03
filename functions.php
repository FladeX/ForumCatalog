<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: function.php
* last update: 2011.12.03
**/
include('config.php');
include('db.php');

global $config;
// sape begin
global $sape;
if (!defined('_SAPE_USER')){
	define('_SAPE_USER', '22b924a215c5d8f07adb54d5d19ec55f'); 
}
require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php');
$o['charset'] = 'UTF-8';
$sape = new SAPE_client($o);
//unset($o);
// sape end
function category($category)
{
	global $dbprefix;
	// Получаем данные о категории
	if (($category == 0) || ($category == ''))
	{
		return "Категория форума не указана";
	}
	$sql = "SELECT *
			FROM " . $dbprefix . "category
			WHERE id = " . $category;
	$result = mysql_query($sql);
	if (!$result)
	{
		die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
	}
	$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
	return $result_row['title'];
}
/*
Функция для вывода списка категорий с учетом вложенности в раскрывающихся списках
*/
function category_list($tags, $catid)
{
	global $dbprefix;
	$category_list = '';
	//Получаем список категорий
	$sql = "SELECT *
			FROM " . $dbprefix . "category
			WHERE catid = 0";
	$result = mysql_query($sql);
	if (!$result)
	{
		die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
	}
	while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		if ($tags == "option")
		{
			if ($catid != $result_row['id'])
			{
				$category_list .= "								<option value=\"" . $result_row['id'] . "\">- " . $result_row['title'] . "</option>\n";
			}
			else
			{
				$category_list .= "								<option value=\"" . $result_row['id'] . "\" selected=\"selected\">- " . $result_row['title'] . "</option>\n";
			}
		}
		elseif ($tags == "li")
		{
			$category_list .= "								<li>" . $result_row['title'] . "</li>\n";
		}
		elseif ($tags == "h2")
		{
			$category_list .= "								<li><h2><a href=\"category" . $result_row['id'] . "/\">" . $result_row['title'] . "</a></h2>\n";
		}
		elseif ($tags == "div")
		{
			$category_list .= "								<div>" . $result_row['title'] . "<input name=\"category_\" type=\"hidden\" value=\"" . $result_row['id'] . "\" /></div>\n";
		}
		elseif ($tags == "td")
		{
//			$category_list .= "							<tr><td><img src=\"temp/images/s/" . $result_row['id'] . ".gif\" alt=\"" . $result_row['title'] . "\" /> " . $result_row['title'] . "<br />\n";
//			$category_list .= "							<tr><td>" . $result_row['title'] . "<br />\n";
			$category_list .= "							<tr><td><a href=\"category" . $result_row['id'] . "/\" style=\"color:#555;text-decoration:none;\">" . $result_row['title'] . "</a><br />\n";
		}
		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE catid =" . $result_row['id'];
		$result2 = mysql_query($sql);
		if (!$result2)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		if ($tags == "li")
		{
			$ul = false;
			$result3 = mysql_query($sql);
			$result3_row = mysql_fetch_array($result3, MYSQL_ASSOC);
			if ($result3_row['id'] > 0)
			{
				$category_list .= "								<li style=\"list-style:none;\">\n";
				$category_list .= "								<ul>\n";
				$ul = true;
			}
		}
		if ($tags == "h2")
		{
			$ul = false;
			$result3 = mysql_query($sql);
			$result3_row = mysql_fetch_array($result3, MYSQL_ASSOC);
			if ($result3_row['id'] > 0)
			{
				$ul = true;
			}
		}
		while ($result2_row = mysql_fetch_array($result2, MYSQL_ASSOC))
		{
			if ($tags == "option")
			{
				if ($catid != $result2_row['id'])
				{
					$category_list .= "								<option value=\"" . $result2_row['id'] . "\">--- " . $result2_row['title'] . "</option>\n";
				}
				else
				{
					$category_list .= "								<option value=\"" . $result2_row['id'] . "\" selected=\"selected\">--- " . $result2_row['title'] . "</option>\n";
				}
			}
			elseif ($tags == "div")
			{
				if ($catid != $result2_row['id'])
				{
					$category_list .= "								<div>--- " . $result2_row['title'] . "<input name=\"category_\" type=\"hidden\" value=\"" . $result2_row['id'] . "\" /></div>\n";
				}
				else
				{
					$category_list .= "								<div class=\"selected\">--- " . $result2_row['title'] . "<input name=\"category_\" type=\"hidden\" value=\"" . $result2_row['id'] . "\" /></div>\n";
				}
			}
			elseif ($tags == "li")
			{
				$category_list .= "								<li><a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a></li>\n";
			}
			elseif ($tags == "h2")
			{
				$category_list .= "								<a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a>, \n";
			}
			elseif ($tags == "td")
			{
				$category_list .= "								<a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a>, \n";
			}
		}
		if (($tags == "li") && $ul)
		{
			$category_list .= "								</ul>\n";
			$category_list .= "								</li>\n";
		}
		if (($tags == "h2") && $ul)
		{
			$category_list .= "								</li>\n";
		}
		if ($tags == "td")
		{
			$category_list .= "</td></tr>\n";
		}
	}
	return $category_list;
}
function email($type, $email)
{
	switch($type)
	{
		case "add":
			$subj = "Добавление в каталог";
			$text = "Вы добавили форум в каталог форумов http://forumcatalog.ru/ \n В ближайшее время модераторы каталога рассмотрят вашу заявку, и если с ней всё в порядке и ваш форум соответствует требованиям каталога, то ваш форум будет утверждён в каталоге. \n\n ------------- \n С уважением, администрация ForumCatalog.ru";
			break;
	}
	mail($email, $subj, $text, "Content-Type: text/plain; charset=\"utf-8\"\r\n" . "From: ForumCatalog.Ru <mail@forumcatalog.ru>\r\n" . "Reply-To: mail@forumcatalog.ru\r\n" . "Content-Type: text/plain; charset=\"utf-8\"\r\n" . "X-Mailer: PHP/" . phpversion());
}
function engine($engine)
{
	global $config;
	if (in_array($engine, $config['engines'])) {
		$forum = $config['engines'][$engine];
	} else {
		$forum = "";
	}

	return $forum;
}
function catalog_header($title)
{
	if ($title == '')
	{
		$title = 'ForumCatalog.ru';
	}
	echo "<!DOCTYPE HTML PUBLIC  \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">\n";
	echo "<html>\n";
	echo "<head>\n";
	echo "<title>" . $title . " &bull; каталог форумов</title>\n";
	echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />\n";
	echo "<meta name=\"keywords\" content=\"каталог форумов, подборка форумов, список форумов, форумы\" />\n";
	echo "<meta name=\"description\" content=\"самый специализированный белый каталог форумов в рунете\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://forumcatalog.ru/temp/style.css\" media=\"screen\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://forumcatalog.ru/markitup/skins/simple/style.css\" />\n";
	echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"http://forumcatalog.ru/markitup/sets/bbcode/style.css\" />\n";
	echo "<link rel=\"shortcut icon\" href=\"http://forumcatalog.ru/favicon.ico\" />\n";
	echo "<link rel=\"alternate\" type=\"application/atom+xml\" title=\"Каталог форумов\" href=\"http://forumcatalog.ru/news.xml\" />\n";
	echo "<!--[if IE 6]>\n";
	echo "<script src=\"http://forumcatalog.ru/temp/js/ie6_png.js\" type=\"text/javascript\"></script>\n";
	echo "<![endif]-->\n";
	echo "<script src=\"http://forumcatalog.ru/temp/js/jquery-1.4.2.min.js\" type=\"text/javascript\"></script>\n";
	echo "<script src=\"http://forumcatalog.ru/temp/js/scripts.js\" type=\"text/javascript\"></script>\n";
	echo "<script src=\"http://forumcatalog.ru/temp/js/search.js\" type=\"text/javascript\"></script>\n";
	echo "<script src=\"http://forumcatalog.ru/markitup/jquery.markitup.js\" type=\"text/javascript\"></script>\n";
	echo "<script src=\"http://forumcatalog.ru/markitup/sets/bbcode/set.js\" type=\"text/javascript\"></script>\n";
	echo "</head>\n";
	echo "<body>\n";
	echo "<!-- Yandex.Metrika -->\n";
	echo "<div style=\"display:none;\"><script type=\"text/javascript\">\n";
	echo "(function(w, c) {\n";
	echo "	(w[c] = w[c] || []).push(function() {\n";
	echo "		try {\n";
	echo "			w.yaCounter2245276 = new Ya.Metrika(2245276);\n";
	echo "			yaCounter2245276.clickmap(true);\n";
	echo " 			yaCounter2245276.trackLinks(true);\n";
	echo "\n";
	echo "		} catch(e) {}\n";
	echo "	});\n";
	echo "})(window, 'yandex_metrika_callbacks');\n";
	echo "</script></div>\n";
	echo "<script src=\"//mc.yandex.ru/metrika/watch.js\" type=\"text/javascript\" defer=\"defer\"></script>\n";
	echo "<noscript><div style=\"position:absolute\"><img src=\"//mc.yandex.ru/watch/2245276\" alt=\"\" /></div></noscript>\n";
	echo "<!-- /Yandex.Metrika -->\n";
	echo "\n";
	echo "<div class=\"container\">\n";
	echo "	<div class=\"push\">\n";
	echo "		<div class=\"top\">\n";
	echo "			<div class=\"links\">\n";
	echo "				<a href=\"http://forumcatalog.ru/search/\">Поиск</a>\n";
	echo "				<img src=\"../temp/images/top_links.jpg\" alt=\"\">\n";
	echo "				<a href=\"../news.xml\">RSS</a>\n";
	echo "				<img src=\"../temp/images/top_links.jpg\" alt=\"\">\n";
	echo "				<a href=\"http://twitter.com/forums_news\" rel=\"nofollow\">Твиттер</a>\n";
	echo "			</div>\n";
	echo "			<div class=\"logo\">\n";
	echo "				<a href=\"http://forumcatalog.ru/\"><img src=\"http://forumcatalog.ru/temp/images/logo.png\" alt=\"каталог форумов\"></a>\n";
	echo "			</div>\n";
	echo "			<div class=\"banner\">\n";
	echo "				<a href=\"http://forumadmins.ru/?r=2\" rel=\"nofollow\"><img src=\"../temp/images/forumadminsru.gif\" alt=\"\"></a>\n";
	echo "			</div>\n";
	echo "			<br class=\"clear\">\n";
	echo "			<div class=\"nav\">\n";
	echo "				<ul>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/rating/\">Рейтинг форумов</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/add/\">Добавить форум</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/refusal/\" title=\"Форумы, не прошедшие модерацию в каталоге\">Непринятые</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/statistics/\">Статистика</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/news/\">Новости</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumcatalog.ru/about/\">О каталоге</a>\n";
	echo "					</li>\n";
	echo "					<li>\n";
	echo "						<a href=\"http://forumadmins.ru/viewforum.php?f=14&amp;r=2\" title=\"Форум технической поддержки каталога\">Форум</a>\n";
	echo "					</li>\n";
	echo "				</ul>\n";
	echo "			</div>\n";
	echo "		</div>\n";
	echo "		<div class=\"main\">\n";
	echo "<div style=\"text-align:center;\"><script type=\"text/javascript\"><!--
google_ad_client = \"ca-pub-2747542108874185\";
/* Горизонтальный forumcatalog */
google_ad_slot = \"0956840546\";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type=\"text/javascript\"
src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">
</script><br /></div>\n";
	echo "			<div class=\"content\">\n";
	echo "				<div class=\"wrap\">\n";
}
function forum_logo($id, $text)
{
	$width = 468; // Ширина изображения
	$height = 60; // Высота изображения
	$font_size_1 = 10; // Размер шрифта текста
	$font_size_2 = 16; // Размер шрифта чисел
	$font1 = "fonts/OctemberScript.ttf"; // Путь к шрифту
	$font2 = "fonts/tahoma.ttf";

	$src = imagecreatetruecolor($width, $height); // создаём изображение
	$fon = imagecolorallocate($src, 255, 255, 255); // создаём фон
	imagefill($src, 0, 0, $fon); // заливаем изображение фоном
	//$color1 = imagecolorallocatealpha($src, 54, 133, 179, 0); // задаём цвет
	$color1 = imagecolorallocatealpha($src, 59, 73, 83, 0); // задаём цвет

	imagettftext($src, $font_size_1, 0, 15, 35, $color1, $font1, $text);

	//$title = "Рыболовный портал Северо-Западного Региона, игры о рыбалке,";
	$color2 = imagecolorallocatealpha($src, 92, 98, 89, 0);
	$filename = 'images/logo/' . $id . '.gif';

	//imagettftext($src, $font_size_2, 0, $pos_x, 50, $color2, $font2, $title);
	//header("Content-type: image/gif"); // выводим картинку
	imagegif($src, $filename);
}
function page_html($text) // на страницу с фильтрацией html-тэгов
{
	return htmlspecialchars(get_magic_quotes_gpc() ? stripslashes($text) : $text);
}
function rating($id, $type, $ip) // функция голосования за форумы aka рейтинг
{
	$status = 0; // голосовал ли пользователь с таким $ip за форум с таким $id. Сначала примем, что нет
	$sql = "SELECT *
			FROM fc_votes
			WHERE ip = '" . $ip . "'";
	$result = mysql_query($sql);
	if (!$result)
	{
		die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
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
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
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
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$message = 'Вы успешно проголосовали за форум. Рейтинг будет обновлён при следующем просмотре форума.';
	}
	return $message;
}
function strl($text)
{
	return preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $text, $dummy);
}
function validate($title, $url, $description, $engine, $portal, $cms, $category, $year, $email, $abq, $rss)
{
	global $dbprefix;
	$validate_result = "";
//	if (strlen($title) == 0)
	if (strl($title) == 0)
	{
		$validate_result .= "Вы не указали название форума.<br />\n";
	}
//	elseif (strlen($title) <= 5)
	elseif (strl($title) <= 5)
	{
		$validate_result .= "Вы указали слишком короткое название форума.<br />\n";
	}
//	elseif (strlen($title) >= 200)
	elseif (strl($title) >= 200)
	{
		$validate_result .= "Вы указали слишком длинное название форума.<br />\n";
	}
	if (strlen($url) == 0)
	{
		$validate_result .= "Вы не указали адрес форума.<br />\n";
	}
	elseif (strlen($url) <= 5)
	{
		$validate_result .= "Вы указали слишком короткий адрес форума.<br />\n";
	}
	elseif (strlen($url) >= 200)
	{
		$validate_result .= "Вы указали слишком длинный адрес форума.<br />\n";
	}
	if (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-zа-я0-9_-]{1,32}".
		"(?::[a-zа-я0-9_-]{1,32})?@)?)?(?:(?:[a-zа-я0-9-]{1,128}\.)+(?:com|net|".
		"org|mil|edu|arpa|gov|biz|info|aero|inc|name|рф|xn--p1ai|pro|[a-z]{2})|(?!0)(?:(?".
		"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
		"?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i", $url, $ok))
	{
		$validate_result .= "Вы указали некорректный адрес форума.<br />\n";
	}
//	if (strlen($description) == 0)
	if (strl($description) == 0)
	{
		$validate_result .= "Вы не указали описание форума.<br />\n";
	}
//	elseif (strlen($description) <= 200)
	elseif (strl($description) <= 200)
	{
		$validate_result .= "Вы указали слишком короткое описание форума.<br />\n";
	}
//	elseif (strlen($description) >= 45000)
	elseif (strl($description) >= 45000)
	{
		$validate_result .= "Вы указали слишком длинное описание форума.<br />\n";
	}
	if (($engine != "phpbb2") &&
		($engine != "phpbb3") &&
		($engine != "ipb1") &&
		($engine != "ipb2") &&
		($engine != "ipb3") &&
		($engine != "smf1") &&
		($engine != "smf2") &&
		($engine != "vb1") &&
		($engine != "vb2") &&
		($engine != "vb3") &&
		($engine != "vb4") &&
		($engine != "xen") &&
		($engine != "punbb") &&
		($engine != "dle") &&
		($engine != "exbb") &&
		($engine != "yabb") &&
		($engine != "vanilla") &&
		($engine != "bbpress") &&
		($engine != "pybb") &&
		($engine != "ucoz") &&
		($engine != "fluxbb") &&
		($engine != "diskuz") &&
		($engine != "borda.ru") &&
		($engine != "autobb") &&
		($engine != "diy") &&
		($engine != "other"))
	{
		$validate_result .= "Вы указали некорректный движок форума.<br />\n";
	}
	if (($portal != 0) && ($portal != 1))
	{
		$validate_result .= "Вы некорректно указали наличие или отсутствие портала на форуме.<br />\n";
	}
	if (($cms != "none") &&
		($cms != "danneo") &&
		($cms != "dle") &&
		($cms != "drupal") &&
		($cms != "e107") &&
		($cms != "hostcms") &&
		($cms != "instantcms") &&
		($cms != "instantsite") &&
		($cms != "joomla") &&
		($cms != "joostina") &&
		($cms != "klarnetcms") &&
		($cms != "kasselercms") &&
		($cms != "modx") &&
		($cms != "netcat") &&
		($cms != "php-fusion") &&
		($cms != "php-nuke") &&
		($cms != "phpshop") &&
		($cms != "runcms") &&
		($cms != "slaed") &&
		($cms != "seditio") &&
		($cms != "typo3") &&
		($cms != "twilight") &&
		($cms != "umi") &&
		($cms != "wordpress"))
	{
		$validate_result .= "Вы некорректно указали интеграцию с сайтом.<br />\n";
	}
	if ($category == "")
	{
		$validate_result .= "Вы не указали тематику форума.<br />\n";
	}
	else
	{
		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE id = " . $category;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
		if (strlen($result_row['title']) <= 2)
		{
			$validate_result .= "Вы указали некорректную тематику форума.<br />\n";
		}
	}
	if (($year != "1998") &&
		($year != "1999") &&
		($year != "2000") &&
		($year != "2001") &&
		($year != "2002") &&
		($year != "2003") &&
		($year != "2004") &&
		($year != "2005") &&
		($year != "2006") &&
		($year != "2007") &&
		($year != "2008") &&
		($year != "2009") &&
		($year != "2010") &&
		($year != "2011"))
	{
		$validate_result .= "Вы указали некорректный год запуска форума.<br />\n";
	}
	if ((strlen($rss) >= 1) && (strlen($rss) <= 5))
	{
		$validate_result .= "Вы указали слишком короткий адрес RSS форума.<br />\n";
	}
	elseif (strlen($rss) >= 200)
	{
		$validate_result .= "Вы указали слишком длинный адрес RSS форума.<br />\n";
	}
/*
	if ((strlen($rss) >= 1) && (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
		"(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
		"org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
		"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
		"?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i", $rss, $ok)))
	{
		$validate_result .= "Вы указали некорректный адрес RSS форума.<br />\n";
	}
*/
	if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$", $email))
	{
		$validate_result .= "Вы указали некорректный e-mail адрес.<br />\n";
	}
	else
	{
		list($alias, $domain) = split("@", $email);
		if (!checkdnsrr($domain, "MX"))
		{
			$validate_result .= "Вы указали несуществующий e-mail адрес.<br />\n";
		}
	}
/*	if (($abq != "Путин") &&
		($abq != "путин") &&
		($abq != "ПУТИН") &&
		($abq != "Медведев") &&
		($abq != "медведев") &&
		($abq != "МЕДВЕДЕВ") &&
		($abq != "Ельцин") &&
		($abq != "ельцин") &&
		($abq != "ЕЛЬЦИН"))
	{*/
//	if ($abq != "Джеймс Кэмерон") 2010.02.13
//	if ($abq != "Виктор Янукович") 2010.03.02
//	if ($abq != "Тим Бертон") 2010.03.29
//	if ($abq != "Григорий Перельман") 2010.06.11
//	if ($abq != "Жак-Ив Кусто") 2010.07.13
	if ($abq != "Диего Форлан")
	{
		$validate_result .= "Вы указали неправильный <a href=\"http://forumadmins.ru/viewtopic.php?f=14&t=100&r=2\" target=\"_blank\">шифр каталога</a>. Возможно, вы — робот.<br />\n";
	}
	return $validate_result;
}
?>