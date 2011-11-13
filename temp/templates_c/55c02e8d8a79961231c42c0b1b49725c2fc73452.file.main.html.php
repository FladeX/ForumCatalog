<?php /* Smarty version Smarty-3.1.3, created on 2011-10-08 19:12:35
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/main.html" */ ?>
<?php /*%%SmartyHeaderCode:11002507894e905b740a6156-94900940%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55c02e8d8a79961231c42c0b1b49725c2fc73452' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/main.html',
      1 => 1318086592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11002507894e905b740a6156-94900940',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e905b7415e6c',
  'variables' => 
  array (
    'title' => 0,
    'mode' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e905b7415e6c')) {function content_4e905b7415e6c($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<?php if ($_smarty_tpl->tpl_vars['mode']->value=='view'){?>
    <?php echo $_smarty_tpl->getSubTemplate ("forum_view.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>

<?php }else{ ?>
    <?php echo $_smarty_tpl->tpl_vars['content']->value;?>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>