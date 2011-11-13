<?php /* Smarty version Smarty-3.1.3, created on 2011-10-09 15:02:47
         compiled from "/var/www/fladex/data/www/forumcatalog.ru/temp/templates/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:2572353444e904330873064-75378495%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bb6238dcfca12b10b0cb48803c075ddd4450439' => 
    array (
      0 => '/var/www/fladex/data/www/forumcatalog.ru/temp/templates/footer.html',
      1 => 1318158038,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2572353444e904330873064-75378495',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.3',
  'unifunc' => 'content_4e904330904e5',
  'variables' => 
  array (
    'recent_forums' => 0,
    'forum' => 0,
    'sape_links' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4e904330904e5')) {function content_4e904330904e5($_smarty_tpl) {?>					</div>
				</div>
			</div>
			<div class="side">
				<div class="box tbox">
					<div class="box_top">
						<div class="box_bottom">
							<h3><!--Последние добавленные--></h3>
							<div class="lastadded">
								<ul>
                                                                        <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recent_forums']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
                                                                            <li><a href="../forum<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['forum']->value['title'];?>
</a></li>
                                                                        <?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="box bbox">
					<div class="box_top">
						<div class="box_bottom">
							<h3><!--Реклама--></h3>
							<div class="counters">
								<a href="http://forumadmins.ru/?r=2" rel="nofollow"><img src="http://forumadmins.ru/images/b/88_31.gif" alt="Форум про форумы" /></a>
								<a href="http://forummap.ru/" rel="nofollow"><img src="http://forummap.ru/media/88_31.png" alt="Сервис генерации sitemap для форумов" /></a>
								<br><br>
								<a href="http://forumstat.ru/" rel="nofollow"><img src="http://forumstat.ru/images/b88-31.gif" alt="Сервис сбора статистики с форумов" /></a>
								<!--LiveInternet counter--><script type="text/javascript"><!--
								document.write("<a href='http://www.liveinternet.ru/click' rel='nofollow' "+
								"target=_blank><img src='http://counter.yadro.ru/hit?t57.11;r"+
								escape(document.referrer)+((typeof(screen)=="undefined")?"":
								";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
								screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
								";"+Math.random()+
								"' alt='' title='LiveInternet' "+
								"border='0' width='88' height='31'><\/a>")
								//--></script><!--/LiveInternet-->
							</div>
							<div class="adv">
								<ul>
									<li>
										<?php echo $_smarty_tpl->tpl_vars['sape_links']->value;?>

									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div class="footer">
	<div class="inner">
		<span>Дизайн от Sentro Internet Technology</span>
		Самый специализированный белый каталог форумов в рунете.<br /> &copy; 2009&ndash;2011 &laquo;Форум&nbsp;Студио&raquo;
	</div>
</div>

</body>
</html><?php }} ?>