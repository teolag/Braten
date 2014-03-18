<?php
$year = empty($_GET['year'])? date("Y") : $_GET['year'];



?>

<h2>Planering <?php echo $year ?></h2>

<a href="?page=planner&year=<?php echo $year+1; ?>">Nästa år</a><br />
<a href="?page=planner&year=<?php echo $year-1; ?>">Föregående år</a><br />
<?php if($year!=date("Y")) echo "<a href='?page=planner'>Tillbaka till ". date("Y") . "</a>";?><br />

<div id="plan">
<?php /*
foreach($owners as $nr => $family) {
	echo "<div class='owner ownercolor".$nr."'><h3>Fam.  " . $family . "</h3>";
	switch($nr) {
		case getOwner(0, $year):
		echo "v. 25-27 - Sommar I";
		break;
		
		case getOwner(1, $year):
		echo "v. ". getEasterWeek($year)." - Påsk<br />";
		echo "v. 28-29 - Sommar II<br />";
		break;
		
		case getOwner(2, $year):
		echo "v. ". (getEasterWeek($year)+6)." Kristihimmel<br />";
		echo "v. 30-32 - Sommar III<br />";
		break;				
	}
	echo "</div>";		
}*/
?>
<?php
for($period=0; $period<3; $period++) {
	$owner = getOwner($period, $year);
	
	
	echo "<div class='owner ownercolor".$owner."'><h3>Fam.  " . $owners[$owner] . "</h3>";
	switch($period) {
		case 0:
		echo "v. 25-27 - Sommar I";
		break;
		
		case 1:
		echo "v. ". getEasterWeek($year)." - Påsk<br />";
		echo "v. 28-29 - Sommar II<br />";
		break;
		
		case 2:
		echo "v. ". (getEasterWeek($year)+6)." Kristihimmel<br />";
		echo "v. 30-32 - Sommar III<br />";
		break;				
	}
	echo "</div>";		
}
?>
</div>

<table id="weeks"><tr>
<?php 
foreach(range(12,34) as $v) {
	$class="noowner";
	if($v==25 || $v==26 || $v==27) { 							$class="ownercolor".getOwner(0, $year); }
	elseif($v==28 || $v==29 || $v==getEasterWeek($year)) { 		$class="ownercolor".getOwner(1, $year); }
	elseif($v==30 || $v==31 || $v==32 || $v==getEasterWeek($year)+6) { 	$class="ownercolor".getOwner(2, $year); }
	
	echo "<td class='".$class."'>".$v."</td>";
}
?>
</tr></table>
