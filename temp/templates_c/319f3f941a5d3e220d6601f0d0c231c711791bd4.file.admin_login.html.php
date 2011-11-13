<?php /* Smarty version Smarty-3.1.3, created on 2011-10-16 21:33:10
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_login.html" */ ?>
<?php /*%%SmartyHeaderCode:3082060574e9b15564b6fa2-93086847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '319f3f941a5d3e220d6601f0d0c231c711791bd4' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/admin_login.html',
      1 => 1318785914,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3082060574e9b15564b6fa2-93086847',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'password_wrong' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9b15565936e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9b15565936e')) {function content_4e9b15565936e($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<div class="news">
	<h1><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</h1>
	<?php if ($_smarty_tpl->tpl_vars['password_wrong']->value){?><p>Введённый пароль неверен!</p><?php }?>
	<p>Введите пароль для доступа:</p>
	<form action="../admin/" method="post">
		<label for="adminpass">Пароль:</label>
		<input type="password" value="" name="adminpass" id="adminpass" />
	</form>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>