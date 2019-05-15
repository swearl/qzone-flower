<?php
define("QFLOWER", 1);

if(file_exists(__DIR__ . "/config.dev.php")) {
	require_once(__DIR__ . "/config.dev.php");
} else {
	require_once(__DIR__ . "/config.php");
}

require_once(__DIR__ . "/include/curl.php");
require_once(__DIR__ . "/include/flower.php");

define("QQ", str_replace("o", "", COOKIE_P_UIN));

$flower = new flower();
$data = $flower->useProp(7);
var_dump($data);