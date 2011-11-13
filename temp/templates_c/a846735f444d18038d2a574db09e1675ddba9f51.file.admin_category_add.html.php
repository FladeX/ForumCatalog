<?php /* Smarty version Smarty-3.1.3, created on 2011-10-16 21:33:44
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_add.html" */ ?>
<?php /*%%SmartyHeaderCode:9507056474e9b1553515e27-84553499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a846735f444d18038d2a574db09e1675ddba9f51' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_add.html',
      1 => 1318786422,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9507056474e9b1553515e27-84553499',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9b15535f505',
  'variables' => 
  array (
    'title' => 0,
    'category_list' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9b15535f505')) {function content_4e9b15535f505($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<a href="../admin/">Администраторский раздел</a>, <a href="../admin/?mode=category">Список категорий</a>, <a href="../admin/?mode=category&amp;option=create">Создать категорию</a>

<div class="news">
	<h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
	<form method="post" action="../admin/?mode=category&amp;option=new">
		<table width="100%" cellspacing="0" border="0">
		<tr>
			<td width="49%">Название категории:</td>
			<td width="49%"><input type="text" name="name" id="name" value="" /></td>
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
				<input type="hidden" name="send" value="send" />
				<input type="reset" value="Сброс" class="buttons" />
				<input type="submit" value="Добавить!" class="buttons" />
			</td>
		</tr>
		</table>
	</form>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>