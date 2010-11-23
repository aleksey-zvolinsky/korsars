<?php
/***************************************************************************
 *                          lang_abq.php [english]
 *                          ----------------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

$lang['ABQ_RegisterForm_explain'] = 'This question is unfortunately necessary in order to make automatic registrations more difficult.';
$lang['ABQ_PostForm_explain'] = 'This question is unfortunately necessary in order to make automatic postings more difficult.';
$lang['ABQ_Form_CaseSensitive'] = 'The answer is case sensitive.';
$lang['ABQ_Form_Incorrect'] = 'The Anti-Bot-Question answer you entered was incorrect.';
$lang['ABQ_Form_Question'] = 'Anti-Bot-Question';
$lang['ABQ_Form_YourAnswer'] = 'Your answer';
$lang['ABQ_Form_Problems'] = 'If you are visually impaired or cannot otherwise answer the question please contact the %sAdministrator%s for help.';
$lang['ABQ_Footer'] = '<a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD - phpBB MOD against Spambots" target="_blank"><img src="' . $phpbb_root_path . 'images/abq_mod/admin/abq-button.gif" width="80" height="15" border="0" alt="Anti Bot Question MOD - phpBB MOD against Spam Bots" /></a>';
$lang['ABQ_Footer_Counter1'] = '<br />Blocked registrations: %s';
$lang['ABQ_Footer_Counter2'] = '<br />Blocked registrations / posts: %s / %s';
$lang['ABQ_Footer_Counter3'] = '<br />Blocked posts: %s';

$lang['ABQ_Too_many_posts'] = 'You have exceeded the number of guest post attempts for this session. Please try again later.';

$lang['ABQ_Form_SelectOption1'] = 'Your answer?';

$lang['ABQ_Form_AutoQuestType01'] = 'What is the result of the arithmetic problem on line %s?';
$lang['ABQ_Form_AutoQuestType02'] = 'What is the result of this arithmetic problem?';
$lang['ABQ_Form_AutoQuestType01Notice'] = 'Only use numbers in your answer. E.g. if the result is five, enter the numeral <b>5</b>.';
$lang['ABQ_Form_AutoQuestType03'] = 'Which numbers are in the following character sequence on line %s?';
$lang['ABQ_Form_AutoQuestType04'] = 'Which numbers are in the following character sequence?';
$lang['ABQ_Form_AutoQuestType03Notice'] = 'Ignore mathematical symbols such as plus or minus, i.e. if the character sequence is "1 + 2" the answer is 12.';
$lang['ABQ_Form_AutoQuestType05'] = 'Which alphabetic characters are in the following character sequence on line %s?';
$lang['ABQ_Form_AutoQuestType06'] = 'Which alphabetic characters are in the following character sequence?';
$lang['ABQ_Form_AutoQuestType05Notice'] = '(Case sensitive)';
$lang['ABQ_Form_AutoQuestType07'] = 'Which characters are at the %s position in the following character sequence?';
$lang['ABQ_Form_AutoQuestType07Notice'] = 'The characters are to be counted from left to the right and from top to bottom.<br />'.$lang['ABQ_Form_AutoQuestType05Notice'];
$lang['ABQ_Form_AutoQuestType08'] = 'Which %s characters are in the following character sequence?';
$lang['ABQ_Form_AutoQuestType08Notice'] = 'Enter the characters in the sequence from left to the right and from top to bottom.<br />'.$lang['ABQ_Form_AutoQuestType05Notice'];
$lang['ABQ_Form_AutoQuestType09'] = 'Enter the characters of the first line in the order which is indicated in the second line (Without blanks).';

$lang['ABQ_and'] = 'and';

$lang['ABQ_Color1'] = 'green';
$lang['ABQ_Color2'] = 'red';

$lang['ABQ_MOD'] = 'Anti Bot Question MOD';
?>