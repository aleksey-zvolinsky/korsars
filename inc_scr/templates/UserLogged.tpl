<table border="0" width="100%">
<tr><td align="center">Вход выполнен</td></tr>
<tr>
	<td align="center">
		{$UserName}<br>
		{if $UserAvatar!=''}
			<img src="{$UserAvatar}" border="0" >
		{/if}
		<br />
		<a href="{$ForumPath}privmsg.php?folder=inbox&sid={$sid}">ЛС&nbsp;(&nbsp;{$UserNewPrivMsg}&nbsp;новых )</a><br />
		<a href="{$ForumPath}login.php?logout=true&sid={$sid}">Выход</a><br>
	</td>
</tr>
</table>