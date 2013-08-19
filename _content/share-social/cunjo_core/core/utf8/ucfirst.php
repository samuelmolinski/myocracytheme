<?php 
function _ucfirst($str)
{
	if (clsUTF8::is_ascii($str))
		return ucfirst($str);

	preg_match('/^(.?)(.*)$/us', $str, $matches);
	return clsUTF8::strtoupper($matches[1]).$matches[2];
}