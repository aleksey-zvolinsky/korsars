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

<p>{L_CONFIGURATION_EXPLAIN}</p>

<form action="{U_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
<colgroup><col width="*" /><col width="200" /></colgroup>
	<tr>
	  <th class="thHead" colspan="2">{L_LIBRARYCONFIG}</th>
	</tr>
	<tr>
		<td class="row1">{L_LIB_GD}<br /><span class="gensmall">{L_LIB_GD_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="lib_gd" value="1" {S_LIB_GD_INSTALLED1} />{L_INSTALLED} ({L_VERSION1})<br /><input type="radio" name="lib_gd" value="2" {S_LIB_GD_INSTALLED2} />{L_INSTALLED} ({L_VERSION2})<br /><input type="radio" name="lib_gd" value="0" {S_LIB_GD_NOTINSTALLED} />{L_NOTINSTALLED}<br /><input type="radio" name="lib_gd" value="3" {S_LIB_GD_AUTO} />{L_AUTO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LIB_FT}<br /><span class="gensmall">{L_LIB_FT_EXPLAIN}</span></td>
		<td class="row2"><input type="radio" name="lib_ft" value="1" {S_LIB_FT_INSTALLED1} />{L_INSTALLED}<br /><input type="radio" name="lib_ft" value="0" {S_LIB_FT_NOTINSTALLED} />{L_NOTINSTALLED}<br /><input type="radio" name="lib_ft" value="2" {S_LIB_FT_AUTO} />{L_AUTO}</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_MAINCONFIG}</th>
	</tr>
	<tr>
		<td class="row1">{L_BG}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_BG_R1" value="{S_BG_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BG_R2" value="{S_BG_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_BG_G1" value="{S_BG_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BG_G2" value="{S_BG_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_BG_B1" value="{S_BG_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BG_B2" value="{S_BG_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_TEXT}<br /><span class="gensmall">{L_TEXT_EXPLAIN}</span></td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_R1" value="{S_TEXT_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Text_R2" value="{S_TEXT_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_G1" value="{S_TEXT_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Text_G2" value="{S_TEXT_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_B1" value="{S_TEXT_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Text_B2" value="{S_TEXT_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_TEXT_QUESTION1}<br /><span class="gensmall">{L_TEXT_QUESTION1_EXPLAIN}</span></td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question1_R" value="{S_TEXT_QUESTION1_R}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question1_G" value="{S_TEXT_QUESTION1_G}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question1_B" value="{S_TEXT_QUESTION1_B}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_TEXT_QUESTION2}<br /><span class="gensmall">{L_TEXT_QUESTION2_EXPLAIN}</span></td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question2_R" value="{S_TEXT_QUESTION2_R}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question2_G" value="{S_TEXT_QUESTION2_G}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Text_Question2_B" value="{S_TEXT_QUESTION2_B}" /><br />
		</td>
	</tr>

	<tr>
	  <th class="thHead" colspan="2">{L_EFFECTCONFIG}</th>
	</tr>
	<tr>
		<td class="row1">{L_SEPARATINGLINES}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_R1" value="{S_SEPARATINGLINES_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_R2" value="{S_SEPARATINGLINES_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_G1" value="{S_SEPARATINGLINES_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_G2" value="{S_SEPARATINGLINES_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_B1" value="{S_SEPARATINGLINES_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_SeparatingLines_B2" value="{S_SEPARATINGLINES_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_BGTEXT}<br /><span class="gensmall">{L_BGTEXT_EXPLAIN}</span></td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_BGText_R1" value="{S_BGTEXT_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BGText_R2" value="{S_BGTEXT_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_BGText_G1" value="{S_BGTEXT_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BGText_G2" value="{S_BGTEXT_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_BGText_B1" value="{S_BGTEXT_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_BGText_B2" value="{S_BGTEXT_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_GRID1}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_R1" value="{S_GRID1_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_R2" value="{S_GRID1_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_G1" value="{S_GRID1_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_G2" value="{S_GRID1_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_B1" value="{S_GRID1_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid1_B2" value="{S_GRID1_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_GRID2}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_R1" value="{S_GRID2_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_R2" value="{S_GRID2_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_G1" value="{S_GRID2_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_G2" value="{S_GRID2_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_B1" value="{S_GRID2_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid2_B2" value="{S_GRID2_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_GRID3}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_R1" value="{S_GRID3_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_R2" value="{S_GRID3_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_G1" value="{S_GRID3_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_G2" value="{S_GRID3_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_B1" value="{S_GRID3_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid3_B2" value="{S_GRID3_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_GRID4}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_R1" value="{S_GRID4_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_R2" value="{S_GRID4_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_G1" value="{S_GRID4_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_G2" value="{S_GRID4_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_B1" value="{S_GRID4_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Grid4_B2" value="{S_GRID4_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_FILLEDGRID}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_R1" value="{S_FILLEDGRID_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_R2" value="{S_FILLEDGRID_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_G1" value="{S_FILLEDGRID_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_G2" value="{S_FILLEDGRID_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_B1" value="{S_FILLEDGRID_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_FilledGrid_B2" value="{S_FILLEDGRID_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ELLIPSES}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_R1" value="{S_ELLIPSES_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_R2" value="{S_ELLIPSES_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_G1" value="{S_ELLIPSES_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_G2" value="{S_ELLIPSES_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_B1" value="{S_ELLIPSES_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Ellipses_B2" value="{S_ELLIPSES_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_PARTIALELLIPSES}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_R1" value="{S_PARTIALELLIPSES_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_R2" value="{S_PARTIALELLIPSES_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_G1" value="{S_PARTIALELLIPSES_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_G2" value="{S_PARTIALELLIPSES_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_B1" value="{S_PARTIALELLIPSES_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_PartialEllipses_B2" value="{S_PARTIALELLIPSES_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_ARCS}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_R1" value="{S_ARCS_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_R2" value="{S_ARCS_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_G1" value="{S_ARCS_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_G2" value="{S_ARCS_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_B1" value="{S_ARCS_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Arcs_B2" value="{S_ARCS_B2}" /><br />
		</td>
	</tr>
	<tr>
		<td class="row1">{L_LINES}</td>
		<td class="row2">
		{L_RGB_R}: <input class="post" type="text" maxlength="3" size="5" name="Color_Lines_R1" value="{S_LINES_R1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Lines_R2" value="{S_LINES_R2}" /><br />
		{L_RGB_G}: <input class="post" type="text" maxlength="3" size="5" name="Color_Lines_G1" value="{S_LINES_G1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Lines_G2" value="{S_LINES_G2}" /><br />
		{L_RGB_B}: <input class="post" type="text" maxlength="3" size="5" name="Color_Lines_B1" value="{S_LINES_B1}" /> - 
		<input class="post" type="text" maxlength="3" size="5" name="Color_Lines_B2" value="{S_LINES_B2}" /><br />
		</td>
	</tr>

	<tr>
		<td class="catBottom" colspan="2" align="center"><input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption" />&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption" /></td>
	</tr>

</table></form>
<br clear="all" />

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" class="copyright"><a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">Anti Bot Question MOD</a> {L_ABQ_VERSION} &copy; 2005-2007 <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD" target="_blank">MagMo</a></div>
