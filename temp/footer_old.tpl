</div>
</div>

<div class="contentright">
<h2>Последнее:</h2>
<div class="contentrightbox">
	<ul style="list-style-type:none;">
		<?php
			include('recent.php');
		?>
	</ul>
</div>

<h2>Баннеры:</h2>
<div class="contentrightbox">
	<div style="text-align:center;">
		<noindex>
			<a href="http://forumadmins.ru/?r=2" rel="nofollow"><img src="http://forumadmins.ru/images/b/88_31.gif" alt="Форум про форумы" /></a>
			<a href="http://forummap.ru/" rel="nofollow"><img src="http://forummap.ru/media/88_31.png" alt="Сервис генерации sitemap для форумов" /></a>
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
		</noindex>
		<?php
			if (isset($sape))
			{
				echo "<br />" . $sape->return_links();
			}
		?>
	</div>
</div>
</div>

</div>
<div style="clear: both;"> </div>
</div>


<div id="footer">
&copy; 2009—2010 Forum Studio. | Design by <a href="http://www.minimalistic-design.net">Minimalistic Design</a>
</div>



</div>
</body>
</html>