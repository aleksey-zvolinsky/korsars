<?php
/***************************************************************************
 *                          lang_abq_admin.php [english]
 *                          ----------------------------
 *   Version              : Version 3.0.0 - 06.03.2007
 *   copyright            : (C) 2005-2007 M.W.
 *   URL                  : http://phpbb.mwegner.de/
 *
 ***************************************************************************/

// redirect pages
$lang['ABQ_Config_updated'] = 'Anti Bot Question MOD configuration changed';
$lang['ABQ_Config2_updated'] = 'Anti Bot Question MOD advanced configuration changed';
$lang['ABQ_Reset_reseted_values'] = 'Default color settings have been restored.'; 
$lang['ABQ_Reset_reseted_multiimages'] = 'Multi image files where deleted.'; 
$lang['ABQ_Click_return_config'] = 'Click %sHere%s to return to Anti Bot Question Mod Configuration';
$lang['ABQ_Click_return_config2'] = 'Click %sHere%s to return to Anti Bot Question Mod advanced Configuration';
$lang['ABQ_Click_return_reset'] = 'Click %sHere%s to return to Anti Bot Question Mod Reset';
$lang['ABQ_New_Question_created'] = 'The new Individual Question was successfully created';
$lang['ABQ_Question_updated'] = 'The Individual Question was successfully updated';
$lang['ABQ_Question_deleted'] = 'The Individual Question was successfully deleted';
$lang['ABQ_Click_return_ABQ'] = 'Click %sHere%s to return to Individual Question Administration of the Anti Bot Question Mod';
$lang['ABQ_Click_return_Fonts'] = 'Click %sHere%s to return to font administration of the Anti Bot Question Mod';
$lang['ABQ_Click_return_IImages'] = 'Click %sHere%s to return to Individual Question Image Administration of the Anti Bot Question Mod';
$lang['ABQ_delete_Font_ok'] = 'The font was successfully deleted';
$lang['ABQ_upload_File_ok'] = 'The file was successfully uploaded.';
$lang['ABQ_delete_Image_ok'] = 'The image file was successfully deleted.';

// not only for redirect pages
$lang['ABQ_unknown_font'] = 'The font you are looking for was not found.';
$lang['ABQ_dont_delete_font'] = 'Do not delete the font "do-not-delete".<br />ABQ requires this font in order to work correctly.';
$lang['ABQ_unknown_image'] = 'The image file you are looking for was not found.';
$lang['ABQ_individual_image_in_use'] = 'You cannot delete this image file because it is in use in at least one Individual Question.';

// general
$lang['ABQ_Version'] = '3.0.0';
$lang['ABQ_Wiki_GD'] = 'http://en.wikipedia.org/wiki/GD_Graphics_Library';
$lang['ABQ_Wiki_FT'] = 'http://en.wikipedia.org/wiki/FreeType';
$lang['ABQ_installed'] = 'Installed';
$lang['ABQ_not_installed'] = 'Not installed';
$lang['ABQ_Randomly_Selected'] = 'randomly Selected';
$lang['ABQ_Example'] = 'Example';
$lang['ABQ_JPG'] = 'JPG';
$lang['ABQ_PNG'] = 'PNG';
$lang['ABQ_ReadOnly1_Explain'] = 'This option requires the <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a>. Because this library is not installed on your server, this option has no function on your board.';
$lang['ABQ_ReadOnly2_Explain'] = 'This option requires the <a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType Library" target="_blank">FreeType Library</a>. Because this library is not installed on your server, this option has no function on your board.';
$lang['ABQ_General'] = 'General Configuration';
$lang['ABQ_Automatic_Questions'] = 'Automatic Questions';
$lang['ABQ_Individual_Questions'] = 'Individual Questions';
$lang['ABQ_File'] = 'File';
$lang['ABQ_Image'] = 'Image';

// ACP Menu
$lang['ABQ_Admin_Index'] = 'Admin-Index';
$lang['ABQ_Admin_Index_Explain'] = 'The Anti Bot Question MOD adds a question to the registration and/or guest post forms to prevent bots from spamming the board. The question must be answered correctly to complete the registration or post successfully. If you use this MOD, you must disable the standard visual confirmation.<br /><br />This MOD is compatible with the <a href="http://www.phpbbhacks.com/download/235" title="Select Default Language MOD 1.3.4" target="_blank">Select Default Language MOD 1.3.4</a>. If you use the Select Default Language MOD, special changes of the code are not necessary.<br />If you use one of the following MODs, you need an add-on to ensure compatibility with ABQ:<br />
&#8226; <a href="http://www.phpbbhacks.com/download/586" title="Advanced Quick Reply MOD 1.1.1" target="_blank">Advanced Quick Reply MOD 1.1.1</a><br />
&#8226; <a href="http://www.phpbbhacks.com/download/522" title="Quick Reply MOD 1.0.5" target="_blank">Quick Reply MOD 1.0.5</a><br />
&#8226; <a href="http://www.phpbbhacks.com/download/540" title="Quick Reply MOD with Quote 1.1.3" target="_blank">Quick Reply MOD with Quote 1.1.3</a><br />
&#8226; <a href="http://www.phpbbhacks.com/download/4733" title="Quick Reply MOD with Quote and BBCode 1.1.3" target="_blank">Quick Reply MOD with Quote and BBCode 1.1.3</a><br />
&#8226; every other Quick Reply MOD (no further special Add-Ons available)<br />
You can download the add-ons <a href="http://phpbb.mwegner.de/anti-bot-question-mod/" title="Anti Bot Question MOD Add-Ons" target="_blank">here</a>.';
$lang['ABQ_AdminMenu_Config'] = 'Configuration';
$lang['ABQ_AdminMenu_AutomaticQuestions'] = '"' . $lang['ABQ_Automatic_Questions'] . '" Administration';
$lang['ABQ_AdminMenu_Fonts'] = 'Font Administration';
$lang['ABQ_AdminMenu_Config2'] = 'Advanced Configuration';
$lang['ABQ_AdminMenu_Reset'] = 'Reset';
$lang['ABQ_AdminMenu_IndividualQuestions'] = '"' . $lang['ABQ_Individual_Questions'] . '" type %s Administration';
$lang['ABQ_AdminMenu_IndividualImages'] = 'Image Administration';

// configuration
$lang['ABQ_EnableDisableABQ'] = 'Enable/disable Anti Bot Question MOD';
$lang['ABQ_EnableDisableABQ_explain'] = 'Activate or deactivate ABQ for registrations and guest postings.';
$lang['ABQ_Register'] = 'Enable Anti Bot Questions for registrations';
$lang['ABQ_Register_explain'] = 'Users must answer a question correctly when registering.';
$lang['ABQ_confirm_enabled'] = 'The default Visual Confirmation is also enabled! (Please disable it under: ' . $lang['General'] . ' &gt; ' . $lang['Configuration'] . ')';
$lang['ABQ_Guest'] = 'Enable Anti Bot Question for guests';
$lang['ABQ_Guest_explain'] = 'If the MOD is enabled for guests, guests must answer the Anti Bot Question correctly to be able to submit the post.';
 // general configuration
$lang['ABQ_General_Config'] = 'General Configuration';
$lang['ABQ_LockRegister'] = 'Allowed registration attempts';
$lang['ABQ_LockRegister_explain'] = 'Wrong answers at registration are counted as failed attempt. After reaching the number set for maximum attempts the user is blocked (only for the current session).<br />Allowed values: 0 - 19; 0 = Never blocked';
$lang['ABQ_LockGuestPosts'] = 'Allowed guest posting attempts';
$lang['ABQ_LockGuestPosts_explain'] = 'Wrong answers by a guest trying to post are counted as failed attempt. After reaching the number set for maximum attempts the user is blocked (only for the current session).<br />Allowed values: 0 - 19; 0 = Never blocked';
$lang['ABQ_AgreedVariable_Name'] = 'Name of agreed variable';
$lang['ABQ_AgreedVariable_Name_explain'] = 'Enter a random set of characters (numeric and/or letters). This has no influence to the registration process but is required to enhance security.<br />Min. length: 3 characters (Only numbers and letters A-Z, a-z are allowed).';
$lang['ABQ_AgreedVariable_Value'] = 'Value of agreed variable';
$lang['ABQ_RegistrationForm_Email_Name'] = 'Name of the email variable in the registration form';
$lang['ABQ_RegistrationForm_Email_Name_explain'] = 'Enter a random set of characters (numeric and/or letters). This has no influence to the registration process but is required to enhance security.<br />Min. length: 3 characters (Only numbers and letters A-Z, a-z are allowed).';
$lang['ABQ_Show_Counter'] = 'Show Spambot-Counter in footer?';
$lang['ABQ_Show_Counter_Explain'] = 'The counter can display blocked registations and/or blocked posts*.<br />* Only counts blocked posts from guests.';
$lang['ABQ_Show_Counter_1'] = 'Do not display counter';
$lang['ABQ_Show_Counter_2'] = 'Only registrations';
$lang['ABQ_Show_Counter_3'] = 'Registrations and posts';
$lang['ABQ_Show_Counter_4'] = 'Only posts';
$lang['ABQ_ABQVariable_Name'] = 'Select the name of the Anti Bot Question POST-variable';
$lang['ABQ_ABQVariable_Name_Explain'] = 'Choose a combination. This does not have visible influence on the registration form for human visitors.';
$lang['ABQ_Ratio_Auto_Individual_Quests'] = 'What percent of the questions should be Individual Questions (the remaining percent are Automatic Questions)';
$lang['ABQ_Ratio_Auto_Individual_Quests_Explain'] = 'With 100% only Individual Questions are taken, with 0% only Automatic Questions. If the Individual Questions are disabled, no Individual Question exists or no kind of Automatic Question is enabled, this setting will be ignored.';
 // Individual Question configuration
$lang['ABQ_Individual_Quest_Config'] = 'Individual Question Configuration';
$lang['ABQ_Individual_Quest_Config_explain'] = 'Only the Individual Questions (type 1 and 2) are affected by this settings.';
$lang['ABQ_Enable_Individual_Quests'] = 'Enable the Individual Questions';
$lang['ABQ_Enable_Individual_Quests_Explain'] = 'If the Individual Questions are disabled, the MOD uses only the Automatic Questions. If no Individual Question is available, this setting will be ignored and the MOD always uses an Automatic Question. If no Automatic Question is enabled, the MOD always uses the Automatic Textquestion type 1.';
$lang['ABQ_CaseSensitive'] = 'Is the Answer to the Individual Question case sensitive?';
$lang['ABQ_CaseSensitive_Explain'] = 'Automatic Questions ignore this setting. The answer to an Automatic Question is always case sensitive!';
 // Individual Question configuration type 1
$lang['ABQ_IndiQuestsType1_Config'] = 'Individual Question type 1 Configuration';
$lang['ABQ_IndiQuestsType1_Config_explain'] = 'Only the Individual Questions type 1 are affected by this settings.';
$lang['ABQ_ImagePHP'] = 'Use the file abq_image.php to show images';
$lang['ABQ_ImagePHP_Explain'] = 'This file makes the identification of images more difficult for Bots. However this does not function on all servers (depending on the server-configuration).<br />If you can read the text (text: Test) shown in the following image, then you should activate this setting.<br />%s<br clear="all" />If no image is shown, there is no error. Your server does not support this function.';
 // Automatical Question configuration
$lang['ABQ_AutoQuest_Config'] = 'Automatical Question Configuration';
$lang['ABQ_AutoQuest_Config_explain'] = 'Only the Automatical Questions are affected by this settings.';
$lang['ABQ_LargeNumbers'] = 'Use large numbers within arithmetric problems';
$lang['ABQ_LargeNumbers_Explain'] = 'If large numerical values are used, then the numbers used within arithmetic problems are larger than 1000. If large numerical values are not used, then the numbers, used within arithmetic problems, as well as the results have maximally a value of 350.';
$lang['ABQ_Multiplication_Symbol'] = 'Multiplication symbol';
$lang['ABQ_Multiplication_Symbol_Explain'] = 'Select a multiplication symbol used within arithmetic problems<br />3*3=?; 3x3=?; 3X3=?';
$lang['ABQ_AutoQuests_MultipleChoice'] = 'Multiple Choice within Automatic Questions';
$lang['ABQ_AutoQuests_MultipleChoice_Explain'] = 'If you select the Multiple Choice option, the user does not have to type an answer. The user must select the correct answer only from several given answers. This is a substantial simplification of the procedure for the user. But the bot protection is also a little bit reduced.';
 // Automatical Image-Question configuration
$lang['ABQ_IndiQuests_AutoQuests_Config'] = 'Individual (type 2) and Automatical Image-Question Configuration';
$lang['ABQ_IndiQuests_AutoQuests_Config_explain'] = 'Only the Individual (type 2) and Automatic Image-Questions are affected by this settings. These require that the <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a> is installed on the server. An installed version of the <a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType Library" target="_blank">FreeType Library</a> is not necessary but recommended.<br /><a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a>: %s<br /><a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType Library" target="_blank">FreeType Library</a>: %s<br /><br />The linked example images are static (i.e. they do not change), in order to reduce the server load.';
$lang['ABQ_IndiQuests_AutoQuests_Config_explain2'] = 'without FreeType Library';
$lang['ABQ_IndiQuests_AutoQuests_Config_explain3'] = 'with FreeType Library';
$lang['ABQ_ImageFormat'] = 'Select the format of the images';
$lang['ABQ_ImageFormat_Explain'] = '<b>Important:</b> The JPG format requires GD Library 1.8 or higher.';
$lang['ABQ_JPGQuality'] = 'JPG-Quality';
$lang['ABQ_JPGQuality_Explain'] = 'Values from 50 to 90 are permissible. The larger the value, the better the quality of the image is. But better quality also means longer load time.';
$lang['ABQ_Multiimages'] = 'Use multi-images';
$lang['ABQ_Multiimages_Explain'] = 'When using multi-images, the image generated for automatic questions is made up of multiple images. This makes recognition by bots almost impossible.<br /><b>Important:</b> As the picture data is saved on the server it is critical that there is enough space available on the harddrive. After the session of the visitor has been closed the picture data is deleted automatically.'; 
$lang['ABQ_Fontsize'] = 'font size';
$lang['ABQ_Fontsize_Explain'] = 'This setting is ignored if the <a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType Library" target="_blank">FreeType Library</a> is not installed.<br />Values from 15 to 40 are permissible. The larger the font size, the easier you can read the text in the images. However the font size also influences the image size. The larger the font size the larger the images are.<br />notice: If more than one text line exists, the font size is automatically reduced by 2 per line.';
$lang['ABQ_Max_Effects'] = 'Upper limit of the used effects';
$lang['ABQ_Max_Effects_explain'] = 'Here you can specify how many effects can be selected at random. This setting is relevant only for effects, whose setting is "' . $lang['ABQ_Randomly_Selected'] . '".<br />If there are more effects with setting "Yes" than this value, then no "' . $lang['ABQ_Randomly_Selected'] . '" effects will be used.<br />If there are fewer effects with setting "Yes" than this value, then "' . $lang['ABQ_Randomly_Selected'] . '" effects will be used. Effects with setting "No" are never used.<br />This value is a maximum value for the number of used effects!<br />A value of zero means there is no limitation. The permissible maximum value is 6.';
$lang['ABQ_Effect_SeparatingLines'] = 'Use effect: separator';
$lang['ABQ_Effect_SeparatingLines_explain'] = 'If more than one text line exists, a separating line can be included between the text lines.';
$lang['ABQ_Effect_BackgroundText'] = 'Use effect: background text';
$lang['ABQ_Effect_Grid'] = 'Use effect: grid';
$lang['ABQ_Effect_GridWidth'] = 'Horizontal distance of the grid network lines';
$lang['ABQ_Effect_GridWidth_explain'] = 'Permissible values: 10 - 100; 0 = a coincidental distance is selected';
$lang['ABQ_Effect_GridHeight'] = 'Vertical distance of the grid network lines';
$lang['ABQ_Effect_GridHeight_explain'] = 'Permissible values: 10 - 50; 0 = a coincidental distance is selected';
$lang['ABQ_Effect_FilledGrid'] = 'Use effect: filled grid';
$lang['ABQ_Effect_FilledGrid_explain'] = 'This effect can be used only in combination with the effect grid. If the effect grid is disabled, the effect filled grid is also automatically disabled.';
$lang['ABQ_Effect_Ellipses'] = 'Use effect: ellipse and partial ellipse';
$lang['ABQ_Effect_Ellipses_explain'] = 'This effect requires PHP 4.0.6 or higher. Your version: %s';
$lang['ABQ_Effect_Arcs'] = 'Use effect: arcs';
$lang['ABQ_Effect_Lines'] = 'Use effect: lines';

// Automatic Questions administration
$lang['ABQ_AutoQuestAdmin'] = 'administrate Automatic Questions';
$lang['ABQ_AutoQuestAdmin_Explain'] = 'Here you can select which Automatic Questions are enabled or disabled.<br /><br />If you want to use the image questions, the <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a> must be installed. The <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a> is %s on your server.<br /><br />If all Automatic Questions are disabled, the MOD uses only Individual Questions. If all Individual Questions are disabled, the MOD always uses the Automatic Text Question type 1.<br /><br />The line x. and the position x1 to x8 are replaced at random by adequate numbers.';
$lang['ABQ_TextQuests'] = 'text questions';
$lang['ABQ_ImageQuests'] = 'image questions';
$lang['ABQ_Type'] = 'type';
 // Questions Lines
$lang['ABQ_Question_4Lines'] = '%s<br />4 lines are shown.';
$lang['ABQ_Question_3Lines'] = '%s<br />3 lines are shown.';
$lang['ABQ_Question_2Lines'] = '%s<br />2 lines are shown.';
$lang['ABQ_Question_1Line'] = '%s';

// Individual Questions administration
$lang['ABQ_Admin_Title'] = 'administrate Individual Questions type %s';
$lang['ABQ_Admin_Explain'] = 'Here you can create new Individual Questions and edit or delete old questions.<br />If the Individual Questions are enabled, the MOD uses one of the following questions. The question is randomly selected.<br /><br />Example:<br />Question: Which of these four is an animal? Car, Europe, Horse, Mountain<br />Answer: Horse<br />';
$lang['ABQ_Admin_Explain_Type1'] = 'Type 1 Individual Questions are text questions that can be combined with an image.<br /><br />' . $lang['ABQ_Admin_Explain']; 
$lang['ABQ_Admin_Explain_Type2'] = 'Type 2 Individual Questions are questions whereby the text is displayed as an image.<br />To use this type <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD-Library" target="_blank">GD-Library</a> must be present. Status: %s<br /><br />' . $lang['ABQ_Admin_Explain']; 
$lang['ABQ_IQ_T2_Explain'] = 'Only the following characters are allowed: A-Z, a-z, 0-9, space and % = + - * / ( ) : ; . , ! ?<br />All other characters are not allowed!<br />Important: Make sure that the user is not confronted with a confusing character mix like a zero (0) and the character O.';
$lang['ABQ_Answer'] = 'correct Answer';
$lang['ABQ_Answer_wrong'] = 'wrong Answer';
$lang['ABQ_Question'] = 'Question';
$lang['ABQ_ImageURL'] = 'Image-URL';
$lang['ABQ_ImageURL_DelExplain'] = 'The image is not deleted from the server!';
$lang['ABQ_Create_Question'] = 'Create a new question &amp; answer';
$lang['ABQ_Image_DNE'] = 'Does not exist any longer.';
$lang['ABQ_No_questions'] = '<br />No individual questions type %s have been created.<br /><br />';
$lang['ABQ_Edit_Question'] = 'Edit Question';
$lang['ABQ_Answer_Explain'] = 'Case-sensitive!';
$lang['ABQ_Delete_Title'] = 'Delete Individual Question';
$lang['ABQ_Delete_Question'] = 'Delete Question';
$lang['ABQ_MCQ'] = 'Multiple Choice Question';
$lang['ABQ_IQ_MC_Info1'] = 'no Multiple Choice Question ** - The user must enter the answer into a text field.';
$lang['ABQ_IQ_MC_Info1a'] = 'Enter one or more correct answers and <b>no</b> wrong answer.';
$lang['ABQ_IQ_MC_Info2'] = 'Multiple Choice Question ** - The user must select the correct answer from all given answers.';
$lang['ABQ_IQ_MC_Info2a'] = 'Fill out only the field &quot;' . $lang['ABQ_Answer'] . ' 1&quot; and <b>all</b> wrong answer-fields.';
$lang['ABQ_IQ_MC_Info3'] = '** - If you select the Multiple Choice option, the user does not have to type an answer. This is a substantial simplification of the procedure for the user. But the bot protection is also slightly reduced (unless you select only automatic graphic images).';

// advanced configuration
$lang['ABQ_Libraries'] = 'Libraries'; 
$lang['ABQ_auto_detection'] = 'Automatic detection'; 
$lang['ABQ_Version1'] = 'Version 1'; 
$lang['ABQ_Version2'] = 'Version 2'; 
$lang['ABQ_lib_GD_conf'] = 'Is the <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD-Library" target="_blank">GD-Library</a> installed?'; 
$lang['ABQ_lib_GD_conf_explain'] = 'You can manually deactivate the detection of the GD-Library. Important: The GD-Library is required for some functions of this Mod. Selecting the wrong setting will make ABQ non-operational.'; 
$lang['ABQ_lib_FT_conf'] = 'Is the <a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType-Library" target="_blank">FreeType-Library</a> installed?'; 
$lang['ABQ_lib_FT_conf_explain'] = 'You can manually deactivate the detection of the Freetype-Library. Important: The Freetype-Library is optional for some functions of this Mod. However, selecting the wrong setting will make ABQ non-operational.'; 
$lang['ABQ_ColorConf_Titel'] = 'advanced configuration';
$lang['ABQ_ColorConf_Explain'] = 'Here you can specify the colors used within the <b>Individual (type 2) and Automatic Image Questions</b>. These values are irrelevant for the Individual (type 1) and Automatic Text Questions.<br /><br /><img width="16" height="16" border="0" vspace="0" hspace="0" src="' . $phpbb_root_path . 'images/abq_mod/admin/attention.gif" alt="ATTENTION" /> <b>Change these settings only if you know what you are doing. Wrong settings can cause the text within the images to be unreadable!</b><br clear="all"><br />Use the RGB schema to define the colors. The following is to be considered:<br />&#187; Valid color-values are: 0 - 255<br />&#187; Two values must be defined for each color attribute R (= red), g (= green) and B (= blue). The second value must be greater then the first.<br /><br />Normally only one value is necessary. Why are two values per color attribute necessary here?<br />Because you define not only one color. You define a set of colors. For example: If the first red-value is 10 and the second is 50, a randomly red-value greater than 9 and smaller than 51 is selected within the image.';
$lang['ABQ_RGB_red'] = 'R';
$lang['ABQ_RGB_green'] = 'G';
$lang['ABQ_RGB_blue'] = 'B';
$lang['ABQ_ColorMainconfig'] = 'Color Configuration';
$lang['ABQ_Color_BG'] = 'background color';
$lang['ABQ_Color_Text'] = 'text color';
$lang['ABQ_Color_Text_Explain'] = 'The text color must be clearly different from text color 1, text color 2 and background text color.';
$lang['ABQ_Color_Question1'] = 'text color 1';
$lang['ABQ_Color_Question1_Explain'] = 'The text color 1 is used within the Automatic Image Question type 16 (%s). If you select another color than green, you must change the language variable $lang[\'ABQ_Color1\'] (file: language/lang_???/lang_abq.php) from "green" to the new color. Make this change for all installed languages!<br />The text color 1 must be clearly different from text color, text color 2 and background text color.';
$lang['ABQ_Color_Question2'] = 'text color 2';
$lang['ABQ_Color_Question2_Explain'] = 'The text color 2 is used within the Automatic Image Question type 17 (%s). If you select another color than red, you must change the language variable $lang[\'ABQ_Color2\'] (file: language/lang_???/lang_abq.php) from "red" to the new color. Make this change for all installed languages!<br />The text color 2 must be clearly different from text color, text color 1 and background text color.';
$lang['ABQ_Effect_conf'] = 'effect color';
$lang['ABQ_Color_SeparatingLines'] = 'Color of the separating line between the text lines';
$lang['ABQ_Color_BGText'] = 'background text color';
$lang['ABQ_Color_BGText_Explain'] = 'The background text color must be clearly different from text color, text color 1 and text color 2. The background color should be less intensive than the text color. This is important for differentiating between the relevant text and the irrelevant background text.';
$lang['ABQ_Color_Grid'] = 'grid color';
$lang['ABQ_Color_FilledGrid'] = 'filled grid color';
$lang['ABQ_Color_Ellipses'] = 'ellipse color';
$lang['ABQ_Color_PartialEllipses'] = 'partial ellipse color';
$lang['ABQ_Color_Arcs'] = 'arc color';
$lang['ABQ_Color_Lines'] = 'line color';

// Reset
$lang['ABQ_Reset_Titel'] = 'Reset';
$lang['ABQ_ValueReset'] = 'reset to default color values';
$lang['ABQ_ValueReset_Explain'] = 'Here you can reset all color values to the original values.<br /><b>Important:</b><br />&#187; If you changed the variable $lang[\'ABQ_Color1\'], you must undo the change within the file language/lang_???/lang_abq.php for all installed languages. The original variable value is "green", the current value is "%s".<br />&#187; If you changed the variable $lang[\'ABQ_Color2\'], you must undo the change within the file language/lang_???/lang_abq.php for all installed languages. The original variable value is "red", the current value is "%s".';
$lang['ABQ_MultiimageReset'] = 'Delete multi image files';
$lang['ABQ_MultiimageReset_Explain'] = 'Do you want to delete all multi image files? When the multi image option is active the files are deleted automatically after each session.';
$lang['ABQ_MultiimageReset_Explain2'] = '%s files (%s) are present.';
$lang['ABQ_MultiimageReset_Explain3'] = 'No files present.';

// font administration
$lang['ABQ_FontAdmin_Title'] = 'Font Administration';
$lang['ABQ_FontAdmin_Explain'] = 'Here you can upload new fonts, which will be used within the Automatic Image Questions. Fonts, which you do not want to use any longer, can be deleted here.<br /><br />It is necessary that the <a href="' . $lang['ABQ_Wiki_GD'] . '" title="GD Graphics Library" target="_blank">GD Graphics Library</a> and the <a href="' . $lang['ABQ_Wiki_FT'] . '" title="FreeType Library" target="_blank">FreeType Library</a> are installed on the server, if you want to use one of these fonts.<br />GD Graphics Library: %s<br />FreeType Library: %s<br /><br />Before uploading a new font please check the copyright. Do not breach any copyrights.';
$lang['ABQ_Font'] = 'font';
$lang['ABQ_Upload_New_Font'] = 'Upload a new font';
$lang['ABQ_GD_FT_NotInstalled'] = 'The GD Graphics Library and the FreeType Library must be installed. Without one of these libraries, the fonts cannot be used.<br />At least one library is not installed.';
$lang['ABQ_FontAdmin_Example'] = 'Show font';
$lang['ABQ_FontAdmin_Example_Explain'] = 'Here the font can be tested. Is the font suitable for the MOD? Are all used characters identifiable and does the font include all used characters?';
$lang['ABQ_Font_Characters'] = 'Following characters must be included and identifiable within the image:';
$lang['ABQ_FontAdmin_Delete'] = 'Delete font';
$lang['ABQ_FontAdmin_Delete_Explain'] = 'Here you can delete a font, if you do not want to use it any longer within the MOD. %s If you want to use this font in the future, you must upload this font again.';
$lang['ABQ_FontAdmin_Delete_Explain2'] = 'The font will be completely deleted from the font-order!';
$lang['ABQ_FontAdmin_Upload'] = 'Font upload';
$lang['ABQ_FontAdmin_Upload_Explain'] = 'Here you can upload new fonts. The following is to be considered:<br />The maximum allowed size of the font file is %d KB.<br />Before uploading a new font please check the copyright. We accept no liability.';
$lang['ABQ_FontAdmin_Upload_FontFile'] = 'Upload font from your computer';
$lang['ABQ_FontAdmin_Upload_FontFile_Explain'] = '<br />Only TTF font files can be uploaded. Other file formats are not valid.<br />Only alphabetic characters, numbers, hyphens (-) and underlines (_) are allowed within the file name.<br />You can not overwrite an existing font file. You must first delete the font file and then you can upload the new font (with the same file name).';

// Image Administration for the Individual Questions (Individual Images)
$lang['ABQ_IImageAdmin_Title'] = 'Image Administration for the Individual Questions';
$lang['ABQ_IImageAdmin_Explain'] = 'Here you can upload new images for use within the Individual Questions. If you do not use an image any longer, you can delete it here.<br /><br />Before uploading a new image please check the copyright. We accept no liability.';
$lang['ABQ_Upload_New_Image'] = 'Upload a new image';
$lang['ABQ_ShowImage'] = 'Show image';
$lang['ABQ_No_IIMages'] = 'There is no image, which can be used within the Individual Questions.';
$lang['ABQ_IImageAdmin_Delete'] = 'Delete image';
$lang['ABQ_IImageAdmin_Delete_Explain'] = 'If you do not need an image any longer, you can delete it here. %s If you want to use the deleted image in the future, you must upload the image again.';
$lang['ABQ_IImageAdmin_Delete_Explain2'] = 'The image will be completely deleted from the image-order!';
$lang['ABQ_IImageAdmin_Upload'] = 'Image upload';
$lang['ABQ_IImageAdmin_Upload_Explain'] = 'Here you can upload new images. The following is to be considered:<br />The maximum allowed size of the image file is %d KB.<br />Before uploading a new image please check the copyright. Do not breach any copyrights.';
$lang['ABQ_IImageAdmin_Upload_ImageFile'] = 'Upload image from your computer';
$lang['ABQ_IImageAdmin_Upload_ImageFile_Explain'] = '<br />Only following image type / file extensions are valid: jpg (jpeg), gif, png. Other image types are not valid.<br />Only alphabetic characters, numbers, hyphens (-) and underlines (_) are allowed within the file name.<br />You cannot overwrite an existing image file. You must first delete the image file and then you can upload the new image (with the same file name).';

// error messages
$lang['ABQ_Error_not_updated'] = 'The database has not been updated.';
$lang['ABQ_Error_Percentage'] = 'The percentage value must be between 0 and 100. Decimal places are not permissible.';
$lang['ABQ_Error_MaxEffects'] = 'The value for the upper limit of the used effects must be within the value range of 0 to 6. Decimal places are not permissible.';
$lang['ABQ_Error_GridWidth'] = 'The value for the horizontal distance of the grid network lines must be 0 or within the value range of 10 to 100. Decimal places are not permissible.';
$lang['ABQ_Error_GridHeight'] = 'The value for the vertical distance of the grid network lines must be 0 or within the value range of 10 to 50. Decimal places are not permissible.';
$lang['ABQ_Error_Fontsize'] = 'The font size must be greater then 14 and smaller then 40. Decimal places are not permissible.';
$lang['ABQ_Error_JPGQuality'] = 'The value for the JPG-quality must be within the value range of 50 to 90. Decimal places are not permissible.';
$lang['ABQ_Error_Attemps'] = 'For maximum attemps only values between 0 and 19 are allowed.';
$lang['ABQ_Error_Question_too_long'] = 'The question is too long (maximum length: %s characters)';
$lang['ABQ_Error_Answer_too_long'] = 'At least one of the answers is too long (maximum length: %s characters)';
$lang['ABQ_Error_Question_missed'] = 'You must specify a question.';
$lang['ABQ_Error_Answer_missed'] = 'You must specify at least one answer.';
$lang['ABQ_Error_Sign_not_allowed'] = 'There is at least one not allowed character in the question.';
$lang['ABQ_Error_Image_not_available'] = 'The image you selected is not available.';
$lang['ABQ_Error_ColorValue1'] = 'The value for the colors must be within the value range of 0 to 255. Decimal places are not permissible.';
$lang['ABQ_Error_ColorValue2'] = 'If two values are necessary for one color, the second value must be greater then the first. You ignored this necessity.';
$lang['ABQ_Error_Valuereset_Not_Confirmed'] = 'Please confirm the reset check box. Without this confirmation the color reset is not possible.';
$lang['ABQ_Error_Deletion_Not_Confirmed'] = 'Deletion of multi images was not confirmed.';
$lang['ABQ_Error_Multiimages_not_deleted'] = 'Multi images could not be deleted.';
$lang['ABQ_Error_no_fonts'] = 'No font is available. <b>The font "do-not-delete" is necessary for the successful operation of the MOD.</b> This font should be uploaded as soon as possible.';
$lang['ABQ_Error_font_missing'] = '<b>The font "do-not-delete" is necessary for the successful operation of the MOD.</b> This font is missing. Please upload this font as soon as possible.';
$lang['ABQ_Error_File_Uploaderror'] = 'The file was not uploaded.';
$lang['ABQ_Error_Fontupload_Filesize'] = 'The font file size must be less than %d KB.';
$lang['ABQ_Error_upload_File_exists'] = 'A file with the same name already exists.<br />Please delete the existing file or rename the file you want to upload.';
$lang['ABQ_Error_upload_invalid_File'] = 'The file has an invalid file type or an invalid file name (use only alphabetic characters, numbers, hyphens and underlines within the file name).';
$lang['ABQ_Error_Font_not_deleted'] = 'Unable to delete the font file.<br />You must have the authorization to delete files within the folder abq_mod/fonts/. Please check it. The CHMOD of this folder must be 777.';
$lang['ABQ_Error_upload_no_File'] = 'No file was specified to be uploaded.';
$lang['ABQ_Error_upload_invalid_Filename'] = 'No valid file name. Only alphabetic characters, numbers, hyphens (-) and underlines (_) are allowed within the file name. Please rename the file.';
$lang['ABQ_Error_upload_can_not_create_File'] = 'Unable to upload the file. You must have the authorization to upload files. Please check it (chmod %s 777).';
$lang['ABQ_Error_Image_not_deleted'] = 'Unable to delete the image file.<br />You must have the authorization to delete files within the folder images/abq_mod/. Please check it. The CHMOD of this folder must be 777.';
$lang['ABQ_Error_Imageupload_Filesize'] = 'The image file size must be less than %d KB.';
$lang['ABQ_Error_upload_invalid_Image'] = 'Only jpg (jpeg), gif and png images can be uploaded. Other image types are not valid. The image type of your new image is not a valid type.';
$lang['ABQ_Error_MultipleChoice_or_not'] = 'No Multiple Choice: one or more correct answers and no wrong answer; Multiple Choice: only one correct answer and ten wrong answers. Other options do not exist.';
$lang['ABQ_Error_MultipleChoice_Answer_missed'] = 'If you want to use the Multiple Choice function, you must enter 10 wrong answers.';
$lang['ABQ_Error_MultipleChoice_wrong_answer_or_not'] = 'A wrong answer is identical with the correct answer.';
$lang['ABQ_Error_MultipleChoice_Answer_twice'] = 'Do not use a wrong answer twice.';
$lang['ABQ_Error_agreedvariable_name_length'] = 'Please enter a name for the agreed variable with at least 3 and maximum 35 characters (Only numbers and letters A-Z, a-z are allowed).'; 
$lang['ABQ_Error_agreedvariable_value_length'] = 'Please enter a value for the agreed variable with at least 3 and maximum 35 characters (Only numbers and letters A-Z, a-z are allowed).'; 
$lang['ABQ_Error_emailvariable_name_length'] = 'Please enter a name for the email variable with at least 3 and maximum 35 characters (Only numbers and letters A-Z, a-z are allowed).'; 
$lang['ABQ_Error_variables_same_name'] = 'The entered name for the agreed variable can not be the same as for the email variable.'; 

?>