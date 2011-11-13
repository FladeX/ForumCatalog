<?php
include('db.php');
include('functions.php');
include('markitup.bbcode-parser.php');
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

if (isset($_GET['mode']))
{
	$mode = $_GET['mode'];
}
else
{
	$mode = '';
}
switch($mode)
{
	case "view":
		$id = $_GET['id'];
		if (!$id)
		{
			die("Указанного форума не существует!");
		}
		// Прибавляем количество просмотров
		$sql = "UPDATE " . $dbprefix . "forums
				SET views = (views + 1)
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Получаем данные о форуме
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
			if (($result_row['active'] != 1) || ($result_row['title'] == ''))
			{
				header('refresh: 3; url=http://forumcatalog.ru/');
				catalog_header('404');
				echo "					<div class=\"news\">\n";
				echo "						<h1>404 - не найдено</h1>\n";
				echo "							<div class=\"item\">\n";
				echo "								<p>Запрошенный форум отсутствует в каталоге</p>\n";
				echo "							</div>\n";
				include('temp/footer.tpl');
				exit;
			}
			else
			{
			catalog_header($result_row['title']);
			if ($_POST['send'] == 'send')
			{
				if (($_POST['type'] == 'plus') || ($_POST['type'] == 'minus'))
				{
					// код для определения ip с учетом прокси взят с http://www.tigir.com/php.htm
					if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
						$ip = getenv("HTTP_CLIENT_IP");

					elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
						$ip = getenv("HTTP_X_FORWARDED_FOR");

					elseif (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
						$ip = getenv("REMOTE_ADDR");

					elseif (!empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
						$ip = $_SERVER['REMOTE_ADDR'];

					else
						$ip = "unknown";

					$message = " (" . rating($result_row['id'], $_POST['type'], $ip) . ")";
				}
				else
				{
					$message = '';
				}
			}
			echo "					<div class=\"forumdetails\">\n";
			echo "						<h1>" . page_html($result_row['title']) . "</h1>\n";
			echo "						<div class=\"cbbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<div class=\"left\">\n";
			echo "										Адрес форума:\n";
			echo "									</div>\n";
			echo "									<div class=\"intext\">\n";
			echo "										<a href=\"" . $result_row['url'] . "\">" . page_html($result_row['url']) . "</a>\n";
			echo "									</div>\n";
			echo "									<div class=\"clear\"></div>\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"cbbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<div class=\"left\">\n";
			echo "										Описание форума:\n";
			echo "									</div>\n";
			echo "									<div class=\"intext\">\n";
			$description = page_html($result_row['description']);
			$description = BBCode2Html($description);
//			echo "										" . page_html($result_row['description']) . "\n";
			echo "										" . $description . "\n";
			echo "									</div>\n";
			echo "									<div class=\"clear\"></div>\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"csbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<span>Тематика форума</span><br>\n";
			echo "									" . category($result_row['cat']) . "\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"csbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<span>Просмотры</span><br>\n";
			echo "									" . $result_row['views'] . "\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"csbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<span>Движок форума:</span><br>\n";
			echo "									" . engine($result_row['engine']) . "\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"csbox\">\n";
			echo "							<div class=\"box_top\">\n";
			echo "								<div class=\"box_bottom\">\n";
			echo "									<span>Год запуска</span><br>\n";
			echo "									" . $result_row['year'] . "\n";
			echo "								</div>\n";
			echo "							</div>\n";
			echo "						</div>\n";
			echo "						<div class=\"clear\"></div>\n";
			echo "						<div class=\"rating\">\n";
			echo "							<span class=\"a\" onclick=\"rating(" . $result_row['id'] . ", 'minus')\"><img src=\"../temp/images/rating_minus.jpg\" alt=\"Уменьшить рейтинг форума\"></span>\n";
			if ($result_row['rating'] > 0)
			{
				echo "							<span class=\"number\" id=\"number\" style=\"color:#00bb00;\">" . $result_row['rating'] . "</span>\n";
			}
			elseif ($result_row['rating'] < 0)
			{
				echo "							<span class=\"number\" id=\"number\" style=\"color:#bb0000;\">" . $result_row['rating'] . "</span>\n";
			}
			else
			{
				echo "							<span class=\"number\" id=\"number\">" . $result_row['rating'] . "</span>\n";
			}

			echo "							<span class=\"a\" onclick=\"rating(" . $result_row['id'] . ", 'plus')\"><img src=\"../temp/images/rating_plus.jpg\" alt=\"Увеличить рейтинг форума\"></span><br>\n";
			echo "							Рейтинг\n";
			echo "							<div id=\"rating_message\"></div>\n";
			echo "						</div>\n";
//			echo "			<img src=\"../images/logo/" . $result_row['id'] . ".gif\" alt=\"" . $result_row['title'] . "\" />\n";
//			echo "							<form method=\"post\" action=\"../forum" . $result_row['id'] . "/\">\n";
//			echo "								<input type=\"hidden\" value=\"send\" name=\"send\" id=\"send\" />\n";
//			echo "								<input type=\"hidden\" value=\"minus\" name=\"type\" />\n";
//			echo "								<input type=\"submit\" value=\"&minus;\" class=\"buttons\" />\n";
//			echo "							</form>\n";
			if ($result_row['rss'] != '')
			{
				include_once('./classes/simplepie.inc');
				$rss_url = $result_row['rss'];

				$feed = new SimplePie();
				// Make sure that page is getting passed a URL
				if (isset($rss_url) && $rss_url !== '')
				{
					// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
					if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
					{
						$rss_url = stripslashes($rss_url);
					}

					// Use the URL that was passed to the page in SimplePie
					$feed->set_feed_url($rss_url);

					// XML dump
					$feed->enable_xml_dump(isset($_GET['xmldump']) ? true : false);
				}
				// Allow us to change the input encoding from the URL string if we want to. (optional)
				if (!empty($_GET['input']))
				{
					$feed->set_input_encoding($_GET['input']);
				}

				// Allow us to choose to not re-order the items by date. (optional)
				if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false')
				{
					$feed->enable_order_by_date(false);
				}
				// Initialize the whole SimplePie object.  Read the feed, process it, parse it, cache it, and 
				// all that other good stuff.  The feed's information will not be available to SimplePie before 
				// this is called.
				$success = $feed->init();

				// We'll make sure that the right content type and character encoding gets set automatically.
				// This function will grab the proper character encoding, as well as set the content type to text/html.
				$feed->handle_content_type();

				// Check to see if there are more than zero errors (i.e. if there are any errors at all)
				if ($feed->error())
				{
					// ... and display it.
					echo "<p>" . htmlspecialchars($feed->error()) . "</p>\r\n";
				}

				// As long as the feed has data to work with...
				if ($success)
				{
					//echo "					<div class=\"news\">\n";
					echo "						<h1>Лента новостей</h1>\n";
					// If the feed has a link back to the site that publishes it (which 99% of them do), link the feed's title to it.
					//if ($feed->get_link()) echo '<a href="' . $feed->get_link() . '">'; echo $feed->get_title(); if ($feed->get_link()) echo '</a>';
					// If the feed has a description, display it.
					//echo $feed->get_description();
					// Let's begin looping through each individual news item in the feed.
					foreach($feed->get_items() as $item)
					{
						echo "							<div class=\"item\">\n";
						// Let's add a favicon for each item. If one doesn't exist, we'll use an alternate one.
						if (!$favicon = $feed->get_favicon())
						{
							$favicon = './images/alternate.png';
						}
						// If the item has a permalink back to the original post (which 99% of them do), link the item's title to it.
						echo "<h4><img src=\"" . $favicon . "\" alt=\"Favicon\" class=\"favicon\" />\r\n";
						if ($item->get_permalink())
						{
							$permalink = str_replace("http://", "http://forumcatalog.ru/go.php?url=http://", $item->get_permalink());
							echo '<a href="' . $permalink . '">';
						}
						echo $item->get_title();
						if ($item->get_permalink()) echo '</a> ';
						echo $item->get_date('j.m.Y G:i');
						echo "</h4>\r\n";
						// Display the item's primary content.
						echo str_replace("http://", "http://forumcatalog.ru/go.php?url=http://", $item->get_content());
						// Stop looping through each item once we've gone through all of them.
						echo "							</div>\n";
					}
					// From here on, we're no longer using data from the feed.
				}
			}
			}
		break;
	case "forumlist":
		catalog_header('');
		echo "					<div class=\"news\">\n";
		echo "						<h1>Каталог форумов</h1>\n";
		echo "						<table width=\"100%\" cellspacing=\"0\">\n";
		echo "						<tr>\n";
		echo "							<th>Форум</th>\n";
		echo "							<th>Движок</th>\n";
		echo "							<th>Дата добавления</th>\n";
		echo "							<th>Тематика форума</th>\n";
		echo "							<th>Год запуска</th>\n";
		echo "						</tr>\n";
		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE active = 1";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "<tr>\n";
//			echo "<td><a href=\"" . $result_row['url'] . "\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
//			echo "<td><a href=\"index.php?mode=view&id=" . $result_row['id'] . "\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
			echo "<td><a href=\"forum" . $result_row['id'] . "/\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
			echo "<td>" . engine($result_row['engine']) . "</td>\n";
			echo "<td>" . date("m.d.Y, H:i", $result_row['date']) . "</td>\n";
			echo "<td>" . category($result_row['cat']) . "</td>\n";
			echo "<td>" . $result_row['year'] . "</td>\n";
			echo "</tr>\n";
		}
		echo "					</table>\n";
		break;
	case "category":
		$id = $_GET['id'];
		if (!$id)
		{
			die("Указанной категории не существует!");
		}
		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
		catalog_header($result_row['title']);
		echo "					<div class=\"news\">\n";
		echo "						<h1>Просмотр категории «" . $result_row['title'] . "»</h1>\n";
		echo "						<ul>\n";
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE cat = " . $result_row['id'] . "
					AND active = 1
				ORDER BY rating DESC";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "						<li><a href=\"../forum" . $result_row['id'] . "/\">" . $result_row['title'] . "</a></li>\n";
		}
		echo "					</ul>\n";
		break;
	default:
		catalog_header('');
		echo "					<div class=\"forumslist\">\n";
//		echo "						<h1>Каталог форумов</h1>\n";
//		echo '				<table width="100%" border="0">';
		echo "					<ul>\n";
		echo category_list('h2', 0);
		echo "					</ul>\n";
//		echo category_list('td', 0);
//		echo "				</table>\n";
		break;
}
// Закрытие соединения с mysql
mysql_close($connection);
include('temp/footer.tpl');
?>