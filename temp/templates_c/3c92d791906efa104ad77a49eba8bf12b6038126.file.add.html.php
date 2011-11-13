<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 15:44:42
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/add.html" */ ?>
<?php /*%%SmartyHeaderCode:20358355104e9056ba7b0a77-96313032%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c92d791906efa104ad77a49eba8bf12b6038126' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/add.html',
      1 => 1318160664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20358355104e9056ba7b0a77-96313032',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9056ba900ad',
  'variables' => 
  array (
    'title' => 0,
    'send' => 0,
    'validate' => 0,
    'content' => 0,
    'engines' => 0,
    'item' => 0,
    'key' => 0,
    'category_list' => 0,
    'cms' => 0,
    'year_list' => 0,
    'year' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9056ba900ad')) {function content_4e9056ba900ad($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<?php if ($_smarty_tpl->tpl_vars['send']->value=='send'){?>
    <?php if ($_smarty_tpl->tpl_vars['validate']->value){?>
        <div class="news">
        <h1>Добавление форума</h1>
        <?php echo $_smarty_tpl->tpl_vars['validate']->value;?>

    <?php }else{ ?>
        <div class="news">
            <h1>Добавление форума</h1>
            <p>Ваша заявка принята к рассмотрению! В ближайшее время модераторы каталога рассмотрят её и, возможно, одобрят её для публикации в каталоге.</p>
    <?php }?>
<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }else{ ?>
                                   <div class="forumadd">
                                           <h1>Добавление форума</h1>
                                           <form method="post" action="../add/">
                                           <div class="column">
                                                   Название форума
                                                   <div class="textfield">
                                                           <input type="text" name="name" id="name" value="">
                                                   </div>
                                                   <div class="formbox">
                                                           <div class="box_top">
                                                                   <div class="box_bottom">
                                                                           О чём ваш форум?<br>
                                                                           Для кого форум предназначен в первую очередь?<br>
                                                                           Какие вопросы обсуждаются на форуме?<br>
                                                                           Какие основные тематические разделы есть на форуме?<br>
                                                                           Чем форум отличается от аналогичных по тематике?
                                                                   </div>
                                                           </div>
                                                   </div>
                                                   Движок форума
                                                   <div class="selectfield">
                                                           <div class="inner">
                                                           </div>
                                                           <input name="engine" type="hidden" value="">
                                                           <div class="options">
                                                                   <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['engines']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                                                        <div><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
<input name="engine_" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"></div>
                                                                   <?php } ?>
                                                           </div>
                                                   </div>
                                                   Портал на движке форума
                                                   <div class="selectfield">
                                                           <div class="inner">
                                                           </div>
                                                           <input name="portal" type="hidden" value="">
                                                           <div class="options">
                                                                   <div class="selected">Не используется<input name="portal_" type="hidden" value="0"></div>
                                                                   <div>Используется<input name="portal_" type="hidden" value="1"></div>
                                                           </div>
                                                   </div>
                                                   Тематика форума
                                                   <div class="selectfield">
                                                           <div class="inner">
                                                           </div>
                                                           <input type="hidden" name="category" value="">
                                                           <div class="options">
                                                                     <?php echo $_smarty_tpl->tpl_vars['category_list']->value;?>

                                                           </div>
                                                   </div>
                                                   RSS форума (необязательно)
                                                   <div class="textfield">
                                                           <input type="text" name="rss" id="rss" value="">
                                                   </div>
                                                   Шифр с <a href="http://forumadmins.ru/viewtopic.php?f=14&amp;t=100&amp;r=2" target="_blank">ForumAdmins</a>:
                                                   <div class="textfield">
                                                           <input type="text" name="abq" id="abq" value="">
                                                   </div>
                                           </div>
                                           <div class="column">
                                                   Адрес форума
                                                   <div class="textfield">
                                                           <input type="text" name="url" id="url" value="">
                                                   </div>
                                                   Описание форума
                                                   <div class="textareafield">
                                                           <script type="text/javascript">
                                                                   $(document).ready(function() {
                                                                           $("#description").markItUp(mySettings);
                                                                   });
                                                           </script>
                                                           <textarea name="description" id="description" cols="5" rows="5"></textarea>
                                                   </div>
                                                   Интеграция с CMS
                                                   <div class="selectfield">
                                                           <div class="inner">
                                                           </div>
                                                           <input type="hidden" name="cms" id="cms" value="">
                                                           <div class="options">
                                                                   <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
                                                                        <div><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
<input name="cms_" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"></div>
                                                                   <?php } ?>
                                                           </div>
                                                   </div>
                                                   Год запуска
                                                   <div class="selectfield">
                                                           <div class="inner">
                                                           </div>
                                                           <input type="hidden" name="year" value="">
                                                           <div class="options">
                                                                   <div>----<input name="year_" type="hidden" value="0"></div>
                                                                   <?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['year_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
?>
                                                                        <div><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
<input name="year_" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
"></div>
                                                                   <?php } ?>
                                                           </div>
                                                   </div>
                                                   Электронная почта
                                                   <div class="textfield">
                                                           <input type="text" name="email" value="">
                                                   </div>
                                                   <div class="clink">
                                                           <input type="reset" value="Очистить все">
                                                   </div>
                                           </div>
                                           <div class="clear"></div>
                                           <div class="submit">
                                                   <input type="hidden" value="send" name="send" id="send" style="display:none;" />
                                                   <input type="submit" value="Отправить">
                                           </div>
                                           </form>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>