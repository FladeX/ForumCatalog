<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: rating.php
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
$top_forums = $forum->display_top_forums();
$recent_forums = $forum->display_recent_forums();

$smarty->assign('title', 'Рейтинг форумов');
$smarty->assign('top_forums', $top_forums);
$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('sape_links', $sape_links);
$smarty->display('rating.html');
?>