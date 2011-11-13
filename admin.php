<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: admin.php
* last update: 2011.11.13
**/
session_start();
include('config.php');
include('db.php');
include('functions.php');
include('classes/Forum.php');
include('classes/Category.php');
include('classes/smarty/Smarty.class.php');

global $sape;
$sape_links = $sape->return_links();

$forum = new Forum;
$smarty = new Smarty();

$smarty->template_dir = SMARTY_TEMPLATE_DIR;
$smarty->compile_dir = SMARTY_COMPILE_DIR;
$smarty->config_dir = SMARTY_CONFIG_DIR;
$smarty->cache_dir = SMARTY_CACHE_DIR;

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

		$cms = array(
			'none' => 'Нет интеграции с cms',
			'danneo' => 'Danneo CMS',
			'dle' => 'DLE (DataLife Engine)',
			'drupal' => 'Drupal',
			'e107' => 'e107',
			'hostcms' => 'Host CMS',
			'instantcms' => 'Instant CMS',
			'instantsite' => 'Instant Site',
			'joomla' => 'Joomla',
			'joostina' => 'Joostina',
			'klarnetcms' => 'Klarnet CMS',
			'kasselercms' => 'Kasseler CMS',
			'modx' => 'ModX',
			'netcat' => 'NetCat',
			'php-fusion' => 'php-fusion',
			'php-nuke' => 'PHP-Nuke',
			'phpshop' => 'PHPShop',
			'runcms' => 'RunCms',
			'slaed' => 'Slaed CMS',
			'seditio' => 'Seditio CMS',
			'typo3' => 'TYPO3',
			'twilight' => 'Twilight CMS',
			'umi' => 'UMI CMS',
			'wordpress' => 'Wordpress',
			'diy' => 'Самописная cms',
			'other' => 'Другая cms',
		);

		$engines = array(
			'phpbb2' => 'phpBB 2.x',
			'phpbb3' => 'phpBB 3.x',
			'ipb1' => 'IPB 1.x',
			'ipb2' => 'IPB 2.x',
			'ipb3' => 'IPB 3.x',
			'smf1' => 'SMF 1.x',
			'smf2' => 'SMF 2.x',
			'vb1' => 'vBulletin 1.x',
			'vb2' => 'vBulletin 2.x',
			'vb3' => 'vBulletin 3.x',
			'vb4' => 'vBulletin 4.x',
			'xen' => 'XenForo',
			'punbb' => 'punBB',
			'dle' => 'DLE Forum',
			'exbb' => 'ExBB',
			'yabb' => 'YaBB',
			'vanilla' => 'Vanilla',
			'bbpress' => 'bbPress (Wordpress)',
			'pybb' => 'PyBB',
			'ucoz' => 'UcoZ',
			'fluxbb' => 'FluxBB',
			'discuz' => 'Discuz',
			'borda.ru' => 'Borda.ru / forum24.ru',
			'autobb' => 'AutoBB (Joomla)',
			'diy' => 'Самописный движок',
			'other' => 'Другой вариант',
		);

		$smarty->assign('title', 'Редактирование форума');
		$smarty->assign('forum', $forum);
		$smarty->assign('years', $year_list);
		$smarty->assign('category_list', $category_list);
		$smarty->assign('cms_list', $cms);
		$smarty->assign('engines', $engines);
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