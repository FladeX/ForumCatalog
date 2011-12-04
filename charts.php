<?php
/**
* project: ForumCatalog
* version: 2.1
* author: Max Istlyaev aka FladeX
* e-mail: FladeX@yandex.ru
* file: charts.php
* last update: 2011.12.04
**/
include('config.php');
include('db.php');
include('functions.php');
// Соединение с базой данных
$connection = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$connection)
{
	die("Невозможно подключиться к базе данных: <br />" . mysql_error());
}
// Выбор базы данных
$db_select = mysql_select_db($dbname);
if (!$db_select)
{
	die("Невозможно выбрать базу данных: <br />" . mysql_error());
}
mysql_query("SET character_set_client = 'utf8'");
mysql_query("SET character_set_connection = 'utf8'");
mysql_query("SET character_set_results = 'utf8'");
mysql_query("SET NAMES 'utf8'");
mysql_set_charset("utf8");

// Обнуление переменных
$phpbb2 = 0;
$phpbb3 = 0;
$ipb1 = 0;
$ipb2 = 0;
$ipb3 = 0;
$vb1 = 0;
$vb2 = 0;
$vb3 = 0;
$vb4 = 0;
$smf1 = 0;
$smf2 = 0;
$punbb = 0;
$dle = 0;
$exbb = 0;
$yabb = 0;
$year2011 = 0;
$year2010 = 0;
$year2009 = 0;
$year2008 = 0;
$year2007 = 0;
$year2006 = 0;
// Запрос всех форумов
$sql = "SELECT *
		FROM " . $dbprefix . "forums
		WHERE active = 1";
$result = mysql_query($sql);
if (!$result)
{
	die("Невозможно исполнить запрос к базе данных: <br />" . mysql_error());
}
// Вывод полученного результата
while ($result_row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	switch ($result_row['engine'])
	{
		case "phpbb2":
			$phpbb2 += 1;
			break;
		case "phpbb3":
			$phpbb3 += 1;
			break;
		case "ipb1":
			$ipb1 += 1;
			break;
		case "ipb2":
			$ipb2 += 1;
			break;
		case "ipb3":
			$ipb3 += 1;
			break;
		case "smf1":
			$smf1 += 1;
			break;
		case "smf2":
			$smf2 += 1;
			break;
		case "vb1":
			$vb1 += 1;
			break;
		case "vb2":
			$vb2 += 1;
			break;
		case "vb3":
			$vb3 += 1;
			break;
		case "vb4":
			$vb4 += 1;
			break;
		case "punbb":
			$punbb += 1;
			break;
		case "dle":
			$dle += 1;
			break;
		case "exbb":
			$exbb += 1;
			break;
		case "yabb":
			$yabb += 1;
			break;
		default:
			break;
	}
	switch ($result_row['year'])
	{
		case "2011":
			$year2011 += 1;
			break;
		case "2010":
			$year2010 += 1;
			break;
		case "2009":
			$year2009 += 1;
			break;
		case "2008":
			$year2008 += 1;
			break;
		case "2007":
			$year2007 += 1;
			break;
		default:
			$year2006 += 1;
			break;
	}
}


// pChart - классы для работы с графиками и диаграммами - http://pchart.sourceforge.net/
// Standard inclusions
include("classes/pData.class");
include("classes/pChart.class");
// Dataset definition
$DataSet = new pData;
//$DataSet->AddPoint(array(10,2,3,5,3),"Serie1");
$DataSet->AddPoint(array($phpbb2 + $phpbb3,$ipb1 + $ipb2 + $ipb3,$smf1 + $smf2,$vb1 + $vb2 + $vb3 + $vb4, $punbb),"Serie1");
//$DataSet->AddPoint(array("vBulletin","phpBB 2.x","phpBB 3.x","IPB 2.x","punBB"),"Serie2");
$DataSet->AddPoint(array("phpBB","IPB","SMF","vBulletin", "punBB"),"Serie2");
$DataSet->AddAllSeries();
$DataSet->SetAbsciseLabelSerie("Serie2");

// Initialise the graph
//$Test = new pChart(380,200);
$Test = new pChart(396,200);
//$Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);
$Test->drawFilledRoundedRectangle(7,7,403,193,5,240,240,240);
//$Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);
$Test->drawRoundedRectangle(5,5,395,195,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(310,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

$Test->Render("images/temp/example10.png");

// Dataset definition
$DataSet = new pData;
//$DataSet->AddPoint(array(10,2,3,5,3),"Serie1");
$DataSet->AddPoint(array($year2011, $year2010,$year2009,$year2008,$year2007,$year2006),"Serie1");
//$DataSet->AddPoint(array("vBulletin","phpBB 2.x","phpBB 3.x","IPB 2.x","punBB"),"Serie2");
$DataSet->AddPoint(array("2011", "2010","2009","2008","2007","< 2006"),"Serie2");
$DataSet->AddAllSeries();
$DataSet->SetAbsciseLabelSerie("Serie2");

// Initialise the graph
//$Test = new pChart(380,200);
$Test = new pChart(396,200);
//$Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);
$Test->drawFilledRoundedRectangle(7,7,403,193,5,240,240,240);
//$Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);
$Test->drawRoundedRectangle(5,5,395,195,5,230,230,230);

// Draw the pie chart
$Test->setFontProperties("fonts/tahoma.ttf",8);
$Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);
$Test->drawPieLegend(310,15,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);

$Test->Render("images/temp/years.png");

// Закрытие соединения с mysql
mysql_close($connection);
?>