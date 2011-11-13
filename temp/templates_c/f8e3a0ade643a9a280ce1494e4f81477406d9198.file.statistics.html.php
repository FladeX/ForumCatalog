<?php /* Smarty version Smarty-3.1.3, created on 2011-10-08 17:51:26
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/statistics.html" */ ?>
<?php /*%%SmartyHeaderCode:5205399184e90555e1023a9-55451931%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8e3a0ade643a9a280ce1494e4f81477406d9198' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/statistics.html',
      1 => 1318081867,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5205399184e90555e1023a9-55451931',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e90555e1b935',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e90555e1b935')) {function content_4e90555e1b935($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                        <div class="news">
                                                <h1>Статистика форумов</h1>
                                                        <p>Статистические данные, собранные на основе добавленных в каталог форумов:</p>
                                                        <p style="text-align:center;"><img src="../images/temp/example10.png" alt="Диаграмма популярности движков форумов" /><br /><i>Распределение движков среди добавленных в каталог форумов</i></p>
                                                        <p style="text-align:center;"><img src="../images/temp/years.png" alt="Диаграмма запуска форумов по годам" /><br /><i>Распределение по годам запуска форумов среди добавленных в каталог форумов</i></p>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>