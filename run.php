<?php

require_once('config.php');
require_once('facebook.class.php');

$facebook = new Facebook(ACCESS_TOKEN, LOCALE);

$arr_pages = array();
$expression = 'travel';

$arr_pages = $facebook->searchForPages($expression);
//$arr_pages = $facebook->getPosts(6483988719);

echo '<pre>';
print_r($arr_pages);
echo '</pre>';
