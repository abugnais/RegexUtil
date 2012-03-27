<?php

/*
 *  Ahmad Moqanasa
 *
 *  php regualr expressions utility library
 *  to use this library your strings need to be encoded in utf-8
 *  if you're using any other character encoding make sure to convert it into utf-8 using the convertCharset function
 */
class RegexUtil {
    /*
     *  returns an array of all the english words in a given text
     *  @param  string  $text           the text that contains the words
     *  @param  integer $minLength      optional,the minimum length of the words to find
     *  @return array 
     */
    public static function findWords($text,$minLength = 1) {
        $regex = '/\w{' .  $minLength . ',}/u';
        preg_match_all($regex,$text,$matches);    
        return $matches;
    }
    /*
     *  returns an array of valid urls found in the given text
     *  @param  string $text    the text that contains the links    
     *  @return array
     */
    public static function findLinks($text) {
        $regex = '#\b(([\w-]+://?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/)))#ui';
        preg_match_all($regex,$text,$matches);
        return $matches[0];
    }
    /*
     *  matches arabic text and returns and array of all arabic words if the flag $returnMatches is set to true
     *  @param  string  $text the text to be examined 
     *  @param  bool    $returnMatches optional,if set to true returns an array of the found words
     *  @return bool|array 
     */
    public static function matchArabic($text,$returnMatches = false) {
        $regex = '/([\x{0621}-\x{0670}]+)/u';
        if(!$returnMatches) return preg_match($regex,$text);
        preg_match_all($regex,$text,$matches);
        return $matches[0];
    }
    /*
     *  matches all the non printable control characters in a given text
     *  @param  string $text the text to be examined 
     *  @param  bool   $remove if set to true removes all the control characters from the string $text
     *  @return bool|string
     */
    public static function findControlChars($text,$remove = false) {
        $regex = '/(?![\x{000d}\x{000a}\x{0009}])\p{C}/u';
        if(!$remove) return preg_match($regex,$text);
        return preg_replace($regex,'',$text);
    }
    /*
     *  matches all the valid twitter screen names in a given text
     *  @param  string $text
     *  @return array
     */
    public static function twitterNames($text) {
        $regex = '/@\w{1,15}/u';
        preg_match_all($regex,$text,$matches);
        return $matches;
    }
    /*
     *  matches all the valid twitter hashtags in a given text
     *  @param  string $text
     *  @return array
     */
    public static function hashtags($text) {
        $regex = '/#\w+/u';
        preg_match_all($regex,$text,$matches);
        return $matches;  
    }
    /*
     *  matches all the valid emails in a given text
     *  @param  string $text
     *  @return array
     */
    public static function findEmails($text) {
        $regex = ";[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?;ui";
        preg_match_all("$regex",$text,$matches);
        return $matches;
    }
    /*
     *  matches all the integers in a given text
     *  @param string $text
     *  @param integer $minLength the minimum number of digits in the numbers to find
     *  @param integer $maxLength the maximum number of digits in the numbers to find
     *  @return array
     */
    public static function findNumbers($text,$minLength = 1,$maxLength = '') {
        if($minLength > $maxLength) $maxLength = '';
        $regex = '/\d{' . $minLength . ',' . $maxLength . '}/u';
        preg_match_all($regex,$text,$matches);
        return $matches;
    }
    /*
     *  Removes extra spaces from the given text
     *  @param string $text 
     *  @return string
     */
    public static function removeExtraSpaces($text) {
        $regex = "/\s+/u";
        return preg_replace($regex,' ',$text);
    }
    /*
     *  Checks the given password based on the given validation conditions
     *  @param string $text the password to be checkes
     *  @param int $minLength the passwords minimum length default = 6
     *  @param bool $char   password condition:need to have at least one character default = true
     *  @param bool $digit  passsword condition:need to have at least one digit default = true
     *  @param bool $symbol password condition:need to have at least one symbol default = false
     *  @param bool $upperCase password condition:need to have at least one upper case character default = false
     */
    public static function passwordVlidator($text,$minLength = 6,$char = true,$digit = true,$symbol = false,$upperCase = false) {
        $regex = '(?=.{' . $minLength . ',})';
        $regex .= $char         ? '(?=.+[a-zA-Z])'   : '';
        $regex .= $digit        ? '(?=.+\d)'         : '';
        $regex .= $upperCase    ? '(?=.+[A-Z])'      : '';
        $regex .= $symbol       ? '(?=.+\W+)'        : '';
        $regex = "/^$regex$/u";
        return preg_match($regex,$text);
    }
    /*
     *  Converts the given string character set to UTF-8 to be compitable with this library
     *  @param string $text the string to be converted
     *  @param string $from the current string character encoding default = auto
     *  @return string
     */
    public static function convertCharset($text,$from = 'auto') {
        if($from == 'auto') $from = mb_detect_encoding($text);
        return iconv($from,'utf-8',$text);
    }
}
?>
