<?php
/***************************************************************************
 *                          lang_abq.php [russian]
 *                          ----------------------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *   Translation rev.     : 25.05.2007
 *   Translator           : Палыч  http://www.phpbbguru.net/community/profile.php?mode=viewprofile&u=5873
 *   Translator           : m0l0h
 *   Proof-reader         : VVVas http://www.vvvas.ru/about/
 ***************************************************************************/

$lang['ABQ_RegisterForm_explain'] = 'К сожалению, данный вопрос необходим, чтобы затруднить автоматическую регистрацию.';
$lang['ABQ_PostForm_explain'] = 'К сожалению, данный вопрос необходим, чтобы затруднить автоматическую публикацию сообщений.';
$lang['ABQ_Form_CaseSensitive'] = 'Ответ регистрозависим.';
$lang['ABQ_Form_Incorrect'] = 'Вы ответили неправильно.';
$lang['ABQ_Form_Question'] = 'Anti-Bot-Question';
$lang['ABQ_Form_YourAnswer'] = 'Ваш ответ';
$lang['ABQ_Form_Problems'] = 'Если у вас плохое зрение или вы не можете ответить на этот вопрос по какой-то другой причине, то обратитесь за помощью к %sАдминистратору%s.';
$lang['ABQ_Footer'] = '<a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD - phpBB MOD against Spambots" target="_blank"><img src="' . $phpbb_root_path . 'images/abq_mod/admin/abq-button.gif" width="80" height="15" border="0" alt="Anti Bot Question MOD - phpBB MOD against Spam Bots" /></a>';
$lang['ABQ_Footer_Counter1'] = '<br />Заблокировано регистраций: %s';
$lang['ABQ_Footer_Counter2'] = '<br />Заблокировано регистраций / сообщений: %s / %s';
$lang['ABQ_Footer_Counter3'] = '<br />Заблокировано сообщений: %s';

$lang['ABQ_Too_many_posts'] = 'Вы превысили количество гостевых сообщений за эту сессию. Пожалуйста, попробуйте позже.';

$lang['ABQ_Form_SelectOption1'] = 'Ваш ответ?';

$lang['ABQ_Form_AutoQuestType01'] = 'Каков результат арифметической задачи в %s строке?';
$lang['ABQ_Form_AutoQuestType02'] = 'Каков результат арифметической задачи?';
$lang['ABQ_Form_AutoQuestType01Notice'] = 'Используйте только цифры при ответе, т.е. если результат равен пяти, введите цифру <b>5</b>.';
$lang['ABQ_Form_AutoQuestType03'] = 'Какие числа (последовательно) находятся в %s строке?';
$lang['ABQ_Form_AutoQuestType04'] = 'Какие числа (последовательно) находятся в строке?';
$lang['ABQ_Form_AutoQuestType03Notice'] = 'Игнорируйте математические символы, такие как плюс или минус, т.е. если вы видите последовательность символов "1 + 2", отвечайте 12.';
$lang['ABQ_Form_AutoQuestType05'] = 'Какие буквы (последовательно) находятся в %s строке?';
$lang['ABQ_Form_AutoQuestType06'] = 'Какие буквы (последовательно) находятся в строке?';
$lang['ABQ_Form_AutoQuestType05Notice'] = '(регистрозависимо)';
$lang['ABQ_Form_AutoQuestType07'] = 'Какие символы находятся в %s позиции?';
$lang['ABQ_Form_AutoQuestType07Notice'] = 'Символы расположены слева - направо и сверху - вниз.<br />'.$lang['ABQ_Form_AutoQuestType05Notice'];
$lang['ABQ_Form_AutoQuestType08'] = 'Какие %s символы (последовательно) вы видите?';
$lang['ABQ_Form_AutoQuestType08Notice'] = 'Введите символы последовательно слева - направо и сверху - вниз.<br />'.$lang['ABQ_Form_AutoQuestType05Notice'];
$lang['ABQ_Form_AutoQuestType09'] = 'Вводите символы с первой позиции в форму ввода без пробелов!';

$lang['ABQ_and'] = 'и';

$lang['ABQ_Color1'] = 'зеленые';
$lang['ABQ_Color2'] = 'красные';

$lang['ABQ_MOD'] = 'Anti Bot Question MOD';
?>