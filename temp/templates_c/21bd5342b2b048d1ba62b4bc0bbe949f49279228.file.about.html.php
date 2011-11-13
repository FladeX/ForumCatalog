<?php /* Smarty version Smarty-3.1.3, created on 2011-10-08 17:06:07
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/about.html" */ ?>
<?php /*%%SmartyHeaderCode:6748720594e904330707f34-16793384%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21bd5342b2b048d1ba62b4bc0bbe949f49279228' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/about.html',
      1 => 1318079163,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6748720594e904330707f34-16793384',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9043307e915',
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9043307e915')) {function content_4e9043307e915($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                        <div class="news">
                                                <h1>О каталоге</h1>
                                                        <div class="item">
                                                                <p>Данный ресурс является специализированным каталогом форумов. Если у вас есть качественный форум, добавьте его в данный каталог, указав необходимые данные о нём. В каталоге действует премодерация, поэтому добавленные форумы появятся в каталоге не сразу, а только после одобрения модератором.</p>
                                                                <p>Все принятые форумы участвуют как в <a href="http://forumcatalog.ru/statistics/">статистике форумов</a>, так и в <a href="http://forumcatalog.ru/rating/">рейтинге форумов</a>. Не поленитесь составить правильное описание для своего форума, чтобы не искажать статистику.</p>
                                                        </div>
                                                        <div class="item">
                                                                <h2>Правила каталога</h2>
                                                                <p>Предложенные пользователями форумы публикуются на сайте только при условии соответствия правилам каталога:</p>
                                                                <ol>
                                                                        <li>Предложенный ресурс должен являться форумом. Ссылка в анкете должна вести на форум, даже если форум находится во вложенной директории на сайте.</li>
                                                                        <li>Описание форума должно быть уникальным (проверяется по поисковикам). Для удобства его составления в форме добавления приведён ряд вопросов, ответив на которые, можно получить правильное описание. Однако данный способ не является обязательным и описание может быть приведено в другой форме.</li>
                                                                        <li>Описание форума не должно быть коротким. Пожалуйста, не добавляйте в каталог форумы с описанием из одного предложения — сэкономьте своё время, ведь такие форумы всё равно не будут добавлены. Чем больше и лучше описание, тем выше шансы на размещение форума в каталоге.</li>
                                                                        <li>Все данные в форме добавления форума должны соответствовать реальности. Особенно это касается полей «Движок форума», «Год запуска», «Интеграция с cms» и «Наличие портала». При несоответствии данных форум не будет размещён в каталоге.</li>
                                                                </ol>
                                                        </div>
                                                        <div class="item">
                                                                <h2>Кнопка</h2>
                                                                <p>Вы можете разместить на своём форуме или блоге кнопку нашего каталога. При добавлении форума в каталог такая кнопка увеличит шансы на успешное рассмотрение заявки.</p>
                                                                <p style="text-align:center;"><a href="http://forumcatalog.ru/"><img src="http://forumcatalog.ru/images/b/button.gif" alt="каталог форумов" /></a></p>
                                                                <textarea readonly="readonly" style="width:98%"><a href="http://forumcatalog.ru/"><img src="http://forumcatalog.ru/images/b/button.gif" alt="каталог форумов" /></a></textarea>
                                                                <textarea readonly="readonly" style="width:98%">[url=http://forumcatalog.ru/][img]http://forumcatalog.ru/images/b/button.gif[/img][/url]</textarea>
                                                        </div>
                                                        <div class="item">
                                                                <h2>Контакты</h2>
                                                                <p>По всем вопросам можете писать на контактный e-mail <a href="mailto:42@forumstudio.ru">42@forumstudio.ru</a>.</p>
                                                        </div>
                                                        <div class="item">
                                                                <h2>Другие наши проекты:</h2>
                                                                <ul>
                                                                        <li><a href="http://fladex.ru/">phpBB Adept</a></li>
                                                                        <li><a href="http://forumadmins.ru/?r=2">Форум для администраторов форумов</a></li>
                                                                        <li><a href="http://lastforum.ru/?r=2">Форум с оплатой за сообщения</a></li>
                                                                        <li><a href="http://forummap.ru/">Сервис генерации sitemap для форумов</a></li>
                                                                        <li><a href="http://forumstat.ru/">Сервис сбора статистики с форумов</a></li>
                                                                        <li><a href="http://forumquoter.ru/">Цитатник форумов</a></li>
                                                                </ul>
                                                        </div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>