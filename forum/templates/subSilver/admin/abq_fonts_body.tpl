<p align="center" class="gensmall">
&#91;<a href="{U_MENU_CONFIG}" title="{L_MENU_CONFIG}">{L_MENU_CONFIG}</a>&#93; 
&#91;<a href="{U_MENU_CONFIG2}" title="{L_MENU_CONFIG2}">{L_MENU_CONFIG2}</a>&#93; 
&#91;<a href="{U_MENU_FONTS}" title="{L_MENU_FONTS}">{L_MENU_FONTS}</a>&#93; 
&#91;<a href="{U_MENU_RESET}" title="{L_MENU_RESET}">{L_MENU_RESET}</a>&#93;<br />
&#91;<a href="{U_MENU_AUTOQUESTIONS}" title="{L_MENU_AUTOQUESTIONS}">{L_MENU_AUTOQUESTIONS}</a>&#93; -
&#91;<a href="{U_MENU_INDIQUESTIONS}" title="{L_MENU_INDIQUESTIONS}">{L_MENU_INDIQUESTIONS}</a>&#93; 
&#91;<a href="{U_MENU_IIMAGES}" title="{L_MENU_IIMAGES}">{L_MENU_IIMAGES}</a>&#93; 
&#91;<a href="{U_MENU_INDIIMAGEQUESTIONS}" title="{L_MENU_INDIIMAGEQUESTIONS}">{L_MENU_INDIIMAGEQUESTIONS}</a>&#93;
</p>

<h1>{L_ABQ_TITLE}</h1>

<p>{L_ABQ_EXPLAIN}</p>

<form action="{U_ABQ_ACTION}" method="post">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catBottom" align="center" height="28" colspan="3"><input type="hidden" value="new" name="mode" /><input name="submit" type="submit" value="{L_UPLOAD_NEW_FONT}" class="liteoption" /></td>
	</tr>
	<tr>
		<th class="thCornerL">{L_ABQ_FONT}</th>
		<th class="thTop">{L_EXAMPLE}</th>
		<th class="thCornerR">{L_ACTION}</th>
	</tr>
	<!-- BEGIN switch_font_missing -->
	<tr>
		<td class="row1" colspan="3" align="center">{L_ABQ_FONT_MISSING}</td>
	</tr>
	<!-- END switch_font_missing -->
	<!-- BEGIN switch_no_fonts -->
	<tr>
		<td class="row1" colspan="3" align="center">{L_ABQ_NO_FONTS}</td>
	</tr>
	<!-- END switch_no_fonts -->
	<!-- BEGIN fonts -->
	<tr>
		<td class="{fonts.COLOR}" width="80%"><span class="gen">{fonts.FONT}</span></td>
		<td class="{fonts.COLOR}" width="10%" align="center"><span class="genmed"><a href="{fonts.U_EXAMPLE_ACTION}" title="{L_EXAMPLE}">{L_EXAMPLE}</a></span></td>
		<td class="{fonts.COLOR}" width="10%" align="center"><span class="genmed">{fonts.U_DELETE_ACTION}</span></td>
	</tr>
	<!-- END fonts -->
	<tr>
		<td class="catBottom" align="center" height="28" colspan="3"><input name="submit" type="submit" value="{L_UPLOAD_NEW_FONT}" class="liteoption" /></td>
	</tr>
</table>
</form>
<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright"><a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">Anti Bot Question MOD</a> {L_ABQ_VERSION} &copy; 2005-2007 <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">MagMo</a></div>
