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
		<td class="catBottom" align="center" height="28" colspan="3"><input type="hidden" value="new" name="mode" /><input name="submit" type="submit" value="{L_UPLOAD_NEW_IMAGE}" class="liteoption" /></td>
	</tr>
	<tr>
		<th class="thCornerL" width="70%">{L_ABQ_IMAGE}</th>
		<th class="thTop" colspan="2" width="30%">{L_ACTION}</th>
	</tr>
	<!-- BEGIN switch_no_images -->
	<tr>
		<td class="row1" colspan="3" align="center">{L_ABQ_NO_IIMAGES}</td>
	</tr>
	<!-- END switch_no_images -->
	<!-- BEGIN images -->
	<tr>
		<td class="{images.COLOR}" width="70%"><span class="gen">{images.IMAGE}</span></td>
		<td class="{images.COLOR}" width="20%" align="center"><span class="genmed"><a href="{images.U_SHOWIMAGE_ACTION}" title="{L_SHOWIMAGE}" target="_blank">{L_SHOWIMAGE}</a></span></td>
		<td class="{images.COLOR}" width="10%" align="center"><span class="genmed"><a href="{images.U_DELETE_ACTION}" title="{L_DELETE}">{L_DELETE}</a></span></td>
	</tr>
	<!-- END images -->
	<tr>
		<td class="catBottom" align="center" height="28" colspan="3"><input name="submit" type="submit" value="{L_UPLOAD_NEW_IMAGE}" class="liteoption" /></td>
	</tr>
</table>
</form>
<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright"><a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">Anti Bot Question MOD</a> {L_ABQ_VERSION} &copy; 2005-2007 <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">MagMo</a></div>
