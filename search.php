<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: search.php
* last update: 2011.11.26
**/
include('config.php');
include('db.php');
include('functions.php');
include('classes/Forum.php');
include('classes/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->template_dir = SMARTY_TEMPLATE_DIR;
$smarty->compile_dir = SMARTY_COMPILE_DIR;
$smarty->config_dir = SMARTY_CONFIG_DIR;
$smarty->cache_dir = SMARTY_CACHE_DIR;

global $sape;
$sape_links = $sape->return_links();

$forum = new Forum;
$recent_forums = $forum->display_recent_forums();

$sSearch_text = (isset($_REQUEST['find']) && strlen($_REQUEST['find']) > 2) ? htmlspecialchars($_REQUEST['find']) : '';

$smarty->assign('title', 'Поиск');
$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('sSearch_text', $sSearch_text);
$smarty->assign('sape_links', $sape_links);
$smarty->display('search.html');
?>