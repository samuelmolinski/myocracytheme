<?php 
$default_key = "##wp-core-mvc#$@%$";
return array(
    'default' => array(
        'key' => $default_key,
        'cipher' => MCRYPT_RIJNDAEL_128,
        'mode'   => MCRYPT_MODE_NOFB,
    ),
);
?>
