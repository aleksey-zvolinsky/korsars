<p align="center" class="gensmall">
&#91;<a href="{U_MENU_CONFIG}" title="{L_MENU_CONFIG}">{L_MENU_CONFIG}</a>&#93; 
&#91;<a href="{U_MENU_CONFIG2}" title="{L_MENU_CONFIG2}">{L_MENU_CONFIG2}</a>&#93; 
&#91;<a href="{U_MENU_FONTS}" title="{L_MENU_FONTS}">{L_MENU_FONTS}</a>&#93; 
&#91;<a href="{U_MENU_RESET}" title="{L_MENU_RESET}">{L_MENU_RESET}</a>&#93;<br />
&#91;<a href="{U_MENU_AUTOQUESTIONS}" title="{L_MENU_AUTOQUESTIONS}">{L_MENU_AUTOQUESTIONS}</a>&#93; -
&#91;<a href="{U_MENU_INDIQUESTIONS}" title="{L_MENU_INDIQUESTIONS}">{L_MENU_INDIQUESTIONS}</a>&#93; 
&#91;<a href="{U_MENU_IIMAGES}" title="{L_MENU_IIMAGES}">{L_MENU_IIMAGES}</a>&#93; 
&#91;<a href="{U_MENU_INDIIMAGEQUESTIONS}" title="{L_MENU_INDIIMAGEQUESTIONS}">{L_MENU_INDIIMAGEQUESTIONS}</a>&#93;
</p>

<h1>{L_CONFIGURATION_TITLE}</h1>

<form action="{U_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_ACTIVATE}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_ACTIVATE_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_ANTI_BOT_QUEST_REGISTER}<br /><span class="gensmall">{L_ANTI_BOT_QUEST_REGISTER_EXPLAIN}</span><b>{L_ANTI_BOT_QUEST_CONFIRM}</b></td>
		<td class="row2"><input type="radio" name="abq_register" value="1" {S_ANTI_BOT_QUEST_REGISTER_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="abq_register" value="0" {S_ANTI_BOT_QUEST_REGISTER_DISABLE} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_ANTI_BOT_QUEST_GUEST}<br /><span class="gensmall">{L_ANTI_BOT_QUEST_GUEST_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="abq_guest" value="1" {S_ANTI_BOT_QUEST_GUEST_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="abq_guest" value="0" {S_ANTI_BOT_QUEST_GUEST_DISABLE} />{L_NO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_LOCKREGISTER}<br /><span class="gensmall">{L_LOCKREGISTER_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="2" size="38" name="lockregister" value="{S_LOCKREGISTER}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_LOCKGUESTPOSTS}<br /><span class="gensmall">{L_LOCKGUESTPOSTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="2" size="38" name="lockguestposts" value="{S_LOCKGUESTPOSTS}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AGREEDVARIABLE_NAME}<br /><span class="gensmall">{L_AGREEDVARIABLE_NAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="35" size="38" name="agreed_variable_name" value="{S_AGREEDVARIABLE_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_AGREEDVARIABLE_VALUE}</td>
		<td class="row2"><input class="post" type="text" maxlength="35" size="38" name="agreed_variable_value" value="{S_AGREEDVARIABLE_VALUE}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_EMAILVARIABLE_NAME}<br /><span class="gensmall">{L_EMAILVARIABLE_NAME_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="35" size="38" name="email_variable_name" value="{S_EMAILVARIABLE_NAME}" /></td>
	</tr>
	<tr>
		<td class="row1">{L_ABQVARIABLE_NAME}<br /><span class="gensmall">{L_ABQVARIABLE_NAME_EXPLAIN}</span></td>
		<td class="row2"><select name="abq_variable_namepart1">{S_ABQVARIABLE_NAMEPART1}</select><select name="abq_variable_namepart2">{S_ABQVARIABLE_NAMEPART2}</select><select name="abq_variable_namepart3">{S_ABQVARIABLE_NAMEPART3}</select><select name="abq_variable_namepart4">{S_ABQVARIABLE_NAMEPART4}</select><select name="abq_variable_namepart5">{S_ABQVARIABLE_NAMEPART5}</select><select name="abq_variable_namepart6">{S_ABQVARIABLE_NAMEPART6}</select></td>
	</tr>
	<tr>
		<td class="row1">{L_RATIO_AUTO_INDI_QUESTS}<br /><span class="gensmall">{L_RATIO_AUTO_INDI_QUESTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="3" size="5" name="Ratio_Auto_Indi_Questions" value="{S_RATIO_AUTO_INDI_QUESTS}" /> %</td>
	</tr>
	<tr>
		<td class="row1">{L_SHOW_COUNTER}<br /><span class="gensmall">{L_SHOW_COUNTER_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="show_counter" value="0" {S_SHOW_COUNTER_1} />{L_SHOW_COUNTER_1}<br />
		<input type="radio" name="show_counter" value="1" {S_SHOW_COUNTER_2} />{L_SHOW_COUNTER_2}<br />
		<input type="radio" name="show_counter" value="3" {S_SHOW_COUNTER_4} />{L_SHOW_COUNTER_4}<br />
		<input type="radio" name="show_counter" value="2" {S_SHOW_COUNTER_3} />{L_SHOW_COUNTER_3}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_INDIVIDUELQUESTS_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_INDIVIDUELQUESTS_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_INDIVIDUELQUESTS}<br /><span class="gensmall">{L_INDIVIDUELQUESTS_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Individuel_Questions" value="1" {S_INDIVIDUELQUESTS_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Individuel_Questions" value="0" {S_INDIVIDUELQUESTS_DISABLE} />{L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_CASESENSITIVE}<br /><span class="gensmall">{L_CASESENSITIVE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="IndiQuests_CaseSensitive" value="1" {S_CASESENSITIVE_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="IndiQuests_CaseSensitive" value="0" {S_CASESENSITIVE_DISABLE} />{L_NO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_INDIQUESTSTYPE1_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_INDIQUESTSTYPE1_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_IMAGEPHP}<br /><span class="gensmall">{L_IMAGEPHP_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="IndiQuests_ImagePHP" value="1" {S_IMAGEPHP_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="IndiQuests_ImagePHP" value="0" {S_IMAGEPHP_DISABLE} />{L_NO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_AUTOQUESTS_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_AUTOQUESTS_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOQUESTS_LARGENUMBERS}<br /><span class="gensmall">{L_AUTOQUESTS_LARGENUMBERS_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="AutoQuests_LargeNumbers" value="1" {S_AUTOQUESTS_LARGENUMBERS_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="AutoQuests_LargeNumbers" value="0" {S_AUTOQUESTS_LARGENUMBERS_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="AutoQuests_LargeNumbers" value="2" {S_AUTOQUESTS_LARGENUMBERS_RAND} />{L_RAND}</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOQUESTS_MULTIPLICATION}<br /><span class="gensmall">{L_AUTOQUESTS_MULTIPLICATION_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="AutoQuests_MultiplicationSymbol" value="*" {S_AUTOQUESTS_MULTIPLICATION_1} />*&nbsp; &nbsp;<input type="radio" name="AutoQuests_MultiplicationSymbol" value="x" {S_AUTOQUESTS_MULTIPLICATION_2} />x&nbsp; &nbsp;<input type="radio" name="AutoQuests_MultiplicationSymbol" value="X" {S_AUTOQUESTS_MULTIPLICATION_3} />X</td>
	</tr>
	<tr>
		<td class="row1">{L_AUTOQUESTS_MULTIPLECHOISE}<br /><span class="gensmall">{L_AUTOQUESTS_MULTIPLECHOISE_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="AutoQuests_MultipleChoise" value="1" {S_AUTOQUESTS_MULTIPLECHOISE_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="AutoQuests_MultipleChoise" value="0" {S_AUTOQUESTS_MULTIPLECHOISE_DISABLE} />{L_NO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_INDI_AUTO_QUESTS_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_INDI_AUTO_QUESTS_SETTINGS_EXPLAIN}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_IMAGEFORMAT}<br /><span class="gensmall">{L_IMAGEFORMAT_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="ImageFormat" value="1" {S_IMAGEFORMAT_JPG} />{L_JPG}&nbsp; &nbsp;<input type="radio" name="ImageFormat" value="0" {S_IMAGEFORMAT_PNG} />{L_PNG}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_JPGQUALITY}<br /><span class="gensmall">{L_JPGQUALITY_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="2" size="5" name="JPG_Quality" value="{S_JPGQUALITY_VALUE}" />{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_MULTIIMAGES}<br /><span class="gensmall">{L_MULTIIMAGES_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="multiimages" value="1" {S_MULTIIMAGES_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="multiimages" value="0" {S_MULTIIMAGES_DISABLE} />{L_NO}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_FONTSIZE}<br /><span class="gensmall">{L_FONTSIZE_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="2" size="5" name="fontsize" value="{S_FONTSIZE_VALUE}" />{L_READONLY1}{L_READONLY2}</td>
	</tr>
	<tr>
		<td class="row1">{L_MAX_EFFECTS}<br /><span class="gensmall">{L_MAX_EFFECTS_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="1" size="5" name="max_Effects" value="{S_MAX_EFFECTS_VALUE}" />{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_SEPARATINGLINES}<br /><span class="gensmall">{L_EFF_SEPARATINGLINES_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_SeparatingLines" value="1" {S_EFF_SEPARATINGLINES_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_SeparatingLines" value="0" {S_EFF_SEPARATINGLINES_DISABLE} />{L_NO}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_BGTEXT}<br /><span class="gensmall">{L_EFF_BGTEXT_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_BGText" value="1" {S_EFF_BGTEXT_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_BGText" value="0" {S_EFF_BGTEXT_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_BGText" value="2" {S_EFF_BGTEXT_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_GRID}<br /><span class="gensmall">{L_EFF_GRID_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_Grid" value="1" {S_EFF_GRID_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_Grid" value="0" {S_EFF_GRID_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_Grid" value="2" {S_EFF_GRID_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_GRIDWIDTH}<br /><span class="gensmall">{L_EFF_GRIDWIDTH_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="3" size="5" name="Effect_GridWidth" value="{S_EFF_GRIDWIDTH_VALUE}" />{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_GRIDHEIGHT}<br /><span class="gensmall">{L_EFF_GRIDHEIGHT_EXPLAIN}</span></td>
		<td class="row2"><input class="post" type="text" maxlength="2" size="5" name="Effect_GridHeight" value="{S_EFF_GRIDHEIGHT_VALUE}" />{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_FILLEDGRID}<br /><span class="gensmall">{L_EFF_FILLEDGRID_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_FilledGrid" value="1" {S_EFF_FILLEDGRID_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_FilledGrid" value="0" {S_EFF_FILLEDGRID_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_FilledGrid" value="2" {S_EFF_FILLEDGRID_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_ELLIPSES}<br /><span class="gensmall">{L_EFF_ELLIPSES_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_Ellipses" value="1" {S_EFF_ELLIPSES_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_Ellipses" value="0" {S_EFF_ELLIPSES_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_Ellipses" value="2" {S_EFF_ELLIPSES_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_ARCS}<br /><span class="gensmall">{L_EFF_ARCS_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_Arcs" value="1" {S_EFF_ARCS_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_Arcs" value="0" {S_EFF_ARCS_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_Arcs" value="2" {S_EFF_ARCS_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>
	<tr>
		<td class="row1">{L_EFF_LINES}<br /><span class="gensmall">{L_EFF_LINES_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="Effect_Lines" value="1" {S_EFF_LINES_ENABLE} />{L_YES}&nbsp; &nbsp;<input type="radio" name="Effect_Lines" value="0" {S_EFF_LINES_DISABLE} />{L_NO}&nbsp; &nbsp;<input type="radio" name="Effect_Lines" value="2" {S_EFF_LINES_RAND} />{L_RAND}{L_READONLY1}</td>
	</tr>

	<!-- BEGIN switch_readonly1 -->
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_READONLY1_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_readonly1 -->
	<!-- BEGIN switch_readonly2 -->
	<tr>
		<td class="row2" colspan="2"><span class="gensmall">{L_READONLY2_EXPLAIN}</span></td>
	</tr>
	<!-- END switch_readonly2 -->

	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>
</table></form>
<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright"><a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">Anti Bot Question MOD</a> {L_ABQ_VERSION} &copy; 2005-2007 <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">MagMo</a></div>
