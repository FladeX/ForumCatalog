<?php

/* Скрипт поиска по сайту на основе Яндекс.XML.
   php-MyAdmin.ru/learning/search.html 0.6 (utf-8). 28.11.2010
   */

function L_test() {
    global $aLocal;
    $aFunc = array('curl_init'  => 'Отсутствует расширение curl.',
                   'preg_match' => 'Отсутствует расширение pcre.');
    foreach ($aFunc as $key => $value) {
        if (!function_exists($key)) print '<h1 style="color: red;">' . $value . "</h1>\n";
    }
    if (!isset($aLocal['ip']) || !preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/', $aLocal['ip'])) {
        print '<div style="color: red; font-size: 150%;">Укажите в конфигурационном файле config.php IP сервера.</div>' . "\n";
    }
    if (!isset($aLocal['url']) || !preg_match('/^http\:\/\/xmlsearch\.yandex\.ru\/xmlsearch.+/', $aLocal['url'])) {
        print '<div style="color: red; font-size: 150%;">Укажите в конфигурационном файле config.php ваш адрес для совершения запроса.</div>' . "\n";
    }
    if (!isset($aLocal['host']) || strlen($aLocal['host']) < 5) {
        print '<div style="color: red; font-size: 150%;">Укажите в конфигурационном файле config.php домен сервера.</div>' . "\n";
    }
}

require('./config.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Тест - Поиск по сайту с помощью Яндекс XML - Разработка php-MyAdmin.ru</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<!-- Вставка поля поиска. Начало. -->
<form method="post" action="/search/" onsubmit="javascript:if (document.getElementById('search_find').value.length < 3) { alert('Введите в поле запроса не менее трёх символов!'); document.getElementById('search_find').focus(); return false; }">
  <div>
    <input type="text" id="search_find" name="find" value="" maxlength="100" size="50" />
    <input type="submit" value="Искать" />
  </div>
</form>
<!-- Вставка поля поиска. Конец. -->

<!-- Проверка наличия обязательных расширений PHP и ошибок в конфигурационном файле. -->
<?php L_test(); ?>
</body>

</html>
