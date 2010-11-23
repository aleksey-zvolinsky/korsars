<table cellpadding="0" cellspacing="0" border="0">
<tr><td>
	<!-- BEGIN group -->
   <span class="gensmall">
	<a href="{group.U_GROUP}">{group.GROUP_IMG}</a></span>
	<!-- END group -->
</td></tr>
<tr><td><span class="gensmall">
<form action="groupcp.php" name="ShowGroupFrm" size="1" method="post">
<select name="g" onChange="submit();">
	<!-- BEGIN group -->
	<option value="{group.GROUP_ID}">
		<!-- BEGIN is_hidden -->
	*
		<!-- END is_hidden -->
		{group.GROUP_NAME}</option>
	<!-- END group -->
	</select>
	<noscript>
		<input type="submit" value="{L_GO}" class="liteoption" />
	</noscript>
</form>
</span></td></tr>

</table>


