<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: index.php
* last update: 2011.12.03
**/
include('config.php');
include('db.php');
include('functions.php');
include('markitup.bbcode-parser.php');
include('classes/Forum.php');
include('classes/Category.php');
include('classes/smarty/Smarty.class.php');

global $config;
global $sape;

if (isset($_GET['mode']))
{
	$mode = $_GET['mode'];
}
else
{
	$mode = '';
}
$send = (isset($_POST['send']) ? $_POST['send'] : '');
$type = (isset($_POST['type']) ? $_POST['type'] : '');

$forum = new Forum;
$category = new Category;
$smarty = new Smarty();

$smarty->template_dir = $config['smarty_template_dir'];
$smarty->compile_dir = $config['smarty_compile_dir'];
$smarty->config_dir = $config['smarty_config_dir'];
$smarty->cache_dir = $config['smarty_cache_dir'];

$sape_links = $sape->return_links();

$recent_forums = $forum->display_recent_forums();

switch($mode)
{
	case "view":
		$id = $_GET['id'];
                $title = 'Каталог форумов';
		//$content = $forum->display_forum($id, $send, $type);
                $forum_view = $forum->display_forum($id, $send, $type);

                $smarty->assign('title', $forum_view['title']);
                $smarty->assign('forum', $forum_view);
                $smarty->assign('recent_forums', $recent_forums);
                $smarty->assign('sape_links', $sape_links);
                $smarty->display('forum_view.html');
		break;
	case "forumlist":
		catalog_header('');
                $title = 'Каталог форумов';
		$content = $forum->display_forumlist();

                $smarty->assign('title', $title);
                $smarty->assign('content', $content);
                $smarty->assign('recent_forums', $recent_forums);
                $smarty->assign('sape_links', $sape_links);
                $smarty->display('main.html');
		break;
	case "category":
		$id = $_GET['id'];
		if (!$id)
		{
			die("Указанной категории не существует!");
		}
                $title = 'Каталог форумов';
		$category = $category->display_category_content($id);

                $smarty->assign('title', $category['title']);
                $smarty->assign('category', $category);
                $smarty->assign('recent_forums', $recent_forums);
                $smarty->assign('sape_links', $sape_links);
                $smarty->display('category_view.html');
		break;
	default:
                $title = 'Каталог форумов';
                $categories = $category->display_category_list('h2', 0);

                $smarty->assign('title', $title);
                $smarty->assign('categories', $categories);
                $smarty->assign('recent_forums', $recent_forums);
                $smarty->assign('sape_links', $sape_links);
                $smarty->display('category_list.html');
		break;
}
?>