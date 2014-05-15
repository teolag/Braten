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


tinymce.init({
	selector: "textarea.tinyMCE",
	theme: "modern",
	height: 300,
	plugins: ['code', 'image', 'link', 'table'],
	language_url: '/js/tiny_mce_language_sv_SE.js',
	/*
	plugins: [
		"advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor"
	],
	*/
	file_browser_callback: function(field_name, url, type, win) {
		console.log("file_browser_callback", field_name, url, type, win);
        tinyMCE.activeEditor.windowManager.open({
			title: "Extern fil",
			url: '/tiny_upload/file_browser.php?type='+type,
			width: 500,
			height: 400
		}, {
			type: type,
			field: win.document.getElementById(field_name)
		});
		
		
    },
	//content_css: "css/content.css",
	toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code", 
	style_formats: [
		{title: 'Bold text', inline: 'b'},
		{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
		{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
		{title: 'Example 1', inline: 'span', classes: 'example1'},
		{title: 'Example 2', inline: 'span', classes: 'example2'},
		{title: 'Table styles'},
		{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	]
}); 