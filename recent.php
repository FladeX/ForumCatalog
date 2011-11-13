<?php
/**
* project: ForumCatalog
* version: 2.0
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: recent.php
* last update: 2011.10.02
**/
include('db.php');
//include('functions.php');

$forum = new Forum;
echo $forum->display_recent_forums();

// Закрытие соединения с mysql
mysql_close($connection);
?>