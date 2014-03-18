<?php


function __autoload($className) {
	switch($className) {
		case "DatabasePDO":
		$file = ROOT."classes/DatabasePDO/" . $className.".php";
		break;
		
		case "PHPMailer":
		$file = ROOT."classes/PHPMailer/class.phpmailer.php";
		break;
		
		default:
		$file = ROOT."classes/" . $className.".php";
	}

	if(is_file($file)) require($file);
	else die("Class not found: " . $file);
}



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


function fixText($text) {
	$text = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a target=\"_blank\" href=\"\\2\" >\\2</a>'", $text);
    $text = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a target=\"_blank\" href=\"http://\\2\" >\\2</a>'", $text);
    $text = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1<a href=\"mailto:\\2@\\3\">\\2@\\3</a>", $text);
	$text = nl2br($text);
	return $text;
}


?>