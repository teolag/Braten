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

	this.superInit();
};

PostEdit.prototype.show = function(state) {
	this.superShow(state);

};

PostEdit.prototype.submitForm = function(e) {
	e.preventDefault();
	Ajax.post2JSON("/actions/posts_save.php", e.target, this.submitCallback.bind(this));

};

PostEdit.prototype.submitCallback = function(data) {
	console.log("submitCallback", data);
};


braten.pages.postEdit = new PostEdit("postEdit");