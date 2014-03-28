<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Ваше название</title>
	<meta http-equiv="content-type" content="text/html; charset=windows-1251" />
	<style type="text/css">
body {
	padding: 0px;
	margin: 0px;
	background-color: #f0f5f6;
	font-family: Tahoma, Arial, sans-serif;
	color: #424242;
	font-size: 11px;
	line-height: 18px;
}

h1 {
	font-family: Tahoma, Arial, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #799fa9;
	border-bottom: 1px solid #799fa9;
	text-transform: uppercase;
}

a:link, a:visited, a:active {
	text-decoration: none;
	color: #406975;
	border-bottom: 1px dashed #406975;
}

a:hover {
	text-decoration: none;
	color: #406975;
	border-bottom: 0px;
}

#wrapper { 
	margin: 0 auto;
	width: 750px;
	background-color: #d0e2e6;
	text-align: justify;
	font-family: Tahoma, Arial, sans-serif;
	color: #424242;
	font-size: 11px;
	line-height: 18px;
	letter-spacing: 1px;
}

#header {
	height: 70px;
	background-color: #adcad2;
	text-align: center;
}

#box {
	width: 220px;
	padding: 11px;
	float: left;
	background-color: #e0ebee;
}

#content {
	width: 485px;
	padding: 11px;
	float: right;
}

#footer {
	padding: 5px;
	height: 40px;
	background-color: #adcad2;
	clear: both;
	text-align: center;
}
	</style>
</head>

<body>
		<div id="wrapper">
	<div id="header">
<!-- здесь будет ваш логотип -->
<br />
	</div>

<!-- левая колонка -->
	<div id="box">
	<?php
	echo $region_leftsidebar;
	/*
<h1>Заголовок</h1>
Curabitur erat orci, adipiscing vel, scelerisque eget, suscipit ac, erat. Etiam facilisis. Quisque commodo. In consectetur sem sit amet felis. Donec sagittis ligula eget lorem. Donec dapibus lacus in quam. In hac habitasse platea dictumst. Donec pretium. Cras sit amet orci. Nulla facilisi. Donec tempor. Pellentesque malesuada.
<br /><br />

<h1>Заголовок</h1>
Curabitur erat orci, adipiscing vel, scelerisque eget, suscipit ac, erat. Etiam facilisis. Quisque commodo. In consectetur sem sit amet felis. Donec sagittis ligula eget lorem. Donec dapibus lacus in quam. In hac habitasse platea dictumst. Donec pretium. Cras sit amet orci. Nulla facilisi. Donec tempor. Pellentesque malesuada.
<br /><br />*/
?>
	</div>

<!-- содержание сайта -->
	<div id="content">
	<?php
	echo $region_content;
/*
<h1>Правила</h1>
1. Запрещается убирать кредит (ссылку на сайт <a href="http://monsterart.ru/">www.monsterart.ru</a>).
<br />
2. Вы можете изменять шаблон: цвет блоков, текста, ссылок, заголовки и т.д., но даже в этом случае вы обязаны оставить ссылку на <a href="http://monsterart.ru/">мой сайт</a> на главной странице!
<br />
3. Запрещается выкладывать шаблон на свой сайт для скачивания.
<br /><br />
Vestibulum feugiat magna sed ligula. Nam malesuada ante blandit nunc. Cras venenatis eros non nibh. Morbi eros. Cras tempus, odio quis ultrices scelerisque, pede nulla dignissim risus, vel placerat lacus leo ut orci. Donec tincidunt commodo lorem. Nulla lacus magna, ultricies quis, vulputate sed, mollis in, augue. Sed sagittis placerat lacus. Curabitur ultricies volutpat risus. Donec volutpat euismod odio. Ut vel erat. Nullam interdum vehicula neque. Integer lectus purus, rutrum vel, commodo sed, adipiscing id, ligula. Proin tempus lectus ac turpis. Sed venenatis felis id tortor.
<br /><br />
Ut leo leo, pulvinar sed, ornare accumsan, commodo id, pede. Sed lacinia. Suspendisse congue tincidunt est. Donec viverra hendrerit libero. Nunc quam leo, vestibulum eget, scelerisque nec, dignissim non, tellus. Aenean pede. Proin placerat quam vitae massa. Aliquam erat volutpat. Quisque diam orci, ullamcorper eu, elementum semper, blandit sed, nunc. Vivamus ligula libero, hendrerit nec, congue nec, iaculis vel, neque. Suspendisse lobortis erat sit amet justo.
*/?>	</div>

<!-- нижняя часть шаблона -->
	<div id="footer">
	<?php
	echo $region_footer;
	/*
2010 &copy; Название и адрес вашего сайта
<br />Код шаблона: <a href="http://monsterart.ru/" target="_blank">Monster Art</a>*/
?>
	</div>
		</div>
</body>
</html>