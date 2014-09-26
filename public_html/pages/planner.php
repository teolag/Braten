<?php
$year = empty($_GET['year'])? date("Y") : $_GET['year'];



?>

<h2>Planering</h2>

<button type="button" id="btnYearNow">I år</button>
<button type="button" id="btnYearPrev">Föregående år</button>
<button type="button" id="btnYearNext">Nästa år</button><br />


<ul id="plannerPeriods"></ul>
<ul id="plannerWeeks"></ul>
