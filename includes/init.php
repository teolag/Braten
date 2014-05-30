<?php


define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/../');
session_start();

setlocale(LC_TIME, 'sv_SV', 'swedish');
require ROOT."includes/config.php";
require ROOT."classes/DatabasePDO/DatabasePDO.php";
require ROOT."classes/Gatekeeper.php";

define("SALT", $config['salt']);

$db = new DatabasePDO($config["db"]["server"], $config["db"]["username"], $config["db"]["password"], $config["db"]["name"]);



?>