<?php /* Smarty version Smarty-3.1.3, created on 2011-10-16 21:13:41
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_forum_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:16010948594e9b0bb74ab3a1-60420889%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a765946e12da11271e4be6615902c4c65ef7254' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_forum_edit.html',
      1 => 1318785216,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16010948594e9b0bb74ab3a1-60420889',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9b0bb7667e8',
  'variables' => 
  array (
    'title' => 0,
    'forum' => 0,
    'engines' => 0,
    'key' => 0,
    'item' => 0,
    'cms_list' => 0,
    'category_list' => 0,
    'years' => 0,
    'year' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9b0bb7667e8')) {function content_4e9b0bb7667e8($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<a href="../admin/">Администраторский раздел</a>, <a href="../admin/?mode=category">Список категорий</a>, <a href="../admin/?mode=category&amp;option=create">Создать категорию</a>

<div class="news">
	<h1>Редактирование форума</h1>
	<form method="post" action="../admin/?mode=save">
		<table width="100%" cellspacing="0" border="0">
		<tr>
			<td width="49%">Название форума:</td>
			<td width="49%"><input type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
" /></td>
		</tr>
		<tr>
			<td>Адрес форума:</td>
			<td><input type="text" name="url" id="url" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['url'];?>
" /></td>
		</tr>
		<tr>
			<td>Описание форума:</td>
			<td><textarea name="description" id="description" rows="20" cols="40"><?php echo $_smarty_tpl->tpl_vars['forum']->value['description'];?>
</textarea></td>
		</tr>
		<tr>
			<td>Движок форума:</td>
			<td>
				<select name="engine">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['engines']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['forum']->value['engine']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Интеграция с cms:</td>
			<td>
				<select name="cms">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['key']->value==$_smarty_tpl->tpl_vars['forum']->value['cms']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Портал на движке форума:</td>
			<td>
				<label for="portal0">Не используется</label> <input type="radio" name="portal" value="0" id="portal0"<?php if ($_smarty_tpl->tpl_vars['forum']->value['portal']==0){?> checked="checked"<?php }?> />
				<label for="portal1">Используется</label> <input type="radio" name="portal" value="1" id="portal1"<?php if ($_smarty_tpl->tpl_vars['forum']->value['portal']==1){?> checked="checked"<?php }?> />
			</td>
		</tr>
		<tr>
			<td>Тематика форума:</td>
			<td>
				<select name="category" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['cat'];?>
">
					 <?php echo $_smarty_tpl->tpl_vars['category_list']->value;?>

				</select>
			</td>
		</tr>
		<tr>
			<td>Год запуска:</td>
			<td>
				<select name="year">
					<option value="0">----</option>
					<?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value){
$_smarty_tpl->tpl_vars['year']->_loop = true;
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['year']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['year']->value==$_smarty_tpl->tpl_vars['forum']->value['year']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['year']->value;?>
</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>RSS форума (оставьте пустым, если его нет):</td>
			<td><input type="text" name="rss" id="rss" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['rss'];?>
" /></td>
		</tr>
		<tr>
			<td>Ваш e-mail:</td>
			<td><input type="text" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['email'];?>
" /></td>
		</tr>
		<tr>
			<td>Форум активен?</td>
			<td><input type="checkbox" name="active" id="active" value="1"<?php if ($_smarty_tpl->tpl_vars['forum']->value['active']==1){?> checked="checked"<?php }?> /></td>
		</tr>
		<tr>
			<td>Причина отказа в размещении:</td>
			<td><input type="text" name="refusal" id="refusal" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['refusal'];?>
" /></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
" name="id" id="id" />
				<input type="reset" value="Сброс" class="buttons" />
				<input type="submit" value="Сохранить!" class="buttons" />
			</td>
		</tr>
		</table>
	</form>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>