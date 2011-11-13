<?php
/**
* project: ForumCatalog
* version: 2.0
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: search.php
* last update: 2011.10.02
**/
include('functions.php');
include('classes/Forum.php');
catalog_header('Поиск');
?>

<?php
$sSearch_text = (isset($_REQUEST['find']) && strlen($_REQUEST['find']) > 2) ? htmlspecialchars($_REQUEST['find']) : '';
?>
					<div class="news">
						<h1>Поиск</h1>
							<div class="item">
								<p>На этой странице вы можете воспользоваться поиском по сайту. Для этого введите искомый запрос в текстовое поле, расположенное ниже и нажмите кнопку &laquo;Искать&raquo;. В результате будет осществлён поиск по всем страницам каталога форумов. Результат поиска будет выведен ниже.</p>
							</div>
							<div class="item">
								<!-- Поиск. Начало. -->
								<div>
									<form method="post" action="" onsubmit="javascript:Search_onsubmit(1); return false;">
										<div>
											<input type="text" id="search_text" value="<?php echo $sSearch_text; ?>" maxlength="100" size="50" />
											<input type="submit" id="search_submit" value="Искать" />
										</div>
									</form>
									<noscript>Для работы поиска включите в браузере JavaScript.</noscript>
									<div class="search_div" id="search_div"></div>
									<script type="text/javascript">
										<!--
										document.onkeydown = L_page_onkeydown;
										<?php
											if (!empty($sSearch_text)) echo 'Search_onsubmit(1)' . "\n";
										?>
										//-->
									</script>
								</div>
								<!-- Поиск. Конец. -->
							</div>
<?php
include('temp/footer.tpl');
?>