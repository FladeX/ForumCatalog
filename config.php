<?php

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