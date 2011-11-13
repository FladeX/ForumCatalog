<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 15:32:20
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/refusal.html" */ ?>
<?php /*%%SmartyHeaderCode:18494867934e9053b1b9a976-43860971%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60efb7850d3d832169af4a2fcff9dd2d43fdf62f' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/refusal.html',
      1 => 1318156884,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18494867934e9053b1b9a976-43860971',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9053b1e1d1d',
  'variables' => 
  array (
    'title' => 0,
    'refusal_forums' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9053b1e1d1d')) {function content_4e9053b1e1d1d($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                    <div class="news">
                                           <h1>Непрошедшие модерацию</h1>
                                           <div class="item">
                                           <table width="100%" cellspacing="0" border="0" class="viewforum">
                                           <tr>
                                                   <th width="49%">Форум</th>
                                                   <th width="49%">Причина отказа</th>
                                           </tr>
                                            <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['refusal_forums']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['forum']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['forum']['iteration']++;
?>
                                                <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['forum']['iteration']%2==1){?>
                                                    <tr class="row1">
                                                <?php }else{ ?>
                                                    <tr class="row2">
                                                <?php }?>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</td>
                                                    <td><?php echo $_smarty_tpl->tpl_vars['forum']->value['refusal'];?>
</td>
                                                </tr>
                                            <?php } ?>
                                           </table>
                                           </div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>