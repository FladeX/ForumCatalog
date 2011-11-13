<?php /* Smarty version Smarty-3.1.3, created on 2011-10-16 19:57:52
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_forum_list.html" */ ?>
<?php /*%%SmartyHeaderCode:1983541264e9af6fd730f88-11723613%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a013704e2e5908a609c973ce7be54eeba6e7b980' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_forum_list.html',
      1 => 1318780661,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1983541264e9af6fd730f88-11723613',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9af6fd8c34c',
  'variables' => 
  array (
    'title' => 0,
    'admin_forum_list' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9af6fd8c34c')) {function content_4e9af6fd8c34c($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<a href="../admin/">Администраторский раздел</a>, <a href="../admin/?mode=category">Список категорий</a>, <a href="../admin/?mode=category&amp;option=create">Создать категорию</a>

<div class="news">
	<h1>Редактирование форумов</h1>
	<table width="100%" cellspacing="0">
	<tr>
		<th>Форум</th>
		<th>Движок</th>
		<th>Дата добавления</th>
		<th>Тематика форума</th>
		<th>Год запуска</th>
		<th>Управление</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['admin_forum_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
		<?php if ($_smarty_tpl->tpl_vars['forum']->value['active']){?>
			<tr>
		<?php }elseif($_smarty_tpl->tpl_vars['forum']->value['refusal']!=''){?>
			<tr class="refusal">
		<?php }else{ ?>
			<tr class="deactive">
		<?php }?>
			<td><a href="<?php echo $_smarty_tpl->tpl_vars['forum']->value['url'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['forum']->value['description'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['forum']->value['description'];?>
"><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</a></td>
			<td><?php echo $_smarty_tpl->tpl_vars['forum']->value['engine'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['forum']->value['date'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['forum']->value['cat'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['forum']->value['year'];?>
</td>
			<td><!--<a href=\"../logo_generate.php?id=<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
">Лого</a> / --><a href="../admin/?mode=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
"><abbr title="Редактировать">Ред.</abbr></a> / <a href="../admin/?mode=delete&amp;id=<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
"><abbr title="Удалить">Уд.</abbr></a></td>
		</tr>
	<?php } ?>
	</table>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>