<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 15:07:47
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/forum_view.html" */ ?>
<?php /*%%SmartyHeaderCode:14304322364e906886df8b57-41956421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c10caf85e7c957693dc69e2bfa5d3ee66af1b2b2' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/forum_view.html',
      1 => 1318158464,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14304322364e906886df8b57-41956421',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e906886e6e37',
  'variables' => 
  array (
    'title' => 0,
    'forum' => 0,
    'rss' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e906886e6e37')) {function content_4e906886e6e37($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value), 0);?>


<?php if ($_smarty_tpl->tpl_vars['forum']->value['id']==0){?>
    <div class="news">
            <h1>404 &mdash; не найдено</h1>
                    <div class="item">
                            <p>Запрошенный форум отсутствует в каталоге</p>
                    </div>
<?php }else{ ?>
    <div class="forumdetails">
            <h1><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</h1>
            <div class="cbbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <div class="left">
                                            Адрес форума:
                                    </div>
                                    <div class="intext">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['forum']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</a>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                    </div>
            </div>
            <div class="cbbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <div class="left">
                                            Описание форума:
                                    </div>
                                    <div class="intext">
                                            <?php echo $_smarty_tpl->tpl_vars['forum']->value['description'];?>

                                    </div>
                                    <div class="clear"></div>
                            </div>
                    </div>
            </div>
            <div class="csbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <span>Тематика форума</span><br>
                                    <?php echo $_smarty_tpl->tpl_vars['forum']->value['category'];?>

                            </div>
                    </div>
            </div>
            <div class="csbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <span>Просмотры</span><br>
                                    <?php echo $_smarty_tpl->tpl_vars['forum']->value['views'];?>

                            </div>
                    </div>
            </div>
            <div class="csbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <span>Движок форума:</span><br>
                                    <?php echo $_smarty_tpl->tpl_vars['forum']->value['engine'];?>

                            </div>
                    </div>
            </div>
            <div class="csbox">
                    <div class="box_top">
                            <div class="box_bottom">
                                    <span>Год запуска</span><br>
                                    <?php echo $_smarty_tpl->tpl_vars['forum']->value['year'];?>

                            </div>
                    </div>
            </div>
            <div class="clear"></div>
            <div class="rating">
                    <span class="a" onclick="rating('<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
', 'minus')"><img src="../temp/images/rating_minus.jpg" alt="Уменьшить рейтинг форума"></span>
                    <?php if ($_smarty_tpl->tpl_vars['forum']->value['rating']>0){?>
                        <span class="number" id="number" style="color:#00bb00;"><?php echo $_smarty_tpl->tpl_vars['forum']->value['rating'];?>
</span>
                    <?php }elseif($_smarty_tpl->tpl_vars['forum']->value['rating']<0){?>
                        <span class="number" id="number" style="color:#bb0000;"><?php echo $_smarty_tpl->tpl_vars['forum']->value['rating'];?>
</span>
                    <?php }else{ ?>
                        <span class="number" id="number"><?php echo $_smarty_tpl->tpl_vars['forum']->value['rating'];?>
</span>
                    <?php }?>

                    <span class="a" onclick="rating('<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
', 'plus')"><img src="../temp/images/rating_plus.jpg" alt="Увеличить рейтинг форума"></span><br>
                    Рейтинг
                    <div id="rating_message"></div>
            </div>

            <?php if ($_smarty_tpl->tpl_vars['forum']->value['rss']){?>
                <h1>Лента новостей</h1>
                <?php if ($_smarty_tpl->tpl_vars['forum']->value['rss_error']){?>
                    <?php echo $_smarty_tpl->tpl_vars['forum']->value['rss_error'];?>

                <?php }else{ ?>
                    <?php  $_smarty_tpl->tpl_vars['rss'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rss']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forum']->value['rss_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rss']->key => $_smarty_tpl->tpl_vars['rss']->value){
$_smarty_tpl->tpl_vars['rss']->_loop = true;
?>
                        <div class="item">
                            <h4><img src="<?php echo $_smarty_tpl->tpl_vars['rss']->value['favicon'];?>
" alt="Favicon" class="favicon" />
                            <?php if ($_smarty_tpl->tpl_vars['rss']->value['permalink']){?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['rss']->value['permalink'];?>
"><?php echo $_smarty_tpl->tpl_vars['rss']->value['title'];?>
</a>
                            <?php }else{ ?>
                                <?php echo $_smarty_tpl->tpl_vars['rss']->value['title'];?>

                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['rss']->value['date'];?>
</h4>
                            <?php echo $_smarty_tpl->tpl_vars['rss']->value['content'];?>

                        </div>
                    <?php } ?>
                <?php }?>
            <?php }?>
<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>