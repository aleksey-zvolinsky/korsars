<?xml version="1.0" encoding="windows-1251"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>{$title|default:"������� - [������������� �����������]"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<meta name="author" content="���������� �������" />
	<meta name="generator" content="Hands" />
	<meta name="keywords" content="�������,������,��������,corsars,korsars,������,���������,������������,korsari,corsari" />
	<meta name="description" content="������������� ���� �������� ������������� ����� �������" />
	<meta name="robots" content="index, follow" />
	<link rel="stylesheet" href="http://{$smarty.server.SERVER_NAME}/include/main.css" type="text/css" />
</head>
<body>
<table class="main">
	<tr>
		<td>
			<table width="100%">
			<tr>
				<td width="15%">
				</td>
				<td width="70%">
					<h1><font color="#6666cc">www.korsars.kiev.ua</font></h1>
				</td>
				<td align="right" width="15%">
					{include_php file="inc_scr/forum_user.php"}
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr height="500%">
		<td>
		{if $title_page!=''}
			<h2>{$title_page}</h2><br>
		{/if}
		<table width="100%">
		<tr>
			<td valign="top">
			<div id="MainDetailedMenu">
				{$MainDetailedMenu}
			</div>
			</td>
			<td valign="top" id="content_cell">
			<!--�������-->
				{if $ContentText!=''}
					{$ContentText}
				{elseif $ContentTemplate!=''}
					{include file="$ContentTemplate"}
				{else}
					{include file="InWork.tpl"}
				{/if}
	    	</td>
    	</tr>
    	</table>
    	</td>
	</tr>
	<tr>
		<td>
			<hr />
			<center>
			<div id='MainMenu'>
            	{$MainMenu}
            </div>
			</center>
			<hr />
			<p class="copy">��� ����� �������� �������, � ���� ���� �� ���������, �� ����� ��� � ���.<br />
			���� �� ������ ������� ���������� � �����, �� �� �������� ������� ������ �������, ��� �������� ������� ����.
			</p>
		</td>
    </tr>
</table>

</body>

</html>