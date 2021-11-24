<?php

//gyökér könyvtár a szerveren
define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'].'/web2_2/');

//URL a alkalmazás gyökeréhez
define('SITE_ROOT', 'http://localhost/web2_2/');

// a router.php 
require_once(SERVER_ROOT . 'controllers/' . 'router.php');

?>