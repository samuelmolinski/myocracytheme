<?PHP
$session_key = clsSlug::Generate(get_bloginfo('blogname')).'-session';
return array(
    'native' => array(
        'name' => $session_key,
        'lifetime' => clsDate::WEEK,
    ),
    'cookie' => array(
        'name' => $session_key,
        'encrypted' => TRUE,
        'lifetime' => clsDate::YEAR * 2,
    ),
);
?>

