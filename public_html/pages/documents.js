Documents.prototype = new Page();
Documents.prototype.constructor=Documents;

function Documents(name){
	this.name=name;
};

Documents.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

Documents.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.documents = new Documents("documents");