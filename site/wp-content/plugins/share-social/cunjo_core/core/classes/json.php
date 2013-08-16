<?php 
class clsJSON 
{
    static function encode(array $data)
    {
        return json_encode($data);
    }

    static function decode(array $data)
    {
        return json_decode($data);
    }
} 
