StartPage.prototype = new Page();
StartPage.prototype.constructor=StartPage;

function StartPage(name){ 
	this.name=name;
};

StartPage.prototype.init = function() {
	var my = this;
	console.log("init", my.name);
	this.initialized = true;
};

StartPage.prototype.show = function(state) {
	this.superShow(state);
};

braten.pages.start = new StartPage("start");