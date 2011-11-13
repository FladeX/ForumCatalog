<?php
/**
* project: ForumCatalog
* version: 2.0
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: sitemap.php
* last update: 2011.10.02
**/
include('db.php');

// Выбор всех форумов из базы данных
$sql = "SELECT *
		FROM " . $dbprefix . "forums
		WHERE active = 1
		ORDER BY id DESC";
$result = mysql_query($sql);
if (!$result) {
	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
}
// Вывод полученного результата
header("Content-Type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	echo "<url>\n";
	echo "<lastmod>" . date('Y-m-d\TH:i:s+00:00', time()) . "</lastmod>\n";
	echo "<loc>http://forumcatalog.ru/forum" . $result_row['id'] . "/</loc>\n";
	echo "<changefreq>weekly</changefreq>\n";
	echo "<priority>0.5</priority>\n";
	echo "</url>\n";
}
echo "</urlset>";
?>