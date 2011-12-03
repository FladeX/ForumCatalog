<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: admin.php
* last update: 2011.12.03
**/
session_start();
include('config.php');
include('db.php');
include('functions.php');
include('classes/Forum.php');
include('classes/Category.php');
include('classes/smarty/Smarty.class.php');

global $config;
global $sape;

$sape_links = $sape->return_links();

$forum = new Forum;
$smarty = new Smarty();

$smarty->template_dir = $config['smarty_template_dir'];
$smarty->compile_dir = $config['smarty_compile_dir'];
$smarty->config_dir = $config['smarty_config_dir'];
$smarty->cache_dir = $config['smarty_cache_dir'];

$recent_forums = $forum->display_recent_forums();

//session_start();
// Проверка пароля
if ($_SESSION['authorized'] != $admin_session)
{
	$adminpass = $_POST['adminpass'];
	if ($adminpass == "")
	{
		$smarty->assign('title', 'Вход в администраторский раздел');
		$smarty->assign('password_wrong', false);
		$smarty->assign('recent_forums', $recent_forums);
		$smarty->assign('sape_links', $sape_links);
		$smarty->display('admin_login.html');
	}
	else
	{
		if ($adminpass != $admin_password)
		{
			$smarty->assign('title', 'Вход в администраторский раздел');
			$smarty->assign('password_wrong', true);
			$smarty->assign('recent_forums', $recent_forums);
			$smarty->assign('sape_links', $sape_links);
			$smarty->display('admin_login.html');
		}
		else
		{
			$_SESSION['authorized'] = $admin_session;
		}
	}
}
//
if ($_SESSION['authorized'] == $admin_session) {
$mode = $_GET['mode'];
switch ($mode)
{
	case "category":
		$option = $_GET['option'];
		switch ($option)
		{
			case "create":
				$category_list = category_list("option", 0);

				$smarty->assign('title', 'Создание категории');
				$smarty->assign('category_list', $category_list);
				$smarty->assign('recent_forums', $recent_forums);
				$smarty->assign('sape_links', $sape_links);
				$smarty->display('admin_category_add.html');
				break;
			case "new":
				$title = $_POST['name'];
				$catid = $_POST['parent'];
				// Добавление категории в базу данных
				$sql = "INSERT
						INTO " . $dbprefix . "category
						VALUES (NULL, '" . $catid . "', '" . $title . "')";
				$result = mysql_query($sql);
				if (!$result)
				{
					die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
				}
				echo "					<div class=\"news\">\n";
				echo "			<h1>Создание категории</h1>\n";
				echo "					<p>Категория успешно создана!</p>\n";
				break;
			case "edit":
				$id = $_GET['id'];

				$category = new Category;
				$category_data = $category->edit_category($id);
				$category_list = category_list("option", 0);

				$smarty->assign('title', 'Редактирование категории');
				$smarty->assign('category', $category_data);
				$smarty->assign('recent_forums', $recent_forums);
				$smarty->assign('sape_links', $sape_links);
				$smarty->display('admin_category_edit.html');
				break;
			case "save":
				$id = $_POST['id'];
				$title = $_POST['name'];
				$parent_id = 0;

				$category = new Category;
				$category->save_category($id, $title, $parent_id);

				$smarty->assign('title', 'Редактирование категории');
				$smarty->assign('recent_forums', $recent_forums);
				$smarty->assign('sape_links', $sape_links);
				$smarty->display('admin_category_save.html');
				break;
			case "delete":
				$id = $_GET['id'];
				// Проверка существования форума в базе данных
				$sql = "SELECT *
						FROM " . $dbprefix . "category
						WHERE id = $id";
				$result = mysql_query($sql);
				if (!$result)
				{
					die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
				}
				$category_exist = 0;
				while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					$category_exist = 1;
				}
				if ($category_exist)
				{
					// Удаление форума из базы данных
					$sql = "DELETE
							FROM " . $dbprefix . "category
							WHERE id = $id";
					$result = mysql_query($sql);
					if (!$result)
					{
						die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
					}
					echo "					<div class=\"news\">\n";
					echo "			<h1>Удаление категории</h1>\n";
					echo "					<p>Категория успешно удалена!</p>\n";
				}
				else
				{
					echo "					<div class=\"news\">\n";
					echo "			<h1>Удаление категории</h1>\n";
					echo "					<p>Указанная категория не найдена в базе данных. Возможно, она уже была удалена.</p>\n";
				}
				break;
			default:
				$category = new Category;
				$category_list = $category->display_admin_category_list();

				$smarty->assign('title', 'Список категорий');
				$smarty->assign('category_list', $category_list);
				$smarty->assign('recent_forums', $recent_forums);
				$smarty->assign('sape_links', $sape_links);
				$smarty->display('admin_category_list.html');
				break;
		}
		break;
	case "delete":
		$id = $_GET['id'];
		// Проверка существования форума в базе данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE id = $id";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		$forum_exist = 0;
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$forum_exist = 1;
		}
		if ($forum_exist)
		{
			// Удаление форума из базы данных
			$sql = "DELETE
					FROM " . $dbprefix . "forums
					WHERE id = $id";
			$result = mysql_query($sql);
			if (!$result)
			{
				die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
			}
			echo "					<div class=\"news\">\n";
			echo "			<h1>Удаление форума</h1>\n";
			echo "					<p>Форум успешно удалён!</p>\n";
		}
		else
		{
			echo "					<div class=\"news\">\n";
			echo "			<h1>Удаление форума</h1>\n";
			echo "					<p>Указанный форум не найден в базе данных. Возможно, он уже был удалён.</p>\n";
		}
		break;
	case "edit":
		$id = $_GET['id'];

		$forum = $forum->edit_admin_forum($id);

		$category_list = category_list("option", $forum['cat']);

		$year_list = array();
		for ($i = 1998; $i <= date('Y'); $i++) {
			$year_list[] = $i;
		}

		$smarty->assign('title', 'Редактирование форума');
		$smarty->assign('forum', $forum);
		$smarty->assign('years', $year_list);
		$smarty->assign('category_list', $category_list);
		$smarty->assign('cms_list', $config['cms']);
		$smarty->assign('engines', $config['engines']);
		$smarty->assign('recent_forums', $recent_forums);
		$smarty->assign('sape_links', $sape_links);
		$smarty->display('admin_forum_edit.html');
		break;
	case "save":
		// Сохранение изменений в базе данных
		$sql = "UPDATE " . $dbprefix . "forums
				SET title = '" . $_POST['name'] . "', url = '" . $_POST['url'] . "', description = '" . $_POST['description'] . "', engine = '" . $_POST['engine'] . "', portal = '" . $_POST['portal'] . "', cms = '" . $_POST['cms'] . "', cat = '" . $_POST['category'] . "', year = '" . $_POST['year'] . "', email = '" . $_POST['email'] . "', active = '" . $_POST['active'] . "', refusal = '" . $_POST['refusal'] . "', rss = '" . $_POST['rss'] . "'
				WHERE id = " . $_POST['id'];
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		echo "					<div class=\"news\">\n";
		echo "			<h1>Редактирование форума</h1>\n";
		echo "					<p>Форум успешно отредактирован!</p>\n";
		break;
	default:
		$admin_forum_list = $forum->display_admin_forum_list();
 
		$smarty->assign('title', 'Редактирование форумов');
		$smarty->assign('admin_forum_list', $admin_forum_list);
		$smarty->assign('recent_forums', $recent_forums);
		$smarty->assign('sape_links', $sape_links);
		$smarty->display('admin_forum_list.html');
		break;
}

}
?>