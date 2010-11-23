<table border="1" width="100%">
{foreach name=Outer from=$NewsItems item=NewsItem}
  <tr>
    <td width="140px">
      {$NewsItem.date}
    </td>
    <td>
      {$NewsItem.text}
    </td>
  </tr>
{/foreach}
  <tr>
    <td align="center" colspan="2">
      {$NewsNavigation}
    </td>
  </tr>
</table>