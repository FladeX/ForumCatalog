<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: add.php
* last update: 2011.10.08
**/
include('db.php');
include('functions.php');
include('classes/Forum.php');
define('SMARTY_DIR', '/var/www/fladex/data/www/forumcatalog.ru/classes/smarty/');
include('classes/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/';
$smarty->compile_dir = '/var/www/fladex/data/www/forumcatalog.ru/temp/templates_c/';
$smarty->config_dir = '/var/www/fladex/data/www/forumcatalog.ru/temp/configs/';
$smarty->cache_dir = '/var/www/fladex/data/www/forumcatalog.ru/temp/cache/';

global $sape;
$sape_links = $sape->return_links();

$forum = new Forum;
$recent_forums = $forum->display_recent_forums();

$send = (isset($_POST['send']) ? $_POST['send'] : "");
if ($send == "send") {
	$data_name			= (isset($_POST['name']) ? (string) $_POST['name'] : "");
	$data_url			= (isset($_POST['url']) ? (string) $_POST['url'] : "");
	$data_description	= (isset($_POST['description']) ? (string) $_POST['description'] : "");
	$data_engine		= (isset($_POST['engine']) ? (string) $_POST['engine'] : "");
	$data_portal		= (isset($_POST['portal']) ? (int) $_POST['portal'] : "");
	$data_cms			= (isset($_POST['cms']) ? (string) $_POST['cms'] : "");
	$data_category		= (isset($_POST['category']) ? (int) $_POST['category'] : "");
	$data_year			= (isset($_POST['year']) ? (int) $_POST['year'] : "");
	$data_email			= (isset($_POST['email']) ? (string) $_POST['email'] : "");
	$data_abq			= (isset($_POST['abq']) ? (string) $_POST['abq'] : "");
	$data_rss			= (isset($_POST['rss']) ? (string) $_POST['rss'] : "");
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

	$validate = $forum->add_forum($data_name, $data_url, $data_description, $data_engine, $data_portal, $data_cms, $data_category, $data_year, $data_email, $data_rss, $data_abq);
}
else {
        $category_list = category_list("div", 0);
        $year_list = array();
        for ($i = 1998; $i <= date('Y'); $i++) {
            $year_list[] = $i;
        }

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
}

$smarty->assign('title', 'Добавление форума');
$smarty->assign('category_list', $category_list);
$smarty->assign('year_list', $year_list);
$smarty->assign('engines', $engines);
$smarty->assign('cms', $cms);
$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('validate', $validate);
$smarty->assign('sape_links', $sape_links);
$smarty->assign('send', $send);
$smarty->display('add.html');
?>