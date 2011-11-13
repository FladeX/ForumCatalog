<?php /* Smarty version Smarty-3.1.3, created on 2011-10-17 20:29:54
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:18228568214e9c58022f6fa8-57168316%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b5807c8b822649988568fa903ed125110679f37' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_edit.html',
      1 => 1318868978,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18228568214e9c58022f6fa8-57168316',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'category' => 0,
    'category_list' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9c58023e70c',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9c58023e70c')) {function content_4e9c58023e70c($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<a href="../admin/">Администраторский раздел</a>, <a href="../admin/?mode=category">Список категорий</a>, <a href="../admin/?mode=category&amp;option=create">Создать категорию</a>

<div class="news">
	<h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
	<form method="post" action="../admin/?mode=category&amp;option=save">
		<table width="100%" cellspacing="0" border="0">
		<tr>
			<td width="49%">Название категории:</td>
			<td width="49%"><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
" /></td>
		</tr>
		<tr>
			<td>Родительская категория:</td>
			<td>
				<select name="parent">
					<option value="0">Нет родителя</option>
					<?php echo $_smarty_tpl->tpl_vars['category_list']->value;?>

				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" name="id" id="id" />
				<input type="reset" value="Сброс" class="buttons" />
				<input type="submit" value="Сохранить!" class="buttons" />
			</td>
		</tr>
		</table>
	</form>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>