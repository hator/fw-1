<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	
<style>
#debug_data table { margin: 10px; border: 1px solid #DCDCDC; border-width: 1px 0 0 1px; border-radius: 2px; border-spacing: 0; }
#debug_data table td { border: 1px solid #DCDCDC; padding: 8px; border-width: 0 1px 1px 0; font: 13px Arial; color: #444; }
#debug_data thead td { font-weight: bold; background: #F3F3F3; }
</style>
	
</head>
<body>

<h1>Witam w aplikacji testowej Frameworku! Jak na razie wszystko działa poprawnie</h1>

<ul>
	<li><a href="<?=Request::createURL(array('home'))?>">HomeCommand</a></li>
	<li><a href="<?=Request::createURL(array('contact'))?>">ContactCommand</a></li>
</ul>