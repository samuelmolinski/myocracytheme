<?php 
function _strrev($str)
{
	if (clsUTF8::is_ascii($str))
		return strrev($str);

	preg_match_all('/./us', $str, $matches);
	return implode('', array_reverse($matches[0]));
}