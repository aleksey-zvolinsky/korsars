<table bgcolor="#808080">
<tr><td>
������&nbsp;{$UserName}<br>
{if $UserAvatar!=''}
<img src="{$UserAvatar}" border="0" >
{/if}
<br />
<a href="{$ForumPath}privmsg.php?folder=inbox&sid={$sid}">��&nbsp;(&nbsp;{$UserNewPrivMsg}&nbsp;����� )</a><br />
<a href="{$ForumPath}login.php?logout=true&sid={$sid}">�����</a><br>
</td></tr>
</table>