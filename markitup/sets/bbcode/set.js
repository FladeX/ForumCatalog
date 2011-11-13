// ----------------------------------------------------------------------------
// markItUp!
// ----------------------------------------------------------------------------
// Copyright (C) 2008 Jay Salvat
// http://markitup.jaysalvat.com/
// ----------------------------------------------------------------------------
// BBCode tags example
// http://en.wikipedia.org/wiki/Bbcode
// ----------------------------------------------------------------------------
// Feel free to add more tags
// ----------------------------------------------------------------------------
mySettings = {
	previewParserPath:	'', // path to your BBCode parser
	markupSet: [
		{name:'Полужирный текст', key:'B', openWith:'[b]', closeWith:'[/b]'},
		{name:'Наклонный текст', key:'I', openWith:'[i]', closeWith:'[/i]'},
		{name:'Подчёркнутый текст', key:'U', openWith:'[u]', closeWith:'[/u]'},
		{	name:'Цвет текста', 
			className:'colors', 
			openWith:'[color=[![Цвет]!]]', 
			closeWith:'[/color]', 
				dropMenu: [
					{name:'Жёлтый',		openWith:'[color=yellow]', 	closeWith:'[/color]', className:"col1-1" },
					{name:'Оранжевый',	openWith:'[color=orange]', 	closeWith:'[/color]', className:"col1-2" },
					{name:'Красный', 	openWith:'[color=red]', 	closeWith:'[/color]', className:"col1-3" },
					
					{name:'Синий', 		openWith:'[color=blue]', 	closeWith:'[/color]', className:"col2-1" },
					{name:'Фиолетовый', openWith:'[color=purple]', 	closeWith:'[/color]', className:"col2-2" },
					{name:'Зелёный', 	openWith:'[color=green]', 	closeWith:'[/color]', className:"col2-3" },
					
					{name:'Белый', 		openWith:'[color=white]', 	closeWith:'[/color]', className:"col3-1" },
					{name:'Серый', 		openWith:'[color=gray]', 	closeWith:'[/color]', className:"col3-2" },
					{name:'Чёрный',		openWith:'[color=black]', 	closeWith:'[/color]', className:"col3-3" }
				]
		},
		{separator:'---------------' },
		{name:'Маркированный список', openWith:'[list]\n', closeWith:'\n[/list]'},
		{name:'Нумерованный список', openWith:'[list=[![Начальный номер]!]]\n', closeWith:'\n[/list]'}, 
		{name:'Элемент списка', openWith:'[*] '},
		{separator:'---------------' },
		{name:'Цитата', openWith:'[quote]', closeWith:'[/quote]'},
		{name:'Код', openWith:'[code]', closeWith:'[/code]'}
	]
}