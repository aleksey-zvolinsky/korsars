<table bgcolor="#808080">
<tr><td>
<form method="post" action="{$ForumPath}login.php?sid={$sid}">
	<input name="redirect" type="hidden" value="{$Redirect}">
	���:<input type="text" name="username" size="10" /><br />
	������:<input type="password" name="password" size="10" maxlength="32" /><br />
	<input type="submit" name="login" value="����" /><br />
	<a href="{$ForumPath}index.php">���� �� �����</a>
</form>
</td></tr>
</table>