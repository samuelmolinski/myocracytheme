<?php
class clsEncrypt_Simple
{
  private static function getKey($key)
  {
      if($key == '')
      {
          $config = WPFuel::LoadConfig('encrypt');
          $config = $config['default'];

          return $config['key'];
      }
      return $key;
      
  }
  
  static function encrypt($string, $key='') {
      
      $key = self::getKey($key);
      
      $result = '';
      for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)+ord($keychar));
        $result.=$char;
      }

      return base64_encode($result);
    }

    static function decrypt($string, $key='') {
        
      $key = self::getKey($key);
        
      $result = '';
      $string = base64_decode($string);

      for($i=0; $i<strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key))-1, 1);
        $char = chr(ord($char)-ord($keychar));
        $result.=$char;
      }

      return $result;
    }
}

?>