<?php 
function _trim($str, $charlist = NULL)
{
	if ($charlist === NULL)
		return trim($str);

	return clsUTF8::ltrim(clsUTF8::rtrim($str, $charlist), $charlist);
}