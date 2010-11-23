<table width="100%">
<tr>
	<td>
	<ul>
	{assign var="prev_part_id" value="-1"}
	{foreach from=$PagesGroups item=curr}
		<!--{$curr.page_id}{$curr.page_name}{$curr.part_id}{$curr.part_name}-->
		{if $prev_part_id!=$curr.part_id}
			<h2>{$curr.part_name}</h2>
		{/if}
		<li><a href="http://{$smarty.server.SERVER_NAME}/mod/pages/id/{$curr.page_id}.html">{$curr.page_name}</a></li>
		{assign var="prev_part_id" value=$curr.part_id}
	{/foreach}
	</ul>
	</td>
</tr>
</table>