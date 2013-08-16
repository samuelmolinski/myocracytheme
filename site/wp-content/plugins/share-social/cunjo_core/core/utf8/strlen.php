<?php 
function _strlen($str)
{
	if (clsUTF8::is_ascii($str))
		return strlen($str);

	return strlen(utf8_decode($str));
}