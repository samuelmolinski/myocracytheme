<?php 
function _strpos($str, $search, $offset = 0)
{
	$offset = (int) $offset;

	if (clsUTF8::is_ascii($str) AND clsUTF8::is_ascii($search))
		return strpos($str, $search, $offset);

	if ($offset == 0)
	{
		$array = explode($search, $str, 2);
		return isset($array[1]) ? clsUTF8::strlen($array[0]) : FALSE;
	}

	$str = clsUTF8::substr($str, $offset);
	$pos = clsUTF8::strpos($str, $search);
	return ($pos === FALSE) ? FALSE : $pos + $offset;
}