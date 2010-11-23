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

<!-- BEGIN switch_delete -->
<form action="{U_DELETE_ACTION}" method="post">
<!-- END switch_delete -->
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<th class="thCornerL" width="50%">{L_ABQ_FONT}</th>
		<th class="thTop" width="50%" align="center">{L_ACTION}</th>
	</tr>
	<!-- BEGIN switch_unknown_font -->
	<tr>
		<td class="row1" colspan="2" align="center"><span class="gen">{L_ABQ_UNKNOWN_FONT}</span></td>
	</tr>
	<!-- END switch_unknown_font -->
	<!-- BEGIN switch_dont_delete_font -->
	<tr>
		<td class="row1" colspan="2" align="center"><span class="gen">{L_ABQ_DONT_DELETE_FONT}</span></td>
	</tr>
	<!-- END switch_dont_delete_font -->
	<!-- BEGIN switch_delete -->
	<tr>
		<td class="row1"><span class="gen">{FONT}<input type="hidden" name="name" value="{FONT}" /></span></td>
		<td class="row1"><input type="hidden" value="delete" name="mode" /><input type="hidden" name="id" value="{S_FONTID}" /><input name="submit" type="submit" value="{L_DELETE}" class="mainoption" /></td>
	</tr>
	<tr>
		<td class="row2" colspan="2" align="center"><span class="gen">{L_ABQ_EXPLAIN2}</span></td>
	</tr>
	<!-- END switch_delete -->
	<tr>
		<td class="catBottom" align="center" height="28" colspan="2">&#160;</td>
	</tr>
</table>
<!-- BEGIN switch_delete -->
</form>
<!-- END switch_delete -->
<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright"><a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">Anti Bot Question MOD</a> {L_ABQ_VERSION} &copy; 2005-2007 <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">MagMo</a></div>
