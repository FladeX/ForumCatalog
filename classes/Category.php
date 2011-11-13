<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: classes/Category.php
* last update: 2011.10.17
**/
class Category {

	public function display_category_content($id) { // выводим содержимое категории
		global $dbprefix;
                $category = array();

		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result) {
			//die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
                        $category['id'] = 0;
                        $category['title'] = 'Категория не найдена';
                        return $category;
		}
                else {
                    // Вывод полученного результата
                    $result_row = mysql_fetch_array($result, MYSQL_ASSOC);

                    $category['id'] = $result_row['id'];
                    $category['title'] = $result_row['title'];

                    $category_forums = array();

                    $sql = "SELECT *
                                    FROM " . $dbprefix . "forums
                                    WHERE cat = " . $result_row['id'] . "
                                            AND active = 1
                                    ORDER BY rating DESC";
                    $result = mysql_query($sql);
                    if (!$result) {
                            $category['id'] = 0;
                            $category['title'] = 'Категория не найдена';
                            //die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
                            return $category;
                    }
                    $i = 0;
                    while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                            $category_forums[$i]['id'] = $result_row['id'];
                            $category_forums[$i]['title'] = $result_row['title'];
                            $i++;
                    }
                    $category['forums_count'] = $i;
                    $category['forums'] = $category_forums;
                }

                return $category;
	}

	public function display_category_list($tags, $catid) { // выводим список категорий с учетом вложенности в раскрывающихся списках
		global $dbprefix;
		$category_list = '';
		//Получаем список категорий
		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE catid = 0";
		$result = mysql_query($sql);
		if (!$result) {
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
                $categories = array();
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$sql = "SELECT *
					FROM " . $dbprefix . "category
					WHERE catid =" . $result_row['id'];
			$result2 = mysql_query($sql);
			if (!$result2) {
				die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			}
/*			if ($tags == "li") {
				$ul = false;
				$result3 = mysql_query($sql);
				$result3_row = mysql_fetch_array($result3, MYSQL_ASSOC);
				if ($result3_row['id'] > 0) {
					$category_list .= "								<li style=\"list-style:none;\">\n";
					$category_list .= "								<ul>\n";
					$ul = true;
				}
			}
			if ($tags == "h2") {
				$ul = false;
				$result3 = mysql_query($sql);
				$result3_row = mysql_fetch_array($result3, MYSQL_ASSOC);
				if ($result3_row['id'] > 0) {
					$ul = true;
				}
			}*/
                        $i = 0;
                        $child_categories = array();
			while ($result2_row = mysql_fetch_array($result2, MYSQL_ASSOC)) {
                                $child_categories[$i]['id'] = $result2_row['id'];
                                $child_categories[$i]['title'] = $result2_row['title'];
                                $i++;

/*				if ($tags == "option") {
					if ($catid != $result2_row['id']) {
						$category_list .= "								<option value=\"" . $result2_row['id'] . "\">--- " . $result2_row['title'] . "</option>\n";
					}
					else {
						$category_list .= "								<option value=\"" . $result2_row['id'] . "\" selected=\"selected\">--- " . $result2_row['title'] . "</option>\n";
					}
				}
				elseif ($tags == "div") {
					if ($catid != $result2_row['id']) {
						$category_list .= "								<div>--- " . $result2_row['title'] . "<input name=\"category_\" type=\"hidden\" value=\"" . $result2_row['id'] . "\"></div>\n";
					}
					else {
						$category_list .= "								<div class=\"selected\">--- " . $result2_row['title'] . "<input name=\"category_\" type=\"hidden\" value=\"" . $result2_row['id'] . "\"></div>\n";
					}
				}
				elseif ($tags == "li") {
					$category_list .= "								<li><a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a></li>\n";
				}
				elseif ($tags == "h2") {
					$category_list .= "								<a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a>, \n";
				}
				elseif ($tags == "td") {
					$category_list .= "								<a href=\"category" . $result2_row['id'] . "/\">" . $result2_row['title'] . "</a>, \n";
				}*/
			}
                        $categories_list['child'] = $child_categories;
/*			if (($tags == "li") && $ul) {
				$category_list .= "								</ul>\n";
				$category_list .= "								</li>\n";
			}
			if (($tags == "h2") && $ul) {
				$category_list .= "								</li>\n";
			}
			if ($tags == "td") {
				$category_list .= "</td></tr>\n";
			}*/

                        $categories_list = array();
                        $categories_list['id'] = $result_row['id'];
                        $categories_list['title'] = $result_row['title'];
                        $categories_list['child'] = $child_categories;

                        $categories[] = $categories_list;
		}
		//return $category_list;
                return $categories;
	}

	public function display_admin_category_list() { // выводит список всех категорий в админке
		global $dbprefix;

		// Выбор всех категорий из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "category";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$category_list = array();
		$row = 0;
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$category_list[$row]['id'] = $result_row['id'];
			$category_list[$row]['title'] = page_html($result_row['title']);
			$row++;
		}

		return $category_list;
	}

	public function edit_category($id) { // редактируем категорию
		global $dbprefix;

		$sql = "SELECT *
				FROM " . $dbprefix . "category
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$category = array();
		if ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$category['title'] = page_html($result_row['title']);
			$category['id'] = $result_row['id'];
		}

		return $category;
	}

	public function save_category($id, $title, $parent_id) { // сохранение данных о категории
		global $dbprefix;

		// Сохранение изменений в базе данных
		$sql = "UPDATE " . $dbprefix . "category
				SET catid = '" . $parent_id . "', title = '" . $title . "'
				WHERE id = " . $id;
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}

		return true;
	}
}

?>