Gallery.prototype = new Page();
Gallery.prototype.constructor=Gallery;

function Gallery(name){
	this.name=name;
};

Gallery.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

Gallery.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.gallery = new Gallery("gallery");