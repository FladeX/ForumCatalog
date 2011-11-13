<?php /* Smarty version Smarty-3.1.3, created on 2011-10-17 20:17:04
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_list.html" */ ?>
<?php /*%%SmartyHeaderCode:8564317554e9c5500ae40c2-96842136%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57d69fc9a2ea4a7cd53fadd219ad028894eda7bf' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_category_list.html',
      1 => 1318868220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8564317554e9c5500ae40c2-96842136',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'category_list' => 0,
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9c5500c0539',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9c5500c0539')) {function content_4e9c5500c0539($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<a href="../admin/">Администраторский раздел</a>, <a href="../admin/?mode=category">Список категорий</a>, <a href="../admin/?mode=category&amp;option=create">Создать категорию</a>

<div class="news">
	<h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
	<ul>
		<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
 (<a href="../admin/?mode=category&amp;option=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
">редактировать</a>, <a href="../admin/?mode=category&amp;option=delete&amp;id=<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
">удалить</a>)</li>
		<?php } ?>
	</ul>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>