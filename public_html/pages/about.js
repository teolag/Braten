About.prototype = new Page();
About.prototype.constructor=About;

function About(name){
	this.name=name;
};

About.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

About.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.about = new About("about");