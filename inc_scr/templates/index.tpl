<HTML>
<HEAD>
	<title>{$title|default:"КОРСАРЫ :: туристическая организация"}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<meta name="author" content="Зволинский Алексей" />
	<meta name="generator" content="Hands" />
	<meta name="keywords" content="корсары,корсар,корсарам,corsars,korsars,туризм,альпинизм,скалалазанье,korsari,corsari" />
	<meta name="description" content="Туристический сайт киевской туристической групы Корсары" />
	<meta name="robots" content="index, follow" />
	<link rel="stylesheet" href="http://{$smarty.server.SERVER_NAME}/include/main.css" type="text/css" />
</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
		<div align="center">
			<TABLE BORDER=1 CELLPADDING=0 CELLSPACING=0 id="MainTable">
				<TR height="128">
					<td width="25" valign="bottom" height="128"><IMG SRC="images/triangle02u.gif" WIDTH=25 ALT="Левый угол"></td>
					<TD COLSPAN=2 bgcolor="#666699" HEIGHT=128><IMG SRC="images/triangle01.gif" WIDTH=192 HEIGHT=164 ALT="Верхний угол"></TD>
					<TD COLSPAN=2 bgcolor="#666699" height="128">
						<div id="Header">
						<table width="100%">
							<tr><td align="right"><img src="images/texts_06.jpg" alt="" width="396" height="24" border="0"></td></tr>
							<tr><td align="center"><img src="images/korsars.jpg" alt="" width="476" height="75" border="0"></td></tr>
							<tr><td align="left"><img src="images/texts_03.jpg" alt="" width="387" height="21" border="0"></td></tr>
						</table>
						</div>
					</TD>
				</TR>
				<TR>
					<TD rowspan="5" WIDTH=25 valign="top"><IMG SRC="images/triangle02d.gif" WIDTH=25 height="44" ALT="Левый угол(низ)"></TD>
					<TD rowspan="3" bgcolor="#9999cc" valign="top" width="186"><IMG SRC="images/triangle03.gif" WIDTH=154 HEIGHT=99 ALT="Низ треугольника"></TD>
					<TD bgcolor="#ddddee" WIDTH=38 valign="top"><IMG SRC="images/triangle04.gif" WIDTH=38 HEIGHT=34 ALT="Правый угол"></TD>
					<TD bgcolor="#9999cc" width="10"></TD>
					<TD bgcolor="#9999cc" width="502"></TD>
				</TR>
				<tr>
					<td rowspan="3" colspan="2" bgcolor="#ddddee" valign="top" width="542">
							{if $ContentText!=''}
								{$ContentText}
							{elseif $ContentTemplate!=''}
								{include file="$ContentTemplate"}
							{else}
								{include file="InWork.tpl"}
							{/if}
						</td>
					<td bgcolor="#9999cc" width="10"></td>
				</tr>
				<TR>
					<td bgcolor="#9999cc" width="10"></td>
				</TR>
				<TR>
					<td bgcolor="#666699" width="154"><font color="black">{$MainDetailedMenu}</font>
						<div id="MainDetailedMenu"></div>
						<div id="ForumUser">
							<font color="black">{include_php file=&quot;inc_scr/forum_user.php&quot;</font><font color="#e2e2e2">}</font></div>
					</td>
					<td bgcolor="#9999cc" width="10"></td>
				</TR>
				<TR>
					<td colspan="3" valign="bottom" align="center" bgcolor="#9999cc"> 
						<table width="100%" cellspacing="2" cellpadding="0">
							<tr>
								<td>
									<div align="right" id="copyright">
										Все права защищены законом, а если кому не нравиться, то якорь Вам в зад.<br>
										Если Вы решили украсть информацию с сайта, то не забудьте указать откуда свиснул, ибо Посейдон накажет тебя.
									</div>
								</td>
								<td align="right">
									<img src="images/anchor.jpg" alt="" height="79" width="100" border="0">
								</td>
							</tr>
						</table>
					</td>
					<td bgcolor="#9999cc" width="10"></td>
				</TR>
			</TABLE>
		</div>
	</BODY>
</HTML>