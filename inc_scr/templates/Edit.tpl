{if $ID!=''}
<form name="{$Mod}" action="?mod={$Mod}&sid={$sid}" method="post">
<input name="ID" type="hidden" value="{if $ID!='-1'}{$ID}{/if}">
<input type="submit" value="Сохранить">&nbsp;<input type="reset" value="Сбросить">
<table>
	{foreach from=$Fields item=Field}
	<tr>
		<td>{$Field.Comment}</td>
		{assign var='FieldName' value=$Field.Field|upper}
		<td>
			{if $FieldName=='ID'}
				{$Item.$FieldName}
			{elseif $Field.Type<>'text'}
				<input name="{$FieldName}" type="text" size="{if $Field.Size>64}64{else}{$Field.Size}{/if}" value="{$Item.$FieldName}">
			{else}
				<textarea name="{$FieldName}"  style="width:100%">{$Item.$FieldName}</textarea>
			{/if}
		</td>

	</tr>
	{/foreach}
</table>
<input type="submit" value="Сохранить">&nbsp;<input type="reset" value="Сбросить">
</form>
{else}
	{if $Grants->Add==true}
<a href="http://{$smarty.server.SERVER_NAME}{$smarty.server.REQUEST_URI}&id=-1&sid={$sid}">Добавить</a>
	{/if}

<table border="1" id="EditGrid">
	<tr>
	{if $Grants->Edit==true}
		<th>Ред.</th>
	{/if}
	{if $Grants->Delete==true}
		<th>Удал.</th>
	{/if}
	{foreach from=$Fields item=Field}
	   	<th>{$Field.Comment}</th>
	{/foreach}
	</tr>
{foreach from=$Items item=Item}
	<tr>
	{if $Grants->Edit==true}
		<td><a href="http://{$smarty.server.SERVER_NAME}{$smarty.server.REQUEST_URI}&id={$Item.ID}&action=edit">
			<img border="0" src="http://{$smarty.server.SERVER_NAME}/images/EditButton.gif" alt="Редактировать">
		</a></td>
	{/if}
	{if $Grants->Delete==true}
		<td><a href="http://{$smarty.server.SERVER_NAME}{$smarty.server.REQUEST_URI}&id={$Item.ID}&action=delete">
			<img border="0" src="http://{$smarty.server.SERVER_NAME}/images/DeleteButton.gif" alt="Удалить">
		</a></td>
	{/if}
	{foreach from=$Fields item=Field}
		{assign var="FieldName" value=$Field.Field|upper}
		<td>{$Item.$FieldName}</td>
	{/foreach}
	<tr>
{/foreach}
</table>
</form>
{/if}