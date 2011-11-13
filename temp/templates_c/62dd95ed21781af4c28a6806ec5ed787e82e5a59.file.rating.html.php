<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 14:55:43
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/rating.html" */ ?>
<?php /*%%SmartyHeaderCode:14551736114e9059094035a5-08919934%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62dd95ed21781af4c28a6806ec5ed787e82e5a59' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/rating.html',
      1 => 1318157698,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14551736114e9059094035a5-08919934',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e9059094bc28',
  'variables' => 
  array (
    'title' => 0,
    'top_forums' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e9059094bc28')) {function content_4e9059094bc28($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


                                    <div class="news">
                                           <h1>Рейтинг форумов</h1>
                                           <div class="item">
                                                   <p>Приведённый здесь <strong>рейтинг форумов</strong> &mdash; это подборка <?php echo $_smarty_tpl->tpl_vars['top_forums']->value['limit'];?>
 форумов из каталога, имеющих самый большой рейтинг. Каждый из размещённых в каталоге форумов характеризуется рейтингом, который ему присваивают посетители. Чем выше значение рейтинга &mdash; тем выше форум в этом рейтинге.</p>
                                                   <h2>Лучшие <?php echo $_smarty_tpl->tpl_vars['top_forums']->value['limit'];?>
</h2>
                                                   <ol>
                                                    <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['top_forums']->value['forum']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['forum']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['forum']['iteration']++;
?>
                                                        <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['forum']['iteration']%2==1){?>
                                                            <li class="row1">
                                                        <?php }else{ ?>
                                                            <li class="row2">
                                                        <?php }?>
                                                                <a href="http://forumcatalog.ru/forum<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</a> <span title="рейтинг форума">[&nbsp;<b style="color:green;"><?php echo $_smarty_tpl->tpl_vars['forum']->value['rating'];?>
</b>&nbsp;]</span>
                                                            </li>
                                                    <?php } ?>
                                           </ol>
                                           </div>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>