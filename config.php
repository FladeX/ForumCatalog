<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: config.php
* last update: 2011.12.03
**/

global $config;

// Smarty
$config['smarty_dir']		= '/www/fc/classes/smarty/';
$config['smarty_template_dir']	= '/www/fc/temp/templates/';
$config['smarty_compile_dir']	= '/www/fc/temp/templates_c/';
$config['smarty_config_dir']	= '/www/fc/temp/configs/';
$config['smarty_cache_dir']	= '/www/fc/temp/cache/';

$config['engines'] = array(
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
$config['cms'] = array(
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
$config['years'] = range(1998, date('Y'), 1);

//$config['abq'] = "Джеймс Кэмерон"; // 2010.02.13
//$config['abq'] = "Виктор Янукович"; // 2010.03.02
//$config['abq'] = "Тим Бертон"; // 2010.03.29
//$config['abq'] = "Григорий Перельман"; // 2010.06.11
//$config['abq'] = "Жак-Ив Кусто"; // 2010.07.13
$config['abq'] = "Диего Форлан"; 

/* Скрипт поиска по сайту на основе Яндекс.XML.
   php-MyAdmin.ru/learning/search.html 0.6 (utf-8). 28.11.2010
   */

/* IP сервера. Должен быть зарегистрирован на странице http://xml.yandex.ru/settings.xml
   */
$aLocal['ip'] = '88.198.38.245';

/* Ваш адрес для совершения запроса, который можно найти на странице http://xml.yandex.ru/settings.xml
   Адрес уникален и должен выглядет примерно так:
   http://xmlsearch.yandex.ru/xmlsearch?user=name&key=********
   */
$aLocal['url'] = 'http://xmlsearch.yandex.ru/xmlsearch?user=fladex&key=03.5708448:af0ab0bd07ae376aa35d5dc64ca45e01';

/* Домен, по которому производится поиск. Например: php-myadmin.ru
   */
$aLocal['host'] = 'forumcatalog.ru';

?>