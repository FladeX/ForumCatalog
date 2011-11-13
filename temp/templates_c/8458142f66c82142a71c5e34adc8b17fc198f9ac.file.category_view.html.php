<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 14:26:02
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/category_view.html" */ ?>
<?php /*%%SmartyHeaderCode:8935264124e9171901d34e8-01296664%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8458142f66c82142a71c5e34adc8b17fc198f9ac' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/category_view.html',
      1 => 1318155827,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8935264124e9171901d34e8-01296664',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e917190297fa',
  'variables' => 
  array (
    'title' => 0,
    'category' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e917190297fa')) {function content_4e917190297fa($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                    <div class="news">
                                            <?php if ($_smarty_tpl->tpl_vars['category']->value['id']==0){?>
                                                <h1>Категория не найдена</h1>
                                                <p>Запрошенной вами категории не существует.</p>
                                            <?php }else{ ?>
                                                <h1>Просмотр категории &laquo;<?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
&raquo;</h1>
                                                <?php if ($_smarty_tpl->tpl_vars['category']->value['forums_count']>0){?>
                                                <ul>
                                                <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['forums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
                                                    <li><a href="../forum<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</a></li>
                                                <?php } ?>
                                                </ul>
                                                <?php if ($_smarty_tpl->tpl_vars['category']->value['forums_count']==1){?>
                                                    <p>Всего в категории <b><?php echo $_smarty_tpl->tpl_vars['category']->value['forums_count'];?>
</b> форум.</p>
                                                <?php }elseif($_smarty_tpl->tpl_vars['category']->value['forums_count']<=4){?>
                                                    <p>Всего в категории <b><?php echo $_smarty_tpl->tpl_vars['category']->value['forums_count'];?>
</b> форума.</p>
                                                <?php }elseif(($_smarty_tpl->tpl_vars['category']->value['forums_count']>20)||(($_smarty_tpl->tpl_vars['category']->value['forums_count']%10)==2)){?>
                                                    <p>Всего в категории <b><?php echo $_smarty_tpl->tpl_vars['category']->value['forums_count'];?>
</b> форума.</p>
                                                <?php }else{ ?>
                                                    <p>Всего в категории <b><?php echo $_smarty_tpl->tpl_vars['category']->value['forums_count'];?>
</b> форумов.</p>
                                                <?php }?>
                                                <?php }else{ ?>
                                                    <p>Нет форумов в этой категории.</p>
                                                <?php }?>
                                            <?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>