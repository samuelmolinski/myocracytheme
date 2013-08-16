<?php 
function _strcasecmp($str1, $str2)
{
	if (clsUTF8::is_ascii($str1) AND clsUTF8::is_ascii($str2))
		return strcasecmp($str1, $str2);

	$str1 = clsUTF8::strtolower($str1);
	$str2 = clsUTF8::strtolower($str2);
	return strcmp($str1, $str2);
}