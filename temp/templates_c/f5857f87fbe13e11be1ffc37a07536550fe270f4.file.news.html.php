<?php /* Smarty version Smarty-3.1.3, created on 2011-10-08 17:40:34
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/news.html" */ ?>
<?php /*%%SmartyHeaderCode:5921806934e9052d276a2e9-20634401%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5857f87fbe13e11be1ffc37a07536550fe270f4' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/news.html',
      1 => 1318081147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5921806934e9052d276a2e9-20634401',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9052d28865f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9052d28865f')) {function content_4e9052d28865f($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                        <div class="news">
                                                <h1>Новости</h1>
                                                        <div class="item">
                                                                <div class="date">26 февраля 2011</div>
                                                                <h2>Поиск по каталогу</h2>
                                                                <p>Нужный функционал, долгое время отсутствовавший в каталоге &mdash; поиск &mdash; наконец-то был добавлен. Теперь любой посетитель может найти интересующие его форумы не только с помощью категорий, но и введя соответствующие ключевые слова на <a href="http://forumcatalog.ru/search/">странице поиска</a> в каталоге. Для реализации были использованы технологии Яндекс.XML.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">19 декабря 2010</div>
                                                                <h2>Лучшие 50</h2>
                                                                <p>После добавления рейтинга к размещённым в каталоге форумам логичным шагом было создание списка форумов, имеющих самый высокий рейтинг. Итак, встречайте&nbsp;&mdash;&nbsp;&laquo;<a href="http://forumcatalog.ru/rating/">Лучшие 50</a>&raquo;. Данный список составляется исключительно на оценках форумов, данных посетителями каталога.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">4 августа 2010</div>
                                                                <h2>BB-коды</h2>
                                                                <p>С этого момента при составлении описания форума можно пользоваться BB-кодами. Поддерживаются следующие BB-коды: [b]<b>полужирный текст</b>[/b], [i]<i>наклонный текст</i>[/i], [u]<u>подчёркнутый текст</u>[/u], [color=Цвет]<span style="color:blue">выделение цветом</span>[/color], [quote]цитата[/quote], [code]код[/code], [list][*]маркированный[/list] и [list=1][*]нумерованный[/list] списки.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">13 июля 2010</div>
                                                                <h2>Редизайн каталога</h2>
                                                                <p>Многие пользователи отмечали недостатки дизайна каталога форумов. Под действием общественного мнения был сделан новый дизайн, который вы можете наблюдать на сайте уже сейчас. При создании этого дизайна основное внимание было уделено вопросу подачи контента, что и было достигнуто в итоге.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">5 июня 2010</div>
                                                                <h2>Рейтинг форумов</h2>
                                                                <p>У добавленных в каталог форумов появилась новая характеристика — рейтинг. Он складывается из голосов, оставленных пользователями. Голоса могут быть как положительными, так и отрицательными. Во избежании накрутки рейтинга каждый пользователь может проголосовать за один форум лишь раз.</p>
                                        </div>
                                        <div class="item">
                                                                <div class="date">2 марта 2010</div>
                                                                <h2>Непринятые форумы</h2>
                                                                <p>Каталог форумов постепенно пополняется новыми форумами, что параллельно приводит к повышению требований к размещению в каталоге для новых заявок. Для удобства определения дальнейшей судьбы поданной заявки в каталоге был открыт раздел «<a href="http://forumcatalog.ru/refusal/">Непринятое</a>», в котором выводятся форумы, отклонённые при модерации, с указанием причины отказа в размещении.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">18 февраля 2010</div>
                                                                <h2>RSS ленты форумов</h2>
                                                                <p>При добавлении форума теперь можно указать ссылку на его rss. При размещении форума в каталоге это позволит выводить последние темы/сообщения с него на персональной странице этого форума в каталоге. Если у вашего форума нет rss, то просто оставьте соответствующее поле пустым.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">16 февраля 2010</div>
                                                                <h2>Диаграмма распределения форумов по году запуска</h2>
                                                                <p>В разделе «Статистика» добавлена диаграмма, отображающая распределение форумов по годам их запуска. Чтобы не слишком загромождать диаграмму, 2006 год и более ранние объединены в одну категорию. Более поздние года отображаются по отдельности.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">20 января 2010</div>
                                                                <h2>Интеграция с <abbr title="Content Management System">cms</abbr></h2>
                                                                <p>Многие форумы работают в связке с сайтом. Сайт может быть как на отдельной <abbr title="Content Management System">cms</abbr>, так и на портале, основанном на форуме. Теперь при добавлении форума в каталог можно указать тип сайта, используемого в связке с форумом.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">16 января 2010</div>
                                                                <h2>Расширен список движков</h2>
                                                                <p>Список форумных движков расширен, в него были добавлены в том числе и такие редкие, как ExBB, YaBB, Vanilla, bbPress, PyBB, FluxBB и Discuz. Также был добавлен вариант «самописный движок» для проектов, не использующих готовые разработки.</p>
                                                        </div>
                                                        <div class="item">
                                                                <div class="date">14 января 2010</div>
                                                                <h2>Запуск каталога форумов</h2>
                                                                <p>С сегодняшнего дня будет функционировать новый каталог сайтов, специализированный для форумов. Сюда будут приниматься все присланные вами форумы, в случае, если заявка оформлена верно и ваш форум представляет интерес для пользователей.</p>
                                                        </div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>