<html>
<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php

require_once('config.php');
require_once('facebook.class.php');

$facebook = new Facebook(ACCESS_TOKEN, LOCALE);

$arr_result = array();
$expression = 'travel';

$arr_result = $facebook->searchForPages($expression);
//$arr_result = $facebook->getPosts('6483988719');
//$arr_result = $facebook->getPageInformation('1422456317971571');

if (is_null($arr_result)) {
	echo 'No result';
}
else {
	echo '<pre>';
	print_r($arr_result);
	echo '</pre>';
}
?>
</body>
</html>
