<h2>������</h2>
{foreach name=Travel from=$TravelItems item=TravelItem}
{if $smarty.foreach.Travel.first==true}
<table border="1" width="100%">
  <tr>
    <th>��������</th>
    <th>���</th>
    <th>���� �</th>
    <th>���� ��</th>
    <th>�����������</th>
  </tr>
{/if}
  <a href="http://{$smarty.server.SERVER_NAME}/travel/detail/{$TravelItem.ID}.html">
  <tr>
    <td>{$TravelItem.NAME}</td>
    <td>{$TravelItem.TYPE}</td>
    <td>{$TravelItem.BEGIN_DATE}</td>
    <td>{$TravelItem.END_DATE}</td>
    <td>{$TravelItem.COMMENTS}</td>
  </tr>
  </a>
{if $smarty.foreach.Travel.last==true}
</table>
{/if}
{foreachelse}
<div align="center">������������������ ������� �� ������ ������ ���.</div>
{/foreach}
{if $IsDetail=='Y'}
	{foreach name=TravelDetail from=$TravelDetailItems item=TravelDetailItem}
	{if $smarty.foreach.TravelDetail.first==true}
	<table border="1" width="100%">
	  <tr>
	    <th>�����</th>
	    <th>�������</th>
	    <th>�����������</th>
	  </tr>
	{/if}
      <tr>
	    <td>{$TravelDetailItem.DATETIME}</td>
	    <td>{$TravelDetailItem.PLACE}</td>
	    <td>{$TravelDetailItem.COMMENTS}</td>
	  </tr>
	{foreachelse}
	<div align="center">����������� � ������ ���.
	  <a href="http://{$smarty.server.SERVER_NAME}/travel.html">���������</a>
	</div>
	{/foreach}
{/if}
