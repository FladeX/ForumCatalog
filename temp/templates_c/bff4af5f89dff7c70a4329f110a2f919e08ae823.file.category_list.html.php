<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 13:22:27
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/category_list.html" */ ?>
<?php /*%%SmartyHeaderCode:12316085994e9071b3b2d018-30561434%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bff4af5f89dff7c70a4329f110a2f919e08ae823' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/category_list.html',
      1 => 1318152144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12316085994e9071b3b2d018-30561434',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9071b3bcf61',
  'variables' => 
  array (
    'title' => 0,
    'categories' => 0,
    'category' => 0,
    'child_category' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9071b3bcf61')) {function content_4e9071b3bcf61($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                    <div class="forumslist">
                                   <ul>
                                        <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
                                            <li><h2><a href="category<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
</a></h2>
                                                <?php  $_smarty_tpl->tpl_vars['child_category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['child_category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child_category']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child_category']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['child_category']->key => $_smarty_tpl->tpl_vars['child_category']->value){
$_smarty_tpl->tpl_vars['child_category']->_loop = true;
 $_smarty_tpl->tpl_vars['child_category']->iteration++;
 $_smarty_tpl->tpl_vars['child_category']->last = $_smarty_tpl->tpl_vars['child_category']->iteration === $_smarty_tpl->tpl_vars['child_category']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['child_category']['last'] = $_smarty_tpl->tpl_vars['child_category']->last;
?>
                                                    <a href="category<?php echo $_smarty_tpl->tpl_vars['child_category']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['child_category']->value['title'];?>
</a><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['child_category']['last']){?>. <?php }else{ ?>, <?php }?>
                                                <?php }
if (!$_smarty_tpl->tpl_vars['child_category']->_loop) {
?>
                                                    нет вложенных категорий
                                                <?php } ?>
                                            </li>
                                        <?php }
if (!$_smarty_tpl->tpl_vars['category']->_loop) {
?>
                                            нет категорий
                                        <?php } ?>
                                   </ul>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>