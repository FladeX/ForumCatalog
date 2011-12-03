<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: rating.php
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
$top_forums = $forum->display_top_forums();
$recent_forums = $forum->display_recent_forums();

$smarty->assign('title', 'Рейтинг форумов');
$smarty->assign('top_forums', $top_forums);
$smarty->assign('recent_forums', $recent_forums);
$smarty->assign('sape_links', $sape_links);
$smarty->display('rating.html');
?>