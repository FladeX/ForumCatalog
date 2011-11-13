<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: admin.php
* last update: 2011.10.16
**/
session_start();
include('db.php');
include('functions.php');
include('classes/Forum.php');
include('classes/Category.php');
define('SMARTY_DIR', '/var/www/fladex/data/www/forumcatalog.ru/classes/smarty/');
include('classes/smarty/Smarty.class.php');

global $sape;
$sape_links = $sape->return_links();

$recent_forums = $forum->display_recent_forums();

$smarty->assign('title', $title);
$smarty->assign('categories', $categories);
$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('sape_links', $sape_links);
$smarty->display('category_list.html');

catalog_header('админка');
//session_start();
// Проверка пароля
if ($_SESSION['authorized'] != "admincatalog42")
{
	$adminpass = $_POST['adminpass'];
	if ($adminpass == "")
	{
		echo "					<div class=\"news\">\n";
		echo "						<h1>Редактирование категории</h1>\n";
		echo "						<p>Введите пароль для доступа:</p>\n";
		echo "						<form action=\"../admin/\" method=\"post\">\n";
		echo "							<label for=\"adminpass\">Пароль:</label>\n";
		echo "							<input type=\"password\" value=\"\" name=\"adminpass\" id=\"adminpass\" />\n";
		echo "						</form>\n";
		die();
	}
	else
	{
		if ($adminpass != "catAlog090909")
		{
			echo "					<div class=\"news\">\n";
			echo "						<h1>Редактирование категории</h1>\n";
			echo "						<p>Доступ невозможен!</p>\n";
			echo "						<form action=\"../admin/\" method=\"post\">\n";
			echo "							<label for=\"adminpass\">Пароль:</label>\n";
			echo "							<input type=\"password\" value=\"\" name=\"adminpass\" id=\"adminpass\" />\n";
			echo "						</form>\n";
			die();
		}
		else
		{
			$_SESSION['authorized'] = "admincatalog42";
		}
	}
}
//
echo "<a href=\"../admin/\">Администраторский раздел</a>, <a href=\"../admin/?mode=category\">Список категорий</a>, <a href=\"../admin/?mode=category&option=create\">Создать категорию</a>\n";
$mode = $_GET['mode'];
switch ($mode)
{
	case "category":
		$option = $_GET['option'];
		switch ($option)
		{
			case "create":
				echo "					<div class=\"news\">\n";
				echo "					<h1>Создание категории</h1>\n";
				echo "					<form method=\"post\" action=\"../admin/?mode=category&option=new\">\n";
				echo "					<table width=\"100%\" cellspacing=\"0\" border=\"0\">\n";
				echo "					<tr>\n";
				echo "						<td width=\"49%\">Название категории:</td>\n";
				echo "						<td width=\"49%\"><input type=\"text\" name=\"name\" id=\"name\" value=\"\" /></td>\n";
				echo "					</tr>\n";
				echo "					<tr>\n";
				echo "						<td>Родительская категория:</td>\n";
				echo "						<td>\n";
				echo "							<select name=\"parent\">\n";
				echo "								<option value=\"0\">Нет родителя</option>\n";
				echo category_list("option", 0);
				echo "							</select>\n";
				echo "						</td>\n";
				echo "					</tr>\n";
				echo "					<tr>\n";
				echo "						<td colspan=\"2\" style=\"text-align:center;\">\n";
				echo "							<input type=\"hidden\" name=\"send\" value=\"send\" />\n";
				echo "							<input type=\"reset\" value=\"Сброс\" class=\"buttons\" />\n";
				echo "							<input type=\"submit\" value=\"Добавить!\" class=\"buttons\" />\n";
				echo "						</td>\n";
				echo "					</tr>\n";
				echo "					</table>\n";
				echo "					</form>\n";
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
				// Выбор всех категорий из базы данных
				$sql = "SELECT *
						FROM " . $dbprefix . "category
						WHERE id = $id";
				$result = mysql_query($sql);
				if (!$result)
				{
					die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
				}
				// Вывод полученного результата
				while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					echo "					<div class=\"news\">\n";
					echo "			<h1>Редактирование категории</h1>\n";
					echo "					<form method=\"post\" action=\"../admin/?mode=category&option=save\">\n";
					echo "					<table width=\"100%\" cellspacing=\"0\" border=\"0\">\n";
					echo "					<tr>\n";
					echo "						<td width=\"49%\">Название категории:</td>\n";
					echo "						<td width=\"49%\"><input type=\"text\" name=\"name\" id=\"name\" value=\"" . page_html($result_row['title']) . "\" /></td>\n";
					echo "					</tr>\n";
					echo "					<tr>\n";
					echo "						<td>Родительская категория:</td>\n";
					echo "						<td>\n";
					echo "							<select name=\"parent\">\n";
					echo "								<option value=\"0\">Нет родителя</option>\n";
					echo category_list("option", 0);
					echo "							</select>\n";
					echo "						</td>\n";
					echo "					</tr>\n";
					echo "					<tr>\n";
					echo "						<td colspan=\"2\" style=\"text-align:center;\">\n";
					echo "							<input type=\"hidden\" value=\"" . $id . "\" name=\"id\" id=\"id\" />\n";
					echo "							<input type=\"reset\" value=\"Сброс\" class=\"buttons\" />\n";
					echo "							<input type=\"submit\" value=\"Сохранить!\" class=\"buttons\" />\n";
					echo "						</td>\n";
					echo "					</tr>\n";
					echo "					</table>\n";
					echo "					</form>\n";
				}
				break;
			case "save":
				// Сохранение изменений в базе данных
				$sql = "UPDATE " . $dbprefix . "category
						SET catid = '0', title = '" . $_POST['name'] . "'
						WHERE id = " . $_POST['id'];
				$result = mysql_query($sql);
				if (!$result)
				{
					die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
				}
				echo "					<div class=\"news\">\n";
				echo "			<h1>Редактирование категории</h1>\n";
				echo "					<p>Категория успешно отредактирована!</p>\n";
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
				echo "					<div class=\"news\">\n";
				echo "			<h1>Просмотр категорий</h1>\n";
				echo "					<ul>\n";
				// Выбор всех категорий из базы данных
				$sql = "SELECT *
						FROM " . $dbprefix . "category";
				$result = mysql_query($sql);
				if (!$result)
				{
					die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
				}
				// Вывод полученного результата
				while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
					echo "						<li>" . page_html($result_row['title']) . " (<a href=\"../admin/?mode=category&option=edit&id=" . $result_row['id'] . "\">редактировать</a>, <a href=\"../admin/?mode=category&option=delete&id=" . $result_row['id'] . "\">удалить</a>)</li>\n";
				}
				echo "					</ul>\n";
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
		// Выбор всех форумов из базы данных
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				WHERE id = $id";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			echo "					<div class=\"news\">\n";
			echo "			<h1>Редактирование форума</h1>\n";
			echo "					<form method=\"post\" action=\"../admin/?mode=save\">\n";
			echo "					<table width=\"100%\" cellspacing=\"0\" border=\"0\">\n";
			echo "					<tr>\n";
			echo "						<td width=\"49%\">Название форума:</td>\n";
			echo "						<td width=\"49%\"><input type=\"text\" name=\"name\" id=\"name\" value=\"" . page_html($result_row['title']) . "\" /></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Адрес форума:</td>\n";
			echo "						<td><input type=\"text\" name=\"url\" id=\"url\" value=\"" . page_html($result_row['url']) . "\" /></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Описание форума:</td>\n";
			echo "						<td><textarea name=\"description\" id=\"description\" rows=\"20\" cols=\"40\">" . $result_row['description'] . "</textarea></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Движок форума:</td>\n";
			echo "						<td>\n";
			echo "							<select name=\"engine\">\n";
			if ($result_row['engine'] == 'phpbb2')
			{
				echo "								<option value=\"phpbb2\" selected=\"selected\">phpBB 2.x</option>\n";
			} else {
				echo "								<option value=\"phpbb2\">phpBB 2.x</option>\n";
			}
			if ($result_row['engine'] == 'phpbb3')
			{
				echo "								<option value=\"phpbb3\" selected=\"selected\">phpBB 3.x</option>\n";
			} else {
				echo "								<option value=\"phpbb3\">phpBB 3.x</option>\n";
			}
			if ($result_row['engine'] == 'ipb1')
			{
				echo "								<option value=\"ipb1\" selected=\"selected\">IPB 1.x</option>\n";
			} else {
				echo "								<option value=\"ipb1\">IPB 1.x</option>\n";
			}
			if ($result_row['engine'] == 'ipb2')
			{
				echo "								<option value=\"ipb2\" selected=\"selected\">IPB 2.x</option>\n";
			} else {
				echo "								<option value=\"ipb2\">IPB 2.x</option>\n";
			}
			if ($result_row['engine'] == 'ipb3')
			{
				echo "								<option value=\"ipb3\" selected=\"selected\">IPB 3.x</option>\n";
			} else {
				echo "								<option value=\"ipb3\">IPB 3.x</option>\n";
			}
			if ($result_row['engine'] == 'smf1')
			{
				echo "								<option value=\"smf1\" selected=\"selected\">SMF 1.x</option>\n";
			} else {
				echo "								<option value=\"smf1\">SMF 1.x</option>\n";
			}
			if ($result_row['engine'] == 'smf2')
			{
				echo "								<option value=\"smf2\" selected=\"selected\">SMF 2.x</option>\n";
			} else {
				echo "								<option value=\"smf2\">SMF 2.x</option>\n";
			}
			if ($result_row['engine'] == 'vb1')
			{
				echo "								<option value=\"vb1\" selected=\"selected\">vBulletin 1.x</option>\n";
			} else {
				echo "								<option value=\"vb1\">vBulletin 1.x</option>\n";
			}
			if ($result_row['engine'] == 'vb2')
			{
				echo "								<option value=\"vb2\" selected=\"selected\">vBulletin 2.x</option>\n";
			} else {
				echo "								<option value=\"vb2\">vBulletin 2.x</option>\n";
			}
			if ($result_row['engine'] == 'vb3')
			{
				echo "								<option value=\"vb3\" selected=\"selected\">vBulletin 3.x</option>\n";
			} else {
				echo "								<option value=\"vb3\">vBulletin 3.x</option>\n";
			}
			if ($result_row['engine'] == 'vb4')
			{
				echo "								<option value=\"vb4\" selected=\"selected\">vBulletin 4.x</option>\n";
			} else {
				echo "								<option value=\"vb4\">vBulletin 4.x</option>\n";
			}
			if ($result_row['engine'] == 'xen')
			{
				echo "								<option value=\"xen\" selected=\"selected\">XenForo</option>\n";
			} else {
				echo "								<option value=\"xen\">XenForo</option>\n";
			}
			if ($result_row['engine'] == 'punbb')
			{
				echo "								<option value=\"punbb\" selected=\"selected\">punBB</option>\n";
			} else {
				echo "								<option value=\"punbb\">punBB</option>\n";
			}
			if ($result_row['engine'] == 'dle')
			{
				echo "								<option value=\"dle\" selected=\"selected\">DLE Forum</option>\n";
			} else {
				echo "								<option value=\"dle\">DLE Forum</option>\n";
			}
			if ($result_row['engine'] == 'exbb')
			{
				echo "								<option value=\"exbb\" selected=\"selected\">ExBB</option>\n";
			} else {
				echo "								<option value=\"exbb\">ExBB</option>\n";
			}
			if ($result_row['engine'] == 'yabb')
			{
				echo "								<option value=\"yabb\" selected=\"selected\">YaBB</option>\n";
			} else {
				echo "								<option value=\"yabb\">YaBB</option>\n";
			}
			if ($result_row['engine'] == 'vanilla')
			{
				echo "								<option value=\"vanilla\" selected=\"selected\">Vanilla</option>\n";
			} else {
				echo "								<option value=\"vanilla\">Vanilla</option>\n";
			}
			if ($result_row['engine'] == 'bbpress')
			{
				echo "								<option value=\"bbpress\" selected=\"selected\">bbPress (Wordpress)</option>\n";
			} else {
				echo "								<option value=\"bbpress\">bbPress (Wordpress)</option>\n";
			}
			if ($result_row['engine'] == 'pybb')
			{
				echo "								<option value=\"pybb\" selected=\"selected\">PyBB</option>\n";
			} else {
				echo "								<option value=\"pybb\">PyBB</option>\n";
			}
			if ($result_row['engine'] == 'ucoz')
			{
				echo "								<option value=\"ucoz\" selected=\"selected\">UcoZ</option>\n";
			} else {
				echo "								<option value=\"ucoz\">UcoZ</option>\n";
			}
			if ($result_row['engine'] == 'fluxbb')
			{
				echo "								<option value=\"fluxbb\" selected=\"selected\">FluxBB</option>\n";
			} else {
				echo "								<option value=\"fluxbb\">FluxBB</option>\n";
			}
			if ($result_row['engine'] == 'discuz')
			{
				echo "								<option value=\"discuz\" selected=\"selected\">Discuz</option>\n";
			} else {
				echo "								<option value=\"discuz\">Discuz</option>\n";
			}
			if ($result_row['engine'] == 'borda.ru')
			{
				echo "								<option value=\"borda.ru\" selected=\"selected\">Borda.ru / forum24.ru</option>\n";
			} else {
				echo "								<option value=\"borda.ru\">Borda.ru / forum24.ru</option>\n";
			}
			if ($result_row['engine'] == 'autobb')
			{
				echo "								<option value=\"autobb\" selected=\"selected\">AutoBB (Joomla)</option>\n";
			} else {
				echo "								<option value=\"autobb\">AutoBB (Joomla)</option>\n";
			}
			if ($result_row['engine'] == 'diy')
			{
				echo "								<option value=\"diy\" selected=\"selected\">Самописный движок</option>\n";
			} else {
				echo "								<option value=\"diy\">Самописный движок</option>\n";
			}
			if ($result_row['engine'] == 'other')
			{
				echo "								<option value=\"other\" selected=\"selected\">Другой вариант</option>\n";
			} else {
				echo "								<option value=\"other\">Другой вариант</option>\n";
			}
			echo "							</select>\n";
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Интеграция с cms:</td>\n";
			echo "						<td>\n";
			echo "							<select name=\"cms\">\n";
			if ($result_row['cms'] == 'none')
			{
				echo "								<option value=\"none\" selected=\"selected\">Нет</option>\n";
			} else {
				echo "								<option value=\"none\">Нет</option>\n";
			}
			if ($result_row['cms'] == 'danneo')
			{
				echo "								<option value=\"danneo\" selected=\"selected\">Danneo cms</option>\n";
			} else {
				echo "								<option value=\"danneo\">Danneo cms</option>\n";
			}
			if ($result_row['cms'] == 'dle')
			{
				echo "								<option value=\"dle\" selected=\"selected\">DataLife Engine (DLE)</option>\n";
			} else {
				echo "								<option value=\"dle\">DataLife Engine (DLE)</option>\n";
			}
			if ($result_row['cms'] == 'drupal')
			{
				echo "								<option value=\"drupal\" selected=\"selected\">Drupal</option>\n";
			} else {
				echo "								<option value=\"drupal\">Drupal</option>\n";
			}
			if ($result_row['cms'] == 'e107')
			{
				echo "								<option value=\"e107\" selected=\"selected\">e107</option>\n";
			} else {
				echo "								<option value=\"e107\">e107</option>\n";
			}
			if ($result_row['cms'] == 'hostcms')
			{
				echo "								<option value=\"hostcms\" selected=\"selected\">Host CMS</option>\n";
			} else {
				echo "								<option value=\"hostcms\">Host CMS</option>\n";
			}
			if ($result_row['cms'] == 'instantcms')
			{
				echo "								<option value=\"instantcms\" selected=\"selected\">InstantCMS</option>\n";
			} else {
				echo "								<option value=\"instantcms\">InstantCMS</option>\n";
			}
			if ($result_row['cms'] == 'instantsite')
			{
				echo "								<option value=\"instantsite\" selected=\"selected\">Instant Site</option>\n";
			} else {
				echo "								<option value=\"instantsite\">Instant Site</option>\n";
			}
			if ($result_row['cms'] == 'joomla')
			{
				echo "								<option value=\"joomla\" selected=\"selected\">Joomla</option>\n";
			} else {
				echo "								<option value=\"joomla\">Joomla</option>\n";
			}
			if ($result_row['cms'] == 'joostina')
			{
				echo "								<option value=\"joostina\" selected=\"selected\">Joostina</option>\n";
			} else {
				echo "								<option value=\"joostina\">Joostina</option>\n";
			}
			if ($result_row['cms'] == 'klarnetcms')
			{
				echo "								<option value=\"klarnetcms\" selected=\"selected\">Klarnet CMS</option>\n";
			} else {
				echo "								<option value=\"klarnetcms\">Klarnet CMS</option>\n";
			}
			if ($result_row['cms'] == 'kasselercms')
			{
				echo "								<option value=\"kasselercms\" selected=\"selected\">Kasseler CMS</option>\n";
			} else {
				echo "								<option value=\"kasselercms\">Kasseler CMS</option>\n";
			}
			if ($result_row['cms'] == 'modx')
			{
				echo "								<option value=\"modx\" selected=\"selected\">ModX</option>\n";
			} else {
				echo "								<option value=\"modx\">ModX</option>\n";
			}
			if ($result_row['cms'] == 'netcat')
			{
				echo "								<option value=\"netcat\" selected=\"selected\">NetCat</option>\n";
			} else {
				echo "								<option value=\"netcat\">NetCat</option>\n";
			}
			if ($result_row['cms'] == 'php-fusion')
			{
				echo "								<option value=\"php-fusion\" selected=\"selected\">php-fusion</option>\n";
			} else {
				echo "								<option value=\"php-fusion\">php-fusion</option>\n";
			}
			if ($result_row['cms'] == 'php-nuke')
			{
				echo "								<option value=\"php-nuke\" selected=\"selected\">PHP-Nuke</option>\n";
			} else {
				echo "								<option value=\"php-nuke\">PHP-Nuke</option>\n";
			}
			if ($result_row['cms'] == 'phpshop')
			{
				echo "								<option value=\"phpshop\" selected=\"selected\">phpShop</option>\n";
			} else {
				echo "								<option value=\"phpshop\">phpShop</option>\n";
			}
			if ($result_row['cms'] == 'runcms')
			{
				echo "								<option value=\"runcms\" selected=\"selected\">RunCMS</option>\n";
			} else {
				echo "								<option value=\"runcms\">RunCMS</option>\n";
			}
			if ($result_row['cms'] == 'slaed')
			{
				echo "								<option value=\"slaed\" selected=\"selected\">Slaed CMS</option>\n";
			} else {
				echo "								<option value=\"slaed\">Slaed CMS</option>\n";
			}
			if ($result_row['cms'] == 'seditio')
			{
				echo "								<option value=\"seditio\" selected=\"selected\">Seditio</option>\n";
			} else {
				echo "								<option value=\"seditio\">Seditio</option>\n";
			}
			if ($result_row['cms'] == 'typo3')
			{
				echo "								<option value=\"typo3\" selected=\"selected\">TYPO3</option>\n";
			} else {
				echo "								<option value=\"typo3\">TYPO3</option>\n";
			}
			if ($result_row['cms'] == 'twilight')
			{
				echo "								<option value=\"twilight\" selected=\"selected\">Twilight CMS</option>\n";
			} else {
				echo "								<option value=\"twilight\">Twilight CMS</option>\n";
			}
			if ($result_row['cms'] == 'umi')
			{
				echo "								<option value=\"umi\" selected=\"selected\">UMI CMS</option>\n";
			} else {
				echo "								<option value=\"umi\">UMI CMS</option>\n";
			}
			if ($result_row['cms'] == 'wordpress')
			{
				echo "								<option value=\"wordpress\" selected=\"selected\">Wordpress</option>\n";
			} else {
				echo "								<option value=\"wordpress\">Wordpress</option>\n";
			}
			if ($result_row['cms'] == 'diy')
			{
				echo "								<option value=\"diy\" selected=\"selected\">Самописная cms</option>\n";
			} else {
				echo "								<option value=\"diy\">Самописная cms</option>\n";
			}
			if ($result_row['cms'] == 'other')
			{
				echo "								<option value=\"other\" selected=\"selected\">Другая cms</option>\n";
			} else {
				echo "								<option value=\"other\">Другая cms</option>\n";
			}
			echo "							</select>\n";
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Портал на движке форума:</td>\n";
			echo "						<td>\n";
			if ($result_row['portal'] == 1)
			{
				echo "							<label for=\"portal0\">Не используется</label> <input type=\"radio\" name=\"portal\" value=\"0\" id=\"portal0\" /> \n";
				echo "							<label for=\"portal1\">Используется</label> <input type=\"radio\" name=\"portal\" value=\"1\" id=\"portal1\" checked=\"checked\" />\n";
			} else {
				echo "							<label for=\"portal0\">Не используется</label> <input type=\"radio\" name=\"portal\" value=\"0\" id=\"portal0\" checked=\"checked\" /> \n";
				echo "							<label for=\"portal1\">Используется</label> <input type=\"radio\" name=\"portal\" value=\"1\" id=\"portal1\" />\n";
			}
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Тематика форума:</td>\n";
			echo "						<td>\n";
			echo "							<select name=\"category\" value=\"" . $result_row['cat'] . "\">\n";
			echo category_list("option", $result_row['cat']);
			echo "							</select>\n";
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Год запуска:</td>\n";
			echo "						<td>\n";
			echo "							<select name=\"year\">\n";
			if ($result_row['year'] == '0')
			{
				echo "								<option value=\"0\" selected=\"selected\">----</option>\n";
			} else {
				echo "								<option value=\"0\">----</option>\n";
			}
			if ($result_row['year'] == '1998')
			{
				echo "								<option value=\"1998\" selected=\"selected\">1998</option>\n";
			} else {
				echo "								<option value=\"1998\">1998</option>\n";
			}
			if ($result_row['year'] == '1999')
			{
				echo "								<option value=\"1999\" selected=\"selected\">1999</option>\n";
			} else {
				echo "								<option value=\"1999\">1999</option>\n";
			}
			if ($result_row['year'] == '2000')
			{
				echo "								<option value=\"2000\" selected=\"selected\">2000</option>\n";
			} else {
				echo "								<option value=\"2000\">2000</option>\n";
			}
			if ($result_row['year'] == '2001')
			{
				echo "								<option value=\"2001\" selected=\"selected\">2001</option>\n";
			} else {
				echo "								<option value=\"2001\">2001</option>\n";
			}
			if ($result_row['year'] == '2002')
			{
				echo "								<option value=\"2002\" selected=\"selected\">2002</option>\n";
			} else {
				echo "								<option value=\"2002\">2002</option>\n";
			}
			if ($result_row['year'] == '2003')
			{
				echo "								<option value=\"2003\" selected=\"selected\">2003</option>\n";
			} else {
				echo "								<option value=\"2003\">2003</option>\n";
			}
			if ($result_row['year'] == '2004')
			{
				echo "								<option value=\"2004\" selected=\"selected\">2004</option>\n";
			} else {
				echo "								<option value=\"2004\">2004</option>\n";
			}
			if ($result_row['year'] == '2005')
			{
				echo "								<option value=\"2005\" selected=\"selected\">2005</option>\n";
			} else {
				echo "								<option value=\"2005\">2005</option>\n";
			}
			if ($result_row['year'] == '2006')
			{
				echo "								<option value=\"2006\" selected=\"selected\">2006</option>\n";
			} else {
				echo "								<option value=\"2006\">2006</option>\n";
			}
			if ($result_row['year'] == '2007')
			{
				echo "								<option value=\"2007\" selected=\"selected\">2007</option>\n";
			} else {
				echo "								<option value=\"2007\">2007</option>\n";
			}
			if ($result_row['year'] == '2008')
			{
				echo "								<option value=\"2008\" selected=\"selected\">2008</option>\n";
			} else {
				echo "								<option value=\"2008\">2008</option>\n";
			}
			if ($result_row['year'] == '2009')
			{
				echo "								<option value=\"2009\" selected=\"selected\">2009</option>\n";
			} else {
				echo "								<option value=\"2009\">2009</option>\n";
			}
			if ($result_row['year'] == '2010')
			{
				echo "								<option value=\"2010\" selected=\"selected\">2010</option>\n";
			} else {
				echo "								<option value=\"2010\">2010</option>\n";
			}
			if ($result_row['year'] == '2011')
			{
				echo "								<option value=\"2011\" selected=\"selected\">2011</option>\n";
			} else {
				echo "								<option value=\"2011\">2011</option>\n";
			}
			echo "							</select>\n";
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>RSS форума (оставьте пустым, если его нет):</td>\n";
			echo "						<td><input type=\"text\" name=\"rss\" id=\"rss\" value=\"" . $result_row['rss'] . "\" /></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Ваш e-mail:</td>\n";
			echo "						<td><input type=\"text\" name=\"email\" id=\"email\" value=\"" . $result_row['email'] . "\" /></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Форум активен?</td>\n";
			if ($result_row['active'] == 1)
			{
				echo "						<td><input type=\"checkbox\" name=\"active\" id=\"active\" value=\"1\" checked=\"checked\" /></td>\n";
			} else {
				echo "						<td><input type=\"checkbox\" name=\"active\" id=\"active\" value=\"1\" /></td>\n";
			}
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td>Причина отказа в размещении:</td>\n";
			echo "						<td><input type=\"text\" name=\"refusal\" id=\"refusal\" value=\"" . $result_row['refusal'] . "\" /></td>\n";
			echo "					</tr>\n";
			echo "					<tr>\n";
			echo "						<td colspan=\"2\" style=\"text-align:center;\">\n";
			echo "							<input type=\"hidden\" value=\"" . $id . "\" name=\"id\" id=\"id\" />\n";
			echo "							<input type=\"reset\" value=\"Сброс\" class=\"buttons\" />\n";
			echo "							<input type=\"submit\" value=\"Сохранить!\" class=\"buttons\" />\n";
			echo "						</td>\n";
			echo "					</tr>\n";
			echo "					</table>\n";
			echo "					</form>\n";
		}
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
		echo "					<div class=\"news\">\n";
		echo "			<h1>Редактирование форумов</h1>\n";
		echo "				<table width=\"100%\" cellspacing=\"0\">\n";
		echo "				<tr>\n";
		echo "				<th>Форум</th>\n";
		echo "				<th>Движок</th>\n";
		echo "				<th>Дата добавления</th>\n";
		echo "				<th>Тематика форума</th>\n";
		echo "				<th>Год запуска</th>\n";
		echo "				<th>Управление</th>\n";
		echo "			</tr>\n";
		// Выбор всех форумов из базы данных
/*
		$sql = "SELECT *
				FROM " . $dbprefix . "forums";
*/
		$sql = "SELECT *
				FROM " . $dbprefix . "forums
				ORDER BY id DESC
				LIMIT 150";
		$result = mysql_query($sql);
		if (!$result)
		{
			die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
		}
		// Вывод полученного результата
		while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			if ($result_row['active'] == 1)
			{
				echo "<tr>\n";
			} elseif ($result_row['refusal'] != '') {
				echo "<tr class=\"refusal\">\n";
			} else {
				echo "<tr class=\"deactive\">\n";
			}
			echo "<td><a href=\"" . page_html($result_row['url']) . "\" alt=\"" . page_html($result_row['description']) . "\" title=\"" . page_html($result_row['description']) . "\">" . page_html($result_row['title']) . "</a></td>\n";
			echo "<td>" . engine($result_row['engine']) . "</td>\n";
			echo "<td>" . date("m.d.Y, H:i", $result_row['date']) . "</td>\n";
			echo "<td>" . category($result_row['cat']) . "</td>\n";
			echo "<td>" . $result_row['year'] . "</td>\n";
			echo "<td><!--<a href=\"../logo_generate.php?id=" . $result_row['id'] . "\">Лого</a> / --><a href=\"../admin/?mode=edit&id=" . $result_row['id'] . "\"><abbr title=\"Редактировать\">Ред.</abbr></a> / <a href=\"../admin/?mode=delete&id=" . $result_row['id'] . "\"><abbr title=\"Удалить\">Уд.</abbr></a></td>\n";
			echo "</tr>\n";
		}
		echo "					</table>\n";
}
// Закрытие соединения с mysql
mysql_close($connection);
?>

<?php
include('temp/footer.tpl');
?>