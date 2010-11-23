{foreach name=MainNav from=$MainNavigation item=NavItem}
   {if $smarty.foreach.MainNav.first==true}
   |
   {/if}
   <a class="navigation_bottom"  href="http://{$smarty.server.SERVER_NAME}/{$NavItem.ALIAS}.html">{$NavItem.CAPTION}</a> |
{foreachelse}
   Нет навигации
{/foreach}
