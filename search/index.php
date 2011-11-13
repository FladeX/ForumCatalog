<?php

/* Скрипт поиска по сайту на основе Яндекс.XML.
   php-MyAdmin.ru/learning/search.html 0.6 (utf-8). 28.11.2010
   */

$sSearch_text = (isset($_REQUEST['find']) && strlen($_REQUEST['find']) > 2)
    ? htmlspecialchars($_REQUEST['find']) : '';

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>Поиск по сайту с помощью Яндекс XML - Разработка php-MyAdmin.ru</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="search.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="search.js"></script>
</head>

<body>

<!-- Поиск. Начало. -->
<div>
  <form method="post" action="" onsubmit="javascript:Search_onsubmit(1); return false;">
    <div>
      <input type="text" id="search_text" value="<?php echo $sSearch_text; ?>" maxlength="100" size="50" />
      <input type="submit" id="search_submit" value="Искать" />
    </div>
  </form>
  <noscript>Для работы поиска включите в браузере JavaScript.</noscript>
  <div class="search_div" id="search_div"></div>
  <script type="text/javascript">
<!--
document.onkeydown = L_page_onkeydown;
<?php
    if (!empty($sSearch_text)) echo 'Search_onsubmit(1)' . "\n";
?>
//-->
  </script>
</div>
<!-- Поиск. Конец. -->

</body>

</html>
