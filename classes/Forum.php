<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: classes/Forum.php
* last update: 2011.12.03
**/
class Forum {

	private function email($type, $email) { // отправляем письма с различными уведомлениями
		switch($type)
		{
			case "add":
				$subj = "Добавление в каталог";
				$text = "Вы добавили форум в каталог форумов http://forumcatalog.ru/ \n В ближайшее время модераторы каталога рассмотрят вашу заявку, и если с ней всё в порядке и ваш форум соответствует требованиям каталога, то ваш форум будет утверждён в каталоге. \n\n ------------- \n С уважением, администрация ForumCatalog.ru";
			break;
		}
		mail($email, $subj, $text, "Content-Type: text/plain; charset=\"utf-8\"\r\n" . "From: ForumCatalog.Ru <mail@forumcatalog.ru>\r\n" . "Reply-To: mail@forumcatalog.ru\r\n" . "Content-Type: text/plain; charset=\"utf-8\"\r\n" . "X-Mailer: PHP/" . phpversion());
	}

	private function engine($engine) { // преобразовываем движок для нормального отображения
		global $config;
		if (in_array($engine, $config['engines'])) {
			$forum = $config['engines'][$engine];
		} else {
			$forum = "";
		}

		return $forum;
	}

	private function forum_logo($id, $text) { // генерируем для каждого форума свою картинку
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

	public function rating($id, $type, $ip) { // метод голосования за форумы aka рейтинг
		global $dbprefix;
		$status = 0; // голосовал ли пользователь с таким $ip за форум с таким $id. Сначала примем, что нет
		$sql = "SELECT *
				FROM " . $dbprefix . "votes
				WHERE ip = '" . $ip . "'";
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if ($result_row['forum_id'] == $id) {
				$status = 1; // пользователь уже голосовал
			}
		}
		if ($status == 1) {
			$message = 'Вы уже голосовали за этот форум. Повторное голосование не разрешено.';
		}
		else {
			// добавление информации о текущем голосе
			$sql = "INSERT
					INTO " . $dbprefix . "votes
					VALUES ('" . $id . "', '" . $type . "', '" . $ip . "', '" . time() . "')";
			$result = mysql_query($sql);
			if (!$result) {
				die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			}
			// обновление рейтинга форума
			$sql = "UPDATE " . $dbprefix . "forums ";
			if ($type == 'plus') {
				$sql .= "SET rating = (rating + 1)";
			}
			else {
				$sql .= "SET rating = (rating - 1)";
			}
			$sql .= " WHERE id = " . $id;
			$result = mysql_query($sql);
			if (!$result) {
				die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			}
			$message = 'Вы успешно проголосовали за форум. Рейтинг будет обновлён при следующем просмотре форума.';
		}
		return $message;
	}

	private function is_title_invalid($title) { // проверяем валидность введенного названия
		$result = "";
		if (strl($title) == 0) {
			$result .= "Вы не указали название форума.<br />\n";
		}
		elseif (strl($title) <= 5) {
			$result .= "Вы указали слишком короткое название форума.<br />\n";
		}
		elseif (strl($title) >= 200) {
			$result .= "Вы указали слишком длинное название форума.<br />\n";
		}

		return $result;
	}

	private function is_url_invalid($url) { // проверяем адрес форума на валидность
		$result = "";
		if (strlen($url) == 0) {
			$result .= "Вы не указали адрес форума.<br />\n";
		}
		elseif (strlen($url) <= 5) {
			$result .= "Вы указали слишком короткий адрес форума.<br />\n";
		}
		elseif (strlen($url) >= 200) {
			$result .= "Вы указали слишком длинный адрес форума.<br />\n";
		}

		if (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-zа-я0-9_-]{1,32}".
			"(?::[a-zа-я0-9_-]{1,32})?@)?)?(?:(?:[a-zа-я0-9-]{1,128}\.)+(?:com|net|".
			"org|mil|edu|arpa|gov|biz|info|aero|inc|name|рф|xn--p1ai|pro|[a-z]{2})|(?!0)(?:(?".
			"!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
			"?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i", $url, $ok))
		{
			$result .= "Вы указали некорректный адрес форума.<br />\n";
		}

		return $result;
	}

	private function is_description_invalid($description) { // проверяем описание форума на валидность
		$result = "";
		if (strl($description) == 0) {
			$result .= "Вы не указали описание форума.<br />\n";
		}
		elseif (strl($description) <= 200) {
			$result .= "Вы указали слишком короткое описание форума.<br />\n";
		}
		elseif (strl($description) >= 45000) {
			$result .= "Вы указали слишком длинное описание форума.<br />\n";
		}

		return $result;
	}

	private function is_engine_invalid($engine) { // проверяем корректность указанного движка форума
		global $config;
		$result = "";
		if (!in_array($engine, $config['engines'])) {
			$result = "Вы указали некорректный движок форума.<br />\n";
		}

		return $result;
	}

	private function is_portal_invalid($portal) { // проверяем корректность указания наличия портала на форуме
		$result = "";
		if (($portal != 0) && ($portal != 1)) {
			$result .= "Вы некорректно указали наличие или отсутствие портала на форуме.<br />\n";
		}

		return $result;
	}

	private function is_cms_invalid($cms) { // проверяем корректность указанной cms
		global $config;
		$result = "";
		if (!in_array($cms, $config['cms'])) {
			$result .= "Вы некорректно указали интеграцию с сайтом.<br />\n";
		}

		return $result;
	}

	private function is_category_invalid($category) { // проверяем правильной указания категории для форума
		global $dbprefix;
		$validate_result = "";
		if ($category == "") {
			$validate_result .= "Вы не указали тематику форума.<br />\n";
		}
		else {
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

		return $validate_result;
	}

	private function is_year_invalid($year) { // проверяем корректность указанного года запуска форума
		global $config;
		$result = "";
		if (!in_array($year, $config['years'])) {
			$result .= "Вы указали некорректный год запуска форума.<br />\n";
		}

		return $result;
	}

	private function is_rss_invalid($rss) { // проверяем корректность ссылки на rss
		$result = "";
		if ((strlen($rss) >= 1) && (strlen($rss) <= 5)) {
			$result .= "Вы указали слишком короткий адрес RSS форума.<br />\n";
		}
		elseif (strlen($rss) >= 200) {
			$result .= "Вы указали слишком длинный адрес RSS форума.<br />\n";
		}

		return $result;
	}

	private function is_email_invalid($email) { // проверяем валидность e-mail
		$result = "";
		if (!mb_ereg("^[a-z0-9]+@[a-z0-9]+\.[a-z0-9]{2,4}$", strtolower($email))) {
			$result .= "Вы указали некорректный e-mail адрес.<br />\n";
		} else {
			list($alias, $domain) = mb_split("@", $email);
			if (!checkdnsrr($domain, "MX")) {
				$result .= "Вы указали несуществующий e-mail адрес.<br />\n";
			}
		}

		return $result;
	}

	private function is_abq_invalid($abq) { // проверяем капчу
		global $config;
		$result = "";
		if ($abq != $config['abq']) {
			$result .= "Вы указали неправильный <a href=\"http://forumadmins.ru/viewtopic.php?f=14&amp;t=100&amp;r=2\" target=\"_blank\">шифр каталога</a>. Возможно, вы — робот.<br />\n";
		}

		return $result;
	}

	private function validate($title, $url, $description, $engine, $portal, $cms, $category, $year, $email, $rss, $abq) { // проверяем корректность заполнения анкеты на добавление форума
		$validate_result = "";

		$validate_result .= $this->is_title_invalid($title);
		$validate_result .= $this->is_url_invalid($url);
		$validate_result .= $this->is_description_invalid($description);
		$validate_result .= $this->is_engine_invalid($engine);
		$validate_result .= $this->is_portal_invalid($portal);
		$validate_result .= $this->is_cms_invalid($cms);
		$validate_result .= $this->is_category_invalid($category);
		$validate_result .= $this->is_year_invalid($year);
		$validate_result .= $this->is_rss_invalid($rss);
		$validate_result .= $this->is_email_invalid($email);
		$validate_result .= $this->is_abq_invalid($abq);

		return $validate_result;
	}

	public function add_forum($title, $url, $description, $engine, $portal, $cms, $category, $year, $email, $rss, $abq) { // добавляем форум в базу
		global $dbprefix;
		$validate = '';

		if ($this->validate($title, $url, $description, $engine, $portal, $cms, $category, $year, $email, $rss, $abq) == "") {
			// Добавление форума в базу данных
			$sql = "INSERT
					INTO " . $dbprefix . "forums
					VALUES (NULL, '" . $title . "', '" . $url . "', '" . $description . "', '" . $engine . "', '" . $portal . "', '" . $cms . "', '" . $category . "', '" . $year . "', '" . $email . "', '0', '', '" . time() . "', '0', '" . $rss . "', '0')";
			$result = mysql_query($sql);
			if (!$result) {
				die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			}
			$this->email("add", $email);
			//forum_logo($data_id, $data_url);
		}
		else {
			$validate .= $this->validate($title, $url, $description, $engine, $portal, $cms, $category, $year, $email, $rss, $abq);
		}

		return $validate;
	}

	public function display_add_form() { // отображаем форму для добавления форума
	}

	public function display_forum($id, $send = '', $type = '') { // выводим страничку с информацией о форуме
		global $dbprefix;
                $forum_view = array();

		// Прибавляем количество просмотров
		$sql = "UPDATE " . $dbprefix . "forums
				SET views = (views + 1)
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}

		// Получаем данные о форуме
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE id = " . $id . "
					AND active = 1";
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
                        $forum_view['id'] = 0;
                        $forum_view['title'] = 'Форум не найден';
                        return $forum_view;
		}

		// Вывод полученного результата
		$result_row = mysql_fetch_array($result, MYSQL_ASSOC);
		if (($result_row['active'] != 1) || ($result_row['title'] == '')) {
                        $forum_view['id'] = 0;
                        $forum_view['title'] = 'Форум не найден';
                        return $forum_view;
		}
		else {
			if ($send == 'send') {
				if (($type == 'plus') || ($type == 'minus')) {
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
				else {
					$message = '';
				}
			}
                        $forum_view['id'] = $result_row['id'];
                        $forum_view['title'] = page_html($result_row['title']);
                        $forum_view['url'] = $result_row['url'];

                        $forum_view['description'] = page_html($result_row['description']);
                        $forum_view['description'] = BBCode2Html($forum_view['description']);

                        $forum_view['category'] = category($result_row['cat']);
                        $forum_view['views'] = $result_row['views'];
                        $forum_view['engine'] = engine($result_row['engine']);
                        $forum_view['year'] = $result_row['year'];
                        $forum_view['rating'] = $result_row['rating'];

                        $forum_view['rss'] = false;

			if ($result_row['rss'] != '') {
                                $forum_view['rss'] = true;

				include_once('./classes/simplepie.inc');
				$rss_url = $result_row['rss'];
                                $rss_data = array();

				$feed = new SimplePie();
				// Make sure that page is getting passed a URL
				if (isset($rss_url) && $rss_url !== '') {
					// Strip slashes if magic quotes is enabled (which automatically escapes certain characters)
					if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
						$rss_url = stripslashes($rss_url);
					}

					// Use the URL that was passed to the page in SimplePie
					$feed->set_feed_url($rss_url);

					// XML dump
					$feed->enable_xml_dump(isset($_GET['xmldump']) ? true : false);
				}
				// Allow us to change the input encoding from the URL string if we want to. (optional)
				if (!empty($_GET['input'])) {
					$feed->set_input_encoding($_GET['input']);
				}

				// Allow us to choose to not re-order the items by date. (optional)
				if (!empty($_GET['orderbydate']) && $_GET['orderbydate'] == 'false') {
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
				if ($feed->error()) {
					// ... and display it.
                                        $forum_view['rss_error'] = htmlspecialchars($feed->error());
				}

				// As long as the feed has data to work with...
				if ($success) {
                                        $forum_view['rss_error'] = '';
					// If the feed has a link back to the site that publishes it (which 99% of them do), link the feed's title to it.
					//if ($feed->get_link()) echo '<a href="' . $feed->get_link() . '">'; echo $feed->get_title(); if ($feed->get_link()) echo '</a>';
					// If the feed has a description, display it.
					//echo $feed->get_description();
					// Let's begin looping through each individual news item in the feed.
                                        $i = 0;
					foreach($feed->get_items() as $item) {
						// Let's add a favicon for each item. If one doesn't exist, we'll use an alternate one.
						if (!$favicon = $feed->get_favicon()) {
							$favicon = './images/alternate.png';
						}
						// If the item has a permalink back to the original post (which 99% of them do), link the item's title to it.
                                                $rss_data[$i]['favicon'] = $favicon;
						if ($item->get_permalink()) {
							$permalink = str_replace("http://", "http://forumcatalog.ru/go.php?url=http://", $item->get_permalink());
                                                        $rss_data[$i]['permalink'] = $permalink;
						}
                                                $rss_data[$i]['title'] = $item->get_title();
						if ($item->get_permalink()) $content .= '</a> ';
                                                $rss_data[$i]['date'] = $item->get_date('j.m.Y G:i');
						// Display the item's primary content.
                                                $rss_data[$i]['content'] = str_replace("http://", "http://forumcatalog.ru/go.php?url=http://", $item->get_content());
						// Stop looping through each item once we've gone through all of them.
                                                $i++;
					}
					// From here on, we're no longer using data from the feed.
				}
			}
                        $forum_view['rss_data'] = (isset($rss_data) ? $rss_data : 0);
		}
                return $forum_view;
	}

	public function display_forumlist() { // выводим таблицу со всеми форумами. осталось от первых версий каталога, сейчас не используется
		$content = "					<div class=\"news\">\n";
		$content .= "						<h1>Каталог форумов</h1>\n";
		$content .= "						<table width=\"100%\" cellspacing=\"0\">\n";
		$content .= "						<tr>\n";
		$content .= "							<th>Форум</th>\n";
		$content .= "							<th>Движок</th>\n";
		$content .= "							<th>Дата добавления</th>\n";
		$content .= "							<th>Тематика форума</th>\n";
		$content .= "							<th>Год запуска</th>\n";
		$content .= "						</tr>\n";
		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE active = 1";
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$content .= "<tr>\n";
//			$content .= "<td><a href=\"" . $result_row['url'] . "\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
//			$content .= "<td><a href=\"index.php?mode=view&id=" . $result_row['id'] . "\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
			$content .= "<td><a href=\"/forum" . $result_row['id'] . "/\" alt=\"" . $result_row['description'] . "\" title=\"" . $result_row['description'] . "\">" . $result_row['title'] . "</a></td>\n";
			$content .= "<td>" . engine($result_row['engine']) . "</td>\n";
			$content .= "<td>" . date("m.d.Y, H:i", $result_row['date']) . "</td>\n";
			$content .= "<td>" . category($result_row['cat']) . "</td>\n";
			$content .= "<td>" . $result_row['year'] . "</td>\n";
			$content .= "</tr>\n";
		}
		$content .= "					</table>\n";

		return $content;
	}

	public function display_refusal_forums($limit = 20) { // выводим список последних форумов, отклоненных после модерации
		global $dbprefix;
                $refusal_forums = array();

		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE active = 0
					AND refusal != ''
				ORDER BY id DESC
				LIMIT " . $limit;
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$row = 0;
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $refusal_forums[$row]['title'] = page_html($result_row['title']);
                        $refusal_forums[$row]['refusal'] = page_html($result_row['refusal']);
                        $row++;
		}

		return $refusal_forums;
	}

	public function display_top_forums($limit = 50) { // выводим список форумов с наивысшим рейтингом
		global $dbprefix;
                $top_forums = array();
                $top_forums['limit'] = $limit;

		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE active = 1
					AND rating > 0
				ORDER BY rating DESC
				LIMIT " . $limit;
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}

		$row = 0;
                $forum = array();
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
                        $forum[$row]['id'] = $result_row['id'];
                        $forum[$row]['title'] = page_html($result_row['title']);
                        $forum[$row]['rating'] = $result_row['rating'];
			$row++;
		}
                $top_forums['forum'] = $forum;

		return $top_forums;
	}

	public function display_recent_forums($limit = 10) { // выводим список последних добавленных форумов в боковой колонке
		global $dbprefix;

		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE active = 1
				ORDER BY id DESC
				LIMIT " . $limit;
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		$recent_forum = array();
                $row = 0;
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                        $recent_forum[$row]['id'] = $result_row['id'];
                        $recent_forum[$row]['title'] = htmlspecialchars(get_magic_quotes_gpc() ? mb_substr(stripslashes($result_row['title']), 0, 30) : mb_substr($result_row['title'], 0, 33));
                        $row++;
		}

		return $recent_forum;
	}

	public function display_admin_forum_list($limit = 150) { // выводим список форумов для админки
		global $dbprefix;

		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				ORDER BY id DESC
				LIMIT " . $limit;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		$admin_forum_list = array();
		$row = 0;
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$admin_forum_list[$row]['id'] = $result_row['id'];
			$admin_forum_list[$row]['url'] = $result_row['url'];
			$admin_forum_list[$row]['title'] = page_html($result_row['title']);
			$admin_forum_list[$row]['description'] = page_html($result_row['description']);
			$admin_forum_list[$row]['year'] = $result_row['year'];
			$admin_forum_list[$row]['engine'] = $result_row['engine'];
			$admin_forum_list[$row]['cat'] = category($result_row['cat']);
			$admin_forum_list[$row]['date'] = date("m.d.Y, H:i", $result_row['date']);
			$admin_forum_list[$row]['active'] = $result_row['active'];
			$admin_forum_list[$row]['refusal'] = $result_row['refusal'];
			$row++;
		}

		return $admin_forum_list;
	}

	public function save_admin_forum($forum) { // сохраняем форум в админке
		global $dbprefix;

		$save_result = false;
		// Сохранение изменений в базе данных
		$sql = "UPDATE " . $dbprefix . "forums
				SET title = '" . $forum['name'] . "', url = '" . $forum['url'] . "', description = '" . $forum['description'] . "', engine = '" . $forum['engine'] . "', portal = '" . $forum['portal'] . "', cms = '" . $forum['cms'] . "', cat = '" . $forum['category'] . "', year = '" . $forum['year'] . "', email = '" . $forum['email'] . "', active = '" . $forum['active'] . "', refusal = '" . $forum['refusal'] . "', rss = '" . $forum['rss'] . "'
				WHERE id = " . $forum['id'];
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			$save_result = false;
		} else {
			$save_result = true;
		}

		return $save_result;
	}

	public function edit_admin_forum($id) { // редактируем форум в админке
		global $dbprefix;

		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		$forum = array();
		if ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$forum['id'] = $result_row['id'];
			$forum['title'] = page_html($result_row['title']);
			$forum['url'] = $result_row['url'];
			$forum['description'] = $result_row['description'];
			$forum['engine'] = $result_row['engine'];
			$forum['cms'] = $result_row['cms'];
			$forum['portal'] = $result_row['portal'];
			$forum['cat'] = $result_row['cat'];
			$forum['year'] = $result_row['year'];
			$forum['rss'] = $result_row['rss'];
			$forum['email'] = $result_row['email'];
			$forum['active'] = $result_row['active'];
			$forum['refusal'] = $result_row['refusal'];
		}

		return $forum;
	}
}
?>