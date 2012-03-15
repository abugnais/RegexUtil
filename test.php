<?php
/*
 *  Ahmad Moqanasa
 *  testing some of the functions in the RegexUtil Library
 *  uncomment each of the lines starting with a # to test a new function
 *  check out the rest of the functions in the RegexUtil class
 */
require('RegexUtil.php');
/*  just some random text,replace it with your own   */
$text           = file_get_contents("test_cases/twitter_wiki.html");
$text           .= file_get_contents("test_cases/fb_wiki.html");
$text           .= file_get_contents("test_cases/arabic_wiki.html");

/*  convert text character encoding from unknown to utf-8*/
$text           = RegexUtil::convertCharset($text);

/*  extract all numbers  */
$arr['numbers']     = RegexUtil::findNumbers($text);

/*  extract all valid email addresses   */
$arr['emails']      = RegexUtil::findEmails($text);

/*  extract all valid hashtags  */
#$arr['hashtags']    = RegexUtil::hashtags($text);

/*  extract all valid twitter screen names  */
#$arr['names']       = RegexUtil::twitterNames($text);

/*  extract all arabic words and return them in an array    */
#$arr['arabic']      = RegexUtil::matchArabic($text,true);


print_r($arr);
?>
