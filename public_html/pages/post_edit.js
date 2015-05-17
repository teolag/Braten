PostEdit.prototype = new Page();
PostEdit.prototype.constructor=PostEdit;

function PostEdit(name){
	this.name=name;
};

PostEdit.prototype.init = function() {
	var my = this;
	console.log("init", my.name);

	this.section = document.querySelector("section[data-id='"+my.name+"']");

	this.heading = this.section.querySelector("h2");

	this.form = this.section.querySelector("form");
	this.form.addEventListener("submit", this.submitForm.bind(this), false);

	this.txtId = this.form.elements['id'];
	this.txtTitle = this.form.elements['title'];
	this.txtText = this.form.elements['text'];



	this.tiny = new tinymce.Editor('txt_text', {
		theme: "modern",
		height: 300,
		plugins: ['code', 'image', 'link', 'table'],
		external_plugins: {
			"tinyGallery": "/js/tinymce_plugin_gallery.js"
		},
		relative_urls : false,
		image_advtab: true,
		menubar: false,
		//file_picker_callback: myImagePicker,
		content_css: "/css/main.css",
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link tinyGallery | code",
		style_formats_merge: true,
		style_formats: [
			{title: 'Bold text', inline: 'b'},
			{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
			{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
			{title: 'Example 1', inline: 'span', classes: 'example1'},
			{title: 'Example 2', inline: 'span', classes: 'example2'},
			{title: 'Table styles'},
			{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},
			{
				title: 'Image Left',
				selector: 'img',
				styles: {
					'float': 'left',
					'margin': '0 10px 0 10px'
				}
			 },
			 {
				 title: 'Image Right',
				 selector: 'img',
				 styles: {
					 'float': 'right',
					 'margin': '0 0 10px 10px'
				 }
			 }
		],

	}, tinymce.EditorManager);
	this.tiny.render();
	p = this.tiny;

	console.log("tiny", this.tiny);

	this.superInit();
};

PostEdit.prototype.show = function(state) {
	this.superShow(state);

	console.log("post show", state);

	if(state.item) {
		var id = parseInt(state.item);
		console.log("edit post id:", id);
		this.heading.textContent = "Redigera inlägg";

		this.txtId.value = id;

		var post = Posts.get(id);
		this.txtTitle.value = post.title;
		this.tiny.setContent(post.text);


	} else {
		console.log("create new post");
		this.heading.textContent = "Skriv nytt inlägg";
		this.txtId.value = "";
		this.txtTitle.value = "";
		this.tiny.setContent("");
	}

};

PostEdit.prototype.submitForm = function(e) {
	e.preventDefault();
	this.tiny.save();
	Ajax.post2JSON("/actions/posts_save.php", e.target, this.submitCallback.bind(this));
};

PostEdit.prototype.submitCallback = function(data) {
	console.log("submitCallback", data);
};


braten.pages.postEdit = new PostEdit("postEdit");