<?php 
function _str_pad($str, $final_str_length, $pad_str = ' ', $pad_type = STR_PAD_RIGHT)
{
	if (clsUTF8::is_ascii($str) AND clsUTF8::is_ascii($pad_str))
		return str_pad($str, $final_str_length, $pad_str, $pad_type);

	$str_length = clsUTF8::strlen($str);

	if ($final_str_length <= 0 OR $final_str_length <= $str_length)
		return $str;

	$pad_str_length = clsUTF8::strlen($pad_str);
	$pad_length = $final_str_length - $str_length;

	if ($pad_type == STR_PAD_RIGHT)
	{
		$repeat = ceil($pad_length / $pad_str_length);
		return clsUTF8::substr($str.str_repeat($pad_str, $repeat), 0, $final_str_length);
	}

	if ($pad_type == STR_PAD_LEFT)
	{
		$repeat = ceil($pad_length / $pad_str_length);
		return clsUTF8::substr(str_repeat($pad_str, $repeat), 0, floor($pad_length)).$str;
	}

	if ($pad_type == STR_PAD_BOTH)
	{
		$pad_length /= 2;
		$pad_length_left = floor($pad_length);
		$pad_length_right = ceil($pad_length);
		$repeat_left = ceil($pad_length_left / $pad_str_length);
		$repeat_right = ceil($pad_length_right / $pad_str_length);

		$pad_left = clsUTF8::substr(str_repeat($pad_str, $repeat_left), 0, $pad_length_left);
		$pad_right = clsUTF8::substr(str_repeat($pad_str, $repeat_right), 0, $pad_length_left);
		return $pad_left.$str.$pad_right;
	}

	trigger_error('clsUTF8::str_pad: Unknown padding type (' . $pad_type . ')', E_USER_ERROR);
}