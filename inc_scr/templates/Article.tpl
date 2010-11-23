{if $ArticleItems!=null}
	{foreach name=Article from=$ArticleItems item=ArticleItem}
	{if $smarty.foreach.Article.first==true}
	<table border="1" width="100%">
	  <tr>
	    <th>Название</th>
	    <th>Тип</th>
	    <th>Дата создания</th>
	    <th>Автор</th>
	  </tr>
	{/if}
	  <a href="http://{$smarty.server.SERVER_NAME}/article/{$ArticleItem.ID}.html">
	  <tr>
	    <td>{$ArticleItem.NAME}</td>
	    <td>{$ArticleItem.TYPE}</td>
	    <td>{$ArticleItem.DATE_CREATE}</td>
	    <td>{$ArticleItem.AUTHOR}</td>
	  </tr>
	  </a>
	{if $smarty.foreach.Article.last==true}
	</table>
	{/if}
	{foreachelse}
	<div align="center">Статей на данный момент нет.</div>
	{/foreach}
{/if}

{if $Text!=null}
<table border="1" width="100%">
<tr>
	<td align="justify">
	{$Text}
	</td>
</tr>
<tr>
	<td align="left">
	{$Author}
	</td>
</tr>
</table>
{/if}
