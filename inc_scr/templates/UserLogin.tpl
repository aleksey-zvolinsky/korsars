<form method="post" action="{$ForumPath}login.php?sid={$sid}">
	<input name="redirect" type="hidden" value="{$Redirect}">
<table border="0" width="100%">
<tr>
	<td colspan="2" align="center">¬ход</td>
</tr>
<tr>
	<td align="right">»м€:</td>
	<td>
		<input type="text" name="username" size="10" />
	</td>
</tr>
<tr>
	<td align="right">ѕароль:</td>
	<td>
		<input type="password" name="password" size="10" maxlength="32" />
	</td>
</tr>
<tr>
	<td></td>
	<td>
		<input type="submit" name="login" value="¬ход" />
	</td>
</tr>
</table>
</form>