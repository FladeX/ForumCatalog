<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: add.php
* last update: 2011.12.03
**/
include('config.php');
include('db.php');
include('functions.php');
include('classes/Forum.php');
include('classes/smarty/Smarty.class.php');

global $config;
global $sape;

$smarty = new Smarty();

$smarty->template_dir = $config['smarty_template_dir'];
$smarty->compile_dir = $config['smarty_compile_dir'];
$smarty->config_dir = $config['smarty_config_dir'];
$smarty->cache_dir = $config['smarty_cache_dir'];

$sape_links = $sape->return_links();

$forum = new Forum;
$recent_forums = $forum->display_recent_forums();

$send = (isset($_POST['send']) ? $_POST['send'] : "");
if ($send == "send") {
	$data_name			= (isset($_POST['name']) ? (string) $_POST['name'] : "");
	$data_url			= (isset($_POST['url']) ? (string) $_POST['url'] : "");
	$data_description		= (isset($_POST['description']) ? (string) $_POST['description'] : "");
	$data_engine			= (isset($_POST['engine']) ? (string) $_POST['engine'] : "");
	$data_portal			= (isset($_POST['portal']) ? (int) $_POST['portal'] : "");
	$data_cms			= (isset($_POST['cms']) ? (string) $_POST['cms'] : "");
	$data_category			= (isset($_POST['category']) ? (int) $_POST['category'] : "");
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
	$validate = false;
	$category_list = category_list("div", 0);
}

$smarty->assign('title', 'Добавление форума');

if (isset($category_list)) {
	$smarty->assign('category_list', $category_list);
}
if (isset($config['years'])) {
	$smarty->assign('year_list', $config['years']);
}
if (isset($config['engines'])) {
	$smarty->assign('engines', $config['engines']);
}
if (isset($config['cms'])) {
	$smarty->assign('cms', $config['cms']);
}

$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('validate', $validate);
$smarty->assign('sape_links', $sape_links);
$smarty->assign('send', $send);
$smarty->display('add.html');
?>