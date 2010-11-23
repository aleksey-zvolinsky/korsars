<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>{$title|default:'Админ-панель'}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<meta name="author" content="Зволинский Алексей" />
	<meta name="generator" content="Hands" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="noindex, nofollow" />
	<link rel="stylesheet" href="http://{$smarty.server.SERVER_NAME}/EditMain.css" type="text/css" />
	<link rel="stylesheet" href="http://{$smarty.server.SERVER_NAME}/main.css" type="text/css" />
	<script language="javascript" type="text/javascript" src="http://{$smarty.server.SERVER_NAME}/jscripts/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" type="text/javascript" src="http://{$smarty.server.SERVER_NAME}/jscripts/init_tiny_mce.js"></script>
</head>
<body>
<div align="center">
<table id="maintable" CELLPADDING="0" CELLSPACING="0" width="100%">
<tr>
	<td width="100px" valign="top">
		<table width="100%">
		<tr>
			<td>
				<img src="http://{$smarty.server.SERVER_NAME}/images/inceram_logo.jpg" width="246" height="125">
			</td>
		</tr>
		</table>
		<div id="leftmenu">
		<table width="100%">
        {foreach from=$Panels item=Panel}
        <tr>
        	<td align="center">
				<a href="?mod={$Panel.Name}&sid={$sid}">{$Panel.Title}</a>
			</td>
		</tr>
		{/foreach}
		</table>
		</div>
	</td>
	<td>
		<h3 style="padding-top:10px; padding-bottom:10px;">{$title|default:'Админ-панель'}</h3>
		<div id="Panel">
				{if $ContentText!=''}
					{$ContentText}
				{elseif $ContentTemplate!=''}
					{include file="$ContentTemplate"}
				{else}
					{include file="InWork.tpl"}
				{/if}
		</div>
	</td>
</tr>
</table>
</div>
</body>

</html>