$(document).ready( function() {	var SFl = $('.selectfield').get().length;	$('.selectfield').each( function(ind) {		$(this).css('z-index', SFl-ind);	});	if ($.browser.msie && $.browser.version.substr(0,1)<7) {		$('.selectfield .options div').hover(		function() {			$(this).addClass('hover');		},		function() {			$(this).removeClass('hover');		});		$('.selectfield .options').each( function(ind) {			if($(this).height() > 200 ) {				$(this).height(200);			}		});	}	$('.selectfield .inner').each( function(ind) {		$(this).text(			( ( $(this).parent().children('.options').children('.selected').text() == "" )			? $(this).parent().children('.options').children(':first').addClass('selected').text()			: $(this).parent().children('.options').children('.selected').text() )		);        $(this).parent().children('input').val(           $(this).parent().children('.options').children('.selected').children('input').val()        );	});	$('.selectfield .inner').click( function() {		$(this).parent().children('.options').animate( {			height: 'toggle'		}, 300 );	});	$('.selectfield .options div').click( function() {		$(this).parent().children('div.selected').removeClass('selected');		$(this).addClass('selected');        $(this).parent().parent().children('.inner').text(        	$(this).text()        );        $(this).parent().parent().children('input').val(            $(this).children('input').val()        );		$(this).parent().animate( {			height: 'toggle'		}, 500 );	});});function getXmlHttp(){	var xmlhttp;	try	{		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");	}	catch (e)	{		try		{			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");		}		catch (E)		{			xmlhttp = false;		}	}	if (!xmlhttp && typeof XMLHttpRequest!='undefined')	{		xmlhttp = new XMLHttpRequest();	}	return xmlhttp;}// javascript-код голосования из примераfunction rating(id, plusminus){	// (1) создать объект для запроса к серверу	var req = getXmlHttp()	// (2)	// span рядом с кнопкой	// в нем будем отображать ход выполнения	var statusElem = document.getElementById('number');	req.onreadystatechange = function()	{		// onreadystatechange активируется при получении ответа сервера		if (req.readyState == 4)		{			// если запрос закончил выполняться			//statusElem.innerHTML = req.statusText // показать статус (Not Found, ОК..)			if(req.status == 200)			{				statusElem.innerHTML = req.responseText;			}		}	}	var params = 'id=' + encodeURIComponent(id) + '&type=' + encodeURIComponent(plusminus);	// (3) задать адрес подключения	req.open('POST', '../ratethis.php', true);	req.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')	// объект запроса подготовлен: указан адрес и создана функция onreadystatechange	// для обработки ответа сервера	// (4)	req.send(params);  // отослать запрос	// (5)	//statusElem.innerHTML = 'Ожидаю ответа сервера...'	//statusElem.innerHTML = req.responseText;}