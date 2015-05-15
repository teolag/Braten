<?php


define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/../');
session_cache_limiter('private');
session_start();

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

setlocale(LC_TIME, 'sv_SV', 'swedish');
require ROOT."includes/config.php";
require "/git/DatabasePDO/DatabasePDO.php";
require ROOT."classes/Gatekeeper.php";

define("SALT", $config['salt']);

$db = new DatabasePDO($config["db"]["server"], $config["db"]["username"], $config["db"]["password"], $config["db"]["name"]);




$easterWeeks = array();
for($year=2000; $year<2035;  $year++) {
	$easterWeeks[] = date("W", easter_date($year));
}




$owners = array("Mats", "Gunilla", "Eva");

function getEasterWeek($year) {
	return date("W", easter_date($year));
}

function getMidsummerWeek($year) {
	$date = findNextDayOfWeek(strtotime($year."-06-20"),6);
	return date("W",$date);
}

function getPrioritizedFamily($week, $year) {
	if($week>32 || $week<12) return 3;

	$easterWeek = getEasterWeek($year);
	switch($week) {
		case 25: case 26: case 27:
		$period = 0;
		break;

		case 28: case 29: case $easterWeek:
		$period = 1;
		break;

		case 30: case 31: case 32: case $easterWeek+6:
		$period = 2;
		break;

		default:
		return 3;
		break;
	}
	return getOwner($period, $year);
}

function getOwner($period, $year) {
	$owner = $period - $year%3;
	if($owner>2) $owner -= 3;
	if($owner<0) $owner += 3;
	return $owner;
}

?>