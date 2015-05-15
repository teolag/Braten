PostEdit.prototype = new Page();
PostEdit.prototype.constructor=PostEdit;

function PostEdit(name){
	this.name=name;
};

PostEdit.prototype.init = function() {
	var my = this;
	console.log("init", my.name);

	this.section = document.querySelector("section[data-id='"+my.name+"']");
	this.form = this.section.querySelector("form");
	this.form.addEventListener("submit", this.submitForm.bind(this), false);


	tinymce.init({
		selector: "textarea.tinyMCE",
		theme: "modern",
		height: 300,
		plugins: ['code', 'image', 'link', 'table'],
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
				url: '/file_browser.php',
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

	this.superInit();
};

PostEdit.prototype.show = function(state) {
	this.superShow(state);

};

PostEdit.prototype.submitForm = function(e) {
	e.preventDefault();
	tinyMCE.activeEditor.save();
	Ajax.post2JSON("/actions/posts_save.php", e.target, this.submitCallback.bind(this));
};

PostEdit.prototype.submitCallback = function(data) {
	console.log("submitCallback", data);
};


braten.pages.postEdit = new PostEdit("postEdit");