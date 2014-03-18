$(function() {


	$navForm = $("#nav_form");
	
	
	$navForm.children("button").hide();
	
	$navForm.on("change", "select", function() {
		console.log("bytte val");
		$navForm.submit();
	});
	
	$navForm.on("submit", function() {
		console.log("Submitta");
	});
	
	
});


