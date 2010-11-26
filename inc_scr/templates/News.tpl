<h1>Новости</h1>
<table border="0" width="100%">
{foreach name=Outer from=$NewsItems item=NewsItem}
<tr width="100%">
	<td class="date" width="100%">
		{$NewsItem.date} - <h2>{$NewsItem.title}</h2>
	</td>
</tr>
<tr>
	<td>
		<p>{$NewsItem.text}</p><br>
	</td>
</tr>
{/foreach}
<tr>
	<td align="center" colspan="2" width="100%">
		{$NewsNavigation}
	</td>
</tr>
</table>