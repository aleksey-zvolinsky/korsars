<table bgcolor="#808080">
<tr><td>
Привет&nbsp;{$UserName}<br>
{if $UserAvatar!=''}
<img src="{$UserAvatar}" border="0" >
{/if}
<br />
<a href="{$ForumPath}privmsg.php?folder=inbox&sid={$sid}">ЛС&nbsp;(&nbsp;{$UserNewPrivMsg}&nbsp;новых )</a><br />
<a href="{$ForumPath}login.php?logout=true&sid={$sid}">Выход</a><br>
</td></tr>
</table>